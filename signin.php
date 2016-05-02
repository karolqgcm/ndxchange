<?php
set_include_path(get_include_path() . PATH_SEPARATOR . '/google/google-api-php-client-master/src');
session_start(); 

$conn = oci_connect('guest','guest','xe');
$query = "select id_user
         from users
         where id_user = :id_user";
$stmt = oci_parse($conn,$query);
oci_bind_by_name($stmt,":id_user",$_POST['id']);
oci_execute($stmt);
$nrows = oci_fetch_all($stmt, $results);
if($nrows !=1){
  $query = "insert into users
           values (:id_user,:name_user,:email_user,:link,:image_url)";
  $stmt = oci_parse($conn,$query);
  oci_bind_by_name($stmt,":id_user",$_POST['id']);
  oci_bind_by_name($stmt,":name_user",$_POST['name']);
  $image = $_POST['image'];
  $image = "1";
  oci_bind_by_name($stmt,":image_url",$image);
  oci_bind_by_name($stmt,":email_user",$_POST['email']);
  $link = "1";
  oci_bind_by_name($stmt,":link",$link);
  oci_execute($stmt);
  $stmt = oci_parse($conn,"commit");
  oci_execute($stmt);
  oci_close($conn);
}
$_SESSION['user_id'] = $_POST['id'];

?>
