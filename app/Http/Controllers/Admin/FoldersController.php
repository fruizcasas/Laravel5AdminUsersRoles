<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Profile;

use Auth;
use DB;
use Exception;
use Flash;
use Excel;
use PDOException;
use Purifier;

use App\Http\Requests\Admin\FolderRequest as ModelRequest;
use App\Http\Requests\Admin\FolderNewRequest as ModelNewRequest;
use App\Http\Requests\Admin\DeleteRequest as DeleteRequest;
use App\Http\Requests\Admin\FolderSearchRequest as SearchRequest;
use App\Http\Requests\Admin\FolderAddRequest as ModelAddRequest;
use App\Models\Admin\User;
use App\Models\Admin\Folder;


/**
 * Class FoldersController
 * @package App\Http\Controllers\Admin
 */
class FoldersController extends Controller
{

    /**
     * @var string
     */
    protected $model_name = 'Folder';
    /**
     * @var string
     */
    protected $index_view = 'admin.folders.index';
    /**
     * @var string
     */
    protected $create_view = 'admin.folders.create';
    /**
     * @var string
     */
    protected $show_view = 'admin.folders.show';
    /**
     * @var string
     */
    protected $edit_view = 'admin.folders.edit';

    /**
     * @var string
     */
    protected $index_route = 'admin.folders.index';
    /**
     * @var string
     */
    protected $create_route = 'admin.folders.create';
    /**
     * @var string
     */
    protected $show_route = 'admin.folders.show';
    /**
     * @var string
     */
    protected $edit_route = 'admin.folders.edit';
    /**
     * @var string
     */
    protected $trash_route = 'admin.folders.trash';

    /**
     * @var string
     */
    protected $resource_name = 'controllers/admin/folders.';

    /**
     * @var array
     */
    protected $sort_fields =
        [
            'id',
            'name',
            'order',
            'user_id',
            'folder_id',
            'root_id',
        ];

