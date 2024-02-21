<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
       
        // // Create connection to Oracle
        
        // $username   = "suja";
        // $password   = "suja";
        // $database   = "//10.137.26.67:1521/BRS";
        // $conn   = oci_connect($username, $password, $database);
        // // if (!$conn) {
        // //    $m = oci_error();
        // //    echo $m['message'], "\n";
        // //    exit;
        // // }
        // // else {
        // //    print "Connected to Oracle!";
        // // }
        // // // Close the Oracle connection
        // // oci_close($conn);
        // // $conn = oci_connect('CJCMS', 'admin99', '10.137.62.6:1521/RPA');
        // if (!$conn) {
        //     $e = oci_error();
        //     trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
        // } 

        // $stid = oci_parse($conn, 'SELECT * FROM SH_PD_ABF_RESULT WHERE EPCNO IS NOT NULL');
        // oci_execute($stid);

        // echo "<table border='1'>\n";
        // while ($row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)) {
        //     echo "<tr>\n";
        //     foreach ($row as $item) {
        //         echo "    <td>" . ($item !== null ? htmlentities($item, ENT_QUOTES) : "&nbsp;") . "</td>\n";
        //     }
        //     echo "</tr>\n";
        // }
        // echo "</table>\n";
        
        return view('home');
    }
}
