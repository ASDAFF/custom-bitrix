<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$rand = rand(1,100);
?>

<?if(count($arResult["ITEMS"]) > 0):?>


        <ul class="license_list">
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






<?/*if($arParams["USE_PAGINATION"]):?>
	<p class="medialibslider-pagination"></p>
<?endif*/?>

<?endif?>