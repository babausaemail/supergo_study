<?php
    //setcookie("testCookie", "kuCookie", time()+120, "/");
?>
<!DOCTYPE html>
<html lang="en">
    <head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link href="bootstrap-3.2.0-dist/css/bootstrap.min.css" rel="stylesheet">
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <style>
        .error {color:#ff0000;}
        .form-control { width: 60%; }
        input[name=colorkey] { width: 30%; }
    </style>
    </head>
    <body>
    <div class="container">
        <h1>PHP Form Validation Example</h1>
        <p class="error">*required field</p>
        <div class="row">
            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                <form role="form" id="ajaxForm" method="post" action="formValid.php" enctype="multipart/form-data">
                    <div class="form-group">
                        <span class="glyphicon glyphicon-user"> Name:</span>
                        <input type="text" class="form-control" name="Namekey" placeholder="Your Name"><span class="error">*</span><br>
                    </div>
                    <div class="form-group">
                        Color: <input type="color" class="form-control" name="colorkey" ><span class="error">*</span><br>
                    </div>
                    <div class="form-group">
                        date;  <input type="date"  class="form-control" name="datekey"><span class="error">*</span><br>
                    </div>
                    <div class="form-group">
                        Message: <textarea class="form-control" name="message" row="14" ></textarea><br>
                    </div>
                    <div class="form-group">
                        Upload File: <input type="file" class="form-control" name="file"><span class="error"></span><br>
                    </div>
                    <input type="submit" class="btn btn-info" value="Submit">
                </form>
            </div>
        </div>

        <h2></h2>
        <script>
            $(document).ready(function(){
                $("input[name='Namekey']").blur(function(){
                    isEmpty('Namekey', 'Empty' );
                });
                $("input[name='colorkey']").blur(function(){
                    isEmpty('colorkey', 'Error' );
                });
                $("input[name='datekey']").blur(function(){
                    isEmpty('datekey', 'Error' );
                });

                $('form#ajaxForm').on("submit", function(){
                    var url1=$(this).attr('action'),
                        type=$(this).attr('method'),
                        data=new FormData(document.getElementById('ajaxForm'));

                    $.ajax({
                        //async:false,
                        url:url1,
                        type:type,
                        data:data,
                        enctype: 'multipart/form-data',
                        processData: false,
                        contentType: false,
                        success: function(response) {
                            console.log(response);
                            response=JSON.parse(response);
                            $("input[name='Namekey']").next().text(response.nameValidMessage);
                            $("input[name='file']").next().text(response.uploadFileMessage);
                        }
                    });
                    return false;
                });
            });

            function isEmpty(nameKey, errorMessage){
                //alert(jQuery.type($("input[name="+nameKey+"]").val()));
                //alert($("input[name="+nameKey+"]").val());
                if($("input[name="+nameKey+"]").val()=="") {
                    $("input[name="+nameKey+"]").next().text(errorMessage);
                }else{
                    $("input[name="+nameKey+"]").next().text("Good");
                }
            }
        </script>
		<script src="bootstrap-3.2.0-dist/js/bootstrap.min.js"></script>
    </div>
    </body>
</html>