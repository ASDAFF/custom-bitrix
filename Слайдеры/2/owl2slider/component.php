<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
use
		\Bitrix\Main\Localization\Loc,
		\Bitrix\Main\Loader,
		\Bitrix\Main\Page\Asset;

$Asset = Asset::getInstance();

Loc::loadLanguageFile(__FILE__);
//Loader::includeModule("teasoft.owl2slider");

//$this->IncludeComponentLang('.parameters.php');

$arParams["OWL2SLIDER_SOURCE_TYPE"] = (isset($arParams["OWL2SLIDER_SOURCE_TYPE"]) ? trim($arParams["OWL2SLIDER_SOURCE_TYPE"]) : "");
$arParams["OWL2SLIDER_IBLOCK_TYPE"] = (isset($arParams["OWL2SLIDER_IBLOCK_TYPE"]) ? trim($arParams["OWL2SLIDER_IBLOCK_TYPE"]) : "");
$arParams["OWL2SLIDER_IBLOCK_ID"] = (isset($arParams["OWL2SLIDER_IBLOCK_ID"]) ? trim($arParams["OWL2SLIDER_IBLOCK_ID"]) : "");
$arParams["OWL2SLIDER_ADVERT_TYPE"] = (isset($arParams["OWL2SLIDER_ADVERT_TYPE"]) ? trim($arParams["OWL2SLIDER_ADVERT_TYPE"]) : "");

if ($arParams["OWL2SLIDER_SOURCE_TYPE"] === "" || $arParams["OWL2SLIDER_SOURCE_TYPE"] === "none")
{
	ShowMessage(GetMessage("OWL2SLIDER_OSIBKA_VY_NE_VYBRALI_SOURCE_TYPE"));
	return;
}

if ($arParams["OWL2SLIDER_SOURCE_TYPE"] == 'advert')
{
	if ($arParams["OWL2SLIDER_ADVERT_TYPE"] === "")
	{
		ShowMessage(GetMessage("OWL2SLIDER_OSIBKA_VY_NE_VYBRALI_ADVERT_TYPE"));
		return;
	}
}

if ($arParams["OWL2SLIDER_SOURCE_TYPE"] == 'iblock')
{
	if ($arParams["OWL2SLIDER_IBLOCK_TYPE"] === "" || $arParams["OWL2SLIDER_IBLOCK_TYPE"] === 0)
	{
		ShowMessage(GetMessage("OWL2SLIDER_OSIBKA_VY_NE_VYBRALI_IBLOCK_TYPE"));
		return;
	}
	if ($arParams["OWL2SLIDER_IBLOCK_ID"] === "" || $arParams["OWL2SLIDER_IBLOCK_ID"] === 0)
	{
		ShowMessage(GetMessage("OWL2SLIDER_OSIBKA_VY_NE_VYBRALI_IBLOCK_ID"));
		return;
	}
}

// - OWL 2 Options
if ($arParams['OWL2SLIDER_INCLUDE_SUBSECTIONS'] != "N") $arParams['OWL2SLIDER_INCLUDE_SUBSECTIONS'] = "Y";
if (!strlen($arParams['OWL2SLIDER_UNIQUE_SUFFIX'])) $arParams['OWL2SLIDER_UNIQUE_SUFFIX'] = "teasoft";
if (intval($arParams['OWL2SLIDER_SOURCE_COUNT']) == 0) $arParams['OWL2SLIDER_SOURCE_COUNT'] = 8;


$arParams['OWL2SLIDER_OWL_OPTS_USE_RESIZE'] = ($arParams['OWL2SLIDER_OWL_OPTS_USE_RESIZE'] != "N") ? "Y" : "N";
$arParams['OWL2SLIDER_OWL_OPTS_USE_RESIZER2'] = ($arParams['OWL2SLIDER_OWL_OPTS_USE_RESIZER2'] != "N") ? "Y" : "N";
if (intval($arParams['OWL2SLIDER_OWL_OPTS_RESIZE_LIST_SET']) == 0) $arParams['OWL2SLIDER_OWL_OPTS_RESIZE_LIST_SET'] = 1;
if (!strlen($arParams['OWL2SLIDER_OWL_OPTS_RESIZE_WIDTH'])) $arParams['OWL2SLIDER_OWL_OPTS_RESIZE_WIDTH'] = "";
if (!strlen($arParams['OWL2SLIDER_OWL_OPTS_RESIZE_HEIGHT'])) $arParams['OWL2SLIDER_OWL_OPTS_RESIZE_HEIGHT'] = "";

