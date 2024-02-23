<?php

namespace App\Http\Controllers;

use App\Models\PrePostTest;
use Illuminate\Http\Request;
use DB;
use File;
use Illuminate\Support\Facades\Hash;

class PrepostTestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ujian  = DB::table('tb_ujian')->where('id', 1)->First();
        $soal   = DB::table('tb_soal')->select('tb_soal.*', 'tb_bagian.nama as nama_bagian')->join('tb_bagian', 'tb_bagian.id', 'tb_soal.bagian_id')->orderBy('tb_bagian.id', 'ASC')->orderBy('tb_soal.id', 'ASC')->get();
        $jawaban   = DB::table('tb_jawaban')->orderBy('soal_id', 'ASC')->get();

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
        $start_date = date('Y-m-d H:i:s');
        return view('prepost-test.index', compact('ujian', 'soal_data', 'start_date'));
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
        $jawaban    = $request->jawaban;

        $jawaban_user = [];
        $skor       = 0;
        foreach ($soal as $v) {
            $pecah = explode("-", $v);
            $soal_id    = $pecah[0];
            $jawaban_benar_id = $pecah[1];

            $jawab = $jawaban[$soal_id];

            $jawaban_user[] = [
                "soal_id"       => $soal_id,
                "jawaban_id"    => $jawab
            ];
            if ($jawab == $jawaban_benar_id) {
                $skor += 10;
            }
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
        return redirect()->route('home');
    }

    public function result() {
        return view('prepost-test.result');
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

    public function sync_user() {
        $path = public_path('datahr.json');
        $json_file = File::get($path);
        $data_hr = json_decode($json_file);

        $email_verified_at = date('Y-m-d H:i:s');
        $query_insert = "INSERT INTO users (company, plant, department, nickname, name, email, employee_id, password, role, phone) VALUES ";
        $index = 0;
        foreach ($data_hr as $user) {
            if ($user->employee_id != "01220023") {
                if ($index > 0) {
                    $query_insert .= ", ";
                }
                $nickname = empty($user->nickname) ? "" : $user->nickname;
                $password = Hash::make($user->password);
                $query_insert .= " ('$user->company', '$user->plant', '$user->department', '$nickname', '$user->name', '$user->email', '$user->employee_id', '$password', 'user', '$user->phone')";
                $index++;
            }

            if ($index == 600) {
                dd($query_insert);
            }
        }
        $query_insert .= ";";

        return $query_insert;
    }
}
