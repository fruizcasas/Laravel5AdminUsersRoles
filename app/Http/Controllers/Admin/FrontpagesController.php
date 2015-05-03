<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;

use App\Profile;
use DB;
use Exception;
use Flash;
use Excel;


use App\Http\Requests\Admin\FrontpageRequest as ModelRequest;
use App\Http\Requests\Admin\FrontpageNewRequest as ModelNewRequest;
use App\Http\Requests\Admin\DeleteRequest as DeleteRequest;
use App\Http\Requests\Admin\FrontpageSearchRequest as SearchRequest;
use App\Models\Admin\Frontpage;
use App\Models\Admin\User;


class FrontpagesController extends Controller
{

    protected $model_name = 'Frontpage';
    protected $index_view = 'admin.frontpages.index';
    protected $create_view = 'admin.frontpages.create';
    protected $show_view = 'admin.frontpages.show';
    protected $edit_view = 'admin.frontpages.edit';

    protected $index_route = 'admin.frontpages.index';
    protected $create_route = 'admin.frontpages.create';
    protected $show_route = 'admin.frontpages.show';
    protected $edit_route = 'admin.frontpages.edit';
    protected $trash_route = 'admin.frontpages.trash';

    protected $resource_name = 'controllers/admin/frontpages.';

    protected $sort_fields =
        [
            'id',
            'code',
            'edition',
            'status',
            'review_date',
            'publishing_date',
            'total_pages ',
            'title',
            'reason_for_revision',
            'author_id',
            'reviewer_id',
            'approver_id',
            'publisher_id',
        ];

    protected $filter_fields =
        [
            'id',
            'code',
            'edition',
            'status',
            'review_date',
            'publishing_date',
            'total_pages ',
            'title',
            'reason_for_revision',
            'author_id',
            'reviewer_id',
            'approver_id',
            'publisher_id',
        ];

    protected $filter_numeric_fields =
        [
            'id',
            'edition',
        ];

    protected $filter_boolean_fields =
        [
        ];

    /**
     * @var array
     */
    protected $filter_has_fields =
        [
            'author',
            'reviewer',
            'approver',
            'publisher',
        ];


    public function __construct()
    {
        $this->middleware('admin');
    }


    public function show_trash()
    {
        return Session($this->index_view . '.trash', false);
    }

    public function trash($value = false)
    {
        if (isset($value)) {
            if ($value) {
                $value = true;
            } else {
                $value = false;
            }
        } else {
            $value = false;
        }
        Session([$this->index_view . '.trash' => $value]);
        return redirect(route($this->index_route, []));
    }

    public function filter(SearchRequest $request)
    {
        foreach ($this->filter_fields as $field) {
            Profile::loginProfile()->setFilterValue($this->index_view, $field, $request->input($field, ''));
        }
        return redirect(route($this->index_route, []));
    }

    public function sort($column = null, $order = null)
    {
        if (isset($order)) {
            if ($order !== 'desc') {
                $order = 'asc';
            }
        } else {
            $order = 'asc';
        };

        if (isset($column)) {
            if (in_array($column, $this->sort_fields)) {
                Profile::loginProfile()->setOrderByValue($this->index_view, $column, $order);
            }
        } else {
            Profile::loginProfile()->setOrderBy($this->index_view, []);
        };

        return redirect(route($this->index_route, []));
    }

    public function getModels($filter = null)
    {
        $models = Frontpage::sortable($this->index_view);
        if ($this->show_trash()) {
            $models = $models->withTrashed();
        }
        if (isset($filter)) {
            foreach ($this->filter_fields as $field) {
                if (trim($filter[$field]) != '') {
                    $models = $models->Where(function ($query) use ($field, $filter) {
                        $values = explode(',', $filter[$field]);
                        $first = true;
                        foreach ($values as $value) {
                            if (in_array($field, $this->filter_numeric_fields)) {
                                if ($first) {
                                    $query = $query->Where($field, $value);
                                    $first = false;
                                } else {
                                    $query = $query->orWhere($field, $value);
                                }
                            } else if (in_array($field, $this->filter_boolean_fields)) {
                                $value = (strtolower($value) == 'x');
                                if ($first) {
                                    $query = $query->Where($field, $value);
                                    $first = false;
                                } else {
                                    $query = $query->orWhere($field, $value);
                                }
                            } else if (in_array($field, $this->filter_has_fields)) {
                                $value = '%' . $value . '%';
                                if ($first) {
                                    $query = $query->whereHas($field, function ($q) use ($value) {
                                        $q->where('name', 'LIKE', $value);
                                    });
                                    $first = false;
                                } else {
                                    $query = $query->orWhereHas($field, function ($q) use ($value) {
                                        $q->where('name', 'LIKE', $value);
                                    });
                                }
                            } else {
                                $value = '%' . $value . '%';
                                if ($first) {
                                    $query = $query->Where($field, 'LIKE', $value);
                                    $first = false;
                                } else {
                                    $query = $query->orWhere($field, 'LIKE', $value);
                                }
                            }
                        }
                    });
                }
            }
        }
        return $models;
    }

