<?php
 
namespace App\Exports;
 
use DB;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class ReportExport implements FromView, ShouldAutoSize
{
	protected $data;

	public function __construct($data){
        $this->data 	= $data;
    }

    public function view(): View
    {
    	return view('report.excel', [
            'data' => $this->data
        ]);
    }
}