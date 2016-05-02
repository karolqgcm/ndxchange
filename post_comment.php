<?php 
  session_start();
  $conn = oci_connect('guest','guest','xe');
  $stmt = oci_parse($conn,'begin ndcraiglist.create_comment(:store_id,:commenter_id,:content);end;');
  
oci_bind_by_name($stmt,':store_id',$_POST['store_id']);
  oci_bind_by_name($stmt,':commenter_id',$_SESSION['user_id']);

  oci_bind_by_name($stmt,':content',$_POST['content']);

  oci_execute($stmt);
?>
