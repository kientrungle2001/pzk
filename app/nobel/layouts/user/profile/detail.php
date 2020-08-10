

<script src="<?=BASE_URL?>/3rdparty/Validate/dist/jquery.validate.js"></script>
<script src="<?=BASE_URL?>/js/loadding.js"></script>
<script type="text/javascript" src="<?=BASE_URL?>/3rdparty/jquery/jquery.form.min.js"></script>

<?php 
  $user=_db()->getEntity('User.Account.User');
  $userId= pzk_session()->getUserId();
  $user=$user->loadByUserId($userId);
 ?>
 <style>
  .error{
    color: red;
    font-weight: bold;
  }
  .ok{
    color: green;
    font-weight: bold;
  }
 </style>
<div class="user_profile">
  <div class="prf_area">

    <div class="pfr_infor">
      <div class="prf_label">
        <span class="prf_labels">Họ tên :</span>
        <span><?php  echo $user->getName();?></span>
      </div>
      <div class="prf_label">
        <span class="prf_labels">Nickname :</span>
        <span><?php  echo $user->getUsername();?></span>
      </div>
      <div class="prf_label">
        <span class="prf_labels">Ngày sinh :</span>
        <span><?php  echo $user->getBirthday();?></span>
      </div>
      <div class="prf_label">
        <span class="prf_labels">Giới tính :</span>
        <span><?php  $data->checkSex($user->getSex()) ;?></span>
      </div>
      <div class="prf_label2">
        <span class="prf_labels">Địa chỉ :</span>
        <span><?php  echo $user->getAddress();?></span>
      </div>
      <div class="prf_label3">
        <span class="prf_labels">Trường :</span>
        <span><?php  echo $user->getSchool();?></span>
      </div>
      <div class="prf_label">
        <span class="prf_labels">Thời hạn sản phẩm :</span>
        <span> 1 Năm</span>
      </div>
    </div>
    <div class="pfr_imgavatar">
      <div class="pfravatar">
        <div class="pfravatar_img">
          <img src="<?php  echo $user->getAvatar();?>" alt="" width="197px" height="192px">
        </div>
      </div>
      <div class="pfrbutton">
        <div class="pfrbutton1">
          <button class="pfrbtt_edita"  data-toggle="modal" data-target="#exampleModal" type="button">Thay Avatar</button>
        </div>
        <div class="pfrbutton2">
          <button class="pfrbtt_editp" data-toggle="modal" data-target="#editinforModal" type="button">Sửa thông tin</button>
        </div>
      </div>
    </div>
  
  </div>

<!-- Hiển thị Popup editavatar -->
<div id="exampleModal" class="modal fade" role="dialog" aria-labelledby="gridSystemModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content" style="background: linear-gradient(0deg,white, #fcbcb0);border-color: #81691c;">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="title_tooltip" id="gridSystemModalLabel">THAY ĐỔI AVATAR</h4>
        </div>
        <div class="modal-body">
          <div class="container-fluid">
            <div id="output"></div>
            
            <div id="mass_editA"></div>
            <div class="clear"></div>
            <div class="show_note">
            <form action="/Profile/editavatarPost" method="post" id="frmuploadavatar" enctype="multipart/form-data" runat="server">
            <div class="avatar">
              <img id="img_avatar" src="<?php echo $user->getAvatar(); ?>"alt="" width="150px" height="148px">
            </div>
                <span class="show_note">Upload ảnh lên từ máy của bạn:Chỉ chấp nhận định dạng ảnh .JPG và .JPEG dung lượng ảnh tối đa 488kb.</span>
                <input  style="float: left;" name="fileToUpload" id="fileToUpload" type="file" />
                <input type="submit"id="bttUploadA" value="Upload" />
                
              </form>
            </div>

          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->


<!-- Hiển thị Popup editinfor -->
<div id="editinforModal" class="modal fade" role="dialog" aria-labelledby="gridSystemModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content" style="background: linear-gradient(0deg,white, #fcbcb0);border-color: #81691c;">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4  class="title_tooltip" id="inforModalLabel">SỬA THÔNG TIN CÁ NHÂN</h4>
        </div>
        <div class="modal-body">
          <div class="container-fluid">
    
            <div class="editinfor_title">
                <a href="/profile/edit"><span class="txt_editinfor_title">THAY ĐỔI THÔNG TIN CÁ NHÂN </span> <br></a>
            </div>
            <div class="editinfor_title">
              <a href="/profile/changePassword"><span class="txt_editinfor_title">THAY ĐỔI MẬT KHẨU </span> </a><br>
            </div>
            <?php 
               $check=$data->checkIdFacebook();
                echo $check;
            ?> 
                
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->
    
</div>
<script>
$(document).ready(function() { 
  var options = { 
      target: '#output',   // target element(s) to be updated with server response 
      beforeSubmit: beforeSubmit,
      success: afterSuccess,  // post-submit callback 
      resetForm: true        // reset the form after successful submit 
    }; 
    
   $('#frmuploadavatar').submit(function() { 
      $(this).ajaxSubmit(options);        
      // always return false to prevent standard browser submit and page navigation 
      return false; 
    }); 
}); 
function afterSuccess()
{
  $('#bttUploadA').show(); //show submit button
  //$('#loading-img').hide(); //hide submit button
  //alert((new Date()).getMilliseconds());
  $('#img_avatar').prop('src', '/uploads/avatar/'+'<?php echo pzk_session("userId"); ?>'+'.jpg?t=' + (new Date()).getMilliseconds());
}

//function to check file size before uploading.
function beforeSubmit(){
    //check whether browser fully supports all File API
   if (window.File && window.FileReader && window.FileList && window.Blob)
  {
    
    if( !$('#fileToUpload').val()) //check empty input filed
    {
      $("#output").html("<span class='error'><span class='glyphicon glyphicon-remove'></span>Bạn chưa chưa chọn file ảnh</span>");
      return false
    }
    
    var fsize = $('#fileToUpload')[0].files[0].size; //get file size
    var ftype = $('#fileToUpload')[0].files[0].type; // get file type
    

    //allow only valid image file types 
    switch(ftype)
        {
            case 'image/png': case 'image/gif': case 'image/jpeg': case 'image/pjpeg':
                break;
            default:
                $("#output").html("<span class='error'><span class='glyphicon glyphicon-remove'></span>Bạn chỉ được phép upload file ảnh!</span>");
        return false
        }
    
    //Allowed file size is less than 1 MB (1048576)
    if(fsize>500000) 
    {
      $("#output").html("<span class='error'><span class='glyphicon glyphicon-remove'></span>Bạn chỉ được upload file ảnh có kích thước tối đa 488kb !</span>");
      return false
    }
        
    $('#bttUploadA').hide(); //hide submit button
    //$('#loading-img').show(); //hide submit button
    $('#output').html("<span class='ok'><span class='glyphicon glyphicon-ok'></span>Upload avatar thành công !</span>");  
  }
  else
  {
    //Output error to older browsers that do not support HTML5 File API
    $("#output").html("Please upgrade your browser, because your current browser lacks some new features we need!");
    return false;
  }
}

</script>
