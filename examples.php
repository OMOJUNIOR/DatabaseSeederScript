<?php

include 'seederClass.php';

// ----------------------------------------------------------------
//  PDO databse seeder object by Musa A S
//  hard coded input options data'
// ----------------------------------------------------------------
// By: Musa A S
// sheriffmusa42@gmail.com
// 2022-03-12
// 00:47:00
//  ----------------------------------------------------------------
// Provide the  the database credentials
//  ----------------------------------------------------------------

$dbHost = ''; //localhost
$dbName = ''; //database name
$dbCharset = ''; //utf8
$dbUser = ''; // database userName
$dbPass = ''; //database password
$dbPort = null; // if the port is required provide the port number

// ----------------------------------------------------------------
//  PDO databse seeder object by Musa A S
//  hard coded input options data'
//  ----------------------------------------------------------------

// Create the database seeder object
//  ----------------------------------------------------------------

$seeder = new SeederClass($dbHost, $dbName, $dbCharset, $dbUser, $dbPass, $dbPort);

// ----------------------------------------------------------------
//  PDO databse seeder object by Musa A S
//  hard coded input options data'
//  ----------------------------------------------------------------

// Connect to the database
//  ----------------------------------------------------------------

$seeder->connect();

// ----------------------------------------------------------------
//  PDO databse seeder object by Musa A S
//  hard coded input options data'
//  ----------------------------------------------------------------

// Create the table
//  ----------------------------------------------------------------
// If the table does not exist, create it by calling on this
// method and pass the table name as a string
//  ----------------------------------------------------------------
// if the table already exists, this will throw an error.
// Please be careful when using this method if use are
// running this script on a live server.

$tableName = '';
$seeder->createTable($tableName);

// Add columns to the table
// if the table does not have a column use this method to add a column.
// ----------------------------------------------------------------
// Type examples // VARCHAR, INT, TEXT, DATETIME, TIMESTAMP, etc
//
//  ----------------------------------------------------------------

$tableName = ''; // Databse table  name
$column = ''; // Name you want to assign to the column
$type = ''; // INT, TEXT, DATETIME, TIMESTAMP, etc

$test = $seeder->createColumn($tableName, $column, $type);

// ----------------------------------------------------------------
//  PDO databse seeder object by Musa A S
//  hard coded input options data'
//  ----------------------------------------------------------------

// Insert the data
//  ----------------------------------------------------------------
//  This method will insert the data into the table
//  ----------------------------------------------------------------
// Provide the data as multidimensional array
//  ----------------------------------------------------------------
// key in the array should be the name of the column in the table

$data = [
    ['name' => 'Ganta'],
    ['name' => 'Buchanan'],
    ['name' => 'Gbarnga'],
];

$seeder->exportData($data);

// ----------------------------------------------------------------
//  PDO databse seeder object by Musa A S
//  hard coded input options data'
//  ----------------------------------------------------------------
// Reset the table to 0 or delete all records from the table

$tableName = '';

$seeder->resetTable($tableName);

// ----------------------------------------------------------------
//  PDO databse seeder object by Musa A S
//  hard coded input options data'
//  ----------------------------------------------------------------
