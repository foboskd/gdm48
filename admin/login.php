<?php
require('../php/connection.php');
	
	// логин на сайт (в админскую часть)
function login($login, $password, $connection){
	$inquiry = mysqli_query($connection, "SELECT id FROM users WHERE login = \"" . $login . "\" AND password =\"" . MD5($password) . "\"");
	if (!$inquiry){
		echo 'Запрос к БД не удался';
		return 0;
	}
	if (mysqli_num_rows($inquiry) == 1){
		$r = mysqli_fetch_array($inquiry);
		session_start();
		$_SESSION['id'] = $r['id'];
		$_SESSION['login'] = $login;
		return 1;
	} else {
		echo 'Ошибка аутентификации';
		unset($_SESSION['id']);
		return 0;
	}
}

	// логофф с сайта
function logoff(){
	unset($_SESSION['id']);
	unset($_SESSION['username']);
}	
	// если пользователь зашел, то перенаправляем его на панель управления
	if(isset($_SESSION['id'])){
		header('Location: /admin/');
	}
	// если не зашел, то проверяем его данные
	if (!isset($_SESSION['id']) && isset($_POST['login']) && isset($_POST['password'])){
		if (login($_POST['login'], $_POST['password'], $connection) == 1){ 
			header('Location: /admin/');
			die();
		}
	}
	// если пользователь захотел выйти
	if (isset($_GET['l'])){
		logoff();
		header('Location: /');
	}

?>
﻿<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Админка</title>
	<link rel="shortcut icon" type="image/png" href="../img/logo/icon.png">
	<link rel="stylesheet" type="text/css" href="../css/styleadmin.css">
	<link rel="stylesheet" type="text/css" href="../css/font-awesome.min.css">
</head>
<body>
	<div class="forlogin">
		<form method="post" enctype="multipart/form-data">
			<label>Введите ваш логин:</label><br>
			<input type="text" name="login"></input>
			<br>
			<br>
			<label>Введите Ваш пароль:</label><br>
			<input type="password" name="password"></input>
			<br>
			<br>
			<input type="submit" name="goin" value="Работать"></input>
			<br>
			<br>
		</form>
	</div>
</body>
</html>