<?php
  if (!isset($_REQUEST['dt']) || $_REQUEST['dt'] != 'true') {
    require_once('mobile/Mobile_Detect.php'); 
    $detect = new Mobile_Detect();
    if ($detect->isMobile()) {
      header('Location: mobile/', true, 301);
      die();
    }
  }
  require_once('includes.php');
?><!DOCTYPE html>
<html>
<head>
   <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
   <!-- <meta name="viewport" content="width=device-width, initial-scale=1.0"/> -->
   <title><?php tr('Българският Календар', 'The Bulgarian Calendar', 'Der Bulgarisch Kalender', 'Болгарский Календарь')?></title>
   <link rel="stylesheet" type="text/css" href="css/flags.css" /> 
   <link rel="stylesheet" type="text/css" href="navigation.css" /> 
   <link rel="stylesheet" type="text/css" href="bgkalendar.css" /> 
   <link rel="stylesheet" type="text/css" href="forum.css" /> 
   <!-- Facebook tags start -->
   <meta property="og:url"           content="http://bgkalendar.com/" />
   <meta property="og:type"          content="website" />
   <meta property="og:title"         content="Българският Календар (Bulgarian Calendar)" />
   <meta property="og:description"   content="Универсален календар на древните българи" />
   <!-- <meta property="og:image"         content="http://www.your-domain.com/path/image.jpg" /> -->
   <!-- Facebook tags end  -->
   <!-- extreme_yordan_0601ace132628511a2a71ae3a980c736 -->
   <!--[if IE]>
        <link rel="stylesheet" type="text/css" href="bgcalendar-ie.css" /> 
   <![endif]-->
   <!--[if !IE]><!-->
        <link rel="stylesheet" type="text/css" href="bgkalendar-nonie.css" /> 
   <!--<![endif]-->

   <script type="text/javascript" src="bgkalendar.js"></script>
   <!--
      These four scripts are needed in order to support the transform css propety and more 
      specifically the rotation by 90 degrees in Internet Explorer. 
      Thanks to 
      http://www.useragentman.com/blog/2010/03/09/cross-browser-css-transforms-even-in-ie/
   -->
   <script type="text/javascript">
     function initialize() {
         windowResized();

          // Initialize Bulgarian Kalendar....

          <?php $indexbg = $periodsbg[2]->startsAtDaysAfterEpoch();?>;
          var indexbg = <?php echo $indexbg;?>;
          var indexgr = 
          <?php echo bcsub($indexbg, bcsub($daysbgFromStartOfCalendarTillJavaEpoch, $daysgrFromStartOfCalendarTillJavaEpoch));?>;
          //var jepochindex = <?php echo bcsub($indexbg, $daysbgFromStartOfCalendarTillJavaEpoch);?>;
          var jepochindex = indexbg;
          var i = 0;
          for (i = 0; i <= (366 + 31); i++) {
             var namebg = "daybg" + (indexbg + i);
             var namegr = "daygr" + (indexgr + i);
             var jepoch = jepochindex + i;

             var bg = document.getElementById(namebg);
             var gr = document.getElementById(namegr);

             if (bg != null) {
                setFuncOnFocus( "onfocus_"     + namebg, namebg, namegr);
                setFuncOnBlur ( "onblur_"      + namebg, namebg, namegr);
                setFuncOnmover( "onmouseover_" + namebg, namebg, namegr);
                setFuncOnmout ( "onmouseout_"  + namebg, namebg, namegr);
                setFuncOnmdown( "onmousedown_" + namebg, namebg, namegr, "<?php echo $DAYS_BG_URL_PARAMETER ?>", jepoch);
                setFuncOnmup  ( "onmouseup_"   + namebg, namebg, namegr, "<?php echo $DAYS_BG_URL_PARAMETER ?>", jepoch)
                setFuncOnkpres( "onkeypress_"  + namebg, namebg, namegr, "<?php echo $DAYS_BG_URL_PARAMETER ?>", jepoch);
           
                bg.onfocus     = this["onfocus_" + namebg];
                bg.onblur      = this["onblur_"  + namebg];
                bg.onmouseover = this["onmouseover_" + namebg];
                bg.onmouseout  = this["onmouseout_" + namebg];
                bg.onmousedown = this["onmousedown_" + namebg];
                bg.onmouseup   = this["onmouseup_" + namebg];
                bg.onkeypress  = this["onkeypress_" + namebg];
                bg.setAttribute("tabindex", i + 1);
                bg.setAttribute("tabIndex", i + 1);
                bg.tabIndex = i + 1;
             }
          }
      // Initialize Gregorian Kalendar....

          <?php $indexgr = bcsub($periodsgr[2]->startsAtDaysAfterEpoch(), 31);?>
          var indexgr = <?php echo $indexgr;?>;
          var indexbg = 
          <?php echo bcadd($indexgr, bcsub($daysbgFromStartOfCalendarTillJavaEpoch, $daysgrFromStartOfCalendarTillJavaEpoch));?>;
          //var jepochindex = <?php echo bcsub($indexgr, $daysgrFromStartOfCalendarTillJavaEpoch);?>;
          var jepochindex = indexgr;
          var i = 0;
          for (i = 0; i <= (366 + 31); i++) {
             var namebg = "daybg" + (indexbg + i);
             var namegr = "daygr" + (indexgr + i);
             var jepoch = jepochindex + i;

             var bg = document.getElementById(namebg);
             var gr = document.getElementById(namegr);

             if (gr != null) {
                setFuncOnFocus( "onfocus_"     + namegr, namegr, namebg);
                setFuncOnBlur ( "onblur_"      + namegr, namegr, namebg);
                setFuncOnmover( "onmouseover_" + namegr, namegr, namebg);
                setFuncOnmout ( "onmouseout_"  + namegr, namegr, namebg);
                setFuncOnmdown( "onmousedown_" + namegr, namegr, namebg, "<?php echo $DAYS_GR_URL_PARAMETER;?>", jepoch);
                setFuncOnmup  ( "onmouseup_"   + namegr, namegr, namebg, "<?php echo $DAYS_GR_URL_PARAMETER;?>", jepoch);
                setFuncOnkpres( "onkeypress_"  + namegr, namegr, namebg, "<?php echo $DAYS_GR_URL_PARAMETER;?>", jepoch);
           
                gr.onfocus     = this["onfocus_" + namegr];
                gr.onblur      = this["onblur_"  + namegr];
                gr.onmouseover = this["onmouseover_" + namegr];
                gr.onmouseout  = this["onmouseout_" + namegr];
                gr.onmousedown = this["onmousedown_" + namegr];
                gr.onmouseup   = this["onmouseup_" + namegr];
                gr.onkeypress  = this["onkeypress_" + namegr];
                gr.setAttribute("tabindex", i + 1);
                gr.setAttribute("tabIndex", i + 1);
                gr.tabIndex = (366 + 31) + i + 1;
             }
          }
     }
   </script>
</head>
<body class="body" onload="javascript:initialize();">

<nav>
<div class="toptitle"><span class="toptitle"><?php tr('Българският Календар', 'The Bulgarian Calendar', 'Der Bulgarisch Kalender', 'Болгарский Календарь')?></span> 

<div class="lang"> 
  <?php if ($lang != 'bg') echo '<a href="?lang=bg">'; ?> 
  <div class="flag-box">
    <div class="flag-flagbox">
      <span class="flag bg <?php echo $lang != 'bg' ? 'selectflag' :  'currentflag';?>"/>
    </div>
    <div class="flag-title<?php echo $lang == 'bg' ? '-current' : '';?>">bg</div>
  </div>
  <?php echo '</a>';?> 

  <?php if ($lang != 'en') echo '<a href="?lang=en">'; ?> 
  <div class="flag-box">
    <div class="flag-flagbox">
      <span class="flag en <?php echo $lang != 'en' ? 'selectflag' :  'currentflag';?>"/>
    </div>
    <div class="flag-title<?php echo $lang == 'en' ? '-current' : '';?>">en</div>
  </div>
  <?php echo '</a>';?> 

  <?php if ($lang != 'de') echo '<a href="?lang=de">'; ?> 
  <div class="flag-box">
    <div class="flag-flagbox">
      <span class="flag de <?php echo $lang != 'de' ? 'selectflag' :  'currentflag';?>"/>
    </div>
    <div class="flag-title<?php echo $lang == 'de' ? '-current' : '';?>">de</div>
  </div>
  <?php echo '</a>';?> 

  <?php if ($lang != 'ru') echo '<a href="?lang=ru">'; ?> 
  <div class="flag-box">
    <div class="flag-flagbox">
      <span class="flag ru <?php echo $lang != 'ru' ? 'selectflag' :  'currentflag';?>"/>
    </div>
    <div class="flag-title<?php echo $lang == 'ru' ? '-current' : '';?>">ru</div>
  </div>
  <?php echo '</a>';?> 

  <div class="flag-box" style="margin-left: 20px;">
    <div class="flag-flagbox" style="min-height: 24px; ">
