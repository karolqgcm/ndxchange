<script src="https://code.jquery.com/jquery-1.10.2.js"></script>
<script>
$.post( "view_product.php", ' name: "John"' );
console.log("123")
</script>
<?php
session_start();
$_SESSION["store_id"] = $_GET['id']; 

echo $_POST["name"];
header("Location:http://ndxchange.esc.nd.edu:8164/view_product.php");
?>
