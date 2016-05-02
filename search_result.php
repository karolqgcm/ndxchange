<?php
  $conn = oci_connect("guest", "guest", "xe") or die("Couldn't connect");
  $search = $_POST['search'];
  $query = "select * from cat;"; 
  print $query;
  $stmt = oci_parse($conn, $query);
  oci_execute($stmt);

  $nrows = oci_fetch_all($stmt, $results);
  print $nrows;
  print "<br/>";
  if ( $nrows > 0 ) {
    print "<TABLE BORDER=\"3\">\n";
    print "<TR>\n";
    while ( list( $key, $val ) = each( $results ) ) {
      print "<TH>$key</TH>\n";
    }
    print "</TR>\n";

    for ( $i = 0; $i < $nrows; $i++ ) {
      reset($results);
      print "<TR>\n";
      while ( $column = each($results) ) {
        $data = $column['value'];
        print "<TD>$data[$i]</TD>\n";
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
