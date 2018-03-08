<?php
echo "Welcome";

set_time_limit(100000);


// MultiDimensional Array Search
// This will search out matching email fields in our lists.
//

function array_search2d($needle, $haystack) {
  for ($i = 0, $l = count($haystack); $i < $l; ++$i) {
      if (in_array($needle, $haystack[$i])) return $i;
  }
  return false;
}


// Set current year to process.
//
$currentYear = '2017';
$currentFile = 'Registrations/'.$currentYear.'.csv';

$input = new SplFileObject($currentFile);
$input->setFlags(SplFileObject::READ_CSV);

foreach ($input as $row) {
    $csv_1[] = $row;
    // echo "<hr>";
    // var_dump($row);
}

// All Years
//

$master = new SplFileObject("Registrations/Master.csv");
$master->setFlags(SplFileObject::READ_CSV);

foreach ($master as $row) {
    $master_row[] = $row;
}

// All years into single array to itterate through
//
$years = array( $master_row );

// Set index to count where in the array the match is
//
$index = 0;

// Loop through input csv
//
foreach($csv_1 as $unique_row) {

  // Set term to search for (Email)
  //
  $searchTerm = $unique_row[0];

  // Loop through Year array
  //
  foreach($years as $yearC) {

    // Set the year we're looping through
    $csv_2 = $yearC;

    // Find Email address in the current year that matches the email in our input.
    $pos = array_search2d($searchTerm, $csv_2);

    if (false !== $pos) {
        // If Twitter isn't empty, replace value
        if ( !empty($csv_2[$pos][3]) ) {
          // Remove @ symbol
          $csv_1[$index][3] = str_replace('@', '', $csv_2[$pos][3]);
        }
        //City
        if (  !empty($csv_2[$pos][4]) ) {
          $csv_1[$index][4] = $csv_2[$pos][4];
        }
        //Company
        if (  !empty($csv_2[$pos][5]) ) {
          $csv_1[$index][5] = $csv_2[$pos][5];
        }
        //Podcast
        if (  !empty($csv_2[$pos][6]) ) {
          $csv_1[$index][6] = $csv_2[$pos][6];
        }
        //Website
        if (  !empty($csv_2[$pos][7]) ) {
          $csv_1[$index][7] = $csv_2[$pos][7];
        }
        //Street
        if (  !empty($csv_2[$pos][8]) ) {
          $csv_1[$index][8] = $csv_2[$pos][8];
        }
        //State
        if (  !empty($csv_2[$pos][9]) ) {
          $csv_1[$index][9] = $csv_2[$pos][9];
        }
        //Country
        if (  !empty($csv_2[$pos][10]) ) {
          $csv_1[$index][10] = $csv_2[$pos][10];
        }
    } // End Replacement
  }
  // Set index position
  $index++;
} // Finished looping through years

// Create new file
//
$fp = fopen('Merged.csv', 'w');

// Loop through modifyed array and create a CSV output
foreach ($csv_1 as $fields) {
    fputcsv($fp, $fields);
}
// Close file
fclose($fp);

//  Display the output of the array

  // echo '<hr><table>';
  //   foreach($csv_1 as $unique_row) {
  //     echo '<tr>';
  //       foreach($unique_row as $element) {
  //         echo '<td>' . $element . '</td>';
  //       }
  //     echo '</tr>';
  //   }
  // echo '</table>';
  // echo '<br />';
?>