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
				<div class="slider autoplay">
					<?php 
					$rire = mysqli_query($connection, "SELECT * FROM indexslider");
					while ($ric = mysqli_fetch_assoc($rire)){
						echo '<div><a href="'.$ric['link'].'"><img src="'.$ric['imgmin'].'"><h3>'.$ric['title'].'</h3></a></div>';
					}
					?>
				</div>
<script src='https://pos.gosuslugi.ru/bin/script.min.js'></script> 
<style>
#js-show-iframe-wrapper{position:relative;display:flex;align-items:center;justify-content:center;width:100%;min-width:293px;max-width:100%;background:linear-gradient(138.4deg,#38bafe 26.49%,#2d73bc 79.45%);color:#fff;cursor:pointer}#js-show-iframe-wrapper .pos-banner-fluid *{box-sizing:border-box}#js-show-iframe-wrapper .pos-banner-fluid .pos-banner-btn_2{display:block;width:240px;min-height:56px;font-size:18px;line-height:24px;cursor:pointer;background:#0d4cd3;color:#fff;border:none;border-radius:8px;outline:0}#js-show-iframe-wrapper .pos-banner-fluid .pos-banner-btn_2:hover{background:#1d5deb}#js-show-iframe-wrapper .pos-banner-fluid .pos-banner-btn_2:focus{background:#2a63ad}#js-show-iframe-wrapper .pos-banner-fluid .pos-banner-btn_2:active{background:#2a63ad}@-webkit-keyframes fadeInFromNone{0%{display:none;opacity:0}1%{display:block;opacity:0}100%{display:block;opacity:1}}@keyframes fadeInFromNone{0%{display:none;opacity:0}1%{display:block;opacity:0}100%{display:block;opacity:1}}@font-face{font-family:LatoWebLight;src:url(https://pos.gosuslugi.ru/bin/fonts/Lato/fonts/Lato-Light.woff2) format("woff2"),url(https://pos.gosuslugi.ru/bin/fonts/Lato/fonts/Lato-Light.woff) format("woff"),url(https://pos.gosuslugi.ru/bin/fonts/Lato/fonts/Lato-Light.ttf) format("truetype");font-style:normal;font-weight:400}@font-face{font-family:LatoWeb;src:url(https://pos.gosuslugi.ru/bin/fonts/Lato/fonts/Lato-Regular.woff2) format("woff2"),url(https://pos.gosuslugi.ru/bin/fonts/Lato/fonts/Lato-Regular.woff) format("woff"),url(https://pos.gosuslugi.ru/bin/fonts/Lato/fonts/Lato-Regular.ttf) format("truetype");font-style:normal;font-weight:400}@font-face{font-family:LatoWebBold;src:url(https://pos.gosuslugi.ru/bin/fonts/Lato/fonts/Lato-Bold.woff2) format("woff2"),url(https://pos.gosuslugi.ru/bin/fonts/Lato/fonts/Lato-Bold.woff) format("woff"),url(https://pos.gosuslugi.ru/bin/fonts/Lato/fonts/Lato-Bold.ttf) format("truetype");font-style:normal;font-weight:400}@font-face{font-family:RobotoWebLight;src:url(https://pos.gosuslugi.ru/bin/fonts/Roboto/Roboto-Light.woff2) format("woff2"),url(https://pos.gosuslugi.ru/bin/fonts/Roboto/Roboto-Light.woff) format("woff"),url(https://pos.gosuslugi.ru/bin/fonts/Roboto/Roboto-Light.ttf) format("truetype");font-style:normal;font-weight:400}@font-face{font-family:RobotoWebRegular;src:url(https://pos.gosuslugi.ru/bin/fonts/Roboto/Roboto-Regular.woff2) format("woff2"),url(https://pos.gosuslugi.ru/bin/fonts/Roboto/Roboto-Regular.woff) format("woff"),url(https://pos.gosuslugi.ru/bin/fonts/Roboto/Roboto-Regular.ttf) format("truetype");font-style:normal;font-weight:400}@font-face{font-family:RobotoWebBold;src:url(https://pos.gosuslugi.ru/bin/fonts/Roboto/Roboto-Bold.woff2) format("woff2"),url(https://pos.gosuslugi.ru/bin/fonts/Roboto/Roboto-Bold.woff) format("woff"),url(https://pos.gosuslugi.ru/bin/fonts/Roboto/Roboto-Bold.ttf) format("truetype");font-style:normal;font-weight:400}@font-face{font-family:ScadaWebRegular;src:url(https://pos.gosuslugi.ru/bin/fonts/Scada/Scada-Regular.woff2) format("woff2"),url(https://pos.gosuslugi.ru/bin/fonts/Scada/Scada-Regular.woff) format("woff"),url(https://pos.gosuslugi.ru/bin/fonts/Scada/Scada-Regular.ttf) format("truetype");font-style:normal;font-weight:400}@font-face{font-family:ScadaWebBold;src:url(https://pos.gosuslugi.ru/bin/fonts/Scada/Scada-Bold.woff2) format("woff2"),url(https://pos.gosuslugi.ru/bin/fonts/Scada/Scada-Bold.woff) format("woff"),url(https://pos.gosuslugi.ru/bin/fonts/Scada/Scada-Bold.ttf) format("truetype");font-style:normal;font-weight:400}@font-face{font-family:Geometria;src:url(https://pos.gosuslugi.ru/bin/fonts/Geometria/Geometria.eot);src:url(https://pos.gosuslugi.ru/bin/fonts/Geometria/Geometria.eot?#iefix) format("embedded-opentype"),url(https://pos.gosuslugi.ru/bin/fonts/Geometria/Geometria.woff) format("woff"),url(https://pos.gosuslugi.ru/bin/fonts/Geometria/Geometria.ttf) format("truetype");font-weight:400;font-style:normal}@font-face{font-family:Geometria-ExtraBold;src:url(https://pos.gosuslugi.ru/bin/fonts/Geometria/Geometria-ExtraBold.eot);src:url(https://pos.gosuslugi.ru/bin/fonts/Geometria/Geometria-ExtraBold.eot?#iefix) format("embedded-opentype"),url(https://pos.gosuslugi.ru/bin/fonts/Geometria/Geometria-ExtraBold.woff) format("woff"),url(https://pos.gosuslugi.ru/bin/fonts/Geometria/Geometria-ExtraBold.ttf) format("truetype");font-weight:800;font-style:normal}
</style>

