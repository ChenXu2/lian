<?php 
	$pdo=new PDO('mysql:host=127.0.0.1;dbname=test',"root","root");//pdo连接数据库
	$sql="select * from shop";
	$data=$pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);	
 ?>
 <!DOCTYPE html>
 <html lang="en">
 <head>
 	<script src="jquery.js"></script>
 	<meta charset="UTF-8">
 	<title>Document</title>
 </head>
 <body>
 	<?php foreach ($data as $key => $value):?>
 		<div style="float:left;margin-right:20px;">
			<p>
				<span id='h<?=$value['id']?>'></span>时
				<span id='m<?=$value['id']?>'></span>分
				<span id='s<?=$value['id']?>'></span>秒
			</p>

 			<p><img src="<?=$value['img']?>" width="150" height='150'></p>
 			<p><?=$value['name']?></p>
 			<p><?=$value['price']?></p>
 			<p><input type="button" value="抢购" onclick="qiang()"></p>
 		</div>
 	<?php endforeach ?>
 </body>
 </html>
 <script>
  $(document).ready(function(){
  		window.setInterval(function(){
  			$.ajax({
  				url:'clactime.php',
  				type:'get',
  				dataType:'json',
  				success:function(data){
  					for (var i=0;i<data.length;i++) {
  						id=data[i]['id'];
  						$('#h'+id).text(data[i]['hour']);
  						$('#m'+id).text(data[i]['fen']);
  						$('#s'+id).text(data[i]['miao']);
  					}
  				}
  			});
  		},1000);
  });
  function qiang(){
  	alert('抢购成功');
  }
 </script>