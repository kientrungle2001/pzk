<?php
$text = '';
$contents= $data -> getNews();
$text .= '<?xml version="1.0" encoding="UTF-8"?>'."\n";
$text .='<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">'."\n"; 
$text .= '<url>'."\n";
$text .= '  <loc>http://www.nextnobels.com/</loc>'."\n";
$text .= '  <changefreq>daily</changefreq>'."\n";
$text .= '  <priority>1.00</priority>'."\n";
$text .='</url>'."\n";
$text .='<url>'."\n";
$text .= '   <loc>http://www.nextnobels.com/index.php</loc>'."\n";
$text .= '   <changefreq>daily</changefreq>'."\n";
$text .= '   <priority>0.80</priority>'."\n";
$text .= '</url>'."\n";
foreach($contents as $content){
    $text .= '<url>'."\n";
    $text .= '  <loc>http://www.nextnobels.com/' . str_replace(array("&", "<", ">", '"', "'",":-"), array("&amp;", "&lt;", "&gt;", "&quot;", "&apos;","-"),$content['alias']).'</loc>'."\n";
    $text .= '  <changefreq>daily</changefreq>'."\n";
    $text .= '  <priority>0.80</priority>'."\n";
    $text .='</url>'."\n";
}
$text .='</urlset>'."\n";

foreach($contents as $content){
    echo 'http://www.nextnobels.com/' . $content['alias']."<br>";
}
echo "Đã ghi ".file_put_contents("sitemap.xml",$text)." ký tự".'<br>';
echo "Finish!";
?>