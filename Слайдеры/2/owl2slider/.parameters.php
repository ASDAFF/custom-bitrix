<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
use
		\Bitrix\Main\Localization\Loc,
		\Bitrix\Main\Loader;

Loc::loadMessages(__FILE__);

if (!$bIblock = Loader::includeModule("iblock"))
{
	return;
}
$bAdvert = Loader::includeModule("advertising");


// getting all types of iblocks
$arIBlockTypes = array(0 => Loc::getMessage("OWL2SLIDER_NONE"));
$rsIBlockTypes = CIBlockType::GetList(array("sort" => "asc"), array("ACTIVE" => "Y"));
while ($arIBlockType = $rsIBlockTypes->Fetch())
{
	if ($arIBlockTData = CIBlockType::GetByIDLang($arIBlockType["ID"], LANGUAGE_ID))
	{
		$arIBlockTypes[$arIBlockType["ID"]] = "[" . $arIBlockType["ID"] . "] " . $arIBlockTData["NAME"];
	}
}

// getting all iblocks
$arIBlocks = array(0 => Loc::getMessage("OWL2SLIDER_NONE"));
$IBlockFilter = array("ACTIVE" => "Y");
if ($arCurrentValues["OWL2SLIDER_IBLOCK_TYPE"])
{
	$IBlockFilter["TYPE"] = $arCurrentValues["OWL2SLIDER_IBLOCK_TYPE"];
}
$rsIBlock = CIBlock::GetList(Array("sort" => "asc"), $IBlockFilter);
while ($arIBlock = $rsIBlock->Fetch())
{
	$arIBlocks[$arIBlock["ID"]] = "[" . $arIBlock["ID"] . "] " . $arIBlock["NAME"];
}


// getting all sections
$arSections = array(false => Loc::getMessage("OWL2SLIDER_VSE_RAZDELY"));
if (intval($arCurrentValues['OWL2SLIDER_IBLOCK_ID']) > 0)
{
	$filter = array(
			"IBLOCK_ID"     => intval($arCurrentValues['OWL2SLIDER_IBLOCK_ID']),
			"ACTIVE"        => "Y",
			"IBLOCK_ACTIVE" => "Y",
	);
	$arOrder = array('left_margin' => "ASC", "NAME" => "ASC");
	$rsSections = CIBlockSection::GetList($arOrder, $filter);

	while ($arSection = $rsSections->GetNext())
	{
		$arSections[$arSection["ID"]] = str_repeat(". ", $arSection['DEPTH_LEVEL'] - 1) . "[" . $arSection["ID"] . "] " . htmlspecialcharsback($arSection["NAME"]);
	}
}


// getting element properties
$arProperties = array(0 => Loc::getMessage("OWL2SLIDER_NE_ISPOLQZOVATQ"));
$rsProp = CIBlockProperty::GetList(Array("sort" => "asc", "name" => "asc"), Array("ACTIVE" => "Y", "IBLOCK_ID" => $arCurrentValues["OWL2SLIDER_IBLOCK_ID"]));
while ($arr = $rsProp->Fetch()) $arProperties[$arr["ID"]] = "[" . ($arr["CODE"] ? $arr["CODE"] : $arr["ID"]) . "] " . $arr["NAME"];
$arrAnimateFallbackEasing = array(
		"swing"   => "swing",
		"fadeIn"  => "fadeIn",
		"fadeOut" => "fadeOut",

);


$arrAnimate3D_Types = array(
	// "attention_seekers":
	"bounce"             => "bounce",
	"flash"              => "flash",
	"pulse"              => "pulse",
	"rubberBand"         => "rubberBand",
	"shake"              => "shake",
	"swing"              => "swing",
	"tada"               => "tada",
	"wobble"             => "wobble",

	//  "bouncing_entrances":
	"bounceIn"           => "bounceIn",
	"bounceInDown"       => "bounceInDown",
	"bounceInLeft"       => "bounceInLeft",
	"bounceInRight"      => "bounceInRight",
	"bounceInUp"         => "bounceInUp",

	//  "bouncing_exits":
	"bounceOut"          => "bounceOut",
	"bounceOutDown"      => "bounceOutDown",
	"bounceOutLeft"      => "bounceOutLeft",
	"bounceOutRight"     => "bounceOutRight",
	"bounceOutUp"        => "bounceOutUp",

	//  "fading_entrances":
	"fadeIn"             => "fadeIn",
	"fadeInDown"         => "fadeInDown",
	"fadeInDownBig"      => "fadeInDownBig",
	"fadeInLeft"         => "fadeInLeft",
	"fadeInLeftBig"      => "fadeInLeftBig",
	"fadeInRight"        => "fadeInRight",
	"fadeInRightBig"     => "fadeInRightBig",
	"fadeInUp"           => "fadeInUp",
	"fadeInUpBig"        => "fadeInUpBig",

	//  "fading_exits":
	"fadeOut"            => "fadeOut",
	"fadeOutDown"        => "fadeOutDown",
	"fadeOutDownBig"     => "fadeOutDownBig",
	"fadeOutLeft"        => "fadeOutLeft",
	"fadeOutLeftBig"     => "fadeOutLeftBig",
	"fadeOutRight"       => "fadeOutRight",
	"fadeOutRightBig"    => "fadeOutRightBig",
	"fadeOutUp"          => "fadeOutUp",
	"fadeOutUpBig"       => "fadeOutUpBig",

	//  "flippers":
	"flip"               => "flip",
	"flipInX"            => "flipInX",
	"flipInY"            => "flipInY",
	"flipOutX"           => "flipOutX",
	"flipOutY"           => "flipOutY",

	//  "lightspeed":
	"lightSpeedIn"       => "lightSpeedIn",
	"lightSpeedOut"      => "lightSpeedOut",

	//  "rotating_entrances":
	"rotateIn"           => "rotateIn",
	"rotateInDownLeft"   => "rotateInDownLeft",
	"rotateInDownRight"  => "rotateInDownRight",
	"rotateInUpLeft"     => "rotateInUpLeft",
	"rotateInUpRight"    => "rotateInUpRight",

	//  "rotating_exits":
	"rotateOut"          => "rotateOut",
	"rotateOutDownLeft"  => "rotateOutDownLeft",
	"rotateOutDownRight" => "rotateOutDownRight",
	"rotateOutUpLeft"    => "rotateOutUpLeft",

	//  "specials":
	"hinge"              => "hinge",
	"rollIn"             => "rollIn",
	"rollOut"            => "rollOut",

	//  "zooming_entrances":
	"zoomIn"             => "zoomIn",
	"zoomInDown"         => "zoomInDown",
	"zoomInLeft"         => "zoomInLeft",
	"zoomInRight"        => "zoomInRight",
	"zoomInUp"           => "zoomInUp",

	//  "zooming_exits":
	"zoomOut"            => "zoomOut",
	"zoomOutDown"        => "zoomOutDown",
	"zoomOutLeft"        => "zoomOutLeft",
	"zoomOutRight"       => "zoomOutRight",
	"zoomOutUp"          => "zoomOutUp",

	//  "sliding_entrances":
	"slideInDown"        => "slideInDown",
	"slideInLeft"        => "slideInLeft",
	"slideInRight"       => "slideInRight",
	"slideInUp"          => "slideInUp",

	//  "sliding_exits":
	"slideOutDown"       => "slideOutDown",
	"slideOutLeft"       => "slideOutLeft",
	"slideOutRight"      => "slideOutRight",
	"slideOutUp"         => "slideOutUp",
);

