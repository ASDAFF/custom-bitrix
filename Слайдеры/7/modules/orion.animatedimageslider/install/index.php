<?
IncludeModuleLangFile(__FILE__);
Class orion_animatedimageslider extends CModule
{
	const MODULE_ID = 'orion.animatedimageslider';
	var $MODULE_ID = 'orion.animatedimageslider'; 
	var $MODULE_VERSION;
	var $MODULE_VERSION_DATE;
	var $MODULE_NAME;
	var $MODULE_DESCRIPTION;
	var $MODULE_CSS;
	var $errors = false;

	function __construct()
	{
		$arModuleVersion = array();
		include(dirname(__FILE__)."/version.php");
		$this->MODULE_VERSION = $arModuleVersion["VERSION"];
		$this->MODULE_VERSION_DATE = $arModuleVersion["VERSION_DATE"];
		$this->MODULE_NAME = GetMessage("orion.animatedimageslider_MODULE_NAME");
		$this->MODULE_DESCRIPTION = GetMessage("orion.animatedimageslider_MODULE_DESC");

		$this->PARTNER_NAME = GetMessage("orion.animatedimageslider_PARTNER_NAME");
		$this->PARTNER_URI = GetMessage("orion.animatedimageslider_PARTNER_URI");
	}

	function InstallDB($arParams = array()){
		global $DB, $DBType, $APPLICATION;
		
		return true;
	}

	function UnInstallDB($arParams = array()){
		global $DB, $DBType, $APPLICATION;

		
		return true;
	}
	
	function InstallFiles($arParams = array())
	{
		//админка
		if (is_dir($p = $_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/'.self::MODULE_ID.'/admin'))
		{
			if ($dir = opendir($p))
			{
				while (false !== $item = readdir($dir))
				{
					if ($item == '..' || $item == '.' || $item == 'menu.php')
						continue;
					file_put_contents($file = $_SERVER['DOCUMENT_ROOT'].'/bitrix/admin/'.self::MODULE_ID.'_'.$item,
					'<'.'? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/'.self::MODULE_ID.'/admin/'.$item.'");?'.'>');
				}
				closedir($dir);
			}
		}
		
		//images 
		if (is_dir($p = $_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/'.self::MODULE_ID.'/install/images'))
		{
			if ($dir = opendir($p))
			{
				while (false !== $item = readdir($dir))
				{
					if ($item == '..' || $item == '.')
						continue;
					CopyDirFiles($p.'/'.$item, $_SERVER['DOCUMENT_ROOT'].'/bitrix/images/'.$item, $ReWrite = True, $Recursive = True);
				}
				closedir($dir);
			}
		}		
		
		//тема админки
		if (is_dir($p = $_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/'.self::MODULE_ID.'/install/themes/.default'))
		{
			if ($dir = opendir($p))
			{
				while (false !== $item = readdir($dir))
				{
					if ($item == '..' || $item == '.')
						continue;
					CopyDirFiles($p.'/'.$item, $_SERVER['DOCUMENT_ROOT'].'/bitrix/themes/.default/'.$item, $ReWrite = True, $Recursive = True);
				}
				closedir($dir);
			}
		}		
		
		//js скрипты (общие)
		if (is_dir($p = $_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/'.self::MODULE_ID.'/install/js'))
		{
			if ($dir = opendir($p))
			{
				while (false !== $item = readdir($dir))
				{
					if ($item == '..' || $item == '.')
						continue;
					CopyDirFiles($p.'/'.$item, $_SERVER['DOCUMENT_ROOT'].'/bitrix/js/'.$item, $ReWrite = True, $Recursive = True);
				}
				closedir($dir);
			}
		}		
		
		$src_fn = $_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/'.self::MODULE_ID.'/install/themes/.default/orion.animatedimageslider.css';
		$dest_fn = $_SERVER["DOCUMENT_ROOT"]."/bitrix/themes/.default/orion.animatedimageslider.css";		
		copy($src_fn, $dest_fn);
		
		//компоненты
		if (is_dir($p = $_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/'.self::MODULE_ID.'/install/public/components'))
		{
			if ($dir = opendir($p))
			{
				while (false !== $item = readdir($dir))
				{
					if ($item == '..' || $item == '.')
						continue;
					CopyDirFiles($p.'/'.$item, $_SERVER['DOCUMENT_ROOT'].'/bitrix/components/'.$item, $ReWrite = True, $Recursive = True);
				}
				closedir($dir);
			}
		}		
		
		return true;
	}

	function UnInstallFiles($arParams = array())
	{
		if (is_dir($p = $_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/'.self::MODULE_ID.'/admin'))
		{
			if ($dir = opendir($p))
			{
				while (false !== $item = readdir($dir))
				{
					if ($item == '..' || $item == '.')
						continue;
					unlink($_SERVER['DOCUMENT_ROOT'].'/bitrix/admin/'.self::MODULE_ID.'_'.$item);
				}
				closedir($dir);
			}
		}
		
		if (is_dir($p = $_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/'.self::MODULE_ID.'/install/images'))
		{
			if ($dir = opendir($p))
			{
				while (false !== $item = readdir($dir))
				{
					if ($item == '..' || $item == '.' || !is_dir($p0 = $p.'/'.$item))
						continue;

					$dir0 = opendir($p0);
					while (false !== $item0 = readdir($dir0))
					{
						if ($item0 == '..' || $item0 == '.')
							continue;
						DeleteDirFilesEx('/bitrix/images/'.$item.'/'.$item0);
					}
					closedir($dir0);
				}
				closedir($dir);
			}
		}		
		
		if (is_dir($p = $_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/'.self::MODULE_ID.'/install/themes/.default'))
		{
			if ($dir = opendir($p))
			{
				while (false !== $item = readdir($dir))
				{
					if ($item == '..' || $item == '.' || !is_dir($p0 = $p.'/'.$item))
						continue;

					$dir0 = opendir($p0);
					while (false !== $item0 = readdir($dir0))
					{
						if ($item0 == '..' || $item0 == '.')
							continue;
						DeleteDirFilesEx('/bitrix/themes/.default/'.$item.'/'.$item0);
					}
					closedir($dir0);
				}
				closedir($dir);
			}
		}		
		
		if (is_dir($p = $_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/'.self::MODULE_ID.'/install/public/components'))
		{
			if ($dir = opendir($p))
			{
				while (false !== $item = readdir($dir))
				{
					if ($item == '..' || $item == '.' || !is_dir($p0 = $p.'/'.$item))
						continue;

					$dir0 = opendir($p0);
					while (false !== $item0 = readdir($dir0))
					{
						if ($item0 == '..' || $item0 == '.')
							continue;
						DeleteDirFilesEx('/bitrix/components/'.$item.'/'.$item0);
					}
					closedir($dir0);
				}
				closedir($dir);
			}
		}		
		
		$dest_fn = $_SERVER["DOCUMENT_ROOT"]."/bitrix/themes/.default/orion.animatedimageslider.css";		
		unlink($dest_fn);
		
		return true;
	}

	function DoInstall(){
		global $APPLICATION, $step;
	
		$step = IntVal($step);
			
		if ($step < 2){
			$APPLICATION->IncludeAdminFile(
				GetMessage(self::MODULE_ID."_INSTALL_TITLE"),
				$_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/".self::MODULE_ID."/install/inst1.php"
			);
		} elseif ($step == 2) {				
			$this->InstallFiles();
			$this->InstallDB();
			
			RegisterModule(self::MODULE_ID);
			RegisterModuleDependences('main', 'OnBuildGlobalMenu', self::MODULE_ID, 'COrionAnimatedImageSlider', 'OnBuildGlobalMenu');
			RegisterModuleDependences('main', 'OnEpilog', self::MODULE_ID, 'COrionAnimatedImageSlider', 'OnEpilog');			
		
			$GLOBALS["errors"] = $this->errors;	
			$APPLICATION->IncludeAdminFile(
				GetMessage(self::MODULE_ID."_INSTALL_TITLE"),
				$_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/".self::MODULE_ID."/install/inst2.php"
			);
		}
	}

	function DoUninstall(){
		global $APPLICATION, $step;
		
		$RIGHT = $APPLICATION->GetGroupRight(self::MODULE_ID);
		if ($RIGHT=="W")
		{
			if ($step < 2){
				$APPLICATION->IncludeAdminFile(
					GetMessage(self::MODULE_ID."_DELETE_TITLE"),
					$_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/".self::MODULE_ID."/install/uninst1.php"
				);
			} elseif ($step == 2) {		
				UnRegisterModuleDependences('main', 'OnEpilog', self::MODULE_ID, 'COrionAnimatedImageSlider', 'OnEpilog');
				UnRegisterModuleDependences('main', 'OnBuildGlobalMenu', self::MODULE_ID, 'COrionAnimatedImageSlider', 'OnBuildGlobalMenu');
				UnRegisterModule(self::MODULE_ID);			
				
				$this->UnInstallFiles(array(
					"savedata" => $_REQUEST["savedata"],
				));
			
				$this->UnInstallDB(array(
					"savedata" => $_REQUEST["savedata"],
				));
			
				//удаляем все сохраненные параметры модуля
				COption::RemoveOption(self::MODULE_ID);

				$GLOBALS["errors"] = $this->errors;
				$APPLICATION->IncludeAdminFile(
					GetMessage(self::MODULE_ID."_DELETE_TITLE"),
					$_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/".self::MODULE_ID."/install/uninst2.php"
				);
			}	
		}
	}
}
?>
