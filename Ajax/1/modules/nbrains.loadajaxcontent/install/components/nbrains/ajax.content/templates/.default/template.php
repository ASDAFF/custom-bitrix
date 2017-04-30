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
$com_path = '/bitrix/components/nbrains/ajax.content/';
$this->addExternalCss($com_path."front/css/jquery.mCustomScrollbar.css");
$this->addExternalJS($com_path."front/js/jquery-3.1.1.min.js");
$this->addExternalJS($com_path."front/js/jquery.mCustomScrollbar.concat.min.js");
?>
<?

?>
<div class="news_left_nbrains">
	<div class="title_news_nbrains" style="border-top: 2px solid <?=$arParams['COLOR_TOP']?>;"><?=$arResult["NAME"]?></div>
	<div id="content-news-scroll-nbrains" class="content-news-scroll-nbrains" style="height: <?=$arParams['HEIGHT_WINDOW']?>px;">
		<? foreach($arResult["ITEMS"] as $arItem):?>
			<?
			$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
			$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
			?>

			<div class="scroll-box-nbrains">

				<div class="media-nbrains">
					<div class="media-left-nbrains">
						<? if($arParams['DISPLAY_PICTURE'] == "Y"): ?>
						<a href="<?=$arItem['DETAIL_PAGE_URL']?>">
							<img alt="64x64" class="media-object" src="<?=$arItem['PREVIEW_PICTURE']['SRC'];?>" data-holder-rendered="true">
						</a>
						<? endif ?>
					</div>

					<div class="media-body-nbrains">
						<? if($arParams['DISPLAY_DATE'] == "Y"): ?>
						<span class="scroll-text-date"><?=date($arParams["ACTIVE_DATE_FORMAT"],strtotime($arItem['TIMESTAMP_X']));?></span>
						<? endif ?>
						<? if($arParams['DISPLAY_NAME'] == "Y"): ?>
						<p class="scroll-text"><a href="<?=$arItem['DETAIL_PAGE_URL']?>"><strong><?=$arItem['NAME'];?></strong></a></p>
						<? endif ?>
						<? if($arParams['DISPLAY_PREVIEW_TEXT'] == "Y"): ?>
						<p class="scroll-text"><a href="<?=$arItem['DETAIL_PAGE_URL']?>"><?=strip_tags($arItem['PREVIEW_TEXT']);?></a></p>
						<? endif ?>
					</div>

				</div>

			</div>

		<? endforeach; ?>

	</div>

</div>

<script>
	$(function(){
		$(".content-news-scroll-nbrains").mCustomScrollbar({
			theme:"3d",
			scrollInertia: 500,
			scrollbarPosition:"inside",
			callbacks: {
				onTotalScroll: function () {
					myCallback(this)
				},
			}
		});

		var startFrom = 2;
		function myCallback(el){

			$.ajax({
				url: '<?=$com_path?>ajax.php',
				method: 'POST',
				data: {
					"startFrom" : startFrom,
					"iBlock" : "<?=trim($arParams['IBLOCK_ID'])?>",
					"newsCount" : "<?=trim($arParams['NEWS_COUNT'])?>",
					"dataFormat" : "<?=trim($arParams['ACTIVE_DATE_FORMAT'])?>",
					"sort" : "<?=trim($arParams['SORT'])?>",
					"displayDate" : "<?=trim($arParams['DISPLAY_DATE'])?>",
					"displayName" : "<?=trim($arParams['DISPLAY_NAME'])?>",
					"displayPrevText" : "<?=trim($arParams['DISPLAY_PREVIEW_TEXT'])?>",
					"displayPic" : "<?=trim($arParams['DISPLAY_PICTURE'])?>"
				},
				beforeSend: function() {
					inProgress(true);
					$(".load-news-fon-nbrains",el).css("top",$(".mCSB_container",el).css('top').slice(1));
					$(el).mCustomScrollbar("disable");
				}
			}).done(function(data){
				data = jQuery.parseJSON(data);
				if (data.length > 0) {

					$.each(data, function(index, data){
						var img = '';
						if(data.img != ''){
							img = "<a href='"+ data.url +"'><img class='media-object mCS_img_loaded' src='"+ data.img +"'></a>";
						}
						$(".news_left_nbrains .mCSB_container").append("<div class='scroll-box-nbrains'><div class='media-nbrains'><div class='media-left-nbrains'>" + img + "</div><div class='media-body-nbrains'><span class='scroll-text-date'>"+ data.data +"</span><p class='scroll-text'><a href='"+ data.url +"'><strong>"+ data.text +"</strong></a></p><p class='scroll-text'><a href='"+ data.url +"'>"+ data.desc +"</a></p></div></div></div>");
					});

					inProgress(false);
					startFrom += 1;
				}else{
					inProgress(false);
					$(".news_left_nbrains .mCSB_container").append("<p style='text-align: center;margin: 5px;'><?=$arParams['STR_END']?></p>");
				}

				$(el).mCustomScrollbar("update");
			});
		}
		function inProgress(val){
			if(val == true){
				$(".news_left_nbrains .mCSB_container").append("<p class='load-news-fon-nbrains' style='padding-top: <?=$arParams['PRE_LOAD']?>px;'><img style='max-width: 50px;' src=\"<?=$com_path?>images/loading.gif\"></p>");
			}
			if(val == false){
				$(".mCSB_container > p").remove();
			}
		}
	});
</script>