$arDataSource = array(
		"none"   => Loc::getMessage("OWL2SLIDER_NONE"),
		"iblock" => Loc::getMessage("OWL2SLIDER_SOURCE_TYPE_IBLOCK")
);

if ($bAdvert)
{
	$arDataSource["advert"] = Loc::getMessage("OWL2SLIDER_SOURCE_TYPE_BANNERS");
}

$arComponentParameters = array(
		"GROUPS"     => array(
				"DATA_SOURCE" => array(
						"NAME" => Loc::getMessage("OWL2SLIDER_DATA_SOURCE_GP"),
						'SORT' => '150'
				),
				"SORTING"     => array(
						"NAME" => Loc::getMessage("OWL2SLIDER_SORTIROVKA_ELEMENTOV"),
						'SORT' => '200'
				),
				"VISUAL"      => array(
						"NAME" => Loc::getMessage("OWL2SLIDER_VISUAL_GP"),
						'SORT' => '300'
				),
				"RESPONSIVE"  => array(
						"NAME" => Loc::getMessage("OWL2SLIDER_DATA_RESPONSIVE_GP"),
						'SORT' => '350'
				),
				"RESIZING"    => array(
						"NAME" => Loc::getMessage("OWL2SLIDER_DATA_RESIZING_GP"),
						'SORT' => '370'
				)
		),
		"PARAMETERS" => array(
				"OWL2SLIDER_SOURCE_TYPE"  => array(
						"PARENT"  => "DATA_SOURCE",
						"NAME"    => Loc::getMessage("OWL2SLIDER_SOURCE_TYPE"),
						"TYPE"    => "LIST",
						"VALUES"  => $arDataSource,
						"REFRESH" => "Y",
						"DEFAULT" => "none",
				),
				"OWL2SLIDER_SOURCE_COUNT" => array(
						"PARENT"            => "DATA_SOURCE",
						"NAME"              => Loc::getMessage("OWL2SLIDER_SOURCE_COUNT"),
						"TYPE"              => "STRING",
						"MULTIPLE"          => "N",
						"ADDITIONAL_VALUES" => "N",
						"DEFAULT"           => "8",
				),

				"OWL2SLIDER_EXPERT_MODE"                      => array(
						"PARENT"  => "ADDITIONAL_SETTINGS",
						"NAME"    => Loc::getMessage("OWL2SLIDER_EXPERT_MODE"),
						"TYPE"    => "CHECKBOX",
						"DEFAULT" => "N",
						"REFRESH" => "Y"
				),
				"OWL2SLIDER_UNIQUE_SUFFIX"                    => array(
						"PARENT"            => "ADDITIONAL_SETTINGS",
						"NAME"              => Loc::getMessage("OWL2SLIDER_UNIQUE_SUFFIX"),
						"TYPE"              => "STRING",
						"MULTIPLE"          => "N",
						"ADDITIONAL_VALUES" => "N",
						"DEFAULT"           => generateRandomString(),
				),
				"OWL2SLIDER_USE_JQUERY"                       => array(
						"PARENT"  => "ADDITIONAL_SETTINGS",
						"NAME"    => Loc::getMessage("OWL2SLIDER_USE_JQUERY"),
						"TYPE"    => "CHECKBOX",
						"DEFAULT" => "N",
				),
            "OWL2SLIDER_USE_OWL_CAROUSEL"                       => array(
                "PARENT"  => "ADDITIONAL_SETTINGS",
                "NAME"    => Loc::getMessage("OWL2SLIDER_USE_OWL_CAROUSEL"),
                "TYPE"    => "CHECKBOX",
                "DEFAULT" => "N",
            ),
				"OWL2SLIDER_OWL_OPTS_visibleItemsCount"       => array(
						"PARENT"            => "VISUAL",
						"NAME"              => Loc::getMessage("OWL2SLIDER_OWL_OPTS_visibleItemsCount"),
						"TYPE"              => "LIST",
						"MULTIPLE"          => "N",
						"ADDITIONAL_VALUES" => "Y",
						"DEFAULT"           => "3",
						"VALUES"            => array(
								"1" => "1",
								"3" => "3",
								"5" => "5"
						),
						"REFRESH"           => "Y",
				),
				"OWL2SLIDER_OWL_OPTS_margin"                  => array(
						"PARENT"            => "VISUAL",
						"NAME"              => Loc::getMessage("OWL2SLIDER_OWL_OPTS_margin"),
						"TYPE"              => "STRING",
						"MULTIPLE"          => "N",
						"ADDITIONAL_VALUES" => "N",
						"DEFAULT"           => "5",
				),
				"OWL2SLIDER_OWL_OPTS_loop"                    => array(
						"PARENT"  => "VISUAL",
						"NAME"    => Loc::getMessage("OWL2SLIDER_OWL_OPTS_loop"),
						"TYPE"    => "CHECKBOX",
						"DEFAULT" => "Y",
				),
				"OWL2SLIDER_OWL_OPTS_center"                  => array(
						"PARENT"  => "VISUAL",
						"NAME"    => Loc::getMessage("OWL2SLIDER_OWL_OPTS_center"),
						"TYPE"    => "CHECKBOX",
						"DEFAULT" => "Y",
				),
				"OWL2SLIDER_OWL_OPTS_startPosition"           => array(
						"PARENT"            => "VISUAL",
						"NAME"              => Loc::getMessage("OWL2SLIDER_OWL_OPTS_startPosition"),
						"TYPE"              => "STRING",
						"MULTIPLE"          => "N",
						"ADDITIONAL_VALUES" => "N",
						"DEFAULT"           => "0",
				),
				"OWL2SLIDER_OWL_OPTS_nav"                     => array(
						"PARENT"  => "VISUAL",
						"NAME"    => Loc::getMessage("OWL2SLIDER_OWL_OPTS_nav"),
						"TYPE"    => "CHECKBOX",
						"DEFAULT" => "Y",
						"REFRESH" => "Y",
				),
				"OWL2SLIDER_OWL_OPTS_slideBy"                 => array(
						"PARENT"            => "VISUAL",
						"NAME"              => Loc::getMessage("OWL2SLIDER_OWL_OPTS_slideBy"),
						"TYPE"              => "STRING",
						"MULTIPLE"          => "N",
						"ADDITIONAL_VALUES" => "N",
						"DEFAULT"           => "1",
				),
				"OWL2SLIDER_OWL_OPTS_dots"                    => array(
						"PARENT"  => "VISUAL",
						"NAME"    => Loc::getMessage("OWL2SLIDER_OWL_OPTS_dots"),
						"TYPE"    => "CHECKBOX",
						"DEFAULT" => "Y",
				),
				"OWL2SLIDER_OWL_OPTS_dotsEach"                => array(
						"PARENT"  => "VISUAL",
						"NAME"    => Loc::getMessage("OWL2SLIDER_OWL_OPTS_dotsEach"),
						"TYPE"    => "CHECKBOX",
						"DEFAULT" => "N",
				),
				"OWL2SLIDER_OWL_OPTS_autoplay"                => array(
						"PARENT"  => "VISUAL",
						"NAME"    => Loc::getMessage("OWL2SLIDER_OWL_OPTS_autoplay"),
						"TYPE"    => "CHECKBOX",
						"DEFAULT" => "Y",
				),
				"OWL2SLIDER_OWL_OPTS_responsive"              => array(
						"PARENT"  => "RESPONSIVE",
						"NAME"    => Loc::getMessage("OWL2SLIDER_OWL_OPTS_responsive"),
						"TYPE"    => "CHECKBOX",
						"DEFAULT" => "Y",
						"REFRESH" => "Y",
				),
				"OWL2SLIDER_OWL_OPTS_video"                   => array(
						"PARENT"  => "VISUAL",
						"NAME"    => Loc::getMessage("OWL2SLIDER_OWL_OPTS_video"),
						"TYPE"    => "CHECKBOX",
						"DEFAULT" => "N",
						"REFRESH" => "Y",
				),
				"OWL2SLIDER_OWL_OPTS_rtl"                     => array(
						"PARENT"  => "VISUAL",
						"NAME"    => Loc::getMessage("OWL2SLIDER_OWL_OPTS_rtl"),
						"TYPE"    => "CHECKBOX",
						"DEFAULT" => "N",
				),
				"OWL2SLIDER_OWL_OPTS_showDescription"         => array(
						"PARENT"  => "VISUAL",
						"NAME"    => Loc::getMessage("OWL2SLIDER_OWL_OPTS_showDescription"),
						"TYPE"    => "CHECKBOX",
						"DEFAULT" => "Y",
				),
				"OWL2SLIDER_OWL_OPTS_DESCRIPTION_TEXT_SOURCE" => array(
						"PARENT"            => "VISUAL",
						"NAME"              => Loc::getMessage("OWL2SLIDER_OWL_OPTS_DESCRIPTION_TEXT_SOURCE"),
						"TYPE"              => "LIST",
						"MULTIPLE"          => "N",
						"ADDITIONAL_VALUES" => "N",
						"VALUES"            => $arProperties,
						"REFRESH"           => "N",
				),
				"OWL2SLIDER_OWL_OPTS_USE_RESIZE"              => array(
						"PARENT"  => "RESIZING",
						"NAME"    => Loc::getMessage("OWL2SLIDER_OWL_OPTS_USE_RESIZE"),
						"TYPE"    => "CHECKBOX",
						"DEFAULT" => "N",
						"REFRESH" => "Y",
				),
				"CACHE_TIME"                                  => array("DEFAULT" => 3600),
		),
);


