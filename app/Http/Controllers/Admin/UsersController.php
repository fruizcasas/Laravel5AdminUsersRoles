<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Profile;
use DB;
use Auth;
use Exception;

use App\Http\Requests\Admin\UserRequest as ModelRequest;
use App\Http\Requests\Admin\DeleteRequest as DeleteRequest;
use App\Http\Requests\Admin\UserSearchRequest as SearchRequest;
use App\Models\Admin\User;
use App\Models\Admin\Role;


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


    protected $sort_fields = ['id', 'name', 'email','is_admin'];
    protected $filter_fields = ['id', 'name', 'email','is_admin','roles'];

    protected $show_trash = 'empty';
    protected $login_profile;


    public function __construct()
    {
        $this->middleware('auth');
        $this->show_trash = 'empty';
    }


    public function show_trash()
    {
        if ($this->show_trash === 'empty')
        {
            $this->show_trash = Profile::loginProfile()->show_trash;
        }
        return $this->show_trash;
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

        return redirect(route('admin.users.index'));
    }


    /**
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $filter = $this->getFilter();
        $records = $this->getModels($filter)->with('roles');
        $records = $records->paginate(Profile::loginProfile()->per_page);
        return view($this->index_view, compact('records', 'filter'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $model = new User();
        $roles = Role::lists('name', 'id');
        $model_roles = [];
        return view($this->create_view, compact(['model', 'roles', 'model_roles']));
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
            $roles = Role::lists('name', 'id');
            $model_roles = $model->roles->lists('id');
            return view($this->show_view, compact(['model', 'roles', 'model_roles']));
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
        $roles = Role::lists('name', 'id');
        $model_roles = $model->roles->lists('id');
        return view($this->edit_view, compact(['model', 'roles', 'model_roles']));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(ModelRequest $request)
    {
        try {
            $roles = $request->input('roles', []);
            $model = new User($request->all());
            try {
                DB::beginTransaction();
                $model->save();
                $model->roles()->sync($roles);
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
            $model = $this->getModel($id);
            try {
                DB::beginTransaction();
                $model->update($request->all());
                $model->roles()->sync($roles);
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
        $records = User::sortable($this->index_view);
        if ($this->show_trash()) {
            $records = $records->withTrashed();
        }
        if (isset($filter)) {
            foreach ($this->filter_fields as $field) {
                if (trim($filter[$field]) != '') {
                    $values = explode(',', $filter[$field]);
                    $first = true;
                    foreach ($values as $value) {
                        if ($field == 'id') {
                            if ($first) {
                                $records = $records->Where($field, $value);
                                $first = false;
                            } else {
                                $records = $records->orWhere($field, $value);
                            }
                        } else if ($field == 'is_admin') {
                                $value = (mb_strtolower($value) == 'x');
                                if ($first) {
                                    $records = $records->Where($field, $value);
                                    $first = false;
                                } else {
                                    $records = $records->orWhere($field, $value);
                                }
                        } else if ($field == 'roles') {
                            $value = '%' . $value . '%';
                            if ($first) {
                                $records = $records->whereHas('roles', function ($q) use($value) {
                                    $q->where('name', 'like', $value);
                                });
                                $first = false;
                            } else {
                                $records = $records->orWhereHas('roles', function ($q) use ($value) {
                                    $q->where('name', 'like', $value);
                                });
                            }
                        } else {
                            $value = '%' . $value . '%';
                            if ($first) {
                                $records = $records->Where($field, 'LIKE', $value);
                                $first = false;
                            } else {
                                $records = $records->orWhere($field, 'LIKE', $value);
                            }
                        }
                    }
                }
            }
        }
        return $records;
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
