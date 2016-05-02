<?php
   session_start();
   $conn = oci_connect('guest','guest','xe');
   $stmt = oci_parse($conn, 'select email_user from users where id_user = :user_id');
   oci_bind_by_name($stmt,':user_id',$_SESSION['user_id']);
   oci_define_by_name($stmt,'EMAIL_USER',$contact);
   oci_execute($stmt);
   oci_fetch($stmt);
 
   $stmt = oci_parse($conn,'select email_user from users,store where id_user = id_manager and id_store = :store_id');
   oci_bind_by_name($stmt,':store_id',$_POST['store_id']);
   oci_define_by_name($stmt,'EMAIL_USER',$to);
   oci_execute($stmt);
   oci_fetch($stmt);   

   $subject = 'NDxChange - Product interest';
   $message = "Dear user,\r\n";
   $message .= "There is someone interested in the product ".$_POST['name']."\r\n";
   $message .= "Contact them via the email: ".$contact."\r\n";
   $message .= "Thank you!";
   mail($to,$subject,$message);
?>
