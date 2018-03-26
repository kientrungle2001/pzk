<style>
.entry-title {
	font-size: 16px;
	padding: 0;
	margin: 0;
}
</style>
{item = $data->getItem()}
<my.container>
<my.row>
<div class="col-md-9">
<img src="{item[img]}" class="img-responsive hidden" />
<h2 class="text-justify">{item[title]}</h2>
<div class="text-justify">
{item[content]}
</div>
</div>
<div class="col-md-3">
{relateds = $data->getRelateds()}
<div class="row">
{each $relateds as $related}
<a href="/{related[alias]}">
<div class="col-sm-12 thumbnail">
	<img src="{related[img]}" class="img-responsive img-thumbnail" />
	<h3 class="entry-title">{related[title]}</h3>
</div>
</a>

{/each}
</div>
</div>
</my.row>
</my.container>