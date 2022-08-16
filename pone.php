<?php require('php/connection.php');?>
<!DOCTYPE html>
<html>
	<?php require('php/head.php');?>
	<body>
		<?php require('php/menuvisor.php');?>
		<?php require('php/header.php');?>
		<?php require('php/soci.php');?>
		<div class="allcontent">
			<section class="leftcontent">
				<?php require('php/nav.php');?>
				<?php
					if(isset($_GET['news'])){
						if(($_GET['news']=='more')){
							$inquire = mysqli_query($connection, "SELECT * FROM news ORDER BY id DESC");
							echo'<div class="newsanons">
									<h2>Актуальные новости</h2>';
							while ($inq = mysqli_fetch_assoc($inquire)){
								$pic = unserialize($inq['img']);
								echo'<div class="newsanonscontent">
										<aside>
											<img src="../img/clip/news/'.$pic[0].'">
										</aside>
										<section>
											<a href="ptwo.php?type=detailed&id='.$inq['id'].'"><h3>'.$inq['title'].'</h3></a>
											<p><i class="fa fa-calendar" aria-hidden="true"></i> '.$inq['data'].' | '.$inq['category'].'</p>
											<p>'.$inq['anons'].'</p>
										</section>
									</div>';
							}
							echo'<a href="pone.php?news" id="pagination">Назад</a></div>';
						}else{
							$inquire = mysqli_query($connection, "SELECT * FROM news ORDER BY id DESC limit 5");
							echo'<div class="newsanons">
									<h2>Актуальные новости</h2>';
							while ($inq = mysqli_fetch_assoc($inquire)){
								$pic = unserialize($inq['img']);
								echo'<div class="newsanonscontent">
										<aside>
											<img src="../img/clip/news/'.$pic[0].'">
										</aside>
										<section>
											<a href="ptwo.php?type=detailed&id='.$inq['id'].'"><h3>'.$inq['title'].'</h3></a>
											<p><i class="fa fa-calendar" aria-hidden="true"></i> '.$inq['data'].' | '.$inq['category'].'</p>
											<p>'.$inq['anons'].'</p>
										</section>
									</div>';
							}
							echo'<a href="pone.php?news=more" id="pagination">Все новости</a></div>';
						};
					}
					if(isset($_GET['fotos'])){
						$inquery = mysqli_query($connection, "SELECT * FROM fotos ORDER BY id DESC");
						echo'<div class="fotoanons">
							<h2>Фоторепортажи</h2>';
							while($inq = mysqli_fetch_assoc($inquery)){
								$array = unserialize($inq['img']);
								echo'<div class="fotoanonscontent">';
								for($i=0; $i<8; $i++){
									echo '<img src="img/clip/fotoreport/'.$array[$i].'">';
								}
								echo'<a href="ptwo.php?type=fotosinfo&id='.$inq['id'].'"><h3>'.$inq['title'].'</h3></a>
								<p><i class="fa fa-calendar" aria-hidden="true"></i> '.$inq['date'].' | '.$inq['category'].'</p>';
								echo'</div>';
							}
						echo'</div>';
					}
					if(isset($_GET['club'])){
						$inquire = mysqli_query($connection, "SELECT * FROM club");
						echo'<div class="container">
							<div class="concontent">
							<h2>Клубы</h2>
								<div class="confotowrapper">';
									while($inq = mysqli_fetch_assoc($inquire)){
										echo'<a href="ptwo.php?type=clubdetail&id='.$inq['id'].'"><figure>
											<img src="'.$inq['imgmin1'].'">	
											<figcaption><i class="fa fa-hashtag" aria-hidden="true"></i> '.$inq['title'].'</figcaption>
										</figure></a>';
									}
								echo'</div>
							</div>
						</div>';
					}
					if(isset($_GET['contact'])){
						$inquire = mysqli_query($connection, "SELECT * FROM employees ORDER BY `employees`.`id` ASC");
						echo'<script type="text/javascript" charset="utf-8" async src="https://api-maps.yandex.ru/services/constructor/1.0/js/?um=constructor%3A54e147fd670504f7c535fb8d2b81905addc8f740ec27fcda1697d2ce7314fdff&amp;width=100%&amp;height=400&amp;lang=ru_RU&amp;scroll=true"></script>';
						echo'<div class="container">
							<div class="concontent">
									<div class="ourcontact">
										<h2>Наши контакты</h2>
										<p>Директор (4742)37-11-46 (доб.201);<br> Зам.директора 37-11-46 (доб.202,203)<br> Секретарь 37-11-46 (доб.204))<br>
										График работы:<br>
										ПН-ЧТ 8.30 – 17.30<br>
										ПТ 8.30 – 16.30<br>
										ПЕРЕРЫВ 13.12 – 14.00<br> E-mail: lipmol48@gmail.com<br> 
										Адрес: 398008, г. Липецк, Шкатова, д.25.</p>
									</div>
									<div class="ourcontact">
										<h2>Наши реквизиты</h2>
										<p>Юр адрес: 398008, г. Липецк, Шкатова, д.25.<br>
										ИНН 4826022615<br>
										КПП 482601001<br>
										Департамент финансов администрации г. Липецка<br>
										( л/с 20622004160 )<br>
										Банк: в Отделение ЛИПЕЦК<br>
										Р/С 40701810900003000001<br>
										БИК 044206001<br>
										ОГРН 1024840842256<br>
										ОКАТО 42701000</p>
									</div>
									<div style="clear:both;"></div>
								<h2>Наши специалисты</h2>
							</div>';
						while($inq = mysqli_fetch_assoc($inquire)){
						echo'<div class="contactpersonal">
							<aside>
								<img src="'.$inq ['imgmin'].'">
							</aside>
							<section>
								<h3>'.$inq ['fio'].'</h3>
								<div>
									<p>'.$inq ['position'].'</p>
									<p>'.$inq ['contacts'].'</p>
								</div>
							</section>
						</div>';
						}
						
						echo'</div>';
					}
					if(isset($_GET['poster'])){
						$inquire = mysqli_query($connection, "SELECT * FROM poster");
						echo'<div class="newsanons">
								<h2>Афиша</h2>';
						while ($inq = mysqli_fetch_assoc($inquire)){
							echo'<a style="text-decoration:none; font-size:1.2em;" href="'.$inq['img'].'">'.$inq['name'].'</a><br>';
						}
						echo'</div>';
					}
					if (isset($_GET['video'])){
						$inquire = mysqli_query($connection, "SELECT * FROM video");
						echo'<div class="container">
							<div class="concontent">
							<h2>Видео</h2>
								<div class="confotowrapper">';
									while($inq = mysqli_fetch_assoc($inquire)){
										echo'<figure>
											<iframe src="'.$inq['link'].'" allowfullscreen></iframe>	
											<figcaption><i class="fa fa-video-camera" aria-hidden="true"></i> '.$inq['title'].'</figcaption>
										</figure>';
									}
								echo'</div>
							</div>
						</div>';
					}
				?>			
			</section>
			<aside class="rightcontent">
				<?php require('php/rightcontent.php')?>
			</aside>
		</div>
		<?php require('php/footer.php');?>
		<script type="text/javascript" src="/js/uGost11.js"></script>
		<?php require('php/developer.php')?>
	</body>
</html>