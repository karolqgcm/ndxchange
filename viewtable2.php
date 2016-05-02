
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
<article>
 <div class ="register_prod" id="tables">



<?php
  session_start();
  $conn = oci_connect("guest", "guest", "xe");
// $term = str_replace("'","''",$_POST['search']);
 $query = $_SESSION["query"]; 
/*

if (strpos($term, "%") !== false){


$term=str_replace("%" , "/%", $term);
}

$term = "%".$term."%";

$query = "select * from store where name_store like :term  escape '/'";
*/
//echo $term;
//echo "<br>";
//echo $query;
  $stmt = oci_parse($conn, $query);
//  oci_bind_by_name($stmt, ':term', $term);
  oci_execute($stmt);

  $nrows = oci_fetch_all($stmt, $results);
  print "<br/>";
  if ( $nrows > 0 ) {
    print "<TABLE class='TABLES_TAB'BORDER=\"3\">\n";
    print "<TR>\n";
    while ( list( $key, $val ) = each( $results ) ) {
     // print "<TH>$key</TH>\n";
    }
    print "<TH>ITEM</TH><TH>PRICE</TH>\n";
    print "</TR>\n";

    for ( $i = 0; $i < $nrows; $i++ ) {
      reset($results);
      print "<TR>\n";
      while ( $column = each($results) ) {
        $data = $column['value'];
        if($column['key'] == 'ID_STORE'){
          $store_id = $column['value'][$i];
        }
        if($column['key'] == 'NAME_STORE'){
          print "<TD><a href='http://ndxchange.esc.nd.edu:8164/product_redirect.php?id=".$store_id."' >$data[$i]</a></TD>\n";
        }else{
          if($column['key'] != 'ID_STORE' && $column['key'] != 'ID_MANAGER'
		&&  $column['key'] != 'CREATION_DATE' &&  $column['key'] != 'PRODUCT_CATEGORY' && $column['key'] != 'DESCRIPTION_STORE'){         
	   print "<TD>$data[$i]</TD>\n";
	   }
        }
      }
      print "</TR>\n";
    }
    print "</TABLE>\n";
  } else {
    print "No data found<BR>\n";
  }

  oci_free_statement($stmt);
  oci_close($conn);
?>




</div>
</article>
<footer>
   
</footer>
<script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
<script src="http://dhbhdrzi4tiry.cloudfront.net/cdn/sites/foundation.js"></script>
    <script>
        $(document).foundation();
    </script>
    </body>
    </html>

