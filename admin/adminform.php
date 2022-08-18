<?php require('../php/connection.php');
if(!isset($_SESSION['id'])) //проверям входил ли пользователь под паролем
	die("Эта страница для Вас недоступна, <a href=login.php>зайдите в панель управления</a>.");
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Админка</title>
	<link rel="shortcut icon" type="image/png" href="../img/logo/icon.png">
	<link rel="stylesheet" type="text/css" href="../css/styleadmin.css">
	<link rel="stylesheet" type="text/css" href="../css/font-awesome.min.css">
</head>
<body>
	<h1>Управление контентом</h1>
	<div class="allcontent">
		<section class="menu">
			<nav>
				<menu>
					<li><a href="index.php?banners">Баннеры</a></li>
					<li><a href="index.php?club">Клубы</a></li>
					<li><a href="index.php?employees">Коллектив</a></li>
					<li><a href="index.php?fotos">Фотоальбомы</a></li>
					<li><a href="index.php?indexslider">Слайдер</a></li>
					<li><a href="index.php?news">Новости</a></li>
					<li><a href="index.php?partners">Партнеры</a></li>
					<li><a href="index.php?rewards">Награды</a></li>
					<li><a href="index.php?vacancies">Вакансии</a></li>
					<li><a href="index.php?poster">Афиша</a></li>
					<li><a href="index.php?video">Видео</a></li>
					<li><a href="login.php?l=">Выход</a></li>
				</menu>
			</nav>
		</section>
		<section class="content">
		<?php 
		if (isset($_GET['type'])){
			
			if($_GET['type'] == 'addbanners'){
				
				if(isset($_POST['submit'])){
					if($_FILES['file']['size'] != 0){
						$tmpImage = $_FILES['file']['tmp_name'];
						$newImage = $_SERVER['DOCUMENT_ROOT']."/img/banners/".$_FILES['file']['name'];
						$shortImage = "/img/banners/".$_FILES['file']['name'];
						if(!move_uploaded_file($tmpImage , $newImage)){
							echo "Ошибка при загрузке файла изображения!";
							die();
						}	
					}
						$title = $_POST['title'];
						$link = $_POST['link'];
						$description = $_POST['description'];
						
						$inquiry = mysqli_query($connection, "INSERT INTO banners(title, link, img, description) VALUES('$title', '$link', '$shortImage', '$description')");
						header('Location:/admin/index.php?banners');
				}								
				echo'<div class="form">
					<h3>Управление баннерами</h3>
					<form method="POST" enctype="multipart/form-data">
						<label>Название баннера</label></br>
						<input name="title" value="'.$title.'"></br>
						<label>Ссылка</label></br>
						<input name="link" value="'.$link.'"></br>
						<label>Описание</label></br>
						<textarea name="description" value="'.$description.'"></textarea></br>
						<label>Прикрепить фото продукта</label></br>
						<input type="file" name="file"></br>
						<button name="submit" type="submit">Добавить</button>
						<button name="clear" type="reset">Очистить</button>
					</form>
				</div>';
			};//добавление записи, конец
			
			if($_GET['type'] == 'edbanners'){
				
				$inquiry = mysqli_query($connection, "SELECT * FROM banners WHERE id=".$_GET['id']); //запрос на вывод конкретной записи согласно id
				$inq = mysqli_fetch_assoc($inquiry); //подготовим данные к выводу
					
					if(isset($_POST['submit'])){
						if(!empty($_FILES['file']['size'])){
							if($_FILES['file']['size'] != 0){
								$tmpImage = $_FILES['file']['tmp_name'];
								$newImage = $_SERVER['DOCUMENT_ROOT']."/img/banners/".$_FILES['file']['name'];
								$shortImage = "/img/banners/".$_FILES['file']['name'];
								if(!move_uploaded_file($tmpImage , $newImage)){
									echo "Ошибка при загрузке файла изображения!";
									die();
								}		
							}
								$title = $_POST['title'];
								$link = $_POST['link'];
								$description = $_POST['description'];
								
								$inquiry = mysqli_query($connection, "UPDATE banners SET title='$title', link='$link', img='$shortImage', description='$description' WHERE id=".$_GET['id']);
								header('Location:/admin/index.php?banners');
						}else{
								$title = $_POST['title'];
								$link = $_POST['link'];
								$description = $_POST['description'];
								
								$inquiry = mysqli_query($connection, "UPDATE banners SET title='$title', link='$link', description='$description' WHERE id=".$_GET['id']);
								header('Location:/admin/index.php?banners');
						};								
					};
					echo'<div class="form">
					<h3>Управление баннерами</h3>
					<form method="POST" enctype="multipart/form-data">
						<label>Название баннера</label></br>
						<input name="title" value="'.$inq['title'].'"></br>
						<label>Ссылка</label></br>
						<input name="link" value="'.$inq['link'].'"></br>
						<label>Описание</label></br>
						<textarea name="description">'.$inq['description'].'</textarea></br>
						<label>Прикрепить фото продукта</label></br>
						<input type="file" name="file"></br>
						<button name="submit" type="submit">Добавить</button>
						<button name="clear" type="reset">Очистить</button>
					</form>
					</div>';
			};//правка записи, конец

			if($_GET['type'] == 'delbanners'){
				$inquiry = mysqli_query($connection, "SELECT * FROM banners WHERE id=".$_GET['id']);
				$inq = mysqli_fetch_assoc($inquiry);
				$img = $inq['img'];
				unlink($_SERVER['DOCUMENT_ROOT'].$img);
				$inquiry = mysqli_query($connection, "DELETE FROM banners WHERE id=".$_GET['id']);
				header('Location:/admin/index.php?banners');
			};//удаление записи, конец
			
//БАННЕРЫ КОНЕЦ			

			if($_GET['type'] == 'addpartners'){
				
				if(isset($_POST['submit'])){
					if($_FILES['file']['size'] != 0){
						$tmpImage = $_FILES['file']['tmp_name'];
						$newImage = $_SERVER['DOCUMENT_ROOT']."/img/clip/partners/".$_FILES['file']['name'];
						$shortImage = "/img/clip/partners/".$_FILES['file']['name'];
						if(!move_uploaded_file($tmpImage , $newImage)){
							echo "Ошибка при загрузке файла изображения!";
							die();
						}	
						
						$size=GetImageSize ($newImage); //узнаем размер картинки (это массив где 0 и 1 это ширина высота, 2 тип файла(1 - gif, 2 - jpeg, 3 - png), 3 вместе ширина высота)
				
						if ($size[2] == "1"){
								
						//echo "это гиф";
							$src=imagecreatefromgif($newImage);//создаем новую картинку копию той что в $shortImage
								
						}elseif ($size[2] == "2"){
								
							//echo "это jpeg";
							$src=imagecreatefromjpeg($newImage);//создаем новую картинку копию той что в $shortImage
								
						}elseif ($size[2] == "3"){
								
							//echo "это png";
							$src=imagecreatefrompng($newImage);//создаем новую картинку копию той что в $shortImage
								
						}else{
								
							echo "Ошибка!";
								
						};
							
						$iw=$size[0]; //берем значение ширины
							
						$ih=$size[1]; //берем значение высоты
							
						$new_w=ceil(($iw*0)+50); //новое значение ширины
							
						$new_h=ceil(($ih*0)+50); //новое значение высоты
							
						$dst=ImageCreateTrueColor ($new_w, $new_h);//создаем пустое изображение
							
						ImageCopyResampled ($dst, $src, 0, 0, 0, 0, $new_w, $new_h, $iw, $ih);//Данная функция копирует прямоугольную часть изображения в другое изображение, плавно интерполируя пикселные значения таким образом, что, в частности, уменьшение размера изображения сохранит его чёткость и яркость.
							
						if ($size[2] == "1"){
								
							//echo "это гиф";
							imagegif ($dst, $_SERVER['DOCUMENT_ROOT']."/img/clip/partners/partnersmin/".$_FILES['file']['name']);//сохраняем изображение в новом размере, по уазанному пути и с указанным качеством
							$minimage = "/img/clip/partners/partnersmin/".$_FILES['file']['name'];
							
						}elseif ($size[2] == "2"){
								
							//echo "это jpeg";
							imagejpeg ($dst, $_SERVER['DOCUMENT_ROOT']."/img/clip/partners/partnersmin/".$_FILES['file']['name'], 100);//сохраняем изображение в новом размере, по уазанному пути и с указанным качеством
							$minimage = "/img/clip/partners/partnersmin/".$_FILES['file']['name'];
							
						}elseif ($size[2] == "3"){
								
							//echo "это png";
							imagepng ($dst, $_SERVER['DOCUMENT_ROOT']."/img/clip/partners/partnersmin/".$_FILES['file']['name'], 0);//сохраняем изображение в новом размере, по уазанному пути и с указанным качеством
							$minimage = "/img/clip/partners/partnersmin/".$_FILES['file']['name'];
							
						}else{
								
							echo "Неудачно!";
								
						};
							
						imagedestroy($src);
					}
						$name = $_POST['name'];
						$contact = $_POST['contact'];
						
						$inquiry = mysqli_query($connection, "INSERT INTO partners(name, contact, img, imgmin) VALUES('$name', '$contact', '$shortImage', '$minimage')");
						header('Location:/admin/index.php?partners');
				}								
				echo'<div class="form">
					<h3>Управление партнерами</h3>
					<form method="POST" enctype="multipart/form-data">
						<label>Наименование партнера</label></br>
						<input name="name" value="'.$name.'"></br>
						<label>Ссылка</label></br>
						<input name="contact" value="'.$contact.'"></br>
						<label>Прикрепить фото</label></br>
						<input type="file" name="file"></br>
						<button name="submit" type="submit">Добавить</button>
						<button name="clear" type="reset">Очистить</button>
					</form>
				</div>';
			};//добавление записи, конец

			if($_GET['type'] == 'edpartners'){
				
				$inquiry = mysqli_query($connection, "SELECT * FROM partners WHERE id=".$_GET['id']); //запрос на вывод конкретной записи согласно id
				$inq = mysqli_fetch_assoc($inquiry); //подготовим данные к выводу
					
					if(isset($_POST['submit'])){
						if(!empty($_FILES['file']['size'])){
							if($_FILES['file']['size'] != 0){
								$tmpImage = $_FILES['file']['tmp_name'];
								$newImage = $_SERVER['DOCUMENT_ROOT']."/img/clip/partners/".$_FILES['file']['name'];
								$shortImage = "/img/clip/partners/".$_FILES['file']['name'];
								if(!move_uploaded_file($tmpImage , $newImage)){
									echo "Ошибка при загрузке файла изображения!";
									die();
								}		
							
							$size=GetImageSize ($newImage); //узнаем размер картинки (это массив где 0 и 1 это ширина высота, 2 тип файла(1 - gif, 2 - jpeg, 3 - png), 3 вместе ширина высота)
					
							if ($size[2] == "1"){
									
							//echo "это гиф";
								$src=imagecreatefromgif($newImage);//создаем новую картинку копию той что в $shortImage
									
							}elseif ($size[2] == "2"){
									
								//echo "это jpeg";
								$src=imagecreatefromjpeg($newImage);//создаем новую картинку копию той что в $shortImage
									
							}elseif ($size[2] == "3"){
									
								//echo "это png";
								$src=imagecreatefrompng($newImage);//создаем новую картинку копию той что в $shortImage
									
							}else{
									
								echo "Ошибка!";
									
							};
								
							$iw=$size[0]; //берем значение ширины
								
							$ih=$size[1]; //берем значение высоты
								
							$new_w=ceil(($iw*0)+50); //новое значение ширины
								
							$new_h=ceil(($ih*0)+50); //новое значение высоты
								
							$dst=ImageCreateTrueColor ($new_w, $new_h);//создаем пустое изображение
								
							ImageCopyResampled ($dst, $src, 0, 0, 0, 0, $new_w, $new_h, $iw, $ih);//Данная функция копирует прямоугольную часть изображения в другое изображение, плавно интерполируя пикселные значения таким образом, что, в частности, уменьшение размера изображения сохранит его чёткость и яркость.
								
							if ($size[2] == "1"){
									
								//echo "это гиф";
								imagegif ($dst, $_SERVER['DOCUMENT_ROOT']."/img/clip/partners/partnersmin/".$_FILES['file']['name']);//сохраняем изображение в новом размере, по уазанному пути и с указанным качеством
								$minimage = "/img/clip/partners/partnersmin/".$_FILES['file']['name'];
								
							}elseif ($size[2] == "2"){
									
								//echo "это jpeg";
								imagejpeg ($dst, $_SERVER['DOCUMENT_ROOT']."/img/clip/partners/partnersmin/".$_FILES['file']['name'], 100);//сохраняем изображение в новом размере, по уазанному пути и с указанным качеством
								$minimage = "/img/clip/partners/partnersmin/".$_FILES['file']['name'];
								
							}elseif ($size[2] == "3"){
									
								//echo "это png";
								imagepng ($dst, $_SERVER['DOCUMENT_ROOT']."/img/clip/partners/partnersmin/".$_FILES['file']['name'], 0);//сохраняем изображение в новом размере, по уазанному пути и с указанным качеством
								$minimage = "/img/clip/partners/partnersmin/".$_FILES['file']['name'];
								
							}else{
									
								echo "Неудачно!";
									
							};
								
							imagedestroy($src);
							}
								$name = $_POST['name'];
								$contact = $_POST['contact'];
								
								$inquiry = mysqli_query($connection, "UPDATE partners SET name='$name', contact='$contact', img='$shortImage', imgmin='$minimage' WHERE id=".$_GET['id']);
								header('Location:/admin/index.php?partners');
						}else{
								$name = $_POST['name'];
								$contact = $_POST['contact'];
								
								$inquiry = mysqli_query($connection, "UPDATE partners SET name='$name', contact='$contact' WHERE id=".$_GET['id']);
								header('Location:/admin/index.php?partners');
						};								
					};
					echo'<div class="form">
					<h3>Управление партнерами</h3>
					<form method="POST" enctype="multipart/form-data">
						<label>Наименование партнера</label></br>
						<input name="name" value="'.$inq['name'].'"></br>
						<label>Ссылка</label></br>
						<input name="contact" value="'.$inq['contact'].'"></br>
						<label>Прикрепить фото</label></br>
						<input type="file" name="file"></br>
						<button name="submit" type="submit">Добавить</button>
						<button name="clear" type="reset">Очистить</button>
					</form>
				</div>';
			};//правка записи, конец

			if($_GET['type'] == 'delpartners'){
				$inquiry = mysqli_query($connection, "SELECT * FROM partners WHERE id=".$_GET['id']);
				$inq = mysqli_fetch_assoc($inquiry);
				$img = $inq['img'];
				$imgmin = $inq['imgmin'];
				unlink($_SERVER['DOCUMENT_ROOT'].$img);
				unlink($_SERVER['DOCUMENT_ROOT'].$imgmin);
				$inquiry = mysqli_query($connection, "DELETE FROM partners WHERE id=".$_GET['id']);
				header('Location:/admin/index.php?partners');
			};//удаление записи, конец

//ПАРТНЕРЫ КОНЕЦ

			if($_GET['type'] == 'addemployees'){
				
				if(isset($_POST['submit'])){
					if($_FILES['file']['size'] != 0){
						$tmpImage = $_FILES['file']['tmp_name'];
						$newImage = $_SERVER['DOCUMENT_ROOT']."/img/clip/collegs/".$_FILES['file']['name'];
						$shortImage = "/img/clip/collegs/".$_FILES['file']['name'];
						if(!move_uploaded_file($tmpImage , $newImage)){
							echo "Ошибка при загрузке файла изображения!";
							die();
						}	
						
						$size=GetImageSize ($newImage); //узнаем размер картинки (это массив где 0 и 1 это ширина высота, 2 тип файла(1 - gif, 2 - jpeg, 3 - png), 3 вместе ширина высота)
				
						if ($size[2] == "1"){
								
						//echo "это гиф";
							$src=imagecreatefromgif($newImage);//создаем новую картинку копию той что в $shortImage
								
						}elseif ($size[2] == "2"){
								
							//echo "это jpeg";
							$src=imagecreatefromjpeg($newImage);//создаем новую картинку копию той что в $shortImage
								
						}elseif ($size[2] == "3"){
								
							//echo "это png";
							$src=imagecreatefrompng($newImage);//создаем новую картинку копию той что в $shortImage
								
						}else{
								
							echo "Ошибка!";
								
						};
							
						$iw=$size[0]; //берем значение ширины
							
						$ih=$size[1]; //берем значение высоты
							
						$new_w=ceil($iw/10); //новое значение ширины
							
						$new_h=ceil($ih/10); //новое значение высоты
							
						$dst=ImageCreateTrueColor ($new_w, $new_h);//создаем пустое изображение
							
						ImageCopyResampled ($dst, $src, 0, 0, 0, 0, $new_w, $new_h, $iw, $ih);//Данная функция копирует прямоугольную часть изображения в другое изображение, плавно интерполируя пикселные значения таким образом, что, в частности, уменьшение размера изображения сохранит его чёткость и яркость.
							
						if ($size[2] == "1"){
								
							//echo "это гиф";
							imagegif ($dst, $_SERVER['DOCUMENT_ROOT']."/img/clip/collegs/collegsmin/".$_FILES['file']['name']);//сохраняем изображение в новом размере, по уазанному пути и с указанным качеством
							$minimage = "/img/clip/collegs/collegsmin/".$_FILES['file']['name'];
							
						}elseif ($size[2] == "2"){
								
							//echo "это jpeg";
							imagejpeg ($dst, $_SERVER['DOCUMENT_ROOT']."/img/clip/collegs/collegsmin/".$_FILES['file']['name'], 100);//сохраняем изображение в новом размере, по уазанному пути и с указанным качеством
							$minimage = "/img/clip/collegs/collegsmin/".$_FILES['file']['name'];
							
						}elseif ($size[2] == "3"){
								
							//echo "это png";
							imagepng ($dst, $_SERVER['DOCUMENT_ROOT']."/img/clip/collegs/collegsmin/".$_FILES['file']['name'], 0);//сохраняем изображение в новом размере, по уазанному пути и с указанным качеством
							$minimage = "/img/clip/collegs/collegsmin/".$_FILES['file']['name'];
							
						}else{
								
							echo "Неудачно!";
								
						};
							
						imagedestroy($src);
					}
						$fio = $_POST['fio'];
						$position = $_POST['position'];
						$contacts = $_POST['contacts'];
						
						$inquiry = mysqli_query($connection, "INSERT INTO employees(fio, position, contacts, img, imgmin) VALUES('$fio', '$position', '$contacts', '$shortImage', '$minimage')");
						header('Location:/admin/index.php?employees');
				}								
				echo'<div class="form">
					<h3>Управление партнерами</h3>
					<form method="POST" enctype="multipart/form-data">
						<label>ФИО сотрудника</label></br>
						<input name="fio" value="'.$fio.'"></br>
						<label>Должность</label></br>
						<input name="position" value="'.$position.'"></br>
						<label>Контакты</label></br>
						<input name="contacts" value="'.$contacts.'"></br>
						<label>Прикрепить фото</label></br>
						<input type="file" name="file"></br>
						<button name="submit" type="submit">Добавить</button>
						<button name="clear" type="reset">Очистить</button>
					</form>
				</div>';
			};//добавление записи, конец

			if($_GET['type'] == 'edemployees'){
				
				$inquiry = mysqli_query($connection, "SELECT * FROM employees WHERE id=".$_GET['id']); //запрос на вывод конкретной записи согласно id
				$inq = mysqli_fetch_assoc($inquiry); //подготовим данные к выводу
					
					if(isset($_POST['submit'])){
						if(!empty($_FILES['file']['size'])){
							if($_FILES['file']['size'] != 0){
								$tmpImage = $_FILES['file']['tmp_name'];
								$newImage = $_SERVER['DOCUMENT_ROOT']."/img/clip/collegs/".$_FILES['file']['name'];
								$shortImage = "/img/clip/collegs/".$_FILES['file']['name'];
								if(!move_uploaded_file($tmpImage , $newImage)){
									echo "Ошибка при загрузке файла изображения!";
									die();
								}		
							
							$size=GetImageSize ($newImage); //узнаем размер картинки (это массив где 0 и 1 это ширина высота, 2 тип файла(1 - gif, 2 - jpeg, 3 - png), 3 вместе ширина высота)
					
							if ($size[2] == "1"){
									
							//echo "это гиф";
								$src=imagecreatefromgif($newImage);//создаем новую картинку копию той что в $shortImage
									
							}elseif ($size[2] == "2"){
									
								//echo "это jpeg";
								$src=imagecreatefromjpeg($newImage);//создаем новую картинку копию той что в $shortImage
									
							}elseif ($size[2] == "3"){
									
								//echo "это png";
								$src=imagecreatefrompng($newImage);//создаем новую картинку копию той что в $shortImage
									
							}else{
									
								echo "Ошибка!";
									
							};
								
							$iw=$size[0]; //берем значение ширины
								
							$ih=$size[1]; //берем значение высоты
								
							$new_w=ceil(($iw*0)+50); //новое значение ширины
								
							$new_h=ceil(($ih*0)+50); //новое значение высоты
								
							$dst=ImageCreateTrueColor ($new_w, $new_h);//создаем пустое изображение
								
							ImageCopyResampled ($dst, $src, 0, 0, 0, 0, $new_w, $new_h, $iw, $ih);//Данная функция копирует прямоугольную часть изображения в другое изображение, плавно интерполируя пикселные значения таким образом, что, в частности, уменьшение размера изображения сохранит его чёткость и яркость.
								
							if ($size[2] == "1"){
									
								//echo "это гиф";
								imagegif ($dst, $_SERVER['DOCUMENT_ROOT']."/img/clip/collegs/collegsmin/".$_FILES['file']['name']);//сохраняем изображение в новом размере, по уазанному пути и с указанным качеством
								$minimage = "/img/clip/collegs/collegsmin/".$_FILES['file']['name'];
								
							}elseif ($size[2] == "2"){
									
								//echo "это jpeg";
								imagejpeg ($dst, $_SERVER['DOCUMENT_ROOT']."/img/clip/collegs/collegsmin/".$_FILES['file']['name'], 100);//сохраняем изображение в новом размере, по уазанному пути и с указанным качеством
								$minimage = "/img/clip/collegs/collegsmin/".$_FILES['file']['name'];
								
							}elseif ($size[2] == "3"){
									
								//echo "это png";
								imagepng ($dst, $_SERVER['DOCUMENT_ROOT']."/img/clip/collegs/collegsmin/".$_FILES['file']['name'], 0);//сохраняем изображение в новом размере, по уазанному пути и с указанным качеством
								$minimage = "/img/clip/collegs/collegsmin/".$_FILES['file']['name'];
								
							}else{
									
								echo "Неудачно!";
									
							};
								
							imagedestroy($src);
							}
								$fio = $_POST['fio'];
								$position = $_POST['position'];
								$contacts = $_POST['contacts'];
								
								$inquiry = mysqli_query($connection, "UPDATE employees SET fio='$fio', position='$position', contacts='$contacts', img='$shortImage', imgmin='$minimage' WHERE id=".$_GET['id']);
								header('Location:/admin/index.php?employees');
						}else{
								$fio = $_POST['fio'];
								$position = $_POST['position'];
								$contacts = $_POST['contacts'];
								
								$inquiry = mysqli_query($connection, "UPDATE employees SET fio='$fio', position='$position', contacts='$contacts' WHERE id=".$_GET['id']);
								header('Location:/admin/index.php?employees');
						};								
					};
					echo'<div class="form">
					<h3>Управление партнерами</h3>
					<form method="POST" enctype="multipart/form-data">
						<label>ФИО сотрудника</label></br>
						<input name="fio" value="'.$inq['fio'].'"></br>
						<label>Должность</label></br>
						<input name="position" value="'.$inq['position'].'"></br>
						<label>Контакты</label></br>
						<input name="contacts" value="'.$inq['contacts'].'"></br>
						<label>Прикрепить фото</label></br>
						<input type="file" name="file"></br>
						<button name="submit" type="submit">Добавить</button>
						<button name="clear" type="reset">Очистить</button>
					</form>
				</div>';
			};//правка записи, конец

			if($_GET['type'] == 'delemployees'){
				$inquiry = mysqli_query($connection, "SELECT * FROM employees WHERE id=".$_GET['id']);
				$inq = mysqli_fetch_assoc($inquiry);
				$img = $inq['img'];
				$imgmin = $inq['imgmin'];
				unlink($_SERVER['DOCUMENT_ROOT'].$img);
				unlink($_SERVER['DOCUMENT_ROOT'].$imgmin);
				$inquiry = mysqli_query($connection, "DELETE FROM employees WHERE id=".$_GET['id']);
				header('Location:/admin/index.php?employees');
			};//удаление записи, конец

//РАБОТНИКИ КОНЕЦ

			if($_GET['type'] == 'addnews'){
				
				if(isset($_POST['submit'])){
					
					for($i=0; $i<count($_FILES['file']['name']); $i++){
						
						if(is_uploaded_file($_FILES['file']['tmp_name'][$i])){
							
							$tmpImage = $_FILES['file']['tmp_name'][$i];
							
							$newImage = $_SERVER['DOCUMENT_ROOT']."/img/clip/news/".$_FILES['file']['name'][$i];
														
							$shortImage = serialize($_FILES['file']['name']);
							
							if(!move_uploaded_file($tmpImage, $newImage)){
								echo "Ошибка при загрузке файла изображения!";
								die();
							}
							
						}
					}
										
						$title = $_POST['title'];
						$data = $_POST['data'];
						$category = $_POST['category'];
						$anons = $_POST['anons'];
						$text = $_POST['text'];
						
						$inquiry = mysqli_query($connection, "INSERT INTO news(title, data, category, anons, text, img, imgmin) VALUES('$title', '$data', '$category', '$anons', '$text', '$shortImage', '$minimage')");
						header('Location:/admin/index.php?news');
				}								
				echo'<div class="form">
					<h3>Управление баннерами</h3>
					<form method="POST" enctype="multipart/form-data">
						<label>Заголовок новости</label></br>
						<input name="title" value="'.$title.'"></br>
						<label>Дата</label></br>
						<input name="data" value="'.$data.'"></br>
						<label>Категория</label></br>
						<input name="category" value="'.$category.'"></br>
						<label>Анонс новости</label></br>
						<textarea name="anons" value="'.$anons.'"></textarea></br>
						<label>Текст новости</label></br>
						<textarea name="text" value="'.$text.'"></textarea></br>
						<label>Фото новости</label></br>
						<input type="file" name="file[]" multiple></br>
						<button name="submit" type="submit">Добавить</button>
						<button name="clear" type="reset">Очистить</button>
					</form>
				</div>';
			};//добавление записи, конец
			
			if($_GET['type'] == 'ednews'){
				
				$inquiry = mysqli_query($connection, "SELECT * FROM news WHERE id=".$_GET['id']); //запрос на вывод конкретной записи согласно id
				$inq = mysqli_fetch_assoc($inquiry); //подготовим данные к выводу
					
					if(isset($_POST['submit'])){
						if(!empty($_FILES['file']['size'][0])){
							
							for($i=0; $i<count($_FILES['file']['name']); $i++){
						
								if(is_uploaded_file($_FILES['file']['tmp_name'][$i])){
							
									$tmpImage = $_FILES['file']['tmp_name'][$i];
								
									$newImage = $_SERVER['DOCUMENT_ROOT']."/img/clip/news/".$_FILES['file']['name'][$i];
															
									$shortImage = serialize($_FILES['file']['name']);
								
									if(!move_uploaded_file($tmpImage, $newImage)){
										echo "Ошибка при загрузке файла изображения!";
										die();
									}

								}
							}
								$title = $_POST['title'];
								$data = $_POST['data'];
								$category = $_POST['category'];
								$anons = $_POST['anons'];
								$text = $_POST['text'];
								
								$inquiry = mysqli_query($connection, "UPDATE news SET title='$title', data='$data', category='$category', anons='$anons', text='$text', img='$shortImage', imgmin='$minimage' WHERE id=".$_GET['id']);
								header('Location:/admin/index.php?news');
						}else{
								$title = $_POST['title'];
								$data = $_POST['data'];
								$category = $_POST['category'];
								$anons = $_POST['anons'];
								$text = $_POST['text'];
								
								$inquiry = mysqli_query($connection, "UPDATE news SET title='$title', data='$data', category='$category', anons='$anons', text='$text' WHERE id=".$_GET['id']);
								header('Location:/admin/index.php?news');
						};								
					};
					echo'<div class="form">
					<h3>Управление новостями</h3>
					<form method="POST" enctype="multipart/form-data">
						<label>Заголовок новости</label></br>
						<input name="title" value="'.$inq['title'].'"></br>
						<label>Дата</label></br>
						<input name="data" value="'.$inq['data'].'"></br>
						<label>Категория</label></br>
						<input name="category" value="'.$inq['category'].'"></br>
						<label>Анонс новости</label></br>
						<textarea name="anons">'.$inq['anons'].'</textarea></br>
						<label>Текст новости</label></br>
						<textarea name="text">'.$inq['text'].'</textarea></br>
						<label>Фото новости</label></br>
						<input type="file" name="file[]" multiple></br>
						<button name="submit" type="submit">Добавить</button>
						<button name="clear" type="reset">Очистить</button>
					</form>
					</div>';
			};//правка записи, конец

			if($_GET['type'] == 'delnews'){
				$inquiry = mysqli_query($connection, "SELECT * FROM news WHERE id=".$_GET['id']);
				$inq = mysqli_fetch_assoc($inquiry);
				$img = unserialize($inq['img']);
				$imgmin = $inq['imgmin'];
				for($i=0; $i<count($img); $i++){
					unlink($_SERVER['DOCUMENT_ROOT']."/img/clip/news/".$img[$i]);
				}
				//unlink($_SERVER['DOCUMENT_ROOT'].$imgmin);
				$inquiry = mysqli_query($connection, "DELETE FROM news WHERE id=".$_GET['id']);
				header('Location:/admin/index.php?news');
			};//удаление записи, конец
			
//НОВОСТИ КОНЕЦ				
			
			if($_GET['type'] == 'addindexslider'){
				
				if(isset($_POST['submit'])){
					if($_FILES['file']['size'] != 0){
						$tmpImage = $_FILES['file']['tmp_name'];
						$newImage = $_SERVER['DOCUMENT_ROOT']."/img/clip/slyder/".$_FILES['file']['name'];
						$shortImage = "/img/clip/slyder/".$_FILES['file']['name'];
						if(!move_uploaded_file($tmpImage , $newImage)){
							echo "Ошибка при загрузке файла изображения!";
							die();
						}	
					
						$size=GetImageSize ($newImage); //узнаем размер картинки (это массив где 0 и 1 это ширина высота, 2 тип файла(1 - gif, 2 - jpeg, 3 - png), 3 вместе ширина высота)
						
						if ($size[2] == "1"){
										
						//echo "это гиф";
						$src=imagecreatefromgif($newImage);//создаем новую картинку копию той что в $shortImage
										
						}elseif ($size[2] == "2"){
										
						//echo "это jpeg";
						$src=imagecreatefromjpeg($newImage);//создаем новую картинку копию той что в $shortImage
										
						}elseif ($size[2] == "3"){
										
						//echo "это png";
						$src=imagecreatefrompng($newImage);//создаем новую картинку копию той что в $shortImage
										
						}else{
										
						echo "Ошибка!";
										
						};
									
						$iw=$size[0]; //берем значение ширины
									
						$ih=$size[1]; //берем значение высоты
									
						$new_w=ceil(($iw*0)+850); //новое значение ширины
									
						$new_h=ceil(($ih*0)+460); //новое значение высоты
									
						$dst=ImageCreateTrueColor ($new_w, $new_h);//создаем пустое изображение
									
						ImageCopyResampled ($dst, $src, 0, 0, 0, 0, $new_w, $new_h, $iw, $ih);//Данная функция копирует прямоугольную часть изображения в другое изображение, плавно интерполируя пикселные значения таким образом, что, в частности, уменьшение размера изображения сохранит его чёткость и яркость.
									
						if ($size[2] == "1"){
										
						//echo "это гиф";
						imagegif ($dst, $_SERVER['DOCUMENT_ROOT']."/img/clip/slyder/slydermin/".$_FILES['file']['name']);//сохраняем изображение в новом размере, по уазанному пути и с указанным качеством
						$minimage = "/img/clip/slyder/slydermin/".$_FILES['file']['name'];
									
						}elseif ($size[2] == "2"){
										
						//echo "это jpeg";
						imagejpeg ($dst, $_SERVER['DOCUMENT_ROOT']."/img/clip/slyder/slydermin/".$_FILES['file']['name'], 100);//сохраняем изображение в новом размере, по уазанному пути и с указанным качеством
						$minimage = "/img/clip/slyder/slydermin/".$_FILES['file']['name'];
									
						}elseif ($size[2] == "3"){
										
						//echo "это png";
						imagepng ($dst, $_SERVER['DOCUMENT_ROOT']."/img/clip/slyder/slydermin/".$_FILES['file']['name'], 0);//сохраняем изображение в новом размере, по уазанному пути и с указанным качеством
						$minimage = "/img/clip/slyder/slydermin/".$_FILES['file']['name'];
									
						}else{
										
						echo "Неудачно!";
										
						};
									
						imagedestroy($src);
					}
						$title = $_POST['title'];
						$link = $_POST['link'];
						$description = $_POST['description'];
						
						$inquiry = mysqli_query($connection, "INSERT INTO indexslider(title, link, img, imgmin, description) VALUES('$title', '$link', '$shortImage', '$minimage', '$description')");
						header('Location:/admin/index.php?indexslider');
				}								
				echo'<div class="form">
					<h3>Управление индексным слайдером</h3>
					<form method="POST" enctype="multipart/form-data">
						<label>Название слайдера</label></br>
						<input name="title" value="'.$title.'"></br>
						<label>Ссылка</label></br>
						<input name="link" value="'.$link.'"></br>
						<label>Описание</label></br>
						<textarea name="description" value="'.$description.'"></textarea></br>
						<label>Прикрепить фото продукта</label></br>
						<input type="file" name="file"></br>
						<button name="submit" type="submit">Добавить</button>
						<button name="clear" type="reset">Очистить</button>
					</form>
				</div>';
			};//добавление записи, конец
			
			if($_GET['type'] == 'edindexslider'){
				
				$inquiry = mysqli_query($connection, "SELECT * FROM indexslider WHERE id=".$_GET['id']); //запрос на вывод конкретной записи согласно id
				$inq = mysqli_fetch_assoc($inquiry); //подготовим данные к выводу
					
					if(isset($_POST['submit'])){
						if(!empty($_FILES['file']['size'])){
							if($_FILES['file']['size'] != 0){
								$tmpImage = $_FILES['file']['tmp_name'];
								$newImage = $_SERVER['DOCUMENT_ROOT']."/img/clip/slyder/".$_FILES['file']['name'];
								$shortImage = "/img/clip/slyder/".$_FILES['file']['name'];
								if(!move_uploaded_file($tmpImage , $newImage)){
									echo "Ошибка при загрузке файла изображения!";
									die();
								}		
								
								$size=GetImageSize ($newImage); //узнаем размер картинки (это массив где 0 и 1 это ширина высота, 2 тип файла(1 - gif, 2 - jpeg, 3 - png), 3 вместе ширина высота)
							
								if ($size[2] == "1"){
												
								//echo "это гиф";
								$src=imagecreatefromgif($newImage);//создаем новую картинку копию той что в $shortImage
												
								}elseif ($size[2] == "2"){
												
								//echo "это jpeg";
								$src=imagecreatefromjpeg($newImage);//создаем новую картинку копию той что в $shortImage
												
								}elseif ($size[2] == "3"){
												
								//echo "это png";
								$src=imagecreatefrompng($newImage);//создаем новую картинку копию той что в $shortImage
												
								}else{
												
								echo "Ошибка!";
												
								};
											
								$iw=$size[0]; //берем значение ширины
											
								$ih=$size[1]; //берем значение высоты
											
								$new_w=ceil(($iw*0)+850); //новое значение ширины
											
								$new_h=ceil(($ih*0)+460); //новое значение высоты
											
								$dst=ImageCreateTrueColor ($new_w, $new_h);//создаем пустое изображение
											
								ImageCopyResampled ($dst, $src, 0, 0, 0, 0, $new_w, $new_h, $iw, $ih);//Данная функция копирует прямоугольную часть изображения в другое изображение, плавно интерполируя пикселные значения таким образом, что, в частности, уменьшение размера изображения сохранит его чёткость и яркость.
											
								if ($size[2] == "1"){
												
								//echo "это гиф";
								imagegif ($dst, $_SERVER['DOCUMENT_ROOT']."/img/clip/slyder/slydermin/".$_FILES['file']['name']);//сохраняем изображение в новом размере, по уазанному пути и с указанным качеством
								$minimage = "/img/clip/slyder/slydermin/".$_FILES['file']['name'];
											
								}elseif ($size[2] == "2"){
												
								//echo "это jpeg";
								imagejpeg ($dst, $_SERVER['DOCUMENT_ROOT']."/img/clip/slyder/slydermin/".$_FILES['file']['name'], 100);//сохраняем изображение в новом размере, по уазанному пути и с указанным качеством
								$minimage = "/img/clip/slyder/slydermin/".$_FILES['file']['name'];
											
								}elseif ($size[2] == "3"){
												
								//echo "это png";
								imagepng ($dst, $_SERVER['DOCUMENT_ROOT']."/img/clip/slyder/slydermin/".$_FILES['file']['name'], 0);//сохраняем изображение в новом размере, по уазанному пути и с указанным качеством
								$minimage = "/img/clip/slyder/slydermin/".$_FILES['file']['name'];
											
								}else{
												
								echo "Неудачно!";
												
								};
											
								imagedestroy($src);
							}
								$title = $_POST['title'];
								$link = $_POST['link'];
								$description = $_POST['description'];
								
								$inquiry = mysqli_query($connection, "UPDATE indexslider SET title='$title', link='$link', img='$shortImage', imgmin='$minimage', description='$description' WHERE id=".$_GET['id']);
								header('Location:/admin/index.php?indexslider');
						}else{
								$title = $_POST['title'];
								$link = $_POST['link'];
								$description = $_POST['description'];
								
								$inquiry = mysqli_query($connection, "UPDATE indexslider SET title='$title', link='$link', description='$description' WHERE id=".$_GET['id']);
								header('Location:/admin/index.php?indexslider');
						};								
					};
					echo'<div class="form">
					<h3>Управление индексным слайдером</h3>
					<form method="POST" enctype="multipart/form-data">
						<label>Название слайдера</label></br>
						<input name="title" value="'.$inq['title'].'"></br>
						<label>Ссылка</label></br>
						<input name="link" value="'.$inq['link'].'"></br>
						<label>Описание</label></br>
						<textarea name="description">'.$inq['description'].'</textarea></br>
						<label>Прикрепить фото продукта</label></br>
						<input type="file" name="file"></br>
						<button name="submit" type="submit">Добавить</button>
						<button name="clear" type="reset">Очистить</button>
					</form>
					</div>';
			};//правка записи, конец

			if($_GET['type'] == 'delindexslider'){
				$inquiry = mysqli_query($connection, "SELECT * FROM indexslider WHERE id=".$_GET['id']);
				$inq = mysqli_fetch_assoc($inquiry);
				$img = $inq['img'];
				$imgmin = $inq['imgmin'];
				unlink($_SERVER['DOCUMENT_ROOT'].$img);
				unlink($_SERVER['DOCUMENT_ROOT'].$imgmin);
				$inquiry = mysqli_query($connection, "DELETE FROM indexslider WHERE id=".$_GET['id']);
				header('Location:/admin/index.php?indexslider');
			};//удаление записи, конец
			
//ИНДЕКССЛАЙДЕР КОНЕЦ			
			
				if($_GET['type'] == 'addrewards'){
				
				if(isset($_POST['submit'])){
					if($_FILES['file']['size'] != 0){
						$tmpImage = $_FILES['file']['tmp_name'];
						$newImage = $_SERVER['DOCUMENT_ROOT']."/img/clip/rewards/".$_FILES['file']['name'];
						$shortImage = "/img/clip/rewards/".$_FILES['file']['name'];
						if(!move_uploaded_file($tmpImage , $newImage)){
							echo "Ошибка при загрузке файла изображения!";
							die();
						}	
					
						$size=GetImageSize ($newImage); //узнаем размер картинки (это массив где 0 и 1 это ширина высота, 2 тип файла(1 - gif, 2 - jpeg, 3 - png), 3 вместе ширина высота)
						
						if ($size[2] == "1"){
										
						//echo "это гиф";
						$src=imagecreatefromgif($newImage);//создаем новую картинку копию той что в $shortImage
										
						}elseif ($size[2] == "2"){
										
						//echo "это jpeg";
						$src=imagecreatefromjpeg($newImage);//создаем новую картинку копию той что в $shortImage
										
						}elseif ($size[2] == "3"){
										
						//echo "это png";
						$src=imagecreatefrompng($newImage);//создаем новую картинку копию той что в $shortImage
										
						}else{
										
						echo "Ошибка!";
										
						};
									
						$iw=$size[0]; //берем значение ширины
									
						$ih=$size[1]; //берем значение высоты
									
						$new_w=ceil(($iw*0)+140); //новое значение ширины
									
						$new_h=ceil(($ih*0)+197); //новое значение высоты
									
						$dst=ImageCreateTrueColor ($new_w, $new_h);//создаем пустое изображение
									
						ImageCopyResampled ($dst, $src, 0, 0, 0, 0, $new_w, $new_h, $iw, $ih);//Данная функция копирует прямоугольную часть изображения в другое изображение, плавно интерполируя пикселные значения таким образом, что, в частности, уменьшение размера изображения сохранит его чёткость и яркость.
									
						if ($size[2] == "1"){
										
						//echo "это гиф";
						imagegif ($dst, $_SERVER['DOCUMENT_ROOT']."/img/clip/rewards/rewardsmin/".$_FILES['file']['name']);//сохраняем изображение в новом размере, по уазанному пути и с указанным качеством
						$minimage = "/img/clip/rewards/rewardsmin/".$_FILES['file']['name'];
									
						}elseif ($size[2] == "2"){
										
						//echo "это jpeg";
						imagejpeg ($dst, $_SERVER['DOCUMENT_ROOT']."/img/clip/rewards/rewardsmin/".$_FILES['file']['name'], 100);//сохраняем изображение в новом размере, по уазанному пути и с указанным качеством
						$minimage = "/img/clip/rewards/rewardsmin/".$_FILES['file']['name'];
									
						}elseif ($size[2] == "3"){
										
						//echo "это png";
						imagepng ($dst, $_SERVER['DOCUMENT_ROOT']."/img/clip/rewards/rewardsmin/".$_FILES['file']['name'], 0);//сохраняем изображение в новом размере, по уазанному пути и с указанным качеством
						$minimage = "/img/clip/rewards/rewardsmin/".$_FILES['file']['name'];
									
						}else{
										
						echo "Неудачно!";
										
						};
									
						imagedestroy($src);
					}
						$title = $_POST['title'];
						$description = $_POST['description'];
						
						$inquiry = mysqli_query($connection, "INSERT INTO rewards(title, img, imgmin, description) VALUES('$title', '$shortImage', '$minimage', '$description')");
						header('Location:/admin/index.php?rewards');
				}								
				echo'<div class="form">
					<h3>Управление наградами</h3>
					<form method="POST" enctype="multipart/form-data">
						<label>Название слайдера</label></br>
						<input name="title" value="'.$title.'"></br>
						<label>Описание</label></br>
						<textarea name="description" value="'.$description.'"></textarea></br>
						<label>Прикрепить фото продукта</label></br>
						<input type="file" name="file"></br>
						<button name="submit" type="submit">Добавить</button>
						<button name="clear" type="reset">Очистить</button>
					</form>
				</div>';
			};//добавление записи, конец
			
			if($_GET['type'] == 'edrewards'){
				
				$inquiry = mysqli_query($connection, "SELECT * FROM rewards WHERE id=".$_GET['id']); //запрос на вывод конкретной записи согласно id
				$inq = mysqli_fetch_assoc($inquiry); //подготовим данные к выводу
					
					if(isset($_POST['submit'])){
						if(!empty($_FILES['file']['size'])){
							if($_FILES['file']['size'] != 0){
								$tmpImage = $_FILES['file']['tmp_name'];
								$newImage = $_SERVER['DOCUMENT_ROOT']."/img/clip/rewards/".$_FILES['file']['name'];
								$shortImage = "/img/clip/rewards/".$_FILES['file']['name'];
								if(!move_uploaded_file($tmpImage , $newImage)){
									echo "Ошибка при загрузке файла изображения!";
									die();
								}		
								
							$size=GetImageSize ($newImage); //узнаем размер картинки (это массив где 0 и 1 это ширина высота, 2 тип файла(1 - gif, 2 - jpeg, 3 - png), 3 вместе ширина высота)
						
							if ($size[2] == "1"){
												
							//echo "это гиф";
							$src=imagecreatefromgif($newImage);//создаем новую картинку копию той что в $shortImage
												
							}elseif ($size[2] == "2"){
												
							//echo "это jpeg";
							$src=imagecreatefromjpeg($newImage);//создаем новую картинку копию той что в $shortImage
												
							}elseif ($size[2] == "3"){
												
							//echo "это png";
							$src=imagecreatefrompng($newImage);//создаем новую картинку копию той что в $shortImage
												
							}else{
												
							echo "Ошибка!";
												
							};
											
							$iw=$size[0]; //берем значение ширины
											
							$ih=$size[1]; //берем значение высоты
											
							$new_w=ceil(($iw*0)+140); //новое значение ширины
											
							$new_h=ceil(($ih*0)+197); //новое значение высоты
											
							$dst=ImageCreateTrueColor ($new_w, $new_h);//создаем пустое изображение
											
							ImageCopyResampled ($dst, $src, 0, 0, 0, 0, $new_w, $new_h, $iw, $ih);//Данная функция копирует прямоугольную часть изображения в другое изображение, плавно интерполируя пикселные значения таким образом, что, в частности, уменьшение размера изображения сохранит его чёткость и яркость.
											
							if ($size[2] == "1"){
												
							//echo "это гиф";
							imagegif ($dst, $_SERVER['DOCUMENT_ROOT']."/img/clip/rewards/rewardsmin/".$_FILES['file']['name']);//сохраняем изображение в новом размере, по уазанному пути и с указанным качеством
							$minimage = "/img/clip/rewards/rewardsmin/".$_FILES['file']['name'];
											
							}elseif ($size[2] == "2"){
												
							//echo "это jpeg";
							imagejpeg ($dst, $_SERVER['DOCUMENT_ROOT']."/img/clip/rewards/rewardsmin/".$_FILES['file']['name'], 100);//сохраняем изображение в новом размере, по уазанному пути и с указанным качеством
							$minimage = "/img/clip/rewards/rewardsmin/".$_FILES['file']['name'];
											
							}elseif ($size[2] == "3"){
												
							//echo "это png";
							imagepng ($dst, $_SERVER['DOCUMENT_ROOT']."/img/clip/rewards/rewardsmin/".$_FILES['file']['name'], 0);//сохраняем изображение в новом размере, по уазанному пути и с указанным качеством
							$minimage = "/img/clip/rewards/rewardsmin/".$_FILES['file']['name'];
											
						}else{
												
							echo "Неудачно!";
												
						};
											
						imagedestroy($src);
						}		
						$title = $_POST['title'];
						$description = $_POST['description'];
								
						$inquiry = mysqli_query($connection, "UPDATE rewards SET title='$title', img='$shortImage', imgmin='$minimage', description='$description' WHERE id=".$_GET['id']);
						header('Location:/admin/index.php?rewards');
						}else{
						
						$title = $_POST['title'];
						$description = $_POST['description'];
								
						$inquiry = mysqli_query($connection, "UPDATE rewards SET title='$title', description='$description' WHERE id=".$_GET['id']);
						header('Location:/admin/index.php?rewards');
						};								
					};
					echo'<div class="form">
					<h3>Управление индексным слайдером</h3>
					<form method="POST" enctype="multipart/form-data">
						<label>Название слайдера</label></br>
						<input name="title" value="'.$inq['title'].'"></br>
						<label>Описание</label></br>
						<textarea name="description">'.$inq['description'].'</textarea></br>
						<label>Прикрепить фото продукта</label></br>
						<input type="file" name="file"></br>
						<button name="submit" type="submit">Добавить</button>
						<button name="clear" type="reset">Очистить</button>
					</form>
					</div>';
			};//правка записи, конец

			if($_GET['type'] == 'delrewards'){
				$inquiry = mysqli_query($connection, "SELECT * FROM rewards WHERE id=".$_GET['id']);
				$inq = mysqli_fetch_assoc($inquiry);
				$img = $inq['img'];
				$imgmin = $inq['imgmin'];
				unlink($_SERVER['DOCUMENT_ROOT'].$img);
				unlink($_SERVER['DOCUMENT_ROOT'].$imgmin);
				$inquiry = mysqli_query($connection, "DELETE FROM rewards WHERE id=".$_GET['id']);
				header('Location:/admin/index.php?rewards');
			};//удаление записи, конец
			
//НАГРАДЫ КОНЕЦ			
			
			if($_GET['type'] == 'addvacancies'){
				
				if(isset($_POST['submit'])){
						$title = $_POST['title'];
						$description = $_POST['description'];
						$contacts = $_POST['contacts']; 
						$date = $_POST['date'];
						$inquiry = mysqli_query($connection, "INSERT INTO vacancies(title, contacts, date, description) VALUES('$title', '$contacts', '$date', '$description')");
						header('Location:/admin/index.php?vacancies');
				}								
				echo'<div class="form">
					<h3>Управление вакансиями</h3>
					<form method="POST" enctype="multipart/form-data">
						<label>Название вакансии</label></br>
						<input name="title" value="'.$title.'"></br>
						<label>Контакты</label></br>
						<input name="contacts" value="'.$contacts.'"></br>
						<label>Дата размещения вакансии</label></br>
						<input name="date" value="'.$date.'"></br>
						<label>Описание вакансии</label></br>
						<textarea name="description" value="'.$description.'"></textarea></br>
						<button name="submit" type="submit">Добавить</button>
						<button name="clear" type="reset">Очистить</button>
					</form>
				</div>';
			};//добавление записи, конец
			
			if($_GET['type'] == 'edvacancies'){
				
				$inquiry = mysqli_query($connection, "SELECT * FROM vacancies WHERE id=".$_GET['id']); //запрос на вывод конкретной записи согласно id
				$inq = mysqli_fetch_assoc($inquiry); //подготовим данные к выводу
					
					if(isset($_POST['submit'])){
						
						$title = $_POST['title'];
						$description = $_POST['description'];
						$contacts = $_POST['contacts']; 
						$date = $_POST['date'];
						$inquiry = mysqli_query($connection, "UPDATE vacancies SET title='$title', date='$date', contacts='$contacts', description='$description' WHERE id=".$_GET['id']);
						header('Location:/admin/index.php?vacancies');
					};
					echo'<div class="form">
					<h3>Управление вакансиями</h3>
					<form method="POST" enctype="multipart/form-data">
						<label>Название вакансии</label></br>
						<input name="title" value="'.$inq['title'].'"></br>
						<label>Контакты</label></br>
						<input name="contacts" value="'.$inq['contacts'].'"></br>
						<label>Дата размещения вакансии</label></br>
						<input name="date" value="'.$inq['date'].'"></br>
						<label>Описание вакансии</label></br>
						<textarea name="description" value="">'.$inq['description'].'</textarea></br>
						<button name="submit" type="submit">Добавить</button>
						<button name="clear" type="reset">Очистить</button>
					</form>
				</div>';
			};//правка записи, конец

			if($_GET['type'] == 'delvacancies'){
				$inquiry = mysqli_query($connection, "DELETE FROM vacancies WHERE id=".$_GET['id']);
				header('Location:/admin/index.php?vacancies');
			};//удаление записи, конец
			
//ВАКАНСИИ КОНЕЦ				
			
			if($_GET['type'] == 'addclub'){
				
				if(isset($_POST['submit'])){
					if($_FILES['file1']['size'] != 0){
//фото 1
						$tmpImage = $_FILES['file1']['tmp_name'];
						$newImage = $_SERVER['DOCUMENT_ROOT']."/img/clip/club/".$_FILES['file1']['name'];
						$shortImage = "/img/clip/club/".$_FILES['file1']['name'];
						
						if(!move_uploaded_file($tmpImage, $newImage)){
							echo "Ошибка при загрузке файла изображения!";
							die();
						}
						
						$size=GetImageSize ($newImage); //узнаем размер картинки (это массив где 0 и 1 это ширина высота, 2 тип файла(1 - gif, 2 - jpeg, 3 - png), 3 вместе ширина высота)
					
							if ($size[2] == "1"){
									
							//echo "это гиф";
								$src=imagecreatefromgif($newImage);//создаем новую картинку копию той что в $shortImage
									
							}elseif ($size[2] == "2"){
									
								//echo "это jpeg";
								$src=imagecreatefromjpeg($newImage);//создаем новую картинку копию той что в $shortImage
									
							}elseif ($size[2] == "3"){
									
								//echo "это png";
								$src=imagecreatefrompng($newImage);//создаем новую картинку копию той что в $shortImage
									
							}else{
									
								echo "Ошибка!";
									
							};
								
							$iw=$size[0]; //берем значение ширины
								
							$ih=$size[1]; //берем значение высоты
								
							$new_w=ceil(($iw*0)+800); //новое значение ширины
								
							$new_h=ceil(($ih*0)+600); //новое значение высоты
								
							$dst=ImageCreateTrueColor ($new_w, $new_h);//создаем пустое изображение
								
							ImageCopyResampled ($dst, $src, 0, 0, 0, 0, $new_w, $new_h, $iw, $ih);//Данная функция копирует прямоугольную часть изображения в другое изображение, плавно интерполируя пикселные значения таким образом, что, в частности, уменьшение размера изображения сохранит его чёткость и яркость.
								
							if ($size[2] == "1"){
									
								//echo "это гиф";
								imagegif ($dst, $_SERVER['DOCUMENT_ROOT']."/img/clip/club/clubmin/".$_FILES['file1']['name']);//сохраняем изображение в новом размере, по уазанному пути и с указанным качеством
								$minimage = "/img/clip/club/clubmin/".$_FILES['file1']['name'];
								
							}elseif ($size[2] == "2"){
									
								//echo "это jpeg";
								imagejpeg ($dst, $_SERVER['DOCUMENT_ROOT']."/img/clip/club/clubmin/".$_FILES['file1']['name'], 100);//сохраняем изображение в новом размере, по уазанному пути и с указанным качеством
								$minimage = "/img/clip/club/clubmin/".$_FILES['file1']['name'];
								
							}elseif ($size[2] == "3"){
									
								//echo "это png";
								imagepng ($dst, $_SERVER['DOCUMENT_ROOT']."/img/clip/club/clubmin/".$_FILES['file1']['name'], 0);//сохраняем изображение в новом размере, по уазанному пути и с указанным качеством
								$minimage = "/img/clip/club/clubmin/".$_FILES['file1']['name'];
								
							}else{
									
								echo "Неудачно!";
									
							};
								
							imagedestroy($src);
							
//фото 2
							$tmpImage2 = $_FILES['file2']['tmp_name'];
							$newImage2 = $_SERVER['DOCUMENT_ROOT']."/img/clip/club/".$_FILES['file2']['name'];
							$shortImage2 = "/img/clip/club/".$_FILES['file2']['name'];
							
							if(!move_uploaded_file($tmpImage2, $newImage2)){
							echo "Ошибка при загрузке файла изображения!";
							die();
							}
						
							$size2=GetImageSize ($newImage2); //узнаем размер картинки (это массив где 0 и 1 это ширина высота, 2 тип файла(1 - gif, 2 - jpeg, 3 - png), 3 вместе ширина высота)
					
							if ($size2[2] == "1"){
									
								//echo "это гиф";
								$src2=imagecreatefromgif($newImage2);//создаем новую картинку копию той что в $shortImage
									
							}elseif ($size2[2] == "2"){
									
								//echo "это jpeg";
								$src2=imagecreatefromjpeg($newImage2);//создаем новую картинку копию той что в $shortImage
									
							}elseif ($size2[2] == "3"){
									
								//echo "это png";
								$src2=imagecreatefrompng($newImage2);//создаем новую картинку копию той что в $shortImage
									
							}else{
									
								echo "Ошибка!";
									
							};
								
							$iw2=$size2[0]; //берем значение ширины
								
							$ih2=$size2[1]; //берем значение высоты
								
							$new_w2=ceil(($iw2*0)+800); //новое значение ширины
								
							$new_h2=ceil(($ih2*0)+600); //новое значение высоты
								
							$dst2=ImageCreateTrueColor ($new_w2, $new_h2);//создаем пустое изображение
								
							ImageCopyResampled ($dst2, $src2, 0, 0, 0, 0, $new_w2, $new_h2, $iw2, $ih2);//Данная функция копирует прямоугольную часть изображения в другое изображение, плавно интерполируя пикселные значения таким образом, что, в частности, уменьшение размера изображения сохранит его чёткость и яркость.
								
							if ($size2[2] == "1"){
									
								//echo "это гиф";
								imagegif ($dst2, $_SERVER['DOCUMENT_ROOT']."/img/clip/club/clubmin/".$_FILES['file2']['name']);//сохраняем изображение в новом размере, по уазанному пути и с указанным качеством
								$minimage2 = "/img/clip/club/clubmin/".$_FILES['file2']['name'];
								
							}elseif ($size2[2] == "2"){
									
								//echo "это jpeg";
								imagejpeg ($dst2, $_SERVER['DOCUMENT_ROOT']."/img/clip/club/clubmin/".$_FILES['file2']['name'], 100);//сохраняем изображение в новом размере, по уазанному пути и с указанным качеством
								$minimage2 = "/img/clip/club/clubmin/".$_FILES['file2']['name'];
								
							}elseif ($size2[2] == "3"){
									
								//echo "это png";
								imagepng ($dst2, $_SERVER['DOCUMENT_ROOT']."/img/clip/club/clubmin/".$_FILES['file2']['name'], 0);//сохраняем изображение в новом размере, по уазанному пути и с указанным качеством
								$minimage2 = "/img/clip/club/clubmin/".$_FILES['file2']['name'];
								
							}else{
									
								echo "Неудачно!";
									
							};
								
							imagedestroy($src2);
							
//фото 3
							$tmpImage3 = $_FILES['file3']['tmp_name'];
							$newImage3 = $_SERVER['DOCUMENT_ROOT']."/img/clip/club/".$_FILES['file3']['name'];
							$shortImage3 = "/img/clip/club/".$_FILES['file3']['name'];
							
							if(!move_uploaded_file($tmpImage3, $newImage3)){
							echo "Ошибка при загрузке файла изображения!";
							die();
							}
														
							$size3=GetImageSize ($newImage3); //узнаем размер картинки (это массив где 0 и 1 это ширина высота, 2 тип файла(1 - gif, 2 - jpeg, 3 - png), 3 вместе ширина высота)
					
							if ($size3[2] == "1"){
									
								//echo "это гиф";
								$src3=imagecreatefromgif($newImage3);//создаем новую картинку копию той что в $shortImage
									
							}elseif ($size3[2] == "2"){
									
								//echo "это jpeg";
								$src3=imagecreatefromjpeg($newImage3);//создаем новую картинку копию той что в $shortImage
									
							}elseif ($size3[2] == "3"){
									
								//echo "это png";
								$src3=imagecreatefrompng($newImage3);//создаем новую картинку копию той что в $shortImage
									
							}else{
									
								echo "Ошибка!";
									
							};
								
							$iw3=$size3[0]; //берем значение ширины
								
							$ih3=$size3[1]; //берем значение высоты
								
							$new_w3=ceil(($iw3*0)+800); //новое значение ширины
								
							$new_h3=ceil(($ih3*0)+600); //новое значение высоты
								
							$dst3=ImageCreateTrueColor ($new_w3, $new_h3);//создаем пустое изображение
								
							ImageCopyResampled ($dst3, $src3, 0, 0, 0, 0, $new_w3, $new_h3, $iw3, $ih3);//Данная функция копирует прямоугольную часть изображения в другое изображение, плавно интерполируя пикселные значения таким образом, что, в частности, уменьшение размера изображения сохранит его чёткость и яркость.
								
							if ($size3[2] == "1"){
									
								//echo "это гиф";
								imagegif ($dst3, $_SERVER['DOCUMENT_ROOT']."/img/clip/club/clubmin/".$_FILES['file3']['name']);//сохраняем изображение в новом размере, по уазанному пути и с указанным качеством
								$minimage3 = "/img/clip/club/clubmin/".$_FILES['file3']['name'];
								
							}elseif ($size3[2] == "2"){
									
								//echo "это jpeg";
								imagejpeg ($dst3, $_SERVER['DOCUMENT_ROOT']."/img/clip/club/clubmin/".$_FILES['file3']['name'], 100);//сохраняем изображение в новом размере, по уазанному пути и с указанным качеством
								$minimage3 = "/img/clip/club/clubmin/".$_FILES['file3']['name'];
								
							}elseif ($size3[2] == "3"){
									
								//echo "это png";
								imagepng ($dst3, $_SERVER['DOCUMENT_ROOT']."/img/clip/club/clubmin/".$_FILES['file3']['name'], 0);//сохраняем изображение в новом размере, по уазанному пути и с указанным качеством
								$minimage3 = "/img/clip/club/clubmin/".$_FILES['file3']['name'];
								
							}else{
									
								echo "Неудачно!";
									
							};
								
							imagedestroy($src3);
							
					}
						$title = $_POST['title'];
						$superintendent = $_POST['superintendent'];
						$contacts = $_POST['contacts'];
						$about = $_POST['about'];
						
						$inquiry = mysqli_query($connection, "INSERT INTO club(title, superintendent, contacts, about, img1, img2, img3, imgmin1, imgmin2, imgmin3) VALUES('$title', '$superintendent', '$contacts', '$about', '$shortImage', '$shortImage2', '$shortImage3', '$minimage', '$minimage2', '$minimage3')");
						header('Location:/admin/index.php?club');
				}									
				echo'<div class="form">
					<h3>Управление баннерами</h3>
					<form method="POST" enctype="multipart/form-data">
						<label>Название клуба</label></br>
						<input name="title" value="'.$title.'"></br>
						<label>Руководитель</label></br>
						<input name="superintendent" value="'.$superintendent.'"></br>
						<label>Контакты</label></br>
						<input name="contacts" value="'.$contacts.'"></br>
						<label>Описание клуба</label></br>
						<textarea name="about" value="'.$about.'"></textarea></br>
						
						<label>Фото клуба 1</label></br>
						<input type="file" name="file1"></br>
						<label>Фото клуба 2</label></br>
						<input type="file" name="file2"></br>
						<label>Фото клуба 3</label></br>
						<input type="file" name="file3"></br>
						
						<button name="submit" type="submit">Добавить</button>
						<button name="clear" type="reset">Очистить</button>
					</form>
				</div>';
			};//добавление записи, конец
			
			if($_GET['type'] == 'edclub'){
				
				$inquiry = mysqli_query($connection, "SELECT * FROM club WHERE id=".$_GET['id']); //запрос на вывод конкретной записи согласно id
				$inq = mysqli_fetch_assoc($inquiry); //подготовим данные к выводу
					
					if(isset($_POST['submit'])){
						if(!empty($_FILES['file1']['size'])){
							if($_FILES['file1']['size'] != 0){
//фото 1
						$tmpImage = $_FILES['file1']['tmp_name'];
						$newImage = $_SERVER['DOCUMENT_ROOT']."/img/clip/club/".$_FILES['file1']['name'];
						$shortImage = "/img/clip/club/".$_FILES['file1']['name'];
						
						if(!move_uploaded_file($tmpImage, $newImage)){
							echo "Ошибка при загрузке файла изображения!";
							die();
						}
						
						$size=GetImageSize ($newImage); //узнаем размер картинки (это массив где 0 и 1 это ширина высота, 2 тип файла(1 - gif, 2 - jpeg, 3 - png), 3 вместе ширина высота)
					
							if ($size[2] == "1"){
									
							//echo "это гиф";
								$src=imagecreatefromgif($newImage);//создаем новую картинку копию той что в $shortImage
									
							}elseif ($size[2] == "2"){
									
								//echo "это jpeg";
								$src=imagecreatefromjpeg($newImage);//создаем новую картинку копию той что в $shortImage
									
							}elseif ($size[2] == "3"){
									
								//echo "это png";
								$src=imagecreatefrompng($newImage);//создаем новую картинку копию той что в $shortImage
									
							}else{
									
								echo "Ошибка!";
									
							};
								
							$iw=$size[0]; //берем значение ширины
								
							$ih=$size[1]; //берем значение высоты
								
							$new_w=ceil(($iw*0)+800); //новое значение ширины
								
							$new_h=ceil(($ih*0)+600); //новое значение высоты
								
							$dst=ImageCreateTrueColor ($new_w, $new_h);//создаем пустое изображение
								
							ImageCopyResampled ($dst, $src, 0, 0, 0, 0, $new_w, $new_h, $iw, $ih);//Данная функция копирует прямоугольную часть изображения в другое изображение, плавно интерполируя пикселные значения таким образом, что, в частности, уменьшение размера изображения сохранит его чёткость и яркость.
								
							if ($size[2] == "1"){
									
								//echo "это гиф";
								imagegif ($dst, $_SERVER['DOCUMENT_ROOT']."/img/clip/club/clubmin/".$_FILES['file1']['name']);//сохраняем изображение в новом размере, по уазанному пути и с указанным качеством
								$minimage = "/img/clip/club/clubmin/".$_FILES['file1']['name'];
								
							}elseif ($size[2] == "2"){
									
								//echo "это jpeg";
								imagejpeg ($dst, $_SERVER['DOCUMENT_ROOT']."/img/clip/club/clubmin/".$_FILES['file1']['name'], 100);//сохраняем изображение в новом размере, по уазанному пути и с указанным качеством
								$minimage = "/img/clip/club/clubmin/".$_FILES['file1']['name'];
								
							}elseif ($size[2] == "3"){
									
								//echo "это png";
								imagepng ($dst, $_SERVER['DOCUMENT_ROOT']."/img/clip/club/clubmin/".$_FILES['file1']['name'], 0);//сохраняем изображение в новом размере, по уазанному пути и с указанным качеством
								$minimage = "/img/clip/club/clubmin/".$_FILES['file1']['name'];
								
							}else{
									
								echo "Неудачно!";
									
							};
								
							imagedestroy($src);
							
//фото 2
							$tmpImage2 = $_FILES['file2']['tmp_name'];
							$newImage2 = $_SERVER['DOCUMENT_ROOT']."/img/clip/club/".$_FILES['file2']['name'];
							$shortImage2 = "/img/clip/club/".$_FILES['file2']['name'];
							
							if(!move_uploaded_file($tmpImage2, $newImage2)){
							echo "Ошибка при загрузке файла изображения!";
							die();
							}
						
							$size2=GetImageSize ($newImage2); //узнаем размер картинки (это массив где 0 и 1 это ширина высота, 2 тип файла(1 - gif, 2 - jpeg, 3 - png), 3 вместе ширина высота)
					
							if ($size2[2] == "1"){
									
								//echo "это гиф";
								$src2=imagecreatefromgif($newImage2);//создаем новую картинку копию той что в $shortImage
									
							}elseif ($size2[2] == "2"){
									
								//echo "это jpeg";
								$src2=imagecreatefromjpeg($newImage2);//создаем новую картинку копию той что в $shortImage
									
							}elseif ($size2[2] == "3"){
									
								//echo "это png";
								$src2=imagecreatefrompng($newImage2);//создаем новую картинку копию той что в $shortImage
									
							}else{
									
								echo "Ошибка!";
									
							};
								
							$iw2=$size2[0]; //берем значение ширины
								
							$ih2=$size2[1]; //берем значение высоты
								
							$new_w2=ceil(($iw2*0)+800); //новое значение ширины
								
							$new_h2=ceil(($ih2*0)+600); //новое значение высоты
								
							$dst2=ImageCreateTrueColor ($new_w2, $new_h2);//создаем пустое изображение
								
							ImageCopyResampled ($dst2, $src2, 0, 0, 0, 0, $new_w2, $new_h2, $iw2, $ih2);//Данная функция копирует прямоугольную часть изображения в другое изображение, плавно интерполируя пикселные значения таким образом, что, в частности, уменьшение размера изображения сохранит его чёткость и яркость.
								
							if ($size2[2] == "1"){
									
								//echo "это гиф";
								imagegif ($dst2, $_SERVER['DOCUMENT_ROOT']."/img/clip/club/clubmin/".$_FILES['file2']['name']);//сохраняем изображение в новом размере, по уазанному пути и с указанным качеством
								$minimage2 = "/img/clip/club/clubmin/".$_FILES['file2']['name'];
								
							}elseif ($size2[2] == "2"){
									
								//echo "это jpeg";
								imagejpeg ($dst2, $_SERVER['DOCUMENT_ROOT']."/img/clip/club/clubmin/".$_FILES['file2']['name'], 100);//сохраняем изображение в новом размере, по уазанному пути и с указанным качеством
								$minimage2 = "/img/clip/club/clubmin/".$_FILES['file2']['name'];
								
							}elseif ($size2[2] == "3"){
									
								//echo "это png";
								imagepng ($dst2, $_SERVER['DOCUMENT_ROOT']."/img/clip/club/clubmin/".$_FILES['file2']['name'], 0);//сохраняем изображение в новом размере, по уазанному пути и с указанным качеством
								$minimage2 = "/img/clip/club/clubmin/".$_FILES['file2']['name'];
								
							}else{
									
								echo "Неудачно!";
									
							};
								
							imagedestroy($src2);
							
//фото 3
							$tmpImage3 = $_FILES['file3']['tmp_name'];
							$newImage3 = $_SERVER['DOCUMENT_ROOT']."/img/clip/club/".$_FILES['file3']['name'];
							$shortImage3 = "/img/clip/club/".$_FILES['file3']['name'];
							
							if(!move_uploaded_file($tmpImage3, $newImage3)){
							echo "Ошибка при загрузке файла изображения!";
							die();
							}
														
							$size3=GetImageSize ($newImage3); //узнаем размер картинки (это массив где 0 и 1 это ширина высота, 2 тип файла(1 - gif, 2 - jpeg, 3 - png), 3 вместе ширина высота)
					
							if ($size3[2] == "1"){
									
								//echo "это гиф";
								$src3=imagecreatefromgif($newImage3);//создаем новую картинку копию той что в $shortImage
									
							}elseif ($size3[2] == "2"){
									
								//echo "это jpeg";
								$src3=imagecreatefromjpeg($newImage3);//создаем новую картинку копию той что в $shortImage
									
							}elseif ($size3[2] == "3"){
									
								//echo "это png";
								$src3=imagecreatefrompng($newImage3);//создаем новую картинку копию той что в $shortImage
									
							}else{
									
								echo "Ошибка!";
									
							};
								
							$iw3=$size3[0]; //берем значение ширины
								
							$ih3=$size3[1]; //берем значение высоты
								
							$new_w3=ceil(($iw3*0)+800); //новое значение ширины
								
							$new_h3=ceil(($ih3*0)+600); //новое значение высоты
								
							$dst3=ImageCreateTrueColor ($new_w3, $new_h3);//создаем пустое изображение
								
							ImageCopyResampled ($dst3, $src3, 0, 0, 0, 0, $new_w3, $new_h3, $iw3, $ih3);//Данная функция копирует прямоугольную часть изображения в другое изображение, плавно интерполируя пикселные значения таким образом, что, в частности, уменьшение размера изображения сохранит его чёткость и яркость.
								
							if ($size3[2] == "1"){
									
								//echo "это гиф";
								imagegif ($dst3, $_SERVER['DOCUMENT_ROOT']."/img/clip/club/clubmin/".$_FILES['file3']['name']);//сохраняем изображение в новом размере, по уазанному пути и с указанным качеством
								$minimage3 = "/img/clip/club/clubmin/".$_FILES['file3']['name'];
								
							}elseif ($size3[2] == "2"){
									
								//echo "это jpeg";
								imagejpeg ($dst3, $_SERVER['DOCUMENT_ROOT']."/img/clip/club/clubmin/".$_FILES['file3']['name'], 100);//сохраняем изображение в новом размере, по уазанному пути и с указанным качеством
								$minimage3 = "/img/clip/club/clubmin/".$_FILES['file3']['name'];
								
							}elseif ($size3[2] == "3"){
									
								//echo "это png";
								imagepng ($dst3, $_SERVER['DOCUMENT_ROOT']."/img/clip/club/clubmin/".$_FILES['file3']['name'], 0);//сохраняем изображение в новом размере, по уазанному пути и с указанным качеством
								$minimage3 = "/img/clip/club/clubmin/".$_FILES['file3']['name'];
								
							}else{
									
								echo "Неудачно!";
									
							};
								
							imagedestroy($src3);
							
						}
								$title = $_POST['title'];
								$superintendent = $_POST['superintendent'];
								$contacts = $_POST['contacts'];
								$about = $_POST['about'];
																
								$inquiry = mysqli_query($connection, "UPDATE club SET title='$title', superintendent='$superintendent', contacts='$contacts', about='$about', img1='$shortImage', img2='$shortImage2', img3='$shortImage3', imgmin1='$minimage', imgmin2='$minimage2', imgmin3='$minimage3' WHERE id=".$_GET['id']);
								header('Location:/admin/index.php?club');
						}else{
								$title = $_POST['title'];
								$superintendent = $_POST['superintendent'];
								$contacts = $_POST['contacts'];
								$about = $_POST['about'];
								
								$inquiry = mysqli_query($connection, "UPDATE club SET title='$title', superintendent='$superintendent', contacts='$contacts', about='$about' WHERE id=".$_GET['id']);
								header('Location:/admin/index.php?club');
						};								
					};
					echo'<div class="form">
					<h3>Управление баннерами</h3>
					<form method="POST" enctype="multipart/form-data">
						<label>Название клуба</label></br>
						<input name="title" value="'.$inq['title'].'"></br>
						<label>Руководитель</label></br>
						<input name="superintendent" value="'.$inq['superintendent'].'"></br>
						<label>Контакты</label></br>
						<input name="contacts" value="'.$inq['contacts'].'"></br>
						<label>Описание клуба</label></br>
						<textarea name="about">'.$inq['about'].'</textarea></br>
						
						<label>Фото клуба 1</label></br>
						<input type="file" name="file1"></br>
						<label>Фото клуба 2</label></br>
						<input type="file" name="file2"></br>
						<label>Фото клуба 3</label></br>
						<input type="file" name="file3"></br>
						
						<button name="submit" type="submit">Добавить</button>
						<button name="clear" type="reset">Очистить</button>
					</form>
				</div>';
			};//правка записи, конец

			if($_GET['type'] == 'delclub'){
				$inquiry = mysqli_query($connection, "SELECT * FROM club WHERE id=".$_GET['id']);
				$inq = mysqli_fetch_assoc($inquiry);
				$img1 = $inq['img1'];
				$imgmin1 = $inq['imgmin1'];
				$img2 = $inq['img2'];
				$imgmin2 = $inq['imgmin2'];
				$img3 = $inq['img3'];
				$imgmin3 = $inq['imgmin3'];
				unlink($_SERVER['DOCUMENT_ROOT'].$img1);
				unlink($_SERVER['DOCUMENT_ROOT'].$imgmin1);
				unlink($_SERVER['DOCUMENT_ROOT'].$img2);
				unlink($_SERVER['DOCUMENT_ROOT'].$imgmin2);
				unlink($_SERVER['DOCUMENT_ROOT'].$img3);
				unlink($_SERVER['DOCUMENT_ROOT'].$imgmin3);
				$inquiry = mysqli_query($connection, "DELETE FROM club WHERE id=".$_GET['id']);
				header('Location:/admin/index.php?club');
			};//удаление записи, конец
			
//КЛУБЫ КОНЕЦ

			if($_GET['type'] == 'addfotos'){
				
				if(isset($_POST['submit'])){
			
					for($i=0; $i<count($_FILES['file']['name']); $i++){
						if(is_uploaded_file($_FILES['file']['tmp_name'][$i])){
							move_uploaded_file($_FILES['file']['tmp_name'][$i], $_SERVER['DOCUMENT_ROOT']."/img/clip/fotoreport/".$_FILES['file']['name'][$i]);
						}
					}
			
					$img = serialize($_FILES['file']['name']);
					
					$title = $_POST['title'];
					$category = $_POST['category'];
					$date = $_POST['date'];
					$description = $_POST['description'];
				
					$inquiry = mysqli_query($connection, "INSERT INTO fotos(date, category, title, img, description) VALUES('$date', '$category', '$title', '$img', '$description')");
					header('Location:/admin/index.php?fotos');
				};
				
				echo'<div class="form">
					<h3>Управление альбомом</h3>
					
					<form enctype="multipart/form-data" method="post">
						<label>Название альбома</label></br>
						<input name="title" value="">
						</br>
						<label>Категория</label></br>
						<input name="category" value="">
						</br>
						<label>Дата</label></br>
						<input name="date" value="">
						</br>
						<label>Описание альбома</label></br>
						<textarea name="description"></textarea></br>
						
						<label>Добавить фото в альбом</label></br>
						<input type="file" name="file[]" multiple></br>
						
						<button name="submit" type="submit">Добавить</button>
						<button name="clear" type="reset">Очистить</button>
					</form>
				</div>';
			};//добавление записи, конец
			
			if($_GET['type'] == 'delfotos'){
				$inquiry = mysqli_query($connection, "SELECT * FROM fotos WHERE id=".$_GET['id']);
				$inq = mysqli_fetch_assoc($inquiry);
				
				$in = unserialize($inq['img']);
				
				for($i=0; $i<count($in); $i++){
					unlink($_SERVER['DOCUMENT_ROOT']."/img/clip/fotoreport/".$in[$i]);				
				};
				
				$inquiry = mysqli_query($connection, "DELETE FROM fotos WHERE id=".$_GET['id']);
				header('Location:/admin/index.php?fotos');
			};//удаление записи, конец

//АЛЬБОМЫ КОНЕЦ

			if($_GET['type'] == 'addposter'){
				if(isset($_POST['submit'])){
					if($_FILES['file']['size'] != 0){
						$tmpImage = $_FILES['file']['tmp_name'];
						$newImage = $_SERVER['DOCUMENT_ROOT']."/img/banners/".$_FILES['file']['name'];
						$shortImage = "/img/banners/".$_FILES['file']['name'];
						if(!move_uploaded_file($tmpImage , $newImage)){
							echo "Ошибка при загрузке файла изображения!";
							die();
						}	
					}
						$name = $_POST['name'];
						$inquiry = mysqli_query($connection, "INSERT INTO poster(name, img) VALUES('$name', '$shortImage')");
						header('Location:/admin/index.php?poster');
				}								
				echo'<div class="form">
					<h3>Управление АФишами</h3>
					<form method="POST" enctype="multipart/form-data">
						<label>Название Афиши</label></br>
						<input name="name" value="'.$title.'"></br>
						<label>Прикрепить файл</label></br>
						<input type="file" name="file"></br>
						<button name="submit" type="submit">Добавить</button>
						<button name="clear" type="reset">Очистить</button>
					</form>
				</div>';
			};//добавление записи, конец
			
			if($_GET['type'] == 'edposter'){
				
				$inquiry = mysqli_query($connection, "SELECT * FROM poster WHERE id=".$_GET['id']); //запрос на вывод конкретной записи согласно id
				$inq = mysqli_fetch_assoc($inquiry); //подготовим данные к выводу
					
					if(isset($_POST['submit'])){
						if(!empty($_FILES['file']['size'])){
							if($_FILES['file']['size'] != 0){
								$tmpImage = $_FILES['file']['tmp_name'];
								$newImage = $_SERVER['DOCUMENT_ROOT']."/img/banners/".$_FILES['file']['name'];
								$shortImage = "/img/banners/".$_FILES['file']['name'];
								if(!move_uploaded_file($tmpImage , $newImage)){
									echo "Ошибка при загрузке файла изображения!";
									die();
								}		
							}
								$name = $_POST['name'];
								$inquiry = mysqli_query($connection, "UPDATE poster SET name='$name', img='$shortImage' WHERE id=".$_GET['id']);
								header('Location:/admin/index.php?poster');
						}else{
								$name = $_POST['name'];
								$inquiry = mysqli_query($connection, "UPDATE poster SET name='$name' WHERE id=".$_GET['id']);
								header('Location:/admin/index.php?poster');
						};								
					};
					echo'<div class="form">
					<h3>Управление баннерами</h3>
					<form method="POST" enctype="multipart/form-data">
						<label>Название Афиши</label></br>
						<input name="name" value="'.$inq['name'].'"></br>
						<label>Прикрепить файл</label></br>
						<input type="file" name="file"></br>
						<button name="submit" type="submit">Добавить</button>
						<button name="clear" type="reset">Очистить</button>
					</form>
					</div>';
			};//правка записи, конец

			if($_GET['type'] == 'delposter'){
				$inquiry = mysqli_query($connection, "SELECT * FROM poster WHERE id=".$_GET['id']);
				$inq = mysqli_fetch_assoc($inquiry);
				$img = $inq['img'];
				unlink($_SERVER['DOCUMENT_ROOT'].$img);
				$inquiry = mysqli_query($connection, "DELETE FROM poster WHERE id=".$_GET['id']);
				header('Location:/admin/index.php?poster');
			};//удаление записи, конец
			
//Афиша КОНЕЦ		

			if($_GET['type'] == 'addvideo'){
				if(isset($_POST['submit'])){
						$title = $_POST['title'];
						$description = $_POST['description'];
						$link = $_POST['link'];
						$inquiry = mysqli_query($connection, "INSERT INTO video(title, description, link) VALUES('$title', '$description', '$link')");
						header('Location:/admin/index.php?video');
				}								
				echo'<div class="form">
					<h3>Управление Видеозаписями</h3>
					<form method="POST" enctype="multipart/form-data">
						<label>Название видео</label></br>
						<input name="title" value="'.$title.'"></br>
						<label>Описание видео</label></br>
						<input name="description" value="'.$description.'"></br>
						<label>Ссылка на добавление видео</label></br>
						<input name="link" value="'.$link.'"></br>
						<button name="submit" type="submit">Добавить</button>
						<button name="clear" type="reset">Очистить</button>
					</form>
				</div>';
			};//добавление записи, конец
			
			if($_GET['type'] == 'edvideo'){
				
				$inquiry = mysqli_query($connection, "SELECT * FROM video WHERE id=".$_GET['id']); //запрос на вывод конкретной записи согласно id
				$inq = mysqli_fetch_assoc($inquiry); //подготовим данные к выводу
					
					if(isset($_POST['submit'])){
								$title = $_POST['title'];
								$description = $_POST['description'];
								$link = $_POST['link'];
																
								$inquiry = mysqli_query($connection, "UPDATE video SET title='$title', description='$description', link='$link' WHERE id=".$_GET['id']);
								header('Location:/admin/index.php?video');
					};								
					echo'<div class="form">
						<h3>Управление Видеозаписями</h3>
						<form method="POST" enctype="multipart/form-data">
							<label>Название видео</label></br>
							<input name="title" value="'.$inq['title'].'"></br>
							<label>Описание видео</label></br>
							<input name="description" value="'.$inq['description'].'"></br>
							<label>Ссылка на добавление видео</label></br>
							<input name="link" value="'.$inq['link'].'"></br>
							<button name="submit" type="submit">Добавить</button>
							<button name="clear" type="reset">Очистить</button>
						</form>
					</div>';
			};//правка записи, конец

			if($_GET['type'] == 'delvideo'){
				$inquiry = mysqli_query($connection, "DELETE FROM video WHERE id=".$_GET['id']);
				header('Location:/admin/index.php?video');
			};//удаление записи, конец
			
//Видео КОНЕЦ	

}
?>
	</section>
	</div>
	<footer>
		<div class="footercontent"></div>
		<div class="developer">Все права защищены, 2017. Сайт разработан ООО "МБИ ЛГТУ"</div>
	</footer>
</body>
</html>