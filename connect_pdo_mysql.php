<?php 
   
    $host = "";  // Your hosting server 
    $dbname = "";  // Your database password 
    $dbuser = ""; // Your user name
    $userpass = ""; // Your user password
    
    $dsn = 'mysql:host=' . $host . ';dbname=' . $dbname;

    $conn = new PDO($dsn, $dbuser, $userpass);
    
    if(!$conn){
    echo "Error. No connect to database" . $dbname;
    }