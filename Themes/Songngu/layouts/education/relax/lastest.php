<div id="myCarousel" class="carousel" data-ride="carousel">
  <div class="carousel-inner" role="listbox">
    {? 
	$first = true;
	$items = $data->getItems(); ?}
	{each $items as $item}
	{? 
	$active = '';
	if($first) {
		$active = 'active';
		$first = false;
	}
	?}
    <div class="item {active}">
      <a href="#" onclick='chitiet({item[id]}); return false;'><img src="{item[img]}" style="max-height:250px;" alt="{item[title]}">
      <div class="carousel-caption">
        <h3><a href="#" style="color: white; text-decoration: none;" onclick="chitiet({item[id]}); return false;">{item[title]}</a></h3>
      </div>
	  </a>
    </div>
	{/each}
  </div>

  <!-- Left and right controls 
  <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
  -->
</div>