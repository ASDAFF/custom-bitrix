<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

global $APPLICATION;

if($arParams["USE_JQUERY"])
{
	$APPLICATION->AddHeadScript("https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js");
}

$APPLICATION->AddHeadScript($templateFolder."/js/jquery.jcarousel.js");

if($arParams["USE_FANCYBOX"])
{
	$APPLICATION->AddHeadScript($templateFolder."/js/jquery.fancybox.min.js");
	$APPLICATION->AddHeadScript($templateFolder."/js/jquery.initFancybox.js");
	$APPLICATION->SetAdditionalCSS($templateFolder."/css/jquery.fancybox.min.css");
}

if(!empty($arParams["TEMPLATE_THEME"]))
{
	$templateData["TEMPLATE_THEME"] = $templateFolder."/theme/".$arParams["TEMPLATE_THEME"]."/style.css";
	if(!file_exists($templateData["TEMPLATE_THEME"]))
	{
		$APPLICATION->SetAdditionalCSS($templateData["TEMPLATE_THEME"]);
	}
}


?>