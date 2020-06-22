<?php

namespace App\Http\Controllers;

use App\StockEmplacement;

use Illuminate\Http\Request;
use App\Http\Requests\StockEmplacementRequest;
use App\Http\Requests\StockEmplacementCreateRequest;
use App\Http\Requests\StockEmplacementEditRequest;


class StockEmplacementController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:stock_emplacement-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\StockEmplacement  $stockEmplacement
     * @return \Illuminate\Http\Response
     */
    public function show(StockEmplacement $stockEmplacement)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\StockEmplacement  $stockEmplacement
     * @return \Illuminate\Http\Response
     */
    public function edit(StockEmplacement $stockEmplacement)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\StockEmplacement  $stockEmplacement
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, StockEmplacement $stockEmplacement)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\StockEmplacement  $stockEmplacement
     * @return \Illuminate\Http\Response
     */
    public function destroy(StockEmplacement $stockEmplacement)
    {
        //
    }
}
