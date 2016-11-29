<?php

$data = json_decode($response);
foreach ($data as $subdata) { @$cnt++; }
if($cnt==3){ 
	 $returned_transref = $data->  {'TransactionId'}  .'<br>';
	 $returned_status   = $data->{'TransactionStatus'}.'<br>';
	 $returned_amount   = $data->{'TransactionAmount'}.'<br>';
	 $user_id.'<br>';
	 $post_id.'<br>';
	 $qty.'<br>';
	//always remember to cross-check the amount in your database with that returned by the webservice
	//provide service for successful transaction only if the amount returned by cashenvoy matches what you have in your db
} else {
	$error = $data->{'TransactionStatus'};
}
echo $status;

?>