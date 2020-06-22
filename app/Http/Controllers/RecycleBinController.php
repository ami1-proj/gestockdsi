<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\RecycleBin;

class RecycleBinController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $recherche_cols = ['id', 'denomination', 'type objet','date suppression'];
        $recherche_cols_val = ['id' => 'object_id', 'denomination' => 'object_denomination', 'type objet' => 'object_model_name','date suppression' => 'created_at'];

        $sortBy = 'id';
        $orderBy = 'asc';
        $perPage = 5;
        $q = null;
        if ($request->has('orderBy')) $orderBy = $request->query('orderBy');
        if ($request->has('sortBy')) $sortBy = $recherche_cols_val[$request->query('sortBy')];
        if ($request->has('perPage')) $perPage = $request->query('perPage');
        if ($request->has('q')) $q = $request->query('q');

        $trashes = RecycleBin::search($q)->orderBy($sortBy, $orderBy)->paginate($perPage);

        //dd($typearticles);

        return view('recyclebin.index', compact('trashes', 'recherche_cols', 'orderBy', 'sortBy', 'q', 'perPage'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        dd('create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        dd('store', $request);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $trashe = RecycleBin::find($id);

        if ($trashe->	is_soft_deleted) {
          $model_obj = $trashe->object_class_name::onlyTrashed()->with('statut')->where('id', $trashe->object_id)->first();

          $view_show = $trashe->object_class_name::$view_folder . '.' . 'show';

          $view_arr = [$trashe->object_class_name::$var_name_single => $model_obj];

          return view($view_show, $view_arr);
        } else {
          return view('recyclebin.show', ['trashe' => $trashe]);
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        dd('edit', $id);
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
        dd('update', $request, $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $recycle = RecycleBin::find($id);
        $recycle->deleteModel();
        session()->flash('msg_success',__('messages.modelForceDeleted', [] ));

        return redirect()->action('RecycleBinController@index');
    }

    public function restore(Request $request, $recyclebin)
    {
        $recycle = RecycleBin::find($recyclebin);
        $recycle->restoreModel();
        $request->session()->flash('msg_success',__('messages.modelRestored', [] ));

        return redirect()->action('RecycleBinController@index');
    }

    public function restoreOrDelete(Request $request)
    {
        if ($request->has('selection')) {
          foreach ($request['selection'] as $recycle_bin_id) {
            $recycle = RecycleBin::find($recycle_bin_id);
            if ($request['action'] == 'restore') {
              $recycle->restoreModel();
            } else {
              $recycle->deleteModel();
            }
          }

          if ($request['action'] == 'restore') {
            $request->session()->flash('msg_success',__('messages.modelRestored', [] ));
          } else {
            $request->session()->flash('msg_success',__('messages.modelForceDeleted', [] ));
          }
        } else {
          $request->session()->flash('msg_danger',__('Veuillez sélectionner au moins une ligne', [] ));
        }

        return redirect()->action('RecycleBinController@index');
    }
}
