<style>
#menu {
    font: bold 12px Arial, Helvetica, Sans-serif;
	height: 35px;
	background: #337ab7;
}

#menu ul {
    margin:0;
    padding:0;
    list-style:none;
}

#menu ul li {
    float:left;
    white-space: nowrap;
}

#menu ul li a {
    float: left;
    text-decoration:none;
    background:#337ab7;
    border-left: 1px solid rgba(255, 255, 255, 0.05);
    border-right: 1px solid rgba(0,0,0,0.2);
}

#menu li ul {
    background:#337ab7;
    left: -999em;
    margin: 35px 0 0;
    position: absolute;
    width: 160px;
    z-index: 9999;
}

#menu li ul a {
    background: none;
    border: 0 none;
    margin-right: 0;
    width: 160px;

}

#menu ul li a:hover,
#menu ul li:hover > a {
    background: #428BCA;
}

#menu li ul a:hover,
#menu ul li li:hover > a  {
    background: #428BCA;
}



#menu li:hover ul {
    left: auto;
}


#menu li li ul {
    margin: 0px 0 0 160px;
    visibility:hidden;
}

#menu li li:hover ul {
    visibility:visible;
}

ul.drop li{
	list-style: none;
}
ul.drop li a{
	text-decoration: none;
	float: left;
	display: block;
	padding: 0px 17px;
    height: 35px;
    line-height: 35px;
    overflow: hidden;
	color: #fff;
	border-right: 1px solid #fff;
}

#menu ul li.action > a {
    background: #428BCA;
}

ul.drop li a.active {
	background: #418AC9 !important;
}

</style>
<div id="menu" class="text-center">
<?php 		
$items = $data->getItems();
$items = buildTree($items);
show_menu($items, 'drop', 'drop', '');
?>
</div>