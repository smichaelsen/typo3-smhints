<?php

/***************************************************************
 * Extension Manager/Repository config file for ext "sm_hints".
 *
 * Auto generated 09-12-2013 12:24
 *
 * Manual updates:
 * Only the data in the array - everything else is removed by next
 * writing. "version" and "dependencies" must not be touched!
 ***************************************************************/

$EM_CONF[$_EXTKEY] = array(
	'title' => 'Hints',
	'description' => 'Adds a new content element "hint", which basically provides an info box containing a symbol and some text. Symbol sets are fully configurable in the backend. The is extension is developed for and used in production by Stiftung Mitarbeit, Bonn, Germany.',
	'category' => 'fe',
	'author' => 'Sebastian Michaelsen',
	'author_email' => 'sebastian@app-zap.de',
	'state' => 'stable',
	'clearCacheOnLoad' => 1,
	'version' => '0.2.0',
	'constraints' => array(
		'depends' => array(
			'typo3' => '4.5.0-6.2.99',
			'fluid' => '',
		),
		'conflicts' => array(
		),
		'suggests' => array(
		),
	),
	'_md5_values_when_last_written' => 'a:11:{s:21:"ext_conf_template.txt";s:4:"c4e0";s:12:"ext_icon.gif";s:4:"7b3d";s:14:"ext_tables.php";s:4:"0a7c";s:14:"ext_tables.sql";s:4:"6c5b";s:9:"README.md";s:4:"7a48";s:38:"Configuration/Typoscript/constants.txt";s:4:"f9fe";s:34:"Configuration/Typoscript/setup.txt";s:4:"5ed8";s:43:"Resources/Private/Language/locallang_db.xml";s:4:"0e1a";s:37:"Resources/Private/Templates/Hint.html";s:4:"f766";s:41:"Resources/Public/Icons/ttcontent_hint.gif";s:4:"7b3d";s:45:"Resources/Public/Icons/ttcontent_hinttype.gif";s:4:"411c";}',
);

?>