

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
    </div>
<div class ="register_prod">
<form action='upload.php' method='post' enctype='multipart/form-data'>
<h2>Register your product</h2>
	<p>Product Name:</p> <input type='text' maxlength='15' id="search_field" name='product_name' required></input><br><br>
<p>Price:</p> <input type='number' min='0' step='0.01'id="search_field" name='product_price' required></input> <br><br>
<p>Product Category: </p>
  <?php
    $conn = oci_connect("guest","guest","xe") or die("Couldn't connect");
    $stmt = oci_parse($conn,"select cat_description from category");
    oci_define_by_name($stmt,"CAT_DESCRIPTION",$category);
    oci_execute($stmt);
    echo "<select name='product_category' id='search_field'>";
    while(oci_fetch($stmt)){
      $option = "<option value='";
      $option .=$category;
      $option .= "'>";
      $option .=$category;
      $option .="</option> <br>";
      echo $option;
    }
    echo "</select> <br><br>";

  ?>
Description: <textarea rows='4' maxlength='100' name='product_description' id='search_field' required></textarea> <br><br>

<input type="file" name="fileToUpload[]" id="fileToUpload" class="inputfile" multiple><br><br>
<label for "fileToUpload"> Select image to upload</label>
<div class="upload">
<input type='submit' class="button expanded" id="search_button" value='Register Product' name='submit'></input>
</div> 
</form>
</div>
<div class="callout large secondary">
    <div class="row">
        <div class="large-4 columns">

        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
<script src="http://dhbhdrzi4tiry.cloudfront.net/cdn/sites/foundation.js"></script>
    <script>
        $(document).foundation();
    </script>
    </body>
    </html>

