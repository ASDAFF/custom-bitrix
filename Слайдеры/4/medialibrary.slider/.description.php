<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$arComponentDescription = array(
	"NAME" => GetMessage("HMWEB_MEDIALIBRARY_SLIDER_NAME"),
	"DESCRIPTION" => GetMessage("HMWEB_MEDIALIBRARY_SLIDER_DESCRIPTION"),
	"ICON" => "/images/news_list.gif",
	"CACHE_PATH" => "Y",
	"PATH" => array(
		"ID" => "custom",
		"NAME" => GetMessage("HMWEB_MEDIALIBRARY_SLIDER_DEVELOP"),
 		"CHILD" => array(
			"ID" => "content",
			"NAME" => GetMessage("HMWEB_MEDIALIBRARY_SLIDER_PARENT")
		),
	),
);
?>