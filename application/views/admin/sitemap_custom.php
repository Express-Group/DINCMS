<?php
function getDatesFromRange($start, $end, $format = 'Y-m-d'){ 
    $array = array(); 
    $interval = new DateInterval('P1D'); 
    $realEnd = new DateTime($end); 
    $realEnd->add($interval); 
    $period = new DatePeriod(new DateTime($start), $interval, $realEnd); 
    foreach($period as $date) {                  
        $array[] = $date->format($format);  
    } 
    return $array; 
}
$Dates = getDatesFromRange('2009-04-14', date('Y-m-d'));
$Dates = array_reverse($Dates);
$baseUrl = base_url();
?>
<?xml version="1.0" encoding="utf-8"?>
<sitemapindex xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
<?php 
for($i=0;$i<count($Dates);$i++):
$splitDate = explode("-",$Dates[$i]);
?>
<sitemap>
<loc><?php echo $baseUrl.'sample.xml'?>?yyyy=<?php echo $splitDate[0];?>&amp;mm=<?php echo $splitDate[1];?>&amp;dd=<?php echo $splitDate[2];?></loc>
</sitemap>
<?php
endfor;
?>
</sitemapindex>