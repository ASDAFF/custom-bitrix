<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use    \Bitrix\Main\Page\Asset;

$Asset = Asset::getInstance();

/*********************CSS****************************/
if (isset($arParams['OWL2SLIDER_OWL_OPTS_THEME']) && !empty($arParams['OWL2SLIDER_OWL_OPTS_THEME']))
	$Asset->addCss($templateFolder . '/css/owl.theme.' . $arParams['OWL2SLIDER_OWL_OPTS_THEME'] . '.css', true);
