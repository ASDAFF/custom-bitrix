<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
/** @var array $arCurrentValues */

if(!CModule::IncludeModule("iblock"))
	return;

$arTypesEx = CIBlockParameters::GetIBlockTypes();

$arIBlocks=array();
$db_iblock = CIBlock::GetList(array("SORT"=>"ASC"), array("SITE_ID"=>$_REQUEST["site"], "TYPE" => ($arCurrentValues["IBLOCK_TYPE"]!="-"?$arCurrentValues["IBLOCK_TYPE"]:"")));
while($arRes = $db_iblock->Fetch())
	$arIBlocks[$arRes["ID"]] = $arRes["NAME"];

	$arIBlockSections=array();
	$db_iblockSections = CIBlockSection::GetList(
		array("SORT"=>"ASC"),
		array("IBLOCK_TYPE" => ($arCurrentValues["IBLOCK_TYPE"]!="-"?$arCurrentValues["IBLOCK_TYPE"]:""),
		"IBLOCK_ID" => ($arCurrentValues["IBLOCK_ID"]!="-"?$arCurrentValues["IBLOCK_ID"]:""),
	)
);
while($arRes2 = $db_iblockSections->Fetch())
	$arIBlockSections[$arRes2["ID"]] = $arRes2["NAME"];

$arPropIB = array();
$arFilter2 = Array("IBLOCK_ID"=>$arCurrentValues["IBLOCK_ID"], "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y");
$res2 = CIBlockElement::GetList(Array(), $arFilter2, false, Array("nPageSize"=>2), array());
if($ob2 = $res2->GetNextElement())
{
	$arPropIB = $ob2->GetProperties();
}

$prop_array_video = array();
$prop_array_video["NONE"] = "NONE";
//$prop_array_video["DETAIL_TEXT"] = "DETAIL_TEXT";

$prop_array_img = array();
$prop_array_img["NONE"] = "NONE";
$prop_array_img["PREVIEW_PICTURE"] = "PREVIEW_PICTURE";
$prop_array_img["DETAIL_PICTURE"] = "DETAIL_PICTURE";

if(!empty($arPropIB) && is_array($arPropIB))
{
	foreach($arPropIB as $key => $value)
	{
		if($arPropIB[$key]["PROPERTY_TYPE"] == "S" && $arPropIB[$key]["USER_TYPE"] == "video")
		{
			$prop_array_video[$key] = $key;
		}
		if($arPropIB[$key]["PROPERTY_TYPE"] == "F")
		{
			$file_img = CFile::GetByID($arPropIB[$key]["ID"]);
			$is_img = CFile::IsImage($file_img->arResult[0]["FILE_NAME"], $file_img->arResult[0]["CONTENT_TYPE"]);
			if($is_img)
				$prop_array_img[$key] = $key;
		}
	}
}