$arParams['OWL2SLIDER_OWL_OPTS_RESIZE_IS_PROPORTIONAL'] = ($arParams['OWL2SLIDER_OWL_OPTS_RESIZE_IS_PROPORTIONAL'] != "N") ? "Y" : "N";
$arParams['OWL2SLIDER_COMPOSITE'] = ($arParams['OWL2SLIDER_COMPOSITE'] != "N") ? "Y" : "N";

$arParams['OWL2SLIDER_OWL_OPTS_THEME'] = (!strlen($arParams['OWL2SLIDER_OWL_OPTS_THEME'])) ? "bordo" : $arParams['OWL2SLIDER_OWL_OPTS_THEME'];
$arParams['OWL2SLIDER_OWL_OPTS_DESIGN'] = (!strlen($arParams['OWL2SLIDER_OWL_OPTS_DESIGN'])) ? "default" : $arParams['OWL2SLIDER_OWL_OPTS_DESIGN'];

$arParams['OWL2SLIDER_OWL_OPTS_loop'] = $arParams['OWL2SLIDER_OWL_OPTS_LOOP'];
$arParams['OWL2SLIDER_OWL_OPTS_loop'] = ($arParams['OWL2SLIDER_OWL_OPTS_loop'] != "N") ? "Y" : "N";

$arParams['OWL2SLIDER_OWL_OPTS_center'] = ($arParams['OWL2SLIDER_OWL_OPTS_center'] != "N") ? "Y" : "N";
$arParams['OWL2SLIDER_OWL_OPTS_mouseDrag'] = ($arParams['OWL2SLIDER_OWL_OPTS_mouseDrag'] != "N") ? "Y" : "N";
$arParams['OWL2SLIDER_OWL_OPTS_touchDrag'] = ($arParams['OWL2SLIDER_OWL_OPTS_touchDrag'] != "N") ? "Y" : "N";
$arParams['OWL2SLIDER_OWL_OPTS_pullDrag'] = ($arParams['OWL2SLIDER_OWL_OPTS_pullDrag'] != "N") ? "Y" : "N";
$arParams['OWL2SLIDER_OWL_OPTS_freeDrag'] = ($arParams['OWL2SLIDER_OWL_OPTS_freeDrag'] != "N") ? "Y" : "N";
$arParams['OWL2SLIDER_OWL_OPTS_merge'] = ($arParams['OWL2SLIDER_OWL_OPTS_merge'] != "N") ? "Y" : "N";
$arParams['OWL2SLIDER_OWL_OPTS_mergeFit'] = ($arParams['OWL2SLIDER_OWL_OPTS_mergeFit'] != "N") ? "Y" : "N";
$arParams['OWL2SLIDER_OWL_OPTS_autoWidth'] = ($arParams['OWL2SLIDER_OWL_OPTS_autoWidth'] != "N") ? "Y" : "N";

$arParams['OWL2SLIDER_OWL_OPTS_autoHeight'] = ($arParams['OWL2SLIDER_OWL_OPTS_autoHeight'] != "N") ? "Y" : "N";
$arParams['OWL2SLIDER_OWL_OPTS_autoHeight'] = (intval($arParams['OWL2SLIDER_OWL_OPTS_visibleItemsCount']) > 1) ? "N" : 1;

$arParams['OWL2SLIDER_OWL_OPTS_stagePadding'] = intval($arParams['OWL2SLIDER_OWL_OPTS_stagePadding']);
$arParams['OWL2SLIDER_OWL_OPTS_mergeSource'] = intval($arParams['OWL2SLIDER_OWL_OPTS_mergeSource']);

if (intval($arParams['OWL2SLIDER_OWL_OPTS_visibleItemsCount']) > 0)
{
	$arParams['OWL2SLIDER_OWL_OPTS_visibleItemsCount'] = intval($arParams['OWL2SLIDER_OWL_OPTS_visibleItemsCount']);
}
elseif (intval($arParams['OWL2SLIDER_OWL_OPTS_VISIBLE_ITEMS_COUNT']) > 0)
{
	$arParams['OWL2SLIDER_OWL_OPTS_visibleItemsCount'] = intval($arParams['OWL2SLIDER_OWL_OPTS_VISIBLE_ITEMS_COUNT']);
}
else
	$arParams['OWL2SLIDER_OWL_OPTS_visibleItemsCount'] = 7;


