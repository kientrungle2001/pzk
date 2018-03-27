<?php 
require_once(BASE_DIR.'/lib/recursive.php');
?>
<script>
    $(document).ready(function(){
        $(".drop li").hover(
            function(){
                $(this).children('ul').hide();
                $(this).children('ul').slideDown();
            },
            function () {
                $('ul', this).slideUp();
            });
    });

</script>
<!--[if lte IE 9]> <style>  #menu{background: green!important} </style><![endif]-->
<div id="menu">
        <ul class="drop">
			<?php 
			$active = NULL;
			if(!pzk_request()->getSegment(3)) {
				$active = 'active';
			}?>
            <li><a class="{active}" style="border-right: 1px solid #F7E308;" href="<?=BASE_REQUEST?>/Home">Trang Chủ</a></li>
		</ul>
		<a href="/news/rssfeed"><img src="/default/skin/nobel/media/rss_button.gif" style="float:right; margin-top:14px; margin-right: 12px;"></a>
        <?php 
		$items = $data->getItems();
        $items = buildTree($items);
        show_menu($items);
        ?>
</div>
	<div id="main">