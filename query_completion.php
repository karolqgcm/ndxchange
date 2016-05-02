<html>
<body>
<?php 

session_start();
$term = str_replace("'","''",$_POST['search']);
$query = "select * from store where name_store like '%".$term."%'";
$_SESSION["query"] = $query;
$location = "Location:http://ndxchange.esc.nd.edu:8164/viewtable2.php";
header($location);
 ?>
</body>
</html>