    public function getModel($id)
    {
        return $this->getModels()->findOrFail($id);
    }

    public function getFilter()
    {
        $values = [];
        foreach ($this->filter_fields as $field) {
            $values[$field] = Profile::loginProfile()->getFilterValue($this->index_view, $field);
        }
        return $values;
    }


    public function excel($format = 'xlsx')
    {
        $filter = $this->getFilter();
        $models = $this->getModels($filter);
        Excel::create(str_plural($this->model_name), function ($excel) use ($models) {

            // Our first sheet
            $excel->sheet(str_plural($this->model_name),
                function ($sheet) use ($models) {
                    $sheet->fromModel($models->get())
                        ->setAutoFilter();
                });


        })->export($format);
    }

    /**
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $filter = $this->getFilter();
        $models = $this->getModels($filter)->with('author')->with('reviewer')->with('approver')->with('publisher');
        $models = $models->paginate(Profile::loginProfile()->per_page);
        return view($this->index_view, compact('models', 'filter'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $model = new Frontpage();
        $users = [null =>'Empty'] +
                  User::withTrashed()->lists('display_name','id');
        return view($this->create_view,
            compact([
                'model','users',
            ]));
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function show($id)
    {
        try {
            $model = $this->getModel($id);
            $users = [null =>'Empty'] +
                      User::withTrashed()->lists('display_name','id');
            return view($this->show_view,
                compact([
                    'model',
                    'users',
                ]));
        } catch (Exception $e) {
            Flash::warning(trans($this->resource_name . 'not_found', ['model' => $this->model_name, 'id' => $id]));
            return $this->index();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function edit($id)
    {
        try {
            $model = $this->getModel($id);
            $users = [null =>'Empty'] +
                    User::withTrashed()->lists('display_name','id');

            return view($this->edit_view,
                compact([
                    'model',
                    'users'
                ]));
        } catch (Exception $e) {
            Flash::warning(trans($this->resource_name . 'not_found', ['model' => $this->model_name, 'id' => $id]));
            return $this->index();
        }
    }


    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(ModelNewRequest $request)
    {
        try {
            $model = new Frontpage($request->all());
            try {
                DB::beginTransaction();
                $model->save();
                DB::commit();
                Flash::info(trans($this->resource_name . 'saved', ['model' => $this->model_name]));
                return redirect(route($this->show_route, [$model->id]));
            } catch (Exception $e) {
                DB::rollBack();
                throw $e;
            }
        } catch (Exception $e) {
            $errors = [];
            if ($e->getCode() == 23000) {
                $errors['email'] = trans($this->resource_name . 'duplicated_email');
            } else {
                Flash::error(get_class($e).'-'.$e->getMessage());
            }
            return $request->response($errors);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     * @return Response
     */
    public function update($id, ModelRequest $request)
    {
        try {
            $model = $this->getModel($id);
            try {
                DB::beginTransaction();
                $model->update($request->all());
                DB::commit();
                Flash::info(trans($this->resource_name . 'saved', ['model' => $this->model_name]));
                return redirect(route($this->show_route, [$model->id]));
            } catch (Exception $e) {
                DB::rollBack();
                throw $e;
            }
        } catch (Exception $e) {
            $errors = [];
            if ($e->getCode() == 23000) {
                $errors['email'] = trans($this->resource_name . 'duplicated_email');
            } else {
                Flash::error(get_class($e).'-'.$e->getMessage());
            }
            return $request->response($errors);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($id, DeleteRequest $request)
    {
        try {
            $model = $this->getModel($id);
            $model->delete();
            Flash::info(trans($this->resource_name . 'sent_to_trash', ['model' => $this->model_name]));
            if ($this->show_trash()) {
                return redirect(route($this->show_route, [$id]));
            } else {
                return redirect(route($this->index_route, []));
            }
        } catch (Exception $e) {
            Flash::error($e->getMessage());
            return $request->response([]);
        }
    }


    public function restore($id, DeleteRequest $request)
    {
        try {
            $model = $this->getModel($id);
            $model->restore();
            Flash::info(trans($this->resource_name . 'restored', ['model' => $this->model_name]));
            return redirect(route($this->show_route, [$id]));
        } catch (Exception $e) {
            Flash::error($e->getMessage());
            return $request->response([]);
        }
    }

    public function forcedelete($id, DeleteRequest $request)
    {
        try {
            $model = $this->getModel($id);
            DB::transaction(
                function () use ($model) {
                    $model->forcedelete();
                });
            Flash::info(trans($this->resource_name . 'deleted', ['model' => $this->model_name]));
            return redirect(route($this->index_route, []));
        } catch (Exception $e) {
            Flash::error($e->getMessage());
            return $request->response([]);
        }
    }

}
