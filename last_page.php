<!DOCTYPE html>

<html lang="ru" xml:lang="ru">
<head>
<title>26 задание ЕГЭ</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf8" />
<meta name="keywords" content="layout, css layout, xhtml layout, css, xhtml, webstandards, free, free layout, free div layout" />
<link rel="stylesheet" type="text/css" href="css.css" media="screen" />
</head>

<body>

<div id="container">


	<div id="header"><div class="headtitle">26 знания ЕГЭ</div></div>



	<div id="menu">
		<ul>
			<li><a href="index.php" title="">ПОДГОТОВКА</a></li>
			<li><a href="second_page.php" title="">ТРОПЫ</a></li>
			<li><a href="third_page.php" title="">СИНТАКСИЧЕСКИЕ СР-ВА</a></li>
			<li><a href="fourth_page.php" title="">ФОНЕТИЧЕСКИЕ СР-ВА</a></li>
			<li><a href="#" title="">ЛЕКСИЧЕСКИЕ СР-ВА ВЫРАЗИТЕЛЬНОСТИ</a></li>
			<li><a id="is_active">ТЕСТЫ</a></li>
	</div>

	

	<div id="roundedheader">&nbsp;</div>
	<div id="content">
	
		<div id="insidecontent">
			
			<h1>ТЕСТЫ</h1>
			<h2>ТЕСТЫ</h2>
			
			<h3>Теперь проверим ваши знания </h3>
			<p><!DOCTYPE html PUBLIC "–//W3C//DTD HTML 4.01//EN">
