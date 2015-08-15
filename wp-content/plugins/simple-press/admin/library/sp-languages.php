<?php
/*
Simple:Press
Desc: Supported Languages (from Glotpress)
$LastChangedDate: 2014-05-24 09:12:47 +0100 (Sat, 24 May 2014) $
$Rev: 11461 $
*/

if (preg_match('#'.basename(__FILE__).'#', $_SERVER['PHP_SELF'])) die('Access denied - you cannot directly call this file');

# --------------------------------------
# Array of supported languages from
# GlotPress site - used for upgrades
# and install
# ---------------------------------------

$langSets = array(
	'af' => 'Afrikaans',
	'ar' => 'Arabic',
	'hy' => 'Armenian',
	'az' => 'Azerbaijani',
	'be' => 'Belarusian',
	'bn' => 'Bengali',
	'bs' => 'Bosnian',
	'bg' => 'Bulgarian',
	'ca' => 'Catalan',
	'bal' => 'Catalan (Balear)',
	'zh-cn' => 'Chinese (China)',
	'zh-tw' => 'Chinese (Taiwan)',
	'hr' => 'Croatian',
	'cs' => 'Czech',
	'da' => 'Danish',
	'nl' => 'Dutch',
	'et' => 'Estonian',
	'fo' => 'Faroese',
	'fi' => 'Finnish',
	'fr-ca' => 'French (Canada)',
	'fr' => 'French (France)',
	'ka' => 'Georgian',
	'de' => 'German',
	'el' => 'Greek',
	'gu' => 'Gujarati',
	'he' => 'Hebrew',
	'hi' => 'Hindi',
	'hu' => 'Hungarian',
	'is' => 'Icelandic',
	'id' => 'Indonesian',
	'it' => 'Italian',
	'ja' => 'Japanese',
	'ko' => 'Korean',
	'la' => 'Latin',
	'lv' => 'Latvian',
	'lt' => 'Lithuanian',
	'mk' => 'Macedonian',
	'no' => 'Norwegian',
	'nb' => 'Norwegian (Bokmål)',
	'fa' => 'Persian',
	'pl' => 'Polish',
	'pt-br' => 'Portuguese (Brazil)',
	'pt' => 'Portuguese (Portugal)',
	'ro' => 'Romanian',
	'ru' => 'Russian',
	'sr' => 'Serbian',
	'sk' => 'Slovak',
	'sl' => 'Slovenian',
	'es' => 'Spanish (Spain)',
	'sv' => 'Swedish',
	'tl' => 'Tagalog',
	'ta-lk' => 'Tamil (Sri Lanka)',
	'th' => 'Thai',
	'tr' => 'Turkish',
	'uk' => 'Ukrainian',
	'uz' => 'Uzbek',
	'vi' => 'Vietnamese'
);

?>