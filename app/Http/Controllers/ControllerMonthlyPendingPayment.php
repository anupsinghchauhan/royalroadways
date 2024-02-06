<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MonthlyPendingPaymetParty;
use PDF;
use Mail;
use DataTables;
use Excel;
use Session;
class ControllerMonthlyPendingPayment extends Controller
{
    //
    public function monthly_pending_party_payment_list()
    {

        return view('pages.admin.monthlypending.view_list_monthly_pending_data');
    }

    public function DataTableAjax(Request $request)
    {
        $site_master_id = Session::get('site_master_id');
        if($request->ajax()){
            $data = MonthlyPendingPaymetParty::where('site_master_id',$site_master_id)->select('party_name')->groupBy('party_name');
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $url = url('monthly-pending-party-bill/delete-by-name',base64_encode($row->party_name));
                    $actionBtn = '<a href="javascript:void(0)" onClick="MonthyPendingPartyForm(\''.$row->party_name.'\')"><i class="fa fa-eye" aria-hidden="true"></i></a>&nbsp;';
                    $actionBtn .= '<a href="javascript:void(0)" onclick="DeleteMonthlyData(\''.$url.'\');"><i class="fa fa-trash" aria-hidden="true"></i></a>&nbsp;';
                    return $actionBtn;
                })

