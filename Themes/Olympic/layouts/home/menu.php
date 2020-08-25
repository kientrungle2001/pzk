<div class="navbar mgt80 navbar-default" role="navigation">
    <div class="container pdl0">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar2">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>
        <div id='myNavbar2' class="collapse navbar-collapse">
			<?php 
				$items = $data->getItems();
				$items = buildBs($items);
				
				$currentCategory = _db()->getTableEntity('categories')->load(pzk_request()->getSegment(3));
				$controller = pzk_request()->getController();
				$action = pzk_request()->getaction();
				
				if(isset($items[0])) {
			?>
			<ul class="nav navbar-nav">
				<li <?php if($controller =='Home' && $action =='index') { echo "class='active'"; } ?> >
                    <a  href="/" >Home </a>
				</li>
			<?php
					foreach($items[0] as $key => $val) {
					$active = strpos($currentCategory->getParents(), ',' . $val['id'] . ',') !== false ? 'active': '';
			?>
				<li <?php echo "class='$active'"; ?>>
				<a href="<?php if(SEO_MODE && @$val['alias']) { echo BASE_REQUEST.'/'.$val['alias']; } else { echo BASE_REQUEST.'/'.$val['router'].'/'.$val['id']; }?>" class="dropdown-toggle" > 
					<?php echo $val['name']; ?> 
					<?php if(isset($items[$val['id']])) { ?>
						<b class="caret"></b>
					<?php } ?>
				</a>
					<?php if(isset($items[$val['id']])) { 	
					?>
					<ul class="dropdown-menu">
					<?php	
							$data2 = $items[$val['id']];
							foreach($data2 as $key => $val) {
							$active = strpos($currentCategory->getParents(), ',' . $val['id'] . ',') !== false ? 'active': '';
					?>
						<li <?php if(isset($items[$val['id']])) { ?> class="dropdown-submenu <?php echo $active;?>" <?php } else { echo "class='$active'"; } ?> >
                            <a href="<?php if(SEO_MODE && @$val['alias']) { echo BASE_REQUEST.'/'.$val['alias']; } else { echo BASE_REQUEST.'/'.$val['router'].'/'.$val['id']; }?>" class="dropdown-toggle" >
							<?php echo $val['name']; ?></a>
							<?php if(isset($items[$val['id']])) { 
								$data3 = $items[$val['id']];
								?>
								<ul class="dropdown-menu">
								<?php
								foreach($data3 as $key => $val) {
								$active = strpos($currentCategory->getParents(), ',' . $val['id'] . ',') !== false ? 'active': '';
							?>
								<li  <?php echo "class='$active'"; ?>>
								<a href="<?php if(SEO_MODE && @$val['alias']) { echo BASE_REQUEST.'/'.$val['alias']; } else { echo BASE_REQUEST.'/'.$val['router'].'/'.$val['id']; }?>">
								<?php echo $val['name']; ?></a>
								</li>
								<li class="divider"></li>
							<?php 
								unset($data3[$key]);
								} 
							?>
								</ul>
							<?php } ?>
						</li>
						<li class="divider"></li>
					<?php 
							unset($data2[$key]); 
							} 
					?>
					</ul>
					<?php
						} 
					?>
				</li>
				<li class="divider"></li>
			<?php 
					unset($items[0][$key]);
					} 
				} 
			?>
            
        </div><!--/.nav-collapse -->
    </div>
</div>