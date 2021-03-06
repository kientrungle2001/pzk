<?php
function sw_get_current_weekday() {
    date_default_timezone_set('Asia/Ho_Chi_Minh');
    $weekday = date("l");
    $weekday = strtolower($weekday);
    switch($weekday) {
        case 'monday':
            $weekday = 'Thứ hai';
            break;
        case 'tuesday':
            $weekday = 'Thứ ba';
            break;
        case 'wednesday':
            $weekday = 'Thứ tư';
            break;
        case 'thursday':
            $weekday = 'Thứ năm';
            break;
        case 'friday':
            $weekday = 'Thứ sáu';
            break;
        case 'saturday':
            $weekday = 'Thứ bảy';
            break;
        default:
            $weekday = 'Chủ nhật';
            break;
    }
    return date('H:i d/m/Y').', '.$weekday;
}
?>
<style>
	.login-title{ color:#265B89; margin-top:7px; }
	.margin-top-33{ margin-top:33px;}
	.margin-top-30{ margin-top:30px;}
	.margin-top-20{ margin-top:20px;}
	.margin-top-5{margin-top:5px}
	.margin-top-10{margin-top:10px}
	.margin-top-3{margin-top:3px}
	.validate{ color:#b20000; font-weight:bold; }
	
	.icon-date{ margin-top: 32px; position: absolute; right: 20px; }
	
	input.error{ border: 1px solid #b20000 !important; }
	label.error{ margin-top:3px; color: #b20000;}
	.pd-5{ padding-left:5px; }
	select.error{ border: 1px solid #b20000 !important; }
	.date .col-xs-4{padding:0px 0px;}
	#registerForm{border-top:2px solid #265b89 !important; }
	#register_successful{display:none;}
	#register_successful11{display:none;}
</style>
<div id="search">

	<div class="row">
		<div class="col-xs-6">
			<span class="date_menu"><?=sw_get_current_weekday();?></span>
		</div>

		<div  class="col-xs-6">

            <div style="float: right; padding: 8px 0px; margin-right: 20px;">
                <?php if(pzk_session('userId') <= 0):?>
                	<a id="nobelLogin" href="javascript:void(0)" data-toggle="modal" data-target=".bs-example-modal-lg"><span class="pd-left-10"> Đăng nhập/ Đăng ký</span></a>
                <?php elseif(pzk_session('userId') >0 ):?>
                	<span  class="color-white user_name pd-left-10"> Xin chào ( <?php $data->displayChildren('[id=userAccountUser]') ?> )</span>
               	 	<a  href="<?=BASE_REQUEST?>/account/logout"><span>Thoát</span></a>
                <?php endif;?>
            </div>

            <div style="float: right; padding: 8px 0px;">
                <span style="color:white; float:left;"><strong>Tra từ</strong></span>
                <div class="pd-left-10 pd-right-20" style="float:left;">
                    <script type="text/javascript" src="<?=BASE_URL?>/js/configURL.js"></script>
                    <script type="text/javascript"> var edict_d = '-1'; var edict_fontsize = '5'; var edict_inputsize = '5'; var edict_bordercolor = 'b7d6e9'; </script>
                    <script type="text/javascript" src="<?=BASE_URL?>/js/widget.js"></script>
                </div>




		</div>
	</div>
	
	<?php $data->displayChildren('[id=userAccountDialog]') ?>
</div>