$bExpertMode = false;
if ($arCurrentValues['OWL2SLIDER_EXPERT_MODE'] !== 'N')
{
	$bExpertMode = true;
	$arComponentParameters['PARAMETERS'] = array_merge(
			$arComponentParameters['PARAMETERS'],
			[
					"OWL2SLIDER_COMPOSITE"                      => array(
							"PARENT"  => "ADDITIONAL_SETTINGS",
							"NAME"    => Loc::getMessage("OWL2SLIDER_COMPOSITE"),
							"TYPE"    => "CHECKBOX",
							"DEFAULT" => "N",
					),
					"OWL2SLIDER_OWL_OPTS_mouseDrag"             => array(
							"PARENT"  => "VISUAL",
							"NAME"    => Loc::getMessage("OWL2SLIDER_OWL_OPTS_mouseDrag"),
							"TYPE"    => "CHECKBOX",
							"DEFAULT" => "Y",
					),
					"OWL2SLIDER_OWL_OPTS_touchDrag"             => array(
							"PARENT"  => "VISUAL",
							"NAME"    => Loc::getMessage("OWL2SLIDER_OWL_OPTS_touchDrag"),
							"TYPE"    => "CHECKBOX",
							"DEFAULT" => "Y",
					),
					"OWL2SLIDER_OWL_OPTS_pullDrag"              => array(
							"PARENT"  => "VISUAL",
							"NAME"    => Loc::getMessage("OWL2SLIDER_OWL_OPTS_pullDrag"),
							"TYPE"    => "CHECKBOX",
							"DEFAULT" => "Y",
					),
					"OWL2SLIDER_OWL_OPTS_freeDrag"              => array(
							"PARENT"  => "VISUAL",
							"NAME"    => Loc::getMessage("OWL2SLIDER_OWL_OPTS_freeDrag"),
							"TYPE"    => "CHECKBOX",
							"DEFAULT" => "N",
					),
					"OWL2SLIDER_OWL_OPTS_merge"                 => array(
							"PARENT"  => "VISUAL",
							"NAME"    => Loc::getMessage("OWL2SLIDER_OWL_OPTS_merge"),
							"TYPE"    => "CHECKBOX",
							"DEFAULT" => "N",
							"REFRESH" => "Y",
					),
					"OWL2SLIDER_OWL_OPTS_autoWidth"             => array(
							"PARENT"  => "VISUAL",
							"NAME"    => Loc::getMessage("OWL2SLIDER_OWL_OPTS_autoWidth"),
							"TYPE"    => "CHECKBOX",
							"DEFAULT" => "N",
					),
					"OWL2SLIDER_OWL_OPTS_navRewind"             => array(
							"PARENT"  => "VISUAL",
							"NAME"    => Loc::getMessage("OWL2SLIDER_OWL_OPTS_navRewind"),
							"TYPE"    => "CHECKBOX",
							"DEFAULT" => "Y",
					),
					"OWL2SLIDER_OWL_OPTS_autoplayTimeout"       => array(
							"PARENT"            => "VISUAL",
							"NAME"              => Loc::getMessage("OWL2SLIDER_OWL_OPTS_autoplayTimeout"),
							"TYPE"              => "STRING",
							"MULTIPLE"          => "N",
							"ADDITIONAL_VALUES" => "N",
							"DEFAULT"           => "5000",
					),
					"OWL2SLIDER_OWL_OPTS_autoplayHoverPause"    => array(
							"PARENT"  => "VISUAL",
							"NAME"    => Loc::getMessage("OWL2SLIDER_OWL_OPTS_autoplayHoverPause"),
							"TYPE"    => "CHECKBOX",
							"DEFAULT" => "Y",
					),
					"OWL2SLIDER_OWL_OPTS_smartSpeed"            => array(
							"PARENT"            => "VISUAL",
							"NAME"              => Loc::getMessage("OWL2SLIDER_OWL_OPTS_smartSpeed"),
							"TYPE"              => "STRING",
							"MULTIPLE"          => "N",
							"ADDITIONAL_VALUES" => "N",
							"DEFAULT"           => "250",
					),
					"OWL2SLIDER_OWL_OPTS_autoplaySpeed"         => array(
							"PARENT"            => "VISUAL",
							"NAME"              => Loc::getMessage("OWL2SLIDER_OWL_OPTS_autoplaySpeed"),
							"TYPE"              => "STRING",
							"MULTIPLE"          => "N",
							"ADDITIONAL_VALUES" => "N",
							"DEFAULT"           => "3000",
					),
					"OWL2SLIDER_OWL_OPTS_dotsSpeed"             => array(
							"PARENT"            => "VISUAL",
							"NAME"              => Loc::getMessage("OWL2SLIDER_OWL_OPTS_dotsSpeed"),
							"TYPE"              => "STRING",
							"MULTIPLE"          => "N",
							"ADDITIONAL_VALUES" => "N",
							"DEFAULT"           => "",
					),
					"OWL2SLIDER_OWL_OPTS_dragEndSpeed"          => array(
							"PARENT"            => "VISUAL",
							"NAME"              => Loc::getMessage("OWL2SLIDER_OWL_OPTS_dragEndSpeed"),
							"TYPE"              => "STRING",
							"MULTIPLE"          => "N",
							"ADDITIONAL_VALUES" => "N",
							"DEFAULT"           => "",
					),
					"OWL2SLIDER_OWL_OPTS_responsiveRefreshRate" => array(
							"PARENT"            => "RESPONSIVE",
							"NAME"              => Loc::getMessage("OWL2SLIDER_OWL_OPTS_responsiveRefreshRate"),
							"TYPE"              => "STRING",
							"MULTIPLE"          => "N",
							"ADDITIONAL_VALUES" => "N",
							"DEFAULT"           => "200",
					),
					"OWL2SLIDER_OWL_OPTS_responsiveBaseElement" => array(
							"PARENT"            => "RESPONSIVE",
							"NAME"              => Loc::getMessage("OWL2SLIDER_OWL_OPTS_responsiveBaseElement"),
							"TYPE"              => "STRING",
							"MULTIPLE"          => "N",
							"ADDITIONAL_VALUES" => "N",
							"DEFAULT"           => "window",
					),
					"OWL2SLIDER_OWL_OPTS_fallbackEasing"        => array(
							"PARENT"            => "VISUAL",
							"NAME"              => Loc::getMessage("OWL2SLIDER_OWL_OPTS_fallbackEasing"),
							"TYPE"              => "LIST",
							"MULTIPLE"          => "N",
							"ADDITIONAL_VALUES" => "N",
							"DEFAULT"           => "swing",
							"VALUES"            => $arrAnimateFallbackEasing,
					),
					"OWL2SLIDER_OWL_OPTS_stagePadding"          => array(
							"PARENT"            => "VISUAL",
							"NAME"              => Loc::getMessage("OWL2SLIDER_OWL_OPTS_stagePadding"),
							"TYPE"              => "STRING",
							"MULTIPLE"          => "N",
							"ADDITIONAL_VALUES" => "N",
							"DEFAULT"           => "0",
					),
					"OWL2SLIDER_OWL_OPTS_lazyLoad"              => array(
							"PARENT"  => "VISUAL",
							"NAME"    => Loc::getMessage("OWL2SLIDER_OWL_OPTS_lazyLoad"),
							"TYPE"    => "CHECKBOX",
							"DEFAULT" => "N",
					)
			]);
}

