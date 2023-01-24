<?php
$db_host = "localhost";            // np. localhost
$db_name = "blogapp";                 // np. test
$db_user = "root";           // np. root
$db_pass = "";  // np. puste "" 
$db_conn = mysqli_connect($db_host,$db_user,$db_pass) or die ("Odpowiedź: Błąd połączenia z serwerem $host");
mysqli_select_db($db_conn, $db_name) or die("Trwa konserwacja bazy danych… Odśwież stronę za kilka sekund.");
?>


