<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Billing;
use App\Models\MonthlyPendingPaymetParty;
use PDF;
use Mail;
use DataTables;
use Excel;
use App\Exports\BillingExport;
use Session;

class ControllerLR extends Controller
{
    
    public function listLrData()
    {
      $txtSearchFrom =  $txtSearchTo = '';
      $site_master_id = Session::get('site_master_id');
      return view('pages.admin.lrdata.view_list_lr_data',compact('txtSearchFrom','txtSearchTo','site_master_id'));
    }

    public function listTodayLrData()
    {
      $txtSearchFrom =  $txtSearchTo = date('d-m-Y');
      $site_master_id = Session::get('site_master_id');
      return view('pages.admin.lrdata.view_list_lr_data',compact('txtSearchFrom','txtSearchTo','site_master_id'));
    }

    public function listLrDataTableAjax(Request $request)
    {
      $site_master_id = Session::get('site_master_id');
        if ($request->ajax()) {
            $data = Billing::where('site_master_id',$site_master_id)->latest('lrno'); // data table query
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $actionBtn = '<a href="'.url('lr-bill/view',$row->id).'"><i class="fa fa-eye" aria-hidden="true"></i></a>&nbsp;';
                    $actionBtn .= '<a href="'.url('lr-bill/edit',$row->id).'"><i class="fa fa-pencil" aria-hidden="true"></i></a>&nbsp;';
                    $actionBtn .= '<a href="'.url('lr-bill/delete',$row->id).'" onclick="return confirm(\'Are you sure you want to delete this item?\');"><i class="fa fa-trash" aria-hidden="true"></i></a>&nbsp;';
                    
                    $actionBtn .= '<a href="'.url('lr-bill/sendmail',$row->id).'"><i class="fa fa-envelope-o" aria-hidden="true"></i></a>';
                    
                    return $actionBtn;
                })

