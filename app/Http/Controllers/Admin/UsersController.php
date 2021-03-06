<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;

use Symfony\Component\HttpFoundation\File\UploadedFile;

use App\Models\Admin\Picture;
use App\Library\Utils;
use App\Library\Imaging;
use App\Profile;
use DB;
use Exception;
use Flash;
use Excel;

use Config;
use File;

use App\Http\Requests\Admin\UserRequest as ModelRequest;
use App\Http\Requests\Admin\UserNewRequest as ModelNewRequest;
use App\Http\Requests\Admin\DeleteRequest as DeleteRequest;
use App\Http\Requests\Admin\UserSearchRequest as SearchRequest;
use App\Http\Requests\Admin\PasswordRequest as PasswordRequest;
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
    protected $edit_password_view = 'admin.users.edit_password';

    protected $index_route = 'admin.users.index';
    protected $create_route = 'admin.users.create';
    protected $show_route = 'admin.users.show';
    protected $edit_route = 'admin.users.edit';
    protected $trash_route = 'admin.users.trash';

    protected $resource_name = 'controllers/admin/users.';

    protected $sort_fields =
        [
            'id',
            'name',
            'acronym',
            'display_name',
            'is_admin',
            'is_employee',
            'is_author',
            'is_reviewer',
            'is_approver',
            'is_publisher',
            'user_id',
        ];

    protected $filter_fields =
        [
            'id',
            'name',
            'acronym',
            'display_name',
            'parent',
            'roles',
            'departments',
            'is_admin',
            'is_employee',
            'is_author',
            'is_reviewer',
            'is_approver',
            'is_publisher',
        ];

    protected $filter_numeric_fields =
        [
            'id',
        ];

    protected $filter_boolean_fields =
        [
            'is_admin',
            'is_employee',
            'is_author',
            'is_reviewer',
            'is_approver',
            'is_publisher',
        ];

    /**
     * @var array
     */
    protected $filter_has_fields =
        [
            'roles',
            'departments',
        ];


    public function __construct()
    {
        $this->middleware('admin');

        $root = User::withTrashed()->find(User::ROOT_USER);
        if (!$root) {
            $root = new User();
            $root->name = 'Root';
            $root->acronym = 'root';
            $root->display_name = 'Root User';
            $root->user_id = null;
            $root->save();
            $root->id = User::ROOT_USER;
            $root->save();
        } else {
            if ($root->trashed()) {
                $root->restore();
            };
            if ($root->user_id != null) {
                $root->user_id = null;
                $root->save();
            }
        }
        $more = User::withTrashed()->whereUserId(null)->where('id', '<>', User::ROOT_USER);
        if ($more->count() > 0) {
            $more->update(['user_id' => User::ROOT_USER]);
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
        $models = User::sortable($this->index_view);
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
                            } else if ($field == 'parent') {
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
                            } else if (in_array($field, $this->filter_has_fields)) {
                                $value = '%' . $value . '%';
                                if ($first) {
                                    $query = $query->whereHas($field, function ($q) use ($value) {
                                        $q->where('acronym', 'LIKE', $value);
                                    });
                                    $first = false;
                                } else {
                                    $query = $query->orWhereHas($field, function ($q) use ($value) {
                                        $q->where('acronym', 'LIKE', $value);
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
        $models = $this->getModels($filter)->with('roles')->with('departments')->with('parent');
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
                'is_employee' => false,
                'is_author' => false,
                'is_reviewer' => false,
                'is_approver' => false,
                'is_publisher' => false,
            ]);
        $roles = Role::lists('name', 'id');
        $model_roles = [];
        $departments = Department::lists('name', 'id');
        $model_departments = [];
        $users = User::ListUsers();

        return view($this->create_view,
            compact([
                'model',
                'roles',
                'model_roles',
                'departments',
                'model_departments',
                'users',
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
            $roles = Role::lists('name', 'id');
            $model_roles = $model->roles->lists('id');
            $departments = Department::lists('name', 'id');
            $model_departments = $model->departments->lists('id');
            $users = User::where('id','<>',$id)->withTrashed()->lists('display_name','id');
            return view($this->show_view,
                compact([
                    'model',
                    'roles',
                    'model_roles',
                    'departments',
                    'model_departments',
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
            $roles = Role::lists('name', 'id');
            $model_roles = $model->roles->lists('id');
            $departments = Department::lists('name', 'id');
            $model_departments = $model->departments->lists('id');
            $users = User::where('id','<>',$id)->withTrashed()->lists('display_name','id');

            return view($this->edit_view,
                compact([
                    'model',
                    'roles',
                    'model_roles',
                    'departments',
                    'model_departments',
                    'users'
                ]));
        } catch (Exception $e) {
            Flash::warning(trans($this->resource_name . 'not_found', ['model' => $this->model_name, 'id' => $id]));
            return $this->index();
        }
    }


    protected function dummy_picture()
    {
        $objImg = @imagecreatetruecolor(100,100);
        imagefill($objImg,0,0,0xCCCCCC);
        imagestring($objImg,5,18,45,'NO IMAGE',0);
        ob_start();
        imagejpeg($objImg,null,100);
        $file_content = ob_get_contents();
        ob_end_clean();
        imagedestroy($objImg);
        return $file_content;
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function picture($id)
    {
        try {
            $user = User::findOrFail($id);
            if ($user) {
                $picture = $user->picture;
                if ($picture) {
                    $filename = base_path() . $picture->filename;
                    if (File::exists($filename)) {
                        $file_content = File::get($filename);
                    }
                    else{
                        $file_content = $this->dummy_picture();
                    }
                    return (new Response($file_content, Response::HTTP_OK))->header('Content-Type', $picture->mime_type);
                }
                else{
                    return (new Response($this->dummy_picture(), Response::HTTP_OK))
                                    ->header('Content-Type', 'image/jpeg');
                }
            }
            return (new Response('', Response::HTTP_NOT_FOUND));
        } catch (Exception $e) {
            return (new Response($e->getMessage(), Response::HTTP_NOT_FOUND));
        }
    }


    public function save_picture($user_name, UploadedFile $file_upload)
    {

        $tmp_name = storage_path('tmp/').str_random(16).'.'.$file_upload->getClientOriginalExtension();
        Utils::file_force_contents($tmp_name, File::get($file_upload));
        $pictures_dir = Config::get('dirs.pìctures','/uploads/pictures');
        $target_name = $pictures_dir .'/'. $user_name . '.jpeg';
        if (!File::isDirectory(base_path().$pictures_dir)) {
            mkdir(base_path() . $pictures_dir, 0770, true);
        }
        $n = 1;
        while (File::exists(base_path().$target_name)) {
            $target_name = $pictures_dir .'/'.  $user_name . '(' . $n . ').jpeg';
            $n++;
        }
        Imaging::img_resize($tmp_name,base_path().$target_name,200,300);
        File::delete($tmp_name);
        return $target_name;

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
            $user_id = $request->input('user_id', null);
            $model = new User($request->all());
            try {
                DB::beginTransaction();
                $model->user_id = $user_id;
                $model->save();
                $model->roles()->sync($roles);
                $model->departments()->sync($departments);
                if ($request->hasFile('photo')) {
                    $uploaded_file= $request->file('photo');
                    if ($uploaded_file->isValid()) {
                        $picture = new Picture();
                        $picture->filename = $this->save_picture($model->name,$uploaded_file);
                        $picture->mime_type = $uploaded_file->getMimeType();
                        $picture->extension = $uploaded_file->guessExtension();
                        if (!$picture->extension){
                            $picture->extension = $uploaded_file->getExtension();
                        }
                        $picture->user_id = $model->id;
                        $picture->save();
                    }
                }
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
            $roles = $request->input('roles', []);
            $departments = $request->input('departments', []);
            $user_id = $request->input('user_id', null);
            $clear_picture= $request->input('clear_picture', false);
            $model = $this->getModel($id);
            try {
                DB::beginTransaction();
                $model->user_id = $user_id;
                $model->update($request->all());
                $model->roles()->sync($roles);
                $model->departments()->sync($departments);
                if ($clear_picture) {
                    $picture = $model->picture;
                    if ($picture) {
                        try {
                            File::delete(base_path() . $picture->filename);
                            $picture->forcedelete();
                        } catch (Exception $e) {

                        }
                    };
                }
                else if ($request->hasFile('photo')) {
                    $uploaded_file= $request->file('photo');
                    if ($uploaded_file->isValid()) {
                        $picture = $model->picture;
                        if (!$picture) {
                            $picture = new Picture();
                        }
                        else
                        {
                            try {
                                File::delete(base_path() . $picture->filename);
                            }
                            catch(Exception $e)
                            {

                            }
                        }
                        $picture->filename = $this->save_picture($model->name,$uploaded_file);
                        $picture->mime_type = $uploaded_file->getMimeType();
                        $picture->extension = $uploaded_file->guessExtension();
                        if (!$picture->extension){
                            $picture->extension = $uploaded_file->getExtension();
                        }
                        $picture->user_id = $model->id;
                        $picture->save();
                    }
                }
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
                    if ($model->picture)
                    {
                        try {
                            File::delete(base_path() . $model->picture->filename);
                        }
                        catch(Exception $e)
                        {

                        }
                        $model->picture->forcedelete();
                    }
                    $model->departments()->sync([]);
                    $model->roles()->sync([]);
                    $model->forcedelete();
                });
            Flash::info(trans($this->resource_name . 'deleted', ['model' => $this->model_name]));
            return redirect(route($this->index_route, []));
        } catch (Exception $e) {
            Flash::error($e->getMessage());
            return $request->response([]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function edit_password($id)
    {
        try {
            $model = $this->getModel($id);
            return view($this->edit_password_view, compact('model'));
        } catch (Exception $e) {
            Flash::warning(trans($this->resource_name . 'not_found', ['model' => $this->model_name, 'id' => $id]));
            return $this->index();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     * @return Response
     */
    public function update_password($id, PasswordRequest $request)
    {
        try {
            $model = $this->getModel($id);
            try {
                $model->password = bcrypt($request->input('password'));
                $model->save();
                Flash::info(trans($this->resource_name . 'password_updated'));
                return redirect(route($this->show_route, [$model->id]));
            } catch (Exception $e) {
                throw $e;
            }
        } catch (Exception $e) {
            $errors = [];
            $errors [] = $e->getMessage();
            return $request->response($errors);
        }
    }

}