$arParams['OWL2SLIDER_OWL_OPTS_margin'] = (intval($arParams['OWL2SLIDER_OWL_OPTS_MARGIN']) > 0) ? intval($arParams['OWL2SLIDER_OWL_OPTS_MARGIN']) : intval($arParams['OWL2SLIDER_OWL_OPTS_margin']);
$arParams['OWL2SLIDER_OWL_OPTS_startPosition'] = intval($arParams['OWL2SLIDER_OWL_OPTS_startPosition']);

$arParams['OWL2SLIDER_OWL_OPTS_nav'] = ($arParams['OWL2SLIDER_OWL_OPTS_nav'] != "N") ? "Y" : "N";
$arParams['OWL2SLIDER_OWL_OPTS_navRewind'] = ($arParams['OWL2SLIDER_OWL_OPTS_navRewind'] != "N") ? "Y" : "N";

if (!strlen($arParams['OWL2SLIDER_OWL_OPTS_NAVIGATION_TYPE'])) $arParams['OWL2SLIDER_OWL_OPTS_NAVIGATION_TYPE'] = "arrows";

if (!strlen($arParams['OWL2SLIDER_OWL_OPTS_NAVIGATION_TEXT_BACK']) || $arParams['OWL2SLIDER_OWL_OPTS_NAVIGATION_TYPE'] == "arrows")
	$arParams['OWL2SLIDER_OWL_OPTS_NAVIGATION_TEXT_BACK'] = Loc::getMessage("OWL2SLIDER_OWL_OPTS_NAVIGATION_TEXT_BACK_TEXT");

if (!strlen($arParams['OWL2SLIDER_OWL_OPTS_NAVIGATION_TEXT_NEXT']) || $arParams['OWL2SLIDER_OWL_OPTS_NAVIGATION_TYPE'] == "arrows")
	$arParams['OWL2SLIDER_OWL_OPTS_NAVIGATION_TEXT_NEXT'] = Loc::getMessage("OWL2SLIDER_OWL_OPTS_NAVIGATION_TEXT_NEXT_TEXT");

$arParams['OWL2SLIDER_OWL_OPTS_navText'] = array(
		'"' . $arParams['OWL2SLIDER_OWL_OPTS_NAVIGATION_TEXT_BACK'] . '"',
		'"' . $arParams['OWL2SLIDER_OWL_OPTS_NAVIGATION_TEXT_NEXT'] . '"'
);

if (intval($arParams['OWL2SLIDER_OWL_OPTS_slideBy']) == 0) $arParams['OWL2SLIDER_OWL_OPTS_slideBy'] = '"page"';
if (intval($arParams['OWL2SLIDER_OWL_OPTS_slideBy']) > 0) $arParams['OWL2SLIDER_OWL_OPTS_slideBy'] = intval($arParams['OWL2SLIDER_OWL_OPTS_slideBy']);

$arParams['OWL2SLIDER_OWL_OPTS_dots'] = ($arParams['OWL2SLIDER_OWL_OPTS_dots'] != "N") ? "Y" : "N";
$arParams['OWL2SLIDER_OWL_OPTS_dotsEach'] = ($arParams['OWL2SLIDER_OWL_OPTS_dotsEach'] != "N") ? "Y" : "N";
$arParams['OWL2SLIDER_OWL_OPTS_lazyLoad'] = ($arParams['OWL2SLIDER_OWL_OPTS_lazyLoad'] != "N") ? "Y" : "N";
$arParams['OWL2SLIDER_OWL_OPTS_autoplay'] = ($arParams['OWL2SLIDER_OWL_OPTS_autoplay'] != "N") ? "Y" : "N";

$arParams['OWL2SLIDER_OWL_OPTS_autoplayTimeout'] = (intval($arParams['OWL2SLIDER_OWL_OPTS_autoplayTimeout']) > 0) ? intval($arParams['OWL2SLIDER_OWL_OPTS_autoplayTimeout']) : 5000;
$arParams['OWL2SLIDER_OWL_OPTS_autoplayHoverPause'] = ($arParams['OWL2SLIDER_OWL_OPTS_autoplayHoverPause'] != "N") ? "Y" : "N";

