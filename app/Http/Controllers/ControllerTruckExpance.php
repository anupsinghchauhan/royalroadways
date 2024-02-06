<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TruckExpenseDetail;
use PDF;
use Mail;
use DataTables;
use Excel;

class ControllerTruckExpance extends Controller
{
    public function listTrucksData(){
        return view('pages.admin.truckexpance.view_list_truck_expance_data');
    }

    public function DataTableAjax(Request $request){
        
    	if ($request->ajax()) {
            $data = TruckExpenseDetail::latest(); // data table query
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $actionBtn .= '<a href="'.url('lr-bill/delete',$row->id).'" onclick="return confirm(\'Are you sure you want to delete this item?\');"><i class="fa fa-trash" aria-hidden="true"></i></a>&nbsp;';
                    return $actionBtn;
                })

                ->filter( function($instance) use ($request){

                  if(!empty($request->get('txtSearchFrom')))
                    $instance->whereRaw("DATE(royal_date) >= '".date('Y-m-d',strtotime($request->get('txtSearchFrom'))) ."'");
                  if(!empty($request->get('txtSearchTo')))
                    $instance->whereRaw("DATE(royal_date) <= '".date('Y-m-d',strtotime($request->get('txtSearchTo'))) ."'");
                  if(!empty($request->get('txttruckNo')))
                    $instance->where("truck_no",$request->get('txttruckNo'));
                } )
                ->rawColumns(['action'])
                //->make(true);
                ->toJson();
        }
    }

    public function create(){

      $title = "Under Construction.";
      return view('pages.admin.view_under_construction',compact('title'));
    }
    public function delete(){

        $title = "Under Construction.";
        return view('pages.admin.view_under_construction',compact('title'));
    }

    public function downloadExcel(){

      $title = "Under Construction.";
      return view('pages.admin.view_under_construction',compact('title'));
    }
}