//Advert
if ($arCurrentValues['OWL2SLIDER_SOURCE_TYPE'] == "advert" && $bAdvert)
{
	$arAdvertTypeFields = Array("" => Loc::getMessage("OWL2SLIDER_NONE"));
	$resAdvTypes = CAdvType::GetList($by, $order, Array("ACTIVE" => "Y"), $is_filtered, "Y");
	while ($arAdvType = $resAdvTypes->GetNext())
	{
		$arAdvertTypeFields[$arAdvType["SID"]] = "[" . $arAdvType["SID"] . "] " . $arAdvType["NAME"];
	}
	$arComponentParameters['PARAMETERS']['OWL2SLIDER_ADVERT_TYPE'] = array(
			"PARENT"  => "DATA_SOURCE ",
			"NAME"    => Loc::getMessage("OWL2SLIDER_ADVERT_TYPE"),
			"TYPE"    => "LIST",
			"VALUES"  => $arAdvertTypeFields,
			"REFRESH" => "Y",
	);
}

//IBlock
if ($arCurrentValues['OWL2SLIDER_SOURCE_TYPE'] == "iblock" && $bIblock)
{

	$arComponentParameters['PARAMETERS']['OWL2SLIDER_IBLOCK_TYPE'] = array(
			"PARENT"  => "DATA_SOURCE",
			"NAME"    => Loc::getMessage("OWL2SLIDER_IBLOCK_TYPE"),
			"TYPE"    => "LIST",
			"VALUES"  => $arIBlockTypes,
			"REFRESH" => "Y",
	);

	$arComponentParameters['PARAMETERS']['OWL2SLIDER_IBLOCK_ID'] = array(
			"PARENT"            => "DATA_SOURCE",
			"NAME"              => Loc::getMessage("OWL2SLIDER_IBLOCK_ID"),
			"TYPE"              => "LIST",
			"MULTIPLE"          => "N",
			"ADDITIONAL_VALUES" => "N",
			"VALUES"            => $arIBlocks,
			"REFRESH"           => "Y",
	);

	if (intval($arCurrentValues['OWL2SLIDER_IBLOCK_ID']) > 0)
	{
		$arValues = $arProperties;
		$arValues["dpu"] = "[DETAIL_PAGE_URL] Element URL";
		$arComponentParameters['PARAMETERS']['OWL2SLIDER_LINK_URL_PROPERTY_ID'] = array(
				"PARENT"            => "DATA_SOURCE",
				"NAME"              => Loc::getMessage("OWL2SLIDER_LINK_URL_PROPERTY_ID"),
				"TYPE"              => "LIST",
				"MULTIPLE"          => "N",
				"ADDITIONAL_VALUES" => "N",
				"VALUES"            => $arValues,
				"REFRESH"           => "N",
		);
		unset($arValues);
		$arComponentParameters['PARAMETERS']['OWL2SLIDER_SECTION_ID'] = array(
				"PARENT"            => "DATA_SOURCE",
				"NAME"              => Loc::getMessage("OWL2SLIDER_SECTION_ID"),
				"TYPE"              => "LIST",
				"MULTIPLE"          => "N",
				"ADDITIONAL_VALUES" => "N",
				"VALUES"            => $arSections,
				"REFRESH"           => "N",
		);

		$arComponentParameters['PARAMETERS']['OWL2SLIDER_INCLUDE_SUBSECTIONS'] = array(
				"PARENT"  => "DATA_SOURCE",
				"NAME"    => Loc::getMessage("OWL2SLIDER_INCLUDE_SUBSECTIONS"),
				"TYPE"    => "CHECKBOX",
				"DEFAULT" => "Y",
		);

		$arSortingDir = array(
				'asc'        => Loc::getMessage("OWL2SLIDER_PO_VOZRASTANIU"),
				'nulls,asc'  => Loc::getMessage("OWL2SLIDER_PO_VOZRASTANIU_PUST"),
				'asc,nulls'  => Loc::getMessage("OWL2SLIDER_PO_VOZRASTANIU_PUST1"),
				'desc'       => Loc::getMessage("OWL2SLIDER_PO_UBYVANIU"),
				'nulls,desc' => Loc::getMessage("OWL2SLIDER_PO_UBYVANIU_PUSTYE"),
				'desc,nulls' => Loc::getMessage("OWL2SLIDER_PO_UBYVANIU_PUSTYE1"),
		);

		$arSortingFields = array(
				"sort"               => Loc::getMessage("OWL2SLIDER_SORTBY_SORT"),
				"id"                 => "ID",
				"timestamp_x"        => Loc::getMessage("OWL2SLIDER_SORTBY_POSLEDNEE_IZMENENIE"),
				"name"               => Loc::getMessage("OWL2SLIDER_SORTBY_NAZVANIE"),
				"active_from"        => Loc::getMessage("OWL2SLIDER_SORTBY_DATA_NACALA_AKTIVNOS"),
				"active_to"          => Loc::getMessage("OWL2SLIDER_SORTBY_DATA_OKONCANIA_AKTIV"),
				"show_counter_start" => Loc::getMessage("OWL2SLIDER_SORTBY_VREMA_PERVOGO_POKAZA"),
				"shows"              => Loc::getMessage("OWL2SLIDER_SORTBY_USREDNENNOE_KOLICEST"),
				"rand"               => Loc::getMessage("OWL2SLIDER_SORTBY_SLUCAYNYM_OBRAZOM"),
		);

		if ($arCurrentValues["OWL2SLIDER_IBLOCK_ID"] > 0)
		{
			$rsProps = CIBlockProperty::GetList(array("NAME" => "ASC"), array("IBLOCK_ID" => $arCurrentValues["OWL2SLIDER_IBLOCK_ID"]));
			while ($arProp = $rsProps->GetNext())
			{
				$arSortingFields['property_' . $arProp['ID']] = Loc::getMessage("OWL2SLIDER_SVOYSTVO") . $arProp['NAME'];
			}
		}

		if (empty($arCurrentValues['SORT_FIELD_1'])) $arCurrentValues['SORT_FIELD_1'] = "id";
		$count = 1;
		do
		{
			if ($count == 2)
			{
				$arSortingFields = array_merge(array("" => Loc::getMessage("OWL2SLIDER_NE_ISPOLQZOVATQ")), $arSortingFields);
			}
			$arComponentParameters['PARAMETERS']["SORT_FIELD_" . $count] = array(
					"PARENT"            => "SORTING",
					"NAME"              => Loc::getMessage("OWL2SLIDER_POLE_DLA_SORTIROVKI") . $count,
					"TYPE"              => "LIST",
					"MULTIPLE"          => "N",
					"ADDITIONAL_VALUES" => "N",
					"VALUES"            => $arSortingFields,
					"REFRESH"           => "Y",
			);
			if ($count == 1)
			{
				$arComponentParameters['PARAMETERS']["SORT_FIELD_" . $count]['DEFAULT'] = "id";
			}
			$arComponentParameters['PARAMETERS']["SORT_DIR_" . $count] = array(
					"PARENT"            => "SORTING",
					"NAME"              => Loc::getMessage("OWL2SLIDER_NAPRAVLENIE_SORTIROV") . $count,
					"TYPE"              => "LIST",
					"MULTIPLE"          => "N",
					"DEFAULT"           => "DESC",
					"ADDITIONAL_VALUES" => "N",
					"VALUES"            => $arSortingDir,
					"REFRESH"           => "N",
			);
			$count++;
		} while (strlen($arCurrentValues['SORT_FIELD_' . ($count - 1)]));
	}
}

