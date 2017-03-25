<?//some final manipulations ?>

<?
if ($arResult['ITEMS']){
    $currentTime = time();
	foreach($arResult['ITEMS'] as $key => $item){    
        // ADVERT Items:
        if ($arParams['SOURCE_TYPE']=='advert') {
            if ($item['DATE_SHOW_FROM'] != '') {
                if (strtotime($item['DATE_SHOW_FROM']) > $currentTime) {
                    unset($arResult['ITEMS'][$key]);
                    continue;
                }
            } elseif ($item['DATE_SHOW_TO'] != '') {
                if (strtotime($item['DATE_SHOW_TO']) <= $currentTime) {
                    unset($arResult['ITEMS'][$key]);
                    continue;
                }
            }

            $arResult['ITEMS'][$key]['ITEM_URL'] = $item['URL'];
            $arResult['ITEMS'][$key]['ITEM_TEXT'] = ($item['IMAGE_ALT'] != '') ? $item['IMAGE_ALT'] : $item['NAME'];
        }
	}
}
?>

