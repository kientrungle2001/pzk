<?php
require_once __DIR__ . '/../../ActiveRecord.php';

// assumes a table named "books" with a pk named "id"
// see simple.sql
class Book extends ActiveRecord\Model { }

// initialize ActiveRecord
// change the connection settings to whatever is appropriate for your mysql server 
ActiveRecord\Config::initialize(function($cfg)
{
    $cfg->set_model_directory('.');
    $cfg->set_connections(array('development' => 'mysql://root@localhost/test'));
});
$conditions = array();

if(isset($_REQUEST['sort'])) {
	$sorters = array();
	$sorts = $_REQUEST['sort'];
	
	foreach($sorts as $key => $val) {
		$sorters[] = $key . ' ' . $val;
	}
	$conditions['order'] = implode(', ', $sorters);
} else {
	$conditions['order'] = 'id asc';
}

//echo json_encode(array(Book::first()->attributes()));
$all = Book::find('all', $conditions);
$books = array();
foreach($all as $book) {
	$books[] = $book->attributes();
}
echo json_encode($books);
?>
