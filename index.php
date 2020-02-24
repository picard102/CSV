<?php

set_time_limit( 100000 );


// Normalize email.
//
function normalize( $input ) {
  $input   = str_replace( '.', '', $input );
  $pattern = '/\+(\w+)@/';
  return preg_replace( $pattern, '@', $input );
}


// MultiDimensional Array Search
// This will search out matching email fields in our lists.
function array_search2d( $needle, $haystack ) {
  $needle = normalize( $needle );

  for ( $i = 0, $l = count( $haystack ); $i < $l; ++$i ) {
    if ( in_array( $needle, normalize( $haystack[ $i ] ) ) ) {
      return $i;
    }
  }
  return false;
}


// Set current year to process.
// File in source/
// named orders.csv
//
$orders_file = new SplFileObject( 'source/orders.csv' );
$orders_file->setFlags( SplFileObject::READ_CSV );
foreach ( $orders_file as $row ) {
  $orders[] = $row;
}


// Set master list.
// File in source/
// named master.csv
//
$master_file = new SplFileObject( 'source/master.csv' );
$master_file->setFlags( SplFileObject::READ_CSV );
foreach ( $master_file as $row ) {
  $master[] = $row;
}


// Find the index of the data in the orders
//
$order_email_pos    = array_search( strtolower( 'email' ), array_map( 'strtolower', $orders[0] ) );
$order_fname_pos    = array_search( strtolower( 'First Name' ), array_map( 'strtolower', $orders[0] ) );
$order_lname_pos    = array_search( strtolower( 'Last Name' ), array_map( 'strtolower', $orders[0] ) );
$order_city_pos     = array_search( strtolower( 'billing city' ), array_map( 'strtolower', $orders[0] ) );
$order_company_pos  = array_search( strtolower( 'company' ), array_map( 'strtolower', $orders[0] ) );
$order_job_pos      = array_search( strtolower( 'job title' ), array_map( 'strtolower', $orders[0] ) );
$order_rss_pos      = array_search( strtolower( 'Podcast URL' ), array_map( 'strtolower', $orders[0] ) );
$order_website_pos  = array_search( strtolower( 'Website' ), array_map( 'strtolower', $orders[0] ) );
$order_street_pos   = array_search( strtolower( 'Billing Address 1' ), array_map( 'strtolower', $orders[0] ) );
$order_street2_pos  = array_search( strtolower( 'Billing Address 2' ), array_map( 'strtolower', $orders[0] ) );
$order_state_pos    = array_search( strtolower( 'billing state' ), array_map( 'strtolower', $orders[0] ) );
$order_country_pos  = array_search( strtolower( 'billing country' ), array_map( 'strtolower', $orders[0] ) );
$order_zip_pos      = array_search( strtolower( 'Billing Postal Code' ), array_map( 'strtolower', $orders[0] ) );
$order_age_pos      = array_search( strtolower( 'age' ), array_map( 'strtolower', $orders[0] ) );
$order_birthday_pos = array_search( strtolower( 'Birth Date' ), array_map( 'strtolower', $orders[0] ) );
$order_gender_pos   = array_search( strtolower( 'gender' ), array_map( 'strtolower', $orders[0] ) );
$order_time_pos     = array_search( strtolower( 'Order Date' ), array_map( 'strtolower', $orders[0] ) );


// Find the index of the data in master
//
$master_twitter_pos = array_search( strtolower( 'twitter id' ), array_map( 'strtolower', $master[0] ) );
$master_city_pos    = array_search( strtolower( 'city' ), array_map( 'strtolower', $master[0] ) );
$master_company_pos = array_search( strtolower( 'company name' ), array_map( 'strtolower', $master[0] ) );
$master_job_pos     = array_search( strtolower( 'Job Title' ), array_map( 'strtolower', $master[0] ) );
$master_rss_pos     = array_search( strtolower( 'Podcast Rss Feed' ), array_map( 'strtolower', $master[0] ) );
$master_website_pos = array_search( strtolower( 'website' ), array_map( 'strtolower', $master[0] ) );
$master_street_pos  = array_search( strtolower( 'street' ), array_map( 'strtolower', $master[0] ) );
$master_state_pos   = array_search( strtolower( 'state' ), array_map( 'strtolower', $master[0] ) );
$master_zip_pos     = array_search( strtolower( 'billing zip' ), array_map( 'strtolower', $master[0] ) );
$master_country_pos = array_search( strtolower( 'country' ), array_map( 'strtolower', $master[0] ) );
$master_gender_pos  = array_search( strtolower( 'gender' ), array_map( 'strtolower', $master[0] ) );
$master_age_pos     = array_search( strtolower( 'age' ), array_map( 'strtolower', $master[0] ) );
$master_year_pos    = array_search( strtolower( 'year' ), array_map( 'strtolower', $master[0] ) );
$master_time_pos    = array_search( strtolower( 'OptIN_Time' ), array_map( 'strtolower', $master[0] ) );


