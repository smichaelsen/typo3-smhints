<?php

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




// insert CE type "hint"
$dividersPositions = get_dividers_positions($GLOBALS['TCA']['tt_content']['columns']['CType']['config']['items']);
$position = intval($dividersPositions[1]); // before the 2nd divider
$insertItems = array(
	array(
		'Hinweis',
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
		'Hinweistyp',
		'tx_smhints_hinttype',
		$resourcesPath . 'Icons/ttcontent_hinttype.gif',
	),
);
$GLOBALS['TCA']['tt_content']['columns']['CType']['config']['items'] = array_insert_at_position($GLOBALS['TCA']['tt_content']['columns']['CType']['config']['items'], $position, $insertItems);

?>