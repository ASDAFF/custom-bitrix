<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);

if(!function_exists("formatStr"))
{
	function formatStr($arItem, $arParams)
	{
		ob_start();

		$alxDefPhoto = false;
		if($arItem["src"]=="")
		{
			$alxDefPhoto = true;
			$arItem["src"] = "/bitrix/components/custom/altasib.carousel.owl2/images/def_img.png";
		}

		?><div <?if($arParams["AUTO_WIDTH_OWL"]):
				?>style="width:<?=floor($arItem["width"]/$arItem["height"]*$arParams["HEIGHT_CAROUSEL_OWL"])?>px;" <?
				endif;?> class = "item"><?
		//here begin template
			if($arParams["DISPLAY_VIDEO"]):?><div class="alx-vid"><div class="item-video"><?
				?><a class="owl-video" href="<?=$arItem["VIDEO_PATH"]?>"></a></div></div><?endif;
			if($arParams["DISPLAY_DETAIL_PICTURE"]):
				?><div class="alx-img"><?
				if(!empty($arItem["DETAIL_PAGE_URL"]) && $arParams["SHOW_LINK_DETAIL"]):
					?><a href="<?=$arItem["DETAIL_PAGE_URL"]?>"><?endif;
					?><img class="<?
					if($alxDefPhoto):?>alx-owl-noPhoto<?endif;
					if($arParams["LAZY_LOAD_OWL"]):?> owl-lazy<?endif;
					?>" <?
					/*if($alxDefPhoto):?>width="<?=$arParams["CROPPED_IMAGE_WIDTH"]?>" height="<?=$arParams["CROPPED_IMAGE_HEIGHT"]?>"<?endif;*/
					if($arParams["LAZY_LOAD_OWL"]):?> data-<?endif;
					?>src='<?=$arItem["src"]?>' alt='<?=$arItem["alt"]?>'><?
				if(!empty($arItem["DETAIL_PAGE_URL"]) && $arParams["SHOW_LINK_DETAIL"]):?></a><?endif;
				?></div><?endif;
			if($arParams["DISPLAY_NAME"]):
				?><div class="alx-name"><?
					if(!empty($arItem["DETAIL_PAGE_URL"]) && $arParams["SHOW_LINK_DETAIL"]):?><a href="<?=$arItem["DETAIL_PAGE_URL"]?>"><?endif;
						?><?=$arItem["NAME"];?><?
					if(!empty($arItem["DETAIL_PAGE_URL"]) && $arParams["SHOW_LINK_DETAIL"]):?></a><?endif;
				?></div><?endif;
			if($arParams["DISPLAY_PREVIEW_TEXT"]):?><div class="alx-prev-text"><?=$arItem["PREVIEW_TEXT"];?></div><?endif;
		//here end template
		?></div><?

		$temp = ob_get_contents();

		if(SITE_CHARSET !== "UTF-8")
			$temp = iconv('CP1251', 'UTF-8', $temp);

		ob_end_clean();
		return $temp;
	}
}

if($_POST["altasib_owl_page"] && $_POST["ALTASIB_OWL_COUNTER"] == $arParams["COUNTER"])
{
	$jsonData = array();
	$jsonData["owl"] = array();
	foreach($arResult["ITEMS"] as $arItem)
		$jsonData["owl"][] = array("item" => formatStr($arItem, $arParams));

	$jsonData["NavPageCount"] = $arParams["NavPageCount"];
	$arResult["JSON"] = json_encode($jsonData);
	echo $arResult["JSON"];
}
else
{
	?><div id="owl-carousel<?=$arParams["COUNTER"]?>" class="owl-carousel"></div>
<script type="text/javascript">
new OwlCarouselPhp(<? echo CUtil::PhpToJSObject($arParams);?>);
</script>
<?
}
?>