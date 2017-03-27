<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

if(!CModule::IncludeModule("fileman"))
	return;

CMedialib::Init();

$arCollection = array();

$_arCollection = CMedialibCollection::GetList(array('arFilter' => array('ACTIVE' => 'Y')));
foreach($_arCollection as $key=>$val) {
	$arCollection[$val["ID"]] = $val["NAME"];
}


$arComponentParameters = array(
	"GROUPS" => array(
		"SETTING_SLIDER" => array(
			"NAME" => GetMessage("HWMLS_GROUPS_SETTING_SLIDER_NAME"),
			"SORT" => 400,
		),
	),
	"PARAMETERS" => array(
		"COLLECTIONS" => array(
			"PARENT"=>"BASE",
			"NAME"=>GetMessage("HWMLS_PARAMETERS_COLLECTION_NAME"),
			"TYPE"=>"LIST",
			"DEFAULT"=>"-",
			"VALUES"=>$arCollection,
			"ADDITIONAL_VALUES"=>"N",
			"MULTIPLE"=>"Y",
			"SIZE"=>5,
		),
		"CACHE_TIME"  =>  array("DEFAULT"=>36000000),
		"CACHE_GROUPS" => array(
			"PARENT" => "CACHE_SETTINGS",
			"NAME" => GetMessage("HWMLS_CP_BNL_CACHE_GROUPS"),
			"TYPE" => "CHECKBOX",
			"DEFAULT" => "Y",
		),
	)
);

?>