<style>
#js-show-iframe-wrapper{background:var(--pos-banner-fluid-104__background)}#js-show-iframe-wrapper .pos-banner-fluid .pos-banner-btn_2{width:100%;min-height:52px;background:#0d4cd3;color:#fff;font-size:16px;font-family:LatoWeb,sans-serif;font-weight:400;padding:0;line-height:1.2}#js-show-iframe-wrapper .pos-banner-fluid .pos-banner-btn_2:active,#js-show-iframe-wrapper .pos-banner-fluid .pos-banner-btn_2:focus,#js-show-iframe-wrapper .pos-banner-fluid .pos-banner-btn_2:hover{background:#1d5deb}#js-show-iframe-wrapper .bf-104{position:relative;display:grid;grid-template-columns:var(--pos-banner-fluid-104__grid-template-columns);grid-template-rows:var(--pos-banner-fluid-104__grid-template-rows);width:100%;max-width:var(--pos-banner-fluid-104__max-width);box-sizing:border-box;grid-auto-flow:row dense}#js-show-iframe-wrapper .bf-104__decor{background:var(--pos-banner-fluid-104__bg-url) var(--pos-banner-fluid-104__bg-url-position) no-repeat;background-size:cover;background-color:#f8efec;position:relative}#js-show-iframe-wrapper .bf-104__content{display:flex;flex-direction:column;padding:var(--pos-banner-fluid-104__content-padding);grid-row:var(--pos-banner-fluid-104__content-grid-row);background-color:var(--pos-banner-fluid-104__content-bgc)}#js-show-iframe-wrapper .bf-104__description{display:flex;flex-direction:column;margin:var(--pos-banner-fluid-104__description-margin)}#js-show-iframe-wrapper .bf-104__text{margin:var(--pos-banner-fluid-104__text-margin);font-size:var(--pos-banner-fluid-104__text-font-size);line-height:1.3;font-family:LatoWeb,sans-serif;font-weight:700;color:#0b1f33}#js-show-iframe-wrapper .bf-104__text_small{font-size:var(--pos-banner-fluid-104__text-small-font-size);font-weight:400;margin:0}#js-show-iframe-wrapper .bf-104__bottom-wrap{display:flex;flex-direction:row;align-items:center}#js-show-iframe-wrapper .bf-104__logo-wrap{box-shadow:var(--pos-banner-fluid-104__logo-box-shadow);position:absolute;top:var(--pos-banner-fluid-104__logo-wrap-top);left:0;padding:var(--pos-banner-fluid-104__logo-wrap-padding);background:#fff;border-radius:0 0 8px}#js-show-iframe-wrapper .bf-104__logo{width:var(--pos-banner-fluid-104__logo-width);margin-left:1px}#js-show-iframe-wrapper .bf-104__slogan{font-family:LatoWeb,sans-serif;font-weight:700;font-size:var(--pos-banner-fluid-104__slogan-font-size);line-height:1;color:#005ca9}#js-show-iframe-wrapper .bf-104__btn-wrap{width:100%;max-width:var(--pos-banner-fluid-104__button-wrap-max-width)}
</style>

