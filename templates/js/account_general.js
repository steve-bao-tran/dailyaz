/* general.js */
/**
 * Create 	: Steve Tran
 * Date 	: 10/03/2018
 * Email	: tranbaothe@gmail.com
 * Phone	: 0979 160 641
 * [description]  Javascript Account
 */
function checkUsername(value) {
    if (value != '') {
        $.ajax({
            type: "POST",
            url: siteUrl + 'user/check-username',
            data: {username : value},
            success: function (data) {
                if (data == "1") {                    
                    alert('Tên đăng nhập này đã có người sử dụng, vui lòng nhập kiểm tra lại và nhập tên khác!');
					$('#usUsername').val('');
                    $('#usUsername').focus();
                    return false;
                }
            },
            error: function () {
            }
        });
    }
}

function checkIfMailExisted(value, str) { 
	// var filter = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
	var pattern = new RegExp(/^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/i);
    if(value && pattern.test(value)){
    	$.ajax({
            type: "POST",
            url: siteUrl + 'user/check-email',
            data: {email : value},
            success: function (data) {
                if (data == "1") {                    
                    alert('Email này đã có người sử dụng, vui lòng nhập kiểm tra lại và nhập email khác!');
					$('#'+str).val('');
                    $('#'+str).focus();
                    return false;
                }
            },
            error: function () {
            }
        });
    }
}

function CallNext(e) {
	$('#'+e).click();
}

function PreviewImgAvatar(event, obj) {
    var output = document.getElementById(obj);
    output.src = URL.createObjectURL(event.target.files[0]);
    $(output).parent().parent().removeClass( "hidden" );
}

function RemoveImg(img, e, f = '', ed = false) {
	if(ed == true) {
		if($('#'+f).val() != ''){
			$.ajax({
	            type: 'post',
	            url: siteUrl + 'user/delete-avatar-user',
	            cache: false,
	            dataType: 'text',
	            data: { image:$('#'+f).val()},
	            success: function (data) {
	                var message = '';                  
	                if (data == '1') {
	                    message = 'Xóa ảnh thành công!';
	                    $("#"+f).val("");
	                } else {
	                    message = 'Xóa ảnh không thành công. Vui lòng thử lại!';
	                }
	                // alert(message);
                    $.jAlert({
                        'title': 'Thông báo',
                        'content': message,
                        'theme': 'default',
                        'btns': {
                            'text': 'Ok', 'theme': 'blue', 'onClick': function (e, btn) {
                                e.preventDefault();                                
                                return false;
                            }
                        }
                    });
	            }
	        });
		}
	}
	$("."+img).addClass('hidden');
	$("#"+e).val("");
}

function ChangeStyle(e, t) {
    switch (t) {
        case 1:
            document.getElementById(e).style.border = "1px #2F97FF solid";
            break;
        case 2:
            document.getElementById(e).style.border = "1px #CCC solid";
            break;
        default:
            document.getElementById(e).style.border = "1px #2F97FF solid"
    }
}

function addCart(pid) {
    showLoading();

    var qty = 1;
    if ($('#quantity')[0]) {
        qty = $('#quantity').val();
    }

    $.ajax({
        type: "POST",
        dataType: "json",
        url: siteUrl + 'showcart/add',       
        data: {pid: pid, qty: qty},
        success: function (result) {
            // console.log(result); 
            hideLoading();           
            if (result.error == false) {
                $('.num').text('(' + result.num + ')');
            }
            if (result.message != '') {
                // var type = result.error == true ? 'alert-danger' : 'alert-success';
                // showMessage(result.message, type);
                location.reload();
            }
        },
        error: function () {
        }
    });
}

function buyNow(pid) {
    showLoading();
    var qty = 1;
    if ($('#quantity')[0]) {
        qty = $('#quantity').val();
    }
    $.ajax({
        type: "POST",
        dataType: "json",
        url: siteUrl + 'showcart/add',       
        data: {pid: pid, qty: qty},
        success: function (result) {
            // console.log(result); 
            hideLoading();           
            if (result.error == false) {
                $('.num').text('(' + result.num + ')');
            }
            if (result.message != '') {
                // var type = result.error == true ? 'alert-danger' : 'alert-success';
                // showMessage(result.message, type);
                // location.reload();
                window.location.href = siteUrl + 'gio-hang';
            }
        },
        error: function () {
        }
    });
}

function delCart(pid) {
    $.jAlert({
        'title': 'Thông báo',
        'content': 'Bạn muốn xóa sản phẩm này trong giỏ hàng của bạn?',
        'theme': 'default',
        'btns': {
            'text': 'Ok', 'theme': 'blue', 'onClick': function (e, btn) {
                if (btn.closeAlert){
                    return window.location.href = siteUrl + 'showcart/del-cart/' + pid;
                    exit();
                } else {               
                    e.preventDefault();                                
                    return false;
                }
            }
        }
    });
}

