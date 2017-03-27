<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$rand = rand(1,100);
?>

<?if(count($arResult["ITEMS"]) > 0):?>
<div class="medialibslider-wrapper">
	<div
		class="medialibslider"
		data-count-element="<?=$arResult["COUNT_ELEMENT_DEFAULT"]?>"
		data-wrap="<?=$arResult["CAROUSEL_WRAP"]?>"
		data-interval="<?=($arResult["AUTOSCROLL_INTERVAL"]) ? $arResult["AUTOSCROLL_INTERVAL"] : '3000'?>"
		data-autostart="<?=($arParams["USE_AUTOSCROLL"]) ? 'true' : 'false'?>"
		data-start="<?=$arParams["START_ELEMENT_SLIDER"]?>">
		<ul>
		<?foreach($arResult["ITEMS"] as $arItem):?>
		<?
			$arImage = array();

			if($arParams["USE_THUMB_IMG"]
				&& ($arItem["FULL_IMG"]["WIDTH"] > $arParams["THUMB_IMG_WIDTH"]
					|| $arItem["FULL_IMG"]["HEIGHT"] > $arParams["THUMB_IMG_HEIGHT"]))
			{
				$arImage = $arItem["THUMB_IMG"];
			}
			else
			{
				$arImage = $arItem["FULL_IMG"];
			}
		?>
			<li>
				<?if($arParams["USE_FANCYBOX"]):?>
					<a href="<?=$arItem["FULL_IMG"]["SRC"]?>" data-fancybox="group<?=$rand?>">
						<img src="<?=$arImage["SRC"]?>" width="<?=$arImage["WIDTH"]?>" height="<?=$arImage["HEIGHT"]?>">
					</a>
				<?else:?>
					<img src="<?=$arImage["SRC"]?>" width="<?=$arImage["WIDTH"]?>" height="<?=$arImage["HEIGHT"]?>">
				<?endif?>
			</li>
		<?endforeach?>
		</ul>
	</div>
	<a href="#" class="medialibslider-control-prev">&lsaquo;</a>
	<a href="#" class="medialibslider-control-next">&rsaquo;</a>
<?if($arParams["USE_PAGINATION"]):?>
	<p class="medialibslider-pagination"></p>
<?endif?>
</div>
<?endif?>