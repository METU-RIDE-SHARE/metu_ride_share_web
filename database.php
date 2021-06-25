<?php

	define("DB_HOST", "localhost");
	define("DB_USER", "root");
	define("DB_PASSWORD", "");
	define("DB_DATABASE", "metu_ride_share");

	// Connect to the database

	$link = new mysqli(DB_HOST,DB_USER,DB_PASSWORD,DB_DATABASE);
    if (!$link)
    {
        echo "MySQL Error: " . mysqli_connect_error();
    }


?>