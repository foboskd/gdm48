<?php ob_start();
header('Content-Type: text/html; charset=utf-8');
	if (isset($_COOKIE[session_name()])){
		if (!isset($_SESSION)){
			session_start();
		}else {
			unset($_SESSION['id']);
		}
	}

	$connection = mysqli_connect('mysql-18.smartape.ru', 'user11046_mgdm', '31052017', 'user11046_gdm');
	mysqli_set_charset($connection, 'utf8');	
	
	if ($connection == false){
		echo 'база данных не подключена';
		echo mysqli_connect_error();
	exit();};
?>