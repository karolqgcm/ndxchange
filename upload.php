<?php
function check_image($target_file,$index){
  $uploadOk = 1;
  $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
  $error = "";
  // Check if image file is a actual image or fake image
  if(isset($_POST["submit"])) {
      $check = getimagesize($_FILES["fileToUpload"]["tmp_name"][$index]);
      if($check !== false) {
          $uploadOk = 1;
      } else {
          $error = "File is not an image.";
          $uploadOk = 0;
      }
  }
  // Check if file already exists
  if (file_exists($target_file)) {
      $error = "Sorry, file already exists.";
      $uploadOk = 0;
  }
  // Check file size
  if ($_FILES["fileToUpload"]["size"][$index] > 500000) {
      $error = "Sorry, your file is too large.";
      $uploadOk = 0;
  }
  // Allow certain file formats
  if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
      $error = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
      $uploadOk = 0;
  }
  return array($uploadOk,$error);
}

session_start();
$conn = oci_connect("guest","guest","xe");
$query = "begin :r := ndcraiglist.create_store(:manager_id,:product_name,:product_price,:product_category,:product_description); end;";

$manager_id = $_SESSION["user_id"];
$product_name = $_POST["product_name"];
$product_price = $_POST["product_price"];
$product_category = $_POST["product_category"];
$product_description = $_POST["product_description"];
$stmt = oci_parse($conn,$query);

oci_bind_by_name($stmt, ":manager_id", $manager_id);
oci_bind_by_name($stmt, ":product_name", $product_name);
oci_bind_by_name($stmt, ":product_price", $product_price);
oci_bind_by_name($stmt, ":product_category", $product_category);
oci_bind_by_name($stmt, ":product_description", $product_description);
oci_bind_by_name($stmt, ':r', $store_id);
oci_execute($stmt);

$stmt = oci_parse($conn,"commit");
oci_execute($stmt);
;
$_SESSION["store_id"]=$store_id;

$target_dir = "images/";
$count = count($_FILES["fileToUpload"]["name"]);
for($i=0; $i< $count; $i++ ){
  $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"][$i]);
  list($ok, $error) = check_image($target_file,$i);
  if($ok != 0){
    $new_name = $store_id."_".$i.".".pathinfo($target_file,PATHINFO_EXTENSION);
    $new_dir = $target_dir.$new_name;
    if(move_uploaded_file($_FILES["fileToUpload"]["tmp_name"][$i],$new_dir)){
      echo "file uploaded";

      $stmt = oci_parse($conn,"begin ndcraiglist.create_image(:store_id,:name_image);end;");
      oci_bind_by_name($stmt, ":store_id", $store_id);
      oci_bind_by_name($stmt, ":name_image", $new_name);
      oci_execute($stmt);

    }else{
      echo "file not uploaded";
    }
  }else{
   echo $error;
  }
}

$stmt = oci_parse($conn,"commit");
oci_execute($stmt);
oci_close($conn);
header("Location:http://ndxchange.esc.nd.edu:8164/view_product.php");

?>
