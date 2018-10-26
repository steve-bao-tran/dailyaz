<!-- Modal -->
<div class="modal fade" id="ModalLogin" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  	<div class="modal-dialog" role="document">
    	<div class="modal-content">

      		<div class="modal-header">
                <a data-toggle="collapse" data-parent="#accordion" href="#collapse1" style="text-decoration: none;" title="Click vào đây để mở/gấp khung nhập bên dưới">
        		  <h5 class="modal-title" id="exampleModalLabel">ĐĂNG NHẬP NẾU BẠN CÓ TÀI KHOẢN    <i class="fa fa-plus"></i></h5>                   
                </a>
        		<!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          			<span aria-hidden="true">&times;</span>
        		</button> -->
      		</div>

      		<div class="modal-body">
                <div id="collapse1" class="panel-collapse collapse in">                          
                    <div class="form-group">
                        <input type="text" class="input-form-custom form-control" name="m_username" id="m_username" placeholder="Tên đăng nhập / Email" required="required">
                    </div>

                    <div class="form-group">
                        <input type="password" class="input-form-custom form-control" name="m_password" id="m_password" placeholder="Mật khẩu" required="required">
                    </div>
                    
                    <div class="form-group">
                        <input type="hidden" name="m_control" id="m_control">
                        <input type="hidden" name="m_pid" id="m_pid">
                        <button type="submit" class="btn btn btn-primary" onclick="callLogin()">Đăng nhập & Tiếp tục</button>                            
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy bỏ</button>                            
                        <span class="pull-right">
                            <h6><a href="<?php echo base_url() ?>tai-khoan/quen-mat-khau" title="Lấy lại mật khẩu">Quên mật khẩu?</a></h6>
                            <h6><a href="<?php echo base_url() ?>tai-khoan/dang-ky" title="Đăng ký tài khoản mới">Hoặc tạo tài khoản</a></h6>
                        </span>
                    </div>
                   
                </div>               
      		</div>

            <div class="hidden" id="notify_me">
                <div class="modal-header">
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapse2" style="text-decoration: none;" title="Click vào đây để mở/gấp khung nhập bên dưới">
                      <h5 class="modal-title" id="exampleModalLabel">HOẶC CHỈ CẦN THÔNG TIN SAU    <i class="fa fa-plus"></i></h5>
                    </a>                
                </div>
                <div class="modal-body">
                    <div id="collapse2" class="panel-collapse collapse">                        
                        <span><small>Cho tôi biết số điện thoại hoặc thư điện tử của bạn</small></span>
                        <div class="form-group">
                            <input type="number" class="form-control" name="m_mobile" id="m_mobile" placeholder="Số điện thoại...">
                        </div>

                        <div class="form-group">
                            <input type="text" class="form-control" name="m_email" id="m_email" placeholder="Hoặc thư điện tử...">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn btn-primary" onclick="notifyToMe();">Gửi yêu cầu</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy bỏ</button>                           
                        </div>
                        
                    </div>
                </div>
            </div>
	      	<!-- <div class="modal-footer">
                <input type="hidden" name="control" id="control">
	        	<button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
	        	<button type="button" class="btn btn-primary">Đăng nhập</button>
	      	</div> -->
    	</div>
  	</div>
</div>

<!-- Loadding -->
<div id="showloading">
	<div class="loading_bg"></div>
	<span class="loading" style="display: none;"><i class="fa fa-circle-o-notch fa-spin"></i></span>
	<div class="showmsg"></div>
</div>