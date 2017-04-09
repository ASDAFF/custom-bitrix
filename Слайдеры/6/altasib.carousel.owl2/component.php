<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
/** @var CBitrixComponent $this */
/** @var array $arParams */
/** @var array $arResult */
/** @var string $componentPath */
/** @var string $componentName */
/** @var string $componentTemplate */
/** @global CDatabase $DB */
/** @global CUser $USER */
/** @global CMain $APPLICATION */

if(!isset($arParams["CACHE_TIME"]))
	$arParams["CACHE_TIME"] = 36000000;

$arParams["IBLOCK_TYPE"] = trim($arParams["IBLOCK_TYPE"]);
if(strlen($arParams["IBLOCK_TYPE"])<=0)
	$arParams["IBLOCK_TYPE"] = "carousel";
$arParams["IBLOCK_ID"] = trim($arParams["IBLOCK_ID"]);
$arParams["PARENT_SECTION"] = intval($arParams["PARENT_SECTION"]);

$arParams["NEWS_COUNT"] = intval($arParams["NEWS_COUNT"],10);
if($arParams["NEWS_COUNT"]<=0)
	$arParams["NEWS_COUNT"] = 20;

$arParams["IMAGE_FIELD_OWL"] = strtoupper($arParams["IMAGE_FIELD_OWL"]);
$arParams["VIDEO_FIELD_OWL"] = strtoupper($arParams["VIDEO_FIELD_OWL"]);

$arParams["LOAD_NEW_PICTURE"] = $arParams["LOAD_NEW_PICTURE"] == "Y" ? true : false;
$arParams["DISPLAY_NAME"] = $arParams["DISPLAY_NAME"] == "Y" ? true : false;
$arParams["DISPLAY_PREVIEW_TEXT"] = $arParams["DISPLAY_PREVIEW_TEXT"] == "Y" ? true : false;
$arParams["DISPLAY_DETAIL_PICTURE"] = $arParams["DISPLAY_DETAIL_PICTURE"] == "Y" ? true : false;
$arParams["DISPLAY_VIDEO"] = $arParams["DISPLAY_VIDEO"] == "Y" ? true : false;
$arParams["COMPRESS_PICTURE"] = $arParams["COMPRESS_PICTURE"] =="Y" ? true: false;
$arParams["CROPPED_IMAGE"] = $arParams["CROPPED_IMAGE"] =="Y" ? true: false;
$arParams["CROPPED_IMAGE_HEIGHT"] = isset($arParams["CROPPED_IMAGE_HEIGHT"]) ? intval(trim($arParams["CROPPED_IMAGE_HEIGHT"]), 10) : 300;
$arParams["CROPPED_IMAGE_WIDTH"] = isset($arParams["CROPPED_IMAGE_WIDTH"]) ? intval(trim($arParams["CROPPED_IMAGE_WIDTH"]), 10) : 300;
$arParams["SHOW_LINK_DETAIL"] = $arParams["SHOW_LINK_DETAIL"] =="Y" ? true: false;