<!-- Twitter Button Start -->
<a class="twitter-share-button" 
  href="https://twitter.com/intent/tweet?text=%D0%92%D0%B8%D0%B6+%D0%BA%D0%BE%D1%8F+%D0%B4%D0%B0%D1%82%D0%B0+%D1%81%D0%BC%D0%B5+%D0%B4%D0%BD%D0%B5%D1%81+%D1%81%D0%BF%D0%BE%D1%80%D0%B5%D0%B4+%D0%94%D1%80%D0%B5%D0%B2%D0%BD%D0%B8%D1%8F%D1%82+%D0%91%D1%8A%D0%BB%D0%B3%D0%B0%D1%80%D1%81%D0%BA%D0%B8+%D0%A3%D0%BD%D0%B8%D0%B2%D0%B5%D1%80%D1%81%D0%B0%D0%BB%D0%B5%D0%BD+%D0%9A%D0%B0%D0%BB%D0%B5%D0%BD%D0%B4%D0%B0%D1%80+&url=http%3A%2F%2Fbgkalendar.com&hashtagsbgkalendar&">Tweet</a>
<script>window.twttr = (function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0],
    t = window.twttr || {};
  if (d.getElementById(id)) return t;
  js = d.createElement(s);
  js.id = id;
  js.src = "https://platform.twitter.com/widgets.js";
  fjs.parentNode.insertBefore(js, fjs);

  t._e = [];
  t.ready = function(f) {
    t._e.push(f);
  };

  return t;
}(document, "script", "twitter-wjs"));</script>
<!-- Twitter Button End -->
    </div>
    <div class="flag-title" style="min-height: 25px;"> 
