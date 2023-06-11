<?php
error_reporting(0);


$text_check = strip_tags($_GET['docs']);

 $data_param= '{"return_result":true,"debug":true,
"rules":["DATE_TIME","IP_ADDRESS","URL","EMAIL_ADDRESS","NRP","LOCATION","PERSON","PHONE_NUMBER","US_DRIVER_LICENSE","US_ITIN","US_PASSPORT","US_SSN","CREDIT_CARD","CRYPTO","IBAN_CODE","US_BANK_NUMBER"],
"text": "'.$text_check.'"}';




include('setting.php');

$url ="https://redact.aws.us.pangea.cloud/v1/redact";

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, TRUE);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json', "Authorization: Bearer $redact_access_token"));  
curl_setopt($ch, CURLOPT_POSTFIELDS, $data_param);
//curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
 $output = curl_exec($ch); 


$http_status = curl_getinfo($ch, CURLINFO_HTTP_CODE);

// catch error message before closing
if (curl_errno($ch)) {
    //echo $error_msg = curl_error($ch);
}
curl_close($ch); 





if($output ==''){

echo "<div style='background:red;color:white;padding:10px;border:none;'>
 Please Ensure there is Internet Connections and Try Again</div><br>";
exit();
}


$json = json_decode($output, true);

$redacted_text = $json['result']['redacted_text'];
$request_id = $json['request_id'];
$summary = $json['summary'];
$status = $json['status'];





$data[] = array('Redact Text Data', 'Score(%)');

foreach($json['result']['report']['recognizer_results'] as $row){

$field_type = $row['field_type'];
$score = $row['score'];
$redact_text = $row['text'];
$redacted = $row['redacted'];

$start = $row['start'];
$end = $row['end'];
$percent =  $score * 100;

$redact_text2="$field_type ($redact_text)";

$data[] = array($redact_text2 ,(int)$percent);
}



echo json_encode($data);









