<?php

	 $DBhost = "localhost";
	 $DBuser = "root";	//Change accordingly
	 $DBpass = "Akatenshi6"; //Change accordingly
	 $DBname = "police_db";
	 
	 $DBcon = new MySQLi($DBhost,$DBuser,$DBpass,$DBname);
    
     if ($DBcon->connect_errno) {
         die("ERROR : -> ".$DBcon->connect_error);
     }
