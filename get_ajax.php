<?php
header("Content-type: text/plain; charset=utf-8");
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);

session_start();

$PlayerWord	= $_POST['PlayerWord'];
$PlayerWord	= strtolower($PlayerWord);

function WordVerification($PlayerWord)
{
	$AllowedCharacters	= "qwertyuiopasdfghjklzxcvbnmйцукенгшщзхъфывапролджэячсмитьбю";
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
	
	$vowels ="qeyuioajйуеъыаоэяиью";
	$j	= 0;
	for ($i=0;$i<strlen($PlayerWord);$i++)
	{
		$litter	= substr($PlayerWord, $i, 1);
		if !strpos($vowels,$litter) $j++;
	}
	if ($j==strlen($PlayerWord)) $make	= false;
	
	if (!$make) echo "Слово из одних гласных? Что это за язык? Я такого не знаю!";
	
	$vowels ="wrtpsdfghklzxcvbnmцкнгшщзхфвпрлджчсмтб";
	$j	= 0;
	for ($i=0;$i<strlen($PlayerWord);$i++)
	{
		$litter	= substr($PlayerWord, $i, 1);
		if !strpos($vowels,$litter) $j++;
	}
	if ($j==strlen($PlayerWord)) $make	= false;
	
	if (!$make) echo "Слово из одних согласных? Что это за язык? Я такого не знаю!";
	
	$pattern = '[qeyuioajйуеъыаоэяиью]{3}';
	if (preg_match($pattern, $PlayerWord)) $make	= false;
	
	if (!$make) echo "Три гласных подряд? Что это за язык? Я такого не знаю!";
	
	$pattern = '[wrtpsdfghklzxcvbnmцкнгшщзхфвпрлджчсмтб]{3}';
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

?>