function updateCart(pid, no = 0) {
    showLoading();    
    var qty = parseInt($('#qty_' + pid).val());
    var content = '';
    var msg = false;
    if (no == 0) {
        if (qty < 1) {
            msg = true;
            content = 'Số lượng sản phẩm không thể nhập dưới 1!!';
        }         
    } else {
        if (qty + no < 1) {
            msg = true;
            content = 'Số lượng sản phẩm không thể giảm dưới 1!!';
        }
    }

    if (msg == true) {
        $.jAlert({
            'title': 'Thông báo',
            'content': content,
            'theme': 'default',
            'btns': {
                'text': 'OK', 'theme': 'blue', 'onClick': function (e, btn) {
                    e.preventDefault();
                    if (no == 0) {
                        location.reload();
                    }
                    return false;
                }
            }
        });
    } else {
        $.ajax({
            type: "POST",
            dataType: "json",
            url: siteUrl + 'showcart/update-cart',       
            data: {pid: pid, qty: qty, no: no},
            success: function (result) {
                //console.log(result); 
                hideLoading();           
                if (result.error == false) {
                    $('.num').text('(' + result.num + ')');
                }
                if (result.message != '') {
                    // var type = result.error == true ? 'alert-danger' : 'alert-success';
                    // showMessage(result.message, type);
                    location.reload();
                }
            },
            error: function () {
            }
        });
    }
}

function ContinueCheckout() {
    if ($('#createacc').is(':checked')) {
        window.location.href = siteUrl + 'dat-hang/co-tao-tai-khoan';
        exit();
    } else {
        window.location.href = siteUrl + 'dat-hang/khong-tao-tai-khoan';
        exit();
    }
}

function SubmitCancelOrder(e) {
    if (e != '') {
        if ($('#reasoncancel').val() != '') {
            $( "#"+ e).submit();
        } else {
            $('#check_reason').removeClass('hidden');
            $('#reasoncancel').focus();
            return false;
        }        
    } else {
        return false;
    }
}

function addFav(pid, user = 0) {
    showLoading();
    if (user <= 0) {
        hideLoading();
        showModal(pid, 1);
        return false;
    } else {
        $.ajax({
            type: "POST",
            dataType: "text",
            url: siteUrl + 'product/addtofav',
            data: {pid: pid},
            success: function (result) {
                hideLoading();                
                if (result == '1') {                    
                    $.jAlert({
                        'title': 'Thông báo',
                        'content': 'Thêm sản phẩm vào danh sách yêu thích thành công!',
                        'theme': 'default',
                        'btns': {
                            'text': 'Ok', 'theme': 'blue', 'onClick': function (e, btn) {
                                e.preventDefault();
                                location.reload();                                
                                return false;
                            }
                        }
                    }); 
                } else if (result == '2') {
                    $.jAlert({
                        'title': 'Thông báo',
                        'content': 'Sản phẩm này đã có trong danh sách yêu thích của bạn!',
                        'theme': 'default',
                        'btns': {
                            'text': 'Ok', 'theme': 'blue', 'onClick': function (e, btn) {
                                e.preventDefault();
                                location.reload();                               
                                return false;
                            }
                        }
                    });                    
                } else {
                    alert('Có lỗi xảy ra. Vui lòng thử lại!'); 
                }           
            },
            error: function () {
                // alert('Có lỗi xảy ra. Vui lòng thử lại!'); 
            }
        });
    }   
}

function notifyMe(pid, user = 0) {
    showLoading();
    if (user <= 0) {
        hideLoading();
        showModal(pid, 2);
        return false;
    } else {
        $.ajax({
            type: "POST",
            dataType: "text",
            url: siteUrl + 'product/notifytome',
            data: {pid: pid},
            success: function (result) {                
                if (result == '1') {
                    hideLoading();                   
                    $.jAlert({
                        'title': 'Thông báo',
                        'content': 'Cảm ơn bạn, khi nào có hàng chúng tôi sẽ sớm thông báo đến bạn qua thư điện tử hoặc số điện thoại!',
                        'theme': 'default',
                        'btns': {
                            'text': 'Ok', 'theme': 'blue', 'onClick': function (e, btn) {
                                e.preventDefault();
                                location.reload();                                
                                return false;
                            }
                        }
                    });
                } else {
                    location.reload();
                    alert('Không thể đặt lịch tư vấn cho bạn lúc này. Vui lòng thử lại!');
                }
            },
            error: function () {
                alert('Có lỗi xảy ra. Vui lòng thử lại!');
            }
        });
    }    
}

