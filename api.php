<?php
date_default_timezone_set("Asia/Calcutta");
if (isset($_POST['sub_id'])) {
$subid=$_POST['sub_id'];
$users_arr = array();
$user_content_key=array();
$in_arr = [];
$data=file_get_contents('https://script.googleusercontent.com/macros/echo?user_content_key=qdlYByvmi_JCQiIAC0bhEUTfDYPklrHRQVq_4XgO4p7pCVtIgjA1leaSDZ45PRbDSzyOf7LtPTz40AoBtPd4UgSH8PGzTMwxm5_BxDlH2jW0nuo2oDemN9CCS2h10ox_1xSncGQajx_ryfhECjZEnC09Nb0QZ6ca_LU0vmo6mSiQ7SyFG3CgdL9-1Vgcha-TAYaAGhh-9xNG-9rMNEZHQRElvdDletx0&lib=MlJcTt87ug5f_XmzO-tnIbN3yFe7Nfhi6');
$decode=json_decode($data,true);
	foreach ($decode[$subid]['slots'] as $val) {
	$users_arr[]=array("date"=>date("d/m/Y",substr($val['slot'],0,-3)));
	} 
	$input=array_unique($users_arr, SORT_REGULAR);
	foreach ($input as $inpu) {
	$user_content_key[]=$inpu;
	}
	echo json_encode($user_content_key);
}
if (isset($_POST['time'])) {
$date=$_POST['time'];
$subid=$_POST['sub_index2'];
$arr = array();
$key=array();
$data=file_get_contents('https://script.googleusercontent.com/macros/echo?user_content_key=qdlYByvmi_JCQiIAC0bhEUTfDYPklrHRQVq_4XgO4p7pCVtIgjA1leaSDZ45PRbDSzyOf7LtPTz40AoBtPd4UgSH8PGzTMwxm5_BxDlH2jW0nuo2oDemN9CCS2h10ox_1xSncGQajx_ryfhECjZEnC09Nb0QZ6ca_LU0vmo6mSiQ7SyFG3CgdL9-1Vgcha-TAYaAGhh-9xNG-9rMNEZHQRElvdDletx0&lib=MlJcTt87ug5f_XmzO-tnIbN3yFe7Nfhi6');
$decode=json_decode($data,true);
	foreach ($decode[$subid]['slots'] as $val) {
	$key[]=array("date"=>date("d/m/Y",substr($val['slot'],0,-3)) , "time"=>substr($val['slot'],0,-3));
	}
	foreach ($key as $value) {
		if ($date == $value['date']) {	
		$start_time = date('H:i', $value['time']);

		$end_time_temp = ($value['time']) + 3600;
		$end_time = date('H:i', $end_time_temp);

		$cond_starttime=1597570217+60*60*4;
		 
		$cond_endtime=1597570217+60*60*24*7;
		if ($cond_starttime < $value['time'] && $value['time'] < $cond_endtime) {
		$arr[]=array("start_time"=> $start_time,"end_time"=> $end_time,"timestamp"=> $value['time']);
		}
		}
	} 
	echo json_encode($arr);
}
?>