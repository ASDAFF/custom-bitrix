<?php
IncludeModuleLangFile(__FILE__);


class nbrains_loadajaxcontent extends CModule {

    var $MODULE_ID = 'nbrains.loadajaxcontent';

    function __construct(){

        $arModuleVersion = array();
        include(__DIR__.'/version.php');

        $this->MODULE_ID = 'nbrains.loadajaxcontent';
        $this->MODULE_VERSION = $arModuleVersion['VERSION'];
        $this->MODULE_VERSION_DATE = $arModuleVersion['VERSION_DATE'];

        $this->MODULE_NAME = GetMessage('THEBRAINSE_LOADAJAXCONTENT_MODULE_NAME');
        $this->MODULE_DESCRIPTION = GetMessage('THEBRAINSE_LOADAJAXCONTENT_MODULE_DESC');
        $this->PARTNER_NAME = GetMessage('THEBRAINSE_LOADAJAXCONTENT_PARTNER_NAME');
        $this->PARTNER_URI = GetMessage('THEBRAINSE_LOADAJAXCONTENT_PARTNER_URL');

    }

    function DoInstall(){
        global $APPLICATION;
        RegisterModule($this->MODULE_ID);
        CopyDirFiles($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/".$this->MODULE_ID."/install/components/", $_SERVER["DOCUMENT_ROOT"]."/bitrix/components", true, true);
        $APPLICATION->IncludeAdminFile(GetMessage('THEBRAINSE_LOADAJAXCONTENT_INSTALL'),$_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/".$this->MODULE_ID."/install/step.php");
    }

    function DoUninstall(){
        global $APPLICATION;
        UnRegisterModule($this->MODULE_ID);
        DeleteDirFilesEx("/bitrix/components/nbrains/ajax.content");
        $APPLICATION->IncludeAdminFile(GetMessage('THEBRAINSE_LOADAJAXCONTENT_UNINSTALL'),$_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/".$this->MODULE_ID."/install/unstep.php");
    }



}