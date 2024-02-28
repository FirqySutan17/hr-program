<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Http\Request;
use DB;
use Maatwebsite\Excel\Facades\Excel;

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

    public function export(Request $request)
    {
        $ujian_id = $request->ujian;
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
        
        $soal   = DB::table('tb_soal')->select('tb_soal.*', 'tb_bagian.nama as nama_bagian')->join('tb_bagian', 'tb_bagian.id', 'tb_soal.bagian_id')->join('tb_ujian_bagian', 'tb_ujian_bagian.bagian_id', 'tb_bagian.id')->where('tb_ujian_bagian.ujian_id', $ujian->id)->orderBy('tb_bagian.id', 'ASC')->orderBy('tb_soal.id', 'ASC')->get();
        $jawaban   = DB::table('tb_jawaban')->orderBy('soal_id', 'ASC')->get();
        dd($soal, $jawaban);
        $soal_data = [];
        foreach ($soal as $s) {
            if (!array_key_exists($s->bagian_id, $soal_data)) {
                $soal_data[$s->bagian_id] = [
                    "nama"  => $s->nama_bagian,
                    "data"  => []
                ];
            }
            $jawaban_soal = $jawaban->where('soal_id', $s->id);
            $soal_data[$s->bagian_id]["data"][] = [
                "soal"      => $s,
                "jawaban"   => $jawaban_soal
            ];
        }
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