$arParams['OWL2SLIDER_OWL_OPTS_smartSpeed'] = intval($arParams['OWL2SLIDER_OWL_OPTS_smartSpeed']);
$arParams['OWL2SLIDER_OWL_OPTS_autoplaySpeed'] = intval($arParams['OWL2SLIDER_OWL_OPTS_autoplaySpeed']);
$arParams['OWL2SLIDER_OWL_OPTS_navSpeed'] = intval($arParams['OWL2SLIDER_OWL_OPTS_navSpeed']);
$arParams['OWL2SLIDER_OWL_OPTS_dotsSpeed'] = intval($arParams['OWL2SLIDER_OWL_OPTS_dotsSpeed']);
$arParams['OWL2SLIDER_OWL_OPTS_dragEndSpeed'] = intval($arParams['OWL2SLIDER_OWL_OPTS_dragEndSpeed']);

$arParams['OWL2SLIDER_OWL_OPTS_responsive'] = ($arParams['OWL2SLIDER_OWL_OPTS_responsive'] != "N") ? "Y" : "N";
$arParams['OWL2SLIDER_OWL_OPTS_responsiveRefreshRate'] = (intval($arParams['OWL2SLIDER_OWL_OPTS_responsiveRefreshRate']) > 0) ? intval($arParams['OWL2SLIDER_OWL_OPTS_responsiveRefreshRate']) : 200;
if (!strlen($arParams['OWL2SLIDER_OWL_OPTS_responsiveBaseElement'])) $arParams['OWL2SLIDER_OWL_OPTS_responsiveBaseElement'] = "window";

$arParams['OWL2SLIDER_OWL_OPTS_video'] = ($arParams['OWL2SLIDER_OWL_OPTS_video'] != "N") ? "Y" : "N";
$arParams['OWL2SLIDER_OWL_OPTS_videoHeight'] = intval($arParams['OWL2SLIDER_OWL_OPTS_videoHeight']);
$arParams['OWL2SLIDER_OWL_OPTS_videoWidth'] = intval($arParams['OWL2SLIDER_OWL_OPTS_videoWidth']);
$arParams['OWL2SLIDER_OWL_OPTS_videoSource'] = intval($arParams['OWL2SLIDER_OWL_OPTS_videoSource']);

$arParams['OWL2SLIDER_OWL_OPTS_animateOut'] = ($arParams['OWL2SLIDER_OWL_OPTS_animateOut'] != "N") ? "Y" : "N";
$arParams['OWL2SLIDER_OWL_OPTS_animateIn'] = ($arParams['OWL2SLIDER_OWL_OPTS_animateIn'] != "N") ? "Y" : "N";
if (!strlen($arParams['OWL2SLIDER_OWL_OPTS_animateOut_Type'])) $arParams['OWL2SLIDER_OWL_OPTS_animateOut_Type'] = "flipOutX";
if (!strlen($arParams['OWL2SLIDER_OWL_OPTS_animateIn_Type'])) $arParams['OWL2SLIDER_OWL_OPTS_animateIn_Type'] = "flipInX";
if (!strlen($arParams['OWL2SLIDER_OWL_OPTS_fallbackEasing'])) $arParams['OWL2SLIDER_OWL_OPTS_fallbackEasing'] = "swing";

$arParams['OWL2SLIDER_OWL_OPTS_rtl'] = ($arParams['OWL2SLIDER_OWL_OPTS_rtl'] != "N") ? "Y" : "N";
$arParams['OWL2SLIDER_OWL_OPTS_showDescription'] = ($arParams['OWL2SLIDER_OWL_OPTS_showDescription'] != "N") ? "Y" : "N";

$arParams['OWL2SLIDER_LINK_URL_PROPERTY_ID'] = ("dpu" == $arParams['OWL2SLIDER_LINK_URL_PROPERTY_ID']) ? "dpu" : intval($arParams['OWL2SLIDER_LINK_URL_PROPERTY_ID']);
$arParams['OWL2SLIDER_OWL_OPTS_DESCRIPTION_TEXT_SOURCE'] = intval($arParams['OWL2SLIDER_OWL_OPTS_DESCRIPTION_TEXT_SOURCE']);

// - OWL 2 Options


$arResult = array();
$arResult['ITEMS'] = array();

$Asset->addCss('/bitrix/components/custom/owl2slider/css/animate.min.css');
$Asset->addCss('/bitrix/components/custom/owl2slider/css/owl.carousel.min.css');

