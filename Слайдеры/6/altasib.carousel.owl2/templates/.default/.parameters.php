<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arTemplateParameters = array(	
	"DISPLAY_NAME" => Array(
		"NAME" => GetMessage("DISPLAY_NAME_NAME"),
		"TYPE" => "CHECKBOX",
		"DEFAULT" => "Y",
	),
	"DISPLAY_PREVIEW_TEXT" => Array(
		"NAME" => GetMessage("DISPLAY_PREVIEW_TEXT_NAME"),
		"TYPE" => "CHECKBOX",
		"DEFAULT" => "N",
	),
	"DISPLAY_DETAIL_PICTURE" => Array(
		"NAME" => GetMessage("DISPLAY_DETAIL_PICTURE_NAME"),
		"TYPE" => "CHECKBOX",
		"DEFAULT" => "Y",
	),
	"DISPLAY_VIDEO" => Array(
		"NAME" => GetMessage("DISPLAY_VIDEO_NAME"),
		"TYPE" => "CHECKBOX",
		"DEFAULT" => "N",
	),
);
?>