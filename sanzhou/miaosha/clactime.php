<?php 
	$pdo=new PDO('mysql:host=127.0.0.1;dbname=test',"root","root");//pdo连接数据库
	$sql="select * from shop";//sql语句
	$data=$pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);	

	foreach ($data as $key => $value) {
		$startTime=time();//当前时间
		$endTime=$value['endtime'];//结束时间
		$remTime=$endTime-$startTime;//秒杀时间
		$hour=floor($remTime/3600);//计算小时
		$fen=floor(($remTime-$hour*3600)/60);//计算分钟
		$miao=$remTime-$hour*3600-$fen*60;//计算秒数

		$data[$key]['hour']=$hour;
		$data[$key]['fen']=$fen;
		$data[$key]['miao']=$miao;
		// print_r($data);
	}
	echo json_encode($data);
 ?>