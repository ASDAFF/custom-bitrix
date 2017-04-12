<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

if(!CModule::IncludeModule("iblock"))
	return;
	
if(!CModule::IncludeModule('orion.animatedimageslider')) 
	return;	

$arIBlockType = CIBlockParameters::GetIBlockTypes();

$arIBlock = array();
$rsIBlock = CIBlock::GetList(Array("sort" => "asc"), Array("TYPE" => $arCurrentValues["IBLOCK_TYPE"], "ACTIVE"=>"Y"));
while($arr=$rsIBlock->Fetch())
	$arIBlock[$arr["ID"]] = "[".$arr["ID"]."] ".$arr["NAME"];

$arProperty_LNS = array();
$arProperty_N = array();
$arProperty_X = array();

$arPropertyImg['PREVIEW_PICTURE'] = '[PREVIEW_PICTURE] '.GetMessage('CP_AIS_PREVIEW_PICTURE');
$arPropertyImg['DETAIL_PICTURE'] = '[DETAIL_PICTURE] '.GetMessage('CP_AIS_DETAIL_PICTURE');

$arPropertyImgDesc['PREVIEW_TEXT'] = '[PREVIEW_TEXT] '.GetMessage('CP_AIS_PREVIEW_TEXT');
$arPropertyImgDesc['DETAIL_TEXT'] = '[DETAIL_TEXT] '.GetMessage('CP_AIS_DETAIL_TEXT');

$arPropertyImgHref['DETAIL_URL'] = '[DETAIL_URL] '.GetMessage('CP_AIS_DETAIL_URL');

if (0 < intval($arCurrentValues['IBLOCK_ID']))
{
	$rsProp = CIBlockProperty::GetList(Array("sort"=>"asc", "name"=>"asc"), Array("IBLOCK_ID"=>$arCurrentValues["IBLOCK_ID"], "ACTIVE"=>"Y"));
	while ($arr=$rsProp->Fetch())
	{
		if($arr["MULTIPLE"] != "Y"){
			if($arr["PROPERTY_TYPE"] == "F"){
				$arPropertyImg[$arr["CODE"]] = "[".$arr["CODE"]."] ".$arr["NAME"];
			}	
			
			if($arr["PROPERTY_TYPE"] == 'S'){
				$arPropertyImgHref[$arr["CODE"]] = "[".$arr["CODE"]."] ".$arr["NAME"];
			}	
				
			if($arr["PROPERTY_TYPE"] == 'S' || $arr["PROPERTY_TYPE"] == 'T'){
				$arPropertyImgDesc[$arr["CODE"]] = "[".$arr["CODE"]."] ".$arr["NAME"];
			}	
		}
		
		if($arr["PROPERTY_TYPE"] != "F")
			$arProperty[$arr["CODE"]] = "[".$arr["CODE"]."] ".$arr["NAME"];
	}
}

$arProperty_UF = array();
$arSProperty_LNS = array();
$arUserFields = $GLOBALS["USER_FIELD_MANAGER"]->GetUserFields("IBLOCK_".$arCurrentValues["IBLOCK_ID"]."_SECTION");
foreach($arUserFields as $FIELD_NAME=>$arUserField)
{
	$arProperty_UF[$FIELD_NAME] = $arUserField["LIST_COLUMN_LABEL"]? $arUserField["LIST_COLUMN_LABEL"]: $FIELD_NAME;
	if($arUserField["USER_TYPE"]["BASE_TYPE"]=="string")
		$arSProperty_LNS[$FIELD_NAME] = $arProperty_UF[$FIELD_NAME];
}

$arAscDesc = array(
	"asc" => GetMessage("IBLOCK_SORT_ASC"),
	"desc" => GetMessage("IBLOCK_SORT_DESC"),
);

