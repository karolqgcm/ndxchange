<?php 
session_start();
$query = "select id_category from category where cat_description ='".$_GET['search']."'";
$conn = oci_connect("guest","guest","xe");
$stmt = oci_parse($conn,$query);
oci_define_by_name($stmt,"ID_CATEGORY",$id_cat);
oci_execute($stmt);
oci_fetch($stmt);
$query = "select * from store where product_category = ".$id_cat;
$_SESSION["query"] = $query;
header("Location:http://ndxchange.esc.nd.edu:8164/viewtable2.php");



?>
