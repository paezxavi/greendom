<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Commande;
use App\File;
use Storage;

class FileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Commande $commande)
    {
        /*$files = File::all();
        foreach ($files as $file) {
            echo $file->name;
        }*/
        //dd(File::all());
        return File::all()->where('commande_id',$commande->id);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function storeFile(Request $request, Commande $commande) {
        //dd($commande);
        //dd($request->file('files'));
        $files = $request->file('files');
        if ($request->hasFile('files')) {
            foreach ($files as $file) {
                $name = md5($file->getClientOriginalName() . $commande->id . time());
                $path = config('greendom.files_directory');
                $file->storeAs($path, $name);
                $f = new File();
                $f->path = $name;
                $f->name = $file->getClientOriginalName();
                $f->commande_id = $commande->id;
                $f->save();
            }
        }
    }

    public function download(File $file) {
        //dd($file);
        //return $file;
        return response()->download(storage_path("app/files/{$file->path}"), $file->name);
    }

    public function remove(File $file) {
        $file->delete();
        Storage::delete(storage_path("app/files/{$file->path}"));
    }
}
