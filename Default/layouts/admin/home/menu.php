<?php
	// require_once BASE_DIR . '/lib/recursive.php';
    $level = pzk_session('adminLevel');
    if($level) {
        if($level == 'Administrator'){
            $allmenu = _db()->useCB()->select('*')
                ->from('admin_menu')
                ->where(array('status',1))
                ->where(array('software', pzk_request('softwareId')))
                ->orderBy('ordering asc')
                ->result();
        }else {
            $query = _db()->useCB()->select('am.*, ala.admin_level_id, ala.admin_action, ala.admin_level, ala.status, ala.action_type')
                ->from('admin_menu am')
                ->join('admin_level_action ala', 'am.admin_controller = ala.admin_action')
                ->where(array('equal', array('column', 'ala', 'admin_level'), $level))
                ->where(array('equal', array('column', 'am', 'software'), pzk_request('softwareId')))
                ->where(array('equal', array('column', 'ala', 'software'), pzk_request('softwareId')))
                ->where(array('equal', array('column', 'ala', 'action_type'),'index'))
                ->where(array('equal', array('column', 'am', 'status'),1))
                ->where(array('equal', array('column', 'ala', 'status'),1));
            $query->orderBy('am.ordering asc');
            //echo $query->getQuery();
           // $query->where(array(array('in', 'am', 'status'),$arrIds));
            //$query->where(array('in', 'am.id', $arrIds));
            $allmenu = $query->result();
            //$allmenu = array_merge($a, $rootmenu);

        }
    }
    //debug($allmenu);
?>
<div id="menu">
	<ul class="drop">
		<li style="background: #fff;"><a style="background: #fff;" href="#" onclick="return false;"><img style="height: 32px; width: auto;" src="<?php echo BASE_URL ?>/Default/skin/admin/media_admin/logo.png" alt="Logo" /></a></li>
		<li><a href="/Admin_Home/index"> Bảng điều khiển</a></li>
    </ul>
    <?php
    $items = buildTree($allmenu);
    //debug($items);
    showAdminMenu($items);
    ?>
	<ul class="drop" style="float: right;">
		<li><a href="#"><?=pzk_session('adminUser')?> </a></li>
		<li> <a style="float: right;" href="/Admin_Login/logout"><b>(Thoát)</b></a></li>
	</ul>
</div>
<div id="main">