<?php
	ob_start();
	$tool_dir = "/var/www/tool/translation/";
	$store_dir = "/var/www/tool/upload/";
	$filename = $_COOKIE["filename"];
	$fileext = $_COOKIE["fileext"];
	if($_POST["type"] === "cdf-fits"){
        	system("cd /var/www/tool/upload/;".$tool_dir."cdf-to-fits-static ".$store_dir.$filename.".fits ".$store_dir.$filename.".".$fileext, $msg);
//		echo $msg;
		header('Location:/tool/upload/'.$filename.".fits");	
	}
	else if($_POST["type"] === "cdf-netCDF"){
		system("cd /var/www/tool/upload/;".$tool_dir."cdf-to-netCDF -map ".$tool_dir."cdf_to_netcdf_mapping.dat ".$store_dir.$filename.".".$fileext, $msg);
//		echo $msg;
		header('Location:/tool/upload/'.$filename.".nc");
	}
	else if($_POST["type"] === ""){
		
	}
?>
