				<div class="uk-panel">
					<a href="/<?= $_SERVER['REQUEST_URL'] ?>" onclick="dmuGostSettings();" id="enableuGost">
					<button class="sscf-popup">
					<i class="fa fa-eye" aria-hidden="true"></i>
					версия сайта для слабовидящих
					</button>
					</a>
				</div>
				<script type="text/javascript" src="https://all.culture.ru/scripts/widgets/api.js?3973"></script> 
				<div id="eipsk-culturebanner" style="margin-bottom:30px; border:1px solid #E3E3E3; width:255px;"></div>
					<!-- EIPSK Widget -->
				<script type="text/javascript">
					EIPSK.Widgets.Inline('1chlyam7up56b4si', 'eipsk-culturebanner');
				</script>
				<ul>
					<li><a href="https://fadm.gov.ru/"><img src="img/banners/rosmol.png"></a></li>
					<li><a href="pone.php?poster"><img src="img/banners/poster.png"></a></li>
					<?php $inquiry = mysqli_query($connection, "SELECT * FROM banners");
					while($inq = mysqli_fetch_assoc($inquiry)){
						echo'<li><a href="'.$inq['link'].'"><img src="'.$inq['img'].'"></a></li>';
					}?>
				</ul>
				