function callMe(pid, user = 0) {
    showLoading();
    if ($('#callmyphone').val() == '') {
        hideLoading();
        $.jAlert({
            'title': 'Thông báo',
            'content': 'Vui lòng nhập số điện thoại của bạn!!',
            'theme': 'default',
            'btns': {
                'text': 'Ok', 'theme': 'blue', 'onClick': function (e, btn) {
                    e.preventDefault();
                    $('#callmyphone').val('');                   
                    $('#callmyphone').focus();                                
                    return false;
                }
            }
        });
        return false;
    } else {
        $.ajax({
            type: "POST",
            dataType: "text",
            url: siteUrl + 'product/callme',
            data: {pid: pid, mobile: $('#callmyphone').val(), user: user},
            success: function (result) {
                hideLoading();                                
                if (result == '1') {                    
                    $.jAlert({
                        'title': 'Thông báo',
                        'content': 'Gửi yêu cầu tư vấn sản phẩm này thành công. Cảm ơn bạn đã liên hệ với chúng tôi!!',
                        'theme': 'default',
                        'btns': {
                            'text': 'Ok', 'theme': 'blue', 'onClick': function (e, btn) {
                                e.preventDefault();                                
                                return false;
                            }
                        }
                    }); 
                } else {
                    $.jAlert({
                        'title': 'Thông báo',
                        'content': 'Có lỗi xảy ra. Vui lòng thử lại!',
                        'theme': 'default',
                        'btns': {
                            'text': 'Ok', 'theme': 'red', 'onClick': function (e, btn) {
                                e.preventDefault();
                                $('#callmyphone').val('');                   
                                $('#callmyphone').focus();                               
                                return false;
                            }
                        }
                    });
                }           
            },
            error: function () {
                // alert('Có lỗi xảy ra. Vui lòng thử lại!'); 
            }
        });
    }
}

function notifyToMe() {
    var mobile = $('#m_mobile').val();
    var email = $('#m_email').val();
    var pid = $('#m_pid').val();

    if (mobile != '' || email != '') { 
        $.ajax({
            type: "POST",
            dataType: "text",
            url: siteUrl + 'product/notifytome',
            data: {pid: pid, mobile: mobile, email: email},
            success: function (res) {                
                if (res == '1') {
                    $('#ModalLogin').modal('hide');
                    hideLoading();                   
                    $.jAlert({
                        'title': 'Thông báo',
                        'content': 'Cảm ơn bạn, khi nào có hàng chúng tôi sẽ sớm thông báo đến bạn qua thư điện tử hoặc số điện thoại!',
                        'theme': 'default',
                        'btns': {
                            'text': 'Ok', 'theme': 'blue', 'onClick': function (e, btn) {
                                e.preventDefault();                                
                                return false;
                            }
                        }
                    });
                } else {
                    alert('Không thể liên hệ lúc này. Vui lòng thử lại!');
                } 
            },
            error: function () {
                alert('Có lỗi xảy ra. Vui lòng thử lại!');
            }
        });
    } else {
        // alert('Vui lòng nhập số điện thoại hoặc email của bạn!!');
        $('#m_mobile').focus();
        return false;
    }
}

function callLogin() {
    showLoading();
    var username = $('#m_username').val();
    var password = $('#m_password').val();  
    if (username != '') {
        if (password != '') {
            $.ajax({
                type: "POST",
                dataType: "json",
                url: siteUrl + 'user/ajax-signin',       
                data: {username: username, password: password},
                success: function (resp) {
                    // console.log(resp);                         
                    if (resp.error == false) {
                        hideLoading();
                        var control = $('#m_control').val();
                        var pid = $('#m_pid').val();
                        $('#ModalLogin').modal('hide');
                        if (control == 1) {                            
                            addFav(pid, resp.uid);                            
                        } else if (control == 2) {
                            notifyMe(pid, resp.uid);
                        }
                    } else {
                        showMessage(resp.msg, 'alert-danger');
                    }                
                },
                error: function () {
                }
            });
        } else {
            hideLoading();
            $('#m_password').focus();
            return false;
        }        
    } else {
        hideLoading();
        $('#m_username').focus();
        return false;
    }
}

function showLoading() {
    $('.loading').show();
    $('#showloading').show();
}

function hideLoading() {
    $('#showloading').hide();
}

function showMessage(message, type) {
    $('.loading').hide();
    // $('#myModal').modal('show');
    $('.showmsg').html('<p class="' + type + '">' + message + '</p>');
    $('.loading_bg').click(function () {
        hideLoading();
        $('.showmsg').empty();
        $('.loading_bg').unbind('click');
    });
}

function showModal(pid, e) {
    $('#ModalLogin').modal('show');
    if (e == 2) {
        $('#notify_me').removeClass('hidden');
    }
    $('#m_control').val(e);
    $('#m_pid').val(pid);       
}




