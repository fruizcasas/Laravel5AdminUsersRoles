<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;

use App\Library\Utils as Utils;
use App\Profile;
use DB;
use Exception;
use Flash;
use Excel;

use Config;
use File;
use Auth;


use App\Http\Requests\Admin\DocumentRequest as ModelRequest;
use App\Http\Requests\Admin\DocumentNewRequest as ModelNewRequest;
use App\Http\Requests\Admin\DeleteRequest as DeleteRequest;
use App\Http\Requests\Admin\DocumentSearchRequest as SearchRequest;
use App\Models\Admin\Document;
use App\Models\Admin\User;

use Symfony\Component\HttpFoundation\File\UploadedFile;



class DocumentsController extends Controller
{

    protected $model_name = 'Document';
    protected $index_view = 'admin.documents.index';
    protected $create_view = 'admin.documents.create';
    protected $show_view = 'admin.documents.show';
    protected $edit_view = 'admin.documents.edit';

    protected $index_route = 'admin.documents.index';
    protected $create_route = 'admin.documents.create';
    protected $show_route = 'admin.documents.show';
    protected $edit_route = 'admin.documents.edit';
    protected $trash_route = 'admin.documents.trash';

    protected $resource_name = 'controllers/admin/documents.';

    protected $sort_fields =
        [
            'id',
            'user_id',
            'name',
            'mime_type',
            'extension',
            'title',
            'description',
            'original_name',
            'original_mime_type',
            'original_extension',
            'size',
            'sha1',
        ];

    protected $filter_fields =
        [
            'id',
            'user_id',
            'name',
            'mime_type',
            'extension',
            'title',
            'description',
            'original_name',
            'original_mime_type',
            'original_extension',
            'size',
            'sha1',
        ];

    protected $filter_numeric_fields =
        [
            'id',
            'size',
        ];

    protected $filter_boolean_fields =
        [
        ];

    /**
     * @var array
     */
    protected $filter_has_fields =
        [
            'owner',
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
        $model = new Document();
        $models = Document::sortable($this->index_view);
        if ($this->show_trash()) {
            $models = $models->withTrashed();
        }
        if (isset($filter)) {
            foreach ($this->filter_fields as $field) {
                if (trim($filter[$field]) != '') {
                    $models = $models->Where(function ($query) use ($field, $filter, $model) {
                        $values = explode(',', $filter[$field]);
                        $first = true;
                        foreach ($values as $value) {
                            if (strtolower($value) == 'null') {
                                if ($first) {
                                    $query = $query->Where($field, 'IS NULL');
                                    $first = false;
                                } else {
                                    $query = $query->orWhere($field, 'IS NULL');
                                }
                            } else if (strtolower($value) == 'not null') {
                                if ($first) {
                                    $query = $query->Where($field, 'IS NOT NULL');
                                    $first = false;
                                } else {
                                    $query = $query->orWhere($field, 'IS NOT NULL');
                                }

                            } else if (in_array($field, $this->filter_numeric_fields)) {
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
                                    $query->whereHas($field, function ($q) use ($value) {
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

    public
    function getModel($id)
    {
        return $this->getModels()->findOrFail($id);
    }

    public
    function getFilter()
    {
        $values = [];
        foreach ($this->filter_fields as $field) {
            $values[$field] = Profile::loginProfile()->getFilterValue($this->index_view, $field);
        }
        return $values;
    }


    public
    function excel($format = 'xlsx')
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
    public
    function index()
    {
        $filter = $this->getFilter();
        $models = $this->getModels($filter)->with('owner');
        $models = $models->paginate(Profile::loginProfile()->per_page);
        return view($this->index_view, compact('models', 'filter'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public
    function create()
    {
        $model = new Document(['user_id' => Auth::user()->id]);
        $users = [null => 'Empty'] +
            User::withTrashed()->lists('display_name', 'id');
        return view($this->create_view,
            compact([
                'model', 'users',
            ]));
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public
    function show($id)
    {
        try {
            $model = $this->getModel($id);
            $users = [null => 'Empty'] +
                User::withTrashed()->lists('display_name', 'id');
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
    public
    function edit($id)
    {
        try {
            $model = $this->getModel($id);
            $users = [null => 'Empty'] +
                User::withTrashed()->lists('display_name', 'id');

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
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function download($id)
    {
        try {
            $model = Document::findOrFail($id);
            $filename = base_path() . $model->name;
            $name = pathinfo($model->original_name, PATHINFO_FILENAME) . '.' . $model->extension;
            return response()->download($filename, $name, ['Content-Type' => $model->mime_type]);
        } catch (Exception $e) {
            return (new Response($e->getMessage(), Response::HTTP_NOT_FOUND));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function get($id)
    {
        try {
            $model = Document::findOrFail($id);
            $filename = base_path() . $model->name;
            $file_content = File::get($filename);
            return (new Response($file_content, Response::HTTP_OK))->header('Content-Type', $model->mime_type);
        } catch (Exception $e) {
            return (new Response($e->getMessage(), Response::HTTP_NOT_FOUND));
        }
    }


    public function save_upload(UploadedFile $file_upload, $extension)
    {
        $uploads_dir = Config::get('dirs.uploads');
        $filename = pathinfo($file_upload->getClientOriginalName(), PATHINFO_FILENAME);
        $target_name = $uploads_dir . strftime('/%Y/%m%d/') . $filename . '.' . $extension;
        $n = 1;
        while (File::exists(base_path($target_name))) {
            $target_name = $uploads_dir . strftime('/%Y/%m%d/') . $filename . '(' . $n . ').' . $extension;
            $n++;
        }
        Utils::file_force_contents(base_path($target_name), File::get($file_upload));
        //Utils::gzCompressFile(base_path($target_name));
        return $target_name;

    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public
    function store(ModelNewRequest $request)
    {
        try {
            $model = new Document($request->all());
            if ($request->hasFile('file_upload')) {
                $file = $request->file('file_upload');
                if ($file->isValid()) {
                    $new_ext = $file->guessExtension();
                    $new_mime_type = $file->getMimeType();
                    if ($new_ext =='bin')
                    {
                        $new_ext = $file->getClientOriginalExtension();
                        $new_mime_type = $file->getClientMimeType();
                    }
                    $model->original_name = $file->getClientOriginalName();
                    $model->original_mime_type = $file->getClientMimeType();
                    $model->original_extension = $file->getClientOriginalExtension();
                    $model->name = $this->save_upload($file,$new_ext);
                    $model->mime_type = $new_mime_type;
                    $model->extension = $new_ext;
                    $model->size = $file->getSize();
                    $model->sha1 = sha1_file(base_path($model->name));
                    if (! $model->title)
                    {
                        $model->title = $model->original_name;
                    }
                }
            }

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
            Flash::error(get_class($e) . '-' . $e->getMessage());
            return $request->response($errors);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     * @return Response
     */
    public
    function update($id, ModelRequest $request)
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
            Flash::error(get_class($e) . '-' . $e->getMessage());
            return $request->response($errors);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return Response
     */
    public
    function destroy($id, DeleteRequest $request)
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


    public
    function restore($id, DeleteRequest $request)
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

    public
    function forcedelete($id, DeleteRequest $request)
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