<div id='js-show-iframe-wrapper'>
<div class='pos-banner-fluid bf-104'>

  <div class='bf-104__decor'>
    <div class='bf-104__logo-wrap'>
      <img class='bf-104__logo' src='https://pos.gosuslugi.ru/bin/banner-fluid/gosuslugi-logo-blue.svg'
        alt='Госуслуги' />
      <div class='bf-104__slogan'>Решаем вместе</div>
    </div>
  </div>
  <div class='bf-104__content'>
    <div class='bf-104__description'>
      <span class='bf-104__text'>
        Сложности с получением «Пушкинской карты» или приобретением билетов? Знаете, как улучшить работу учреждений культуры?
      </span>
      <span class='bf-104__text bf-104__text_small'>
        Напишите&nbsp;— решим!
      </span>
    </div>

    <div class='bf-104__bottom-wrap'>
      <div class='bf-104__btn-wrap'>
        <!-- pos-banner-btn_2 не удалять; другие классы не добавлять -->
        <button class='pos-banner-btn_2' type='button'>Написать
        </button>
      </div>
    </div>
  </div>

</div>
</div>

<script>
"use strict";function ownKeys(e,t){var n=Object.keys(e);if(Object.getOwnPropertySymbols){var r=Object.getOwnPropertySymbols(e);t&&(r=r.filter((function(t){return Object.getOwnPropertyDescriptor(e,t).enumerable}))),n.push.apply(n,r)}return n}function _objectSpread(e){for(var t=1;t<arguments.length;t++){var n=null!=arguments[t]?arguments[t]:{};t%2?ownKeys(Object(n),!0).forEach((function(t){_defineProperty(e,t,n[t])})):Object.getOwnPropertyDescriptors?Object.defineProperties(e,Object.getOwnPropertyDescriptors(n)):ownKeys(Object(n)).forEach((function(t){Object.defineProperty(e,t,Object.getOwnPropertyDescriptor(n,t))}))}return e}function _defineProperty(e,t,n){return t in e?Object.defineProperty(e,t,{value:n,enumerable:!0,configurable:!0,writable:!0}):e[t]=n,e}var POS_PREFIX_104="--pos-banner-fluid-104__",posOptionsInitialBanner104={background:"transparent","content-bgc":"#FFFFFF","grid-template-columns":"100%","grid-template-rows":"264px auto","max-width":"1440px","text-font-size":"18px","text-small-font-size":"14px","text-margin":"0 0px 12px 0","description-margin":"0 0 16px 0","button-wrap-max-width":"245px","bg-url":"url('https://pos.gosuslugi.ru/bin/banner-fluid/100/banner-fluid-100-405.svg')","bg-url-position":"center center","content-padding":"36px 24px","logo-wrap-padding":"16px 12px 12px 12px","logo-width":"65px","logo-wrap-top":"0","slogan-font-size":"12px","logo-box-shadow":"none"},setStyles=function(e,t){var n=arguments.length>2&&void 0!==arguments[2]?arguments[2]:POS_PREFIX_104;Object.keys(e).forEach((function(r){t.style.setProperty(n+r,e[r])}))},removeStyles=function(e,t){var n=arguments.length>2&&void 0!==arguments[2]?arguments[2]:POS_PREFIX_100;Object.keys(e).forEach((function(e){t.style.removeProperty(n+e)}))};function changePosBannerOnResize(){var e=document.documentElement,t=_objectSpread({},posOptionsInitialBanner104),n=document.getElementById("js-show-iframe-wrapper"),r=n?n.offsetWidth:document.body.offsetWidth;r>499&&(t["bg-url"]="url('https://pos.gosuslugi.ru/bin/banner-fluid/100/banner-fluid-100-500.svg')"),r>584&&(t["grid-template-rows"]="auto",t["bg-url"]="url('https://pos.gosuslugi.ru/bin/banner-fluid/100/banner-fluid-100-273.svg')",t["text-font-size"]="20px",t["content-padding"]="46px 24px 46px 24px",t["grid-template-columns"]="53% 47%",t["content-grid-row"]="1"),r>649&&(t["bg-url"]="url('https://pos.gosuslugi.ru/bin/banner-fluid/100/banner-fluid-100-558.svg')"),r>799&&(t["text-font-size"]="20px",t["text-small-font-size"]="16px",t["bg-url"]="url('https://pos.gosuslugi.ru/bin/banner-fluid/100/banner-fluid-100-500.svg')"),r>1115&&(t["text-font-size"]="24px",t["text-small-font-size"]="18px",t["content-padding"]="46px 80px 46px 140px",t["bg-url"]="url('https://pos.gosuslugi.ru/bin/banner-fluid/100/banner-fluid-100-720.svg')"),setStyles(t,e)}changePosBannerOnResize(),window.addEventListener("resize",changePosBannerOnResize),window.onunload=function(){var e=document.documentElement,t=_objectSpread({},posOptionsInitialBanner104);window.removeEventListener("resize",changePosBannerOnResize),removeStyles(t,e)};
</script> <script>Widget("https://pos.gosuslugi.ru/form", 354778)</script>

				<?php		
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
					echo'</div>';
				?>
				<div class="fotoanons">
					<h2>Фоторепортажи</h2>
					
						<?php 
							$inquery = mysqli_query($connection, "SELECT * FROM fotos ORDER BY id DESC");
		
							while($inq = mysqli_fetch_assoc($inquery)){
								$array = unserialize($inq['img']);
								
								echo'<div class="fotoanonscontent">';
								
								for($i=0; $i<4; $i++){
									echo '<img src="img/clip/fotoreport/'.$array[$i].'">';
								}
								
								echo'<a href="ptwo.php?type=fotosinfo&id='.$inq['id'].'"><h3>'.$inq['title'].'</h3></a>
								<p><i class="fa fa-calendar" aria-hidden="true"></i> '.$inq['date'].' | '.$inq['category'].'</p>';
								
								echo'</div>';
							}
						?>
				</div>
				<div class="collegs">
					<h2>Наш коллектив</h2>
					<div class="collegscontent">
						<?php
						$inquiry = mysqli_query($connection, "SELECT * FROM employees ORDER BY `employees`.`id` ASC");
							while($inq = mysqli_fetch_assoc($inquiry)){
								echo'<div class="collegnumber"><a href="'.$inq['img'].'" target="_blank"><img src="'.$inq['imgmin'].'"></a><h3>'.$inq['fio'].'</h3><p>'.$inq['position'].'</p></div>';
							}
						?>
					</div>
				</div>
				<div class="rewards">
					<h2>Награды и благодарности</h2>
					<div class="rewardscontent">
					<?php 
					$fly = mysqli_query($connection, "SELECT * FROM rewards");
					while ($ry = mysqli_fetch_assoc($fly)){
						echo'<div><a href="'.$ry['img'].'" target="a_blank"><img src="'.$ry['imgmin'].'"></a></div>';
					}
						?>
					</div>
				</div>
				<div class="partners">
					<h2>Наши партнеры</h2>
					<div class="partnerscontent">
						<?php
						$inquiry = mysqli_query($connection, "SELECT * FROM partners");
							while($inq = mysqli_fetch_assoc($inquiry)){
								echo'<a href="'.$inq['contact'].'" target="a_blank"><div><img src="'.$inq['imgmin'].'" alt="'.$inq['name'].'" title="'.$inq['name'].'"></div></a>';
							}
						?>
					</div>
				</div>
			</section>
			<aside class="rightcontent">
				<?php require('php/rightcontent.php');?>
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