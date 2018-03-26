<p class="t-weight text-center btn-custom8 mgright textcl">Các tin cùng chuyên mục</p>
{? $items = $data->getItems(); ?}
{each $items as $item}
<a onclick='chitiet({item[id]}); return false;' href="#" ><h4 class="top20">{item[title]}</h4></a>
{/each}