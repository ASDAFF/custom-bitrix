<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arComponentDescription = array(
	"NAME" => GetMessage("OWL_NAME"),
	"DESCRIPTION" => GetMessage("OWL_DESCRIPTION"),
	"ICON" => "/images/сarousel_owl.gif",
	"SORT" => 20,
	
	"PATH" => array(
		"ID" => "IS-MARKET.RU",
		"CHILD" => array(
			"ID" => "altasib_photoplayer",
			"NAME" => GetMessage("OWL_NAME_MENU"),
			"SORT" => 10,
			"CHILD" => array(
				"ID" => "carousel_owl",
			),
		),
	),
);

?>