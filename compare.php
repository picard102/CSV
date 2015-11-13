<?php
// QA generated files

set_time_limit(100000);

$i2010 = new SplFileObject("2010v1.csv");
$i2010->setFlags(SplFileObject::READ_CSV);

foreach ($i2010 as $row) {
    $i2010c[] = $row;
}

$i2011 = new SplFileObject("2011v1.csv");
$i2011->setFlags(SplFileObject::READ_CSV);

foreach ($i2011 as $row) {
    $i2011c[] = $row;
}

$i2012 = new SplFileObject("2012v1.csv");
$i2012->setFlags(SplFileObject::READ_CSV);

foreach ($i2012 as $row) {
    $i2012c[] = $row;
}

$i2013 = new SplFileObject("2013v1.csv");
$i2013->setFlags(SplFileObject::READ_CSV);

foreach ($i2013 as $row) {
    $i2013c[] = $row;
}

$i2014 = new SplFileObject("2014v1.csv");
$i2014->setFlags(SplFileObject::READ_CSV);

foreach ($i2014 as $row) {
    $i2014c[] = $row;
}

$i2015 = new SplFileObject("2015v1.csv");
$i2015->setFlags(SplFileObject::READ_CSV);

foreach ($i2015 as $row) {
    $i2015c[] = $row;
}


// Combine arrays
//
$arr = array_merge( $i2010c,$i2011c,$i2012c,$i2013c,$i2014c, $i2015c );

// Sort the merged array 
  function val_sort($array,$key) {
  
  // Loop through and get the values of our specified key
  foreach($array as $k=>$v) {
    $b[] = strtolower($v[$key]);
  }
  
  asort($b);
  foreach($b as $k=>$v) {
    $c[] = $array[$k];
  }
  return $c;
}
// Sort by email (col 2)
$sorted = val_sort($arr, '2');


// Loop through files to QA file outputs
//
echo '<hr><table>';
foreach($sorted as $unique_row) {
      echo '<tr>';
        foreach($unique_row as $element) {
          echo '<td>' . $element . '</td>';
        }
      echo '</tr>';
    }
echo '</table>';
echo '<br />';


?>
