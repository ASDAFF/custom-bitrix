<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

//Params
$arParams["USE_JQUERY"] = $arParams["USE_JQUERY"] != "N";
$arParams["USE_THUMB_IMG"] = $arParams["USE_THUMB_IMG"] != "N";
$arParams["CAROUSEL_RTL"] = $arParams["CAROUSEL_RTL"] != "N";
$arParams["USE_PAGINATION"] = $arParams["USE_PAGINATION"] != "N";
$arParams["USE_AUTOSCROLL"] = $arParams["USE_AUTOSCROLL"] != "N";
$arParams["THUMB_IMG_WIDTH"] = intval($arParams["THUMB_IMG_WIDTH"]);
$arParams["THUMB_IMG_HEIGHT"] = intval($arParams["THUMB_IMG_HEIGHT"]);
$arParams["START_ELEMENT_SLIDER"] = intval($arParams["START_ELEMENT_SLIDER"]);
if($arParams["START_ELEMENT_SLIDER"] <= 0)
{
	$arParams["START_ELEMENT_SLIDER"] = 1;
}

$arResult["COUNT_ELEMENT_DEFAULT"] = intval($arParams["COUNT_ELEMENT_DEFAULT"]);
$arResult["AUTOSCROLL_INTERVAL"] = intval($arParams["AUTOSCROLL_INTERVAL"])*1000;
$arResult["CAROUSEL_WRAP"] = htmlspecialchars($arParams["CAROUSEL_WRAP"]);


if($this->StartResultCache(false,false))
{
	if(!CModule::IncludeModule("fileman")) return;

	CMedialib::Init();

	if(count($arParams["COLLECTIONS"]) > 0)
	{
		$arResult["ITEMS"] = array();

		$arItems = CMedialibItem::GetList(array('arCollections'=>$arParams["COLLECTIONS"]));

		foreach($arItems as $key => $arItem)
		{
			if(CFile::IsImage($arItem["FILE_NAME"],$arItem["CONTENT_TYPE"]))
			{
				$arResult["ITEMS"][$key] = array(
					"ID" => $arItem["ID"],
					"NAME" => $arItem["NAME"],
					"DESCRIPTION" => $arItem["DESCRIPTION"],
					"DATE_CREATE" => $arItem["DATE_CREATE"],
					"DATE_UPDATE" => $arItem["DATE_UPDATE"],
					"DATE_UPDATE2" => $arItem["DATE_UPDATE2"],
					"TYPE" => $arItem["TYPE"],
					"CONTENT_TYPE"=>$arItem["CONTENT_TYPE"],
					"THUMB_IMG" => array(
						"SRC" => $arItem["THUMB_PATH"],
					),
					"FULL_IMG" => array(
						"SRC" => $arItem["PATH"],
						"WIDTH" => $arItem["WIDTH"],
						"HEIGHT" => $arItem["HEIGHT"],
					),
				);
				
				if($arParams["USE_THUMB_IMG"] && ($arItem["WIDTH"] > $arParams["THUMB_IMG_WIDTH"] || $arItem["HEIGHT"] > $arParams["THUMB_IMG_HEIGHT"])) {
					$rsFile = CFile::ResizeImageGet(
						CFile::GetFileArray($arItem["SOURCE_ID"]),
						array("width"=>$arParams["THUMB_IMG_WIDTH"],"height"=>$arParams["THUMB_IMG_HEIGHT"]),
						$arParams["RESIZE_TYPE"],
						true
					);

					$arResult["ITEMS"][$key]["THUMB_IMG"] = array(
						"SRC" => $rsFile["src"],
						"WIDTH" => $rsFile["width"],
						"HEIGHT" => $rsFile["height"],
					);
				}
			}
		}
	}

	$this->IncludeComponentTemplate();	
}
?>