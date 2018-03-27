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
<div id="menu">
        <ul class="drop">
            <li><a href="/">Trang Chủ</a></li>
			<li><a style="border-right: 1px solid #F7E308;" href="http://forum.nextnobels.vn/index.php">Diễn đàn</a></li>
		</ul>
        <?php 
		
		$items = $data->getMenu();
        $items = buildTree($items);
        show_menu($items);
        ?>
</div>
	<div id="main">