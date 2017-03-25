<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use    \Bitrix\Main\Page\Asset;

$Asset = Asset::getInstance();

/*********************CSS****************************/
$Asset->addCss($templateFolder . "/css/owl-themes.min.css", true);
/*********************JS****************************/