//OPT NAV
if ($arCurrentValues['OWL2SLIDER_OWL_OPTS_nav'] == 'Y')
{
	$arComponentParameters['GROUPS']['NAV_OPTS'] = array(
			"NAME" => Loc::getMessage("OWL2SLIDER_NAV_OPTS_GP"),
			'SORT' => '310'
	);

	$arComponentParameters['PARAMETERS']["OWL2SLIDER_OWL_OPTS_NAVIGATION_TYPE"] = array(
			"PARENT"            => "NAV_OPTS",
			"NAME"              => Loc::getMessage("OWL2SLIDER_OWL_OPTS_NAVIGATION_TYPE"),
			"TYPE"              => "LIST",
			"MULTIPLE"          => "N",
			"ADDITIONAL_VALUES" => "N",
			"DEFAULT"           => "arrows",
			"VALUES"            => array(
					"arrows" => Loc::getMessage("OWL2SLIDER_OWL_OPTS_NAVIGATION_TYPE_ARROWS"),
					"text"   => Loc::getMessage("OWL2SLIDER_OWL_OPTS_NAVIGATION_TYPE_TEXT"),
			),
			"REFRESH"           => "Y",
	);
	if ($arCurrentValues['OWL2SLIDER_OWL_OPTS_NAVIGATION_TYPE'] == 'text')
	{

		$arComponentParameters['PARAMETERS']['OWL2SLIDER_OWL_OPTS_NAVIGATION_TEXT_BACK'] = array(
				"PARENT"            => "NAV_OPTS",
				"NAME"              => Loc::getMessage("OWL2SLIDER_OWL_OPTS_NAVIGATION_TEXT_BACK"),
				"TYPE"              => "STRING",
				"MULTIPLE"          => "N",
				"ADDITIONAL_VALUES" => "N",
				"DEFAULT"           => Loc::getMessage("OWL2SLIDER_OWL_OPTS_NAVIGATION_TEXT_BACK_TEXT"),
		);

		$arComponentParameters['PARAMETERS']['OWL2SLIDER_OWL_OPTS_NAVIGATION_TEXT_NEXT'] = array(
				"PARENT"            => "NAV_OPTS",
				"NAME"              => Loc::getMessage("OWL2SLIDER_OWL_OPTS_NAVIGATION_TEXT_NEXT"),
				"TYPE"              => "STRING",
				"MULTIPLE"          => "N",
				"ADDITIONAL_VALUES" => "N",
				"DEFAULT"           => Loc::getMessage("OWL2SLIDER_OWL_OPTS_NAVIGATION_TEXT_NEXT_TEXT"),
		);
	}

	if ($bExpertMode)
	{
		$arComponentParameters['PARAMETERS']['OWL2SLIDER_OWL_OPTS_navSpeed'] = array(
				"PARENT"            => "NAV_OPTS",
				"NAME"              => Loc::getMessage("OWL2SLIDER_OWL_OPTS_navSpeed"),
				"TYPE"              => "STRING",
				"MULTIPLE"          => "N",
				"ADDITIONAL_VALUES" => "N",
				"DEFAULT"           => "300",
		);
	}

}