//
$arParams["ITEMS_OWL"] = isset($arParams["ITEMS_OWL"]) ? intval(trim($arParams["ITEMS_OWL"]), 10) : 5;
$arParams["LOOP_OWL"] = $arParams["LOOP_OWL"] == "Y" ? true : false;
$arParams["CENTER_OWL"] = isset($arParams["CENTER_OWL"]) && $arParams["CENTER_OWL"] == "Y" ? true : false;
$arParams["CENTER_OWL"] = $arParams["LOOP_OWL"] ? $arParams["CENTER_OWL"] : false;
//
$arParams["MOUSE_DRAG_OWL"] = $arParams["MOUSE_DRAG_OWL"] == "Y" ? true : false;
$arParams["TOUCH_DRAG_OWL"] = $arParams["TOUCH_DRAG_OWL"] == "Y" ? true : false;
$arParams["PULLDRAG_OWL"] = $arParams["PULLDRAG_OWL"] == "Y" ? true : false;
$arParams["MOUSE_SCROLL_OWL"] = $arParams["MOUSE_SCROLL_OWL"] == "Y" ? true : false;
//
$arParams["MARGIN_OWL"] = isset($arParams["MARGIN_OWL"]) ? intval($arParams["MARGIN_OWL"],10) : 10;
$arParams["STAGE_PADDING_OWL"] = isset($arParams["STAGE_PADDING_OWL"]) ? intval($arParams["STAGE_PADDING_OWL"], 10) : 0;
//
$arParams["START_POSITION_OWL"] = intval(trim($arParams["START_POSITION_OWL"]), 10);
$arParams["RTL_OWL"] = $arParams["RTL_OWL"] === "Y" ? true : false;
$arParams["SMART_SPEED_OWL"] = isset($arParams["SMART_SPEED_OWL"]) && $arParams["SMART_SPEED_OWL"] != "0" ? intval(trim($arParams["SMART_SPEED_OWL"]), 10) : 250;
$arParams["DRAG_END_SPEED_OWL"] = isset($arParams["DRAG_END_SPEED_OWL"]) && $arParams["DRAG_END_SPEED_OWL"] != false ? intval(trim($arParams["DRAG_END_SPEED_OWL"]), 10) : 0;
//
$arParams["LAZY_LOAD_OWL"] = $arParams["LAZY_LOAD_OWL"] == "Y" ? true : false;
//
$arParams["HEIGHT_CAROUSEL_OWL"] = isset($arParams["HEIGHT_CAROUSEL_OWL"]) && $arParams["HEIGHT_CAROUSEL_OWL"] != false ? intval(trim($arParams["HEIGHT_CAROUSEL_OWL"]), 10) : 200;
$arParams["AUTO_HEIGHT_OWL"] = $arParams["AUTO_HEIGHT_OWL"] === "Y" ? true : false;
$arParams["AUTO_WIDTH_OWL"] = $arParams["AUTO_WIDTH_OWL"] === "Y" ? true : false;
//
$arParams["VIDEO_OWL"] = $arParams["VIDEO_OWL"] == "Y" ? true : false;
$arParams["VIDEO_HEIGHT_OWL"] = isset($arParams["VIDEO_HEIGHT_OWL"]) && $arParams["VIDEO_HEIGHT_OWL"] != false ? intval(trim($arParams["VIDEO_HEIGHT_OWL"]), 10) : 150;
$arParams["VIDEO_WIDTH_OWL"] = isset($arParams["VIDEO_WIDTH_OWL"]) && $arParams["VIDEO_WIDTH_OWL"] != false ? intval(trim($arParams["VIDEO_WIDTH_OWL"]), 10) : 200;
//
$arParams["ANIMATE_OWL"] = isset($arParams["ANIMATE_OWL"]) && $arParams["ANIMATE_OWL"] != false && $arParams["ANIMATE_OWL"] == "Y" ? true : false;
if(!isset($arParams["ANIMATE_OUT_OWL"]))
	$arParams["ANIMATE_OUT_OWL"][] = "fadeOut";
if(!isset($arParams["ANIMATE_IN_OWL"]))
	$arParams["ANIMATE_IN_OWL"][] = "fadeIn";

//
$arParams["AUTO_PLAY_OWL"] = $arParams["AUTO_PLAY_OWL"] == "Y" ? true : false;
$arParams["AUTO_PLAY_TIMEOUT_OWL"] = isset($arParams["AUTO_PLAY_TIMEOUT_OWL"]) && $arParams["AUTO_PLAY_TIMEOUT_OWL"] != false ? intval(trim($arParams["AUTO_PLAY_TIMEOUT_OWL"])) : 1000;
$arParams["AUTO_PLAY_SPEED_OWL"] = isset($arParams["AUTO_PLAY_SPEED_OWL"]) && $arParams["AUTO_PLAY_SPEED_OWL"] != false && is_numeric($arParams["AUTO_PLAY_SPEED_OWL"]) ? intval(trim($arParams["AUTO_PLAY_SPEED_OWL"]), 10) : false;
$arParams["AUTO_PLAY_HOVER_PAUSE_OWL"] = isset($arParams["AUTO_PLAY_HOVER_PAUSE_OWL"]) && $arParams["AUTO_PLAY_HOVER_PAUSE_OWL"] != false ? $arParams["AUTO_PLAY_HOVER_PAUSE_OWL"] : "Y";
$arParams["AUTO_PLAY_HOVER_PAUSE_OWL"] = $arParams["AUTO_PLAY_HOVER_PAUSE_OWL"] == "Y" ? true : false;
//
$arParams["NAV_OWL"] = $arParams["NAV_OWL"] == "Y" ? true : false;
$arParams["NAV_TEXT_LEFT_OWL"] = isset($arParams["NAV_TEXT_LEFT_OWL"]) && $arParams["NAV_TEXT_LEFT_OWL"] != false ? trim($arParams["NAV_TEXT_LEFT_OWL"]) : "prev";
$arParams["NAV_TEXT_RIGHT_OWL"] = isset($arParams["NAV_TEXT_RIGHT_OWL"]) && $arParams["NAV_TEXT_RIGHT_OWL"] != false ? trim($arParams["NAV_TEXT_RIGHT_OWL"]) : "next";
$arParams["NAV_TEXT_OWL"] = array($arParams["NAV_TEXT_LEFT_OWL"],$arParams["NAV_TEXT_RIGHT_OWL"]);

