<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
/** @var array $arCurrentValues */

if(!CModule::IncludeModule("iblock"))
	return;

$arTypesEx = CIBlockParameters::GetIBlockTypes(array("-"=>" "));

$arIBlocks=array();
$db_iblock = CIBlock::GetList(array("SORT"=>"ASC"), array("SITE_ID"=>$_REQUEST["site"], "TYPE" => ($arCurrentValues["IBLOCK_TYPE"]!="-"?$arCurrentValues["IBLOCK_TYPE"]:"")));
while($arRes = $db_iblock->Fetch())
	$arIBlocks[$arRes["ID"]] = $arRes["NAME"];

$arComponentParameters = array(
	"PARAMETERS" => array(
		"IBLOCK_TYPE" => array(
			"PARENT" => "BASE",
			"NAME" => GetMessage("T_IBLOCK_DESC_LIST_TYPE"),
			"TYPE" => "LIST",
			"VALUES" => $arTypesEx,
			"DEFAULT" => "news",
			"REFRESH" => "Y",
		),
		"IBLOCK_ID" => array(
			"PARENT" => "BASE",
			"NAME" => GetMessage("T_IBLOCK_DESC_LIST_ID"),
			"TYPE" => "LIST",
			"VALUES" => $arIBlocks,
			"REFRESH" => "Y",
		),
		"NEWS_COUNT" => array(
			"PARENT" => "BASE",
			"NAME" => GetMessage("T_IBLOCK_DESC_LIST_CONT"),
			"TYPE" => "STRING",
			"DEFAULT" => "5",
		),
		"HEIGHT_WINDOW" => array(
			"PARENT" => "BASE",
			"NAME" => GetMessage("T_IBLOCK_DESC_LIST_HEIGHT_WINDOW"),
			"TYPE" => "STRING",
			"DEFAULT" => "400",
		),
		"COLOR_TOP" => array(
			"PARENT" => "BASE",
			"NAME" => GetMessage("T_IBLOCK_DESC_LIST_COLOR_TOP"),
			"TYPE" => "STRING",
			"DEFAULT" => "#94B830",
		),
		"SORT" => Array(
			"PARENT" => "BASE",
			"NAME" => GetMessage("T_IBLOCK_DESC_NBRAINS_SORT"),
			"TYPE" => "LIST",
			"DEFAULT" => "DESC",
			"VALUES" => array('ASC' => GetMessage("T_IBLOCK_DESC_NBRAINS_SORT_FIRST"),'DESC' => GetMessage("T_IBLOCK_DESC_NBRAINS_SORT_LAST")),
			"ADDITIONAL_VALUES" => "N",
		),
		"STR_END" => Array(
			"PARENT" => "BASE",
			"NAME" => GetMessage("T_IBLOCK_DESC_NBRAINS_STR_END"),
			"TYPE" => "STRING",
			"DEFAULT" => GetMessage("T_IBLOCK_DESC_NBRAINS_STR_END_VALUE"),
		),
		"PRE_LOAD" => Array(
			"PARENT" => "BASE",
			"NAME" => GetMessage("T_IBLOCK_DESC_NBRAINS_PRE_LOAD"),
			"TYPE" => "STRING",
			"DEFAULT" => "150",
		),
		"ACTIVE_DATE_FORMAT" => CIBlockParameters::GetDateFormat(GetMessage("T_IBLOCK_DESC_ACTIVE_DATE_FORMAT"), "ADDITIONAL_SETTINGS"),
	),
);


