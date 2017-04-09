<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arThemes = array();
$arThemes["blue"] = GetMessage("HWMLS_PARAMETERS_TPL_THEME_BLUE");
$arThemes["red"] = GetMessage("HWMLS_PARAMETERS_TPL_THEME_RED");
$arThemes["green"] = GetMessage("HWMLS_PARAMETERS_TPL_THEME_GREEN");
$arThemes["orange"] = GetMessage("HWMLS_PARAMETERS_TPL_THEME_ORANGE");
$arThemes["black"] = GetMessage("HWMLS_PARAMETERS_TPL_THEME_BLACK");

$arResizeType = array();
$arResizeType["BX_RESIZE_IMAGE_EXACT"] = GetMessage("HWMLS_PARAMETERS_RESIZE_TYPE_EXACT");
$arResizeType["BX_RESIZE_IMAGE_PROPORTIONAL"] = GetMessage("HWMLS_PARAMETERS_RESIZE_TYPE_PROPORTIONAL");

$arWrap = array();
$arWrap["first"] = GetMessage("HWMLS_PARAMETERS_CAROUSEL_WRAP_FIRST");
$arWrap["last"] = GetMessage("HWMLS_PARAMETERS_CAROUSEL_WRAP_LAST");
$arWrap["both"] = GetMessage("HWMLS_PARAMETERS_CAROUSEL_WRAP_BOTH");
$arWrap["circular"] = GetMessage("HWMLS_PARAMETERS_CAROUSEL_WRAP_CIRCULAR");

$arTemplateParameters['TEMPLATE_THEME'] = array(
	'PARENT' => 'VISUAL',
	'NAME' => GetMessage("HWMLS_PARAMETERS_TPL_THEME_NAME"),
	'TYPE' => 'LIST',
	'VALUES' => $arThemes,
	'DEFAULT' => 'blue',
	'ADDITIONAL_VALUES' => 'Y'
);
$arTemplateParameters['USE_JQUERY'] = array(
	"PARENT"=>"VISUAL",
	"NAME"=>GetMessage("HWMLS_PARAMETERS_USE_JQUERY_NAME"),
	"TYPE"=>"CHECKBOX",
	"DEFAULT"=>"Y"
);

$arTemplateParameters['USE_THUMB_IMG'] = array(
	"PARENT"=>"VISUAL",
	"NAME"=>GetMessage("HWMLS_PARAMETERS_USE_THUMB_IMG_NAME"),
	"TYPE"=>"CHECKBOX",
	"DEFAULT"=>"N",
	"REFRESH"=>"Y"
);

if($arCurrentValues["USE_THUMB_IMG"]=="Y")
{
	$arTemplateParameters['THUMB_IMG_WIDTH'] = array(
		"PARENT"=>"VISUAL",
		"NAME"=>GetMessage("HWMLS_PARAMETERS_THUMB_IMG_WIDTH_NAME"),
		"TYPE"=>"STRING",
		"MULTIPLE"=>"N",
		"DEFAULT"=>"100",
		"COLS"=>3
	);
	$arTemplateParameters['THUMB_IMG_HEIGHT'] = array(
		"PARENT"=>"VISUAL",
		"NAME"=>GetMessage("HWMLS_PARAMETERS_THUMB_IMG_HEIGHT_NAME"),
		"TYPE"=>"STRING",
		"MULTIPLE"=>"N",
		"DEFAULT"=>"100",
		"COLS"=>3
	);
	$arTemplateParameters['RESIZE_TYPE'] = array(
		'PARENT' => 'VISUAL',
		'NAME' => GetMessage("HWMLS_PARAMETERS_RESIZE_TYPE_NAME"),
		'TYPE' => 'LIST',
		'VALUES' => $arResizeType,
		'DEFAULT' => 'BX_RESIZE_IMAGE_EXACT',
		'ADDITIONAL_VALUES' => 'N'
	);
}

/*$arTemplateParameters['USE_FANCYBOX'] = array(
	'PARENT' => 'VISUAL',
	'NAME' => GetMessage("HWMLS_PARAMETERS_USE_FANCYBOX_NAME"),
	'TYPE' => 'CHECKBOX',
	'DEFAULT' => 'N',
	'REFRESH' => 'Y'
);*/

$arTemplateParameters['COUNT_ELEMENT_DEFAULT'] = array(
	"PARENT"=>"SETTING_SLIDER",
	"NAME"=>GetMessage("HWMLS_PARAMETERS_COUNT_ELEMENT_DEFAULT_NAME"),
	"TYPE"=>"STRING",
	"MULTIPLE"=>"N",
	"DEFAULT"=>"4",
);

$arTemplateParameters['CAROUSEL_WRAP'] = array(
	'PARENT' => 'SETTING_SLIDER',
	'NAME' => GetMessage("HWMLS_PARAMETERS_CAROUSEL_WRAP_NAME"),
	'TYPE' => 'LIST',
	'VALUES' => $arWrap,
	'DEFAULT' => 'circular',
	'ADDITIONAL_VALUES' => 'N'
);

/*$arTemplateParameters['USE_PAGINATION'] = array(
	"PARENT"=>"SETTING_SLIDER",
	"NAME"=>GetMessage("HWMLS_PARAMETERS_USE_PAGINATION_NAME"),
	"TYPE"=>"CHECKBOX",
	"DEFAULT"=>"N"
);*/

$arTemplateParameters['USE_AUTOSCROLL'] = array(
	"PARENT"=>"SETTING_SLIDER",
	"NAME"=>GetMessage("HWMLS_PARAMETERS_USE_AUTOSCROLL_NAME"),
	"TYPE"=>"CHECKBOX",
	"DEFAULT"=>"N",
	"REFRESH"=>"Y"
);
if($arCurrentValues["USE_AUTOSCROLL"]=="Y") {
	$arTemplateParameters['AUTOSCROLL_INTERVAL'] = array(
		"PARENT"=>"SETTING_SLIDER",
		"NAME"=>GetMessage("HWMLS_PARAMETERS_AUTOSCROLL_INTERVAL_NAME"),
		"TYPE"=>"STRING",
		"MULTIPLE"=>"N",
		"DEFAULT"=>"4",
		"COLS"=>3
	);
}

$arTemplateParameters['START_ELEMENT_SLIDER'] = array(
	"PARENT"=>"SETTING_SLIDER",
	"NAME"=>GetMessage("HWMLS_PARAMETERS_START_ELEMENT_SLIDER_NAME"),
	"TYPE"=>"STRING",
	"MULTIPLE"=>"N",
	"DEFAULT"=>"1",
);

?>