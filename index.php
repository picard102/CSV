<?php
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
$currentYear = '2010';
$currentFile = 'Registrations/'.$currentYear.'.csv';

$input = new SplFileObject($currentFile);
$input->setFlags(SplFileObject::READ_CSV);

foreach ($input as $row) {
    $csv_1[] = $row;
}

// All Years
//

$i2010 = new SplFileObject("Registrations/2010.csv");
$i2010->setFlags(SplFileObject::READ_CSV);

foreach ($i2010 as $row) {
    $i2010c[] = $row;
}

$i2011 = new SplFileObject("Registrations/2011.csv");
$i2011->setFlags(SplFileObject::READ_CSV);

foreach ($i2011 as $row) {
    $i2011c[] = $row;
}

$i2012 = new SplFileObject("Registrations/2012.csv");
$i2012->setFlags(SplFileObject::READ_CSV);

foreach ($i2012 as $row) {
    $i2012c[] = $row;
}

$i2013 = new SplFileObject("Registrations/2013.csv");
$i2013->setFlags(SplFileObject::READ_CSV);

foreach ($i2013 as $row) {
    $i2013c[] = $row;
}

$i2014 = new SplFileObject("Registrations/2014.csv");
$i2014->setFlags(SplFileObject::READ_CSV);

foreach ($i2014 as $row) {
    $i2014c[] = $row;
}

$i2015 = new SplFileObject("Registrations/2015.csv");
$i2015->setFlags(SplFileObject::READ_CSV);

foreach ($i2015 as $row) {
    $i2015c[] = $row;
}



// All years into single array to itterate through
//
$years = array( $i2010c,$i2011c,$i2012c,$i2013c,$i2014c, $i2015c );

// Set index to count where in the array the match is
//
$index = 0;


// Loop through input csv
//
foreach($csv_1 as $unique_row) {

  // Set term to search for (Email)
  //
  $searchTerm = $unique_row[2];

  // Loop through Year array
  //
  foreach($years as $yearC) {

    // Set the year we're looping through
    //
    $csv_2 = $yearC;

    // Find Email address in the current year that matches the email in our input.
    //
    if (false !== ($pos = array_search2d($searchTerm, $csv_2))) {
        // If Twitter isn't empty, replace value
        if (  !empty($csv_2[$pos][4]) ) {
          // Remove @ symbol 
          $csv_1[$index][4] = str_replace('@', '', $csv_2[$pos][4]);
        }
        //City
        if (  !empty($csv_2[$pos][5]) ) {
          $csv_1[$index][5] = $csv_2[$pos][5];
        }   
        //Company
        if (  !empty($csv_2[$pos][6]) ) {
          $csv_1[$index][6] = $csv_2[$pos][6];
        }   
        //Podcast
        if (  !empty($csv_2[$pos][7]) ) {
          $csv_1[$index][7] = $csv_2[$pos][7];
        }
        //Website
        if (  !empty($csv_2[$pos][8]) ) {
          $csv_1[$index][8] = $csv_2[$pos][8];
        }       
        //Street
        if (  !empty($csv_2[$pos][9]) ) {
          $csv_1[$index][9] = $csv_2[$pos][9];
        }                           
        //State
        if (  !empty($csv_2[$pos][10]) ) {
          $csv_1[$index][10] = $csv_2[$pos][10];
        }   
        //Country
        if (  !empty($csv_2[$pos][11]) ) {
          $csv_1[$index][11] = $csv_2[$pos][11];
        }   
    } // End Replacement
  }
  // Set index position
  $index++;
} // Finished looping through years

// Create new file 
//
$fp = fopen($currentYear.'.csv', 'w');

// Loop through modifyed array and create a CSV output
foreach ($csv_1 as $fields) {
    fputcsv($fp, $fields);
}
// Close file
fclose($fp);

  // Display the output of the array
  //
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