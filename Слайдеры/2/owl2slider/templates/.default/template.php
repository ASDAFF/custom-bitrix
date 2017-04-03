<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>
<?
if ($arParams['OWL2SLIDER_COMPOSITE'] == 'Y') {
    if (method_exists($this, 'createFrame'))
        $frame = $this->createFrame()->begin(GetMessage('OWL2SLIDER_COMPOSITE_INIT'));
}
?>

<?
//echo "<pre>", print_r($arResult['ITEMS']), "</pre>";
if (count($arResult['ITEMS']) > 0):?>
    <ul
            id="teasoft-owl2-<?= $arParams['OWL2SLIDER_UNIQUE_SUFFIX']; ?>"
            class="owl-carousel owl-<?= $arParams['OWL2SLIDER_OWL_OPTS_DESIGN']; ?>_<?= $arParams['OWL2SLIDER_OWL_OPTS_COLOR']; ?>"
    >
        <? foreach ($arResult['ITEMS'] as $item): ?>
            <li
                    id="<?= $this->GetEditAreaId($item['ID']); ?>"
                    class="item"
            >
                <?
                // Advert flash?
                if ($item['AD_TYPE'] == 'flash'): ?>
                    <div class="item__flash"></div>
                    <a target="<?= $item['ITEM_URL_TARGET']; ?>" href="<?= $item['ITEM_URL']; ?>">
                        <figure>
                            <object type="application/x-shockwave-flash"
                                    data="<?= $item['PICTURE_RESIZED']['src']; ?>"
                                    height="<?= $item['PICTURE_RESIZED']['height']; ?>"
                                    width="<?= $item['PICTURE_RESIZED']['width']; ?>">
                                <param name="movie" value="<?= $item['PICTURE_RESIZED']['src']; ?>"/>
                                <param name="quality" value="high"/>
                                <param name="wmode" value="opaque"/>
                                <embed style="z-index:0;"
                                       src="<?= $item['PICTURE_RESIZED']['src']; ?>"
                                       height="<?= $item['PICTURE_RESIZED']['height']; ?>"
                                       width="<?= $item['PICTURE_RESIZED']['width']; ?>"
                                       type="application/x-shockwave-flash"
                                       allowscriptaccess="always"
                                       allowfullscreen="true"
                                       wmode="opaque">
                            </object>
                        </figure>
                    </a>
                    </div>
                    <?
                // Advert Html?
                elseif ($item['AD_TYPE'] == 'html'): ?>
                    <?= $item['CODE']; ?>
                    <?
                //  Iblock?
                else:
                    $this->AddEditAction($item['ID'], $item['EDIT_LINK'], CIBlock::GetArrayByID($item["IBLOCK_ID"], "ELEMENT_EDIT"));
                    $this->AddDeleteAction($item['ID'], $item['DELETE_LINK'], CIBlock::GetArrayByID($item["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                    // Video Item?
                    if ($arParams['OWL2SLIDER_OWL_OPTS_video'] == "Y" && $item['ITEM_VIDEO_URL'] != '') {
                        ?>
                        <div class="item__video"
                            <? if ($arParams['OWL2SLIDER_OWL_OPTS_merge'] == "Y" && $item['ITEM_MERGE_COUNT'] > 1) {
                                echo 'data-merge = "' . $item['ITEM_MERGE_COUNT'] . '""';
                            } ?>
                        >
                            <a class="owl-video" href="<?= $item['ITEM_VIDEO_URL']; ?>"></a>
                        </div>
                    <? } else {
                        if ($item['ITEM_URL'] != ''): ?>
                            <a target="<?= $item['ITEM_URL_TARGET']; ?>"  href="<?= $item['ITEM_URL']; ?>">
                        <? endif; ?>
                        <img
                                alt="<?= htmlspecialcharsEx($item['NAME']); ?>"
                                title='<?= htmlspecialcharsEx($item['NAME']); ?>'
                                class="item__img <? if ($arParams['OWL2SLIDER_OWL_OPTS_lazyLoad'] == "Y" && (count($arResult['ITEMS']) >= 9)): ?>owl-lazy<? endif; ?>"
                            <? if ($arParams['OWL2SLIDER_OWL_OPTS_lazyLoad'] == "Y" && (count($arResult['ITEMS']) >= 9)) {
                                echo 'data-src = "' . $item["PICTURE_RESIZED"]["src"] . '"';
                            } else {
                                echo 'src = "' . $item['PICTURE_RESIZED']['src'] . '"';
                            } ?>

                            <? if ($arParams['OWL2SLIDER_OWL_OPTS_merge'] == "Y" && $item['ITEM_MERGE_COUNT'] > 1): ?>
                                data-merge="<?= $item['ITEM_MERGE_COUNT']; ?>
						     <? endif; ?>"
                        >
                        <? if ($item['ITEM_URL'] != ''): ?>
                            </a>
                        <? endif; ?>
                        <? if ($arParams['OWL2SLIDER_OWL_OPTS_showDescription'] == 'Y'): ?>
                            <div class="item__descr">
                                <div class="descr__title"><?= htmlspecialcharsEx($item['NAME']); ?></div>
                                <div class="descr__content">
                                    <? if ($item['NAME'] != $item['ITEM_TEXT']) {
                                        echo htmlspecialcharsEx($item['ITEM_TEXT']);;
                                    }
                                    ?>
                                </div>
                            </div>
                        <? endif;
                    } ?>
                <? endif; ?>
            </li>
        <? endforeach; ?>
    </ul>

    <script>
        BX.ready(function () {

            var $owl2_<?=$arParams['OWL2SLIDER_UNIQUE_SUFFIX'];?>= $('#teasoft-owl2-<?=$arParams['OWL2SLIDER_UNIQUE_SUFFIX']?>')

            $owl2_<?=$arParams['OWL2SLIDER_UNIQUE_SUFFIX'];?>.on('refreshed.owl.carousel', function (event) {
                var carousel = event.target;

                $(carousel).find('.item__video').css("height", function () {
                    var H = $(this).height();
                    if (!H)
                        H = $(this).closest('.owl-stage').height();
                    return H + "px";
                });

                //responsive for flash
                var flashWrapItems = $(carousel).find('.item__flash');
                var flashItems = flashWrapItems.find("object, embed");
                var flashFluidItems = flashWrapItems.find('figure');

                if (flashWrapItems.length) {
                    flashItems.each(function () {
                        $(this)
                        // jQuery .data does not work on object/embed elements
                            .attr('data-aspectRatio', this.height / this.width)
                            .removeAttr('height')
                            .removeAttr('width');
                    });

                    $(window).resize(function () {
                        var newWidth = flashFluidItems.width();
                        flashItems.each(function () {
                            var $el = $(this);
                            $el
                                .width(newWidth)
                                .height(newWidth * $el.attr('data-aspectRatio'));
                        });
                    }).resize();
                }
            });

            $owl2_<?=$arParams['OWL2SLIDER_UNIQUE_SUFFIX'];?>.owlCarousel(
                {
                    items: <?= $arParams['OWL2SLIDER_OWL_OPTS_visibleItemsCount'];?>,
                    margin: <?= $arParams['OWL2SLIDER_OWL_OPTS_margin'];?>,
                    loop: <?=($arParams['OWL2SLIDER_OWL_OPTS_loop'] == "Y") ? "true" : "false";?>,
                    center: <?=($arParams['OWL2SLIDER_OWL_OPTS_center'] == "Y") ? "true" : "false";?>,
                    mouseDrag: <?= ($arParams['OWL2SLIDER_OWL_OPTS_mouseDrag'] == "Y") ? "true" : "false";?>,
                    touchDrag: <?= ($arParams['OWL2SLIDER_OWL_OPTS_touchDrag'] == "Y") ? "true" : "false";?>,
                    pullDrag: <?= ($arParams['OWL2SLIDER_OWL_OPTS_pullDrag'] == "Y") ? "true" : "false";?>,
                    freeDrag: <?= ($arParams['OWL2SLIDER_OWL_OPTS_freeDrag'] == "Y") ? "true" : "false";?>,
                    stagePadding: <?=$arParams['OWL2SLIDER_OWL_OPTS_stagePadding']?>,
                    merge: <?= ($arParams['OWL2SLIDER_OWL_OPTS_merge'] == "Y") ? "true" : "false";?>,
                    mergeFit: <?= ($arParams['OWL2SLIDER_OWL_OPTS_mergeFit'] == "Y") ? "true" : "false";?>,
                    autoWidth: <?= ($arParams['OWL2SLIDER_OWL_OPTS_autoWidth'] == "Y") ? "true" : "false";?>,
                    autoHeight:<?= ($arParams['OWL2SLIDER_OWL_OPTS_autoHeight'] == "Y") ? "true" : "false";?>,
                    startPosition: <?=$arParams['OWL2SLIDER_OWL_OPTS_startPosition']?>,
                    nav: <?= ($arParams['OWL2SLIDER_OWL_OPTS_nav'] == "Y") ? "true" : "false";?>,
                    navRewind: <?= ($arParams['OWL2SLIDER_OWL_OPTS_navRewind'] == "Y") ? "true" : "false";?>,
                    navText: [<?=implode(', ', htmlspecialcharsBack($arParams['OWL2SLIDER_OWL_OPTS_navText'])); ?>],
                    slideBy: <?=$arParams['OWL2SLIDER_OWL_OPTS_slideBy']?>,
                    dots: <?= ($arParams['OWL2SLIDER_OWL_OPTS_dots'] == "Y") ? "true" : "false";?>,
                    dotsEach: <?= ($arParams['OWL2SLIDER_OWL_OPTS_dotsEach'] == "Y") ? "true" : "false";?>,
                    <? if ((count($arResult['ITEMS']) >= 9)):?>
                    lazyLoad: <?= ($arParams['OWL2SLIDER_OWL_OPTS_lazyLoad'] == "Y") ? "true" : "false";?>,
                    <?endif;?>
                    autoplay: <?= ($arParams['OWL2SLIDER_OWL_OPTS_autoplay'] == "Y") ? "true" : "false";?>,
                    autoplayTimeout: <?=$arParams['OWL2SLIDER_OWL_OPTS_autoplayTimeout']?>,
                    autoplayHoverPause: <?= ($arParams['OWL2SLIDER_OWL_OPTS_autoplayHoverPause'] == "Y") ? "true" : "false";?>,
                    smartSpeed: <?= (intval($arParams['OWL2SLIDER_OWL_OPTS_smartSpeed']) > 0) ? $arParams['OWL2SLIDER_OWL_OPTS_smartSpeed'] : "false";?>,
                    autoplaySpeed: <?= (intval($arParams['OWL2SLIDER_OWL_OPTS_autoplaySpeed']) > 0) ? $arParams['OWL2SLIDER_OWL_OPTS_autoplaySpeed'] : "false";?>,
                    navSpeed: <?= (intval($arParams['OWL2SLIDER_OWL_OPTS_navSpeed']) > 0) ? $arParams['OWL2SLIDER_OWL_OPTS_navSpeed'] : "false"?>,
                    dotsSpeed: <?= (intval($arParams['OWL2SLIDER_OWL_OPTS_dotsSpeed']) > 0) ? $arParams['OWL2SLIDER_OWL_OPTS_dotsSpeed'] : "false"?>,
                    dragEndSpeed: <?= (intval($arParams['OWL2SLIDER_OWL_OPTS_dragEndSpeed']) > 0) ? $arParams['OWL2SLIDER_OWL_OPTS_dragEndSpeed'] : "false"?>,
                    <?if ($arParams['OWL2SLIDER_OWL_OPTS_responsive'] == "Y"):?>
                    responsiveClass: true,
                    responsive: {
                        0: {
                            items: <?= (intval($arParams['OWL2SLIDER_OWL_OPTS_responsiveMobileCnt']) > 0) ? intval($arParams['OWL2SLIDER_OWL_OPTS_responsiveMobileCnt']) : 1;?>,
                        },
                        479: {
                            items: <?= (intval($arParams['OWL2SLIDER_OWL_OPTS_responsiveTabletCnt']) > 0) ? intval($arParams['OWL2SLIDER_OWL_OPTS_responsiveTabletCnt']) : 3;?>,
                        },
                        767: {
                            items: <?= (intval($arParams['OWL2SLIDER_OWL_OPTS_responsiveLaptopCnt']) > 0) ? intval($arParams['OWL2SLIDER_OWL_OPTS_responsiveLaptopCnt']) : 5;?>,
                        },
                        1199: {
                            items: <?= (intval($arParams['OWL2SLIDER_OWL_OPTS_responsiveDesktopCnt']) > 0) ? intval($arParams['OWL2SLIDER_OWL_OPTS_responsiveDesktopCnt']) : 7;?>,
                        }
                    },
                    responsiveRefreshRate: <?=$arParams['OWL2SLIDER_OWL_OPTS_responsiveRefreshRate']?>,
                    responsiveBaseElement: <?=$arParams['OWL2SLIDER_OWL_OPTS_responsiveBaseElement']?>,
                    <?else:?>
                    responsive: false,
                    <?endif;?>

                    video: <?= ($arParams['OWL2SLIDER_OWL_OPTS_video'] == "Y") ? "true" : "false";?>,
                    videoHeight: <?= (intval($arParams['OWL2SLIDER_OWL_OPTS_videoHeight']) > 0) ? $arParams['OWL2SLIDER_OWL_OPTS_videoHeight'] : "false"?>,
                    videoWidth: <?= (intval($arParams['OWL2SLIDER_OWL_OPTS_videoWidth']) > 0) ? $arParams['OWL2SLIDER_OWL_OPTS_videoWidth'] : "false"?>,
                    animateOut: <?= ($arParams['OWL2SLIDER_OWL_OPTS_animateOut'] == "Y") ? '"' . $arParams['OWL2SLIDER_OWL_OPTS_animateOut_Type'] . '"' : "false"?>,
                    animateIn: <?= ($arParams['OWL2SLIDER_OWL_OPTS_animateIn'] == "Y") ? '"' . $arParams['OWL2SLIDER_OWL_OPTS_animateIn_Type'] . '"' : "false"; ?>,
                    fallbackEasing: '<?=$arParams['OWL2SLIDER_OWL_OPTS_fallbackEasing']?>',
                    rtl: <?= ($arParams['OWL2SLIDER_OWL_OPTS_rtl'] == "Y") ? "true" : "false";?>

                }
            );

            <?if(intval($arParams['OWL2SLIDER_OWL_OPTS_visibleItemsCount']) == 1):?>
            $(".owl-<?= $arParams['OWL2SLIDER_OWL_OPTS_DESIGN']; ?>_<?= $arParams['OWL2SLIDER_OWL_OPTS_COLOR']; ?> .owl-dots").css({
                "position": "absolute",
                "bottom": "3rem"
            });
            <?endif;?>




        });
    </script>
<? endif; ?>

<? if ($arParams['OWL2SLIDER_COMPOSITE'] == 'Y'): ?>
    <? if (method_exists($this, 'createFrame')) $frame->end(); ?>
<? endif; ?>