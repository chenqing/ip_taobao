#!/usr/bin/php
<?php
        require("include/class.taobao.php");
        $ip=$argv[1];
        $t = new taobao("$ip");
        //echo "  $t->get_isp()"."\n";
	$region = $t->get_region();
	$isp    = $t->get_isp();
	$country = $t->get_country();
	$city = $t->get_city();
	echo "$ip  $country $region $city  $isp"."\n";
?>