$arParams["NAV_SPEED_OWL"] = isset($arParams["NAV_SPEED_OWL"]) && $arParams["NAV_SPEED_OWL"] != false ? intval(trim($arParams["NAV_SPEED_OWL"]), 10) : false;

$arParams["DOTS_OWL"] = $arParams["DOTS_OWL"] == "Y" ? true : false;
$arParams["DOTS_EACH_OWL"] = isset($arParams["DOTS_EACH_OWL"]) && $arParams["DOTS_EACH_OWL"] != false && $arParams["DOTS_EACH_OWL"] == "Y" ? true : false;
$arParams["DOTS_SPEED_OWL"] = isset($arParams["DOTS_SPEED_OWL"]) && $arParams["DOTS_SPEED_OWL"] != false ? intval(trim($arParams["DOTS_SPEED_OWL"]), 10) : false;

$arParams["ADAPTIVE_OWL"] = $arParams["ADAPTIVE_OWL"] == "Y" ? true : false;
$arParams["ITEM_0_ADAPTIVE_OWL"] = isset($arParams["ITEM_0_ADAPTIVE_OWL"]) && $arParams["ITEM_0_ADAPTIVE_OWL"] != false ? intval(trim($arParams["ITEM_0_ADAPTIVE_OWL"]), 10) : 1;
$arParams["ITEM_768_ADAPTIVE_OWL"] = isset($arParams["ITEM_768_ADAPTIVE_OWL"]) && $arParams["ITEM_768_ADAPTIVE_OWL"] != false ? intval(trim($arParams["ITEM_768_ADAPTIVE_OWL"]), 10) : 3;
$arParams["ITEM_992_ADAPTIVE_OWL"] = isset($arParams["ITEM_992_ADAPTIVE_OWL"]) && $arParams["ITEM_992_ADAPTIVE_OWL"] != false ? intval(trim($arParams["ITEM_992_ADAPTIVE_OWL"]), 10) : 4;
$arParams["ITEM_1200_ADAPTIVE_OWL"] = isset($arParams["ITEM_1200_ADAPTIVE_OWL"]) && $arParams["ITEM_1200_ADAPTIVE_OWL"] != false ? intval(trim($arParams["ITEM_1200_ADAPTIVE_OWL"]), 10) : 5;



