<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Billing;
use App\Models\BillInformation;
use Illuminate\Support\Facades\DB;
use PDF;
use Mail;
use DataTables;
use Excel;
use App\Exports\BillingExport;
use Session;
class ControllerBilling extends Controller
{
    
    public function listBillsData()
    {

        return view('pages.admin.billing.view_list_bills_data');
    }

    public function listBillsDataAjax(Request $request)
    {
        $site_master_id = Session::get('site_master_id');
        if($request->ajax()){
            $data = BillInformation::where('site_master_id',$site_master_id)->latest();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('created_at',function($row){
                    return date('d M Y',strtotime($row->created_at));
                })
                ->addColumn('action', function($row){
                    $actionBtn = '<a href="'.url('bills/view',$row->id).'"><i class="fa fa-eye" aria-hidden="true"></i></a>&nbsp;';
                    $actionBtn .= '<a href="'.url('bills/edit',$row->id).'"><i class="fa fa-pencil" aria-hidden="true"></i></a>&nbsp;';
                    $actionBtn .= '<a href="'.url('bills/delete',$row->id).'" onclick="return confirm(\'Are you sure you want to delete this item?\');"><i class="fa fa-trash" aria-hidden="true"></i></a>&nbsp;';
                    $actionBtn .= '<a href="'.url('bills/sendmail',$row->id).'" ><i class="fa fa-envelope-o" aria-hidden="true"></i></a>';
                    return $actionBtn;
                })

                ->filter( function($instance) use ($request){
                    // search box
                      if($request->has('search') && $request->get('search')['value']!="" ){
    
                        $instance->where(function($query) use ($request) {
                            $query->where('client_name','like', '%'.$request->get('search')['value'].'%')
                                ->orWhere('send_email_id','like','%'.$request->get('search')['value'].'%')
                                ->orWhere('bill_information_data','like','%'.$request->get('search')['value'].'%');
                        });
                      }
                      // search box
                } )
                ->rawColumns(['created_at','action'])
                //->make(true);
                ->toJson();
        }
    }

    public function createBill()
    {
        $site_master_id = Session::get('site_master_id');
        $arrResult = BillInformation::where('site_master_id',$site_master_id)->latest('id')->first();
        $bill_no = (!empty($arrResult) && isset($arrResult->bill_no))?$arrResult->bill_no+1:1;
        $mode = "add";
        $id = 0;
        return view('pages.admin.billing.view_bills_create_bill',compact('bill_no','mode','id'));
    }

    public function view($id)
    {
        $arrResult = BillInformation::find($id);
        if(!empty($arrResult)){

            $arrayPDF = array(
              'id' => $arrResult->id,
              'client_name' => $arrResult->client_name,
              'bill_no' => $arrResult->bill_no,
              'send_email_id' => $arrResult->send_email_id,
              'bill_date' => getDateFormate($arrResult->bill_date),
              'bill_information_data' => $arrResult->bill_information_data,
              'total_amount_rupees' => $arrResult->total_amount_rupees,
              'total_amount' => $arrResult->total_amount,
              'created_at' => $arrResult->created_at
            );

        }
        return view('pages.admin.billing.view_bills_data',compact('arrayPDF'));
    }

    public function edit($id)
    {
        $site_master_id = Session::get('site_master_id');
        $arrResult = BillInformation::where('site_master_id',$site_master_id)->latest('id')->first();
        $bill_no = (!empty($arrResult) && isset($arrResult->bill_no))?$arrResult->bill_no+1:1;
        $arrBillData = BillInformation::find($id);
        $mode = "edit";
        return view('pages.admin.billing.view_bills_create_bill',compact('bill_no','arrBillData','mode','id'));
    }

    public function delete($id)
    {
        $arrResult = BillInformation::find($id);
        if(!empty($arrResult) && isset($arrResult->id)){
            $arrResult->delete();
            return redirect()->back()->with('success', 'Record has been deleted successfully.');
        }else{
            return redirect()->back()->with('error', 'oops !! something went wrong please try again.');
        }
        
    }

    public function sendmail($id)
    {
        $arrResult = BillInformation::find($id);
        return view('pages.admin.billing.view_sendmail',compact('arrResult'));
    }

    public function save(Request $request,$id=0)
    {
        $site_master_id = Session::get('site_master_id');
        $validated = $request->validate([
            'c_name1' => 'required',
            'bill_date' => 'required',
        ]);
        for ($i=0; $i < count($request->trno); $i++) { 
            $arrJson[] = array(
                'trno' => $request->trno[$i],
                'lrno' => $request->lrno[$i],
                'paid_date' => $request->paid_date[$i],
                'weight' => $request->weight[$i],
                'rate' => $request->rate[$i],
                'consignor' => $request->consignor[$i],
                'consignee' => $request->consignee[$i],
                'site_master_id' => $site_master_id,
                'amt' => $request->amt[$i],
            );
        }
        if($request->mode == "edit" && $id > 0){
            $billing_information = BillInformation::find($id);
        }else{
            $billing_information = new BillInformation;
        }
        
        $billing_information->client_name = $request->c_name1;
        $billing_information->bill_no = $request->bill_no;
        $billing_information->bill_date = $request->bill_date;
        $billing_information->bill_information_data = json_encode($arrJson);
        $billing_information->total_amount_rupees = $request->total_amt_words;
        $billing_information->total_amount = $request->total_amt;
        $billing_information->site_master_id = $site_master_id;
        $billing_information->save();
        
        return redirect()->back()->with('success','Details hase been added successfully.');
    }

