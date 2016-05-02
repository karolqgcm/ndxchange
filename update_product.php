<?php
   $conn = oci_connect('guest', 'guest', 'xe');
   $stmt = oci_parse($conn, 'select id_category from category where cat_description = :cat');
   oci_bind_by_name($stmt,':cat',$_POST['category']);
   oci_define_by_name($stmt,'ID_CATEGORY',$category);
   oci_execute($stmt);
   oci_fetch($stmt);

   $stmt = oci_parse($conn, 'update store set name_store = :name, price_per_product = :price, product_category = :cat, description_store = :descr where id_store = :store ');
   oci_bind_by_name($stmt,':name',$_POST['name']);
   oci_bind_by_name($stmt,':price',$_POST['price']);
   oci_bind_by_name($stmt,':cat',$category);
   oci_bind_by_name($stmt,':descr',$_POST['description']);
   oci_bind_by_name($stmt,':store',$_POST['store_id']);
   oci_execute($stmt);
   oci_close($conn);

?>
