<?php 
	$redis=new Redis;
	$redis->connect('127.0.0.1',6379);
	// print_r($redis);
	$city=$_GET['city'];
	if($redis->exists($city)){
	$str=$redis->get($city);
	echo $str;	
	}else{
		$key='cee650bf3f754ad2a987dd162aeca540';
		$url="https://free-api.heweather.com/s6/weather/forecast?location=$city&key=$key";
		$str=curl_get($url);
		echo $str;

		$data=json_decode($str,true);
		// echo '<pre/>';
		// print_r($data);

		$data=$data['HeWeather6'][0]['daily_forecast'];
		// echo '<pre/>';
		// print_r($data);
		$pdo=new PDO('mysql:host=localhost;dbname=test','root','root');
		foreach ($data as $key => $value) {
			$date=$value['date'];
			$maxTemp=$value['tmp_max'];		// 最高温度
			$minTemp=$value['tmp_min'];		// 最低温度
			$sql="insert into weather(city,date,maxtemp,mintemp) values('$city','$date','$maxTemp','$minTemp')";
			// echo $sql;
			$pdo->exec($sql);
		}
		$str=join($data);
		$redis->set($city,$str);
		echo $str;
	}
	
	function curl_get($url){
		$ch=curl_init();
		curl_setopt($ch,CURLOPT_URL,$url);
		curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
		curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,0);
		$str=curl_exec($ch);
		curl_close($ch);
		return $str;
	}
 ?>