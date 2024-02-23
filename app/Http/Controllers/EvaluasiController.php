<?php

namespace App\Http\Controllers;

use App\Models\Evaluasi;
use Illuminate\Http\Request;

class EvaluasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('evaluasi.index');
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
     * @param  \App\Models\Evaluasi  $evaluasi
     * @return \Illuminate\Http\Response
     */
    public function show(Evaluasi $evaluasi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Evaluasi  $evaluasi
     * @return \Illuminate\Http\Response
     */
    public function edit(Evaluasi $evaluasi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Evaluasi  $evaluasi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Evaluasi $evaluasi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Evaluasi  $evaluasi
     * @return \Illuminate\Http\Response
     */
    public function destroy(Evaluasi $evaluasi)
    {
        //
    }
}
