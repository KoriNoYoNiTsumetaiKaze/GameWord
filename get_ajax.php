<?php
header("Content-type: text/plain; charset=utf-8");
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);

$playerWord	= $_POST['PlayerWord'];

include_once "WordVerification.php";

$errtxt='';
if (!WV_Contor($playerWord,$errtxt))
	{
		echo $errtxt;
		die();
	}

echo $playerWord;

/*session_start();

$PlayerWord	= strtolower($PlayerWord);

function WordVerification($PlayerWord)
{
	$AllowedCharacters	= "йцукенгшщзхъфывапролджэячсмитьбю";
	$AllowedPlayerWord	= "";
	for ($i=0;$i<strlen($PlayerWord);$i++)
	{
		$litter	= substr($PlayerWord, $i, 1);
		if !strpos($AllowedCharacters,$litter) $AllowedPlayerWord	= $AllowedPlayerWord.$litter;
	}
	$PlayerWord	= $AllowedPlayerWord;
	
	if (strlen($PlayerWord)>3) $make	= true
	else $make	= false;
	
	if (!$make) echo "Слово слишком короткое!";
	
	$vowels ="йуеъыаоэяиью";
	$j	= 0;
	for ($i=0;$i<strlen($PlayerWord);$i++)
	{
		$litter	= substr($PlayerWord, $i, 1);
		if !strpos($vowels,$litter) $j++;
	}
	if ($j==strlen($PlayerWord)) $make	= false;
	
	if (!$make) echo "Слово из одних гласных? Что это за язык? Я такого не знаю!";
	
	$vowels ="цкнгшщзхфвпрлджчсмтб";
	$j	= 0;
	for ($i=0;$i<strlen($PlayerWord);$i++)
	{
		$litter	= substr($PlayerWord, $i, 1);
		if !strpos($vowels,$litter) $j++;
	}
	if ($j==strlen($PlayerWord)) $make	= false;
	
	if (!$make) echo "Слово из одних согласных? Что это за язык? Я такого не знаю!";
	
	$pattern = '[йуеъыаоэяиью]{3}';
	if (preg_match($pattern, $PlayerWord)) $make	= false;
	
	if (!$make) echo "Три гласных подряд? Что это за язык? Я такого не знаю!";
	
	$pattern = '[цкнгшщзхфвпрлджчсмтб]{3}';
	if (preg_match($pattern, $PlayerWord)) $make	= false;
	
	if (!$make) echo "Три согласных подряд? Что это за язык? Я такого не знаю!";	
}

function CompWord($make=false)
{
	if (!$make)
	{
		echo "Эй! Это слово не подходит!";
		return;
	}
	
	if (!isset($_SESSION['UseWord'])) $_SESSION['UseWord']	= array();
	
	$lostlitter	= substr(trim($PlayerWord), -1, 1);
	if ($lostlitter=="ь") $lostlitter	= substr(trim($PlayerWord), -2, 1);
	
	$host	= 'localhost'; // имя хоста (уточняется у провайдера)
	$database	= 'bd_PlayerWord'; // имя базы данных, которую вы должны создать
	$user	= 'root'; // заданное вами имя пользователя, либо определенное провайдером
	$pswd	= 'admin'; // заданный вами пароль
	
	$dbh = mysql_connect($host, $user, $pswd);
	mysql_select_db($database);
	mysql_query("SET character_set_client='utf-8'");
	
	$query = "SELECT word FROM `Words` WHERE litter='$lostlitter'";
	$res = mysql_query($query);
	if(mysql_num_rows($res) == 0)
	{
		echo "Компьютер: АААААААААа!!! Я не знаю!!!"
	}
	else
	{
		$row	= mysql_fetch_array($res);
		foreach ($res as $key => $value)
		{
			if (!in_array($PlayerWord, $_SESSION['UseWord'])) echo "Компьютер: ".$value;
		}
	}
	
	$_SESSION['UseWord'][]	= $PlayerWord;
	
	$query = "SELECT word FROM `Words` WHERE word='$PlayerWord' LIMIT 1";
	
	$res = mysql_query($query);
	if(mysql_num_rows($res) == 0)
	{
		$firestlitter	= substr(trim($PlayerWord), 0, 1);
		$result = mysql_query("INSERT INTO Words (litter, word) VALUES ('$firestlitter', '$PlayerWord')");
	}
	
	mysql_close($dbh);
}

$make	= WordVerification($PlayerWord);
CompWord($make);
*/
?>
