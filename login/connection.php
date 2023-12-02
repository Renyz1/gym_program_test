<?php

$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "gym_program";

if(!$con = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname))
{

	die("failed to connect!");
}
