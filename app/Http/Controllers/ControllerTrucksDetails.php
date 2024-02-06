<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\TruckExpenseCalculate;
use PDF;
use Mail;
use DataTables;
use Excel;

class ControllerTrucksDetails extends Controller
{
    
    public function listTrucksData(){
        return view('pages.admin.truck.view_list_truck_data');
    }

    public function DataTableAjax(Request $request){
        
    	if ($request->ajax()) {
            $data = TruckExpenseCalculate::latest(); // data table query
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $actionBtn = '<a href="'.url('lr-bill/view',$row->id).'"><i class="fa fa-eye" aria-hidden="true"></i></a>&nbsp;';
                    $actionBtn .= '<a href="'.url('lr-bill/edit',$row->id).'"><i class="fa fa-pencil" aria-hidden="true"></i></a>&nbsp;';
                    $actionBtn .= '<a href="'.url('lr-bill/delete',$row->id).'" onclick="return confirm(\'Are you sure you want to delete this item?\');"><i class="fa fa-trash" aria-hidden="true"></i></a>&nbsp;';
                    $actionBtn .= '<a href="javascript:void(0);" onclick="sendMail(\''.$row->id.'\');"><i class="fa fa-envelope-o" aria-hidden="true"></i></a>';
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

    public function edit(){

      $title = "Under Construction.";
      return view('pages.admin.view_under_construction',compact('title'));
    }
    public function delete(){

        $title = "Under Construction.";
        return view('pages.admin.view_under_construction',compact('title'));
    }

    public function downloadPDF(){

      $title = "Under Construction.";
      return view('pages.admin.view_under_construction',compact('title'));
    }
}
