<?
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use
		\Bitrix\Main\Localization\Loc,
		\Bitrix\Main\Loader;

Loc::loadMessages(__FILE__);

if (!Loader::includeModule('iblock'))
	return;

$arThemesList = array(
		"default" => Loc::getMessage("OWL2SLIDER_OWL_OPTS_DESIGN_default"),
		"rect"    => Loc::getMessage("OWL2SLIDER_OWL_OPTS_DESIGN_rect"),
		"round"   => Loc::getMessage("OWL2SLIDER_OWL_OPTS_DESIGN_round")
);

$arStylesList = array(
		"blue"      => Loc::getMessage("OWL2SLIDER_OWL_OPTS_COLOR"),
		"ash"        => Loc::getMessage("OWL2SLIDER_OWL_OPTS_COLOR_ash"),
		"orange"     => Loc::getMessage("OWL2SLIDER_OWL_OPTS_COLOR_orange"),
		"bilberry"   => Loc::getMessage("OWL2SLIDER_OWL_OPTS_COLOR_bilberry"),
		"strawberry" => Loc::getMessage("OWL2SLIDER_OWL_OPTS_COLOR_strawberry"),
		"blackberry" => Loc::getMessage("OWL2SLIDER_OWL_OPTS_COLOR_blackberry"),
);

$arTemplateParameters["OWL2SLIDER_OWL_OPTS_DESIGN"] = array(
		"PARENT"            => "VISUAL",
		"NAME"              => Loc::getMessage("OWL2SLIDER_OWL_OPTS_DESIGN"),
		"TYPE"              => "LIST",
		"MULTIPLE"          => "N",
		"ADDITIONAL_VALUES" => "Y",
		"DEFAULT"           => "default",
		"VALUES"            => $arThemesList,
);

$arTemplateParameters["OWL2SLIDER_OWL_OPTS_COLOR"] = array(
		"PARENT"            => "VISUAL",
		"NAME"              => Loc::getMessage("OWL2SLIDER_OWL_OPTS_COLOR"),
		"TYPE"              => "LIST",
		"MULTIPLE"          => "N",
		"ADDITIONAL_VALUES" => "Y",
		"DEFAULT"           => "blue",
		"VALUES"            => $arStylesList,
);

