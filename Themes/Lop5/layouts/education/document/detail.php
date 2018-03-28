<div class="container document hidden-xs">
	<div class="row">
		<div class="col-md-1">&nbsp;</div>			
		<div class="col-xs-11 col-md-11 ">
			<div class="pd-20 text-left">
				<a href="<?=FL_URL?>"><h1>FULL LOOK</h1></a>	
				<h3 class="hidden-xs">Phần mềm Khảo sát và Phát triển năng lực toàn diện bằng tiếng Anh</h3>
				<?php echo partial('Themes/Default/layouts/home/aboutbtn');?>
			</div>
		</div>
	</div>
</div>
<div class="container top50 visible-xs">
	<div class="row">
		<div class="col-md-1">&nbsp;</div>			
		<div class="col-xs-11 col-md-11 ">
			<div class="pd-20 text-left">
				<a href="<?=FL_URL?>"><h1>FULL LOOK</h1></a>	
			</div>
		</div>
	</div>
</div>	
{? $item = $data->getItem(); ?}
<?php 
$subject = _db()->getTableEntity('categories')->load($item['categoryId']);
$subjects = _db()->selectAll()->fromCategories()->whereDisplay(1)->whereParent($subject->get('parent'))->result();
 ?>
{children [position=top-menu]}
<div class="container fivecolumns">
	<div class="row">
		<div class="col-md-2 col-xs-12">
			{children [position=left-banner]}
		</div>
		<div class="col-md-8 col-xs-12 left-10">
			<div id="document-detail">
				<p class="t-weight text-center"><ul class="breadcrumb text-center">
					<li><a href="/document/home">Tài liệu học tập</a></li>
					<li class="active">
						<span class="dropdown">
						  <a class="dropdown-toggle" type="button" id="dropdownSubjectDocument" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
							{subject.get('name')}
							<span class="caret"></span>
						  </a>
						  <ul class="dropdown-menu" aria-labelledby="dropdownSubjectDocument" style="top: 12px;">
						  {each $subjects as $sbj}
						  
							<li><a href="/document/class-{? echo intval(pzk_request()->get('class'))?}/subject-{sbj[alias]}-{sbj[id]}">{sbj[name]}</a></li>
						  {/each}
						  </ul>
						</span>
					</li>
				</ul></p>
				<p class="t-weight text-center">{item[title]}</p>
				<?php if(@$item['file']) : ?>
				<script type="text/javascript" src="/3rdparty/jquery.gdocsviewer.v1.0/jquery.gdocsviewer.min.js"></script> 
				<script type="text/javascript">
					$(document).ready(function() {
						$('#embedURL').gdocsViewer({width: '100%'});
					});
				</script>
				<a href="<?php echo BASE_URL.$item['file']; ?>" id="embedURL">&nbsp;</a>
				<?php else: ?>
				<div class="content">{? echo str_replace('&nbsp;', '', $item['content']) ?}</div>
				<?php endif; ?>
				<!--
				<iframe src="https://docs.google.com/viewer?srcid={? echo urlencode(BASE_URL.$item['file']); ?}&pid=explorer&efh=false&a=v&chrome=false&embedded=true" style="width:100%; height:600px; "></iframe>
				<iframe src="http://docs.google.com/viewer?url={? echo urlencode(BASE_URL.$item['file']); ?}&output=embed" style="width:100%; height:600px; "></iframe>
				<iframe src="/3rdparty/pdf.js/web/viewer.html?file={? echo urlencode('http://s1.nextnobels.com'.$item['file']); ?}" style="width:100%; height:600px; "></iframe>
				-->
			</div>
			<?php if(@$item['file']) : ?>
			<p class="text-center pd-20"><i class="fa fa-link"></i>Tải về <a href="{item[file]}">{item[title]}</a></p>
			<?php endif; ?>
			{children [position=other-document]} 
		</div>
		<div class="col-md-2 col-xs-12 pd-15 left5">
			{children [position=right-banner]} 
		</div>
	</div>
</div>
