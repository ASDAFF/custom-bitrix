<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");?>

<?php

if(CModule::IncludeModule("iblock")):

    $arSelect = Array("ID", "IBLOCK_ID","NAME","DETAIL_PAGE_URL","PREVIEW_PICTURE", "TIMESTAMP_X","PREVIEW_TEXT");
    $arFilter = Array("IBLOCK_ID" => $_POST['iBlock'], "ACTIVE" => "Y");

    $resul = CIBlockElement::GetList(Array("ID" => $_POST['sort']), $arFilter, false,false, $arSelect);

    while($ob = $resul->GetNextElement()) {
        $navCount[] = $ob->GetFields();
    }



    $arResult = array();
    if($_POST['startFrom'] <= ceil(count($navCount)/$_POST['newsCount'])) {
    $res = CIBlockElement::GetList(Array("ID" => $_POST['sort']), $arFilter, false,  Array ("nPageSize" => $_POST['newsCount'],"iNumPage" => $_POST['startFrom'],"bShowAll"=> false), $arSelect);
    while($ob = $res->GetNextElement())
        {
            $arFields = $ob->GetFields();
            if($_POST['displayDate'] == 'Y'){$displayDate = date($_POST["dataFormat"],strtotime($arFields['TIMESTAMP_X']));}else{$displayDate = '';}
            if($_POST['displayName'] == 'Y'){$displayName = $arFields['NAME'];}else{$displayName = '';}
            if($_POST['displayPrevText'] == 'Y'){$displayPrevText = strip_tags($arFields['PREVIEW_TEXT']);}else{$displayPrevText = '';}
            if($_POST['displayPic'] == 'Y'){$displayPic = CFile::GetPath($arFields['PREVIEW_PICTURE']);}else{$displayPic = '';}
                $arResult[] = array(
                    'url' => $arFields['DETAIL_PAGE_URL'],
                    'text' => $displayName,
                    'desc' => $displayPrevText,
                    'data' => $displayDate,
                    'img' => $displayPic
                );
        }
    }
    echo json_encode($arResult);

endif;