if ($this->StartResultCache(false, $USER->GetGroups()))
{
	// IBLOCK CONTENT
	if ($arParams['OWL2SLIDER_SOURCE_TYPE'] == 'iblock' && Loader::includeModule("iblock"))
	{
		$arOrder = [];
		foreach ($arParams as $k => $param)
		{
			if (strpos($k, "SORT_FIELD_", 0) === 0)
			{
				$i = str_replace("SORT_FIELD_", "", $k);
				if (strlen($param))
				{
					$arOrder[strtoupper($param)] = $arParams['SORT_DIR_' . $i];
				}
			}
		}

		if (!$arOrder) $arOrder['SORT'] = "ASC";

		$arFilter = array(
				'IBLOCK_ID'   => $arParams['OWL2SLIDER_IBLOCK_ID'],
				'ACTIVE'      => "Y",
				'ACTIVE_DATE' => "Y"
		);

		if ($arParams['OWL2SLIDER_SECTION_ID'])
		{
			$arFilter['SECTION_ID'] = $arParams['OWL2SLIDER_SECTION_ID'];
		}

		if ($arParams['OWL2SLIDER_INCLUDE_SUBSECTIONS'] == "Y")
		{
			$arFilter['INCLUDE_SUBSECTIONS'] = "Y";
		}

		$arSelect = [
				'ID',
				'IBLOCK_ID',
				'LANG_ID',
				'EDIT_LINK',
				'DELETE_LINK',
				'DETAIL_PAGE_URL',
				'NAME',
				'PREVIEW_PICTURE',
				'DETAIL_PICTURE'
		];

		$itemUrlPropID = $arParams['OWL2SLIDER_LINK_URL_PROPERTY_ID'];
		$itemVideoUrlPropID = $arParams['OWL2SLIDER_OWL_OPTS_videoSource'];
		$itemTextPropID = $arParams['OWL2SLIDER_OWL_OPTS_DESCRIPTION_TEXT_SOURCE'];
		$itemMergeCountPropID = $arParams['OWL2SLIDER_OWL_OPTS_mergeSource'];

		if ($itemUrlPropID) $arSelect[] = 'PROPERTY_' . $itemUrlPropID;
		if ($itemVideoUrlPropID) $arSelect[] = 'PROPERTY_' . $itemVideoUrlPropID;
		if ($itemTextPropID) $arSelect[] = 'PROPERTY_' . $itemTextPropID;
		if ($itemMergeCountPropID) $arSelect[] = 'PROPERTY_' . $itemMergeCountPropID;

		$rsItems = CIBlockElement::GetList(
				$arOrder,
				$arFilter,
				false,
				array('nPageSize' => $arParams['OWL2SLIDER_SOURCE_COUNT']),
				$arSelect
		);

		while ($arItem = $rsItems->GetNextElement())
		{
			$value = $arItem->GetFields();
			$value['PROPS'] = $arItem->GetProperties();
			$arResult['ITEMS'][] = $value;
		}
		unset($value);
	} // ADVERTISING CONTENT
	elseif ($arParams['OWL2SLIDER_SOURCE_TYPE'] == 'advert' && Loader::includeModule("advertising"))
	{
		$arFilter = Array(
				"TYPE_SID" => $arParams["OWL2SLIDER_ADVERT_TYPE"],
				"ACTIVE"   => "Y"
		);

		$rsBanners = CAdvBanner::GetList($by = "s_weight", $order = "desc", $arFilter, $is_filtered, "N");

		while ($arBanner = $rsBanners->GetNext())
		{
			$arResult["ITEMS"][] = $arBanner;
		}
	}

	if ($arResult['ITEMS'])
	{
		foreach ($arResult['ITEMS'] as $key => $Item)
		{
			if (isset($itemVideoUrlPropID) && !empty($Item['PROPS'][$itemVideoUrlPropID] ['~VALUE']))
			{
				$itemVideoUrl = parse_url($Item['PROPS'][$itemVideoUrlPropID] ['~VALUE']);
			}
			elseif ($Item['DETAIL_PICTURE'])
			{
				$arResult['ITEMS'][$key]['PICTURE_ID'] = $Item['DETAIL_PICTURE'];
			}
			elseif ($Item['PREVIEW_PICTURE'])
			{
				$arResult['ITEMS'][$key]['PICTURE_ID'] = $Item['PREVIEW_PICTURE'];
			}
			elseif ($Item['IMAGE_ID'])
			{
				$arResult['ITEMS'][$key]['PICTURE_ID'] = $Item['IMAGE_ID'];
			}
			elseif ($Item['AD_TYPE'] == 'html')
			{
				//nothing yet
			}
			else
			{
				unset($arResult['ITEMS'][$key]);
				continue;
			}


			if ($arParams['OWL2SLIDER_OWL_OPTS_USE_RESIZER2'] == "Y" && Loader::includeModule('yenisite.resizer2'))
			{
				$ImgPath = CFile::GetPath($arResult['ITEMS'][$key]['PICTURE_ID']);
				$arResult['ITEMS'][$key]['PICTURE_RESIZED']['src'] = CResizer2Resize::ResizeGD2($ImgPath, $arParams["OWL2SLIDER_OWL_OPTS_RESIZE_LIST_SET"]);

			}
			else
			{
				$arImgSizes = array();

				if (intval($arParams['OWL2SLIDER_OWL_OPTS_RESIZE_WIDTH']) > 0)
				{
					$arImgSizes['width'] = intval($arParams['OWL2SLIDER_OWL_OPTS_RESIZE_WIDTH']);
				}

				if (intval($arParams['OWL2SLIDER_OWL_OPTS_RESIZE_HEIGHT']) > 0)
				{
					$arImgSizes['height'] = intval($arParams['OWL2SLIDER_OWL_OPTS_RESIZE_HEIGHT']);
				}


				$imgResizeType = BX_RESIZE_IMAGE_EXACT;
				if ($arParams['OWL2SLIDER_OWL_OPTS_RESIZE_IS_PROPORTIONAL'] == 'Y')
				{
					$imgResizeType = BX_RESIZE_IMAGE_PROPORTIONAL_ALT;
				}

				$arResult['ITEMS'][$key]['PICTURE_RESIZED'] = CFile::ResizeImageGet($arResult['ITEMS'][$key]['PICTURE_ID'], $arImgSizes, $imgResizeType);
			}

			$arResult['ITEMS'][$key]['ITEM_MERGE_COUNT'] = 1;

			// IBLOCK Items:
			if ($arParams['OWL2SLIDER_SOURCE_TYPE'] == 'iblock')
			{
				$itemUrl = $Item['PROPS'][$itemUrlPropID]['~VALUE'];

				if (0 < intval($itemUrlPropID) && !empty($itemUrl))
				{
					$arResult['ITEMS'][$key]['ITEM_URL'] = $Item['PROPS'][$itemUrlPropID] ['~VALUE'];
				}
				elseif ('dpu' == $itemUrlPropID)//DETAIL_PAGE_URL
				{
					$arResult['ITEMS'][$key]['ITEM_URL'] = $Item['DETAIL_PAGE_URL'];
				}
				else
				{
					$arResult['ITEMS'][$key]['ITEM_URL'] = '';
				}

				if (!empty($Item['PROPS'][$itemTextPropID] ['VALUE']))
				{
					$arResult['ITEMS'][$key]['ITEM_TEXT'] = $Item['PROPS'][$itemTextPropID] ['VALUE']['TEXT'];
				}
				else
				{
					$arResult['ITEMS'][$key]['ITEM_TEXT'] = $Item['NAME'];
				}

				if (isset($itemVideoUrl) && preg_match('/(player.|www.)?(vimeo\.com|youtu(be\.com|\.be|be\.googleapis\.com))/', $itemVideoUrl['host']))
				{
					$arResult['ITEMS'][$key]['ITEM_VIDEO_URL'] = $Item['PROPS'][$itemVideoUrlPropID] ['~VALUE'];
				}
				else
				{
					$arResult['ITEMS'][$key]['ITEM_VIDEO_URL'] = "";
				}

				if ($Item['PROPS'][$itemMergeCountPropID] ['~VALUE'])
				{
					$arResult['ITEMS'][$key]['ITEM_MERGE_COUNT'] = (intval($Item['PROPS'][$itemMergeCountPropID] ['~VALUE']) == 0) ? 1 : intval($Item['PROPS'][$itemMergeCountPropID] ['~VALUE']);
				}

			}
			$arResult['ITEMS'][$key]['ITEM_URL_TARGET'] = ($Item['URL_TARGET'] == '') ? '_self' : $Item['URL_TARGET'];
		}
		if (count($arResult['ITEMS']) < $arParams['OWL2SLIDER_OWL_OPTS_visibleItemsCount']) $arParams['OWL2SLIDER_OWL_OPTS_visibleItemsCount'] = count($arResult['ITEMS']);
	}

	$this->IncludeComponentTemplate();
}

if ($arParams['OWL2SLIDER_USE_JQUERY'] == "Y")
{
	$Asset->addJs('/bitrix/components/custom/owl2slider/js/jquery.min.js');
}
$Asset->addJs('/bitrix/components/custom/owl2slider/js/owl.carousel.min.js', true);

