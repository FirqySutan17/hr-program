<?php

namespace App\Http\Controllers;

use App\Models\PostTest;
use Illuminate\Http\Request;

class PostTestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('post-test.index');
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
     * @param  \App\Models\PostTest  $postTest
     * @return \Illuminate\Http\Response
     */
    public function show(PostTest $postTest)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PostTest  $postTest
     * @return \Illuminate\Http\Response
     */
    public function edit(PostTest $postTest)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PostTest  $postTest
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PostTest $postTest)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PostTest  $postTest
     * @return \Illuminate\Http\Response
     */
    public function destroy(PostTest $postTest)
    {
        //
    }
}
