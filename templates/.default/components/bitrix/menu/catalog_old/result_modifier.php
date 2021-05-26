<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
if(!function_exists('OutputMenuLI')) {
	function OutputMenuLI($items, $level = 0, $parent = false) {
		static $levelClass = array('type-product', 'firm-product', 'alezi-list');

		$levelCount = 0;

		if (count($items) == 0) return true;

		echo '<ul class="' , $levelClass[$level] , '">';
		foreach ($items as $item) {
			if ($level == 0 && $item['DEPTH_LEVEL'] != 1) continue;

			$levelCount += 1;
			if ($level > 0 && $levelCount == 20 && count($items > 20)) {
				echo '<li>';
					echo '<a href="' , $parent['LINK'] , '">Все категории...</a>';
				echo '</li>';

				break;
			}

			$clss = ($item['SELECTED'] == 'Y') ? ' class="active is-ul"' : '';

			echo '<li' , $clss , '>';
			if (count($item['CHILD']) > 0) {
				echo '<a href="' , $item['LINK'] , '"' , $clss , ' data-haschild="1">' , $item['TEXT'] , '</a>';
			} else {
				echo '<a href="' , $item['LINK'] , '"' , $clss , '>' , $item['TEXT'] , '</a>';
			}

			$function = __FUNCTION__;
			$function($item['CHILD'], $level + 1, $item);
	
			echo '</li>';
		}
		echo '</ul>';
	}
}
$level = array();
foreach ($arResult as $k => &$item) {
	$level[$item['DEPTH_LEVEL']] = $k;
	$item['CHILD'] = array();

	if ($item['DEPTH_LEVEL'] > 1) {
		$arResult[$level[$item['DEPTH_LEVEL'] - 1]]['CHILD'][] = &$arResult[$k];
	}
}
unset ($item);
?>