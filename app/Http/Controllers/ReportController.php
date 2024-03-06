<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Http\Request;
use DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ReportExport;

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
        $start_date = date('Y-m-d', strtotime($request->start_date));
        $end_date = date('Y-m-d', strtotime($request->end_date));
        $ujian_user = $this->report_query($start_date, $end_date);

        $evaluasi_user = DB::table('tb_ujian_user')->where('ujian_id', 3)->get();
        $soal   = DB::table('tb_soal')->select('tb_soal.*')->where('bagian_id', 4)->get();
        $header = ["DATE", "PLANT", "DEPT", "NPK", "NAMA", "TRAINER", "PRE TEST", "POST TEST"];
        $data = [
            "main_data"         => [],
            "evaluasi_data"     => []
        ];

        $data["main_data"]["HEADER"] = $header;
        foreach ($ujian_user as $uu) {
            $uu_data = [$uu->start_date, $uu->plant_name, $uu->dept_name, $uu->employee_id, $uu->name, $uu->trainer, $uu->pre_score, $uu->post_score];
            $data["main_data"][$uu->employee_id] = $uu_data;
        }

        $nama_file = 'report_excel_'.date('Y-m-d_H-i-s').'.xlsx';
        return Excel::download(new ReportExport($data), $nama_file);
    }

    public function report_query($start_date, $end_date) {
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