$animate = array();
$animate = array("bounce" => "bounce", "flash" => "flash" , "pulse" => "pulse", "rubberBand" => "rubberBand", "shake" => "shake",
	"swing" => "swing", "tada" => "tada", "wobble" => "wobble", "jello" => "jello", "bounceIn" => "bounceIn", "bounceInDown" => "bounceInDown",
	"bounceInLeft" => "bounceInLeft", "bounceInRight" => "bounceInRight", "bounceInUp" => "bounceInUp", "bounceOut" => "bounceOut",
	"bounceOutDown" => "bounceOutDown", "bounceOutLeft" => "bounceOutLeft", "bounceOutRight" => "bounceOutRight", "bounceOutUp" => "bounceOutUp",
	"fadeIn" => "fadeIn", "fadeInDown" => "fadeInDown", "fadeInDownBig" => "fadeInDownBig", "fadeInLeft" => "fadeInLeft",
	"fadeInLeftBig" => "fadeInLeftBig", "fadeInRight" => "fadeInRight", "fadeInRightBig" => "fadeInRightBig", "fadeInUp" => "fadeInUp",
	"fadeInUpBig" => "fadeInUpBig", "fadeOut" => "fadeOut", "fadeOutDown" => "fadeOutDown", "fadeOutDownBig" => "fadeOutDownBig",
	"fadeOutLeft" => "fadeOutLeft", "fadeOutLeftBig" => "fadeOutLeftBig", "fadeOutRight" => "fadeOutRight", "fadeOutRightBig" => "fadeOutRightBig",
	"fadeOutUp" => "fadeOutUp", "fadeOutUpBig" => "fadeOutUpBig", "flip" => "flip", "flipInX" => "flipInX", "flipInY" => "flipInY",
	"flipOutX" => "flipOutX", "flipOutY" => "flipOutY", "lightSpeedIn" => "lightSpeedIn", "lightSpeedOut" => "lightSpeedOut",
	"rotateIn" => "rotateIn", "rotateInDownLeft" => "rotateInDownLeft", "rotateInDownRight" => "rotateInDownRight",
	"rotateInUpLeft" => "rotateInUpLeft", "rotateInUpRight" => "rotateInUpRight", "rotateOut" => "rotateOut",
	"rotateOutDownLeft" => "rotateOutDownLeft", "rotateOutDownRight" => "rotateOutDownRight", "rotateOutUpLeft" => "rotateOutUpLeft",
	"rotateOutUpRight" => "rotateOutUpRight", "slideInUp" => "slideInUp", "slideInDown" => "slideInDown", "slideInLeft" => "slideInLeft",
	"slideInRight" => "slideInRight", "slideOutUp" => "slideOutUp", "slideOutDown" => "slideOutDown", "slideOutLeft" => "slideOutLeft",
	"slideOutRight" => "slideOutRight", "zoomIn" => "zoomIn", "zoomInDown" => "zoomInDown", "zoomInLeft" => "zoomInLeft",
	"zoomInRight" => "zoomInRight", "zoomInUp" => "zoomInUp", "zoomOut" => "zoomOut", "zoomOutDown" => "zoomOutDown",
	"zoomOutLeft" => "zoomOutLeft", "zoomOutRight" => "zoomOutRight", "zoomOutUp" => "zoomOutUp", "hinge" => "hinge", "rollIn" => "rollIn",
	"rollOut" => "rollOut");

