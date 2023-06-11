<!DOCTYPE html>
<html lang="en">

<head>
 <title>Patients Sensistive Data Redaction System</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="keywords" content="Patients Sensitive Data Redaction System" />


<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="bootstrap.min.css">
<script src="jquery.min.js"></script>
<script src="bootstrap.min.js"></script>



<style>




.section_padding {
padding: 60px 40px;
}

.imagelogo_li_remove {
list-style-type: none;
margin: 0;
 padding: 0;
}

.imagelogo_data{
 width:120px;
 height:80px;
}



  .navbar {
    letter-spacing: 1px;
    font-size: 14px;
    border-radius: 0;
    margin-bottom: 0;
   background-color:purple;

    z-index: 9999;
    border: 0;
    font-family: comic sans ms;
//color:white;
  }



  
.navbar-toggle {
background-color:orange;
  }

.navgate {
padding:16px;color:white;

}



.navgate:hover{
 color: black;
 background-color: orange;

}


.navbar-header{
height:60px;
}

.navbar-header-collapse-color {
background:white;
}

.dropdown_bgcolor{

background: #800000;
color:white;
}

.dropdown_dashedline{
 border-bottom: 2px dotted white;
}

.navgate101:hover{
background:800000;
color:white;

}






.category_post{
background-color: #800000;
padding: 16px;
color:white;
font-size:14px;
border-radius: 15%;
border: none;
cursor: pointer;
text-align: center;
width:100%;
z-index: -999;
}
.category_post:hover {
background: black;
color:white;
}	




.category_post1{
background-color: purple;
padding: 16px;
color:white;
font-size:14px;
border-radius: 15%;
border: none;
cursor: pointer;
text-align: center;
width:100%;
z-index: -999;
}

.category_post1:hover {
background: black;
color:white;
}	


.xcx1{
background-color: #ddd;
padding: 2px;
color:black;
//font-size:14px;
border-radius: 10%;
border: none;
//cursor: pointer;
//text-align: center;
height:130px;

}
.xcx1:hover {
background: orange;
color:white;
}

</style>



 
</head>
<body>















<!--start left column all-->

    <div class="left-column-all left_shifting">

<!-- start column nav-->


<div class="text-center">
<nav class="navbar navbar-fixed-top">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navgator">
        <span class="navbar-header-collapse-color icon-bar"></span>
        <span class="navbar-header-collapse-color icon-bar"></span>
        <span class="navbar-header-collapse-color icon-bar"></span> 
        <span class="navbar-header-collapse-color icon-bar"></span>                       
      </button>
     
<li class="navbar-brand home_click imagelogo_li_remove" ><img class="img-rounded imagelogo_data" src="logo.png"></li>
    </div>
    <div class="collapse navbar-collapse" id="navgator">



      <ul class="nav navbar-nav navbar-right">

        <li class="navgate about_click">Patients Sensitive Data Redaction Analyzer</li>
       
       
        
        



      </ul>


    </div>
  </div>



</nav>


    </div><br /><br />

<!-- end column nav-->



	
<br>
<div class="rows">

<h2 style='color:fuchsia'><center>Patients Sensitive Data Redaction Analyzer  </center></h2>
<h4><center><b style='color:#800000'>Helping HealthCare Institutions to easily analyze and redacts Patients Documents for Sensitive data Extraction
Powered by Pangea Redact API</b></center></h4><br>





With Hundreds or Thousands of Sick Patients and Clinical Care Patients going to Hospital for Medical Care and Clinical Care respectively,
Most Healthcare institutions, Hospitals etc. often end up spending huge amount of  time on patient-related paperwork. This tends to create Monotony in the Works Tasks
especially in emergency critical situations.<br><br> 
I built <b>Patients Sensitive Data Redaction Analyzer</b> to help free up the Medical Staff to enable them focus better on patient care all powered by <b> Pangea Redact API</b>.<br>

With Integration of <b>Patients Sensitive Data Redaction Analyzer</b>, Medical Staffs can also improve their workflows and enhance productivity while protecting sensitive patient information.
<br<br>



<h3>What It Does</h3>

It uses <b>Pangea Redact API</b> to break down the Patients Documents into more <b>Simple, Easy, Understandble
and digestable form</b> in order to help <b>Detect, Analyze, extract and safeguard Patients sensitive data and control it from getting compromised.</b>
<br><br>
The <b>Medical Staff</b> can then remove <b>detected Patients Sensitive information</b> from documents to prevent data exposure.<br><br>


The Applications leverages <b>Google Statistical Graphs/Charts</b> to display <b>Graphical/Charts</b> 
Visualization of Patients Redacted Documents.




<div class="col-sm-1">

</div>

<div class="col-sm-10">


<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

<script>

$(document).ready(function(){
$('#documents_btn').click(function(){
		
var documents = $('.documents').val();


 if(documents==""){
alert('Please Enter Patients Text Documents.');

}


else{

$('#loader_o').fadeIn(400).html('<br><div style="color:black;background:#ddd;padding:10px;"><img src="ajax-loader.gif">&nbsp;Please Wait, Processing Patients Documents via Pangea Redact API</div>');
var datasend = {documents:documents};	
		$.ajax({
			
			type:'POST',
			url:'redact.php',
			data:datasend,
                        crossDomain: true,
			cache:false,
			success:function(msg){


                        $('#loader_o').hide();
				//$('#result_o').fadeIn('slow').prepend(msg);

$('#result_o').fadeIn('slow').html(msg);

			//$('#documents').val('');
			}
			
		});
		
		}
		
	})
					
});




</script>







<!-- form starts  -->




<div class="col-sm-12 form-group" style='background:#f1f1f1; padding:16px;color:black'>
<label> Patients Sample Text Documents For Redaction</label>

<br>



<textarea cols="5" rows="5" name="documents" id="documents" class="form-control documents" placeholder="Enter Text Documents">
I am Tony Clark. Am a Diabetic Patients from Texas, United State. Has been suffering this Sickness for Years.  My email is tonyclark@gmail.com. I am 25 Years Old. My Social Security Number is 555-50-1234. Drivers Licence Number is 0187689235. Banking Info is Bank of America. Phone number is (555) 555-1212</textarea>

            </div>



<div class="form-group">

                    <br>
<button type="button" id="documents_btn" class="fcss1"  >Analyze & Redact Documents</button><br><br>
<div id="loader_o"></div>

<div id="result_o" class="myform_o"></div>
<br />
</div>






<style>

.fcss{
padding: 10px;
  border: 2px solid #666;
  color: white;
  background-color: #800000;
}

.fcss:hover{
 color: black;
  background-color: orange;
}


.fcss1{
padding: 10px;
  border: 2px solid #666;
  color: white;
  background-color: purple;
}

.fcss1:hover{
 color: black;
  background-color: orange;
}



</style>




<br><br>

</div>



<!-- form ends  -->











</div>

<div class="col-sm-1">

</div>


<div>
   
<br><br><br><br><br>
</body>
</html>



















