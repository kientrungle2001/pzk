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

<!--[if lte IE 8]> <style>  #menu{background: green!important} </style><![endif]-->
        <ul class="drop">
            <li><a style="border-right: 1px solid #F7E308;" href="http://nextnobels.com/home"><span class="glyphicon glyphicon-home"></span> NextNobels</a></li>
		</ul>
        <?php 
		
		$items = $data->getItems();
        $items = buildTree($items);
        show_menu($items);
        ?>
    
</div>
	<div id="main">