                ->filter( function($instance) use ($request){

                  if(!empty($request->get('txtSearchFrom')))
                    $instance->whereRaw("DATE(royal_date) >= '".date('Y-m-d',strtotime($request->get('txtSearchFrom'))) ."'");
                  if(!empty($request->get('txtSearchTo')))
                    $instance->whereRaw("DATE(royal_date) <= '".date('Y-m-d',strtotime($request->get('txtSearchTo'))) ."'");
                  //if(!empty($request->get('current_year')))
                    //$instance->whereRaw("YEAR(royal_date) = '".$request->get('current_year') ."'");

                  if($request->has('lr_mode') && $request->get('lr_mode') != '' ){
                    $instance->where('lr_mode',$request->get('lr_mode') );
                  }else{
                    $instance->where('lr_mode',lr_mode );
                  }
                  
                  // search box
                  if($request->has('search') && $request->get('search')['value']!="" ){

                    $instance->where(function($query) use ($request) {
                        $query->where('total_amount','like', '%'.$request->get('search')['value'].'%')
                            ->orWhere('royal_email','like','%'.$request->get('search')['value'].'%')
                            ->orWhere('royal_from','like','%'.$request->get('search')['value'].'%')
                            ->orWhere('truckno','like','%'.$request->get('search')['value'].'%')
                            ->orWhere('consignor1','like','%'.$request->get('search')['value'].'%')
                            ->orWhere('consignee1','like','%'.$request->get('search')['value'].'%')
                            ->orWhere('gstin1','like','%'.$request->get('search')['value'].'%')
                            ->orWhere('gstin2','like','%'.$request->get('search')['value'].'%')
                            ->orWhere('lrno','like','%'.$request->get('search')['value'].'%');
                    });
                  }
                  if( $request->has('txtSearch') && $request->get('txtSearch')!="" ){

                    $instance->where(function($query) use ($request) {
                        $query->where('total_amount','like', '%'.$request->get('txtSearch').'%')
                            ->orWhere('royal_email','like','%'.$request->get('txtSearch').'%')
                            ->orWhere('royal_from','like','%'.$request->get('txtSearch').'%')
                            ->orWhere('consignor1','like','%'.$request->get('txtSearch').'%')
                            ->orWhere('consignee1','like','%'.$request->get('txtSearch').'%')
                            ->orWhere('gstin1','like','%'.$request->get('txtSearch').'%')
                            ->orWhere('gstin2','like','%'.$request->get('txtSearch').'%')
                            ->orWhere('lrno','like','%'.$request->get('txtSearch').'%');
                    });
                  }
                  // search box
                  
                } )
                ->rawColumns(['action'])
                ->make(true);
                //->toJson();
        }
    }

    public function createBill()
    {   
        $site_master_id = Session::get('site_master_id');
        //DB::enableQueryLog();
        $ArrBilling = Billing::select('lrno')->where(['lr_mode'=>lr_mode,'site_master_id'=>$site_master_id])->latest('lrno')->limit(1)->get();
        //dd(DB::getQueryLog());exit;
        $lr_number = 1;
        if(count($ArrBilling)>0) $lr_number = $ArrBilling[0]->lrno+1;
        
        //$lr_number = ($lr_number == 4025 )?4147:$lr_number+1;
        $mode = "add";
        $action = url('lr-bill/save');
        return view('pages.admin.lrdata.view_create_bill',compact('lr_number','action','mode'));
    }

    public function view($id)
    {
      $arrResult = Billing::find($id);
      //PDF DATA
      $con1 = $conee1 = $trans1 ='';

      if($arrResult->transport == "Y")
        $trans1 ='Transport ';
      if($arrResult->consignor == "Y")
        $con1 ='Consignor ';
      if($arrResult->consignee == "Y")
        $conee1 ='Consignee ';

        $lrno = $arrResult->lrno;
        $truckno = $arrResult->truckno;
        $royal_date = $arrResult->royal_date;
        $royal_from = $arrResult->royal_from;
        $royal_to = $arrResult->royal_to;
        $driver_details = $arrResult->driver_details;
        $consignor1 = $arrResult->consignor1;
        $consignor_address = $arrResult->consignor_add_1;
        $consignor_gstn = $arrResult->gstin1;
        $consignee1 = $arrResult->consignee1;
        $consignee_address = $arrResult->consignee_add_1;
        $consignee_gstn = $arrResult->gstin2;
        $no_1 = $arrResult->no1;
        $nogstc1 = $arrResult->nogstc1;
        $weight1 = $arrResult->weight1;
        $rate1 = $arrResult->rate1;
        $total_freighty_to_opay1 = $arrResult->total_freighty_to_opay1;
        $royal_amount = $arrResult->royal_amount;
        $cdst = $arrResult->cdst;
        $sgst = $arrResult->sgst;
        $ToPayOrPaid = $arrResult->ToPayOrPaid;
        $total_amount = $arrResult->total_amount;
        $con1 = $con1;
        $conee1 = $conee1;
        $trans1 = $trans1;
      //echo implode(',',$arrayPDF);exit;
      return view('pages.admin.lrdata.view_lr_bill',compact('arrResult','lrno','truckno','royal_date','royal_from','royal_to','driver_details','consignor1','consignor_address','consignor_gstn','consignee1','consignee_address','consignee_gstn','no_1','nogstc1','weight1','rate1','total_freighty_to_opay1','royal_amount','cdst','sgst','ToPayOrPaid','total_amount','con1','conee1','trans1'));
    }

    public function edit($id)
    {
        if($id > 0){
            $arrResult = Billing::find($id);
            if(!empty($arrResult)>0){
                $action = url('lr-bill/save');
                $lr_number = $arrResult->lrno;
                $mode = "edit";
                return view('pages.admin.lrdata.view_create_bill',compact('arrResult','action','lr_number','mode'));        
            }else{
                return redirect()->back()->with('error', 'oops !! something went wrong please try again.');      
            }
            
        }else{
            return redirect()->back()->with('error', 'oops !! something went wrong please try again.');      
        }
        
    }

    public function delete($id)
    {
        if($id > 0){
            $arrResult = Billing::find($id);
            if(!empty($arrResult)>0){
                $arrResult->delete(); 
                return redirect()->back()->with('success', 'Record has been deleted successfully.');
            }else{
                return redirect()->back()->with('error', 'oops !! something went wrong please try again.');      
            }
            
        }else{
            return redirect()->back()->with('error', 'oops !! something went wrong please try again.');      
        }

    }

    public function sendmail($id)
    {
      $arrResult = Billing::find($id);
      return view('pages.admin.lrdata.view_sendmail',compact('arrResult'));
    }
    
    public function save(Request $request)
    {
        $site_master_id = Session::get('site_master_id');
        if($request->input('mode')=="edit"){

            $validated = $request->validate([
                'lrno' => 'required',
                'royal_date' => 'required',
            ]); 

        }else{
            $validated = $request->validate([
                'lrno' => 'required',
                'royal_date' => 'required',
            ]);  
        }
        
        //echo "<pre>";
        //print_r($request->all());exit;
        
        if($request->has('lrno') && !empty($request->input('lrno')) ){

            // define variable
            $lrno = $request->input('lrno');
            $royal_email = $request->input('royal_email');
            $truckno = $request->input('truckno');
            $royal_date = date('Y-m-d',strtotime($request->input('royal_date')));
            $royal_from = $request->input('royal_from');
            $royal_to = $request->input('royal_to');
            $driver_details = $request->input('driver_details');
            $consignor1 = $request->input('consignor1');
            $consignee1 = $request->input('consignee1');
            $consignor_add_1 = $request->input('consignor_add_1');
            $consignee_add_1 = $request->input('consignee_add_1');
            $gstin1 = $request->input('gstin1');
            $gstin2 = $request->input('gstin2');
            $no1 = $request->input('no1');
            $nogstc1 = $request->input('nogstc1');
            $weight1 = $request->input('weight1');
            $rate1 = $request->input('rate1');
            $total_freighty_to_opay1 = $request->input('total_freighty_to_opay1');
            $royal_amount = $request->input('royal_amount');
            $cdst = $request->input('cdst');
            $sgst = $request->input('sgst');
            $total_amount = $request->input('total_amount');
            $consignor = $request->input('consignor');
            $consignee = $request->input('consignee');
            $transport = $request->input('transport');
            $ToPayOrPaid = $request->input('ToPayOrPaid');
            $UnpaidParty = $request->input('UnpaidParty');
            // define variable end 
            if($request->input('mode')=="edit"){
                $id = $request->input('id');
                $billing_data = Billing::find($id);
            }else{
                $billing_data = new Billing;
                $billing_data->lr_mode = lr_mode;
            }
            
            $billing_data->lrno = $lrno;
            $billing_data->royal_email = $royal_email;
            $billing_data->truckno = $truckno;
            $billing_data->royal_date = $royal_date;
            $billing_data->royal_from = $royal_from;
            $billing_data->royal_to = $royal_to;
            $billing_data->driver_details = $driver_details;
            $billing_data->consignor1 = $consignor1;
            $billing_data->consignee1 = $consignee1;
            $billing_data->consignor_add_1 = $consignor_add_1;
            $billing_data->consignee_add_1 = $consignee_add_1;
            $billing_data->gstin1 = $gstin1;
            $billing_data->gstin2 = $gstin2;
            $billing_data->no1 = $no1;
            $billing_data->nogstc1 = $nogstc1;
            $billing_data->weight1 = $weight1;
            $billing_data->rate1 = $rate1;

            if($request->filled('total_freighty_to_opay1'))
                $billing_data->total_freighty_to_opay1 = $total_freighty_to_opay1;

            $billing_data->royal_amount = $royal_amount;
            $billing_data->cdst = $cdst;
            $billing_data->sgst = $sgst;
            $billing_data->total_amount = $total_amount;
            $billing_data->consignor = $consignor;
            $billing_data->consignee = $consignee;
            $billing_data->transport = $transport;
            $billing_data->ToPayOrPaid = $ToPayOrPaid;
            $billing_data->site_master_id = $site_master_id;
            $billing_data->UnpaidParty = $UnpaidParty;
            $billing_data->pdf_name = 'LRNo-'.$lrno.'_'.date('d-M-Y').'_'.rand(1,100).'_royalroadways_Bill.pdf';
            $billing_data->save();
            $id = $billing_data->id;
            
            $UnpaidParty = ( !empty($request->input('UnpaidParty')) ) ? $request->input('UnpaidParty') : '';
            $pay_status = 3;
            $party_name = '';
            if($UnpaidParty == "Consignor"){
              $party_name = $consignor1;
              $pay_status = 1;
            }
            if($UnpaidParty == "Consignee"){
              $party_name = $consignee1;
              $pay_status = 2;
            }

            if($UnpaidParty != ""){
                // delete old record
                //MonthlyPendingPaymetParty::find()
                // save process start
                MonthlyPendingPaymetParty::where('billing_id',$id)->delete();
                $mp_obj = new MonthlyPendingPaymetParty;
                $mp_obj->billing_id = $id;
                $mp_obj->lr_mode = $billing_data->lr_mode;
                $mp_obj->party_name = $party_name;
                $mp_obj->truckno = $truckno;
                $mp_obj->lrno = $lrno;
                $mp_obj->royal_from = $royal_from;
                $mp_obj->consignor1 = $consignor1;
                $mp_obj->consignee1 = $consignee1;
                $mp_obj->royal_to = $royal_to;
                $mp_obj->weight1 = $weight1;
                $mp_obj->rate1 = $rate1;
                $mp_obj->total_amount = $total_amount;
                $mp_obj->royal_date = $royal_date;
                $mp_obj->site_master_id = $site_master_id;
                $mp_obj->save();
            }

            return redirect('/lr-bill/sendmail/'.$id);
        }
    }

    public function ajax_search_address(Request $request){

        if($request->input('name') !=""){

            if( $request->input('type') == "consignor"){
                //DB::enableQueryLog();
                $arrResult= Billing::select('consignor_add_1','consignor_add_2','gstin1')->where('consignor1', 'like', '%' . $request->input('name') . '%')->orderby('id','desc')->limit(1)->get()->toArray();
                //dd(DB::getQueryLog());
                
                if(count($arrResult) > 0  && isset($arrResult[0])){
                    $consignor_add_1 = $arrResult[0]['consignor_add_1'];
                    $consignor_add_2 = $arrResult[0]['consignor_add_2'];
                    $gstin1 = $arrResult[0]['gstin1'];

                }else{
                    $consignor_add_1 = '';
                    $consignor_add_2 = '';
                    $gstin1 = '';
                }
                $arrayName = array('consignor_add_1'=>$consignor_add_1,'consignor_add_2'=>$consignor_add_2,'gstin1'=>$gstin1,'type'=>'consignor');
                echo json_encode($arrayName);exit;

            }
            if( $request->input('type') == "consignee"){
                
                //DB::enableQueryLog();
                $arrResult= Billing::select('consignee_add_1','consignee_add_2','gstin2')->where('consignee1', 'like', '%' . $request->input('name') . '%')->orderby('id','desc')->limit(1)->get()->toArray();
                //dd(DB::getQueryLog());

                if(count($arrResult) > 0 ){
                    
                    $consignee_add_1 = $arrResult[0]['consignee_add_1'];
                    $consignee_add_2 = $arrResult[0]['consignee_add_2'];
                    $gstin2 = $arrResult[0]['gstin2'];

                }else{

                    $consignee_add_1 = '';
                    $consignee_add_2 = '';
                    $gstin2 = '';
                }
                $arrayName = array('consignee_add_1'=>$consignee_add_1,'consignee_add_2'=>$consignee_add_2,'gstin2'=>$gstin2,'type'=>'consignee');
                echo json_encode($arrayName);exit;

            }


        }
        
        
    }

    public function sendMailProcess(Request $request, $id)
    {
        $arrResult = Billing::find($id);
        
        if($request->has('royal_email')){
          $email_to = $request->input('royal_email');
        }else{
          $email_to = $arrResult->royal_email;
        }
        if($email_to == ""){
            return redirect()->back()->with('error','Please Enter Email-ID.');
        }
        $data["email"]=trim($email_to);
        $data["client_name"]=$arrResult->driver_details;
        $data["subject"]="Bill / Invoice From Royal Road Ways";
        $data["lrno"]=$arrResult->lrno;

        //PDF DATA
        $con1 = $conee1 = $trans1 ='';

        if($arrResult->transport == "Y")
          $trans1 ='Transport ';
        if($arrResult->consignor == "Y")
          $con1 ='Consignor ';
        if($arrResult->consignee == "Y")
          $conee1 ='Consignee ';

        $arrayPDF = array(
          'lrno' => $arrResult->lrno,
          'truckno' => $arrResult->truckno,
          'royal_date' => $arrResult->royal_date,
          'royal_from' => $arrResult->royal_from,
          'royal_to' => $arrResult->royal_to,
          'driver_details' => $arrResult->driver_details,
          'consignor1' => $arrResult->consignor1,
          'consignor_address' => $arrResult->consignor_add_1,
          'consignor_gstn' => $arrResult->gstin1,
          'consignee1' => $arrResult->consignee1,
          'consignee_address' => $arrResult->consignee_add_1,
          'consignee_gstn' => $arrResult->gstin2,
          'no_1' => $arrResult->no1,
          'nogstc1' => $arrResult->nogstc1,
          'weight1' => $arrResult->weight1,
          'rate1' => $arrResult->rate1,
          'total_freighty_to_opay1' => $arrResult->total_freighty_to_opay1,
          'royal_amount' => $arrResult->royal_amount,
          'cdst' => $arrResult->cdst,
          'sgst' => $arrResult->sgst,
          'ToPayOrPaid' => $arrResult->ToPayOrPaid,
          'total_amount' => $arrResult->total_amount,
          'con1' => $con1,
          'conee1' => $conee1,
          'trans1' => $trans1
        );

        $pdf = PDF::loadView('pages.admin.lrdata.lrpdf', $arrayPDF);
        
        try{
            Mail::send('pages.admin.lrdata.lrmail-body', $data, function($message)use($data,$pdf) {
            $message->to($data["email"], $data["client_name"])
            ->replyTo('royalroadways55@gmail.com', 'RoyalRoadWays')
            ->bcc('royalroadwaysftp@gmail.com','RoyalRoadWays')
            ->subject('Bill / Invoice From Royal Road Ways')
            ->attachData($pdf->output(), 'LRNo_'.$data['lrno']."_invoice.pdf");
            });
        }catch(JWTException $exception){
            $this->serverstatuscode = "0";
            $this->serverstatusdes = $exception->getMessage();
        }
        if (Mail::failures()) {
             $this->statusdesc  =   "Error sending mail";
             $this->statuscode  =   "0";
 
        }else{
 
           $this->statusdesc  =   "Message sent Succesfully";
           $this->statuscode  =   "1";
        }

        $result = "error";
        $message = "Oops Somthing Wrong to Update pls Try Again";
        if($this->statuscode == 1){
          $result = "success";
          $message = "Message sent Succesfully";
        }
        return redirect()->back()->with($result,$message);
        
        
    }

    public function downloadPDF($id){

      $arrResult = Billing::find($id);

      //PDF DATA
      $con1 = $conee1 = $trans1 ='';

      if($arrResult->transport == "Y")
        $trans1 ='Transport ';
      if($arrResult->consignor == "Y")
        $con1 ='Consignor ';
      if($arrResult->consignee == "Y")
        $conee1 ='Consignee ';

      $arrayPDF = array(
          'lrno' => $arrResult->lrno,
          'truckno' => $arrResult->truckno,
          'royal_date' => $arrResult->royal_date,
          'royal_from' => $arrResult->royal_from,
          'royal_to' => $arrResult->royal_to,
          'driver_details' => $arrResult->driver_details,
          'consignor1' => $arrResult->consignor1,
          'consignor_address' => $arrResult->consignor_add_1,
          'consignor_gstn' => $arrResult->gstin1,
          'consignee1' => $arrResult->consignee1,
          'consignee_address' => $arrResult->consignee_add_1,
          'consignee_gstn' => $arrResult->gstin2,
          'no_1' => $arrResult->no1,
          'nogstc1' => $arrResult->nogstc1,
          'weight1' => $arrResult->weight1,
          'rate1' => $arrResult->rate1,
          'total_freighty_to_opay1' => $arrResult->total_freighty_to_opay1,
          'royal_amount' => $arrResult->royal_amount,
          'cdst' => $arrResult->cdst,
          'sgst' => $arrResult->sgst,
          'ToPayOrPaid' => $arrResult->ToPayOrPaid,
          'total_amount' => $arrResult->total_amount,
          'con1' => $con1,
          'conee1' => $conee1,
          'trans1' => $trans1
        );

        $pdf = PDF::loadView('pages.admin.lrdata.lrpdf', $arrayPDF);
        $pdf->download('LRNo_'.$arrResult->lrno."_invoice.pdf");
    }

    public function downloadExcel(Request $request) 
    {
      return Excel::download(new BillingExport($request), 'Royal_LR_Bill_Report_'.date('d-M-Y').'.xlsx');
    }

} //:)
