<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Profile;
use DB;
use Exception;

use App\Http\Requests\Admin\RoleRequest as ModelRequest;
use App\Http\Requests\Admin\DeleteRequest as DeleteRequest;
use App\Http\Requests\Admin\RoleSearchRequest as SearchRequest;
use App\Models\Admin\Role;
use App\Models\Admin\User;


class RolesController extends Controller {


    protected $model_name = 'Role';
    protected $index_view = 'admin.roles.index';
    protected $create_view = 'admin.roles.create';
    protected $show_view = 'admin.roles.show';
    protected $edit_view = 'admin.roles.edit';

    protected $index_route = 'admin.roles.index';
    protected $create_route = 'admin.roles.create';
    protected $show_route = 'admin.roles.show';
    protected $edit_route = 'admin.roles.edit';


    protected $sort_fields = ['id', 'name', 'display_name','acronym'];
    protected $filter_fields = ['id', 'name', 'display_name','acronym'];

    protected $show_trash = 'empty';


    public function __construct()
    {
        $this->middleware('admin');
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

        return redirect(route($this->index_route));
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
        $model = new Role();
        return view($this->create_view, compact(['model']));
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
            return view($this->show_view, compact('model'));
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
        return view($this->edit_view, compact(['model']));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(ModelRequest $request)
    {
        try {
            $model = new Role($request->all());
            try {
                DB::beginTransaction();
                $model->save();
                DB::commit();
                flash()->info("$this->model_name saved");
                return redirect(route($this->show_route, [$model->id]));
            } catch (Exception $e) {
                DB::rollBack();
                throw $e;
            }
        } catch (Exception $e) {
            $errors = [];
            flash()->error($e->getMessage());
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
                flash()->info("$this->model_name saved");
                return redirect(route($this->show_route, [$model->id]));
            } catch (Exception $e) {
                DB::rollBack();
                throw $e;
            }
        } catch (Exception $e) {
            $errors = [];
            flash()->error($e->getMessage());
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
        $records = Role::sortable($this->index_view);
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