//OPT Single ITEM to SHOW
if (intval($arCurrentValues['OWL2SLIDER_OWL_OPTS_visibleItemsCount']) == 1)
{
	$arComponentParameters['GROUPS']['SINGLE_ITEM_OPTS'] = array(
			"NAME" => Loc::getMessage("OWL2SLIDER_SINGLE_ITEM_GP"),
			'SORT' => '310'
	);

	$arComponentParameters['PARAMETERS']['OWL2SLIDER_OWL_OPTS_animateOut'] = array(
			"PARENT"  => "SINGLE_ITEM_OPTS",
			"NAME"    => Loc::getMessage("OWL2SLIDER_OWL_OPTS_animateOut"),
			"TYPE"    => "CHECKBOX",
			"DEFAULT" => "N",
			"REFRESH" => "Y",
	);
	$arComponentParameters['PARAMETERS']['OWL2SLIDER_OWL_OPTS_animateIn'] = array(
			"PARENT"  => "SINGLE_ITEM_OPTS",
			"NAME"    => Loc::getMessage("OWL2SLIDER_OWL_OPTS_animateIn"),
			"TYPE"    => "CHECKBOX",
			"DEFAULT" => "N",
			"REFRESH" => "Y",
	);

	if ($arCurrentValues['OWL2SLIDER_OWL_OPTS_animateOut'] == "Y")
	{
		$arComponentParameters['PARAMETERS']['OWL2SLIDER_OWL_OPTS_animateOut_Type'] = array(
				"PARENT"  => "SINGLE_ITEM_OPTS",
				"NAME"    => Loc::getMessage("OWL2SLIDER_OWL_OPTS_animateOut_Type"),
				"TYPE"    => "LIST",
				"DEFAULT" => "flipOutX",
				"VALUES"  => $arrAnimate3D_Types
		);
	}

	if ($arCurrentValues['OWL2SLIDER_OWL_OPTS_animateIn'] == "Y")
	{
		$arComponentParameters['PARAMETERS']['OWL2SLIDER_OWL_OPTS_animateIn_Type'] = array(
				"PARENT"  => "SINGLE_ITEM_OPTS",
				"NAME"    => Loc::getMessage("OWL2SLIDER_OWL_OPTS_animateIn_Type"),
				"TYPE"    => "LIST",
				"DEFAULT" => "flipInX",
				"VALUES"  => $arrAnimate3D_Types
		);
	}

	$arComponentParameters['PARAMETERS']['OWL2SLIDER_OWL_OPTS_autoHeight'] = array(
			"PARENT"  => "SINGLE_ITEM_OPTS",
			"NAME"    => Loc::getMessage("OWL2SLIDER_OWL_OPTS_autoHeight"),
			"TYPE"    => "CHECKBOX",
			"DEFAULT" => "N",
	);
}

