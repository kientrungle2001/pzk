<h3 class="mgtop-5 text-center">Bài viết được quan tâm</h3>
<ul class="list-unstyled">
{? $items = $data->getItems(); ?}
{each $items as $item}
<li class="top20"><a href="newsdetail.php?id={item[id]}&parentid={item[categoryId]}" >{item[title]}</a></li>
{/each}
</ul>