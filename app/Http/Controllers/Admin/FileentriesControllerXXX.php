<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Admin\Fileentry;
use Illuminate\Http\Request;

use Response;
use Storage;
use File;

class FileentriesController extends Controller
{

    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index($id)
    {
        $models = Fileentry::all();
        return view('admin.fileentries.index',compact('models'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function get($id)
    {
        $model = Fileentry::findOrFail($id);
        if (!$model) {
            return response(null, 302);
        } else {
            $file = Storage::disk('local')->get($model->filename);
            return (new Response($file, 200))
                ->header('Content-Type', $model->mime);
        }
    }


    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $file = $request->file('file');
        $filename = $file->getFilename();
        $extension = $file->getClientOriginalExtension();
        Storage::disk('local')->put($filename.'.'.$extension,  File::get($file));
        $entry = new Fileentry();
        $entry->original_filename = $file->getClientOriginalName();
        $entry->original_mime_type = $file->getClientMimeType();
        $entry->original_extension = $file->getClientOriginalExtension();
        $entry->filename = $file->getFilename().'.'.$extension;
        $entry->mime_type = $file->getMimeType();
        $entry->extesion = $file->guessExtension();

        $entry->save();
    }


    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */

https://github.com/mrakodol/Laravel-5-Bootstrap-3-Starter-Site/blob/master/app/Http/Controllers/Admin/PhotoController.php

http://www.codetutorial.io/laravel-5-file-upload-storage-download/

    public function update($id,Request $request)
    {
        $file = $request->file('file');
        $extension = $file->getClientOriginalExtension();
        Storage::disk('local')->put($file->getFilename().'.'.$extension,  File::get($file));
        $entry = Fileentry::find($id);
        $entry->original_mime_type = $file->getClientMimeType();
        $entry->original_filename = $file->getClientOriginalName();
        $entry->filename = $file->getFilename().'.'.$extension;

        $entry->save();
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }

}
