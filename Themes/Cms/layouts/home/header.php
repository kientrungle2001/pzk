<nav class="navbar navbar-default navbar-fixed-top">
			<div class="container">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span> 
					</button>
					<a class="navbar-brand" rel="home" href="/home/index">
					
						<img src="<?=BASE_SKIN_URL?>/Default/skin/nobel/Themes/Story/media/logo.png" class="img-responsive" alt="logo nextnobels" style="max-width:70px; margin-top: -15px;" />
					</a>
				</div>
				
				<div class="collapse navbar-collapse" id="myNavbar">
				  {children [id=menu]}
				</div>
			</div>
</nav>
<script>
    // very simple to use!
    $(document).ready(function() {
      $('.js-activated').dropdownHover().dropdown();
    });
</script>