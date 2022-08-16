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
				if(isset($_GET['banners'])){
					$inquery = mysqli_query($connection, "SELECT * FROM banners");
					while($inq = mysqli_fetch_assoc($inquery)){
					
						echo'<figure class="banners">
							<figcaption>
								<p>
									<a href="adminform.php?type=edbanners&id='.$inq['id'].'"><i class="fa fa-pencil" aria-hidden="true"></i></a>
									<a href="adminform.php?type=delbanners&id='.$inq['id'].'" onclick="return confirm(\'Точно удалить?\')" ><i class="fa fa-times" aria-hidden="true"></i></a>
								</p>
							</figcaption>
							<img src="../'.$inq['img'].'">
							<h3>'.$inq['title'].'</h3>
						</figure>';
					};
				echo'<figure class="banners">
					<a href="adminform.php?type=addbanners">
						<i class="fa fa-plus-circle" aria-hidden="true"></i>
					</a>
				</figure>';
				}
				if(isset($_GET['partners'])){
					$inquery = mysqli_query($connection, "SELECT * FROM partners");

					while($inq = mysqli_fetch_assoc($inquery)){
					
						echo'<figure class="banners">
							<figcaption>
								<p>
									<a href="adminform.php?type=edpartners&id='.$inq['id'].'"><i class="fa fa-pencil" aria-hidden="true"></i></a>
									<a href="adminform.php?type=delpartners&id='.$inq['id'].'" onclick="return confirm(\'Точно удалить?\')" ><i class="fa fa-times" aria-hidden="true"></i></a>
								</p>
							</figcaption>
							<img src="../'.$inq['imgmin'].'">
							<h3>'.$inq['name'].'</h3>
						</figure>';
					};
					echo'<figure class="banners">
					<a href="adminform.php?type=addpartners">
						<i class="fa fa-plus-circle" aria-hidden="true"></i>
					</a>
					</figure>';
				}
				if(isset($_GET['employees'])){
					$inquery = mysqli_query($connection, "SELECT * FROM employees");

					while($inq = mysqli_fetch_assoc($inquery)){
					
						echo'<figure class="employees">
							<figcaption>
								<p>
									<a href="adminform.php?type=edemployees&id='.$inq['id'].'"><i class="fa fa-pencil" aria-hidden="true"></i></a>
									<a href="adminform.php?type=delemployees&id='.$inq['id'].'" onclick="return confirm(\'Точно удалить?\')" ><i class="fa fa-times" aria-hidden="true"></i></a>
								</p>
							</figcaption>
							<img src="../'.$inq['imgmin'].'">
							<h3>'.$inq['fio'].'</h3>
						</figure>';
					};
					echo'<figure class="employees">
					<a href="adminform.php?type=addemployees">
						<i class="fa fa-plus-circle" aria-hidden="true"></i>
					</a>
					</figure>';
				}
				if(isset($_GET['news'])){
					$inquery = mysqli_query($connection, "SELECT * FROM news");

					while($inq = mysqli_fetch_assoc($inquery)){
						$pic = unserialize($inq['img']);
						echo'<div class="news">
							<aside class="newsimage">
								<img src="../img/clip/news/'.$pic[0].'">					
							</aside>
							<div class="newscontent">
								<p>
									<a href="adminform.php?type=ednews&id='.$inq['id'].'"><i class="fa fa-pencil" aria-hidden="true"></i></a>
									<a href="adminform.php?type=delnews&id='.$inq['id'].'" onclick="return confirm(\'Точно удалить?\')" ><i class="fa fa-times" aria-hidden="true"></i></a>
								</p>
								<h3>'.$inq['title'].'</h3>
								<p><i class="fa fa-calendar" aria-hidden="true"></i> '.$inq['data'].' | '.$inq['category'].'</p>
								<p>'.$inq['anons'].'</p>
							</div>
						</div>';
					}
					echo'<div class="news">
						<a href="adminform.php?type=addnews">
							<i class="fa fa-plus-circle" aria-hidden="true"></i>
						</a>	
					</div>';
				}
				if(isset($_GET['indexslider'])){
					$inquery = mysqli_query($connection, "SELECT * FROM indexslider");

					while($inq = mysqli_fetch_assoc($inquery)){
					
						echo'<div class="indexslider">
								<p>
									<a href="adminform.php?type=edindexslider&id='.$inq['id'].'"><i class="fa fa-pencil" aria-hidden="true"></i></a>
									<a href="adminform.php?type=delindexslider&id='.$inq['id'].'" onclick="return confirm(\'Точно удалить?\')" ><i class="fa fa-times" aria-hidden="true"></i></a>
								</p>
								<h3>'.$inq['title'].'</h3>
								<img src="../'.$inq['imgmin'].'">
								<p>'.$inq['description'].'</p>
						</div>';
					}
					echo'<div class="indexslider">
						<a href="adminform.php?type=addindexslider">
							<i class="fa fa-plus-circle" aria-hidden="true"></i>
						</a>	
					</div>';
				}
				if(isset($_GET['rewards'])){
					$inquery = mysqli_query($connection, "SELECT * FROM rewards");

					while($inq = mysqli_fetch_assoc($inquery)){
					
						echo'<div class="rewards">
								<p>
									<a href="adminform.php?type=edrewards&id='.$inq['id'].'"><i class="fa fa-pencil" aria-hidden="true"></i></a>
									<a href="adminform.php?type=delrewards&id='.$inq['id'].'" onclick="return confirm(\'Точно удалить?\')" ><i class="fa fa-times" aria-hidden="true"></i></a>
								</p>
								<h3>'.$inq['title'].'</h3>
								<img src="../'.$inq['imgmin'].'">
								<p>'.$inq['description'].'</p>
						</div>';
					}
					echo'<div class="rewards">
						<a href="adminform.php?type=addrewards">
							<i class="fa fa-plus-circle" aria-hidden="true"></i>
						</a>	
					</div>';
				}
				if(isset($_GET['vacancies'])){
				
					$inquery = mysqli_query($connection, "SELECT * FROM vacancies");
						while($inq = mysqli_fetch_assoc($inquery)){
						echo'<div class="vacancies">
								<p>
									<a href="adminform.php?type=edvacancies&id='.$inq['id'].'"><i class="fa fa-pencil" aria-hidden="true"></i></a>
									<a href="adminform.php?type=delvacancies&id='.$inq['id'].'" onclick="return confirm(\'Точно удалить?\')" ><i class="fa fa-times" aria-hidden="true"></i></a>
								</p>
								<h3>'.$inq['title'].'</h3>
						</div>';
						}
						echo'<div class="vacancies">
						<a href="adminform.php?type=addvacancies">
							<i class="fa fa-plus-circle" aria-hidden="true"></i>
						</a>	
						</div>';
				}
				if(isset($_GET['club'])){
				
					$inquery = mysqli_query($connection, "SELECT * FROM club");
						while($inq = mysqli_fetch_assoc($inquery)){
						echo'<div class="news">
							<aside class="newsimage">
								<img src="../'.$inq['imgmin1'].'">					
							</aside>
							<div class="newscontent">
								<p>
									<a href="adminform.php?type=edclub&id='.$inq['id'].'"><i class="fa fa-pencil" aria-hidden="true"></i></a>
									<a href="adminform.php?type=delclub&id='.$inq['id'].'" onclick="return confirm(\'Точно удалить?\')" ><i class="fa fa-times" aria-hidden="true"></i></a>
								</p>
								<h3>'.$inq['title'].'</h3>
								<p>'.$inq['superintendent'].'</p>
							</div>
						</div>';
					}
					echo'<div class="news">
						<a href="adminform.php?type=addclub">
							<i class="fa fa-plus-circle" aria-hidden="true"></i>
						</a>	
					</div>';
				}
				if(isset($_GET['fotos'])){
					$inquery = mysqli_query($connection, "SELECT * FROM fotos");

					while($inq = mysqli_fetch_assoc($inquery)){
						
						$array = unserialize($inq['img']);
				
						echo'<figure class="employees">
							<figcaption>
								<p>
									<!--<a href="adminform.php?type=edfotos&id='.$inq['id'].'"><i class="fa fa-pencil" aria-hidden="true"></i></a>-->
									<a href="adminform.php?type=delfotos&id='.$inq['id'].'" onclick="return confirm(\'Точно удалить?\')" ><i class="fa fa-times" aria-hidden="true"></i></a>
								</p>
							</figcaption>
							<img src="../img/clip/fotoreport/'.$array[0].'">
							<h3>'.$inq['title'].'</h3>
						</figure>';
					}
					echo'<figure class="employees">
						<a href="adminform.php?type=addfotos">
							<i class="fa fa-plus-circle" aria-hidden="true"></i>
						</a>
					</figure>';
				}
				if(isset($_GET['poster'])){
					$inquery = mysqli_query($connection, "SELECT * FROM poster");
						while($inq = mysqli_fetch_assoc($inquery)){
						echo'<div class="news">
							<aside class="newsimage">
							</aside>
							<div class="newscontent">
								<p>
									<a href="adminform.php?type=edposter&id='.$inq['id'].'"><i class="fa fa-pencil" aria-hidden="true"></i></a>
									<a href="adminform.php?type=delposter&id='.$inq['id'].'" onclick="return confirm(\'Точно удалить?\')" ><i class="fa fa-times" aria-hidden="true"></i></a>
								</p>
								<h3>'.$inq['name'].'</h3>
							</div>
						</div>';
					}
					echo'<div class="news">
						<a href="adminform.php?type=addposter">
							<i class="fa fa-plus-circle" aria-hidden="true"></i>
						</a>	
					</div>';
				}
				if(isset($_GET['video'])){
					$inquery = mysqli_query($connection, "SELECT * FROM video");
						while($inq = mysqli_fetch_assoc($inquery)){
						echo'<div class="news" style="margin:5px; height:300px;">
							<div class="newscontent">
								<p>
									<a href="adminform.php?type=edvideo&id='.$inq['id'].'"><i class="fa fa-pencil" aria-hidden="true"></i></a>
									<a href="adminform.php?type=delvideo&id='.$inq['id'].'" onclick="return confirm(\'Точно удалить?\')" ><i class="fa fa-times" aria-hidden="true"></i></a>
								</p>
								<iframe src="'.$inq['link'].'" allowfullscreen></iframe>	
								<h3>'.$inq['title'].'</h3>
							</div>
						</div>';
					}
					echo'<div class="news">
						<a href="adminform.php?type=addvideo">
							<i class="fa fa-plus-circle" aria-hidden="true"></i>
						</a>	
					</div>';
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