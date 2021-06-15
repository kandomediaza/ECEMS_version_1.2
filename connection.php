<?php
$db_host="localhost"; //localhost server 
$db_user="ecemscoz_ecemsapp"; //database username
$db_password="C3m3t3ry!@"; //database password   
$db_name="ecemscoz_ecemsapp"; //database name

try
{
 $db=new PDO("mysql:host={$db_host};dbname={$db_name}",$db_user,$db_password);
 $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOEXCEPTION $e)
{
 $e->getMessage();
}

?>