// Set merged indexs.
//
$headers = array(
	'Email',
	'First Name',
	'Last Name',
	'Gender',
	'Age',
	'Birthday',
	'Podcast RSS Feed',
	'Street',
	'City',
	'State',
	'Zip',
	'Country',
	'Website',
	'Company Name',
	'Job Title',
	'Twitter ID',
	'Year',
	'Opt-In Time',
);
$merged  = array();
array_push( $merged, $headers );


// Loop through Orders csv.
//
$count = 0;
foreach ( $orders as $orders_row ) {
  if ( ! empty( $orders_row[0] ) ) {
    $row = array();
    $count++;
    $customer = $orders_row[ $order_email_pos  ];
    $exists   = array_search2d( $customer, $merged );

    if ( false === $exists ) {

      $pos = array_search2d( $customer, $master );
        array_push( $row, $customer );
      $fname = $orders_row[ $order_fname_pos  ];
        array_push( $row, $fname );
      $lname = $orders_row[ $order_lname_pos  ];
        array_push( $row, $lname );
      $gender = $orders_row[ $order_gender_pos  ];

      //Gender
      if ( empty( $gender ) ) {
        if ( $pos && $master_gender_pos ) {
          $gender = isset( $master[ $pos ][ $master_gender_pos ] ) ? $master[ $pos ][ $master_gender_pos ] : '';
        } else {
          $gender = '';
        }
      }
      array_push( $row, $gender );

      // Age
      $bdayy = isset( $order_birthday_pos ) ? $orders_row[ $order_birthday_pos ] : false;
      if ( ! empty( $bdayy ) ) {
        $byear = substr( $bdayy, -4 );
        $age   = date( 'Y' ) - (int) $byear;
        array_push( $row, $age );
      } else {
        $age = ( true === $order_age_pos ) ? $orders_row[ $order_age_pos ] : false;
        if ( empty( $age ) ) {
          if ( $pos && $master_age_pos ) {
            $age = isset( $master[ $pos ][ $master_age_pos ] ) ? $master[ $pos ][ $master_age_pos ] : '';
          } else {
            $age = '';
          }
        }
        array_push( $row, $age );
      }

      // Birthday
      $bday = isset( $order_birthday_pos ) ? $orders_row[ $order_birthday_pos ] : false;
      if ( empty( $bday ) ) {
        if ( $pos && $master_birthday_pos ) {
          $bday = isset( $master[ $pos ][ $master_birthday_pos ] ) ? $master[ $pos ][ $master_birthday_pos ] : '';
        } else {
          $bday = '';
        }
      }
      array_push( $row, $bday );

      // RSS
      $rss = $orders_row[ $order_rss_pos  ];
      if ( empty( $rss ) ) {
        if ( $pos && $master_rss_pos ) {
          $rss = isset( $master[ $pos ][ $master_rss_pos ] ) ? $master[ $pos ][ $master_rss_pos ] : '';
        } else {
          $rss = '';
        }
      }
      array_push( $row, $rss );

      // Street
      $street = $orders_row[ $order_street_pos ] . ' ' . $orders_row[ $order_street2_pos ];
      if ( empty( $street ) ) {
        if ( $pos && $master_street_pos ) {
          $street = isset( $master[ $pos ][ $master_street_pos ] ) ? $master[ $pos ][ $master_street_pos ] : '';
        } else {
          $street = '';
        }
      }
      array_push( $row, $street );

      // City
      $city = $orders_row[ $order_city_pos  ];
      if ( empty( $city ) ) {
        if ( $pos && $master_city_pos ) {
          $city = isset( $master[ $pos ][ $master_city_pos ] ) ? $master[ $pos ][ $master_city_pos ] : '';
        } else {
          $city = '';
        }
      }
      array_push( $row, $city );

      // State
      $state = $orders_row[ $order_state_pos  ];
      if ( empty( $state ) ) {
        if ( $pos && $master_state_pos ) {
          $state = isset( $master[ $pos ][ $master_state_pos ] ) ? $master[ $pos ][ $master_state_pos ] : '';
        } else {
          $state = '';
        }
      }
      array_push( $row, $state );

      // Zip
      $zip = $orders_row[ $order_zip_pos  ];
      if ( empty( $zip ) ) {
        if ( $pos && $master_zip_pos ) {
          $zip = isset( $master[ $pos ][ $master_zip_pos ] ) ? $master[ $pos ][ $master_zip_pos ] : '';
        } else {
          $zip = '';
        }
      }
      array_push( $row, $zip );

      // Country
      $country = $orders_row[ $order_country_pos  ];
      if ( empty( $country ) ) {
        if ( $pos && $master_country_pos ) {
          $country = isset( $master[ $pos ][ $master_country_pos ] ) ? $master[ $pos ][ $master_country_pos ] : '';
        } else {
          $country = '';
        }
      }
      array_push( $row, $country );

      // Website
      $website = $orders_row[ $order_website_pos  ];
      if ( empty( $website ) ) {
        if ( $pos && $master_website_pos ) {
          $website = isset( $master[ $pos ][ $master_website_pos ] ) ? $master[ $pos ][ $master_website_pos ] : '';
        } else {
          $website = '';
        }
      }
      array_push( $row, $website );

      // Compant
      $company = $orders_row[ $order_company_pos  ];
      if ( empty( $company ) ) {
        if ( $pos && $master_company_pos ) {
          $company = isset( $master[ $pos ][ $master_company_pos ] ) ? $master[ $pos ][ $master_company_pos ] : '';
        } else {
          $company = '';
        }
      }
      array_push( $row, $company );

      // Job Title
      $job = $orders_row[ $order_job_pos  ];
      if ( empty( $job ) ) {
        if ( $pos && $master_job_pos ) {
          $job = isset( $master[ $pos ][ $master_job_pos ] ) ? $master[ $pos ][ $master_job_pos ] : '';
        } else {
          $job = '';
        }
      }
      array_push( $row, $job );

      // Twitter
      if ( $pos && $master_twitter_pos ) {
        $twitter = isset( $master[ $pos ][ $master_twitter_pos ] ) ? $master[ $pos ][ $master_twitter_pos ] : '';
      } else {
        $twitter = '';
      }
      array_push( $row, $twitter );

      // Years
      if ( $pos && $master_year_pos ) {
        $year = isset( $master[ $pos ][ $master_year_pos ] ) ? $master[ $pos ][ $master_year_pos ] . ', 2020' : '';
      } else {
        $year = '2020';
      }
      array_push( $row, $year );

      // Opt In
      if ( $pos && $master_time_pos ) {
        $time = isset( $master[ $pos ][ $master_time_pos ] ) ? $master[ $pos ][ $master_time_pos ] . ', 2020' : '';
      } else {
        $time = isset( $orders_row[ $order_time_pos ] ) ? $orders_row[ $order_time_pos ] : '';
      }
      array_push( $row, $time );

      // Add to Row
      array_push( $merged, $row );
    }
  }
}

// Create new file.
$fp = fopen( 'Merged.csv', 'w' );

// Loop through modifyed array and create a CSV output.
foreach ( $merged as $fields ) {
  fputcsv( $fp, $fields );
}
// Close file.
fclose( $fp );

//Display the output of the array.
echo '<hr><table border="1">';
foreach ( $merged as $unique_row ) {
  echo '<tr>';
  foreach ( $unique_row as $element ) {
    echo '<td>' . $element . '</td>';
  }
  echo '</tr>';
}
echo '</table>';
