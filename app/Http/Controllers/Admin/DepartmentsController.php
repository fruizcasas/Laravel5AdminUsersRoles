<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Profile;
use DB;
use Exception;
use Flash;
use Excel;

use App\Http\Requests\Admin\DepartmentRequest as ModelRequest;
use App\Http\Requests\Admin\DepartmentNewRequest as ModelNewRequest;
use App\Http\Requests\Admin\DeleteRequest as DeleteRequest;
use App\Http\Requests\Admin\DepartmentSearchRequest as SearchRequest;
use App\Models\Admin\Department;
use PDOException;


class DepartmentsController extends Controller
{

    protected $model_name = 'Department';
    protected $index_view = 'admin.departments.index';
    protected $create_view = 'admin.departments.create';
    protected $show_view = 'admin.departments.show';
    protected $edit_view = 'admin.departments.edit';

    protected $index_route = 'admin.departments.index';
    protected $create_route = 'admin.departments.create';
    protected $show_route = 'admin.departments.show';
    protected $edit_route = 'admin.departments.edit';
    protected $trash_route = 'admin.departments.trash';

    protected $resource_name = 'controllers/admin/departments.';

    protected $sort_fields =
        [
            'id',
            'name',
            'acronym',
            'display_name'
        ];

    protected $filter_fields =
        [
            'id',
            'name',
            'acronym',
            'display_name',
            'parent',
            'users',
            'description'
        ];

    protected $filter_numeric_fields =
        [
            'id',
        ];

    protected $filter_boolean_fields =
        [
        ];


    public function __construct()
    {
        $this->middleware('admin');
        $root = Department::withTrashed()->find(Department::ROOT_DEPARTMENT);
        if (!$root) {
            $root = new Department();
            $root->name = '*';
            $root->acronym = '*';
            $root->display_name = '*';
            $root->department_id = null;
            $root->save();
            $root->id = Department::ROOT_DEPARTMENT;
            $root->save();
        } else {
            if ($root->trashed()) {
                $root->restore();
            };
            if ($root->department_id != null) {
                $root->department_id = null;
                $root->save();
            }
        }
        $more = Department::withTrashed()->whereDepartmentId(null)->where('id', '<>', Department::ROOT_DEPARTMENT);
        if ($more->count() > 0) {
            $more->update(['department_id' => Department::ROOT_DEPARTMENT]);
        }
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
        return redirect(route($this->index_route));
    }

    public function filter(SearchRequest $request)
    {
        foreach ($this->filter_fields as $field) {
            Profile::loginProfile()->setFilterValue($this->index_view, $field, $request->input($field, ''));
        }
        return redirect(route($this->index_route));
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

        return redirect(route($this->index_route));
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
        $departments = Department::ListDepartments();
        $model = new Department();
        return view($this->create_view, compact([
            'model',
            'departments',
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
            $departments = Department::ListDepartments();
            $model = $this->getModel($id);
            return view($this->show_view, compact([
                'model',
                'departments',
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

        if ($id == Department::ROOT_DEPARTMENT) {
            $departments = Department::ListDepartments();
            $model = $this->getModel($id);
            Flash::warning(trans($this->resource_name . 'forbidden'));
            return view($this->show_view, compact([
                'model',
                'departments',
            ]));
        }
        try {
            $model = $this->getModel($id);
            $excluded = $model->children()->lists('id');
            $excluded[] = $model->id;
            $departments = Department::ListDepartments($excluded);
            return view($this->edit_view, compact([
                'model',
                'departments',
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
            $model = new Department($request->all());
            try {
                DB::beginTransaction();
                $department_id = $request->input('department_id', null);
                $model->department_id = $department_id;
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
            if ($e instanceof PDOException) {
                Flash::error($e->errorInfo[2]);
            } else {
                Flash::error($e->getMessage());
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
                $department_id = $request->input('department_id', null);
                $model->department_id = $department_id;
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
            if ($e instanceof PDOException) {
                Flash::error($e->errorInfo[2]);
            } else {
                Flash::error($e->getMessage());
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
        if ($id == Department::ROOT_DEPARTMENT) {
            $departments = Department::ListDepartments();
            $model = $this->getModel($id);
            Flash::warning(trans($this->resource_name . 'forbidden'));
            return view($this->show_view, compact([
                'model',
                'departments',
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


    public function restore($id, DeleteRequest $request)
    {
        try {
            $model = $this->getModel($id);
            $model->restore();
            Flash::info(trans($this->resource_name . 'restored', ['model' => $this->model_name]));
            return redirect(route($this->show_route, [$id]));
        } catch (Exception $e) {
            if ($e instanceof PDOException) {
                Flash::error($e->errorInfo[2]);
            } else {
                Flash::error($e->getMessage());
            }
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
            return redirect(route($this->index_route));
        } catch (Exception $e) {
            if ($e instanceof PDOException) {
                Flash::error($e->errorInfo[2]);
            } else {
                Flash::error($e->getMessage());
            }
            return $request->response([]);
        }
    }


    public function getModels($filter = null)
    {
        $models = Department::sortable($this->index_view);
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
                        } else if ($field == 'users') {
                            $value = '%' . $value . '%';
                            if ($first) {
                                $models = $models->whereHas('users', function ($q) use ($value) {
                                    $q->where('acronym', 'like', $value);
                                });
                                $first = false;
                            } else {
                                $models = $models->orWhereHas('users', function ($q) use ($value) {
                                    $q->where('acronym', 'like', $value);
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

}

