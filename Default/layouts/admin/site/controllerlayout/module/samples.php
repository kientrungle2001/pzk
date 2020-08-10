<?php
$items = $data->getItems();
$positions = array();
foreach($items as $item) {
	if(!isset($positions[$item['position']])) {
		$positions[$item['position']] = array();
	}
	$positions[$item['position']][] = $item;
}
?>
<div id="sample-module-list">

  <!-- Nav tabs -->
  <ul id="sample-module-nav" class="nav nav-tabs" role="tablist">
  <?php foreach($positions as $position => $modules) { ?>
    <li role="presentation"><a href="#position-<?php echo $position ?>" aria-controls="<?php echo $position ?>" role="tab" data-toggle="tab"><?php echo $position ?></a></li>
  <?php } ?>
  </ul>

  <!-- Tab panes -->
  <div class="tab-content">
  <?php foreach($positions as $position => $modules) { ?>
    <div role="tabpanel" class="tab-pane active" id="position-<?php echo $position ?>">
	<ul class="list-group sample-modules" id="sample-modules-<?php echo $position ?>">
	<?php foreach($modules as $item): ?>
	<li class="list-group-item">
	<strong><?php echo @$item['name']?></strong><br />
	<?php if($item['image']): ?>
	<div>
		<img class="img-responsive img-circle img-thumbnail" src="<?php echo @$item['image']?>" />
	</div>
	<?php endif; ?>
	<code class="hidden"><?php echo html_escape($item['code']); ?></code>
	</li>
	<?php endforeach; ?>
	</ul>
	</div>
  <?php } ?>
  </div>

</div>


<script type="text/javascript">
	$('.sample-modules li').draggable({
      appendTo: "body",
      helper: "clone"
    });
	 $(function() {
		$( ".position-modules" ).droppable({
		  activeClass: "ui-state-default",
		  hoverClass: "ui-state-hover",
		  accept: ":not(.ui-sortable-helper)",
		  drop: function( event, ui ) {
			  var sample = ui.draggable;
			  var name = sample.find('strong').text();
			  var code = sample.find('code').text();
			  var position = $(this).data('position');
			$( '#' + position + '-add-module' ).find( '[name=name]' ).val(name);
			$( '#' + position + '-add-module' ).find( '[name=code]' ).val(code);
			$( '#' + position + '-add-module' ).submit();
		  }
		});	 
	 });
	 
</script>
<style>
.sample-modules li{
	text-align: center;
}
</style>