<!-- Facebook Like Button JavaScript SDK - START -->
    <div id="fb-root"></div>
    <script>(function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.7";
    fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>
<!-- Facebook Like Button JavaScript SDK - END -->

<!-- The actual Facebook like and share button START -->
    <div class="fb-like" data-href="http://bgkalendar.com/" data-layout="standard" data-action="like" data-show-faces="false" data-share="true"></div> 
<!-- The actual Facebook like and share button END -->
    </div>
  </div>
</div>
<ul class="topmenu">
    <li class="topmenucurrent"><span class="topmenu"><?php tr('Главна', 'Home', 'Grundseite', 'Главная страница');?></span></li>
    <li class="topmenu"><a class="topmenu" href="forum"><span class="topmenu"><?php tr('Дискусии', 'Phorum', 'Forum', 'Форум');?></span></a></li>
    <li class="topmenu"><a class="topmenu" href="papercalendar"><span class="topmenu"><?php tr('Хартиен Календар', 'Wall Calendar', 'Wandkalender', 'Стенный Календарь');?></span></a></li>
</ul>
</nav>
   

<br/>
<br/>
<?php if ($lang == 'bg') : ?>
   Древните българи, живели по нашите земи, създали собствен календар. Българският календар е 
   възстановен по писмени исторически данни (<a href="imennik.html">Именник на Българските Владетели</a>) и по народни
   предания и легенди. Безспорен успех за него е официалното признание на ЮНЕСКО, с което той е 
   признат за най-съвършенния в света. За начална точка на летоброенето е приет денят на зимното 
   слънцестоене (21-ви декември) през 5505 година преди Хр.<br/>
   Тази страница представлява опит за компютърен модел на <a href="kalendar.html">древният български календар</a> 
   и сравнението му със съвременния грегориански календар.
   <br/><br/>Сайтът "Българският Календар", подкрепя инициативата «За Българска Кирилица». За повече подробности, вижте <a href="kupu%D0%BBu%D1%86a.html">тук</a>.
<?php elseif ($lang == 'en') : ?>
   Ancient Bulgarians, who lived on Bulgarian land, created their own callendar system. The Bulgarian Callendar has been 
   reconstrucuted basedon on writen historical artefacts (<a href="imennik.html">Namelist of Bulgarian Rulers</a>), 
   Bulgarian national folklore and legends. Undisputed success is the official recognition from UNESCO, that this is 
   the most perfect and correct Callendar system known to the world. The start of this calendar system lays on the 
   winter solstice (21-st of December) 5505 years before Christ.<br/>
   This page is an attempt for a computer model of <a href="kalendar-en.html">the ancient Bulgarian calendar</a> and its 
   comparison with the modern Gregorian calendar.
   <br/><br/>The site "Bulgarian Calendar", supports the initiative «Pro Bulgarian Style Cyrillic Font». 
   For more information, see <a href="kupu%D0%BBu%D1%86a-en.html">here</a>.
<?php elseif ($lang == 'de') : ?>
   Das alte Bulgaren, die in bulgarisch Land gelebt hat, erstellt einen eigenen Kalender. Der bulgarische Kalender. 
   uber geschrieben historischen Daten (<a href="imennik.html">Namensliste der bulgarischen Khane</a>) und Volks Legenden umgebaut war.
   Der unbestrittene Erfolg ist die officielle Anerkennung durch die UNESCO, die er als die vollkommenste in der Welt anerkannt.
   Der Ausgangspunkt der Chronologie ist Tag des Winters akzeptiert Solstice (21. Dezember) in 5505 Jahre vor Christus.
   Diese Seite ist ein Computermodelanlauf von <a href="kalendar.html">des Bulgarischen Kalender</a> und seinen Vergleich mit modernen Gregorischen Kalender.
   <br/><br/>Die Webseite "Der Bulgarischer Kalender", unterstützt die Initiative  «Für Bulgarisch Kyrillisch Schriftart». 
   Weitere Informationen finden Sie <a href="kupu%D0%BBu%D1%86a.html">hier</a>.
<?php elseif ($lang == 'ru') : ?>
   Древние болгары жили на болгарском земле, создали собственный календарь. Болгарский календарь перестроен писменные исторические данные 
   (<a href="imennik.html">Именник Болгарских Канов</a>) и леганды. Бесспорный успех эго является официальное признание ЮНЕСКО, в которой он признан самым 
   совершенным в мире. Отправной точки летоизчисления принимается день зимном солнцестояния (21 декабря) 5505 годах до нашей эры.
   Этот сайт есть попытка компюторного моделя <a href="kalendar.html">древном болгарско календаря</a> и его 
   сравнение современном грегорианском календаря. 
   <br/><br/>Сайт "Болгарский Календарь", поддерживает инициативу  «За Болгарский стиль шрифта кириллицы». 
   Для дополнительной информации, смотрите <a href="kupu%D0%BBu%D1%86a.html">здесь</a>.
<?php endif ?>
<br/>
<br/>

<div id="bgcalclosed" class="openclosebutton-closed">
   <a class="openclosebutton" onclick="javascript: openclosebutton('bgcalclosed', 'bgcal', 'inline-block');"><div class="openclosebutton">+</div></a>
</div>
<div class="calendartype" id="bgcal" style="margin-right: 1em;">
<a class="openclosebutton" onclick="javascript: openclosebutton('bgcal', 'bgcalclosed', 'block');">
<div class="openclosebutton openclosebutton-position">-</div>
</a>
<center>
<div class="calendartypetitle">
   <?php tr('Древен Български Календар', 'Ancient Bulgarian Calendar', 'Der uralt Bulgarish Kalender', 'Древний Болгарский Календарь'); ?>
</div>
</center>
<div>
<nobr><?php tr('Ден',   'Day',   'Tag',   'День');   echo ": "; echo $daybgformatted;?>,</nobr> 
<nobr><?php tr('Месец', 'Month', 'Monat', 'Месяц');  echo ": "; echo $periodsbg[1]->getStructure()->getName($lang);?>,</nobr> 
<nobr><?php tr('Година','Year',  'Jahr',  'Год');    echo ": "; echo $yearbgformatted;?></nobr>
&nbsp; &nbsp;
<nobr>
<form method="GET" style="display: inline;">
<input type="text" name="cb" value="<?php echo $daybgformatted.'-'.$monthbgformatted.'-'.$yearbg;?>" size="10" style="text-align: right; font-weight: bold; font-family: Times; "/>
<input type="image" src="images/submit.svg" border="0" alt="Submit" />
</form>
<?php if ($hour != -1 && $minute != -1 && $secund != -1) { ?>
&nbsp; &nbsp;
[
  <?php echo formatMinimumDigits($hour, 2);?>:<?php echo formatMinimumDigits($minute, 2);?>:<?php echo formatMinimumDigits($secund, 2);?>
]
<?php } ?>
</nobr>
&nbsp; &nbsp;

<a class="details" onclick="javascript:showhidedetails('detailsbg');"><?php tr('Детайли', 'Details', 'Details', 'Подробности');?></a></div>
<div class="details" id="detailsbg">
   <table>
       <tr>
           <td class="details bold"><?php tr('Ден',   'Day',   'Tag',   'День');?>:</td>
           <td class="details bold">
               <a class="up" href="?db=<?php echo $daysbg + 1;?>">&#x25B2;</a>
               <a class="down" href="?db=<?php echo $daysbg - 1; ?>">&#x25BC;</a>
           </td>
           <td class="details"><?php echo seqPrefix($periodsbg[0]->getNumber() + 1, 'mnmm');?></td>
           <td class="details">
               <?php 
               if ($daybg == 31 && $monthbg == 12) { 
                   tr('(Еднажден, Игнажден, Ани-Алем")', '(Ednazhden, Ignazhden, Ani-alem)', '(Ednazhden, Ignazhden, Ani-Alem)', '(Еднажден, Игнажден, Ани-Алем)');
               } elseif ($daybg == 31 && $monthbg == 6) {
                   tr('(Ени-Джитем)', '(Eni-Dzhhitem)', '(Eni-Dzhitem)', '(Ени-Джитем)');
               } else {
                    echo '&nbsp;';
               }
               $weekdaybg = getBulgarianWeekDay($monthbg+1, $daybg+1);
               if ($weekdaybg != 0) {
                   tr('ден', 'day', 'Tag', 'день'); 
                   echo ' '; 
                   echo seqPrefix($weekdaybg, 'fnff'); 
                   tr('от българската седмица', 'from the Bulgarian week', 'von bulgarischen Woche', 'болгарской недели');
               }
               ?>
           </td>
       </tr>
       <tr>
           <td class="details bold"><?php tr('Месец', 'Month', 'Monat', 'Месяц');?>:</td>
           <td class="details bold">
               <a class="up" href="?db=<?php echo $daysbg + $periodsbg[1]->getStructure()->getTotalLengthInDays();?>">&#x25B2;</a>
               <a class="down" href="?db=<?php echo $daysbg - $periodsbg[1]->getStructure()->getTotalLengthInDays(); ?>">&#x25BC;</a>
           </td>
           <td class="details" colspan="2"><?php echo "" . seqPrefix($periodsbg[1]->getNumber() + 1, 'mnmm') . " (" . $periodsbg[1]->getStructure()->getName($lang) . ")";?></td>
       </tr>
       <tr>
           <td class="details bold"><?php tr('Година','Year',  'Jahr',  'Год');?>:</td>
           <td class="details bold">
               <a class="up" href="?db=<?php echo $daysbg + $periodsbg[2]->getStructure()->getTotalLengthInDays();?>">&#x25B2;</a>
               <a class="down" href="?db=<?php echo $daysbg - $periodsbg[2]->getStructure()->getTotalLengthInDays(); ?>">&#x25BC;</a>
           </td>
           <td class="details nobr"><?php echo seqPrefix($periodsbg[2]->getAbsoluteNumber() + 1, 'fnnm');?></td>
           <td class="details">
                <a class="period" href="kalendar<?php tr('','-en','','');?>.html#12g">
                  <?php 
                  $anim = ($periodsbg[2]->getAbsoluteNumber()) % 12;
                  tr($YEAR_ANIMALS[$anim], $YEAR_ANIMALS_EN[$anim],$YEAR_ANIMALS_DE[$anim],$YEAR_ANIMALS_RU[$anim]);
                  ?>
                </a>
                (<?php tr($YEAR_ANIMALS_BG[$anim], $YEAR_ANIMALS_BG_EN[$anim], $YEAR_ANIMALS_BG_DE[$anim], $YEAR_ANIMALS_BG_RU[$anim]);?>)<br/>
                <?php 
                echo seqPrefix($periodsbg[2]->getNumber()+1, 'fnnm'); 
                tr(' от началото на Четиригодие', 
                   ' from the beginning of four year period', 
                   ' von dem Anfang als vier Jahre lange Abschnitt', 
                   ' с начала четырёх летном периоде');
                ?>
                <br/>
                <?php 
                $yearbginstaryear = ( ( $periodsbg[2]->getAbsoluteNumber() ) % 60 ) + 1; 
                echo seqPrefix($yearbginstaryear, 'fnnm'); 
                tr(' от началото на 60 годишния Звезден Ден', 
                   ' from the beginning of the 60 year long Star Day', 
                   ' von dem Anfang als 60 Jahre lange Sternwoche', 
                   ' с начала 60 летний Звездный День');
                ?>
           </td>
       </tr>
   </table>
   <table>
       <tr>
            <td class="details bold">
                <a href="kalendar<?php tr('','-en','','');?>.html#4g" class="period"><?php tr('Четиригодие', 'Four year period', 'Vier Jahre Abschnitt', 'Четырёхлетный период');?></a>:
            </td>
            <td class="details detailsleft nobr"><?php echo seqPrefix($periodsbg[3]->getNumber()+1, 'nnmm');?></td>

            <td class="details bold detailsright">
                <a class="period" href="kalendar<?php tr('','-en','','');?>.html#1680g"><?php tr('Звезден Месец', 'Star Month', 'Sternmonat', 'Звездный Месяц');?></a>:
            </td>
            <td class="details nobr"><?php echo seqPrefix($periodsbg[6]->getNumber()+1, 'mnmm');?></td>
       </tr>
       <tr>
            <td class="details bold"><a class="period" href="kalendar<?php tr('','-en','','');?>.html#60g"><?php tr('Звезден Ден', 'Star Day', 'Sterntag', 'Звездный День');?></a>:</td>
            <td class="details detailsleft nobr"><?php echo seqPrefix($periodsbg[4]->getNumber()+1, 'mnmm');?></td>

            <td class="details bold detailsright">
                <a class="period" href="kalendar<?php tr('','-en','','');?>.html#20160g"><?php tr('Звездна Година', 'Star Year', 'Sternjahr', 'Звездный Год');?></a>:
            </td>
            <td class="details nobr"><?php echo seqPrefix($periodsbg[7]->getNumber()+1,'fnnm');?></td>
       </tr>
       <tr>
            <td class="details bold">
                <a class="period" href="kalendar<?php tr('','-en','','');?>.html#420"><?php tr('Звездна Седмица', 'Star Week', 'Sternwoche', 'Звездная Неделя');?></a>:
            </td>
            <td class="details detailsleft nobr"><?php echo seqPrefix($periodsbg[5]->getNumber()+1, 'fnff');?></td>

            <td class="details bold detailsright">
                <a class="period" href="kalendar<?php tr('','-en','','');?>.html#10080000g"><?php tr('Звездна Епоха', 'Star Epoch', 'Sternepoche', 'Звездная Эпоха');?></a>:
            </td>
            <td class="details nobr"><?php echo seqPrefix($periodsbg[8]->getNumber()+1, 'fnff');?></td>
       </tr>
       <?php if (file_exists(__DIR__ . "/infobg/" . $daybgformatted.'-'.$monthbgformatted.'.php')) { ?>
       <tr>
            <td colspan="4">
               <div class="info">
               <?php include(__DIR__ . "/infobg/" . $daybgformatted.'-'.$monthbgformatted.'.php'); ?> 
               </div>
            </td>
       </tr>
       <?php } ?>
   </table>
   <!-- These are the details. -->
</div>
<?php 
   $ibg = $periodsbg[2]->startsAtDaysAfterEpoch();
   $igr = bcsub($ibg, bcsub($daysbgFromStartOfCalendarTillJavaEpoch, $daysgrFromStartOfCalendarTillJavaEpoch));
   $jepochindex = bcsub($ibg, $daysbgFromStartOfCalendarTillJavaEpoch);
   $wday = bcmod($igr, 7);
   $tbg = $daysbgFromStartOfCalendar;
?>
<table border="0" style="margin: 10px; border: 10px;">
   <tr>
       <td class="calendartable yearperiod" rowspan="2">
        <div class="calendarvertical yearperiod"><?php tr('Първо Полугодие', 'First half of the year', 'Erste Halbjahr', 'Первое Полугодие');?></div>
       </td>
       <td class="calendartable yearperiod">
        <div class="calendarvertical yearperiod"><?php tr('Първо Тримесечие', 'First Quarter', 'Erste Vierteljah', 'Первая Четверть');?></div>
       </td>
       <td>
           <div class="month">
           <table class="calendartable">
           <tr class="calendartable">
               <td class="calendartable" colspan="7" style="text-align: center;"><?php tr('Месец Първи', 'First Month', 'Ersten Monat', 'Первый Месяц');?></td>
           </tr>
           <tr class="calendartable">
               <td class="calendarweekrow dayofweek"><div class="calendarvertical dayofweek">1<sup><?php tr('-ви','-st','-te','-ый');?></sup></div></td>
               <td class="calendarweekrow dayofweek"><div class="calendarvertical dayofweek">2<sup><?php tr('-ри','-nd','-te','-ой');?></sup></div></td>
               <td class="calendarweekrow dayofweek"><div class="calendarvertical dayofweek">3<sup><?php tr('-ти','-rd','-te','-ый');?></sup></div></td>
               <td class="calendarweekrow dayofweek"><div class="calendarvertical dayofweek">4<sup><?php tr('-ти','-th','-te','-ый');?></sup></div></td>
               <td class="calendarweekrow dayofweek"><div class="calendarvertical dayofweek">5<sup><?php tr('-ти','-th','-te','-ый');?></sup></div></td>
               <td class="calendarweekrow dayofweek"><div class="calendarvertical dayofweek">6<sup><?php tr('-ти','-th','-te','-ый');?></sup></div></td>
               <td class="calendarweekrow dayofweek"><div class="calendarvertical dayofweek">7<sup><?php tr('-ми','-th','-te','-ой');?></sup></div></td>
           </tr>
           <tr class="calendartable">
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">1</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">2</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">3</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">4</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">5</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">6</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">7</td><?php $wday%=7?>
           </tr>
           <tr class="calendartable">
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">8</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">9</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">10</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">11</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">12</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">13</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">14</td><?php $wday%=7?>
           </tr>
           <tr class="calendartable">
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">15</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">16</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">17</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">18</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">19</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">20</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">21</td><?php $wday%=7?>
           </tr>
           <tr class="calendartable">
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">22</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">23</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">24</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">25</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">26</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">27</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">28</td><?php $wday%=7?>
           </tr>
           <tr class="calendartable">
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">29</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">30</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">31</td><?php $wday%=7?>
       <td class="calendartable"></td>
       <td class="calendartable"></td>
       <td class="calendartable"></td>
       <td class="calendartable"></td>
           </tr>
       </table>
           </div>
           <div class="month">
           <table class="calendartable">
           <tr class="calendartable">
               <td class="calendartable" colspan="7" style="text-align: center;"><?php tr('Месец Втори', 'Second Month', 'Zweiten Monat', 'Второй Месяц');?></td>
           </tr>
           <tr class="calendartable">
               <td class="calendarweekrow dayofweek"><div class="calendarvertical dayofweek">1<sup><?php tr('-ви','-st','-te','-ый');?></sup></div></td>
               <td class="calendarweekrow dayofweek"><div class="calendarvertical dayofweek">2<sup><?php tr('-ри','-nd','-te','-ой');?></sup></div></td>
               <td class="calendarweekrow dayofweek"><div class="calendarvertical dayofweek">3<sup><?php tr('-ти','-rd','-te','-ый');?></sup></div></td>
               <td class="calendarweekrow dayofweek"><div class="calendarvertical dayofweek">4<sup><?php tr('-ти','-th','-te','-ый');?></sup></div></td>
               <td class="calendarweekrow dayofweek"><div class="calendarvertical dayofweek">5<sup><?php tr('-ти','-th','-te','-ый');?></sup></div></td>
               <td class="calendarweekrow dayofweek"><div class="calendarvertical dayofweek">6<sup><?php tr('-ти','-th','-te','-ый');?></sup></div></td>
               <td class="calendarweekrow dayofweek"><div class="calendarvertical dayofweek">7<sup><?php tr('-ми','-th','-te','-ой');?></sup></div></td>
           </tr>
           <tr class="calendartable">
       <td class="calendartable"></td>
       <td class="calendartable"></td>
       <td class="calendartable"></td>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">1</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">2</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">3</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">4</td><?php $wday%=7?>
           </tr>
           <tr class="calendartable">
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">5</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">6</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">7</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">8</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">9</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">10</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">11</td><?php $wday%=7?>
           </tr>
           <tr class="calendartable">
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">12</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">13</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">14</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">15</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">16</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">17</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">18</td><?php $wday%=7?>
           </tr>
           <tr class="calendartable">
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">19</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">20</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">21</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">22</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">23</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">24</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">25</td><?php $wday%=7?>
           </tr>
           <tr class="calendartable">
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">26</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">27</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">28</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">29</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">30</td><?php $wday%=7?>
       <td class="calendartable"></td>
       <td class="calendartable"></td>
           </tr>
       </table>
           </div>
           <div class="month">
           <table class="calendartable">
           <tr class="calendartable">
               <td class="calendartable" colspan="7" style="text-align: center;"><?php tr('Месец Трети', 'Tird Month', 'Dritten Monat', 'Третий Месяц');?></td>
           </tr>
           <tr class="calendartable">
               <td class="calendarweekrow dayofweek"><div class="calendarvertical dayofweek">1<sup><?php tr('-ви','-st','-te','-ый');?></sup></div></td>
               <td class="calendarweekrow dayofweek"><div class="calendarvertical dayofweek">2<sup><?php tr('-ри','-nd','-te','-ой');?></sup></div></td>
               <td class="calendarweekrow dayofweek"><div class="calendarvertical dayofweek">3<sup><?php tr('-ти','-rd','-te','-ый');?></sup></div></td>
               <td class="calendarweekrow dayofweek"><div class="calendarvertical dayofweek">4<sup><?php tr('-ти','-th','-te','-ый');?></sup></div></td>
               <td class="calendarweekrow dayofweek"><div class="calendarvertical dayofweek">5<sup><?php tr('-ти','-th','-te','-ый');?></sup></div></td>
               <td class="calendarweekrow dayofweek"><div class="calendarvertical dayofweek">6<sup><?php tr('-ти','-th','-te','-ый');?></sup></div></td>
               <td class="calendarweekrow dayofweek"><div class="calendarvertical dayofweek">7<sup><?php tr('-ми','-th','-te','-ой');?></sup></div></td>
           </tr>
           <tr class="calendartable">
       <td class="calendartable"></td>
       <td class="calendartable"></td>
       <td class="calendartable"></td>
       <td class="calendartable"></td>
       <td class="calendartable"></td>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">1</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">2</td><?php $wday%=7?>
           </tr>
           <tr class="calendartable">
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">3</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">4</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">5</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">6</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">7</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">8</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">9</td><?php $wday%=7?>
           </tr>
           <tr class="calendartable">
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">10</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">11</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">12</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">13</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">14</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">15</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">16</td><?php $wday%=7?>
           </tr>
           <tr class="calendartable">
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">17</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">18</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">19</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">20</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">21</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">22</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">23</td><?php $wday%=7?>
           </tr>
           <tr class="calendartable">
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">24</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">25</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">26</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">27</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">28</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">29</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">30</td><?php $wday%=7?>
           </tr>
       </table>
           </div>
       </td>
   </tr>
   <tr>
       <td class="calendartable yearperiod">
        <div class="calendarvertical yearperiod"><?php tr('Второ Тримесечие', 'Second Quarter', 'Zweite Vierteljahr', 'Вторая Четверть');?></div>
       </td>
       <td style="vertical-align: top;">
           <div class="month">
           <table class="calendartable">
           <tr class="calendartable">
               <td class="calendartable" colspan="7" style="text-align: center;"><?php tr('Месец Четвърти', 'Fourth Month', 'Vierten Monat', 'Четвёртый Месяц');?></td>
           </tr>
           <tr class="calendartable">
               <td class="calendarweekrow dayofweek"><div class="calendarvertical dayofweek">1<sup><?php tr('-ви','-st','-te','-ый');?></sup></div></td>
               <td class="calendarweekrow dayofweek"><div class="calendarvertical dayofweek">2<sup><?php tr('-ри','-nd','-te','-ой');?></sup></div></td>
               <td class="calendarweekrow dayofweek"><div class="calendarvertical dayofweek">3<sup><?php tr('-ти','-rd','-te','-ый');?></sup></div></td>
               <td class="calendarweekrow dayofweek"><div class="calendarvertical dayofweek">4<sup><?php tr('-ти','-th','-te','-ый');?></sup></div></td>
               <td class="calendarweekrow dayofweek"><div class="calendarvertical dayofweek">5<sup><?php tr('-ти','-th','-te','-ый');?></sup></div></td>
               <td class="calendarweekrow dayofweek"><div class="calendarvertical dayofweek">6<sup><?php tr('-ти','-th','-te','-ый');?></sup></div></td>
               <td class="calendarweekrow dayofweek"><div class="calendarvertical dayofweek">7<sup><?php tr('-ми','-th','-te','-ой');?></sup></div></td>
           </tr>
           <tr class="calendartable">
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">1</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">2</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">3</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">4</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">5</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">6</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">7</td><?php $wday%=7?>
           </tr>
           <tr class="calendartable">
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">8</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">9</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">10</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">11</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">12</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">13</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">14</td><?php $wday%=7?>
           </tr>
           <tr class="calendartable">
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">15</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">16</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">17</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">18</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">19</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">20</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">21</td><?php $wday%=7?>
           </tr>
           <tr class="calendartable">
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">22</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">23</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">24</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">25</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">26</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">27</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">28</td><?php $wday%=7?>
           </tr>
           <tr class="calendartable">
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">29</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">30</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">31</td><?php $wday%=7?>
       <td class="calendartable"></td>
       <td class="calendartable"></td>
       <td class="calendartable"></td>
       <td class="calendartable"></td>
           </tr>
       </table>
       </div>
       <div class="month">
           <table class="calendartable">
           <tr class="calendartable">
               <td class="calendartable" colspan="7" style="text-align: center;"><?php tr('Месец Пети', 'Fifth Month', 'Fünften Monat', 'Пятый Месяц');?></td>
           </tr>
           <tr class="calendartable">
               <td class="calendarweekrow dayofweek"><div class="calendarvertical dayofweek">1<sup><?php tr('-ви','-st','-te','-ый');?></sup></div></td>
               <td class="calendarweekrow dayofweek"><div class="calendarvertical dayofweek">2<sup><?php tr('-ри','-nd','-te','-ой');?></sup></div></td>
               <td class="calendarweekrow dayofweek"><div class="calendarvertical dayofweek">3<sup><?php tr('-ти','-rd','-te','-ый');?></sup></div></td>
               <td class="calendarweekrow dayofweek"><div class="calendarvertical dayofweek">4<sup><?php tr('-ти','-th','-te','-ый');?></sup></div></td>
               <td class="calendarweekrow dayofweek"><div class="calendarvertical dayofweek">5<sup><?php tr('-ти','-th','-te','-ый');?></sup></div></td>
               <td class="calendarweekrow dayofweek"><div class="calendarvertical dayofweek">6<sup><?php tr('-ти','-th','-te','-ый');?></sup></div></td>
               <td class="calendarweekrow dayofweek"><div class="calendarvertical dayofweek">7<sup><?php tr('-ми','-th','-te','-ой');?></sup></div></td>
           </tr>
           <tr class="calendartable">
       <td class="calendartable"></td>
       <td class="calendartable"></td>
       <td class="calendartable"></td>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">1</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">2</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">3</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">4</td><?php $wday%=7?>
           </tr>
           <tr class="calendartable">
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">5</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">6</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">7</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">8</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">9</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">10</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">11</td><?php $wday%=7?>
           </tr>
           <tr class="calendartable">
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">12</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">13</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">14</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">15</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">16</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">17</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">18</td><?php $wday%=7?>
           </tr>
           <tr class="calendartable">
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">19</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">20</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">21</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">22</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">23</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">24</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">25</td><?php $wday%=7?>
           </tr>
           <tr class="calendartable">
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">26</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">27</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">28</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">29</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">30</td><?php $wday%=7?>
       <td class="calendartable"></td>
       <td class="calendartable"></td>
           </tr>
       </table>
       </div>
       <div class="month">
           <table class="calendartable">
           <tr class="calendartable">
               <td class="calendartable" colspan="7" style="text-align: center;"><?php tr('Месец Шести', 'Sixth Month', 'Sechsten Monat', 'Шестой Месяц');?></td>
           </tr>
           <tr class="calendartable">
               <td class="calendarweekrow dayofweek"><div class="calendarvertical dayofweek">1<sup><?php tr('-ви','-st','-te','-ый');?></sup></div></td>
               <td class="calendarweekrow dayofweek"><div class="calendarvertical dayofweek">2<sup><?php tr('-ри','-nd','-te','-ой');?></sup></div></td>
               <td class="calendarweekrow dayofweek"><div class="calendarvertical dayofweek">3<sup><?php tr('-ти','-rd','-te','-ый');?></sup></div></td>
               <td class="calendarweekrow dayofweek"><div class="calendarvertical dayofweek">4<sup><?php tr('-ти','-th','-te','-ый');?></sup></div></td>
               <td class="calendarweekrow dayofweek"><div class="calendarvertical dayofweek">5<sup><?php tr('-ти','-th','-te','-ый');?></sup></div></td>
               <td class="calendarweekrow dayofweek"><div class="calendarvertical dayofweek">6<sup><?php tr('-ти','-th','-te','-ый');?></sup></div></td>
               <td class="calendarweekrow dayofweek"><div class="calendarvertical dayofweek">7<sup><?php tr('-ми','-th','-te','-ой');?></sup></div></td>
           </tr>
           <tr class="calendartable">
       <td class="calendartable"></td>
       <td class="calendartable"></td>
       <td class="calendartable"></td>
       <td class="calendartable"></td>
       <td class="calendartable"></td>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">1</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">2</td><?php $wday%=7?>
           </tr>
           <tr class="calendartable">
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">3</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">4</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">5</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">6</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">7</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">8</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">9</td><?php $wday%=7?>
           </tr>
           <tr class="calendartable">
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">10</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">11</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">12</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">13</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">14</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">15</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">16</td><?php $wday%=7?>
           </tr>
           <tr class="calendartable">
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">17</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">18</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">19</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">20</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">21</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">22</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">23</td><?php $wday%=7?>
           </tr>
           <tr class="calendartable">
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">24</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">25</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">26</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">27</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">28</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">29</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">30</td><?php $wday%=7?>
           </tr>
<?php 
$subperiods = ( isset($periodsbg[2]) && $periodsbg[2]->getStructure() != null) ? 
    ( $periodsbg[2]->getStructure()->getSubPeriods() ) : 
    ( null ); 
?>
<?php if ( isset($subperiods[5]) && $subperiods[5]->getTotalLengthIndays()>= 31) : ?>
           <tr class="calendartable">
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>" colspan="7"><?php tr('Ден Бехти', 'Day Behti', 'Tag Behti', 'День Бехти');?></td><?php $wday%=7?>
           </tr>
<?php endif ?>
       </table>
       </div>
       </td>
   </tr>
   <tr>
       <td class="calendartable yearperiod" rowspan="2">
        <div class="calendarvertical yearperiod"><?php tr('Второ Полугодие', 'Second half of the year', 'Zweite Halbjahr', 'Второе Полугодие');?></div>
       </td>
       <td class="calendartable yearperiod">
        <div class="calendarvertical yearperiod"><?php tr('Трето Тримесечие', 'Third Quarter', 'Dritte Vierteljahr', 'Третая Четверть');?></div>
       </td>
       <td>
           <div class="month">
           <table class="calendartable">
           <tr class="calendartable">
               <td class="calendartable" colspan="7" style="text-align: center;"><?php tr('Месец Седми', 'Seventh Month', 'Siebten Monat', 'Седьмой Месяц');?></td>
           </tr>
           <tr class="calendartable">
               <td class="calendarweekrow dayofweek"><div class="calendarvertical dayofweek">1<sup><?php tr('-ви','-st','-te','-ый');?></sup></div></td>
               <td class="calendarweekrow dayofweek"><div class="calendarvertical dayofweek">2<sup><?php tr('-ри','-nd','-te','-ой');?></sup></div></td>
               <td class="calendarweekrow dayofweek"><div class="calendarvertical dayofweek">3<sup><?php tr('-ти','-rd','-te','-ый');?></sup></div></td>
               <td class="calendarweekrow dayofweek"><div class="calendarvertical dayofweek">4<sup><?php tr('-ти','-th','-te','-ый');?></sup></div></td>
               <td class="calendarweekrow dayofweek"><div class="calendarvertical dayofweek">5<sup><?php tr('-ти','-th','-te','-ый');?></sup></div></td>
               <td class="calendarweekrow dayofweek"><div class="calendarvertical dayofweek">6<sup><?php tr('-ти','-th','-te','-ый');?></sup></div></td>
               <td class="calendarweekrow dayofweek"><div class="calendarvertical dayofweek">7<sup><?php tr('-ми','-th','-te','-ой');?></sup></div></td>
           </tr>
           <tr class="calendartable">
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">1</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">2</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">3</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">4</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">5</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">6</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">7</td><?php $wday%=7?>
           </tr>
           <tr class="calendartable">
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">8</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">9</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">10</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">11</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">12</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">13</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">14</td><?php $wday%=7?>
           </tr>
           <tr class="calendartable">
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">15</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">16</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">17</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">18</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">19</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">20</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">21</td><?php $wday%=7?>
           </tr>
           <tr class="calendartable">
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">22</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">23</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">24</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">25</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">26</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">27</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">28</td><?php $wday%=7?>
           </tr>
           <tr class="calendartable">
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">29</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">30</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">31</td><?php $wday%=7?>
       <td class="calendartable"></td>
       <td class="calendartable"></td>
       <td class="calendartable"></td>
       <td class="calendartable"></td>
           </tr>
       </table>
       </div>
       <div class="month">
           <table class="calendartable">
           <tr class="calendartable">
               <td class="calendartable" colspan="7" style="text-align: center;"><?php tr('Месец Осми', 'Eighth Month', 'Achten Monat', 'Восьмой Месяц');?></td>
           </tr>
           <tr class="calendartable">
               <td class="calendarweekrow dayofweek"><div class="calendarvertical dayofweek">1<sup><?php tr('-ви','-st','-te','-ый');?></sup></div></td>
               <td class="calendarweekrow dayofweek"><div class="calendarvertical dayofweek">2<sup><?php tr('-ри','-nd','-te','-ой');?></sup></div></td>
               <td class="calendarweekrow dayofweek"><div class="calendarvertical dayofweek">3<sup><?php tr('-ти','-rd','-te','-ый');?></sup></div></td>
               <td class="calendarweekrow dayofweek"><div class="calendarvertical dayofweek">4<sup><?php tr('-ти','-th','-te','-ый');?></sup></div></td>
               <td class="calendarweekrow dayofweek"><div class="calendarvertical dayofweek">5<sup><?php tr('-ти','-th','-te','-ый');?></sup></div></td>
               <td class="calendarweekrow dayofweek"><div class="calendarvertical dayofweek">6<sup><?php tr('-ти','-th','-te','-ый');?></sup></div></td>
               <td class="calendarweekrow dayofweek"><div class="calendarvertical dayofweek">7<sup><?php tr('-ми','-th','-te','-ой');?></sup></div></td>
           </tr>
           <tr class="calendartable">
       <td class="calendartable"></td>
       <td class="calendartable"></td>
       <td class="calendartable"></td>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">1</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">2</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">3</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">4</td><?php $wday%=7?>
           </tr>
           <tr class="calendartable">
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">5</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">6</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">7</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">8</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">9</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">10</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">11</td><?php $wday%=7?>
           </tr>
           <tr class="calendartable">
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">12</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">13</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">14</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">15</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">16</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">17</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">18</td><?php $wday%=7?>
           </tr>
           <tr class="calendartable">
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">19</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">20</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">21</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">22</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">23</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">24</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">25</td><?php $wday%=7?>
           </tr>
           <tr class="calendartable">
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">26</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">27</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">28</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">29</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">30</td><?php $wday%=7?>
       <td class="calendartable"></td>
       <td class="calendartable"></td>
           </tr>
       </table>
       </div>
       <div class="month">
           <table class="calendartable">
           <tr class="calendartable">
               <td class="calendartable" colspan="7" style="text-align: center;"><?php tr('Месец Девети', 'Ninth Month', 'Neunten Monat', 'Девятый Месяц');?></td>
           </tr>
           <tr class="calendartable">
               <td class="calendarweekrow dayofweek"><div class="calendarvertical dayofweek">1<sup><?php tr('-ви','-st','-te','-ый');?></sup></div></td>
               <td class="calendarweekrow dayofweek"><div class="calendarvertical dayofweek">2<sup><?php tr('-ри','-nd','-te','-ой');?></sup></div></td>
               <td class="calendarweekrow dayofweek"><div class="calendarvertical dayofweek">3<sup><?php tr('-ти','-rd','-te','-ый');?></sup></div></td>
               <td class="calendarweekrow dayofweek"><div class="calendarvertical dayofweek">4<sup><?php tr('-ти','-th','-te','-ый');?></sup></div></td>
               <td class="calendarweekrow dayofweek"><div class="calendarvertical dayofweek">5<sup><?php tr('-ти','-th','-te','-ый');?></sup></div></td>
               <td class="calendarweekrow dayofweek"><div class="calendarvertical dayofweek">6<sup><?php tr('-ти','-th','-te','-ый');?></sup></div></td>
               <td class="calendarweekrow dayofweek"><div class="calendarvertical dayofweek">7<sup><?php tr('-ми','-th','-te','-ой');?></sup></div></td>
           </tr>
           <tr class="calendartable">
       <td class="calendartable"></td>
       <td class="calendartable"></td>
       <td class="calendartable"></td>
       <td class="calendartable"></td>
       <td class="calendartable"></td>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">1</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">2</td><?php $wday%=7?>
           </tr>
           <tr class="calendartable">
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">3</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">4</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">5</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">6</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">7</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">8</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">9</td><?php $wday%=7?>
           </tr>
           <tr class="calendartable">
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">10</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">11</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">12</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">13</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">14</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">15</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">16</td><?php $wday%=7?>
           </tr>
           <tr class="calendartable">
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">17</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">18</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">19</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">20</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">21</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">22</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">23</td><?php $wday%=7?>
           </tr>
           <tr class="calendartable">
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">24</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">25</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">26</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">27</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">28</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">29</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">30</td><?php $wday%=7?>
           </tr>
       </table>
       </div>
       </td>
   </tr>
   <tr>
       <td class="calendartable yearperiod">
        <div class="calendarvertical yearperiod"><?php tr('Четвърто Тримесечие', 'Fifth Quarter', 'Vierte Vierteljahr', 'Четвёртая Четверть');?></div>
       </td>
       <td style="vertical-align: top"> 
         <div class="month">
         <table class="calendartable"> <tr class="calendartable">
           <td class="calendartable" 
                   colspan="7" 
                   style="text-align: center;">
                  Месец Десети
               </td>
         </tr>
           <tr class="calendartable">
               <td class="calendarweekrow dayofweek"><div class="calendarvertical dayofweek">1<sup><?php tr('-ви','-st','-te','-ый');?></sup></div></td>
               <td class="calendarweekrow dayofweek"><div class="calendarvertical dayofweek">2<sup><?php tr('-ри','-nd','-te','-ой');?></sup></div></td>
               <td class="calendarweekrow dayofweek"><div class="calendarvertical dayofweek">3<sup><?php tr('-ти','-rd','-te','-ый');?></sup></div></td>
               <td class="calendarweekrow dayofweek"><div class="calendarvertical dayofweek">4<sup><?php tr('-ти','-th','-te','-ый');?></sup></div></td>
               <td class="calendarweekrow dayofweek"><div class="calendarvertical dayofweek">5<sup><?php tr('-ти','-th','-te','-ый');?></sup></div></td>
               <td class="calendarweekrow dayofweek"><div class="calendarvertical dayofweek">6<sup><?php tr('-ти','-th','-te','-ый');?></sup></div></td>
               <td class="calendarweekrow dayofweek"><div class="calendarvertical dayofweek">7<sup><?php tr('-ми','-th','-te','-ой');?></sup></div></td>
           </tr>
         <tr class="calendartable">
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">1</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">2</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">3</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">4</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">5</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">6</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">7</td><?php $wday%=7?>
         </tr>
         <tr class="calendartable">
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">8</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">9</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">10</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">11</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">12</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">13</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">14</td><?php $wday%=7?>
         </tr>
         <tr class="calendartable">
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">15</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">16</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">17</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">18</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">19</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">20</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">21</td><?php $wday%=7?>
         </tr>
         <tr class="calendartable">
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">22</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">23</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">24</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">25</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">26</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">27</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">28</td><?php $wday%=7?>
         </tr>
         <tr class="calendartable">
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">29</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">30</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">31</td><?php $wday%=7?>
       <td class="calendartable"></td>
       <td class="calendartable"></td>
       <td class="calendartable"></td>
       <td class="calendartable"></td>
         </tr>
       </table>
       </div>
       <div class="month">
           <table class="calendartable">
         <tr class="calendartable">
           <td class="calendartable" 
                   colspan="7" 
                   style="text-align: center;">
                 <?php tr('Месец Единайсти', 'Eleventh Month', 'Elfte Monat', 'Одиннадцатый Месяц');?>
               </td>
         </tr>
           <tr class="calendartable">
               <td class="calendarweekrow dayofweek"><div class="calendarvertical dayofweek">1<sup><?php tr('-ви','-st','-te','-ый');?></sup></div></td>
               <td class="calendarweekrow dayofweek"><div class="calendarvertical dayofweek">2<sup><?php tr('-ри','-nd','-te','-ой');?></sup></div></td>
               <td class="calendarweekrow dayofweek"><div class="calendarvertical dayofweek">3<sup><?php tr('-ти','-rd','-te','-ый');?></sup></div></td>
               <td class="calendarweekrow dayofweek"><div class="calendarvertical dayofweek">4<sup><?php tr('-ти','-th','-te','-ый');?></sup></div></td>
               <td class="calendarweekrow dayofweek"><div class="calendarvertical dayofweek">5<sup><?php tr('-ти','-th','-te','-ый');?></sup></div></td>
               <td class="calendarweekrow dayofweek"><div class="calendarvertical dayofweek">6<sup><?php tr('-ти','-th','-te','-ый');?></sup></div></td>
               <td class="calendarweekrow dayofweek"><div class="calendarvertical dayofweek">7<sup><?php tr('-ми','-th','-te','-ой');?></sup></div></td>
           </tr>
         <tr class="calendartable">
       <td class="calendartable"></td>
       <td class="calendartable"></td>
       <td class="calendartable"></td>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">1</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">2</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">3</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">4</td><?php $wday%=7?>
         </tr>
         <tr class="calendartable">
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">5</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">6</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">7</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">8</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">9</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">10</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">11</td><?php $wday%=7?>
         </tr>
         <tr class="calendartable">
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">12</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">13</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">14</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">15</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">16</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">17</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">18</td><?php $wday%=7?>
         </tr>
         <tr class="calendartable">
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">19</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">20</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">21</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">22</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">23</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">24</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">25</td><?php $wday%=7?>
         </tr>
         <tr class="calendartable">
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">26</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">27</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">28</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">29</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">30</td><?php $wday%=7?>
       <td class="calendartable"></td>
       <td class="calendartable"></td>
         </tr>
       </table>
       </div>
       <div class="month">
           <table class="calendartable">
        <tr class="calendartable">
          <td class="calendartable" colspan="7" style="text-align: center;"><?php tr('Месец Дванайсти', 'Twelfth Month', 'Zwölfte Monat', 'Двенадцатый Месяц');?> </td>
        </tr>
        <tr class="calendartable">
               <td class="calendarweekrow dayofweek"><div class="calendarvertical dayofweek">1<sup><?php tr('-ви','-st','-te','-ый');?></sup></div></td>
               <td class="calendarweekrow dayofweek"><div class="calendarvertical dayofweek">2<sup><?php tr('-ри','-nd','-te','-ой');?></sup></div></td>
               <td class="calendarweekrow dayofweek"><div class="calendarvertical dayofweek">3<sup><?php tr('-ти','-rd','-te','-ый');?></sup></div></td>
               <td class="calendarweekrow dayofweek"><div class="calendarvertical dayofweek">4<sup><?php tr('-ти','-th','-te','-ый');?></sup></div></td>
               <td class="calendarweekrow dayofweek"><div class="calendarvertical dayofweek">5<sup><?php tr('-ти','-th','-te','-ый');?></sup></div></td>
               <td class="calendarweekrow dayofweek"><div class="calendarvertical dayofweek">6<sup><?php tr('-ти','-th','-te','-ый');?></sup></div></td>
               <td class="calendarweekrow dayofweek"><div class="calendarvertical dayofweek">7<sup><?php tr('-ми','-th','-te','-ой');?></sup></div></td>
        </tr>
        <tr class="calendartable">
       <td class="calendartable"></td>
       <td class="calendartable"></td>
       <td class="calendartable"></td>
       <td class="calendartable"></td>
       <td class="calendartable"></td>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">1</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">2</td><?php $wday%=7?>
        </tr>
        <tr class="calendartable">
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">3</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">4</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">5</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">6</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">7</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">8</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">9</td><?php $wday%=7?>
        </tr>
        <tr class="calendartable">
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">10</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">11</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">12</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">13</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">14</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">15</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">16</td><?php $wday%=7?>
        </tr>
        <tr class="calendartable">
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">17</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">18</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">19</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">20</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">21</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">22</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">23</td><?php $wday%=7?>
        </tr>
        <tr class="calendartable">
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">24</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">25</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">26</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">27</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">28</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">29</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">30</td><?php $wday%=7?>
        </tr>
        <tr class="calendartable">
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>" colspan="7"><?php tr('Ден Ени', 'Day Eni', 'Tag Eni', 'День Ени');?></td><?php $wday%=7?>
        </tr>
       </table>
       </div>
       </td>
   </tr>
</table>
</div>

<!-- ***************************************************************************************************** -->

<div id="grcalclosed" class="openclosebutton-closed">
   <a class="openclosebutton" onclick="javascript: openclosebutton('grcalclosed', 'grcal', 'inline-block');"><div class="openclosebutton">+</div></a>
</div>
<div class="calendartype" id="grcal" style="margin-left: 1em;">
<a class="openclosebutton" onclick="javascript: openclosebutton('grcal', 'grcalclosed', 'block');">
<div class="openclosebutton openclosebutton-position">-</div>
</a>
<center>
<div class="calendartypetitle">
   <?php tr('Съвременен Грегориански Календар', 'Modern Gregorian Calendar', 'Modernen Gregorischen Kalender', 'Современный Грегорианский Календарь');?>
</div>
</center>
<div>
<nobr><?php tr('Ден', 'Day', 'Tag', 'День');?>: <?php echo formatMinimumDigits($daygr, 2);?>,</nobr>
<nobr><?php tr('Месец', 'Month', 'Monat', 'Месяц');?>: <?php echo $periodsgr[1]->getStructure()->getName($lang);?>,</nobr> 
<nobr><?php tr('Година', 'Year', 'Jahr', 'Год');?>: <?php echo formatMinimumDigits($yeargr, 4);?></nobr>
&nbsp; &nbsp;
<nobr>
<form method="GET" style="display: inline;">
<input type="text" name="cg" value="<?php echo $daygrformatted.'-'.$monthgrformatted.'-'.$yeargr;?>" size="10" style="text-align: right; font-weight: bold; font-family: Times; "/>
<input type="image" src="images/submit.svg" border="0" alt="Submit" />
</form>
<?php if ($hour != -1 && $minute != -1 && $secund != -1) { ?>
&nbsp; 
[
  <?php echo formatMinimumDigits($hour, 2);?>:<?php echo formatMinimumDigits($minute, 2);?>:<?php echo formatMinimumDigits($secund, 2);?>
]
<?php } ?>
</nobr>
&nbsp; &nbsp;

<a class="details" onclick="javascript:showhidedetails('detailsgr');"><?php tr('Детайли', 'Details', 'Details', 'Подробности');?></a></div>
<div class="details" id="detailsgr">
   <table>
       <tr>
           <td class="details bold"><?php tr('Ден', 'Day', 'Tag', 'День');?>:</td>
           <td class="details bold">
               <a class="up" href="?dg=<?php echo $daysgr + 1;?>">&#x25B2;</a><a class="down" href="?dg=<?php echo $daysgr - 1; ?>">&#x25BC;</a>
           </td>
           <td class="details"><?php echo seqPrefix($periodsgr[0]->getNumber() + 1, 'mnmm');?></td>
           <td class="details">
               <?php
                  $wee = bcmod($daysgrFromStartOfCalendar, '7'); 
                  tr('Ден от седмицата', 'Day of week', 'Wochentag', 'День недели'); 
                  echo ': '; 
                  tr($WEEKDAYS[$wee], $WEEKDAYS_EN[$wee], $WEEKDAYS_DE[$wee], $WEEKDAYS_RU[$wee]);
               ?> 
           </td>
       </tr>
       <tr>
           <td class="details bold"><?php tr('Месец', 'Month', 'Monat', 'Месяц');?>:</td>
           <td class="details bold">
               <a class="up" href="?dg=<?php echo $daysgr + $periodsgr[1]->getStructure()->getTotalLengthInDays();?>">&#x25B2;</a>
               <a class="down" href="?dg=<?php echo $daysgr - $periodsgr[1]->getStructure()->getTotalLengthInDays(); ?>">&#x25BC;</a>
           </td>
           <td class="details" colspan="2"><?php echo "" . seqPrefix($periodsgr[1]->getNumber() + 1, 'mnmm') . " (" . $periodsgr[1]->getStructure()->getName($lang) . ")";?>
           </td>
       </tr>
       <tr>
           <td class="details bold"><?php tr('Година', 'Year', 'Jahr', 'Год');?>:</td>
           <td class="details bold">
               <a class="up" href="?dg=<?php echo $daysgr + $periodsgr[2]->getStructure()->getTotalLengthInDays();?>">&#x25B2;</a>
               <a class="down" href="?dg=<?php echo $daysgr - $periodsgr[2]->getStructure()->getTotalLengthInDays(); ?>">&#x25BC;</a>
           </td>
           <td class="details nobr"><?php echo seqPrefix($periodsgr[2]->getAbsoluteNumber() + 1,'fnnm');?></td>
           <td class="details">
                <?php 
                echo seqPrefix($periodsgr[2]->getNumber()+1, 'fnnm'); 
                tr(' от началото на Четиригодие', 
                   ' from the beginning of four year period', 
                   ' bis den Anfang dem Vierteljahr', 
                   ' с начала четиригодием');
                ?>
                <br/>
                <?php 
                $yeargrincentury = ( ( $periodsgr[2]->getAbsoluteNumber() ) % 100 ) + 1;
                echo seqPrefix($yeargrincentury, 'fnnm');
                tr(' от началото на Столетие (Век)', 
                   ' from the beginning of a Century', 
                   ' bis den Anfang dem Jahrhundert', 
                   ' с начала веком'); 
                ?>
           </td>
       </tr>
       <tr>
            <td class="details bold"><?php tr('Четиригодие', 'Four year period', 'Vier Jahre Abschnitt', 'Четырёхлетный период');?>:</td>
            <td class="details nobr"><?php echo seqPrefix($periodsgr[3]->getNumber()+1, 'nnmm');?></td>

            <td class="details" colspan="2">
                <?php 
                tr(' от началото на столетието/века', 
                   ' from the beginning of the Century', 
                   ' bis den Anfang dem Jahrhundert', 
                   ' с начала веком');
                ?>
            </td>
       </tr>
       <tr>
            <td class="details bold"><?php tr('Столетие/Век', 'Century', 'Jahrhundert', 'Век');?>:</td>
            <td class="details nobr"><?php echo seqPrefix($periodsgr[4]->getAbsoluteNumber()+1, 'nnnm');?></td>

            <td class="details" colspan="2">
               <?php 
               echo seqPrefix($periodsgr[4]->getAbsoluteNumber()+1, 'nnnm'); 
               tr(' от началото на календара и', 
                  ' from the beginning of the calendar', 
                  ' bis den Anfang dem Kalender', 
                  ' с началом календаря');
               ?> 
               <br/>
               <?php 
               echo seqPrefix($periodsgr[4]->getNumber()+1, 'mnnm'); 
               tr(' от началото на 400г. период.', 
                  ' from the beginning of the 400y. period', 
                  ' bis den Anfang dem 400 Jahre Abschnitt', 
                  ' с началом 400 летном периодом');
               ?>
            </td>
       </tr>
       <tr>
            <td class="details bold"><?php tr('400г. период', '400y. period', '400 J. Abschnitt', '400 лет период');?>:</td>
            <td class="details detailsleft nobr"><?php echo seqPrefix($periodsgr[5]->getAbsoluteNumber()+1, 'mnmm');?></td>

            <td class="details bold detailsright"></td>
            <td class="details"></td>
       </tr>
       <?php if (file_exists(__DIR__ . "/infogr/" . $daygrformatted.'-'.$monthgrformatted.'.php')) { ?>
       <tr>
            <td colspan="4">
               <div class="info">
               <?php include(__DIR__ . "/infogr/" . $daygrformatted.'-'.$monthgrformatted.'.php'); ?> 
               </div>
            </td>
       </tr>
       <?php } ?>
   </table>
   <!-- These are the details. -->
</div>
<?php 

$igr = $periodsgr[2]->startsAtDaysAfterEpoch();
$ibg = bcadd($igr, bcsub($daysbgFromStartOfCalendarTillJavaEpoch, $daysgrFromStartOfCalendarTillJavaEpoch));


$jepochindex = bcsub($igr, $daysgrFromStartOfCalendarTillJavaEpoch);
$tgr = $daysgrFromStartOfCalendar;
$wday = bcmod($igr, 7);
?>

<table border="0" style="float: left; margin: 10px; border: 10px;">
   <tr>
       <td class="calendartable yearperiod" rowspan="2">
        <div class="calendarvertical yearperiod"><?php tr('Първо Полугодие', 'First half of the year', 'Erste Halbjahr', 'Первое Полугодие');?></div>
       </td>
       <td class="calendartable yearperiod">
        <div class="calendarvertical yearperiod"><?php tr('Първо Тримесечие', 'First Quarter', 'Erste Vierteljahr', 'Первая Четверть');?></div>
       </td>
       <td style="vertical-align: top">
         <div class="month">
           <?php $wday = bcmod($igr, 7); ?>
           <?php $igr = drawMonth($periodsgr[2]->getAbsoluteNumber()+1, tri('Януари', 'January', 'Januar', 'Январь'), 31, $wday, $igr, $tgr);?>
         </div>
         <div class="month">
           <?php
            $wday = bcmod($igr, 7); 
            $februarydays = 28; 
            $subperiods = ( isset($periodsgr[2]) && $periodsgr[2]->getStructure() != null) ?
                ( $periodsgr[2]->getStructure()->getSubPeriods() ) :
                ( null );
            if ( isset($subperiods[1])) {
               $februarydays = $subperiods[1]->getTotalLengthIndays();
            }
            ?>
           <?php $igr = drawMonth($periodsgr[2]->getAbsoluteNumber()+1, tri('Февруари', 'February', 'Februar', 'Февраль'), $februarydays, $wday, $igr, $tgr);?>
         </div>
         <div class="month">
           <?php $wday = bcmod($igr, 7); ?>
           <?php $igr = drawMonth($periodsgr[2]->getAbsoluteNumber()+1, tri('Март', 'March', 'März', 'Март'),31, $wday, $igr, $tgr);?>
         </div>
       </td>
   </tr>
   <tr>
       <td class="calendartable yearperiod">
        <div class="calendarvertical yearperiod"><?php tr('Второ Тримесечие', 'Second Quarter', 'Zweite Vierteljahr', 'Вторая Четверть');?></div>
       </td>
       <td style="vertical-align: top;">
         <div class="month">
           <?php $wday = bcmod($igr, 7); ?>
           <?php $igr = drawMonth($periodsgr[2]->getAbsoluteNumber()+1, tri('Април', 'April', 'April', 'Апрель'), 30, $wday, $igr, $tgr);?>
         </div>
         <div class="month">
           <?php $wday = bcmod($igr, 7); ?>
           <?php $igr = drawMonth($periodsgr[2]->getAbsoluteNumber()+1, tri('Май', 'May', 'Mai', 'Май'), 31, $wday, $igr, $tgr);?>
         </div>
         <div class="month">
           <?php $wday = bcmod($igr, 7); ?>
           <?php $igr = drawMonth($periodsgr[2]->getAbsoluteNumber()+1, tri('Юни', 'June', 'Juni', 'Июнь'), 30, $wday, $igr, $tgr);?>
         </div>
       </td>
   </tr>
   <tr>
       <td class="calendartable yearperiod" rowspan="2">
        <div class="calendarvertical yearperiod"><?php tr('Второ Полугодие', 'Second half of the year', 'Zweite Halbjahr', 'Второе Полугодие');?></div>
       </td>
       <td class="calendartable yearperiod">
        <div class="calendarvertical yearperiod"><?php tr('Трето Тримесечие', 'Third Quarter', 'Dritte Vierteljahr', 'Третая Четверть');?></div>
       </td>
       <td style="vertical-align: top">
         <div class="month">
           <?php $wday = bcmod($igr, 7); ?>
           <?php $igr = drawMonth($periodsgr[2]->getAbsoluteNumber()+1, tri('Юли', 'July', 'Juli', 'Июль'), 31, $wday, $igr, $tgr);?>
         </div>
         <div class="month">
           <?php $wday = bcmod($igr, 7); ?>
           <?php $igr = drawMonth($periodsgr[2]->getAbsoluteNumber()+1, tri('Август', 'August', 'August', 'Август'), 31, $wday, $igr, $tgr);?>
         </div>
         <div class="month">
           <?php $wday = bcmod($igr, 7); ?>
           <?php $igr = drawMonth($periodsgr[2]->getAbsoluteNumber()+1, tri('Септември', 'September', 'September', 'Сентябрь'), 30, $wday, $igr, $tgr);?>
         </div>
       </td>
   </tr>
   <tr>
       <td class="calendartable yearperiod">
        <div class="calendarvertical yearperiod"><?php tr('Четвърто Тримесечие', 'Fourth Quarter', 'Vierte Vierteljahr', 'Четвёртая Четверть');?></div>
       </td>
       <td style="vertical-align: top">
         <div class="month">
           <?php $wday = bcmod($igr, 7); ?>
           <?php $igr = drawMonth($periodsgr[2]->getAbsoluteNumber()+1, tri('Октомври', 'October', 'Oktober', 'Октябрь'), 31, $wday, $igr, $tgr);?>
         </div>
         <div class="month">
           <?php $wday = bcmod($igr, 7); ?>
           <?php $igr = drawMonth($periodsgr[2]->getAbsoluteNumber()+1, tri('Ноември', 'November', 'November', 'Ноябрь'), 30, $wday, $igr, $tgr);?>
         </div>
         <div class="month">
           <?php $wday = bcmod($igr, 7); ?>
           <?php $igr = drawMonth($periodsgr[2]->getAbsoluteNumber()+1, tri('Декември', 'December', 'Dezember', 'Декабрь'), 31, $wday, $igr, $tgr);?>
         </div>
       </td>
   </tr>
</table>
</div>

<div class="footer">
<div class="footerfloat">
 <span class="footer bold"><?php tr('Карта на сайта', 'Site Map', 'Seitenübersicht', 'Карта сайта');?></span>
 <ul>
     <li><a class="footer" href="."><span class="footer"><?php tr('Главна страница', 'Home', 'Grundseite', 'Главная страница');?></span></a></li>
     <li>
         <a class="footer" href="kalendar<?php tr('', '-en', '', '');?>.html">
             <span class="footer">
                 <?php 
                 tr('Принципи на Българския Календар', 
                    'Bulgarian Calendar Principles', 
                    'Grundsätze der bulgarischen Kalender', 
                    'Принципы болгарского календаря');
                 ?>
             </span>
         </a>
     </li>
     <li>
         <a class="footer" href="imennik.html">
             <span class="footer">
                 <?php 
                 tr('Именник на Българските Канове', 
                    'Name List of Bulgarian Khans', 
                    'Namensliste der bulgarischen Khane', 
                    'Именник болгарских канов');
                 ?>
             </span>
         </a>
     </li>
     <li>
         <a class="footer" href="imennik.html">
             <span class="forum">
                 <?php 
                 tr('Дискусии', 'Phorum', 'Forum', 'Форум');
                 ?>
             </span>
         </a>
     </li>
     <li>
         <a class="footer" href="kupu%D0%BBu%D1%86a<?php tr('','-en', '', '');?>.html">
             <span class="forum">
                 <?php 
                 tr('Българска кирилица', 'Bulgarian cyrillic', 'Bulgarisch Kyrillisch', 'Болгарская кириллица');
                 ?>
             </span>
         </a>
     </li>
 </ul>
</div>
<div class="footerfloat">
 <span class="footer bold"><?php tr('Контакт', 'Contacts', 'Kontakte', 'Контакт');?></span></b>
 <ul>
     <li><a class="footer" href="mailto:admin@bgkalendar.com"><span class="footer">admin@bgkalendar.com</span></a></li>
 </ul>
</div>
<div class="footerfloat">
 <span class="footer bold"><?php tr('Разработка', 'Development', 'Entwicklung', 'Разработка');?></span>
 <ul>
     <li>
         <a class="footer" href="https://github.com/ynedelchev/bgkalendar/">
             <span class="footer">
                 <?php 
                 tr('Изходен код', 'Source code', 'Quellcode', 'Исходный код');
                 ?>
             </span>
          </a>
     </li>
 </ul>
</div>
<div class="footerfloat">
<!-- Tracker code start -->
<div id="eXTReMe"><a href="http://extremetracking.com/open?login=yordan">
<img src="http://t1.extreme-dm.com/i.gif" style="border: 0;"
height="38" width="41" id="EXim" alt="eXTReMe Tracker" /></a>
<script type="text/javascript"><!--
EXref="";top.document.referrer?EXref=top.document.referrer:EXref=document.referrer;//-->
</script><script type="text/javascript"><!--
var EXlogin='yordan' // Login
var EXvsrv='s9' // VServer
EXs=screen;EXw=EXs.width;navigator.appName!="Netscape"?
EXb=EXs.colorDepth:EXb=EXs.pixelDepth;EXsrc="src";
navigator.javaEnabled()==1?EXjv="y":EXjv="n";
EXd=document;EXw?"":EXw="na";EXb?"":EXb="na";
EXref?EXref=EXref:EXref=EXd.referrer;
EXd.write("<img "+EXsrc+"=http://e0.extreme-dm.com",
"/"+EXvsrv+".g?login="+EXlogin+"&amp;",
"jv="+EXjv+"&amp;j=y&amp;srw="+EXw+"&amp;srb="+EXb+"&amp;",
"l="+escape(EXref)+" height=1 width=1>");//-->
</script><noscript><div id="neXTReMe"><img height="1" width="1" alt=""
src="http://e0.extreme-dm.com/s9.g?login=yordan&amp;j=n&amp;jv=n" />
</div></noscript></div>
<!-- Tracker code end-->
</div>
</div>

</body>
</html>
