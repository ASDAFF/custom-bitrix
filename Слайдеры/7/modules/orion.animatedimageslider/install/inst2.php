<?if(!check_bitrix_sessid()) return;?>
<?
IncludeModuleLangFile($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/orion.animatedimageslider/install/index.php");

if($errors===false):
	echo CAdminMessage::ShowNote(GetMessage("MOD_INST_OK"));
	echo '<br/>';
	echo '<span style="font:13px Tahoma">';
	echo GetMessage('MOD_INFO');
	echo '</span>';
	echo '<br/>';
	echo '<br/>';
else:
	for($i=0; $i<count($errors); $i++)
		$alErrors .= $errors[$i]."<br>";
	echo CAdminMessage::ShowMessage(Array("TYPE"=>"ERROR", "MESSAGE" =>GetMessage("MOD_INST_ERR"), "DETAILS"=>$alErrors, "HTML"=>true));
endif;
?>
<form action="<?echo $APPLICATION->GetCurPage()?>">
	<input type="hidden" name="lang" value="<?echo LANG?>" />
	<input type="submit" name="" value="<?echo GetMessage("MOD_BACK")?>" />
</form>