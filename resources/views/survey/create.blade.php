
@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
    <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />
<style>
    body {
    background: #eee
}

#regForm {
    background-color: #ffffff;
    margin: 0px auto;
    font-family: Raleway;
    padding: 40px;
    border-radius: 10px
}

#register {
    color: #6A1B9A
}

h1 {
    text-align: center
}

input {
    padding: 10px;
    width: 100%;
    font-size: 17px;
    font-family: Raleway;
    border: 1px solid #aaaaaa;
    border-radius: 10px;
    -webkit-appearance: none
}

.tab input:focus {
    border: 1px solid #6a1b9a !important;
    outline: none
}

input.invalid {
    border: 1px solid #e03a0666
}

.tab {
    display: none
}

button {
    background-color: #6A1B9A;
    color: #ffffff;
    border: none;
    border-radius: 50%;
    padding: 10px 20px;
    font-size: 17px;
    font-family: Raleway;
    cursor: pointer
}

button:hover {
    opacity: 0.8
}

button:focus {
    outline: none !important
}

#prevBtn {
    background-color: #bbbbbb
}

.all-steps {
    text-align: center;
    margin-top: 30px;
    margin-bottom: 30px;
    width: 100%;
    display: inline-flex;
    justify-content: center
}

.step {
    height: 40px;
    width: 40px;
    margin: 0 2px;
    background-color: #bbbbbb;
    border: none;
    border-radius: 50%;
    display: flex;
    justify-content: center;
    align-items: center;
    font-size: 15px;
    color: #6a1b9a;
    opacity: 0.5
}

.step.active {
    opacity: 1
}

.step.finish {
    color: #fff;
    background: #6a1b9a;
    opacity: 1
}

.all-steps {
    text-align: center;
    margin-top: 30px;
    margin-bottom: 30px
}

.thanks-message {
    display: none
}
</style>
<div class="container mt-5">
    <div class="row d-flex justify-content-center align-items-center">
        <div class="col-md-8">
            <form id="regForm">
                <h1 id="register">Survey Form</h1>
                <div class="all-steps" id="all-steps"> <span class="step">
                <i class="fa fa-user"></i></span> <span class="step"><i class="fa fa-map-marker"></i>
                </span> <span class="step"><i class="fa fa-shopping-bag">

                </i></span> <span class="step">
                <i class="fa fa-car"></i></span> <span class="step"><i class="fa fa-spotify"></i></span> 
                <span class="step"><i class="fa fa-mobile-phone"></i></span> </div>
                <div class="tab"> 
                    <h6>Full Name?</h6>
                    <p> <input placeholder="Name..." oninput="this.className = ''" name="fname" id="fname"></p>
                </div>
                <div class="tab">
                    <h6>Address </h6>
                    <p><input placeholder="Address" oninput="this.className = ''" name="Address" id="Address"></p>
                </div>

                <div class="tab">
                    <h6>E-mail </h6>
                    <p><input placeholder="E-Mail" oninput="this.className = ''" name="mail" id="mail"></p>
                </div>
               
                <div class="tab">
                    <h6>Password</h6>
                    <p><input type="password"  placeholder="Enter Password" oninput="this.className = ''" name="password" id="password"></p>
                </div>
                <div class="tab">
                    <h6>Date of Birth</h6>
                   
                    <p><input placeholder="Date of Birth" class="datepicker" data-date-format="mm/dd/yyyy" oninput="this.className = ''" name="dpirth" id="dpirth" width="270" ></p>
                </div>

                <div class="tab">
                    <h6>Other Information ?</h6>
                    <p><input placeholder="Other Information ?" oninput="this.className = ''" name="dpirth" id="dpirth"></p>
                </div>
                
                <div class="thanks-message text-center" id="text-message"> <img src="https://i.imgur.com/O18mJ1K.png" width="100" class="mb-4">
                    <h3>Thankyou for your feedback!</h3> <span>Thanks for your valuable information. It helps us to improve our services!</span>
                    
                </div>
                <div style="overflow:auto;" id="nextprevious">
                    <div style="float:right;"> 
                    <button type="button" id="prevBtn" onclick="nextPrev(-1)"><i class="fa fa-angle-double-left"></i></button>
                     <button type="button" id="nextBtn" onclick="nextPrev(1)"><i class="fa fa-angle-double-right"></i></button>
                     </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
        $('#datepicker').datepicker({
            uiLibrary: 'bootstrap'
        });
    </script>
<script>
     $(document).ready(function(){
        $('.datepicker').datepicker({
    format: 'mm/dd/yyyy',
    startDate: '-3d'
});
     });
   var currentTab = 0;
document.addEventListener("DOMContentLoaded", function(event) {


showTab(currentTab);

});

function showTab(n) {
    var x = document.getElementsByClassName("tab");
x[n].style.display = "block";
if (n == 0) {
document.getElementById("prevBtn").style.display = "none";
} else {
document.getElementById("prevBtn").style.display = "inline";
}
if (n == (x.length - 1)) {
document.getElementById("nextBtn").innerHTML = '<i class="fa fa-angle-double-right"></i>';
} else {
document.getElementById("nextBtn").innerHTML = '<i class="fa fa-angle-double-right"></i>';
}
fixStepIndicator(n)
   if(n===5)
   {
  
    var fullname=$('#fname').val();
    var Address=$('#Address').val();
    var password=$('#password').val();
    var dpirth=$('#dpirth').val();
    var mail=$('#mail').val();

    $.ajax({
        type: "GET",
                url: "/createnewsurvey",
                dataType: "json",
                data:{
        "_token": "{{ csrf_token() }}",
        fullname:fullname,
        Address:Address,
        password:password,
        dpirth:dpirth,
        mail:mail
      },
     
      beforeSend: function() {    
     
              },
                success: function (response) {
                    url= "{{URL::to('/login')}}";
                    window.location.href = url;
                 
                }
       
           
    
   
});
   
   }


}

function nextPrev(n) {
var x = document.getElementsByClassName("tab");
if (n == 1 && !validateForm()) return false;
x[currentTab].style.display = "none";
currentTab = currentTab + n;
if (currentTab >= x.length) {

document.getElementById("nextprevious").style.display = "none";
document.getElementById("all-steps").style.display = "none";
document.getElementById("register").style.display = "none";
document.getElementById("text-message").style.display = "block";




}
showTab(currentTab);
}

function validateForm() {
var x, y, i, valid = true;
x = document.getElementsByClassName("tab");
y = x[currentTab].getElementsByTagName("input");
for (i = 0; i < y.length; i++) { if (y[i].value=="" ) { y[i].className +=" invalid" ; valid=false; } } if (valid) { document.getElementsByClassName("step")[currentTab].className +=" finish" ; } return valid; } function fixStepIndicator(n) { var i, x=document.getElementsByClassName("step"); for (i=0; i < x.length; i++) { x[i].className=x[i].className.replace(" active", "" ); } x[n].className +=" active" ; }
</script>
@endsection

