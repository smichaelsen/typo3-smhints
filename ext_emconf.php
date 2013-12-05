<?php

##############################################################
# Extension Manager/Repository config file for ext "sm_hints".
##############################################################

$EM_CONF['sm_hints'] = array(
	'title' => 'Hints',
	'description' => 'Hinweis-Inhaltselemente',
	'category' => 'frontend',
	'author' => 'Sebastian Michaelsen',
	'author_email' => 'sebastian@app-zap.de',
	'state' => 'stable',
	'clearCacheOnLoad' => 1,
	'version' => '0.1.0',
	'constraints' => array(
		'depends' => array(
			'typo3' => '4.5.0-6.2.99',
			'fluid' => '',
		),
	),
);

?>
