<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
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

$this->addExternalCss($componentPath . "/front/css/font-awesome.min.css");
$this->addExternalCss($componentPath . "/front/css/animate.min.css");
$this->addExternalCss($componentPath . "/front/css/slider.css");

?>
<style>
    /********************************/
    /*       Slides backgrounds     */
    /********************************/
    #first-slider .slide1 {
        background-image: url(http://s20.postimg.org/h50tgcuz1/image.jpg);
        background-size: cover;
        background-repeat: no-repeat;
    }

    #first-slider .slide2 {
        background-image: url(http://s20.postimg.org/uxf8bzlql/image.jpg);
        background-size: cover;
        background-repeat: no-repeat;
    }

    #first-slider .slide3 {
        background-image: url(http://s20.postimg.org/el56m97f1/image.jpg);
        background-size: cover;
        background-repeat: no-repeat;
    }

    #first-slider .slide4 {
        background-image: url(http://s20.postimg.org/66pjy66dp/image.jpg);
        background-size: cover;
        background-repeat: no-repeat;
    }
</style>
<? //echo "<pre>"; print_r($arResult); echo "</pre>";?>
<div id="first-slider" class="slider">
    <div id="carousel-example-generic" class="carousel slide carousel-fade">
        <!-- Indicators -->
        <!--<ol class="carousel-indicators">
            <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
            <li data-target="#carousel-example-generic" data-slide-to="1"></li>
            <li data-target="#carousel-example-generic" data-slide-to="2"></li>
            <li data-target="#carousel-example-generic" data-slide-to="3"></li>
        </ol>-->
        <!-- Wrapper for slides -->
        <div class="carousel-inner" role="listbox">
            <? foreach ($arResult["ITEMS"] as $arItem => $valItem): ?>
                <?
                $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                ?>
                <div class="item <? if (!$arItem) : ?>active<? endif; ?> slide1"
                     style="min-height:<?= $arParams['HEIGHT'] ?>px; background-image: url(<?= $valItem['DETAIL_PICTURE']['SRC'] ?>);">
                    <div class="row">
                        <div class="container">
                            <div class="col-md-3 text-right">
                                <img style="max-width: 200px;" data-animation="animated zoomInLeft"
                                     src="<?= $valItem['PREVIEW_PICTURE']['SRC'] ?>">
                            </div>
                            <div class="col-md-9 text-left">
                                <h3 data-animation="animated bounceInDown"><?= $valItem['PREVIEW_TEXT'] ?></h3>
                                <h4 data-animation="animated bounceInUp"><?= $valItem['DETAIL_TEXT'] ?></h4>
                            </div>

                        </div>
                    </div>
                </div>
            <? endforeach; ?>
        </div>
        <!-- End Wrapper for slides-->
        <!-- <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
             <i class="fa fa-angle-left"></i><span class="sr-only">Previous</span>
         </a>
         <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
             <i class="fa fa-angle-right"></i><span class="sr-only">Next</span>
         </a> -->
    </div>
</div>
<script src="<?= $componentPath ?>/front/js/common.js"></script>