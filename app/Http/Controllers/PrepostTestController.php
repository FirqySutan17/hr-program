<?php

namespace App\Http\Controllers;

use App\Models\PrePostTest;
use Illuminate\Http\Request;

class PrepostTestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('prepost-test.index');
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
     * @param  \App\Models\PrePostTest  $prePostTest
     * @return \Illuminate\Http\Response
     */
    public function show(PrePostTest $prePostTest)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PrePostTest  $prePostTest
     * @return \Illuminate\Http\Response
     */
    public function edit(PrePostTest $prePostTest)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PrePostTest  $prePostTest
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PrePostTest $prePostTest)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PrePostTest  $prePostTest
     * @return \Illuminate\Http\Response
     */
    public function destroy(PrePostTest $prePostTest)
    {
        //
    }
}
