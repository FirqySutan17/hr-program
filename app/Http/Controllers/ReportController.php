<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Http\Request;
use DB;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $ujian_id = 1;
        if (!empty($request->all())) {
            $ujian_id = $request->ujian;
        }
        $ujian_user = DB::table('tb_ujian_user')
            ->select('tb_ujian_user.*', 'users.name', 'm_department.full_dept_name as dept_name', 'm_plant.class3 as plant_name')
            ->join('users', 'users.employee_id', 'tb_ujian_user.employee_id')
            ->join('m_department', function($join)
            {
                $join->on('users.company', '=', 'm_department.company');
                $join->on('users.plant', '=', 'm_department.plant');
                $join->on('users.department', '=', 'm_department.dept');
            })->join('m_plant', 'users.plant', '=', 'm_plant.code')
            ->where('tb_ujian_user.ujian_id', $ujian_id)->orderBy('tb_ujian_user.id', 'DESC')->get();
        $ujian_data = DB::table('tb_ujian')->orderBy('id', 'ASC')->get();
        return view('report.index', compact('ujian_data', 'ujian_user', 'ujian_id'));
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
     * @param  \App\Models\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function show(Report $report)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function edit(Report $report)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Report $report)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function destroy(Report $report)
    {
        //
    }
}
