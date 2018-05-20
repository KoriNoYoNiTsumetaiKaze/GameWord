<?php
function WV_ContorRuLitter($inWord,&$txt='')
	{
		$allowedCharacters = "йцукенгшщзхъфывапролджэячсмитьбю";
		for ($i=0;$i<mb_strlen($inWord);$i++)
			{
				$litter = mb_substr($inWord, $i, 1);
				if (!(mb_strpos($allowedCharacters,$litter)))
					{
						$txt = 'В слове присутвуют не допустимые символы! Разрешена лишь кирилица';
						return false;
					}
			}
		return true;
	}

function WV_ContorVowels($inWord,&$txt='')
	{
		$vowels = "уеъыаоэяиью";
		$k = 0;
		$lenWord = mb_strlen($inWord);
		for ($i=0;$i<$lenWord;$i++)
			{
				$litter = mb_substr($inWord, $i, 1);
				if (mb_strpos($vowels,$litter))
					{
						$k++;
					}
			}
		if ($lenWord==$k)
			{
				$txt = 'Слово не может быть из одних гласных';
				return false;
			}
		return true;
	}

function WV_ContorConsonantLetter($inWord,&$txt='')
	{
		$consonantLetter = "цкнгшщзхфвпрлджчсмтб";
		$k = 0;
		$lenWord = mb_strlen($inWord);
		for ($i=0;$i<$lenWord;$i++)
			{
				$litter = mb_substr($inWord, $i, 1);
				if (mb_strpos($consonantLetter,$litter))
					{
						$k++;
					}
			}
		if ($lenWord==$k)
			{
				$txt = 'Слово не может быть из одних согласных';
				return false;
			}
		return true;
	}

function WV_Contor($inWord,&$txt='')
	{
		$inWord = mb_strtolower($inWord);
		$inWord = trim($inWord);
		if (mb_strlen($inWord)<3)
			{
				$txt = 'Слово не может быть короче 3 символов';
				return false;
			}
		$pattern = '/[йуеъыаоэяиью]{3}/';
		echo preg_match_all('/[йуеъыаоэяиью][йуеъыаоэяиью][йуеъыаоэяиью]/',$inWord,$matches);
		print_r($matches);
		if (preg_match($pattern, $inWord))
			{
				$txt = 'В слове не может быть 3 подряд гласных';
				return false;
			}
		$pattern = '/[цкнгшщзхфвпрлджчсмтб]{3}/';
		if (preg_match($pattern, $inWord))
			{
				$txt = 'В слове не может быть 3 подряд согласных';
				return false;
			}
		if (!WV_ContorRuLitter($inWord,$txt))
			{
				return false;
			}
		if (!WV_ContorVowels($inWord,$txt))
			{
				return false;
			}
		if (!WV_ContorConsonantLetter($inWord,$txt))
			{
				return false;
			}
		return true;
	}
?>
