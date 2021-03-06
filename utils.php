<?php

require_once(dirname(__FILE__) . '/fingerprint.php');
require_once(dirname(__FILE__) . '/lcs.php');

//----------------------------------------------------------------------------------------
function compare_two_strings($str1, $str2)
{
	$score = 0;

	// check
	$v1 = finger_print($str1);
	$v2 = finger_print($str2);	
	
	if (($v1 != '') && ($v2 != ''))
	{
		//echo "v1: $v1\n";
		//echo "v2: $v2\n";
		
		$lcs = new LongestCommonSequence($v1, $v2);
		$d = $lcs->score();
		
		//echo $d;
		
		$score = min($d / strlen($v1), $d / strlen($v2));
		
		//$score = $d / strlen($v1);
		
		//echo "score=$score\n";
	}
	
	return $score;
}


$stopwords = array(
'a', 'and', 'in', 'the', 'of',
'de', 'y',
'-'
);

//----------------------------------------------------------------------------------------
function optimizeSearchString($searchString) {
	global $stopwords;
    $wordsFromSearchString = preg_split('/,?\s+/u', $searchString);
    $finalWords = array_diff($wordsFromSearchString, $stopwords);
    return $finalWords;
}

/*
$str1 = 'Herbario Gaspar Xuárez Universidad de Buenos Aires (BAA)';
$str2 = 'Herbario Gaspar Xuárez';

$str1 = 'Museo Botánico, Facultad de Ciencias Exactas, Físicas y Naturales, Universidad Nacional de Córdoba (CORD)';
$str2 = 'Herbario CORD, Museo Botánico Córdoba, Instituto Multidisciplinario de Biología Vegetal - CCT-Córdoba-CONICET, Córdoba, Córdoba, Argentina';


$parts1 = optimizeSearchString($str1);
$parts2 = optimizeSearchString($str2);

//$parts1 = preg_split('/,?\s+/u', $s);

sort($parts1);
sort($parts2);

print_r($parts1);
print_r($parts2);

$c1 = array();

foreach ($parts1 as $p)
{
	$c1[] = finger_print($p);
}

$c2 = array();

foreach ($parts2 as $p)
{
	$c2[] = finger_print($p);
}

print_r($c1);
print_r($c2);

$intersect = array_intersect($c1, $c2);

print_r($intersect);

*/
?>

