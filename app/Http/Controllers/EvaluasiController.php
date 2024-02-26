<?php

namespace App\Http\Controllers;

use App\Models\Evaluasi;
use Illuminate\Http\Request;
use DB;
use File;
use Illuminate\Support\Facades\Hash;
use stdClass;

class EvaluasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($flag)
    {
        $ujian  = DB::table('tb_ujian')->select('tb_ujian.*')->join('tb_ujian_bagian', 'tb_ujian_bagian.ujian_id', 'tb_ujian.id')->join('tb_bagian', 'tb_bagian.id', 'tb_ujian_bagian.bagian_id')->where('tb_ujian.flag', $flag)->where('tb_bagian.nama', 'like', 'evaluasi%')->first();
        if (empty($ujian)) {
            return redirect()->route('home');
        }

        $ujian_user = DB::table('tb_ujian_user')->where('ujian_id', $ujian->id)->where('employee_id', auth()->user()->employee_id)->first();

        $soal   = DB::table('tb_soal')->select('tb_soal.*', 'tb_bagian.nama as nama_bagian')->join('tb_bagian', 'tb_bagian.id', 'tb_soal.bagian_id')->join('tb_ujian_bagian', 'tb_ujian_bagian.bagian_id', 'tb_bagian.id')->where('tb_ujian_bagian.ujian_id', $ujian->id)->orderBy('tb_bagian.id', 'ASC')->orderBy('tb_soal.id', 'ASC')->get();
        $jawaban   = DB::table('tb_jawaban')->orderBy('soal_id', 'ASC')->get();

        $soal_data = [];
        foreach ($soal as $s) {
            if (!array_key_exists($s->bagian_id, $soal_data)) {
                $soal_data[$s->bagian_id] = [
                    "nama"  => $s->nama_bagian,
                    "data"  => []
                ];
            }
            $jawaban_soal = $s->type == 2 ? $this->jawaban_evaluasi($s->id) : $jawaban->where('soal_id', $s->id);
            $soal_data[$s->bagian_id]["data"][] = [
                "soal"      => $s,
                "jawaban"   => $jawaban_soal
            ];
        }
        if (!empty($ujian_user)) {
            return view('evaluasi.result', compact('ujian_user', 'ujian', 'soal_data'));
        }
        $start_date = date('Y-m-d H:i:s');
        return view('evaluasi.index', compact('ujian', 'soal_data', 'start_date'));
    }

    public function jawaban_evaluasi($soal_id) {
        $jawaban_arr = ["Sangat Tidak Setuju", "Tidak Setuju", "Ragu Ragu", "Setuju", "Sangat Setuju"];
        $jawaban_result = [];
        foreach ($jawaban_arr as $key => $jawaban) {
            $jwb = new stdClass();
            $jwb->id = $key + 1;
            $jwb->soal_id = $soal_id;
            $jwb->jawaban = $jawaban;
            $jawaban_result[] = $jwb;
        }
        return $jawaban_result;
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
        $ujian_id   = $request->ujian;
        $soal       = $request->soal;
        $soal_type       = $request->soal_type;
        $jawaban    = $request->jawaban;

        $jawaban_user = [];
        $skor       = 0;
        foreach ($soal as $index => $v) {
            $type = $soal_type[$index];
            $pecah = explode("-", $v);
            $soal_id    = $pecah[0];
            $jawab = $jawaban[$soal_id];

            if ($type == 0) {
                $jawaban_benar_id = $pecah[1];
                if ($jawab == $jawaban_benar_id) {
                    $skor += 10;
                }
            }

            $jawaban_user[] = [
                "soal_id"       => $soal_id,
                "jawaban_id"    => $jawab
            ];
        }
        $json_jawaban_user = json_encode($jawaban_user);
        $save_ujian = [
            "ujian_id"      => $ujian_id,
            "employee_id"   => auth()->user()->employee_id,
            "json_jawaban"  => $json_jawaban_user,
            "start_date"    => $request->start_date,
            "end_date"      => date('Y-m-d H:i:s'),
            "score"         => $skor
        ];
        
        $insert = DB::table('tb_ujian_user')->insert($save_ujian);
        return redirect()->back();
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
