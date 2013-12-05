<?php

##############################################################
# Extension Manager/Repository config file for ext "sm_hints".
##############################################################

$EM_CONF['sm_hints'] = array(
	'title' => 'Hints',
	'description' => 'Adds a new content element "hint", which basically provides an info box containing a symbol and some text. Symbol sets are fully configurable in the backend. The is extension is developed for and used in production by Stiftung Mitarbeit, Bonn, Germany.',
	'category' => 'fe',
	'author' => 'Sebastian Michaelsen',
	'author_email' => 'sebastian@app-zap.de',
	'state' => 'stable',
	'clearCacheOnLoad' => 1,
	'version' => '0.1.3',
	'constraints' => array(
		'depends' => array(
			'typo3' => '4.5.0-6.2.99',
			'fluid' => '',
		),
	),
);

?>
