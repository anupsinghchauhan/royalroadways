<?php
use Illuminate\Support\Facades\Session;
//define('lr_mode', '0'); //Before April 2021
//define('lr_mode', '1'); // April 2021 - March 2022
//define('lr_mode', '2'); //April 2022 - March 2023
define('lr_mode', '3'); //April 2023 - March 2024

define('SIGNATURE','https://lh3.googleusercontent.com/-MqpInQs6_lA/Wz4VmqHX-vI/AAAAAAAAA6A/Rk-i_iq9qZk1VCV2AEtqpdp_5xcKEIzUgCLcBGAs/h120/sign.jpg');
define('WHATSAPP_IMAGE','http://royalroadways.in/assets/images/wassapp.png');

if(!function_exists('thePDFHeader')){
	function thePDFHeader()
	{
		$site_master_id = Session::get('site_master_id');

		if($site_master_id == 1){
			echo '<td style="width:55% ;text-align: right;font-family: Arial, sans-serif;font-size:12px;color: #fff">Subject to Ahmedabad Jurisdiction</td>
			<td style="width:20% ;text-align: right;font-family: Arial, sans-serif;font-size:12px;color: #fff">M. 9909378655</td>
			<td style="width:15%;text-align: right;font-family: Arial, sans-serif;font-size:12px;color: #fff"><img src="'.WHATSAPP_IMAGE.'"  width="20" height="20"/> 9824878655</td>';
		}
		if($site_master_id == 2){
			echo '<td style="width:50% ;text-align: right;font-family: Arial, sans-serif;font-size:12px;color: #fff">Subject to Rajkot Jurisdiction</td>
			<td style="width:25% ;text-align: right;font-family: Arial, sans-serif;font-size:12px;color: #fff">M. 9909378655</td>
			<td style="width:15%;text-align: right;font-family: Arial, sans-serif;font-size:12px;color: #fff"><img src="'.WHATSAPP_IMAGE.'"  width="20" height="20"/> 9925078655</td>';
		}
		
	}
}

if(!function_exists('theSiteName')){
	function theSiteName()
	{
		$site_master_id = Session::get('site_master_id');

		if($site_master_id == 1){
			echo 'Royal Roadways';
		}
		if($site_master_id == 2){
			echo 'Royal Logistics';
		}
		
	}
}

if(!function_exists('getBgColor')){
	function getBgColor()
	{
		$site_master_id = Session::get('site_master_id');

		if($site_master_id == 1){
			return '#3d468a';
		}
		if($site_master_id == 2){
			return '#28a745';
		}
		
	}
}

if(!function_exists('theSiteAddress')){
	function theSiteAddress()
	{
		$site_master_id = Session::get('site_master_id');

		if($site_master_id == 1){
			//echo 'F4-A-One Complex, Nr. Charterd, Opp: Khodal Hotal, Sarkhej - Bavla Road, Sanathal, Ahmedabad';
			echo '1, Kesar Park, NR. Jagruti School, Sarkhej, Ahmedabad, Gujarat, 382210';
		}
		if($site_master_id == 2){
			echo 'F-3, Amar Shraddha Complex, Nr. Rileance Petrol Pump, Kuwadva Road, Rajkot-Ahmedabad Highway, Maliyasan, Rajkot';
		}
		
	}
}

if(!function_exists('theGSTIN')){
	function theGSTIN()
	{
		$site_master_id = Session::get('site_master_id');

		if($site_master_id == 1){
			echo 'GSTIN : 24ASSPC4524D1Z1';
		}
		if($site_master_id == 2){
			echo 'Transport ID : 24BGEPC3419A1Z9';
		}
		
	}
}

if(!function_exists('theBankDetails')){
	function theBankDetails()
	{
		$site_master_id = Session::get('site_master_id');

		if($site_master_id == 1){
			echo 'Axis Bank: A/c No. : 917020060099832';
		}
		if($site_master_id == 2){
			echo 'Axis Bank: A/c No. : 921020047230545';
		}
		
	}
}

