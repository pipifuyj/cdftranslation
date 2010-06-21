<?php
	ob_start();
	if ($_FILES["file"]["error"] > 0){
	    echo "Return Code: " . $_FILES["file"]["error"] . "<br />";
	}
	else{
	    echo "Upload: " . $_FILES["file"]["name"] . "<br />";
	    echo "Type: " . $_FILES["file"]["type"] . "<br />";
	    echo "Size: " . ($_FILES["file"]["size"] / 1024) . " Kb<br />";
//	    echo "Temp file: " . $_FILES["file"]["tmp_name"] . "<br />";

            $filename = rand();
	    $temp = explode(".",$_FILES["file"]["name"]);
            $fileext =  $temp[1];
	    move_uploaded_file($_FILES["file"]["tmp_name"], "upload/" . $filename . "." . $fileext);
//	    echo "Stored in: " . "upload/" . $filename . "." . $fileext;
	    setcookie("filename", $filename, time()+3600);
	    setcookie("fileext", $fileext, time()+3600);
	}


if($_POST["submit"] === "translation"){

	$html = '<html>
		<head><title>translation</title></head>
		<body>
		<br>please chooose your translation type£º<br>
		<form action = "translate.php" method = "post">
		<input type="radio" name="type" value = "cdf-fits" checked>cdf-fits<br>
		<input type="radio" name="type" value = "cdf-netCDF">cdf-netCDF<br>
		<input type="submit" value="translate">
		</form>
		</body>
		</html>';
	echo $html;
}
else if($_POST["submit"] === "visual"){
	$str1 = '<?xml version="1.0" encoding="utf-8"?> 
<!-- JNLP File for ViSBARD Application --> 
<jnlp 
     spec="1.0+" 
	 codebase= "http://192.168.111.13:80/cdfvisual/"
     href="visbard_local.jnlp"> 
     <information> 
       <title>ViSBARD</title> 
       <vendor>Visbard Group</vendor> 
       <description>Visual System for Browsing, Analysis, and Retrieval of Data</description> 
       <description kind="short">ViSBARD</description> 
 
     </information> 
     <security> 
         <all-permissions/> 
     </security> 
     <!-- Prior to Java 1.6, the Mac OS X Web Start implementation failed
          to notice updates as well as other platforms.  If this behavior
          continues with Java 1.6, then the following may help     -->
     <update check="always" policy="always" />

     <resources > 
       <j2se version="1.5+" initial-heap-size="96m" max-heap-size="1024m"
            href="http://java.sun.com/products/autodl/j2se" />
       <jar href="lib/visbard.jar" main="true" /> 
	<jar href="lib/visad.jar"  /> 
	<jar href="lib/ccmclib-wrappers.jar"  /> 
	<jar href="lib/cdfjava.jar"  /> 
	<jar href="lib/j3d-org.jar"  /> 
	<jar href="lib/jdom.jar" /> 
	<jar href="lib/jh.jar"  /> 
	<jar href="lib/xerces.jar" /> 
	<jar href="lib/log4j.jar" /> 
	<jar href="lib/patbinfree153.jar" /> 
	<jar href="lib/unit.jar"  /> 

  

       <extension name="cdf-3.3.0"
       		href="cdf-3.3.0.jnlp" /> 
<!--       <extension name="cdf" 
           href="http://sscweb.gsfc.nasa.gov/skteditor/cdf/cdf-3.2-latest.jnlp" /> 
           -->
       <extension name="jax-rpc" 
           href="jax-rpc.jnlp" />
       <extension name="jax-qname" 
           href="jax-qname.jnlp" />           
<!-- 
       <extension name="Java3D"
 href="http://download.java.net/media/java3d/webstart/release/java3d-1.5-latest.jnlp"/>
 -->
       <extension name="log4j"
                  href="log4j.jnlp" />
       <extension name="jdom"
                  href="jdom.jnlp" />
       <extension name="unit"
                  href="unit.jnlp" />
       <extension name="patbinfree"
       			  href="patbinfree153.jnlp" />
       <extension name="xerces"
       			  href="xerces.jnlp"  />
<!--       <extension name="regexp"
                  href="regexp/regexp.jnlp" /> -->
       <extension name="commons-lang"
                  href="commons-lang.jnlp" />
       <extension name="commons-logging"
                  href="commons-logging.jnlp" />
       <extension name="ssc"
                  href="ssc.jnlp" />
       <extension name="cdas"
                  href="cdas.jnlp" />
       <extension name="vspo"
                  href="vspo.jnlp" />
    <extension name="j3d-org"
       			  href="j3d-org.jnlp" />   
       <extension name="javahelp"
       			  href="jh.jnlp" />
       <extension name="ovt"
       			  href="ovt_visbard-2.3.jnlp" />
       <extension name="jai"
       			  href="jai.jnlp" />
      <extension name="j3d"
       			  href="j3d.jnlp" />      		  
       			  
       			  
       <!-- Mac OS X specific properties -->
       <property name="apple.laf.useScreenMenuBar" value="true" />
       <property name="com.apple.macos.useScreenMenuBar" value="true" />
       <property name="com.apple.mrj.application.apple.menu.about.name"
                value="ViSBARD" />
       <property name="apple.awt.showGrowBox" value="true" />
       <property name="com.apple.mrj.application.growbox.intrudes"
                value="true" />
       <property name="apple.awt.antialiasing" value="true" />
       <property name="com.apple.macosx.AntiAliasedTextOn" value="true" />
       <!-- end Mac OS X specific properties -->
     </resources> 
   <resources os="Linux" >
	<nativelib href="lib/libCCMC2so.jar"/>
   </resources> 
 <resources os="Windows" >
	<nativelib href="lib/CCMC2dll.jar"/>
   </resources> 
     <application-desc main-class="gov.nasa.gsfc.visbard.model.VisbardMain">
<argument>-u</argument><argument>';

$str2 = '</argument> 
    </application-desc>
</jnlp> ';

$jnlp = $str1."http://192.168.111.13/tool/upload/".$filename . "." . $fileext.$str2;
	file_put_contents("../cdfvisual/visbard_local.jnlp",$jnlp);
	header('Location:../cdfvisual/visbard_local.jnlp');
}
?>
