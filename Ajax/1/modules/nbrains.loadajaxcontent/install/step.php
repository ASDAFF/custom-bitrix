<?if(!check_bitrix_sessid()) return;?>
<div class="adm-info-message">
<h1><?=GetMessage("THEBRAINSE_LOADAJAXCONTENT_THANK_YOU")?></h1>
<p><?=GetMessage("THEBRAINSE_LOADAJAXCONTENT_HAPPY")?> (<a target="_blank" href="<?=GetMessage("THEBRAINSE_LOADAJAXCONTENT_PARTNER_URL")?>"><?=GetMessage("THEBRAINSE_LOADAJAXCONTENT_PARTNER_NAME")?></a>)</p>
<p><?=GetMessage("THEBRAINSE_LOADAJAXCONTENT_COMMENTS")?></p>
</div>
<?
echo CAdminMessage::ShowNote(GetMessage("MOD_INST_OK"));
?>
<form action="<?echo $APPLICATION->GetCurPage()?>">
    <input type="hidden" name="lang" value="<?echo LANG?>">
    <input type="submit" name="" value="<?echo GetMessage("MOD_BACK")?>">
    <form>
