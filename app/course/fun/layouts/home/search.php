<?php
function sw_get_current_weekday()
{
  $weekday = date("l");
  $weekday = strtolower($weekday);
  switch ($weekday) {
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
  return date('H:i d/m/Y') . ', ' . $weekday;
}
?>
<div id="search">

  <div class="row bg-danger">
    <div class="col-sm-6 col-12 d-none d-sm-block">
      <div class="p-3 text-white">
        <?= sw_get_current_weekday(); ?>
      </div>
    </div>

    <div class="col-sm-6 col-12 text-right">
      <div class="p-3">
        <?php if (pzk_session()->getUserId() <= 0) : ?>
          <a id="nobelLogin" href="javascript:void(0)" data-toggle="modal" data-target=".bs-example-modal-lg"><span class="text-white"> Đăng nhập/ Đăng ký</span></a>
        <?php elseif (pzk_session()->getUserId() > 0) : ?>
          <span class="text-white"> Xin chào ( <?php $data->displayChildren('[id=userAccountUser]') ?> )</span>
          <a href="<?= BASE_REQUEST ?>/account/logout"><span>Thoát</span></a>
        <?php endif; ?>
      </div>
    </div>
  </div>

  <?php $data->displayChildren('[id=userAccountDialog]') ?>
</div>