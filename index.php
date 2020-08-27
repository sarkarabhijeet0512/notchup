<?php
$data=file_get_contents('https://script.googleusercontent.com/macros/echo?user_content_key=qdlYByvmi_JCQiIAC0bhEUTfDYPklrHRQVq_4XgO4p7pCVtIgjA1leaSDZ45PRbDSzyOf7LtPTz40AoBtPd4UgSH8PGzTMwxm5_BxDlH2jW0nuo2oDemN9CCS2h10ox_1xSncGQajx_ryfhECjZEnC09Nb0QZ6ca_LU0vmo6mSiQ7SyFG3CgdL9-1Vgcha-TAYaAGhh-9xNG-9rMNEZHQRElvdDletx0&lib=MlJcTt87ug5f_XmzO-tnIbN3yFe7Nfhi6');
$decode=json_decode($data,true);
// $count=count($decode);

 $check=count($decode);
 

 ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1">
    <meta name="description" content="website">
    <meta name="author" content="Abhijeet Sarkar">

    <link rel="shortcut icon" type="image/x-icon" href="assets/favicon/favicon.ico">
    <title>NotchUp|Booking slot</title>

    <!-- CSS -->
    <link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/iconmoon/css/iconmoon.css" rel="stylesheet">
    <link href="assets/datepicker/css/datepicker.css" rel="stylesheet">
    <link href="css/custom.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- [if lt IE 9]>
        <script src="js/html5shiv.min.js"></script>
        <script src="js/respond.min.js"></script>
        <![endif] -->
<style>
 
</style>
</head>
<body class="fill-bg">
    <section class="login-wrapper register">
        <div class="inner">
            <div class="regiter-inner">
                <div class="login-logo"> <a href="#"><img src="images/logo.png"  class="img-responsive" alt=""></a> </div>
                <div class="head-block">
                    <h1>Register | Book Trial Slots</h1>
                </div> 
                <div class="cnt-block">
                    <form action="#" method="POST" class="form-outer">
                        <div class="row">
                            <div class="col-sm-6">
                                <input name="Parent_Name" type="text" placeholder="Parent's Name" required="required">
                            </div>
                            <div class="col-sm-6">
                                <input name="child_name" type="text" placeholder="Child's Name" required="required">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <span id="lblError" style="color: red"></span>
                                <input type="text" id="txtEmail" name="email" onkeyup="ValidateEmail()"  placeholder="Parent's Email ID"/ required="required">
                                
                            </div>    
                            <div class="col-sm-6">
                                    <input name="Country Code" type="tel" placeholder="+91" class="country-code" required="required" onKeyPress="if(this.value.length==5) return false;">
                                <input name="phone-no" type="number" placeholder="XXXXXX3210" class="phone-no" onKeyPress="if(this.value.length==10) return false;" required="required">
                                
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="clearfix"></div>
                                <div class="date">
                                    <input type='text' class="datepicker" placeholder="Date of birth" required="required"/>
                                    <span class="icon-calander-icon"></span> </div>
                            </div>
                            <div class="col-sm-6">
                                <select id="course" class="form-outer" required="required">
                                    <option value="0">Select Course Name </option>
                                    <?php 
                                    for ($i=0; $i <$check ; $i++) { 
                                        ?>
                                    <option value="<?php echo $decode[$i]['course_id']; ?>" id="course_name<?php echo $i; ?>" data-index="<?php echo $i; ?>"><?php echo $decode[$i]['course_name']; ?></option>
                                        

                                     <?php };?>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                    <select id="date" required="required">
                                        <option value="0" data-id>Date Slot (Select Course First)</option>
                                    </select>
                            </div>
                            <div class="col-sm-6">
                                    <select id="time" required="required">
                                        <option value="0">Time Slot (Select Date First)</option>
                                    </select>
                            </div>
                        <div id="loading" class="loader" ><img src='images/ajax-loader.gif' width="200" height="200"><br>Loading..</div>

                            <div class="button-outer col-sm-3" style="text-align: center;">
                            <button class="btn" type="reset"><span>Register now </span></button>
                            </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Optional JavaScript -->
	<script src="js/sweetalert2.all.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/datepicker/js/datepicker.js"></script>
    <script src="email_validation.js"></script>
    <script src="js/custom.js"></script>

    <script type="text/javascript">
        $(document).ready(function(){

            $("#course").change(function(){
                // var sub_id = $(this).val();
                var sub_index = $(this).children("option:selected").data('index');
                //var sub_index2 = $('#course_name').attr('data-index');
                // alert(sub_index);
                $.ajax({
                    url: 'api.php',
                    type: 'post',
                    data: {sub_id:sub_index},
                    dataType: 'json',
                    beforeSend: function(){
                         $("#loading").show();
                       },
                       complete: function(){
                         $("#loading").hide();
                       },
                    success:function(response){

                        var len = response.length;

                        $("#date").empty();
                        // $("#time").empty();
                        for( var i = 0; i<len; i++){
                            // var id = response[i]['id'];
                            var date = response[i]['date'];
                            // var date = response[i]['date'];
                            $("#date").append("<option>"+date+"</option>");
                            // $("#time").append("<option>"+time+"</option>");
                        }
                    }
                });
            });

            $("#date").change(function(){
                var time = $(this).val();
                var sub_index2 = $("#course").children("option:selected").data('index');
                // var sub_index2 = $(this).children("option:selected").data('id');
                $.ajax({
                    url: 'api.php',
                    type: 'post',
                    data: {time:time,sub_index2:sub_index2},
                    dataType: 'json',
                    beforeSend: function(){
                         $("#loading").show();
                       },
                       complete: function(){
                         $("#loading").hide();
                       },
                    success:function(response){
                        $("#time").empty();
                        if (response.length>0) {
                        var len = response.length;

                        
                        // $("#time").empty();
                        for( var i = 0; i<len; i++){
                            // var id = response[i]['id'];
                            var start_time = response[i]['start_time'];
                            var end_time = response[i]['end_time'];
                            var timestamp = response[i]['timestamp'];
                            // var date = response[i]['date'];
                            $("#time").append("<option value="+timestamp+">"+start_time+" to "+end_time+"</option>");
                             // $("#time").append("<option>"+time+"</option>");

                            }
                        }else{
                            $("#time").append("<option>NO Time Slot Available</option>");
                        }
                    }
                });

            });
            

        });
    </script>
<script>
	$('.btn').on('click', function(e) {
    e.preventDefault();
    // const href = $(this).attr('href')

    Swal.fire({
                    icon: 'success',
                    title: 'Thanks!',
                    text: 'Your Slot Has Been Booked!',
                    showConfirmButton: true,
                  }).then(function() {
                      window.location = 'index.php';
                  });

      })
  // })
			
</script>
</body>
</html>