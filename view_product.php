<?php
session_start();
if (isset($_SESSION['user_id']) && $_SESSION['user_id']) {
$p = $_SESSION['user_id'];
}
?>
<!doctype html>
<html class="no-js" lang="en">
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script src="http://code.jquery.com/ui/1.9.2/jquery-ui.js"></script>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>NDxChange | Welcome</title>
    <link rel="stylesheet" href="./css/foundation.css">
    <link href='https://fonts.googleapis.com/css?family=PT+Sans+Narrow' rel='sty
lesheet' type='text/css'>

</head>
<body>

<div class="top-bar">
    <div class="top-bar-left">
        <ul class="menu">
            <li class="menu-text"><h2 id="page_logo">NDxChange</h2></li>
            <li><a href="index.php">Home</a></li>
            <li><a href="search_category.php">Categories</a></li>
        </ul>
    </div>
    </div>



<article> 
<div class="register_prod">
<form>
<h2>View product</h2>

<?php

$product_id = $_SESSION["store_id"];
$conn = oci_connect("guest","guest","xe");
$query = "select id_manager,name_store,price_per_product,product_category,description_store
      from store
      where id_store=".$product_id;
$stmt = oci_parse($conn,$query);
oci_define_by_name($stmt, "ID_MANAGER", $id_manager);
oci_define_by_name($stmt,"NAME_STORE",$name);
oci_define_by_name($stmt,"PRICE_PER_PRODUCT",$price);
oci_define_by_name($stmt,"PRODUCT_CATEGORY",$cat_id);
oci_define_by_name($stmt,"DESCRIPTION_STORE",$desc);
//oci_define_by_name($stmt,"PRODUCT_IMAGE_ID",$image_id);
oci_execute($stmt);
oci_fetch($stmt);
$query = "select cat_description
      from category
      where id_category=".$cat_id;
$stmt = oci_parse($conn,$query);
oci_define_by_name($stmt,"CAT_DESCRIPTION",$cat);
oci_execute($stmt);
oci_fetch($stmt);

    echo 'Product Name: <input type="text" class="readable"  maxlength="15" name="product_name" value="'.$name.'"  readonly></input><br><br>';
    echo "Price: <input type='number' class='readable' min='0' step='0.01' name='product_price' value='".$price."' readonly></input> <br><br>";
    echo "Product Category:";

    $stmt = oci_parse($conn,"select cat_description from category");

    oci_define_by_name($stmt,"CAT_DESCRIPTION",$category);
    oci_execute($stmt);
    echo "<select disabled id='select' name='product_category'>";
    while(oci_fetch($stmt)){
      $option = "<option value='";
      $option .=$category."'";
      if($category == $cat){
        $option .= "selected";
      }
      $option .= ">";
      $option .=$category;
      $option .="</option> <br>";
      echo $option;
      }
    echo "</select> <br><br>";
    
    echo "Description: <textarea rows='4' class='readable' maxlength='100' name='product_description'  readonly>".$desc."</textarea> <br><br>";
    
    $query = "select image_name
      from image
      where id_product=".$product_id;
    $stmt = oci_parse($conn,$query);
    oci_define_by_name($stmt,"IMAGE_NAME",$image_name);
    oci_execute($stmt);
    while(oci_fetch($stmt)){
        echo "Image: <img class='img_prod'src='images/".$image_name."' height='350'><br><br>";
    }

    echo "<input type='button' class='button expanded' id='edit' value='Edit' onclick='edit()'>";
    echo "<input type='button' class='button expanded' id='delete' value='Delete' onclick='del_product()' >";
    echo "<input type='button' class='button expanded' id='contact' value='Contact Seller' onclick='contact_seller()' >";


    echo "</form>";

    echo "<script>
    function save(){
      var buttons = document.getElementsByClassName('readable');
      var i;
      for(i=0; i<buttons.length; i++){
         buttons[i].readOnly = true;
      }
      document.getElementById('select').disabled = true;

      document.getElementById('edit').value = 'Edit';
      document.getElementById('edit').onclick = edit;
      var url = 'http://ndxchange.esc.nd.edu:8164/update_product.php';
      var message = {
         store_id: ".$product_id.",
         name: document.getElementsByName('product_name')[0].value,
         price: document.getElementsByName('product_price')[0].value,
         category: document.getElementsByName('product_category')[0].value,
         description: document.getElementsByName('product_description')[0].value
      };
      var posting = $.post(url,message)
      }";
    echo "
    function del_product(){
       var url = 'http://ndxchange.esc.nd.edu:8164/delete_product.php';
       var message = {
          store_id: ".$product_id.",
       }
       $.post(url,message, function(data){
           alert('Product Deleted');
       })
       window.location = 'http://ndxchange.esc.nd.edu:8164/index.php';
    }"; 

    echo "
     function contact_seller() {
        var url = 'http://ndxchange.esc.nd.edu:8164/contact.php';
        var message = {
           store_id: ".$product_id.",
           name: document.getElementsByName('product_name')[0].value
        }
        $.post(url,message);
     }
    ";

    echo "
      function commenting(){
        var commentary = document.getElementById('commentary').value;
        var url = 'http://ndxchange.esc.nd.edu:8164/post_comment.php'
        var message = {
           store_id: ".$product_id.",
           content: commentary
        }
        $.post(url,message);
        window.location = 'http://ndxchange.esc.nd.edu:8164/view_product.php';

      }

    ";

    echo "</script>";

    oci_close($conn);
  ?>
  <script>
  function  edit(){
    var buttons = document.getElementsByClassName("readable");
    var i;
    for(i=0; i<buttons.length; i++){
       buttons[i].readOnly = false;
    }
    document.getElementById("select").disabled = false ;
    document.getElementById("edit").value = "Save";
    document.getElementById("edit").onclick = save;
}
</script>
<script>
$(document).ready(function(){
if(<?php echo $p ?>===<?php echo $id_manager ?>){
  $("#contact").hide();
}else{

$("#delete").hide();
$("#edit").hide();
}
})
 
</script>
</div>
<div id='forum'>
   <h3>Commentaries</h3>
   <div>
      <?php
           $product_id = $_SESSION["store_id"];
           $conn = oci_connect('guest','guest','xe');
           $stmt = oci_parse($conn,' select content_comment,name_user from commentary,users where id_commenter = id_user and id_store = :store_id order by (date_comment)');
           oci_bind_by_name($stmt,':store_id',$product_id);
           oci_define_by_name($stmt,'CONTENT_COMMENT',$content);
           oci_define_by_name($stmt,'NAME_USER',$name);
           oci_execute($stmt);
           while(oci_fetch($stmt)){
               echo "<div> <h5>".$name."</h5><br> <p>".$content."</p> </div>";
           }

      ?>
   </div>
   <form>
      <input type='text' id='commentary' maxlength='200'>
      <input type='button' value='Comment' id='comment' class='button expanded' onclick='commenting()'>
   </form>
</div>


<script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
<script src="http://dhbhdrzi4tiry.cloudfront.net/cdn/sites/foundation.js"></script>
    <script>
        $(document).foundation();
    </script>
</article>
      <footer></footer>
    </body>
    </html>