    /**
     * @var array
     */
    protected $filter_fields =
        [
            'id',
            'name',
            'order',
            'owner',
            'root',
            'private',
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
            'private',
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
        $root = Folder::withTrashed()->find(Folder::ROOT_FOLDER);
        if (!$root) {
            $root = new Folder();
            $root->name = '/';
            $root->folder_id = null;
            $root->root_id = null;
            $root->user_id = User::ROOT_USER;
            $root->private = false;
            $root->save();
            $root->id = Folder::ROOT_FOLDER;
            $root->save();
        } else {
            if ($root->trashed()) {
                $root->restore();
            };
            if (($root->folder_id != null) || ($root->user_id!= User::ROOT_USER)) {
                $root->folder_id = null;
                $root->user_id= User::ROOT_USER;
                $root->save();
            }
        }
        Folder::withTrashed()->whereFolderId(null)
            ->where('id', '<>', Folder::ROOT_FOLDER)
            ->update(['folder_id' => Folder::ROOT_FOLDER]);

        $root = Folder::withTrashed()->whereFolderId(Folder::ROOT_FOLDER)->whereUserId(Auth::user()->id)->first();
        if (! $root)
        {
            $root = new Folder();
            $root->name = Auth::user()->display_name;
            $root->folder_id = Folder::ROOT_FOLDER;
            $root->root_id = Folder::ROOT_FOLDER;
            $root->user_id = Auth::user()->id;
            $root->private= true;
            $root->description = Auth::user()->display_name . '\'s Private folder';
            $root->save();
        }
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
     * @return Folder|\Illuminate\Database\Eloquent\Builder|static
     */
    public function getModels($filter = null)
    {
        $models = Folder::sortable($this->index_view);
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
                        } else if ($field == 'owner') {
                            $value = '%' . $value . '%';
                            if ($first) {
                                $models = $models->whereHas('owner', function ($q) use ($value) {
                                    $q->where('name', 'like', $value);
                                });
                                $first = false;
                            } else {
                                $models = $models->orWhereHas('owner', function ($q) use ($value) {
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
        $folders = Folder::ListItems();
        $model = new Folder(['root_id' => Folder::ROOT_FOLDER]);
        $users = User::withTrashed()->lists('display_name','id');
        $roots = Folder::whereFolderId(Folder::ROOT_FOLDER)->orWhere('id',Folder::ROOT_FOLDER)->withTrashed()->lists('name','id');
        return view($this->create_view,
            compact([
                'model',
                'folders',
                'users',
                'roots',
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
            $folders = Folder::ListItems();
            $model = $this->getModel($id);
            $users = User::withTrashed()->lists('display_name','id');
            $roots = Folder::whereFolderId(Folder::ROOT_FOLDER)->orWhere('id',Folder::ROOT_FOLDER)->withTrashed()->lists('name','id');
            return view($this->show_view, compact([
                'model',
                'folders',
                'users',
                'roots',
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
        if ($id == Folder::ROOT_FOLDER) {
            $folders = Folder::ListItems();
            $model = $this->getModel($id);
            $users = User::withTrashed()->lists('display_name','id');
            $roots = Folder::whereFolderId(Folder::ROOT_FOLDER)->orWhere('id',Folder::ROOT_FOLDER)->withTrashed()->lists('name','id');
            Flash::warning(trans($this->resource_name . 'forbidden'));
            return view($this->show_view, compact([
                'model',
                'folders',
                'users',
                'roots',
            ]));
        }
        try {
            $model = $this->getModel($id);
            $excluded = $model->children()->lists('id');
            $excluded[] = $model->id;
            $folders = Folder::ListItems($excluded);
            $users = User::withTrashed()->lists('display_name','id');
            $roots = Folder::whereFolderId(Folder::ROOT_FOLDER)->orWhere('id',Folder::ROOT_FOLDER)->withTrashed()->lists('name','id');
            return view($this->edit_view, compact([
                'model',
                'folders',
                'users',
                'roots',
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
            $model = new Folder($request->all());
            try {
                DB::beginTransaction();
                $folder_id = $request->input('folder_id', null);
                $model->folder_id = $folder_id;
                $model->user_id = $request->input('user_id', Auth::user()->id);
                $model->description =  Purifier::clean($request->input('description'));
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
                $folder_id = $request->input('folder_id', null);
                $model->folder_id = $folder_id;
                $model->user_id = $request->input('user_id', Auth::user()->id);
                $model->description =  Purifier::clean($request->input('description'));
                $model->update($request->input());
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
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function addsubfolders($id,ModelAddRequest $request)
    {
        try {
            $model = new Folder();
            try {
                DB::beginTransaction();
                $model->order = $request->input('addorder', null);
                $model->name = $request->input('addname', null);
                $model->folder_id = $id;
                $model->user_id = Auth::user()->id;
                $model->save();
                DB::commit();
                Flash::info(trans($this->resource_name . 'saved', ['model' => $this->model_name]));
                return redirect(route($this->show_route, [$id,'tab'=>'tab_data']));
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
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function delsubfolders($root_id,DeleteRequest $request)
    {
        try {
            $ids= $request->input('remove_children');
            try {
                DB::beginTransaction();
                foreach ($ids as $id)
                {
                    $model = Folder::withTrashed()->find($id);
                    if ($model)
                    {
                        if ($model->trashed()) {
                            $model->restore();
                        }else {
                            $model->delete();
                        }
                    }
                }
                DB::commit();
                Flash::info(trans($this->resource_name . 'trashed/untrashed', ['model' => $this->model_name]));
                return redirect(route($this->show_route, [$root_id,'tab'=>'tab_data']));
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
        if ($id == Folder::ROOT_FOLDER) {
            $folders = Folder::ListItems();
            $model = $this->getModel($id);
            Flash::warning(trans($this->resource_name . 'forbidden'));
            return view($this->show_view, compact([
                'model',
                'folders',
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
