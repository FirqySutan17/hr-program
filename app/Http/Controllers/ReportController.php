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
        $start_date = date('Y-m-d');
        $end_date   = date('Y-m-d');
        if (!empty($request->all())) {
            $start_date = date('Y-m-d', strtotime($request->start_date));
            $end_date = date('Y-m-d', strtotime($request->end_date));
        }
        $filter = [
            'start_date'    => $start_date,
            'end_date'      => $end_date
        ];
        $ujian_user = $this->report_query($start_date, $end_date);
        return view('report.index', compact('ujian_user', 'filter'));
    }

    public function export(Request $request)
    {
        $ujian_id = $request->ujian;
        $ujian_user = DB::table('tb_ujian_user')
            ->select('tb_ujian_user.*', 'users.name', 'm_department.full_dept_name as dept_name', 'm_plant.class3 as plant_name')
            ->join('users', 'users.employee_id', 'tb_ujian_user.employee_id')
            ->join('m_department', function($join)
            {
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

    private function report_query($start_date, $end_date) {
        $start_date = $start_date." 00:00:00";
        $end_date   = $end_date." 23:59:59";
        $query = DB::table('users as a')
            ->select(
                'a.employee_id', 'a.name', 'b.class3 as plant_name', 'c.full_dept_name as dept_name', 
                'pre.trainer', 'pre.start_date', 'pre.score as pre_score', DB::raw('IFNULL(post.score, 0) as post_score')
            )
            ->join('m_plant as b', 'a.plant', 'b.code')
            ->join('m_department as c', function($join) {
                $join->on('a.plant', 'c.plant');
                $join->on('a.department', 'c.dept');
            })
            ->join('tb_ujian_user as pre', function($join) {
                $join->on('a.employee_id', 'pre.employee_id');
                $join->on('pre.ujian_id', DB::raw("'1'"));
            })
            ->leftJoin('tb_ujian_user as post', function($join) {
                $join->on('a.employee_id', 'post.employee_id');
                $join->on('post.ujian_id', DB::raw("'2'"));
            })
            ->whereBetween('pre.start_date', [$start_date, $end_date])
            ->orderBy('pre.start_date', 'DESC')->get();
        
        return $query;
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
