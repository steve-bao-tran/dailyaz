/* general.js */
/**
 * Create 	: Steve Tran
 * Date 	: 10/03/2018
 * Email	: tranbaothe@gmail.com
 * Phone	: 0979 160 641
 * [description]  Javascript Administrator
 */

function ActiveUser(id, act){
	var x = confirm('Bạn muốn thay đổi trạng thái thành viên này?');
	if(x == true){
		window.location.href = '/admin/publish-user?user=' + id + '&act=' + act;
		exit();
	} else {
		return false;
	}
}

function DeleteUser(id){
	var x = confirm('Bạn muốn xóa thành viên này?');
	if(x == true){
		window.location.href = '/admin/del-user/' + id;
		exit();
	} else {
		return false;
	}	
}

function ActiveCustomer(id, act){
    var x = confirm('Bạn muốn thay đổi trạng thái khách hàng này?');
    if(x == true){
        window.location.href = '/admin/publish-customer?customer=' + id + '&act=' + act;
        exit();
    } else {
        return false;
    }
}

function DeleteCustomer(id){
    var x = confirm('Bạn muốn xóa khách hàng này?');
    if(x == true){
        window.location.href = '/admin/del-customer/' + id;
        exit();
    } else {
        return false;
    }   
}

function ActiveProduct(id, act){
	var x = confirm('Bạn muốn thay đổi trạng thái sản phẩm này?');
	if(x == true){
		window.location.href = '/admin/publish-product?pro=' + id + '&act=' + act;
		exit();
	} else {
		return false;
	}
}

function DeleteProduct(id){
	var x = confirm('Bạn muốn xóa sản phẩm này?');
	if(x == true){
		window.location.href = '/admin/del-product/' + id;
		exit();
	} else {
		return false;
	}	
}

function ActiveContent(id, act){
	var x = confirm('Bạn muốn thay đổi trạng thái nội dung này?');
	if(x == true){
		window.location.href = '/admin/publish-content?con=' + id + '&act=' + act;
		exit();
	} else {
		return false;
	}
}

function DeleteContent(id){
	var x = confirm('Bạn muốn xóa nội dung này?');
	if(x == true){
		window.location.href = '/admin/del-content/' + id;
		exit();
	} else {
		return false;
	}	
}

function ActiveCategory(id, act){
	var x = confirm('Bạn muốn thay đổi trạng thái danh mục này?');
	if(x == true){
		window.location.href = '/admin/publish-category?cat=' + id + '&act=' + act;
		exit();
	} else {
		return false;
	}
}

function DeleteCategory(id){
	var x = confirm('Bạn muốn xóa danh mục này?');
	if(x == true){
		window.location.href = '/admin/del-category/' + id;
		exit();
	} else {
		return false;
	}	
}

function ActiveStyle(id, act){
    var x = confirm('Bạn muốn thay đổi trạng thái phong cách này?');
    if(x == true){
        window.location.href = '/admin/publish-style?style=' + id + '&act=' + act;
        exit();
    } else {
        return false;
    }
}

function DeleteStyle(id){
    var x = confirm('Bạn muốn xóa phong cách này?');
    if(x == true){
        window.location.href = '/admin/del-style/' + id;
        exit();
    } else {
        return false;
    }   
}

function ActiveColor(id, act){
    var x = confirm('Bạn muốn thay đổi trạng thái màu sắc này?');
    if(x == true){
        window.location.href = '/admin/publish-color?color=' + id + '&act=' + act;
        exit();
    } else {
        return false;
    }
}

function DeleteColor(id){
    var x = confirm('Bạn muốn xóa màu sắc này?');
    if(x == true){
        window.location.href = '/admin/del-color/' + id;
        exit();
    } else {
        return false;
    }   
}

function ActiveEmail(id, act){
    var x = confirm('Bạn muốn thay đổi trạng thái thư điện tử này?');
    if(x == true){
        window.location.href = '/admin/publish-email?mail=' + id + '&act=' + act;
        exit();
    } else {
        return false;
    }
}

function DeleteEmail(id){
    var x = confirm('Bạn muốn xóa thư điện tử này?');
    if(x == true){
        window.location.href = '/admin/del-email/' + id;
        exit();
    } else {
        return false;
    }   
}

