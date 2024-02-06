<?php
namespace App\Exports;
  
use App\Models\Billing;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use DB; 
class BillingExport implements FromCollection, WithHeadings, WithMapping
{
    private $current_row = 1;
    private $request;

    public function __construct($request)
    {
        $this->request = $request;
    }

    public function headings():array{
        return[
            'No','LR No.','Truck No','Date','Email','Consignor','Consignee','Driver Details','From','To','Consignor Address','Consignor Address', 'Consignor GSTIN','Consignor GSTIN','To Pay - Paid','NOGSTC','Weight','Rate','Total freighty to opay','Net Amount','CDST','CGST','Total Amount'
        ];
    }
    public function collection()
    {

        $request = $this->request;
        //DB::enableQueryLog();
        $instance = Billing::when(!empty($request->get('pdf_txtSearchFrom')), function($instance) use ($request){
            return $instance->whereRaw("DATE(royal_date) >= '".date('Y-m-d',strtotime($request->get('pdf_txtSearchFrom'))) ."'");
        });
        $instance = $instance->when(!empty($request->get('pdf_txtSearchTo')) ,function($instance) use ($request) {
            return $instance->whereRaw("DATE(royal_date) <= '".date('Y-m-d',strtotime($request->get('pdf_txtSearchTo'))) ."'");
        });
        $instance = $instance->when(!empty($request->get('lr_current_year')),function ($instance) use ($request) {
            return $instance->whereRaw("YEAR(royal_date) = '".$request->get('lr_current_year') ."'");
        });
        $instance = $instance->when($request->get('lr_mode_txt')!="", function($instance) use ($request){
            return $instance->where('lr_mode',$request->get('lr_mode_txt') );
        });
        $instance = $instance->when($request->get('site_master_id_txt')!="", function($instance) use ($request){
            return $instance->where('site_master_id',$request->get('site_master_id_txt') );
        });
        return $instance->get();
        //dd(DB::getQueryLog());exit;
    }
    public function map($billing): array
    {
        return [
            $this->current_row++,
            $billing['lrno'],
            strtoupper($billing['truckno']),
            getDateFormate($billing['royal_date']),
            $billing['royal_email'],
            $billing['consignor1'],
            $billing['consignee1'],
            $billing['driver_details'],
            $billing['royal_from'],
            $billing['royal_to'],
            $billing['consignor_add_1'],
            $billing['consignor_add_2'],
            $billing['gstin1'],
            $billing['gstin2'],
            $billing['ToPayOrPaid'],
            $billing['nogstc1'],
            $billing['weight1'],
            $billing['rate1'],
            $billing['total_freighty_to_opay1'],
            $billing['royal_amount'],
            $billing['cdst'],
            $billing['sgst'],
            $billing['total_amount']
        ];
    }
}