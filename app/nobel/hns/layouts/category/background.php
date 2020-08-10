<?php
$categoryId = pzk_request()->getSegment(3);
$background = $data->getBackground($categoryId);
if($background) {
?>
    <img class="item" src="<?php echo @$background['img']?>" alt=""/>
<?php
}
?>