if($_POST["altasib_owl_page"] && $_POST["ALTASIB_OWL_COUNTER"] == $arParams["COUNTER"])
{
	$APPLICATION->RestartBuffer();
	if($this->StartResultCache(false,array($_POST["altasib_owl_page"])))
	{
		if(!CModule::IncludeModule("iblock"))
		{
			ShowError(GetMessage("SHOW_ERROR_MODULE_IBLOCK"));
			return;
		}
		//SELECT
		$arSelect = array(
			"ID",
			"IBLOCK_ID",
			"IBLOCK_SECTION_ID",
			"NAME",
			"PREVIEW_TEXT",
			"DETAIL_TEXT",
			"DETAIL_PAGE_URL"
		);
		if($arParams["DISPLAY_DETAIL_PICTURE"] == "Y")
		{
			if($arParams["IMAGE_FIELD_OWL"] == "DETAIL_PICTURE")
			{
				$arSelect[] = "DETAIL_PICTURE";
			}
			elseif($arParams["IMAGE_FIELD_OWL"] == "PREVIEW_PICTURE")
			{
				$arSelect[] = "PREVIEW_PICTURE";
			}
			else
			{
				$arSelect[] = "PROPERTY_".$arParams["IMAGE_FIELD_OWL"];
			}
		}

		if($arParams["DISPLAY_VIDEO"] == "Y")
		{
			if($arParams["VIDEO_FIELD_OWL"] != "NONE")
			{
				$arSelect[] = "PROPERTY_".$arParams["VIDEO_FIELD_OWL"];
			}
		}
		//WHERE
		$arFilter = array (
			"ACTIVE" => "Y",
			"IBLOCK_ID" => $arParams["IBLOCK_ID"],
		);
		//If you select the output elements without image
		if($arParams["DISPLAY_EMPTY_PICTURE"] == "N" && $arParams["DISPLAY_DETAIL_PICTURE"] == "Y")
		{
			if($arParams["IMAGE_FIELD_OWL"] == "DETAIL_PICTURE")
			{
				$arFilter["!DETAIL_PICTURE"] = false;
			}
			elseif($arParams["IMAGE_FIELD_OWL"] == "PREVIEW_PICTURE")
			{
				$arFilter["!PREVIEW_PICTURE"] = false;
			}
			else
			{
				$arFilter["!PROPERTY_".$arParams["IMAGE_FIELD_OWL"]] = false;
			}
		}

		if($arParams["DISPLAY_VIDEO"] == "Y")
		{
			if($arParams["VIDEO_FIELD_OWL"] != "NONE")
			{
				$arFilter["!PROPERTY_".$arParams["VIDEO_FIELD_OWL"]] = false;
			}
		}

		if($arParams["PARENT_SECTION"]>0)
		{
			$arFilter["SECTION_ID"] = $arParams["PARENT_SECTION"];
			$arFilter["INCLUDE_SUBSECTIONS"] = "Y";
		}

		//ORDER BY
		$arSort = array("SORT"=>"ASC");
		$arResult["ITEMS"] = array();

		$rsElement = CIBlockElement::GetList($arSort, $arFilter, false, Array("iNumPage"=>$_POST["altasib_owl_page"],
		"nPageSize"=> $arParams["NEWS_COUNT"]), $arSelect);

		$arParams["NavPageCount"] = $rsElement->NavPageCount;

		while($obElement = $rsElement->GetNextElement())
		{
			$arItem = $obElement->GetFields();

			$arItem["VIDEO_PATH"] = $arItem["PROPERTY_".$arParams["VIDEO_FIELD_OWL"]."_VALUE"]["path"];

			$img_source = $arParams["IMAGE_FIELD_OWL"] == "PREVIEW_PICTURE" || $arParams["IMAGE_FIELD_OWL"] == "DETAIL_PICTURE" ?
				$arItem[$arParams["IMAGE_FIELD_OWL"]] : $arItem["PROPERTY_".$arParams["IMAGE_FIELD_OWL"]."_VALUE"];

			if(isset($img_source))
			{
				if($arParams["COMPRESS_PICTURE"])
				{
					$renderImage = CFile::ResizeImageGet($img_source, Array("width" => $arParams["CROPPED_IMAGE_WIDTH"],
						"height" => $arParams["CROPPED_IMAGE_HEIGHT"]), $arParams["CROPPED_IMAGE"] ?
						BX_RESIZE_IMAGE_EXACT:BX_RESIZE_IMAGE_PROPORTIONAL_ALT, true);
					$arItem["src"] = $renderImage["src"];
					$arItem["width"] = $renderImage["width"];
					$arItem["height"] = $renderImage["height"];
				}
				else
				{
					$arItem["src"] = CFile::GetPath($img_source);
					$img_info = CFile::GetByID($img_source)->arResult[0];
					$arItem["width"] = $img_info["WIDTH"];
					$arItem["height"] = $img_info["HEIGHT"];
				}
			}
			else
			{
				$arItem["src"] = "";
				$arItem["width"] = 50;
				$arItem["height"] = 50;
			}
			$arItem["alt"] = $arItem["NAME"];
			$arResult["ITEMS"][] = $arItem;
		}
		$this->IncludeComponentTemplate();
	}
	die();
}
else
{
	// scripts and styles loads in template
	$this->IncludeComponentTemplate();
}
?>