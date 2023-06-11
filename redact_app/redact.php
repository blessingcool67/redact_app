<?php
error_reporting(0);
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");



include('setting.php');


$text_check = strip_tags($_POST['documents']);


if($text_check ==''){

echo "<div  style='background:red;color:white;padding:10px;border:none;'>URL Link to Check Cannot be Empty</div><br>";
exit();
}



if($redact_access_token ==''){
echo "<div  style='background:red;color:white;padding:10px;border:none;'>Redact Access Token is Empty</div><br>";
exit();
}

 $data_param= '{"return_result":true,"debug":true,
"rules":["DATE_TIME","IP_ADDRESS","URL","EMAIL_ADDRESS","NRP","LOCATION","PERSON","PHONE_NUMBER","US_DRIVER_LICENSE","US_ITIN","US_PASSPORT","US_SSN","CREDIT_CARD","CRYPTO","IBAN_CODE","US_BANK_NUMBER"],
"text": "'.$text_check.'"}';




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




if($request_id !='' && $status != 'Success'){
echo "<div style='background:red;color:white;padding:10px;border:none;'>
 Sensitive Data Redaction Failed. Try Again.  Error: $summary  </div><br>";
exit();

}








if($request_id !='' && $status == 'Success' ){
echo "<div style='background:green;color:white;padding:10px;border:none;'>Patients Sensitive Data Redaction Successful</div><br>";
}
echo "<div class='well'>

<b>Original Text Content Before Redaction: </b>$text_check</br><br>
<b>Redacted Text:</b> $redacted_text<br>                              
</div>";



                    
foreach($json['result']['report']['recognizer_results'] as $row){

$field_type = $row['field_type'];
$score = $row['score'];
$percent =  $score * 100;
$percent2 ="$percent %";
$text = $row['text'];
$redacted = $row['redacted'];
if($redacted ==1){
$r = "<span style='color:green;font-size:16px'><b>1(True)</b></span>";
}else{

$r = "<span style='color:red;font-size:16px'><b>0(False)</b></span>";
}

$start = $row['start'];
$end = $row['end'];



echo "<div style='display:inline-block' class='xcx1 col-sm-3'>


<br>
<b style='font-size:16px;'>Field Type: $field_type</b> <br>
<b >Score:</b>   $score &nbsp;&nbsp;&nbsp;&nbsp;($percent2)<br>
<b >Text:</b>   $text<br>
<b >Redacted Status:</b>   $r<br>

<br>
</div>";



}


?>






<script type="text/javascript">  

$(document).ready(function(){

$('#loader1').fadeIn(400).html('<br><br><div style="background:purple;color:white;padding:10px;"><img src="ajax-loader.gif"> &nbsp; &nbsp;Please Wait,Initializing Patients Redact Data Statistics is being Loaded.</div>');


});



var docs = '<?php echo $text_check; ?>';

google.charts.load('current', {'packages':['corechart']});

google.charts.setOnLoadCallback(column_chart);
//google.charts.setOnLoadCallback(line_chart);
function column_chart() {

$('#loader1').fadeIn(400).html('<br><div style="background:#ddd;color:black;padding:10px;"><img src="ajax-loader.gif"> &nbsp; &nbsp;Please Wait, Statistics is being Loaded.</div>');

var res = $.ajax({
url: 'chart.php?docs='+docs,
dataType:"json",
async: false,
success: function(res)
{

  var options = {'title':' Patients Sensitive Redacted Data Over Time', 'width':800, 'height':400,
 series: {
            0: { color: 'purple' },
            1: { color: 'navy' },
          
          }
};


var data = new google.visualization.arrayToDataTable(res);
var chart = new google.visualization.ColumnChart(document.getElementById('columnchart_data'));
chart.draw(data, options);
$('#loader1').hide();

}
}).responseText;
}



google.charts.setOnLoadCallback(line_chart);
function line_chart() {


$('#loader2').fadeIn(400).html('<br><div style="background:#ddd;color:black;padding:10px;"><img src="ajax-loader.gif"> &nbsp; &nbsp;Please Wait, Statistics is being Loaded</div>');

var res1 = $.ajax({
url: 'chart.php?docs='+docs,
dataType:"json",
async: false,
success: function(res1)
{

  var options = {'title':'Patients Sensitive Redacted Data Over Time', 'width':800, 'height':400,
 series: {
            0: { color: '#800000' },
            1: { color: 'orange' },
          
          }
};


var data = new google.visualization.arrayToDataTable(res1);
var chart = new google.visualization.BarChart(document.getElementById('areachart_data'));
chart.draw(data, options);
$('#loader2').hide();

}
}).responseText;
}





google.charts.setOnLoadCallback(pie_chart);
function pie_chart() {


$('#loader3').fadeIn(400).html('<br><div style="background:#ddd;color:black;padding:10px;"><img src="ajax-loader.gif"> &nbsp; &nbsp;Please Wait,  Statistics is being Loaded</div>');

var res2 = $.ajax({
url: 'chart.php?docs='+docs,
dataType:"json",
async: false,
success: function(res2)
{

  var options = {'title':'Patients Sensitive Redacted Data Over Time', 'width':800, 'height':400,
 series: {
            0: { color: '#800000' },
            1: { color: 'orange' },
          
          }
};


var data = new google.visualization.arrayToDataTable(res2);
var chart = new google.visualization.PieChart(document.getElementById('piechart_data'));
chart.draw(data, options);
$('#loader3').hide();

}
}).responseText;
}






</script>


<br><br>
<div class='col-sm-12'>
<div id="loader1"></div>
    <div id="areachart_data"></div>

<div id="loader2"></div>
    <div id="columnchart_data"></div>



<div id="loader3"></div>
    <div id="piechart_data"></div>



    </div>



<div id="loader" class='res_center_css'></div>



<!--chart ends-->









