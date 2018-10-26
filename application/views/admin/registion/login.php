<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN""http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="vi">
<head>
	<base href="<?php echo base_url(); ?>" />
    <link rel="shortcut icon" href="templates/images/favicon.ico" type="image/x-icon">
    <meta name="viewport" content="width=device-width, initial-scale=1">      
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Quản trị CI-Web</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"/>   
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.min.css">
    <link rel="stylesheet" href="//d2d3qesrx8xj6s.cloudfront.net/dist/bootsnipp.min.css?ver=872ccd9c6dce18ce6ea4d5106540f089">    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <style>
        .modal-header{
            color: #31708f;
            background-color: #d9edf7;
            border-color: #bce8f1;
        }
    </style>
</head>
<body>
    <div class="container">    
    <div id="loginbox" style="margin-top:50px;" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">                    
        <div class="panel panel-info" >
            <div class="panel-heading">
                <div class="panel-title">Đăng Nhập Quản Trị</div>
                <div style="float:right; font-size: 80%; position: relative; top:-10px"><a href="#" data-toggle="modal" data-target="#myModal" title="Nhập email quản trị để lấy lại mật khẩu hệ thống.">Quên mật khẩu?</a></div>
            </div>     
            <?php if($this->session->flashdata('sessionErrorLoginAdmin')){ ?>
                <div class="alert alert-danger alert-dismissable fade in" style="margin:15px; padding-top:5px; padding-bottom: 5px;">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Note: </strong> <?php echo $this->session->flashdata('sessionErrorLoginAdmin'); ?>
                </div>                
            <?php } ?>
            <div style="padding-top:20px" class="panel-body" >

                <div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>                    
                <form id="loginform" class="form-horizontal" role="form" method="post">
                            
                    <div style="margin-bottom: 25px" class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                        <input id="login-username" type="text" class="form-control" name="username" value="" placeholder="Tài khoản quản trị" required>                                        
                    </div>
                        
                    <div style="margin-bottom: 25px" class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                        <input id="login-password" type="password" class="form-control" name="password" placeholder="Mật khẩu quản trị" required>
                    </div>                    

                    <div style="margin-top:10px" class="form-group">
                        <!-- Button -->

                        <div class="col-sm-12 controls">                        
                            <input type="button" id="btn-login" name="loginAdmin" class="btn btn-success" title="Đăng nhập hệ thống" onclick="frmLogin();" value="Đăng nhập" autofocus/>
                        </div>
                    </div>

                    <div style="float:right; font-size: 80%; position: relative; top: -25px;">
                        <a href="#" data-toggle="tooltip" data-placement="right" title="Bạn phải nhập tên người dùng và mật khẩu đúng!!">Giúp đỡ?</a></div>

                    <div class="form-group">
                        <div class="col-md-12 control">
                            <div style="border-top: 1px solid#888; padding-top:15px; font-size:85%" >
                                Copyright 2018 - 2019 © Thiết kế bởi  
                            <a href="https://tranthebao.wordpress.com" target="_blank">WebSaiGon.Com
                            </a>
                            </div>
                        </div>
                    </div>

                </form>
            </div>                     
        </div>  
    </div>
    
    <!-- Modal -->
    <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog">        
          <!-- Modal content-->
          <div class="modal-content">
            <form name="frmForgetpass" id="frmForgetpass" method="post">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title">Nhận lại mật khẩu quản trị</h4>
                </div>
                <div class="modal-body">
                  <p>Nhập email của người quản trị trang này:<span style="color: red;"> * </span></p>
                  <div style="margin-bottom: 25px" class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                    <input id="emailgetpass" type="text" class="form-control" name="emailgetpass" placeholder="Email người quản trị" required>                                                                          
                </div>
                </div>
                <div class="modal-footer">                    
                    <input type="submit" class="btn btn-default" onclick="forget_password();" value="Gửi" />
                    <button type="button" class="btn btn-default" data-dismiss="modal">Hủy</button>
                </div>
            </form>  
          </div>
          
        </div>
    </div>
    
</div>
</body>
</html>
<script>   
    $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip();   
    });

    function forget_password(){
        var _email = $('#emailgetpass').val(); 
        if(_email){            
            $.ajax({
                type: 'post',
                url: '/admin/forgetpass',
                cache: false,
                data: {email: _email},
                success: function (data) {
                    var message = '';                  
                    if (data == '2') {
                        message = 'Gửi mã thành công tới mail của bạn. Vui lòng kiểm tra email!';
                    } else if (data == '1') {
                        message = 'Email bạn vừa nhập không phải của quản trị. Vui lòng nhập đúng email!';
                    } else if (data == '3') {
                        message = 'Gửi đến email thất bại. Vui lòng nhập lại!';
                    } else {
                        message = 'Bạn chưa nhập email. Vui lòng nhập lại!';
                    }
                    alert(message);                    
                    return false;
                }
            });   
        } else {
            return false;
        }
    }

    function frmLogin(){
        $('#loginform').submit();
    }
</script>