<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Billing;
use PDF;
use Mail;
use DataTables;
use Excel;
use DB;
use Session;

class ControllerDashboard extends Controller
{
    public function index(){
        $site_master_id = Session::get('site_master_id');
        //echo date('Y-m-d');exit;
        //DB::enableQueryLog();
        $ArrData['ArrCount'] = Billing::where('site_master_id',$site_master_id)->whereRaw('Date(royal_date) = CURDATE()')->count();
        $ArrData['ArrAllCount'] = Billing::where('site_master_id',$site_master_id)->count();
        //dd(DB::getQueryLog());
        
        return View('pages.admin.view_dashboard',$ArrData);
    }
}
