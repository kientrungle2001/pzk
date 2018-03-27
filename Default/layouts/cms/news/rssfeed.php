<?php
$item = "";
$items = $data -> getInfo();
foreach($items as $row){
    $item .= '<item>'."\n";
    $item .= '<title>'.$row['title'].'</title>'."\n";
    $item .= '<link>'.'http://www.nextnobels.com/'.$row['alias'].'</link>'."\n";
    $item .= '<description>'.str_replace(array("&", "<", ">", '"', "'"), array("&amp;", "&lt;", "&gt;", "&quot;", "&apos;"),strip_tags($row['brief'])).'</description>'."\n";
    $item .= '</item>'."\n";
}
echo('<?xml version="1.0" ?>');
echo('<rss version="2.0">');
echo("<channel>");
echo("<title>Phần mềm khảo sát năng lực toàn diện</title>");
echo("<link>http://nextnobels.com</link>");
echo("<description>Phần mềm khảo sát năng lực toàn diện cho học sinh tiểu hoc</description>");
echo $item;
echo("</channel>");
echo('</rss>')
?>