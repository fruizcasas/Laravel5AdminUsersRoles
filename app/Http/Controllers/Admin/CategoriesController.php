<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Profile;
use DB;
use Exception;
use Flash;
use Excel;
use PDOException;

use App\Http\Requests\Admin\CategoryRequest as ModelRequest;
use App\Http\Requests\Admin\CategoryNewRequest as ModelNewRequest;
use App\Http\Requests\Admin\DeleteRequest as DeleteRequest;
use App\Http\Requests\Admin\CategorySearchRequest as SearchRequest;
use App\Models\Admin\Category;


/**
 * Class CategoriesController
 * @package App\Http\Controllers\Admin
 */
class CategoriesController extends Controller
{

    /**
     * @var string
     */
    protected $model_name = 'Category';
    /**
     * @var string
     */
    protected $index_view = 'admin.categories.index';
    /**
     * @var string
     */
    protected $create_view = 'admin.categories.create';
    /**
     * @var string
     */
    protected $show_view = 'admin.categories.show';
    /**
     * @var string
     */
    protected $edit_view = 'admin.categories.edit';

    /**
     * @var string
     */
    protected $index_route = 'admin.categories.index';
    /**
     * @var string
     */
    protected $create_route = 'admin.categories.create';
    /**
     * @var string
     */
    protected $show_route = 'admin.categories.show';
    /**
     * @var string
     */
    protected $edit_route = 'admin.categories.edit';
    /**
     * @var string
     */
    protected $trash_route = 'admin.categories.trash';

    /**
     * @var string
     */
    protected $resource_name = 'controllers/admin/categories.';

    /**
     * @var array
     */
    protected $sort_fields =
        [
            'id',
            'name',
            'acronym',
            'order',
            'display_name',
        ];

    /**
     * @var array
     */
    protected $filter_fields =
        [
            'id',
            'name',
            'acronym',
            'order',
            'display_name',
            'parent',
            'description',
        ];

    /**
     * @var array
     */
    protected $filter_numeric_fields =
        [
            'id',
            'order',
        ];


    /**
     * @var array
     */
    protected $filter_boolean_fields =
        [
        ];


    /**
     *
     */
    public function __construct()
    {
        $this->middleware('admin');

        /*
         * check the ROOT_ITEM with a null parent
         * check all items with null parent to be ROOT_ITEM owned
         */
        $root = Category::withTrashed()->find(Category::ROOT_CATEGORY);
        if (!$root) {
            $root = new Category();
            $root->name = '*';
            $root->acronym = '*';
            $root->display_name = '*';
            $root->category_id = null;
            $root->save();
            $root->id = Category::ROOT_CATEGORY;
            $root->save();
        } else {
            if ($root->trashed()) {
                $root->restore();
            };
            if ($root->category_id != null) {
                $root->category_id = null;
                $root->save();
            }
        }
        Category::withTrashed()->whereCategoryId(null)
                               ->where('id', '<>', Category::ROOT_CATEGORY)
                               ->update(['category_id' => Category::ROOT_CATEGORY]);
    }


    /**
     * @return bool session_value
     */
    public function show_trash()
    {
        return Session($this->index_view . '.trash', false);
    }

    /**
     * @param bool $value
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function trash($value = false)
    {
        Session([$this->index_view . '.trash' => $value ? true : false]);
        return redirect(route($this->index_route));
    }

    /**
     * @param null $filter
     * @return Category|\Illuminate\Database\Eloquent\Builder|static
     */
    public function getModels($filter = null)
    {
        $models = Category::sortable($this->index_view);
        if ($this->show_trash()) {
            $models = $models->withTrashed();
        }
        if (isset($filter)) {
            foreach ($this->filter_fields as $field) {
                if (trim($filter[$field]) != '') {
                    $values = explode(',', $filter[$field]);
                    $first = true;
                    foreach ($values as $value) {
                        if (in_array($field, $this->filter_numeric_fields)) {
                            if ($first) {
                                $models = $models->Where($field, $value);
                                $first = false;
                            } else {
                                $models = $models->orWhere($field, $value);
                            }
                        } else if (in_array($field, $this->filter_boolean_fields)) {
                            $value = (strtolower($value) == 'x');
                            if ($first) {
                                $models = $models->Where($field, $value);
                                $first = false;
                            } else {
                                $models = $models->orWhere($field, $value);
                            }
                        } else if ($field == 'parent') {
                            $value = '%' . $value . '%';
                            if ($first) {
                                $models = $models->whereHas('parent', function ($q) use ($value) {
                                    $q->where('name', 'like', $value);
                                });
                                $first = false;
                            } else {
                                $models = $models->orWhereHas('parent', function ($q) use ($value) {
                                    $q->where('name', 'like', $value);
                                });
                            }

                        } else {
                            $value = '%' . $value . '%';
                            if ($first) {
                                $models = $models->Where($field, 'LIKE', $value);
                                $first = false;
                            } else {
                                $models = $models->orWhere($field, 'LIKE', $value);
                            }
                        }
                    }
                }
            }
        }
        return $models;
    }

    /**
     * @param $id
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model
     */
    public function getModel($id)
    {
        return $this->getModels()->findOrFail($id);
    }

