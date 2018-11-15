<?php 
	$citynm=$_POST['citynm'];
	$sql="insert into	`tian` ($citynm) values('$citynm')";
	echo $sql;
	if ($sql) {
		$day='day';
	$week='week';
	$citynm='citynm';
	$weather='weather';
	$temperature='temperature';
	}
 ?>