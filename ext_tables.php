<?php

$_EXTCONF = unserialize($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['sm_hints']);

if (class_exists('t3lib_div')) {
	// no need for a namespaced variant of this call because ::loadTCA is obsolete in newer version of TYPO3
	/** @noinspection PhpUndefinedClassInspection */
	t3lib_div::loadTCA('tt_content');
}

if (!function_exists('array_insert_at_position')) {
	/**
	 * @param array $array
	 * @param int $position
	 * @param mixed $insert
	 * @return array
	 */
	function array_insert_at_position($array, $position, $insert) {
		if (!is_array($insert)) {
			$insert = (array) $insert;
		}
		return array_merge(array_slice($array, 0, $position), $insert, array_slice($array, $position));
	}
}

if (!function_exists('get_dividers_positions')) {
	function get_dividers_positions($itemsArray) {
		$dividersPositions = array();
		foreach ($itemsArray as $index => $item) {
			if ($item[1] === '--div--') {
				$dividersPositions[] = $index;
			}
		}
		return $dividersPositions;
	}
}

// determine extension's resource path
if (class_exists('t3lib_extMgm')) {
	/** @noinspection PhpUndefinedClassInspection */
	$resourcesPath = t3lib_extMgm::extRelPath('sm_hints') . 'Resources/Public/';
} else {
	/** @noinspection PhpUndefinedClassInspection */
	/** @noinspection PhpUndefinedNamespaceInspection */
	$resourcesPath = \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath('sm_hints') . 'Resources/Public/';
}


// Use bodytext as label for SM-Hints items. Otherwise try header first.
if(!function_exists('tx_smhints_content_label')) {
	function tx_smhints_content_label(&$parameters, $pObj) {
		if($parameters['row']['CType'] == 'tx_smhints_hint') {
			$parameters['title'] = $parameters['row']['bodytext'];
			return;
		}

		$parameters['title'] = $parameters['row']['header'] ?: $parameters['row']['bodytext'] ;
	}
}

$GLOBALS['TCA']['tt_content']['ctrl']['label_userFunc'] = 'tx_smhints_content_label';




// insert CE type "hint"
$dividersPositions = get_dividers_positions($GLOBALS['TCA']['tt_content']['columns']['CType']['config']['items']);
$position = intval($dividersPositions[1]); // before the 2nd divider
$insertItems = array(
	array(
		'LLL:EXT:sm_hints/Resources/Private/Language/locallang_db.xml:tt_content.CType.tx_smhints_hint',
		'tx_smhints_hint',
		$resourcesPath . 'Icons/ttcontent_hint.gif',
	),
);
$GLOBALS['TCA']['tt_content']['columns']['CType']['config']['items'] = array_insert_at_position($GLOBALS['TCA']['tt_content']['columns']['CType']['config']['items'], $position, $insertItems);

// insert CE type "hinttype"
$dividersPositions = get_dividers_positions($GLOBALS['TCA']['tt_content']['columns']['CType']['config']['items']);
$position = intval($dividersPositions[3]) + 1; // after the 4th divider
$insertItems = array(
	array(
		'LLL:EXT:sm_hints/Resources/Private/Language/locallang_db.xml:tt_content.CType.tx_smhints_hinttype',
		'tx_smhints_hinttype',
		$resourcesPath . 'Icons/ttcontent_hinttype.gif',
	),
);
$GLOBALS['TCA']['tt_content']['columns']['CType']['config']['items'] = array_insert_at_position($GLOBALS['TCA']['tt_content']['columns']['CType']['config']['items'], $position, $insertItems);

// Backend appearance of "hint"
$GLOBALS['TCA']['tt_content']['columns']['tx_smhints_hinttype'] = array(
	'exclude' => 1,
	'label' => 'LLL:EXT:sm_hints/Resources/Private/Language/locallang_db.xml:tt_content.tx_smhints_hinttype',
	'config' => array(
		'type' => 'select',
		'items' => array(),
		'foreign_table' => 'tt_content',
		'foreign_table_where' => ' AND tt_content.CType = "tx_smhints_hinttype" AND tt_content.hidden = 0 AND tt_content.pid = ' . intval($_EXTCONF['hintSysFolder']) . ' ORDER BY tt_content.header',
	),
);
$GLOBALS['TCA']['tt_content']['types']['tx_smhints_hint'] = array(
	'showitem' => '
		CType,
		hidden,
		tx_smhints_hinttype,
		bodytext;Text;;richtext:rte_transform[flag=rte_enabled|mode=ts_css],
	'
);

// Backend appearance of "hinttype"
$GLOBALS['TCA']['tt_content']['columns']['tx_smhints_icon'] = array(
	'exclude' => 1,
	'label' => 'LLL:EXT:sm_hints/Resources/Private/Language/locallang_db.xml:tt_content.tx_smhints_icon',
	'config' => array(
		'type' => 'group',
		'internal_type' => 'file',
		'allowed' => $GLOBALS['TYPO3_CONF_VARS']['GFX']['imagefile_ext'],
		'max_size' => $GLOBALS['TYPO3_CONF_VARS']['BE']['maxFileSize'],
		'uploadfolder' => 'uploads/pics',
		'show_thumbs' => '1',
		'size' => '1',
		'maxitems' => '1',
		'minitems' => '0',
	),
);
$GLOBALS['TCA']['tt_content']['types']['tx_smhints_hinttype'] = array(
	'showitem' => '
		CType,
		hidden,
		header;LLL:EXT:sm_hints/Resources/Private/Language/locallang_db.xml:tt_content.CType.tx_smhints_hinttype.header,
		tx_smhints_icon,
		altText;LLL:EXT:sm_hints/Resources/Private/Language/locallang_db.xml:tt_content.CType.tx_smhints_hinttype.altText,
		titleText;LLL:EXT:sm_hints/Resources/Private/Language/locallang_db.xml:tt_content.CType.tx_smhints_hinttype.titleText
	'
);

/**
 * Icons
 */
$icons = array(
	'tx_smhints_hint' => $resourcesPath . 'Icons/ttcontent_hint.gif',
	'tx_smhints_hinttype' => $resourcesPath . 'Icons/ttcontent_hinttype.gif',
);
if (class_exists('t3lib_SpriteManager')) {
	/** @noinspection PhpUndefinedClassInspection */
	t3lib_SpriteManager::addSingleIcons($icons, 'sm_hints');
} else {
	/** @noinspection PhpUndefinedClassInspection */
	/** @noinspection PhpUndefinedNamespaceInspection */
	\TYPO3\CMS\Backend\Sprite\SpriteManager::addSingleIcons($icons, 'sm_hints');
}
$GLOBALS['TCA']['tt_content']['ctrl']['typeicon_classes']['tx_smhints_hint'] = 'extensions-sm_hints-tx_smhints_hint';
$GLOBALS['TCA']['tt_content']['ctrl']['typeicon_classes']['tx_smhints_hinttype'] = 'extensions-sm_hints-tx_smhints_hinttype';

/**
 * Typoscript
 */
if (class_exists('t3lib_extMgm')) {
	/** @noinspection PhpUndefinedClassInspection */
	t3lib_extMgm::addStaticFile('sm_hints', 'Configuration/Typoscript/', 'Hints');
} else {
	/** @noinspection PhpUndefinedClassInspection */
	/** @noinspection PhpUndefinedNamespaceInspection */
	\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile('sm_hints', 'Configuration/Typoscript/', 'Hints');
}

?>