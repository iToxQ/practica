<?php 
$configs = include('config.php');
$errors = array();

if(!isset($_SESSION['logged_user'])){
	header("Location: /");
}

?>

<html>
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="assets/css/style.css">
	<link rel="stylesheet" type="text/css" href="assets/css/main.css">
	<link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@400;500;700&display=swap" rel="stylesheet">
	<title>Received file</title>
</head>
<body>
	<div class="container">
		<div class="left">
			<ui>
				<li class="menu">Menu</li>
				<li><a href="/main.php">Main page</a></li>
				<li><a href="/send.php">Send file</a></li>
				<li><a href="/my.php">My files</a></li>
				<li class="activ"><a href="/received.php">Received file</a></li>
				<li class="end"><a href="/logout.php">Log out</a></li>
			</ui>
		</div>
		<div class="right">
			<h1>Received file</h1>
			<table>
				<tr class="trtit">
					<th>From whom</th>
					<th>File name</th>
				</tr>
				<?php
				$mysql = new mysqli($configs['localhost'], $configs['username'], $configs['password'], $configs['dbname']);
				$cursor = $mysql->query("SELECT `login`, `real-name`, `name` FROM `infofiles`, `user` WHERE `infofiles`.`author-id` = `user`.`id` AND `where-id` = '".$_SESSION['logged_user']['id']."' ORDER BY `infofiles`.`id` DESC;");
				$flagg = true;
				//узнаем сколько строк нам возвращено
				while( $result = $cursor->fetch_assoc() ) { 
					if ($flagg){
						echo '<tr><td>';
					}else{
						echo '<tr class="tr2"><td>';
					}
        			echo $result['login'].'</td><td><a href="/save.php?f='.$result['name'].'">'.$result['real-name'].'</a></td></tr>';
        			$flagg = !$flagg;
        		}
				$mysql->close();
				?>
			</table>
		</div>
	</div>
</body>
</html>