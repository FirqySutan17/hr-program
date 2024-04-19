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
        $this->checkAuth();
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
        
        if (!empty($soal)) {
            foreach ($soal as $eval) {
                $data["evaluasi_data"]["HEADER"][] = $eval->soal;
            }
        }

        if (!empty($evaluasi_user)) {
            foreach ($evaluasi_user as $eval_user) {
                $json_jawaban = json_decode($eval_user->json_jawaban);
                foreach ($json_jawaban as $jawaban) {
                    $data["evaluasi_data"][$eval_user->employee_id][] = $jawaban->jawaban_id;
                }
            }
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
            ->orderBy('pre.start_date', 'DESC');
        if (auth()->user()->plant != '0112') {
            $query->where('a.plant', auth()->user()->plant);
        }
        $result = $query->get();
        return $result;
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

    public function checkAuth()
    {
        $employee_ids = [
            '01220014', '01220023', '01210018', '01080019', '01970045', '01110024', '01210027', '01050008', // JAKARTA
            '01180055', '02070146', // SERANG
            '02070146', '02110238', // JOMBANG
            '04220017', '04170001', // LAMPUNG
            '05220394', '05220022', // SEMARANG
            '06220001', '06220003', // KALIMANTAN
            '03141112', '03130434', // MEDAN
            '07160006', '07140027', // SUJA
        ];

        if (!in_array(auth()->user()->employee_id, $employee_ids)) {
            Alert::warning('Warning!', 'Anda tidak memiliki akses ke halaman ini!');
            return redirect()->route('home');
        }
    }
}
