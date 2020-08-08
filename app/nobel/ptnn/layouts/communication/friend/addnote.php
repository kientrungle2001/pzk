
<style>
 #profilefriend
 {
  width: 100%;
  height: 800px;
  
  float: left;
 } 
 
 .prf_title
 {
  width: 100%;
  float: left;
  background-color: #008000;
  height: 30px;
  font-size: 10pt;
  text-align: center;
  color: #fff;
  margin: 10px 0;
 } 

 .prf_clear
 {
  padding-bottom: 20px;
 clear: both;
 color: #57970F;

 } 
.center_info_cus{float: left;}
.center_info_cus{margin-top: 10px; width: 540px;font-weight:normal;float: left; margin-left:2px; margin-bottom:15px; padding-right:10px;}
.list_test_cen_title_page{
    font-family: arial;
    height: 61px;      
}
.list_test_cen_icon_title{
    float: left;
    margin-right: 11px; 
}
.list_test_cen_wrap_head_title{
    padding: 10px;
}
.res_input {width:271px; height:25px; padding-left:5px; border:1px solid #b5b5b5; cursor:text; font-size:14px; border-radius:4px; background:url(http://data.tienganh123.com/images/v2/home/rs_bg_input.jpg) top repeat-x; color:#333;*padding-top:10px !important;-webkit-border-radius:4px;    -moz-border-radius:4px;}
</style>


<div id="profilefriend_right">
    <div class="prf_title">Chào mừng bạn đã ghé thăm góc học tập của tôi</div>
    <div class="prf_clear" style="width: 100%; height: 30px;"></div>

    <div class="prf_title" style="width:30%;">Ghi chép cá nhân</div>
     <div class="prf_clear" style="width: 100%; height: 30px;"></div>
   
<div class="center_info_cus clear">
    <div class="list_test_cen_title_page">
        <img class="list_test_cen_icon_title" src="/images/pr_list_title_icon.png">
        <div class="list_test_cen_wrap_head_title">
             <b>THÊM GHI CHÉP MỚI</b>                                   
        </div>

    </div>

        <form name="form1" method="post" action="">
        <div class="pne_pr_row">
            Tiêu đề: <input class="res_input" type="text" name="titlenote" id="note_title" value="">
        </div>
        <div id="blog_images_frame" style="clear: both;"></div>
        Nội dung: 
        <div class="form_add_note pne_ck_area">            
            
            <textarea id="addnote" name="contentnote" class="pne_ck_area_box" ></textarea>            
        </div>
        <input class="pne_st1_r_file_bt" type="button" id="note_back" value="Quay lại">
        <input class="pne_st1_r_file_bt" type="button" name="note_finish" id="note_finish" value="Hoàn thành">
        <input class="pne_st1_r_file_bt" type="button" id="note_reset" value="Làm lại">
<!--        <a href="javascript:;"><div class="pne_st1_r_file_bt">Làm lại</div></a>-->
    </form>
   
    <script type="text/javascript" src="../3rdparty/tinymce/js/tinymce/tinymce.min.js"></script>
  <script type="text/javascript">
        tinymce.init({
            selector: "#addnote",
            forced_root_block : "",
            force_br_newlines : true,
            force_p_newlines : false,
            relative_url: false,
            remove_script_host: false,
            plugins: [
                "lists  image charmap print preview anchor",
                "searchreplace visualblocks code fullscreen media",
                "insertdatetime media table contextmenu paste responsivefilemanager textcolor"
            ],

            toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | styleselect formatselect fontselect fontsizeselect | forecolor backcolor",
            entity_encoding : "raw",
            relative_urls: false,
            external_filemanager_path: "/3rdparty/Filemanager/filemanager/",
            filemanager_title:"Quản lý file upload" ,
            external_plugins: { "filemanager" :"/3rdparty/Filemanager/filemanager/plugin.min.js"},
            height: 100
        });
    </script>
    <script>
    $('#note_finish').click(function(){
      var notetitle= $('#note_title').val();
      var notecontent= tinyMCE.get('addnote').getContent();
     
       $.ajax({
            url:'../friend/PostUserNote',
            data:{
              notetitle: notetitle,
              notecontent:notecontent }, 
            success:function(result){
              
              window.location = "/friend/viewnote?member=<?php echo pzk_request()->getMember(); ?>";
                         
            }
          });
    });
    $('#note_reset').click(function()
    {
      $('#note_title').val('');
      tinyMCE.get('addnote').setContent('');
    });
    $('#note_back').click(function()
    {
      window.location="/friend/viewnote?member=<?php echo pzk_request()->getMember(); ?>";
    });
    </script>   
</div>




  </div>