<html><head>
<meta http–equiv="Content–Type" content="text/html; charset=Windows–1251" 
</head><body>
<?php
 $test = array (
  array ('q'=>' Назовите использованное средство выразительности.
И наше северное лето,
Карикатура южных зим,
Мелькнет и нет... (А.Пушкин)
','t'=>'text','a'=>'Перифраза'),
array ('q'=>'  Уж вечер... Облаков померкнули края,
Последний луч зари на башнях умирает. (В.Жуковский)
','t'=>'text','a'=>'Олицетворение'),
array ('q'=>' – Эй, борода! А как проехать отсюда к Плюшкину, так чтоб не мимо господского дома?..(Н.Гоголь)
','t'=>'text','a'=>'Синекдоха'),
  array ('q'=>'И невозможное возможно, дорога дальняя легка.','t'=>'select','i'=>'Литота|Оксюморон|Градация','a'=>'1'),
  array ('q'=>'Выберите предложения с сравнениями','t'=>'multiselect',
   'i'=>'Девичьи лица ярче роз.. |Разливы рек ее, подобные морям...|Покатились глаза собачьи
Золотыми звездами в снег','a'=>'1|1|0')
 );
 if (!empty($_POST['action'])) { //считаем правильные и выводим резюме
  $ball = 0;
  foreach ($test as $key=>$val) {
   switch ($val['t']) {
    case 'checkbox':
     if (isset($_POST[$key]) and $val['a']==1 or !isset($_POST[$key]) and $val['a']==0) $ball++;
    break;
    case 'text':
     if (isset($_POST[$key]) and strlwr_($_POST[$key])==strlwr_($val['a'])) $ball++;
    break;
    case 'select':
     if (isset($_POST[$key]) and $_POST[$key]==$val['a']) $ball++;
    break;
    case 'multiselect':
     $i = explode ('|',$val['a']);
     $cnt = 0;
     foreach ($i as $number=>$answer)
      if (isset($_POST[$key.'_'.$number]) and $answer==1 or 
        !isset($_POST[$key.'_'.$number]) and $answer==0) $cnt++;
     if ($cnt==count($i)) $ball++;
    break;
   }
  }
  $p = round ($ball/count($test)*100);
  echo '<p>Верных ответов: '.$ball.' из '.count($test).', '.$p.'%.</p>';
  echo '<p><a href="'.$_SERVER['PHP_SELF'].'">Ещё раз!</a></p>';
 }
 else { //предложить форму
  echo '<p></p>';
  $counter = 1;
  echo '<form method="post">';
  foreach ($test as $key=>$val) {
   error_check ($val);
   echo ($counter++).'. ';
   switch ($val['t']) {
    case 'checkbox':
     echo $val['q'].' <input type="checkbox" name="'.$key.'" value="1">';
    break;
    case 'text':
     $len = strlen ($val['a']);
     echo $val['q'].' <input type="text" name="'.$key.'" value="" maxlength="'.$len.'" size="'.($len+1).'">'; 
    break;
    case 'select':
     echo $val['q'].' <select name="'.$key.'" size="1">';
     $i = explode ('|',$val['i']);
     foreach ($i as $number=>$item) echo '<option value="'.$number.'">'.$item;
     echo '</select>';
    break;
    case 'multiselect':
     $i = explode ('|',$val['i']);	 
     echo $val['q'].':&nbsp;&nbsp;&nbsp;';
     foreach ($i as $number=>$item)
      echo $item.' <input type="checkbox" name="'.$key.'_'.$number.'" value="1">&nbsp;&nbsp;&nbsp;';
    break;
   }
   echo '<br>';
  }
  echo '<input type="submit" name="action" value="Ответить"></form>';
 }

 function error_check ($q) {
  $question_types = array ('checkbox', 'text', 'select', 'multiselect');
  $error = '';
  if (!isset($q['q']) or empty($q['q'])) $error='Нет текста вопроса или он пуст';
  else if (!isset($q['t']) or empty($q['t'])) $error='Не указан или пуст тип вопроса';
  else if (!in_array($q['t'],$question_types)) $error='Указан неверный тип вопроса';
  else if (!isset($q['a']) or empty($q['a']) and $q['a']!='0') $error='Нет текста ответа или он пуст';
  else {
   if ($q['t']=='checkbox' and !($q['a']=='0' or $q['a']=='1')) 
    $error = 'Для переключателя разрешены ответы 0 или 1';
   else if ($q['t']=='select' || $q['t']=='multiselect') {
    if (!isset($q['i']) or empty($q['i'])) $error='Не указаны элементы списка';
    else {
     $i = explode ('|',$q['i']);
     if (count($i)<2) $error='Нет хотя бы 2 элементов списка вариантов ответа с разделителем |';
     foreach ($i as $s) if (strlen($s)<1) { $error = 'Вариант ответа короче 1 символа'; break; }
     else {
      if ($q['t']=='select' and !array_key_exists($q['a'],$i)) $error='Ответ не является номером элемента списка';
      if ($q['t']=='multiselect' ) {
       $a = explode ('|',$q['a']);
       if (count($i)!=count($a)) $error='Число утверждений и ответов не совпадает';
       foreach ($a as $s) if ($s!='0' and $s!='1') { 
        $error = 'Утверждение не отмечено как верное или неверное'; break; 
       }
      }
     }
    }
   }
  }
  if (!empty($error)) {
   echo '<p>Найдена ошибка теста: '.$error.'</p><p>Отладочная информация:</p>';
   print_r ($q);
   exit;
  }
 }
 
 function strlwr_($s){
  $hi = "ABCDEFGHIJKLMNOPQRSTUVWXYZАБВГДЕЁЖЗИЙКЛМНОПРСТУФХЦЧШЩЪЫЬЭЮЯ";
  $lo = "abcdefghijklmnopqrstuvwxyzабвгдеёжзийклмнопрстуфхцчшщъыьэюя";
  $len = strlen ($s);
  $d='';
  for ($i=0; $i<$len; $i++) {
   $c = substr($s,$i,1);
   $n = strpos($c,$hi); 
   if ($n!==FALSE) $c = substr ($lo,$n,1);
   $d .= $c;
  }
  return $d;
 }
?>
</body></html>  </p>
		</div>

		
		<div style="clear: both;"></div>
	
		
	</div>
	

	<div id="roundedfooter">&nbsp;</div>
	

	<div id="footer">
		<span>LAYOUT &copy; Vsamotoy</span>
	</div>

	
</div>
</body>
</html>