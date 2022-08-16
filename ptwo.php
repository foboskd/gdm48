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
					if(isset ($_GET['type'])){
						if($_GET['type'] == 'clubdetail'){
							
							$inquery = mysqli_query($connection, "SELECT * FROM club WHERE id=".$_GET['id']);
							$inq = mysqli_fetch_assoc ($inquery);
							
							echo'<div class="slider autoplay">';
								echo'<div><img src="'.$inq['imgmin1'].'"><h3>слайд 1</h3></div>';
								echo'<div><img src="'.$inq['imgmin2'].'"><h3>слайд 2</h3></div>';
								echo'<div><img src="'.$inq['imgmin3'].'"><h3>слайд 3</h3></div>';
							echo'</div>';
							echo'<div class="container">
								<div class="concontent">
									<h2>'.$inq['title'].'</h2>
									<p>'.$inq['about'].'</p>
									<h2>Для записи</h2>
									<p>Руководитель: '.$inq['superintendent'].'<br>Телефон: '.$inq['contacts'].'</p>
								</div>
							</div>';
						}
						
						if($_GET['type'] == 'detailed'){
						
							$inquery = mysqli_query($connection, "SELECT * FROM news WHERE id=".$_GET['id']);
							$inq = mysqli_fetch_assoc ($inquery);
							$pic = unserialize($inq['img']);						
							echo'<div class="container">
								<div class="concontent">
									<h2>'.$inq['title'].'</h2>
									<p><i class="fa fa-calendar" aria-hidden="true"></i> '.$inq['data'].' | '.$inq['category'].'</p>
									<em>'.$inq['anons'].'</em>
									<div class="sllddr slider-for">';
										for($i=0; $i<count($pic); $i++){
											echo'<div><a href=""><img src="img/clip/news/'.$pic[$i].'"></a></div>';
										}
									echo'</div>
									<div class="sllddrnav slider-nav">';
										for($i=0; $i<count($pic); $i++){
											echo'<div><img src="img/clip/news/'.$pic[$i].'"></div>';
										}
									echo'</div>';
									echo'<p>'.$inq['text'].'</p>
								</div>
								<script src="//yastatic.net/es5-shims/0.0.2/es5-shims.min.js"></script>
								<script src="//yastatic.net/share2/share.js"></script>
								<div class="ya-share2" data-services="vkontakte,facebook,odnoklassniki" data-counter=""></div>
							</div>';
						}
						
						if($_GET['type'] == 'fotosinfo'){
						
							$inquery = mysqli_query($connection, "SELECT * FROM fotos WHERE id=".$_GET['id']);
							$inq = mysqli_fetch_assoc ($inquery);
							$pic = unserialize($inq['img']);						
							echo'<div class="container">
								<div class="concontent">
									<h2>'.$inq['title'].'</h2>
									<p><i class="fa fa-calendar" aria-hidden="true"></i> '.$inq['data'].' | '.$inq['category'].'</p>
									<em>'.$inq['anons'].'</em>
									<div class="sllddr slider-for">';
										$array = unserialize($inq['img']);
										for($i=0; $i<count($array); $i++){
											echo '<img src="img/clip/fotoreport/'.$array[$i].'">';
										}
									echo'</div>
									<div class="sllddrnav slider-nav">';
										$array = unserialize($inq['img']);
										for($i=0; $i<count($array); $i++){
											echo '<img src="img/clip/fotoreport/'.$array[$i].'">';
										}
									echo'</div>';
									echo'<p>'.$inq['text'].'</p>
								</div>
								<script src="//yastatic.net/es5-shims/0.0.2/es5-shims.min.js"></script>
								<script src="//yastatic.net/share2/share.js"></script>
								<div class="ya-share2" data-services="vkontakte,facebook,odnoklassniki" data-counter=""></div>
							</div>';
						}
					}
				?>
			</section>
			<aside class="rightcontent">
				<?php require('php/rightcontent.php')?>
			</aside>
		</div>
		<?php require('php/footer.php');?>
		<script type="text/javascript" src="//code.jquery.com/jquery-1.11.0.min.js"></script>
		<script type="text/javascript" src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
		<script type="text/javascript" src="slick/slick.min.js"></script>
		<script type="text/javascript" src="js/js.js"></script>
		<script type="text/javascript" src="/js/uGost11.js"></script>
		<?php require('php/developer.php')?>
	</body>
</html>