    public function ajaxSearchData(Request $request)
    {
        $site_master_id = Session::get('site_master_id');
        //DB::enableQueryLog();
        $arrResult = Billing::where(['lrno'=>$request->lrno,'lr_mode'=>lr_mode,'site_master_id'=>$site_master_id])->first();
        //dd(DB::getQueryLog());exit;
        $arrData = array();
        if(!empty($arrResult)){
            
            if(is_numeric($arrResult->rate1)){
            
                $nm = (string)$arrResult->rate1;
                $r = explode('.', $nm);
                if(count($r) == 2 ){

                    if($r[0] == '0'){
                        $rate1 = $arrResult->rate1;
                    }else{
                        $rate1 = '0.'.$r[1];
                    }

                }else{
                    $rate1 = $arrResult->rate1;
                }
            
            }else{
                $rate1 = $arrResult->rate1;
            }

            $total_amount = $arrResult->total_amount;
            $arrData = array(
                'truckno'=>$arrResult->truckno,
                'lrno'=>$arrResult->lrno,
                'created_date'=>date('d-M-y',strtotime($arrResult->royal_date)),
                'royal_from'=>$arrResult->royal_from,
                'royal_to'=>$arrResult->royal_to,
                'weight1'=>$arrResult->weight1,
                'rate1'=>$arrResult->rate1,
                'total_amount'=>$total_amount,
                'consignor'=>$arrResult->consignor1,
                'consignee'=>$arrResult->consignee1
            );
            
        }
        
        echo json_encode($arrData); exit;
        //return view('pages.admin.view_bills_create_bill');
    }

    public function downloadPDF($id){

        $arrResult = BillInformation::find($id);
        if(!empty($arrResult)){

            $arrayPDF['arrayPDF'] = array(
              'id' => $arrResult->id,
              'client_name' => $arrResult->client_name,
              'bill_no' => $arrResult->bill_no,
              'send_email_id' => $arrResult->send_email_id,
              'bill_date' => getDateFormate($arrResult->bill_date),
              'bill_information_data' => $arrResult->bill_information_data,
              'total_amount_rupees' => $arrResult->total_amount_rupees,
              'total_amount' => $arrResult->total_amount,
              'created_at' => $arrResult->created_at
            );

        }

        $pdf = PDF::loadView('pages.admin.billing.view_bills_pdf_data', $arrayPDF);
        $pdf->download('bill_'.$arrResult->bill_no.".pdf");
    }

     public function sendMailProcess(Request $request, $id)
    {
        $validated = $request->validate([
            'send_email_id' => 'required',
        ]);
        $arrResult = BillInformation::find($id);
        if($request->has('send_email_id')){
            
            $arrResult->send_email_id = $request->send_email_id;
            $arrResult->save(); // update email id
            $email_to = $request->input('send_email_id');
            // send email process start

            $data["email"]=trim($email_to);
            $data["client_name"]=$arrResult->client_name;
            $data["subject"]="Bill / Invoice From Royal Road Ways";
            $data["bill_no"]=$arrResult->bill_no;

            //PDF DATA

            $arrayPDF['arrayPDF'] = array(
              'id' => $arrResult->id,
              'client_name' => $arrResult->client_name,
              'bill_no' => $arrResult->bill_no,
              'send_email_id' => $arrResult->send_email_id,
              'bill_date' => getDateFormate($arrResult->bill_date),
              'bill_information_data' => $arrResult->bill_information_data,
              'total_amount_rupees' => $arrResult->total_amount_rupees,
              'total_amount' => $arrResult->total_amount,
              'created_at' => $arrResult->created_at
            );

            $pdf = PDF::loadView('pages.admin.billing.view_bills_pdf_data', $arrayPDF);
     
            try{
                
                Mail::send('pages.admin.lrdata.lrmail-body', $data, function($message)use($data,$pdf) {
                $message->to($data["email"], $data["client_name"])
                ->subject('Bill / Invoice From Royal Road Ways')
                ->bcc('royalroadwaysftp@gmail.com','RoyalRoadWays')
                ->replyTo('royalroadways55@gmail.com', 'RoyalRoadWays')
                ->attachData($pdf->output(), 'Bill_'.date('d_m_Y')."_invoice.pdf");
                });
                
            }catch(JWTException $exception){
                $this->serverstatuscode = "0";
                $this->serverstatusdes = $exception->getMessage();
            }
            if (Mail::failures()) {
                 $this->statusdesc  =   "Error sending mail";
                 $this->statuscode  =   "0";
     
            }else{
     
               $this->statusdesc  =   "Message Sent Succesfully";
               $this->statuscode  =   "1";
            }

            $result = "error";
            $message = "Oops Somthing Wrong to Update pls Try Again";
            if($this->statuscode == 1){
              $result = "success";
              $message = "Message sent Succesfully";
            }
            return redirect()->back()->with($result,$message);
          // send email process start
        }
    }
}