//OPT VIDEO to SHOW
if ($arCurrentValues['OWL2SLIDER_OWL_OPTS_video'] == "Y")
{
	$arComponentParameters['GROUPS']['VIDEO_OPTS'] = array(
			"NAME" => Loc::getMessage("OWL2SLIDER_VIDEO_OPTS_GP"),
			'SORT' => '310'
	);
	$arComponentParameters['PARAMETERS']['OWL2SLIDER_OWL_OPTS_videoSource'] = array(
			"PARENT"            => "VIDEO_OPTS",
			"NAME"              => Loc::getMessage("OWL2SLIDER_OWL_OPTS_videoSource"),
			"TYPE"              => "LIST",
			"MULTIPLE"          => "N",
			"ADDITIONAL_VALUES" => "N",
			"DEFAULT"           => "0",
			"VALUES"            => $arProperties,
	);

	$arComponentParameters['PARAMETERS']['OWL2SLIDER_OWL_OPTS_videoHeight'] = array(
			"PARENT"            => "VIDEO_OPTS",
			"NAME"              => Loc::getMessage("OWL2SLIDER_OWL_OPTS_videoHeight"),
			"TYPE"              => "STRING",
			"MULTIPLE"          => "N",
			"ADDITIONAL_VALUES" => "N",
			"DEFAULT"           => "200",
	);

	$arComponentParameters['PARAMETERS']['OWL2SLIDER_OWL_OPTS_videoWidth'] = array(
			"PARENT"            => "VIDEO_OPTS",
			"NAME"              => Loc::getMessage("OWL2SLIDER_OWL_OPTS_videoWidth"),
			"TYPE"              => "STRING",
			"MULTIPLE"          => "N",
			"ADDITIONAL_VALUES" => "N",
			"DEFAULT"           => "400",
	);
}