function checkUsername(value) {
    if (value != '') {
        $.ajax({
            type: "POST",
            url: "/admin/check-username",
            data: {username : value, usid: $('#usid').val()},
            success: function (data) {
                if (data == "1") {
                    // $.jAlert({
                    //     'title': 'Thông báo',
                    //     'content': 'Tên đăng nhập này đã có người sử dụng, vui lòng nhập kiểm tra lại và nhập số khác!',
                    //     'theme': 'default',
                    //     'btns': {
                    //         'text': 'Ok', 'theme': 'blue', 'onClick': function (e, btn) {
                    //             e.preventDefault();
                    //             $('#ususername').focus();
                    //             return false;
                    //         }
                    //     }
                    // });
                    alert('Tên đăng nhập này đã có người sử dụng, vui lòng nhập kiểm tra lại và nhập số khác!');
					$('#ususername').val('');
                    $('#ususername').focus();
                    return false;
                }
            },
            error: function () {
            }
        });
    }
}

function checkEmail(value) {
    if (value != '') {
        $.ajax({
            type: "POST",
            url: "/admin/check-email",
            data: {email: value, usid: $('#usid').val()},
            success: function (data) {
                if (data == "1") {                   
                    alert('Thư điện tử này đã có người sử dụng, vui lòng nhập kiểm tra lại và nhập email khác!');
                    $('#usemail').focus();
                    $('#usemail').val('');
                    return false;
                }
            },
            error: function () {
            }
        });
    }
}

function checkMobile(value) {
    if (value != '') {
        $.ajax({
            type: "POST",
            url: "/admin/check-mobile",
            data: {mobile: value, usid: $('#usid').val()},
            success: function (data) {
                if (data == "1") {                    
                    alert('Số điện thoại này đã có người sử dụng, vui lòng nhập kiểm tra lại và nhập số khác!');
                    $('#usmobile').focus();
                    $('#usmobile').val('');
                    return false;
                }
            },
            error: function () {
            }
        });
    }
}

function Notspace(e, t) {
    str = e.toLowerCase();
    document.getElementById(t).value = str.trim();
}

function ResetForm(f, e){
	$("#"+f).trigger('reset');
	$('#'+e).focus();
	return false;
}

function CancelForm(link){
	window.location.href = link;
	exit();
}

function SubmitFrm(e){
    if(e){
        $('#'+e).submit();
    }
    return false;
}

function DeleteObject(link, no){
    var x = confirm('Bạn chắc chắn muốn xóa?', 'OK', 'Cancel');
    if(x) {
        jQuery.ajax({
            type: "POST",
            url: "/admin/delete-object",
            data: {link: link, num: no},
            success: function (data) {
                if (data == '0') {               
                    alert('Xóa tập tin thành công!');
                    window.location.reload(true);
                } else if (data == '1') {
                    alert('Xóa tập tin thành công!');
                    window.location.reload(true);
                } else {
                    alert('Thất bại! Vui lòng thử lại.');
                    return false;
                }
            },
            error: function () {
            }
        });
    }
    return false;
}

function CreateDirectory(){
    var name = $('#namedirectories').val();
    var link = $('#parent').val();
    if(name){
        jQuery.ajax({
            type: "POST",
            url: "/admin/create-object",
            data: {link: link, name: name},
            success: function (data) {
                if (data == '1') {               
                    alert('Tạo thư mục thành công!');
                    window.location.reload(true);
                } else if (data == '0') {
                    alert('Thư mục đã tồn tại');
                    return false;
                } else {
                    alert('Thất bại! Vui lòng thử lại.');
                    return false;
                }
            },
            error: function () {
            }
        });
    } 
    return false;
}

function ChangeStatusOrder(oid, st = 0, name = ''){
    $('h4 span.order-code').text(name);
    $('#orderidmodal').val(oid);
    $('#status').val(st);
    if (st > 0) {                                       
        $('#statusorder option[value=' + st + ']').attr('selected','selected');
    }
}

function CallReason(val){    
    if (val == 98 || val == 99) {
        $('#show-reason').removeClass('hidden');
    } else {
        $('#show-reason').addClass('hidden');
    }               
}

function EmptyCheck() {
    if ($('#statusorder').val() == 98 || $('#statusorder').val() == 99) {
        if ($('#reasoncancel').val() == '') {
            $('#reasoncancel').focus();
            return false;
        } else {
            var x = confirm('Bạn có chắc muốn hủy đơn hàng này không??? (Lưu ý: Khi chuyển trạng thái này sẽ không thay đổi được nữa)');
            if (x == true) {
                $('#frmChangeStatusOrder').submit();
            } else {
                return false;
            }            
        }
    } else {
        var x = confirm('Bạn có chắc đơn hàng này hoàn thành??? (Lưu ý: Khi chuyển trạng thái này sẽ không thay đổi được nữa)');
        if (x == true) {
            $('#frmChangeStatusOrder').submit();
        } else {
            return false;
        }
    }               
}
