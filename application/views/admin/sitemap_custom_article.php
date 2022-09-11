<?xml version="1.0" encoding="utf-8"?>
<urlset xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:n="http://www.google.com/schemas/sitemap-news/0.9" xmlns:image="http://www.google.com/schemas/sitemap-image/1.1" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">
<?php
$baseUrl =base_url();
for($i=0;$i<count($articleList);$i++){
	$url =  $baseUrl.$articleList[$i]['url'];
	$lastUpdatedDate = new DateTime(@$articleList[$i]['last_updated_on']);
?>
<url>
<loc><?php echo $url; ?></loc>
<lastmod><?php echo $lastUpdatedDate->format('Y-m-dTH:i:s+05:30') ?></lastmod>
<changefreq>monthly</changefreq>
<priority>0.7</priority>
</url>
<?php
}
?>
<?php
for($i=0;$i<count($galleryList);$i++){
	$url =  $baseUrl.$galleryList[$i]['url'];
	$lastUpdatedDate = new DateTime(@$galleryList[$i]['last_updated_on']);
?>
<url>
<loc><?php echo $url; ?></loc>
<lastmod><?php echo $lastUpdatedDate->format('Y-m-dTH:i:s+05:30') ?></lastmod>
<changefreq>monthly</changefreq>
<priority>0.7</priority>
</url>
<?php
}
?>
<?php
for($i=0;$i<count($videoList);$i++){
	$url =  $baseUrl.$videoList[$i]['url'];
	$lastUpdatedDate = new DateTime(@$videoList[$i]['last_updated_on']);
?>
<url>
<loc><?php echo $url; ?></loc>
<lastmod><?php echo $lastUpdatedDate->format('Y-m-dTH:i:s+05:30') ?></lastmod>
<changefreq>monthly</changefreq>
<priority>0.7</priority>
</url>
<?php
}
?>
</urlset>