//OPT USE MERGE
if ($arCurrentValues['OWL2SLIDER_OWL_OPTS_merge'] == "Y")
{
	$arComponentParameters['GROUPS']['MERGE_OPTS'] = array(
			"NAME" => Loc::getMessage("OWL2SLIDER_MERGE_OPTS_GP"),
			'SORT' => '310'
	);
	$arComponentParameters['PARAMETERS']['OWL2SLIDER_OWL_OPTS_mergeSource'] = array(
			"PARENT"            => "MERGE_OPTS",
			"NAME"              => Loc::getMessage("OWL2SLIDER_OWL_OPTS_mergeSource"),
			"TYPE"              => "LIST",
			"MULTIPLE"          => "N",
			"ADDITIONAL_VALUES" => "N",
			"DEFAULT"           => "0",
			"VALUES"            => $arProperties,
	);
	$arComponentParameters['PARAMETERS']['OWL2SLIDER_OWL_OPTS_mergeFit'] = array(
			"PARENT"  => "MERGE_OPTS",
			"NAME"    => Loc::getMessage("OWL2SLIDER_OWL_OPTS_mergeFit"),
			"TYPE"    => "CHECKBOX",
			"DEFAULT" => "Y",
	);
}

//Resize Options
if ($arCurrentValues['OWL2SLIDER_OWL_OPTS_USE_RESIZE'] == "Y")
{
	if (Loader::includeModule('yenisite.resizer2'))
	{
		$arComponentParameters['PARAMETERS']['OWL2SLIDER_OWL_OPTS_USE_RESIZER2'] = array(
				"PARENT"  => "RESIZING",
				"NAME"    => Loc::getMessage("OWL2SLIDER_OWL_OPTS_USE_RESIZER2"),
				"TYPE"    => "CHECKBOX",
				"DEFAULT" => "Y",
				"REFRESH" => "Y",
		);

		$arrResizer2Sets = CResizer2Set::GetList();
		while ($arr = $arrResizer2Sets->Fetch())
			$arResizer2Sets[$arr["id"]] = "[" . $arr["id"] . "] " . $arr["NAME"];
	}

	if ($arCurrentValues['OWL2SLIDER_OWL_OPTS_USE_RESIZER2'] == "Y")
	{
		$arComponentParameters['PARAMETERS']['OWL2SLIDER_OWL_OPTS_RESIZE_LIST_SET'] = array(
				"PARENT"  => "RESIZING",
				"NAME"    => Loc::getMessage("OWL2SLIDER_OWL_OPTS_RESIZE_LIST_SET"),
				"TYPE"    => "LIST",
				"VALUES"  => $arResizer2Sets,
				"DEFAULT" => "1"
		);
	}
	else
	{
		$arComponentParameters['PARAMETERS']['OWL2SLIDER_OWL_OPTS_RESIZE_WIDTH'] = array(
				"PARENT"            => "RESIZING",
				"NAME"              => Loc::getMessage("OWL2SLIDER_OWL_OPTS_RESIZE_WIDTH"),
				"TYPE"              => "STRING",
				"MULTIPLE"          => "N",
				"ADDITIONAL_VALUES" => "N",
				"DEFAULT"           => "320",
		);
		$arComponentParameters['PARAMETERS']['OWL2SLIDER_OWL_OPTS_RESIZE_HEIGHT'] = array(
				"PARENT"            => "RESIZING",
				"NAME"              => Loc::getMessage("OWL2SLIDER_OWL_OPTS_RESIZE_HEIGHT"),
				"TYPE"              => "STRING",
				"MULTIPLE"          => "N",
				"ADDITIONAL_VALUES" => "N",
				"DEFAULT"           => "580",
		);
		$arComponentParameters['PARAMETERS']['OWL2SLIDER_OWL_OPTS_RESIZE_IS_PROPORTIONAL'] = array(
				"PARENT"  => "RESIZING",
				"NAME"    => Loc::getMessage("OWL2SLIDER_OWL_OPTS_RESIZE_IS_PROPORTIONAL"),
				"TYPE"    => "CHECKBOX",
				"DEFAULT" => "Y",
		);
	}
}

// Responsive
if ($arCurrentValues['OWL2SLIDER_OWL_OPTS_responsive'] == "Y")
{
	$arComponentParameters['PARAMETERS'] = array_merge($arComponentParameters['PARAMETERS'],
			[
					"OWL2SLIDER_OWL_OPTS_responsiveMobileCnt"  => array(
							"PARENT"            => "RESPONSIVE",
							"NAME"              => Loc::getMessage("OWL2SLIDER_OWL_OPTS_responsiveMobileCnt"),
							"TYPE"              => "STRING",
							"MULTIPLE"          => "N",
							"ADDITIONAL_VALUES" => "N",
							"DEFAULT"           => "1",
					),
					"OWL2SLIDER_OWL_OPTS_responsiveTabletCnt"  => array(
							"PARENT"            => "RESPONSIVE",
							"NAME"              => Loc::getMessage("OWL2SLIDER_OWL_OPTS_responsiveTabletCnt"),
							"TYPE"              => "STRING",
							"MULTIPLE"          => "N",
							"ADDITIONAL_VALUES" => "N",
							"DEFAULT"           => "3",
					),
					"OWL2SLIDER_OWL_OPTS_responsiveLaptopCnt"  => array(
							"PARENT"            => "RESPONSIVE",
							"NAME"              => Loc::getMessage("OWL2SLIDER_OWL_OPTS_responsiveLaptopCnt"),
							"TYPE"              => "STRING",
							"MULTIPLE"          => "N",
							"ADDITIONAL_VALUES" => "N",
							"DEFAULT"           => "5",
					),
					"OWL2SLIDER_OWL_OPTS_responsiveDesktopCnt" => array(
							"PARENT"            => "RESPONSIVE",
							"NAME"              => Loc::getMessage("OWL2SLIDER_OWL_OPTS_responsiveDesktopCnt"),
							"TYPE"              => "STRING",
							"MULTIPLE"          => "N",
							"ADDITIONAL_VALUES" => "N",
							"DEFAULT"           => "7",
					)
			]);
}


function generateRandomString($length = 5)
{
	$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	$charactersLength = strlen($characters);
	$randomString = '';
	for ($i = 0; $i < $length; $i++)
	{
		$randomString .= $characters[rand(0, $charactersLength - 1)];
	}
	return $randomString;
}

