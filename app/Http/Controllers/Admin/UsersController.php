<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Profile;
use DB;
use Auth;
use Exception;
use Excel;

use App\Http\Requests\Admin\UserRequest as ModelRequest;
use App\Http\Requests\Admin\UserNewRequest as ModelNewRequest;
use App\Http\Requests\Admin\DeleteRequest as DeleteRequest;
use App\Http\Requests\Admin\UserSearchRequest as SearchRequest;
use App\Models\Admin\User;
use App\Models\Admin\Role;
use App\Models\Admin\Department;


class UsersController extends Controller
{

    protected $model_name = 'User';
    protected $index_view = 'admin.users.index';
    protected $create_view = 'admin.users.create';
    protected $show_view = 'admin.users.show';
    protected $edit_view = 'admin.users.edit';

    protected $index_route = 'admin.users.index';
    protected $create_route = 'admin.users.create';
    protected $show_route = 'admin.users.show';
    protected $edit_route = 'admin.users.edit';
    protected $trash_route = 'admin.users.trash';

    protected $sort_fields =
        [
            'id',
            'name',
            'acronym',
            'display_name',
            'email',
            'is_admin',
            'is_author',
            'is_reviewer',
            'is_approver',
            'is_publisher',
        ];
    protected $filter_fields =
        [
            'id',
            'name',
            'acronym',
            'display_name',
            'email',
            'is_admin',
            'is_author',
            'is_reviewer',
            'is_approver',
            'is_publisher',
            'roles',
            'departments',
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
        Excel::create('Users', function ($excel) use ($models) {

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
        $models = $this->getModels($filter)->with('roles')->with('departments');
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
        $model = new User(
            [
                'is_admin' => false,
                'is_author' => false,
                'is_reviewer' => false,
                'is_approver' => false,
                'is_publisher' => false,
            ]);
        $roles = Role::lists('acronym', 'id');
        $model_roles = [];
        $departments = Department::lists('name', 'id');
        $model_departments = [];
        return view($this->create_view,
            compact([
                'model',
                'roles',
                'model_roles',
                'departments',
                'model_departments',
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
            $roles = Role::lists('acronym', 'id');
            $model_roles = $model->roles->lists('id');
            $departments = Department::lists('name', 'id');
            $model_departments = $model->departments->lists('id');
            return view($this->show_view,
                compact([
                    'model',
                    'roles',
                    'model_roles',
                    'departments',
                    'model_departments',
                ]));
        } catch (Exception $e) {
            flash()->warning("$this->model_name $id not found");
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
        $model = $this->getModel($id);
        $roles = Role::lists('acronym', 'id');
        $model_roles = $model->roles->lists('id');
        $departments = Department::lists('name', 'id');
        $model_departments = $model->departments->lists('id');
        return view($this->edit_view,
            compact([
                'model',
                'roles',
                'model_roles',
                'departments',
                'model_departments',
            ]));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(ModelNewRequest $request)
    {
        try {
            $roles = $request->input('roles', []);
            $departments = $request->input('departments', []);
            $model = new User($request->all());
            try {
                DB::beginTransaction();
                $model->save();
                $model->roles()->sync($roles);
                $model->departments()->sync($departments);
                DB::commit();
                flash()->info("$this->model_name saved");
                return redirect(route($this->show_route, [$model->id]));
            } catch (Exception $e) {
                DB::rollBack();
                throw $e;
            }
        } catch (Exception $e) {
            $errors = [];
            if ($e->getCode() == 23000) {
                $errors['email'] = "Duplicate email";
            } else {
                flash()->error($e->getMessage());
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
            $roles = $request->input('roles', []);
            $departments = $request->input('departments', []);
            $model = $this->getModel($id);
            try {
                DB::beginTransaction();
                $model->update($request->all());
                $model->roles()->sync($roles);
                $model->departments()->sync($departments);
                DB::commit();
                flash()->info("$this->model_name saved");
                return redirect(route($this->show_route, [$model->id]));
            } catch (Exception $e) {
                DB::rollBack();
                throw $e;
            }
        } catch (Exception $e) {
            $errors = [];
            if ($e->getCode() == 23000) {
                $errors['email'] = "Duplicate email";
            } else {
                flash()->error($e->getMessage());
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
            flash()->info("$this->model_name sent to trash");
            if ($this->show_trash()) {
                return redirect(route($this->show_route, [$id]));
            } else {
                return redirect(route($this->index_route));
            }
        } catch (Exception $e) {
            flash()->error($e->getMessage());
            return $request->response([]);
        }
    }


    public function restore($id, DeleteRequest $request)
    {
        try {
            $model = $this->getModel($id);
            $model->restore();
            flash()->info("$this->model_name restored");
            return redirect(route($this->show_route, [$id]));
        } catch (Exception $e) {
            flash()->error($e->getMessage());
            return $request->response([]);
        }
    }

    public function forcedelete($id, DeleteRequest $request)
    {
        try {
            $model = $this->getModel($id);
            DB::transaction(
                function () use ($model) {
                    $model->departments()->sync([]);
                    $model->roles()->sync([]);
                    $model->forcedelete();
                });
            flash()->info("$this->model_name removed");
            return redirect(route($this->index_route));
        } catch (Exception $e) {
            flash()->error($e->getMessage());
            return $request->response([]);
        }
    }


    public function getModels($filter = null)
    {
        $models = User::sortable($this->index_view);
        if ($this->show_trash()) {
            $models = $models->withTrashed();
        }
        if (isset($filter)) {
            foreach ($this->filter_fields as $field) {
                if (trim($filter[$field]) != '') {
                    $values = explode(',', $filter[$field]);
                    $first = true;
                    foreach ($values as $value) {
                        if ($field == 'id') {
                            if ($first) {
                                $models = $models->Where($field, $value);
                                $first = false;
                            } else {
                                $models = $models->orWhere($field, $value);
                            }
                        } else if (in_array($field,
                            ['is_admin', 'is_author', 'is_reviewer', 'is_approver', 'is_publisher'])) {
                            $value = (mb_strtolower($value) == 'x');
                            if ($first) {
                                $models = $models->Where($field, $value);
                                $first = false;
                            } else {
                                $models = $models->orWhere($field, $value);
                            }
                        } else if ($field == 'roles') {
                            $value = '%' . $value . '%';
                            if ($first) {
                                $models = $models->whereHas('roles', function ($q) use ($value) {
                                    $q->where('acronym', 'like', $value);
                                });
                                $first = false;
                            } else {
                                $models = $models->orWhereHas('roles', function ($q) use ($value) {
                                    $q->where('acronym', 'like', $value);
                                });
                            }
                        } else if ($field == 'departments') {
                            $value = '%' . $value . '%';
                            if ($first) {
                                $models = $models->whereHas('departments', function ($q) use ($value) {
                                    $q->where('name', 'like', $value);
                                });
                                $first = false;
                            } else {
                                $models = $models->orWhereHas('departments', function ($q) use ($value) {
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
