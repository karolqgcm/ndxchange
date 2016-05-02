<?php
  
?>
<!doctype html>
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

<div class="top-bar">
    <div class="top-bar-left">
        <ul class="menu">
            <li class="menu-text"><h2 id="page_logo">NDxChange</h2></li>
            <li><a href="index.php">Home</a></li>
            <li><a href="search_category.php">Categories</a></li>
        </ul>
    </div>
    <div class="top-bar-right">
        <ul class="menu">



        </ul>
<!--
<a href="#" onclick="signOut();">Sign out</a>
<script>
  function signOut() {
    var auth2 = gapi.auth2.getAuthInstance();
    auth2.signOut().then(function () {
      console.log('User signed out.');
    });
  }
</script>
-->
    </div>

</div>

<article>                                                                              
                  

<div class="cat_div">
<?php
  $conn = oci_connect("guest","guest","xe") or die("Couldn't connect");

  $stmt = oci_parse($conn,"select cat_description from category");
  oci_define_by_name($stmt,"CAT_DESCRIPTION",$category);
  oci_execute($stmt);
  while(oci_fetch($stmt)){
    $button = "<a class='cat_search' href='http://ndxchange.esc.nd.edu:8164/category_query.php?search=";
    $button .=$category;
    $button .= "'>";
    $button .=$category;
    $button .="</a> <br>";
    echo $button;
  }
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