$arComponentParameters = array(
	"GROUPS" => array(
		'RESIZE_IMG' => array(
			"NAME" => GetMessage("CP_AIS_RESIZE_IMG"),
		),
		'ANIMATION' => array(
			"NAME" => GetMessage("CP_AIS_ANIMATION"),
		),
		'CONTROL_BLOCK' => array(
			"NAME" => GetMessage("CP_AIS_CONTROL_BLOCK"),
		),
		/*'FOCUS_BLOCK' => array(
			"NAME" => GetMessage("CP_AIS_FOCUS_BLOCK"),
		),*/
		'PLAY_PAUSE_CONTROL_BLOCK' => array(
			"NAME" => GetMessage("CP_AIS_PLAY_PAUSE_CONTROL_BLOCK"),
		),
		'NAVIGATION_BLOCK' => array(
			"NAME" => GetMessage("CP_AIS_NAVIGATION_BLOCK"),
		),
		'DESC_BLOCK' => array(
			"NAME" => GetMessage("CP_AIS_DESC_BLOCK"),
		),
		'JS_EVENT_BLOCK' => array(
			"NAME" => GetMessage("CP_AIS_JS_EVENT_BLOCK"),
		),
		"JQUERY" => array(
			"NAME" => GetMessage("CP_AIS_APPLY_JQUERY"),
			"SORT" => "3000",
		),		
	),
	"PARAMETERS" => array(
		//"AJAX_MODE" => array(),
		"IBLOCK_TYPE" => array(
			"PARENT" => "BASE",
			"NAME" => GetMessage("IBLOCK_TYPE"),
			"TYPE" => "LIST",
			"VALUES" => $arIBlockType,
			"REFRESH" => "Y",
		),
		"IBLOCK_ID" => array(
			"PARENT" => "BASE",
			"NAME" => GetMessage("IBLOCK_IBLOCK"),
			"TYPE" => "LIST",
			"ADDITIONAL_VALUES" => "Y",
			"VALUES" => $arIBlock,
			"REFRESH" => "Y",
		),
		"SECTION_ID" => array(
			"PARENT" => "BASE",
			"NAME" => GetMessage("IBLOCK_SECTION_ID"),
			"TYPE" => "STRING",
			"DEFAULT" => '={$_REQUEST["SECTION_ID"]}',
		),
		"SECTION_CODE" => array(
			"PARENT" => "BASE",
			"NAME" => GetMessage("IBLOCK_SECTION_CODE"),
			"TYPE" => "STRING",
			"DEFAULT" => '',
		),
		"COMPONENT_ID" => array(
			"PARENT" => "BASE",
			"NAME" => GetMessage("CP_AIS_COMPONENT_ID"),
			"TYPE" => "STRING",
			"DEFAULT" => COrionAnimatedImageSlider::GetComponentId(),
		),
		
		"ELEMENT_SORT_FIELD" => array(
			"PARENT" => "DATA_SOURCE",
			"NAME" => GetMessage("IBLOCK_ELEMENT_SORT_FIELD"),
			"TYPE" => "LIST",
			"VALUES" => array(
				"shows" => GetMessage("IBLOCK_SORT_SHOWS"),
				"sort" => GetMessage("IBLOCK_SORT_SORT"),
				"timestamp_x" => GetMessage("IBLOCK_SORT_TIMESTAMP"),
				"name" => GetMessage("IBLOCK_SORT_NAME"),
				"id" => GetMessage("IBLOCK_SORT_ID"),
				"active_from" => GetMessage("IBLOCK_SORT_ACTIVE_FROM"),
				"active_to" => GetMessage("IBLOCK_SORT_ACTIVE_TO"),
			),
			"ADDITIONAL_VALUES" => "Y",
			"DEFAULT" => "sort",
		),
		"ELEMENT_SORT_ORDER" => array(
			"PARENT" => "DATA_SOURCE",
			"NAME" => GetMessage("IBLOCK_ELEMENT_SORT_ORDER"),
			"TYPE" => "LIST",
			"VALUES" => $arAscDesc,
			"DEFAULT" => "asc",
			"ADDITIONAL_VALUES" => "Y",
		),
		"FILTER_NAME" => array(
			"PARENT" => "DATA_SOURCE",
			"NAME" => GetMessage("IBLOCK_FILTER_NAME_IN"),
			"TYPE" => "STRING",
			"DEFAULT" => "arrFilter",
		),
		"INCLUDE_SUBSECTIONS" => array(
			"PARENT" => "DATA_SOURCE",
			"NAME" => GetMessage("CP_BCS_INCLUDE_SUBSECTIONS"),
			"TYPE" => "CHECKBOX",
			"DEFAULT" => "Y",
		),
		"SHOW_ALL_WO_SECTION" => array(
			"PARENT" => "DATA_SOURCE",
			"NAME" => GetMessage("CP_BCS_SHOW_ALL_WO_SECTION"),
			"TYPE" => "CHECKBOX",
			"DEFAULT" => "Y",
		),
		"DETAIL_URL" => CIBlockParameters::GetPathTemplateParam(
			"DETAIL",
			"DETAIL_URL",
			GetMessage("IBLOCK_DETAIL_URL"),
			"",
			"URL_TEMPLATES"
		),
		"SECTION_ID_VARIABLE" => array(
			"PARENT" => "URL_TEMPLATES",
			"NAME" => GetMessage("IBLOCK_SECTION_ID_VARIABLE"),
			"TYPE" => "STRING",
			"DEFAULT" => "SECTION_ID",
		),
		"PAGE_ELEMENT_COUNT" => array(
			"PARENT" => "VISUAL",
			"NAME" => GetMessage("IBLOCK_PAGE_ELEMENT_COUNT"),
			"TYPE" => "STRING",
			"DEFAULT" => "30",
		),
		"PROPERTY_CODE" => array(
			"PARENT" => "DATA_SOURCE",
			"NAME" => GetMessage("IBLOCK_PROPERTY"),
			"TYPE" => "LIST",
			"MULTIPLE" => "Y",
			"VALUES" => $arProperty,
			"ADDITIONAL_VALUES" => "Y",
		),
		"PROPERTY_CODE_IMG" => array(
			"PARENT" => "DATA_SOURCE",
			"NAME" => GetMessage("IBLOCK_PROPERTY_IMG"),
			"TYPE" => "LIST",
			"VALUES" => $arPropertyImg,
			"DEFAULT" => 'PREVIEW_PICTURE',
			"ADDITIONAL_VALUES" => "Y",
		),
		"PROPERTY_CODE_IMG_HREF" => array(
			"PARENT" => "DATA_SOURCE",
			"NAME" => GetMessage("IBLOCK_PROPERTY_IMG_HREF"),
			"TYPE" => "LIST",
			"VALUES" => $arPropertyImgHref,
			"ADDITIONAL_VALUES" => "Y",
		),
		"PROPERTY_CODE_IMG_DESC" => array(
			"PARENT" => "DATA_SOURCE",
			"NAME" => GetMessage("IBLOCK_PROPERTY_IMG_DESC"),
			"TYPE" => "LIST",
			"DEFAULT" => 'PREVIEW_TEXT',
			"VALUES" => $arPropertyImgDesc,
			"ADDITIONAL_VALUES" => "Y",
		),
		"CACHE_TIME"  =>  Array("DEFAULT"=>36000000),
		"CACHE_FILTER" => array(
			"PARENT" => "ADDITIONAL_SETTINGS",
			"NAME" => GetMessage("IBLOCK_CACHE_FILTER"),
			"TYPE" => "CHECKBOX",
			"DEFAULT" => "N",
		),
		"CACHE_GROUPS" => array(
			"PARENT" => "CACHE_SETTINGS",
			"NAME" => GetMessage("CP_BCS_CACHE_GROUPS"),
			"TYPE" => "CHECKBOX",
			"DEFAULT" => "Y",
		),
	),
);

$arComponentParameters['PARAMETERS'] = array_merge($arComponentParameters['PARAMETERS'], COrionAnimatedImageSlider::GetAISParameters($arCurrentValues));

?>