if(!function_exists('getDateFormate')){
	function getDateFormate($value='')
	{
		if($value!=""){
			return date('d M Y',strtotime($value));
		}else{
			return "";
		}
	}
}
if(!function_exists('all_truck_arr')){
	function all_truck_arr()
	{
		return array(
			'Gj 01 bv 2608'=>'Gj 01 bv 2608',
			'Gj 01 dx 9957'=>'Gj 01 dx 9957',
			'Gj 01 ct 6232'=>'Gj 01 ct 6232',
			'Gj 01 ft 5374'=>'Gj 01 ft 5374',
			'Gj 01 ft 6179'=>'Gj 01 ft 6179',
			'Gj 01 ht 8655'=>'Gj 01 ht 8655',
			'Gj 01 ht 3167'=>'Gj 01 ht 3167',
			'Gj 05 av 6597'=>'Gj 05 av 6597',
			'Gj 05 bt 3677'=>'Gj 05 bt 3677',
			'Gj 08 z 6707'=>'Gj 08 z 6707');
	}
}
if(!function_exists('all_truck_number_arr')){
	function all_truck_number_arr()
	{
		return array(
			'2608'=>'Gj 01 bv 2608',
			'9957'=>'Gj 01 dx 9957',
			'6232'=>'Gj 01 ct 6232',
			'5374'=>'Gj 01 ft 5374',
			'6179'=>'Gj 01 ft 6179',
			'8655'=>'Gj 01 ht 8655',
			'3167'=>'Gj 01 ht 3167',
			'6597'=>'Gj 05 av 6597',
			'3677'=>'Gj 05 bt 3677',
			'6707'=>'Gj 08 z 6707');
	}
}
if(!function_exists('getIndianCurrency')){
	function getIndianCurrency($number)
	{

		$decimal = round($number - ($no = floor($number)), 2) * 100;

		$hundred = null;

		$digits_length = strlen($no);

		$i = 0;

		$str = array();

		$words = array(0 => '', 1 => 'one', 2 => 'two',

			3 => 'three', 4 => 'four', 5 => 'five', 6 => 'six',

			7 => 'seven', 8 => 'eight', 9 => 'nine',

			10 => 'ten', 11 => 'eleven', 12 => 'twelve',

			13 => 'thirteen', 14 => 'fourteen', 15 => 'fifteen',

			16 => 'sixteen', 17 => 'seventeen', 18 => 'eighteen',

			19 => 'nineteen', 20 => 'twenty', 30 => 'thirty',

			40 => 'forty', 50 => 'fifty', 60 => 'sixty',

			70 => 'seventy', 80 => 'eighty', 90 => 'ninety');

		$digits = array('', 'hundred','thousand','lakh', 'crore');

		while( $i < $digits_length ) {

			$divider = ($i == 2) ? 10 : 100;

			$number = floor($no % $divider);

			$no = floor($no / $divider);

			$i += $divider == 10 ? 1 : 2;

			if ($number) {

				$plural = (($counter = count($str)) && $number > 9) ? 's' : null;

				$hundred = ($counter == 1 && $str[0]) ? ' and ' : null;

				$str [] = ($number < 21) ? $words[$number].' '. $digits[$counter]. $plural.' '.$hundred:$words[floor($number / 10) * 10].' '.$words[$number % 10]. ' '.$digits[$counter].$plural.' '.$hundred;

			} else $str[] = null;

		}

		$Rupees = implode('', array_reverse($str));

		$paise = ($decimal > 0) ? "." . ($words[$decimal / 10] . " " . $words[$decimal % 10]) . ' Paise' : '';

		return ($Rupees ? $Rupees . 'Rupees ' : '') . $paise;

	}
}
if(!function_exists('ArrFilters')){
	function ArrFilters()
	{
		$arrayRes = array();
		$arrayRes[0] = 'Before April 2021';
		for ($i=1; $i <= lr_mode; $i++) { 
			$fromdate = $todate = 0;
			$fromdate = 2020 + $i;
			$todate = ( 2020 + $i ) + 1;
			$arrayRes[$i] = 'April '.$fromdate .' - March '.$todate;
		}
		return $arrayRes;
	}
}