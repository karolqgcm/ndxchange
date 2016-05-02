<?php
    $conn = oci_connect('guest','guest','xe');

    $stmt = oci_parse($conn,'select image_name from image where id_product = :store_id');
    oci_bind_by_name($stmt,':store_id',$_POST['store_id']);
    oci_define_by_name($stmt,'IMAGE_NAME',$image_name);
    oci_execute($stmt);
    while(oci_fetch($stmt)){
       unlink("images/".$image_name);
    }

    $stmt = oci_parse($conn,'delete from image where id_product = :store_id');
    oci_bind_by_name($stmt,':store_id',$_POST['store_id']);
    oci_execute($stmt);

    $stmt = oci_parse($conn,'delete from store where id_store = :store_id');
    oci_bind_by_name($stmt,':store_id',$_POST['store_id']);
    oci_execute($stmt);
    oci_close($conn);
?>