                ->filter( function($instance) use ($request){
                    if(!empty($request->get('txtSearchFrom')))
                        $instance->whereRaw("DATE(royal_date) >= '".date('Y-m-d',strtotime($request->get('txtSearchFrom'))) ."'");
                    if(!empty($request->get('txtSearchTo')))
                        $instance->whereRaw("DATE(royal_date) <= '".date('Y-m-d',strtotime($request->get('txtSearchTo'))) ."'");

                    if($request->has('lr_mode') && $request->get('lr_mode') != '' ){
                        $instance->where('lr_mode',$request->get('lr_mode') );
                    }else{
                        $instance->where('lr_mode',lr_mode );
                    }
                    
                    // search box
                    if($request->has('search') && $request->get('search')['value']!="" ){

                        $instance->where(function($query) use ($request) {
                            $query->where('party_name','like', '%'.$request->get('search')['value'].'%')
                                ->orWhere('total_amount','like','%'.$request->get('search')['value'].'%')
                                ->orWhere('royal_from','like','%'.$request->get('search')['value'].'%')
                                ->orWhere('consignor1','like','%'.$request->get('search')['value'].'%')
                                ->orWhere('consignee1','like','%'.$request->get('search')['value'].'%')
                                ->orWhere('lrno','like','%'.$request->get('search')['value'].'%')
                                ->orWhere('truckno','like','%'.$request->get('search')['value'].'%');
                        });
                    }
                  // search box

                } )
                ->rawColumns(['action'])
                //->make(true);
                ->toJson();
        }
    }

    public function view(Request $request)
    {
        $site_master_id = Session::get('site_master_id');
        $query = MonthlyPendingPaymetParty::where("site_master_id",$site_master_id)->orderBy('royal_date','ASC');
        if($request->has('pdf_txtSearchFrom') && !empty($request->has('pdf_txtSearchFrom')))
            $query->whereRaw("DATE(royal_date) >= '".date('Y-m-d',strtotime($request->get('pdf_txtSearchFrom'))) ."'");
        if(!empty($request->get('pdf_txtSearchTo')))
            $query->whereRaw("DATE(royal_date) <= '".date('Y-m-d',strtotime($request->get('pdf_txtSearchTo'))) ."'");

        if(!empty($request->get('party_name')))
            $query->where("party_name",$request->get('party_name'));

        if($request->has('lr_mode_txt') && $request->get('lr_mode_txt') != '' )
            $query->where("lr_mode",$request->get('lr_mode_txt'));
        else
            $query->where("lr_mode",lr_mode);

        $arrResult = $query->get()->toArray();
        
        $party_name = $request->get('party_name');
        $txtSearchFrom = $request->get('pdf_txtSearchFrom');
        $txtSearchTo = $request->get('pdf_txtSearchTo');
        
        if($request->has('lr_mode_txt') && $request->get('lr_mode_txt') != '' )
            $lr_mode_txt = $request->get('lr_mode_txt');
        else
            $lr_mode_txt = lr_mode;

        $date_range = ($txtSearchFrom!="" && $txtSearchTo !="")?getDateFormate($txtSearchFrom).' - '. getDateFormate($txtSearchTo): '';

        $mode = "view";
        return view('pages.admin.monthlypending.view_monthly_pending_party_bill',compact('arrResult','party_name','txtSearchFrom','txtSearchTo','date_range','lr_mode_txt','mode'));

    }

    public function downloadPDF(Request $request){

        $site_master_id = Session::get('site_master_id');
        $query = MonthlyPendingPaymetParty::where("site_master_id",$site_master_id)->orderBy('royal_date','ASC');
        if($request->has('pdf_txtSearchFrom') && !empty($request->has('pdf_txtSearchFrom')))
            $query->whereRaw("DATE(royal_date) >= '".date('Y-m-d',strtotime($request->get('pdf_txtSearchFrom'))) ."'");
        if(!empty($request->get('pdf_txtSearchTo')))
            $query->whereRaw("DATE(royal_date) <= '".date('Y-m-d',strtotime($request->get('pdf_txtSearchTo'))) ."'");

        if(!empty($request->get('party_name')))
            $query->where("party_name",$request->get('party_name'));

        if($request->has('lr_mode_txt') && $request->get('lr_mode_txt') != '' )
            $query->where("lr_mode",$request->get('lr_mode_txt'));
        else
            $query->where("lr_mode",lr_mode);

        $arrResult = $query->get()->toArray();
        $party_name = $request->get('party_name');
        $txtSearchFrom = $request->get('pdf_txtSearchFrom');
        $txtSearchTo = $request->get('pdf_txtSearchTo');
        
        if($request->has('lr_mode_txt') && $request->get('lr_mode_txt') != '' )
            $lr_mode_txt = $request->get('lr_mode_txt');
        else
            $lr_mode_txt = lr_mode;

        $date_range = ($txtSearchFrom!="" && $txtSearchTo !="")?getDateFormate($txtSearchFrom).' - '. getDateFormate($txtSearchTo): '';

        //PDF DATA
        $arrayPDF = array(
            'arrResult' => $arrResult,
            'party_name' => $party_name,
            'txtSearchFrom' => $txtSearchFrom,
            'txtSearchTo' => $txtSearchTo,
            'date_range' => $date_range,
            'lr_mode_txt' => $lr_mode_txt,
            'mode' => 'pdf',
        );
        $slug = str_replace(' ', '_', $party_name);
        $pdf = PDF::loadView('pages.admin.monthlypending.monthly_pending_party_bill_pdf', $arrayPDF);
        $pdf->download($slug."_pending_payment.pdf");
    }

    public function delete($id=0){

        if($id > 0){
            $site_master_id = Session::get('site_master_id');
            $arrResult = MonthlyPendingPaymetParty::where("site_master_id",$site_master_id)->find($id);
            if(!empty($arrResult)>0){
                $arrResult->delete(); 
                echo json_encode(array('result'=>1,'message'=>"Record has been deleted successfully."));exit;
            }else{
                echo json_encode(array('result'=>0,'message'=>"oops !! something went wrong please try again."));exit;
            }

        }else{

            echo json_encode(array('result'=>0,'message'=>"oops !! something went wrong please try again."));exit;
        }
    }

    public function deleteByName($name=''){
        $name = base64_decode( $name );
        if($name != ""){
            
            $site_master_id = Session::get('site_master_id');
            $arrResult = MonthlyPendingPaymetParty::where(['party_name'=>$name,'site_master_id'=>$site_master_id])->delete();
            if(!empty($arrResult)>0){
                $arrResult->delete(); 
                echo json_encode(array('result'=>1,'message'=>"Record has been deleted successfully."));exit;
            }else{
                echo json_encode(array('result'=>0,'message'=>"oops !! something went wrong please try again."));exit;
            }

        }else{
            
            echo json_encode(array('result'=>0,'message'=>"oops !! something went wrong please try again."));exit;
        }
    }

    public function savePayment(Request $request){

        $id = $request->input('r_pending_paymet_party_id');
        $r_amount = $request->input('r_amount');
        $update_date = date('Y-m-d H:i:s');
        $arrData = MonthlyPendingPaymetParty::find($id);
        if($arrData->total_amount > $r_amount ){
            $arrData->total_amount = $arrData->total_amount - $r_amount;
            $arrData->total_paid_amount = $arrData->total_paid_amount+$r_amount;
            $arrData->save();
            echo json_encode(array('result'=>1,'message'=>"Amount Updated Sucessfully."));
        }else{
            echo json_encode(array('result'=>0,'message'=>"Enterd amount should be less then total amount."));
        }
        
    }
    
}