$arComponentParameters = array(
	"GROUPS" => array(
		"SETTINGS_OWL" => array("NAME" => GetMessage("SETTINGS_OWL_NAME")),
		"MOUSE_TOUCH_SCROLL_GROUPS_OWL" => array("NAME" => GetMessage("MOUSE_TOUCH_SCROLL_GROUPS_OWL_NAME")),
		"MARGIN_PADDING_GROUPS_OWL" => array("NAME" => GetMessage("MARGIN_PADDING_GROUPS_OWL_NAME")),
		"HEIGHT_GROUPS_OWL" => array("NAME" => GetMessage("HEIGHT_GROUPS_OWL_NAME")),
		"WIDTH_GROUPS_OWL" => array("NAME" => GetMessage("WIDTH_GROUPS_OWL_NAME")),
		"MERGE_WIDTH_GROUPS_OWL" => array("NAME" => GetMessage("MERGE_WIDTH_GROUPS_OWL_NAME")),
		"POSITION_GROUPS_OWL" => array("NAME" => GetMessage("POSITION_GROUPS_OWL_NAME")),
		"LAZY_LOAD_GROUPS_OWL" => array("NAME" => GetMessage("LAZY_LOAD_GROUPS_OWL_NAME")),
		"VIDEO_GROUPS_OWL" => array("NAME" => GetMessage("VIDEO_GROUPS_OWL_NAME")),
		"ANIMATE_GROUPS_OWL" => array("NAME" => GetMessage("ANIMATE_GROUPS_OWL_NAME")),
		"AUTO_PLAY_GROUPS_OWL" => array("NAME" => GetMessage("AUTO_PLAY_GROUPS_OWL_NAME")),
		"NAV_GROUPS_OWL" => array("NAME" => GetMessage("NAV_GROUPS_OWL_NAME")),
		"ADAPTIVE_GROUPS_OWL" => array("NAME" => GetMessage("ADAPTIVE_GROUPS_OWL_NAME"))
	),
	"PARAMETERS" => array(
		"IBLOCK_TYPE" => array(
			"PARENT" => "BASE",
			"NAME" => GetMessage("OWL_IBLOCK_TYPE"),
			"TYPE" => "LIST",
			"VALUES" => $arTypesEx,
			"ADDITIONAL_VALUES" => "Y",
			"REFRESH" => "Y",
		),
		"IBLOCK_ID" => array(
			"PARENT" => "BASE",
			"NAME" => GetMessage("OWL_IBLOCK_ID"),
			"TYPE" => "LIST",
			"VALUES" => $arIBlocks,
			"ADDITIONAL_VALUES" => "Y",
			"REFRESH" => "Y",
		),
		"PARENT_SECTION" => array(
			"PARENT" => "BASE",
			"NAME" => GetMessage("OWL_PARENT_SECTION"),
			"TYPE" => "LIST",
			"VALUES" => $arIBlockSections,
			"ADDITIONAL_VALUES" => "Y",
			"REFRESH" => "Y",
		),
		"IMAGE_FIELD_OWL" => array(
			"PARENT" => "BASE",
			"NAME" => GetMessage("IMAGE_FIELD_OWL_NAME"),
			"TYPE" => "LIST",
			"VALUES" => $prop_array_img,
			"DEFAULT" => "PREVIEW_PICTURE_PICTURE",
		),
		"VIDEO_FIELD_OWL" => array(
			"PARENT" => "BASE",
			"NAME" => GetMessage("VIDEO_FIELD_OWL_NAME"),
			"TYPE" => "LIST",
			"VALUES" => $prop_array_video,
			"DEFAULT" => "NONE",
		),
		"NEWS_COUNT" => array(
			"PARENT" => "BASE",
			"NAME" => GetMessage("OWL_NEWS_COUNT"),
			"TYPE" => "STRING",
			"DEFAULT" => "20",
		),
		"LOAD_NEW_PICTURE" => array(
			"PARENT" => "BASE",
			"NAME" => GetMessage("OWL_LOAD_NEW_PICTURE"),
			"TYPE" => "CHECKBOX",
			"DEFAULT" => "Y",
		),
		"DISPLAY_EMPTY_PICTURE" => array(
			"PARENT" => "BASE",
			"NAME" => GetMessage("OWL_DISPLAY_EMPTY_PICTURE"),
			"TYPE" => "CHECKBOX",
			"DEFAULT" => "Y",
		),
		"COMPRESS_PICTURE" => array(
			"PARENT" => "BASE",
			"NAME" => GetMessage("OWL_COMPRESS_PICTURE"),
			"TYPE" => "CHECKBOX",
			"DEFAULT" => "Y",
		),
		"CROPPED_IMAGE" => array(
			"PARENT" => "BASE",
			"NAME" => GetMessage("CROPPED_IMAGE_NAME"),
			"TYPE" => "CHECKBOX",
			"DEFAULT" => "N",
		),
		"CROPPED_IMAGE_HEIGHT" => array(
			"PARENT" => "BASE",
			"NAME" => GetMessage("CROPPED_IMAGE_HEIGHT_NAME"),
			"TYPE" => "STRING",
			"DEFAULT" => "300",
		),
		"CROPPED_IMAGE_WIDTH" => array(
			"PARENT" => "BASE",
			"NAME" => GetMessage("CROPPED_IMAGE_WIDTH_NAME"),
			"TYPE" => "STRING",
			"DEFAULT" => "300",
		),
		"SHOW_LINK_DETAIL" => array(
			"PARENT" => "BASE",
			"NAME" => GetMessage("SHOW_LINK_DETAIL_NAME"),
			"TYPE" => "CHECKBOX",
			"DEFAULT" => "N",
		),

		"CACHE_TIME" => array(
			"DEFAULT"=>36000000
		),

		//options owlCarousel2
		"ITEMS_OWL" => array(
			"PARENT" => "SETTINGS_OWL",
			"NAME" => GetMessage("ITEMS_OWL_NAME"),
			"TYPE" => "STRING",
			"DEFAULT" => "5",
		),

		"LOOP_OWL" => array(
			"PARENT" => "SETTINGS_OWL",
			"NAME" => GetMessage("LOOP_OWL_NAME"),
			"TYPE" => "CHECKBOX",
			"DEFAULT" => "Y",
			"REFRESH" => "Y",
		),

		"CENTER_OWL" => array(
			"PARENT" => "SETTINGS_OWL",
			"NAME" => GetMessage("CENTER_OWL_NAME"),
			"TYPE" => "CHECKBOX",
			"DEFAULT" => "N",
			"HIDDEN" => (isset($arCurrentValues['LOOP_OWL']) && $arCurrentValues['LOOP_OWL'] == 'Y' ? 'N' : 'Y'),
		),

		//speed
		"SMART_SPEED_OWL" => array(
			"PARENT" => "SETTINGS_OWL",
			"NAME" => GetMessage("SMART_SPEED_OWL_NAME"),
			"TYPE" => "STRING",
			"DEFAULT" => "250",
		),
		"DRAG_END_SPEED_OWL" => array(
			"PARENT" => "SETTINGS_OWL",
			"NAME" => GetMessage("DRAG_END_SPEED_OWL_NAME"),
			"TYPE" => "STRING",
			"DEFAULT" => "N",
		),

		//touch
		"MOUSE_DRAG_OWL" => array(
			"PARENT" => "MOUSE_TOUCH_SCROLL_GROUPS_OWL",
			"NAME" => GetMessage("MOUSE_DRAG_OWL_NAME"),
			"TYPE" => "CHECKBOX",
			"DEFAULT" => "Y",
		),
		"TOUCH_DRAG_OWL" => array(
			"PARENT" => "MOUSE_TOUCH_SCROLL_GROUPS_OWL",
			"NAME" => GetMessage("TOUCH_DRAG_OWL_NAME"),
			"TYPE" => "CHECKBOX",
			"DEFAULT" => "Y",
		),
		"PULLDRAG_OWL" => array(
			"PARENT" => "MOUSE_TOUCH_SCROLL_GROUPS_OWL",
			"NAME" => GetMessage("PULLDRAG_OWL_NAME"),
			"TYPE" => "CHECKBOX",
			"DEFAULT" => "Y",
			"HIDDEN" => (isset($arCurrentValues['LOOP_OWL']) && $arCurrentValues['LOOP_OWL'] == 'Y' ? 'Y' : 'N'),
		),
		"MOUSE_SCROLL_OWL" => array(
			"PARENT" => "MOUSE_TOUCH_SCROLL_GROUPS_OWL",
			"NAME" => GetMessage("MOUSE_SCROLL_NAME"),
			"TYPE" => "CHECKBOX",
			"DEFAULT" => "Y",
		),

		//options view
		//indent
		"MARGIN_OWL" => array(
			"PARENT" => "MARGIN_PADDING_GROUPS_OWL",
			"NAME" => GetMessage("MARGIN_OWL_NAME"),
			"TYPE" => "STRING",
			"DEFAULT" => "10",
		),
		"STAGE_PADDING_OWL" => array(
			"PARENT" => "MARGIN_PADDING_GROUPS_OWL",
			"NAME" => GetMessage("STAGE_PADDING_OWL_NAME"),
			"TYPE" => "STRING",
			"DEFAULT" => "0",
		),

		//AUTO_HEIGHT
		"HEIGHT_CAROUSEL_OWL" => array(
			"PARENT" => "HEIGHT_GROUPS_OWL",
			"NAME" => GetMessage("HEIGHT_CAROUSEL_OWL_NAME"),
			"TYPE" => "STRING",
			"DEFAULT" => "200",
		),
		"AUTO_HEIGHT_OWL" => array(
			"PARENT" => "HEIGHT_GROUPS_OWL",
			"NAME" => GetMessage("AUTO_HEIGHT_OWL_NAME"),
			"TYPE" => "CHECKBOX",
			"DEFAULT" => "Y",
		),
		//AUTO_WIDTH
		"AUTO_WIDTH_OWL" => array(
			"PARENT" => "MERGE_WIDTH_GROUPS_OWL",
			"NAME" => GetMessage("AUTO_WIDTH_OWL_NAME"),
			"TYPE" => "CHECKBOX",
			"DEFAULT" => "Y",
		),
		//
		"START_POSITION_OWL" => array(
			"PARENT" => "POSITION_GROUPS_OWL",
			"NAME" => GetMessage("START_POSITION_OWL_NAME"),
			"TYPE" => "STRING",
			"DEFAULT" => "0",
		),
		"RTL_OWL" => array(
			"PARENT" => "POSITION_GROUPS_OWL",
			"NAME" => GetMessage("RTL_OWL_NAME"),
			"TYPE" => "CHECKBOX",
			"DEFAULT" => "N",
		),

		//LAZY_LOAD
		"LAZY_LOAD_OWL" => array(
			"PARENT" => "LAZY_LOAD_GROUPS_OWL",
			"NAME" => GetMessage("LAZY_LOAD_OWL_NAME"),
			"TYPE" => "CHECKBOX",
			"DEFAULT" => "Y",
		),

		//VIDEO
		"VIDEO_OWL" => array(
			"PARENT" => "VIDEO_GROUPS_OWL",
			"NAME" => GetMessage("VIDEO_OWL_NAME"),
			"TYPE" => "CHECKBOX",
			"DEFAULT" => "N",
			"REFRESH" => "Y",
		),
		"VIDEO_HEIGHT_OWL" => array(
			"PARENT" => "VIDEO_GROUPS_OWL",
			"NAME" => GetMessage("VIDEO_HEIGHT_OWL_NAME"),
			"TYPE" => "STRING",
			"DEFAULT" => "150",
			"HIDDEN" => (isset($arCurrentValues['VIDEO_OWL']) && $arCurrentValues['VIDEO_OWL'] == 'Y' ? 'N' : 'Y'),
		),
		"VIDEO_WIDTH_OWL" => array(
			"PARENT" => "VIDEO_GROUPS_OWL",
			"NAME" => GetMessage("VIDEO_WIDTH_OWL_NAME"),
			"TYPE" => "STRING",
			"DEFAULT" => "200",
			"HIDDEN" => (isset($arCurrentValues['VIDEO_OWL']) && $arCurrentValues['VIDEO_OWL'] == 'Y' ? 'N' : 'Y'),
		),

		//ANIMATE
		"ANIMATE_OWL" => array(
			"PARENT" => "ANIMATE_GROUPS_OWL",
			"NAME" => GetMessage("ANIMATE_OWL_NAME"),
			"TYPE" => "CHECKBOX",
			"DEFAULT" => "N",
			"REFRESH" => "Y",
		),
		"ANIMATE_IN_OWL" => array(
			"PARENT" => "ANIMATE_GROUPS_OWL",
			"NAME" => GetMessage("ANIMATE_IN_OWL_NAME"),
			"TYPE" => "LIST",
			"MULTIPLE" => "Y",
			"VALUES" => $animate,
			"DEFAULT" => "flipInX",
			"HIDDEN" => (isset($arCurrentValues['ANIMATE_OWL']) && $arCurrentValues['ANIMATE_OWL'] == 'Y' ? 'N' : 'Y'),
		),
		"ANIMATE_OUT_OWL" => array(
			"PARENT" => "ANIMATE_GROUPS_OWL",
			"NAME" => GetMessage("ANIMATE_OUT_OWL_NAME"),
			"TYPE" => "LIST",
			"MULTIPLE" => "Y",
			"VALUES" => $animate,
			"DEFAULT" => "slideOutDown",
			"HIDDEN" => (isset($arCurrentValues['ANIMATE_OWL']) && $arCurrentValues['ANIMATE_OWL'] == 'Y' ? 'N' : 'Y'),
		),

		//AUTO_PLAY
		"AUTO_PLAY_OWL" => array(
			"PARENT" => "AUTO_PLAY_GROUPS_OWL",
			"NAME" => GetMessage("AUTO_PLAY_OWL_NAME"),
			"TYPE" => "CHECKBOX",
			"DEFAULT" => "N",
			"REFRESH" => "Y",
		),
		"AUTO_PLAY_TIMEOUT_OWL" => array(
			"PARENT" => "AUTO_PLAY_GROUPS_OWL",
			"NAME" => GetMessage("AUTO_PLAY_TIMEOUT_OWL_NAME"),
			"TYPE" => "STRING",
			"DEFAULT" => "1000",
			"HIDDEN" => (isset($arCurrentValues['AUTO_PLAY_OWL']) && $arCurrentValues['AUTO_PLAY_OWL'] == 'Y' ? 'N' : 'Y'),
		),
		"AUTO_PLAY_SPEED_OWL" => array(
			"PARENT" => "AUTO_PLAY_GROUPS_OWL",
			"NAME" => GetMessage("AUTO_PLAY_SPEED_OWL_NAME"),
			"TYPE" => "STRING",
			"DEFAULT" => "N",
			"HIDDEN" => (isset($arCurrentValues['AUTO_PLAY_OWL']) && $arCurrentValues['AUTO_PLAY_OWL'] == 'Y' ? 'N' : 'Y'),
		),
		"AUTO_PLAY_HOVER_PAUSE_OWL" => array(
			"PARENT" => "AUTO_PLAY_GROUPS_OWL",
			"NAME" => GetMessage("AUTO_PLAY_HOVER_PAUSE_OWL_NAME"),
			"TYPE" => "CHECKBOX",
			"DEFAULT" => "Y",
			"HIDDEN" => (isset($arCurrentValues['AUTO_PLAY_OWL']) && $arCurrentValues['AUTO_PLAY_OWL'] == 'Y' ? 'N' : 'Y'),
		),

		//nav
		"NAV_OWL" => array(
			"PARENT" => "NAV_GROUPS_OWL",
			"NAME" => GetMessage("NAV_OWL_NAME"),
			"TYPE" => "CHECKBOX",
			"DEFAULT" => "N",
			"REFRESH" => "Y",
		),
		"NAV_TEXT_LEFT_OWL" => array(
			"PARENT" => "NAV_GROUPS_OWL",
			"NAME" => GetMessage("NAV_TEXT_LEFT_OWL_NAME"),
			"TYPE" => "STRING",
			"DEFAULT" => "prev",
			"HIDDEN" => (isset($arCurrentValues['NAV_OWL']) && $arCurrentValues['NAV_OWL'] == 'Y' ? 'N' : 'Y'),
		),
		"NAV_TEXT_RIGHT_OWL" => array(
			"PARENT" => "NAV_GROUPS_OWL",
			"NAME" => GetMessage("NAV_TEXT_RIGHT_OWL_NAME"),
			"TYPE" => "STRING",
			"DEFAULT" => "next",
			"HIDDEN" => (isset($arCurrentValues['NAV_OWL']) && $arCurrentValues['NAV_OWL'] == 'Y' ? 'N' : 'Y'),
		),
		"NAV_SPEED_OWL" => array(
			"PARENT" => "NAV_GROUPS_OWL",
			"NAME" => GetMessage("NAV_SPEED_OWL_NAME"),
			"TYPE" => "STRING",
		),
		"DOTS_OWL" => array(
			"PARENT" => "NAV_GROUPS_OWL",
			"NAME" => GetMessage("DOTS_OWL_NAME"),
			"TYPE" => "CHECKBOX",
			"DEFAULT" => "Y",
			"REFRESH" => "Y",
		),
		"DOTS_EACH_OWL" => array(
			"PARENT" => "NAV_GROUPS_OWL",
			"NAME" => GetMessage("DOTS_EACH_OWL_NAME"),
			"TYPE" => "CHECKBOX",
			"DEFAULT" => "N",
			"HIDDEN" => (isset($arCurrentValues['DOTS_OWL']) && $arCurrentValues['DOTS_OWL'] == 'Y' ? 'N' : 'Y'),
		),
		"DOTS_SPEED_OWL" => array(
			"PARENT" => "NAV_GROUPS_OWL",
			"NAME" => GetMessage("DOTS_SPEED_OWL_NAME"),
			"TYPE" => "STRING",
			"HIDDEN" => (isset($arCurrentValues['DOTS_OWL']) && $arCurrentValues['DOTS_OWL'] == 'Y' ? 'N' : 'Y'),
		),
		"ADAPTIVE_OWL" => array(
			"PARENT" => "ADAPTIVE_GROUPS_OWL",
			"NAME" => GetMessage("ADAPTIVE_OWL_NAME"),
			"TYPE" => "CHECKBOX",
			"DEFAULT" => "N",
			"REFRESH" => "Y",
		),
		"ITEM_0_ADAPTIVE_OWL" => array(
			"PARENT" => "ADAPTIVE_GROUPS_OWL",
			"NAME" => GetMessage("ITEM_0_ADAPTIVE_OWL_NAME"),
			"TYPE" => "STRING",
			"DEFAULT" => "1",
			"HIDDEN" => (isset($arCurrentValues['ADAPTIVE_OWL']) && $arCurrentValues['ADAPTIVE_OWL'] == 'Y' ? 'N' : 'Y'),
		),
		"ITEM_768_ADAPTIVE_OWL" => array(
			"PARENT" => "ADAPTIVE_GROUPS_OWL",
			"NAME" => GetMessage("ITEM_768_ADAPTIVE_OWL_NAME"),
			"TYPE" => "STRING",
			"DEFAULT" => "3",
			"HIDDEN" => (isset($arCurrentValues['ADAPTIVE_OWL']) && $arCurrentValues['ADAPTIVE_OWL'] == 'Y' ? 'N' : 'Y'),
		),
		"ITEM_992_ADAPTIVE_OWL" => array(
			"PARENT" => "ADAPTIVE_GROUPS_OWL",
			"NAME" => GetMessage("ITEM_992_ADAPTIVE_OWL_NAME"),
			"TYPE" => "STRING",
			"DEFAULT" => "4",
			"HIDDEN" => (isset($arCurrentValues['ADAPTIVE_OWL']) && $arCurrentValues['ADAPTIVE_OWL'] == 'Y' ? 'N' : 'Y'),
		),
		"ITEM_1200_ADAPTIVE_OWL" => array(
			"PARENT" => "ADAPTIVE_GROUPS_OWL",
			"NAME" => GetMessage("ITEM_1200_ADAPTIVE_OWL_NAME"),
			"TYPE" => "STRING",
			"DEFAULT" => "5",
			"HIDDEN" => (isset($arCurrentValues['ADAPTIVE_OWL']) && $arCurrentValues['ADAPTIVE_OWL'] == 'Y' ? 'N' : 'Y'),
		),
	),
);

$arComponentParameters["PARAMETERS"]["JQUERY_EN"] = array(
	"PARENT" => "BASE",
	"NAME" => GetMessage("OWL_ADD_JQUERY"),
	"TYPE" => "LIST",
	"ADDITIONAL_VALUES" => "N",
	"MULTIPLE" => "N",
	"REFRESH" => "N",
	"VALUES" => array("jquery" => GetMessage("OWL_ADD_JQUERY_YES"), "jquery2" => GetMessage("OWL_ADD_JQUERY_JQUERY2"), "N" => GetMessage("OWL_ADD_JQUERY_NO")),
	"DEFAULT" => "Y",
);
?>