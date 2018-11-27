<?php 
	$user=$_GET['user'];
	$pwd=$_GET['pwd'];
	$email=$_GET['email'];
	$pdo=new PDO('mysql:host=127.0.0.1;dbname=test',"root","root");
	$sql="select * from email";
	$data=$pdo->query($sql)->fetchAll();
	
 ?>