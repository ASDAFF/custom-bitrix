<?
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use
		\Bitrix\Main\Localization\Loc,
		\Bitrix\Main\Loader;

Loc::loadMessages(__FILE__);

if (!Loader::includeModule('iblock'))
	return;

$arThemesList = array(
		"blue"  => Loc::getMessage("OWL2SLIDER_OWL_OPTS_THEME_blue"),
		"bordo" => Loc::getMessage("OWL2SLIDER_OWL_OPTS_THEME_bordo"),
		"grey"  => Loc::getMessage("OWL2SLIDER_OWL_OPTS_THEME_grey"),
		"green" => Loc::getMessage("OWL2SLIDER_OWL_OPTS_THEME_green"),
);

$arTemplateParameters["OWL2SLIDER_OWL_OPTS_THEME"] = array(
		"PARENT"            => "VISUAL",
		"NAME"              => Loc::getMessage("OWL2SLIDER_OWL_OPTS_THEME"),
		"TYPE"              => "LIST",
		"MULTIPLE"          => "N",
		"ADDITIONAL_VALUES" => "Y",
		"DEFAULT"           => "bordo",
		"VALUES"            => $arThemesList,
);