<?php $item = $data->getItem();
$layouts = $item['layouts'];
if($layouts) {
	$layouts = json_decode($layouts, true);
} else {
	$layouts = array();
}

$controllers = $item['controllers'];
if($controllers) {
	$controllers = json_decode($controllers, true);
} else {
	$controllers = array();
}

$files = $item['files'];
if($files) {
	$files = json_decode($files, true);
} else {
	$files = array();
}

$modules = @$item['modules'];
if($modules) {
	$modules = json_decode($modules, true);
} else {
	$modules = array();
}

$objects = @$item['objects'];
if($objects) {
	$objects = json_decode($objects, true);
} else {
	$objects = array();
}
 ?>
<div class="container">
<h2>Theme: <a href="/admin_themes/edit/<?php echo @$item['id']?>?backHref=<?php echo urlencode(BASE_REQUEST . '/admin_directory_theme/detail/'. $item['id']); ?>"><?php echo @$item['name']?></a> - Object Editor: <a href="/Admin_Editor">Editor</a></h2>
<hr />
<h3>Layouts</h3>
<div class="row">
<?php  foreach ($layouts as $name => $positions): ?>
<div class="col-xs-6">
	<h4><a href="/Admin_Editor/open?file=/Themes/<?php echo @$item['name']?>/pages/<?php echo $name ?>.php&type=xml&backHref=/admin_directory_theme/detail/<?php echo @$item['id']?>"><?php echo $name ?></a></h4>
	<div class="row">
		<?php  foreach ($positions as $posName => $posLabel): ?>
			<div class="col-xs-4">
			<?php echo $posName ?> - <?php echo @$posLabel['name']?>
			</div>
		<?php  endforeach;?>
	</div>
</div>
<?php  endforeach;?>
</div>
<hr />
<h3>Controllers</h3>
<div class="row">
<div class="col-xs-12">
<ul class="nav navbar-nav">
<?php foreach($controllers as $controller): ?>
	<li>
	<a class="bg-success dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
      <?php echo @$controller['name']?> - <?php echo @$controller['path']?> <span class="caret"></span>
    </a>
    <ul class="dropdown-menu">
      <?php if(file_exists(BASE_DIR . '/Themes/'.$item['name'] . '/controller/' . ucfirst(substr($controller['path'], 0, strpos($controller['path'], '/'))) . '.php')):?>
	  <li>
	  <a class="bg-success"href="/Admin_Editor/open?file=/Themes/<?php echo @$item['name']?>/controller/<?php  echo ucfirst(substr($controller['path'], 0, strpos($controller['path'], '/'))); ?>.php&type=php&backHref=/admin_directory_theme/detail/<?php echo @$item['id']?>" role="button">Controller</a>
	  </li>
	  <?php endif;?>
	  <?php if(file_exists(BASE_DIR . '/Themes/' . $item['name'] . '/pages/' . $controller['layout'].'.php')): ?>
	  <li><a class="bg-success"href="/Admin_Editor/open?file=/Themes/<?php echo @$item['name']?>/pages/<?php echo @$controller['layout']?>.php&type=xml&backHref=/admin_directory_theme/detail/<?php echo @$item['id']?>" role="button">Master Page</a></li>
	  <?php endif; ?>
	  <?php if( file_exists(BASE_DIR . '/Themes/'.$item['name']. '/pages/'. $controller['page'].'.php')):?>
	  <li><a class="bg-success"href="/Admin_Editor/open?file=/Themes/<?php echo @$item['name']?>/pages/<?php echo @$controller['page']?>.php&type=xml&backHref=/admin_directory_theme/detail/<?php echo @$item['id']?>" role="button">Page</a></li>
	  <?php endif;?>
    </ul>
	</li>
<?php endforeach; ?>
</ul>
</div>
</div>
<hr />

<h3>Objects</h3>
<div class="row">
<div class="col-xs-12">
<ul class="nav navbar-nav">
<?php foreach($objects as $object): ?>
	<li>
	<a class="bg-success dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
      <?php echo @$object['name']?><span class="caret"></span>
    </a>
    <ul class="dropdown-menu">
      <?php if($object['object'] && file_exists(BASE_DIR . '/objects/'. $object['object'] . '.php')):?>
	  <li>
	  <a class="bg-success"href="/Admin_Editor/open?file=/objects/<?php echo @$object['object']?>.php&type=php&backHref=/admin_directory_theme/detail/<?php echo @$item['id']?>" role="button">Object</a>
	  </li>
	  <?php endif;?>
	  
	  <?php if($object['layout'] && file_exists(BASE_DIR . '/Themes/' . $item['name'] . '/layouts/' . $object['layout'].'.php')): ?>
	  <li><a class="bg-success"href="/Admin_Editor/open?file=/Themes/<?php echo @$item['name']?>/layouts/<?php echo @$object['layout']?>.php&type=xml&backHref=/admin_directory_theme/detail/<?php echo @$item['id']?>" role="button">Layout</a></li>
	  <?php endif; ?>
	  
	  <?php if($object['js'] && file_exists(BASE_DIR . '/js/'. $object['js'] . '.js')):?>
	  <li>
	  <a class="bg-success"href="/Admin_Editor/open?file=/js/<?php echo @$object['js']?>.js&type=js&backHref=/admin_directory_theme/detail/<?php echo @$item['id']?>" role="button">Javascript</a>
	  </li>
	  <?php endif;?>
	  
    </ul>
	</li>
<?php endforeach; ?>
</ul>
</div>
</div>
<hr />

<h3>Files</h3>
<div class="row">
<div class="col-xs-12">
<ul class="nav nav-pills nav-stacked">
<?php foreach($files as $file): ?>
	<li><a class="bg-success" href="/Admin_Editor/open?file=/Themes/<?php echo @$item['name']?>/<?php echo @$file['path']?>&type=<?php echo @$file['type']?>&backHref=/admin_directory_theme/detail/<?php echo @$item['id']?>"><?php echo @$file['path']?></a></li>
<?php endforeach; ?>
</ul>
</div>
</div>
<hr />
<a href="/admin_directory_theme">Back</a>
</div>
