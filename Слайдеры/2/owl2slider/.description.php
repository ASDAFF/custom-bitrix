<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
use
		\Bitrix\Main\Localization\Loc;
Loc::loadMessages(__FILE__);

$arComponentDescription = array(
		"NAME" => Loc::getMessage('OWL2SLIDER_NAME'),
		"DESCRIPTION" => Loc::getMessage('OWL2SLIDER_DESCRIPTION'),
		"ICON" => "/images/icon_32.png",
		"CACHE_PATH" => "Y",
		"SORT" => 20,
		"PATH" => array(
				"ID" => "custom",
				"CHILD" => array(
						"ID" => "OWL2SLIDER",
						"NAME" => Loc::getMessage('OWL2SLIDER_MENU_NAME')
				)
		),
);
?>