    /**
     * @return array
     */
    public function getFilter()
    {
        $values = [];
        foreach ($this->filter_fields as $field) {
            $values[$field] = Profile::loginProfile()->getFilterValue($this->index_view, $field);
        }
        return $values;
    }

    /**
     * @param SearchRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function filter(SearchRequest $request)
    {
        foreach ($this->filter_fields as $field) {
            Profile::loginProfile()->setFilterValue($this->index_view, $field, $request->input($field, ''));
        }
        return redirect(route($this->index_route));
    }

    /**
     * @param null $column
     * @param null $order
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
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

        return redirect(route($this->index_route));
    }

    /**
     * @param string $format
     */
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
        $models = $this->getModels($filter);
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
        $categories = Category::ListItems();
        $model = new Category();
        return view($this->create_view,
            compact([
                'model',
                'categories',
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
            $categories = Category::ListItems();
            $model = $this->getModel($id);
            return view($this->show_view, compact([
                'model',
                'categories',
            ]));
        } catch (Exception $e) {
            if ($e instanceof PDOException) {
                Flash::error($e->errorInfo[2]);
            } else {
                Flash::warning(trans($this->resource_name . 'not_found', ['model' => $this->model_name, 'id' => $id]));
            }
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
        if ($id == Category::ROOT_CATEGORY) {
            $categories = Category::ListItems();
            $model = $this->getModel($id);
            Flash::warning(trans($this->resource_name . 'forbidden'));
            return view($this->show_view, compact([
                'model',
                'categories',
            ]));
        }
        try {
            $model = $this->getModel($id);
            $excluded = $model->children()->lists('id');
            $excluded[] = $model->id;
            $categories = Category::ListItems($excluded);
            return view($this->edit_view, compact([
                'model',
                'categories',
            ]));
        } catch (Exception $e) {
            if ($e instanceof PDOException) {
                Flash::error($e->errorInfo[2]);
            } else {
                Flash::warning(trans($this->resource_name . 'not_found', ['model' => $this->model_name, 'id' => $id]));
            }

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
            $model = new Category($request->all());
            try {
                DB::beginTransaction();
                $category_id = $request->input('category_id', null);
                $model->category_id = $category_id;
                $model->save();
                DB::commit();
                Flash::info(trans($this->resource_name . 'saved', ['model' => $this->model_name]));
                return redirect(route($this->show_route, [$model->id]));
            } catch (Exception $e) {
                DB::rollBack();
                throw $e;
            }
        } catch (Exception $e) {
            if ($e instanceof PDOException) {
                Flash::error($e->errorInfo[2]);
            } else {
                Flash::error($e->getMessage());
            }
            return $request->response([]);
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
                $category_id = $request->input('category_id', null);
                $model->category_id = $category_id;
                $model->update($request->all());
                DB::commit();
                Flash::info(trans($this->resource_name . 'saved', ['model' => $this->model_name]));
                return redirect(route($this->show_route, [$model->id]));
            } catch (Exception $e) {
                DB::rollBack();
                throw $e;
            }
        } catch (Exception $e) {
            if ($e instanceof PDOException) {
                Flash::error($e->errorInfo[2]);
            } else {
                Flash::error($e->getMessage());
            }
            return $request->response([]);
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
        if ($id == Category::ROOT_CATEGORY) {
            $categories = Category::ListItems();
            $model = $this->getModel($id);
            Flash::warning(trans($this->resource_name . 'forbidden'));
            return view($this->show_view, compact([
                'model',
                'categories',
            ]));
        }

        try {
            $model = $this->getModel($id);
            $model->delete();
            Flash::info(trans($this->resource_name . 'sent_to_trash', ['model' => $this->model_name]));
            if ($this->show_trash()) {
                return redirect(route($this->show_route, [$id]));
            } else {
                return redirect(route($this->index_route));
            }
        } catch (Exception $e) {
            if ($e instanceof PDOException) {
                Flash::error($e->errorInfo[2]);
            } else {
                Flash::error($e->getMessage());
            }
            return $request->response([]);
        }
    }


    /**
     * @param $id
     * @param DeleteRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Symfony\Component\HttpFoundation\Response
     */
    public function restore($id, DeleteRequest $request)
    {
        try {
            $model = $this->getModel($id);
            $model->restore();
            Flash::info(trans($this->resource_name . 'restored', ['model' => $this->model_name]));
            return redirect(route($this->show_route, [$id]));
        } catch (PDOException $e) {
            if ($e instanceof PDOException) {
                Flash::error($e->errorInfo[2]);
            } else {
                Flash::error($e->getMessage());
            }
            return $request->response([]);
        }
    }

    /**
     * @param $id
     * @param DeleteRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Symfony\Component\HttpFoundation\Response
     */
    public function forcedelete($id, DeleteRequest $request)
    {
        try {
            $model = $this->getModel($id);
            DB::transaction(
                function () use ($model) {
                    $model->forcedelete();
                });
            Flash::info(trans($this->resource_name . 'deleted', ['model' => $this->model_name]));
            return redirect(route($this->index_route));
        } catch (PDOException $e) {
            Flash::error($e->errorInfo[2]);
            return $request->response([]);
        }
    }


}
