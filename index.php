<?php
  set_include_path(get_include_path() . PATH_SEPARATOR . '/google/google-api-php-client-master/src');

?>
<!doctype html>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>
<html class="no-js" lang="en">
  <head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>NDxChange | Welcome</title>
    <link rel="stylesheet" href="./css/foundation.css">
    <link href='https://fonts.googleapis.com/css?family=PT+Sans+Narrow' rel='sty
lesheet' type='text/css'>
  </head>
  <body>
    <script>
      $(document).ready(function(){
        $(".signout").hide();
        $(".register").hide();
      });
    </script>
   <div class="top-bar">
     <div class="top-bar-left">
       <ul class="menu">
         <li class="menu-text"><h2 id="page_logo">NDxChange</h2></li>
         <li><a href="index.php">Home</a></li>
         <li><a href="search_category.php">Categories</a></li>
	 <li class="register"><a class="register" href="register_product.php">Register</a></li>
        </ul>
      </div>
    <div class="top-bar-right">
      <ul class="menu">
        <script src="https://apis.google.com/js/platform.js" async defer></script>
        <meta name="google-signin-client_id" content="625124016498-06v1sc3aiocrqrrtj74mk1eoi6r08b06.apps.googleusercontent.com">
        <li>
           <div class="g-signin2" data-onsuccess="onSignIn"></div>
           <script>
	     function onSignIn(googleUser) {
               var profile = googleUser.getBasicProfile();
               message = {
                 id: profile.getId(),
                 name: profile.getName(),
                 image: profile.getImageUrl(),
                 email: profile.getEmail()
               };
 
               var url = "http://ndxchange.esc.nd.edu:8164/signin.php";
	       var posting = $.post(url, message);
	       $(".g-signin2").hide();
 	       $(".signout").show();
               $(".register").show();
              }

            </script>
          </li>
          <li>
            <div class="signout" >
              <a href="#" id="#signout" onclick="signOut();">Sign out</a>
            </div>
          </li>
        </ul>
        <script>
  function signOut() {    
 $(".g-signin2").show();
 $(".signout").hide();
 $(".register").hide(); 
    var auth2 = gapi.auth2.getAuthInstance();
    auth2.signOut().then(function () {
      console.log('User signed out.');
    });
  }
</script>
    </div>

</div>
<article>

<div class="search_div">

<form action="viewtable.php" method="post">


<input  name="search" size='1' required id="search_field">

<input type="submit" value="search" name="button_submit" id="search_button" class="expanded button">
</form>
</div>
<!--<div class="orbit" role="region" aria-label="Favorite Space Pictures" data-orbit>
<ul class="orbit-container">
<button class="orbit-previous" aria-label="previous"><span class="show-for-sr">Previous Slide</span>&#9664;</button>
<button class="orbit-next" aria-label="next"><span class="show-for-sr">Next Slide</span>&#9654;</button>
<li class="orbit-slide is-active orbit_class">
<img  src="http://placehold.it/2000x750&text=1st">
</li>
<li class="orbit-slide orbit_class">
<img src="http://placehold.it/2000x750&text=2nd">
</li>
<li class="orbit-slide orbit_class">
<img src="http://placehold.it/2000x750&text=3nd">
</li>
<li class="orbit-slide orbit_class">
<img src="http://placehold.it/2000x750&text=4nd">
</li>
</ul>
</div>
-->
    <h2>Our Newest Products</h2>
    

<div class="container">
<div id="homepage" class="row small-up-2 large-up-4">
<?php
$conn2 = oci_connect("guest", "guest", "xe");
if(!$conn2){
$m = oci_error();
exit;}
$stmt = oci_parse($conn2, "select store.id_store,store.name_store, store.price_per_product from store order by store.creation_date desc");
oci_define_by_name($stmt, "ID_STORE", $id_product);
//oci_define_by_name($stmt, "IMAGE_NAME", $image_name);
oci_define_by_name($stmt, "NAME_STORE", $name_store);
oci_define_by_name($stmt, "PRICE_PER_PRODUCT", $price);
$i = 0;
oci_execute($stmt);
while(oci_fetch($stmt)&& $i<8) {
$query = "select image.image_name from image where image.id_product=:id_prod";
$stmt2 = oci_parse($conn2, $query);
oci_bind_by_name($stmt2, ":id_prod", $id_product);
oci_define_by_name($stmt2, "IMAGE_NAME", $image_name);
oci_execute($stmt2);
$div = "<div class = 'column'><img class= 'thumbnail' src='/images/";
if(oci_fetch($stmt2)){
  $div .= $image_name;
 // echo "<script> $('.orbit_class').append('<img src='/images/".$image_name."'>')</script>";
}else{
  $div .= "placeholder.png";
}
$div .= "'><h5>";
$div .= $name_store;
$div .= "</h5><p>$";
$div .= $price;
$div .= "</p><a href='http://ndxchange.esc.nd.edu:8164/product_redirect.php?id=".$id_product."' class='button expanded'>More</a></div>";

$i++;

echo $div;
}
oci_close($conn2);
?>

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
