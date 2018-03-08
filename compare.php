<?php
// QA generated files

set_time_limit(100000);

$master = new SplFileObject("Merged.csv");
$master->setFlags(SplFileObject::READ_CSV);

foreach ($master as $row) {
    $master_row[] = $row;
}


// Combine arrays
//
$arr = array_merge( $master_row );

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
