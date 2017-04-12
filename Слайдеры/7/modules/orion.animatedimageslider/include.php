<?
require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/orion.animatedimageslider/prolog.php");

global $DBType;
IncludeModuleLangFile(__FILE__);

CModule::AddAutoloadClasses(
	ADMIN_MODULE_NAME,
	array(
	)
);

Class COrionAnimatedImageSlider
{	
	function GetComponentId($length = 6){
		//$chars = 'abdefhiknrstyzABDEFGHKNQRSTYZ23456789';
		$chars = 'abdefhiknrstyz23456789';
		$numChars = strlen($chars);
		$string = '';
		for ($i = 0; $i < $length; $i++) {
			$string .= substr($chars, rand(1, $numChars) - 1, 1);
		}
		return $string;
	}
	
	function ResizePicture($data){
		$pict = array();
		if($data['t'] =='BX_RESIZE_IMAGE_EXACT')
			$pict = CFile::ResizeImageGet(
				$data['id'], 
				array('width' => $data['w'], 'height' => $data['h']), 
				BX_RESIZE_IMAGE_EXACT, 
				true
			);
			
		if($data['t'] =='BX_RESIZE_IMAGE_PROPORTIONAL')
			$pict = CFile::ResizeImageGet(
				$data['id'], 
				array('width' => $data['w'], 'height' => $data['h']), 
				BX_RESIZE_IMAGE_PROPORTIONAL, 
				true
			);
			
		if($data['t'] =='BX_RESIZE_IMAGE_PROPORTIONAL_ALT')
			$pict = CFile::ResizeImageGet(
				$data['id'], 
				array('width' => $data['w'], 'height' => $data['h']), 
				BX_RESIZE_IMAGE_PROPORTIONAL_ALT, 
				true
			);
		
		$ar = array();
		foreach($pict as $fld => $val) $ar[strtoupper($fld)] = $val;
		
		return array_merge($pict, $ar);				
	}
	
	function AddJS($need_jquery, $arJs = array()){
		global $APPLICATION;
	
		if(!$arJs || in_array('jquery', $arJs))
		switch($need_jquery){
			case 'BITRIX_JQUERY' : 
				CUtil::InitJSCore(Array("jquery"));
				break;
			case 'EXISTS_JQUERY' : 
				break;
			default:
				CUtil::InitJSCore(Array("jquery"));
		}

		if(in_array('skitter', $arJs))
		$APPLICATION->AddHeadScript("/bitrix/js/orion.misc/skitter_slideshow/jquery.skitter40_mod1-min.js" , true);
		
		if(in_array('easing', $arJs))
		$APPLICATION->AddHeadScript("/bitrix/js/orion.misc/skitter_slideshow/jquery.easing.1.3.js" , true);
		
		if(in_array('animate-colors', $arJs))
		$APPLICATION->AddHeadScript("/bitrix/js/orion.misc/skitter_slideshow/jquery.animate-colors-min.js" , true);	
	}
	
	function OnEpilog(){
		global $APPLICATION;
		
		if($APPLICATION->GetPageProperty("orion.ais.skitter") == 'Y')
		$APPLICATION->AddHeadScript("/bitrix/js/orion.misc/skitter_slideshow/jquery.skitter40_mod1-min.js" , true);
		
		if($APPLICATION->GetPageProperty("orion.ais.easing") == 'Y')
		$APPLICATION->AddHeadScript("/bitrix/js/orion.misc/skitter_slideshow/jquery.easing.1.3.js" , true);
		
		if($APPLICATION->GetPageProperty("orion.ais.animate-colors") == 'Y')
		$APPLICATION->AddHeadScript("/bitrix/js/orion.misc/skitter_slideshow/jquery.animate-colors-min.js" , true);			
	}

	function OnBuildGlobalMenu(&$aGlobalMenu, &$aModuleMenu)
	{				
		$MODULE_ID = basename(dirname(__FILE__));

		$arSubItems = array(
			'text' => GetMessage('ais_comp'),
			'url' => $MODULE_ID.'_ais_comp.php',
			'more_url' => array(
			),
			'module_id' => $MODULE_ID,
			"title" => "",
			"items_id" => "orion_soft_ais_comp",
			"icon" => 'ais_comp_menu_icon',
			"page_icon" => 'ais_comp_page_icon',
		);
		
		$arOrionSoftMenu = array();
		//поиск элемента меню Орион Софт
		foreach($aModuleMenu as &$item){
			if($item['items_id'] == 'orion_soft_menu' && $item['parent_menu'] = 'global_menu_services'){
				$arOrionSoftMenu = $item;
				break;
			}
		}
		unset($item);
		
		if(!$arOrionSoftMenu){
			//если не нашли, то добавляем
			$arOrionSoftMenu = array(
				'parent_menu' => 'global_menu_services',
				'text' => GetMessage('ais_company'),
				'url' => '',//$MODULE_ID.'_efbf_index.php', //$MODULE_ID.'_company.php',
				'more_url' => array(
				),
				'module_id' => $MODULE_ID,
				"title" => "",
				"items_id" => "orion_soft_menu",
				"icon" => 'orion_soft_menu_icon',
				"items" => array($arSubItems),
			);
		
			$aModuleMenu[] = $arOrionSoftMenu; 
		}else{
			//если нашли, то добавляем только элементы 2-го уровня
			$arOrionSoftMenu['items'][] = $arSubItems;
		}		

		//устанавливаем url orion_soft_menu на первый элемент в списке 		
		foreach($aModuleMenu as &$item){
			if($item['items_id'] == 'orion_soft_menu'){
				$item = $arOrionSoftMenu;
				$item['url'] = $arOrionSoftMenu['items'][0]['url'];
				break;
			}
		}
		unset($item);	
	}
	
	function GetAISParameters($arCurrentValues){
	
		$arJqueryVariants = array(
			"ORION_JQUERY" => GetMessage('TP_AIS_ORION_JQUERY'),
			"BITRIX_JQUERY" => GetMessage('TP_AIS_BITRIX_JQUERY'),	
			"EXISTS_JQUERY" => GetMessage('TP_AIS_EXISTS_JQUERY'),
		);

		$arAnimations = array(
			'blind' => GetMessage('TP_AIS_ANIM_BLIND'),
			'blindHeight' => GetMessage('TP_AIS_ANIM_BLIND_HEIGHT'),
			'blindWidth' => GetMessage('TP_AIS_ANIM_BLIND_WIDTH'),
			'block' => GetMessage('TP_AIS_ANIM_BLOCK'),
			'circles' => GetMessage('TP_AIS_ANIM_CIRCLES'),
			'circlesInside' => GetMessage('TP_AIS_ANIM_CIRCLES_INSIDE'),
			'circlesRotate' => GetMessage('TP_AIS_ANIM_CIRCLES_ROTATE'),
			'cubeHide' => GetMessage('TP_AIS_ANIM_CUBE_HIDE'),
			'cubeJelly' => GetMessage('TP_AIS_ANIM_CUBE_JELLY'),
			'cubeRandom' => GetMessage('TP_AIS_ANIM_CUBE_RANDOM'),
			'cubeShow' => GetMessage('TP_AIS_ANIM_CUBE_SHOW'),
			'cubeSize' => GetMessage('TP_AIS_ANIM_CUBE_SIZE'),
			'cubeSpread' => GetMessage('TP_AIS_ANIM_CUBE_SPREAD'),
			'cubeStop' => GetMessage('TP_AIS_ANIM_CUBE_STOP'),
			'cubeStopRandom' => GetMessage('TP_AIS_ANIM_CUBE_STOP_RANDOM'),
			'cut' => GetMessage('TP_AIS_ANIM_CUT'),
			'directionBottom' => GetMessage('TP_AIS_ANIM_DIRECTION_BOTTOM'),
			'directionLeft' => GetMessage('TP_AIS_ANIM_DIRECTION_LEFT'),
			'directionRight' => GetMessage('TP_AIS_ANIM_DIRECTION_RIGHT'),
			'directionTop' => GetMessage('TP_AIS_ANIM_DIRECTION_TOP'),
			'downBars' => GetMessage('TP_AIS_ANIM_DOWN_BARS'),
			'fade' => GetMessage('TP_AIS_ANIM_FADE'),
			'fadeFour' => GetMessage('TP_AIS_ANIM_FADE_FOUR'),
			'glassBlock' => GetMessage('TP_AIS_ANIM_GLASS_BLOCK'),
			'glassCube' => GetMessage('TP_AIS_ANIM_GLASS_CUBE'),
			'hideBars' => GetMessage('TP_AIS_ANIM_HIDE_BARS'),
			'horizontal' => GetMessage('TP_AIS_ANIM_HORIZONTAL'),
			'paralell' => GetMessage('TP_AIS_ANIM_PARALELL'),
			'random' => GetMessage('TP_AIS_ANIM_RANDOM'),
			'randomSmart' => GetMessage('TP_AIS_ANIM_RANDOM_SMART'),
			'showBars' => GetMessage('TP_AIS_ANIM_SHOW_BARS'),
			'showBarsRandom' => GetMessage('TP_AIS_ANIM_SHOW_BARS_BOTTOM'),
			'swapBars' => GetMessage('TP_AIS_ANIM_SWAP_BARS'),
			'swapBarsBack' => GetMessage('TP_AIS_ANIM_SWAP_BARS_BACK'),
			'swapBlocks' => GetMessage('TP_AIS_ANIM_SWAP_BLOCKS'),
			'tube' => GetMessage('TP_AIS_ANIM_TUBE'),
			'upBars' => GetMessage('TP_AIS_ANIM_UP_BARS'),
			'cube' => GetMessage('TP_AIS_ANIM_CUBE')
		);
			
		foreach($arAnimations as $key => $value){$arAnimations[$key] = '['.$key.'] '.$value;}
			
		$arAnimationsWithDef = array_merge(array('ext_mode' => GetMessage('TP_AIS_ANIM_EXT')), $arAnimations);
		
		$arControlPositions = array(
			'center' => GetMessage('TP_AIS_CP_CENTER'),
			'leftTop' => GetMessage('TP_AIS_CP_LEFT_TOP'),
			'rightTop' => GetMessage('TP_AIS_CP_RIGHT_TOP'),
			'leftBottom' => GetMessage('TP_AIS_CP_LEFT_BOTOM'),
			'rightBottom' => GetMessage('TP_AIS_CP_RIGHT_BOTOM'),
		);
		//$arFocusPositions = $arControlPositions;
		
		foreach($arControlPositions as $key => $value){$arControlPositions[$key] = '['.$key.'] '.$value;}	
		//foreach($arFocusPositions as $key => $value){$arFocusPositions[$key] = '['.$key.'] '.$value;}	
		
		$arHoriz_Align = array(
			'left' => GetMessage('TP_AIS_HA_LEFT'),
			'center' => GetMessage('TP_AIS_HA_CENTER'),
			'right' => GetMessage('TP_AIS_HA_RIGHT'),
		);
		
		foreach($arHoriz_Align as $key => $value){$arHoriz_Align[$key] = '['.$key.'] '.$value;}	
		
		$arVert_Align = array(
			'css' => GetMessage('TP_AIS_VA_CSS'),
			'top' => GetMessage('TP_AIS_VA_TOP'),
			'bottom' => GetMessage('TP_AIS_VA_BOTTOM'),
		);
		
		foreach($arVert_Align as $key => $value){$arVert_Align[$key] = '['.$key.'] '.$value;}
		
		$arImageResizeTypes = array(
			'BX_RESIZE_IMAGE_EXACT' => GetMessage('TP_AIS_IRT_BX_RESIZE_IMAGE_EXACT'),
			'BX_RESIZE_IMAGE_PROPORTIONAL' => GetMessage('TP_AIS_IRT_BX_RESIZE_IMAGE_PROPORTIONAL'),
			'BX_RESIZE_IMAGE_PROPORTIONAL_ALT' => GetMessage('TP_AIS_IRT_BX_RESIZE_IMAGE_PROPORTIONAL_ALT'),
		);
		
		foreach($arImageResizeTypes as $key => $value){$arImageResizeTypes[$key] = '['.$key.'] '.$value;}
		
		$arEasingDef = array(
			'easeInQuad' => 'easeInQuad',
			'easeOutQuad' => 'easeOutQuad',
			'easeInOutQuad' => 'easeInOutQuad',
			'easeInCubic' => 'easeInCubic',
			'easeOutCubic' => 'easeOutCubic',
			'easeInOutCubic' => 'easeInOutCubic',
			'easeInQuart' => 'easeInQuart',
			'easeOutQuart' => 'easeOutQuart',
			'easeInOutQuart' => 'easeInOutQuart',
			'easeInQuint' => 'easeInQuint',
			'easeOutQuint' => 'easeOutQuint',
			'easeInOutQuint' => 'easeInOutQuint',
			'easeInSine' => 'easeInSine',
			'easeOutSine' => 'easeOutSine',
			'easeInOutSine' => 'easeInOutSine',
			'easeInExpo' => 'easeInExpo',
			'easeOutExpo' => 'easeOutExpo',
			'easeInOutExpo' => 'easeInOutExpo',
			'easeInCirc' => 'easeInCirc',
			'easeOutCirc' => 'easeOutCirc',
			'easeInOutCirc' => 'easeInOutCirc',
			'easeInElastic' => 'easeInElastic',
			'easeOutElastic' => 'easeOutElastic',
			'easeInOutElastic' => 'easeInOutElastic',
			'easeInBack' => 'easeInBack',
			'easeOutBack' => 'easeOutBack',
			'easeInOutBack' => 'easeInOutBack',
			'easeInBounce' => 'easeInBounce',
			'easeOutBounce' => 'easeOutBounce',
			'easeInOutBounce' => 'easeInOutBounce'
		);
		
		$arYesNo = array(
			'true' => '[Y] '.GetMessage('TP_AIS_YN_YES'),
			'false' => '[N] '.GetMessage('TP_AIS_YN_NO'),		
		);
		
		$arAuto = array(
			'auto' => 'auto',
		);	
		
		$arPosition = array(
			'' => GetMessage('TP_AIS_POS_NONE'),
			'absolute' => GetMessage('TP_AIS_POS_ABS'),
			'relative' => GetMessage('TP_AIS_POS_REL'),
			'left' => GetMessage('TP_AIS_POS_LEFT'),
			'right' => GetMessage('TP_AIS_POS_RIGHT'),
			'center' => GetMessage('TP_AIS_POS_CENTER'),
		);	
		
		$arNavModes = array(
			'' => GetMessage('TP_AIS_NAV_NOT'),
			'numbers' => GetMessage('TP_AIS_NAV_NUMBERS'),
			'thumbs' => GetMessage('TP_AIS_NAV_THUMBS'),
			'dots' => GetMessage('TP_AIS_NAV_DOTS'),
			'dotsWithPreview' => GetMessage('TP_AIS_NAV_DOTS_WITH_PREVIEW'),				
		);

		$arTemplateParameters = array(
			"BKGRND_COLOR" => Array(
				"PARENT" => "TEMPLATE",
				"NAME" => GetMessage("TP_AIS_BKGRND_COLOR"),
				"TYPE" => "STRING",
				"DEFAULT" => '',
			),		
			
			"WIDTH" => Array(
				"PARENT" => "TEMPLATE",
				"NAME" => GetMessage("TP_AIS_WIDTH"),
				"TYPE" => "STRING",
				"DEFAULT" => "800px",
			),		

			"HEIGHT" => Array(
				"PARENT" => "TEMPLATE",
				"NAME" => GetMessage("TP_AIS_HEIGHT"),
				"TYPE" => "STRING",
				"DEFAULT" => "300px",
			),		
			
			"MARGIN" => Array(
				"PARENT" => "TEMPLATE",
				"NAME" => GetMessage("TP_AIS_MARGIN"),
				"TYPE" => "STRING",
				"DEFAULT" => '',
			),		
			
			"PADDING" => Array(
				"PARENT" => "TEMPLATE",
				"NAME" => GetMessage("TP_AIS_PADDING"),
				"TYPE" => "STRING",
				"DEFAULT" => '',
			),		
			
			"POSITION" => Array(
				"PARENT" => "TEMPLATE",
				"NAME" => GetMessage("TP_AIS_POSITION"),
				"TYPE" => "LIST",
				"VALUES" => $arPosition,
				"REFRESH" => 'Y',
			),		
			
			"IMAGE_RESIZE" => Array(
				"PARENT" => "RESIZE_IMG",
				"NAME" => GetMessage("TP_AIS_IMAGE_RESIZE"),
				"TYPE" => "LIST",
				"VALUES" => $arYesNo,
				"DEFAULT" => 'false',
				"REFRESH" => 'Y',
			),

			"SKITTER_NAVIGATION_ARROWS" => Array(
				"PARENT" => "NAVIGATION_BLOCK",
				"NAME" => GetMessage("TP_AIS_NAVIGATION_ARROWS"),
				"TYPE" => "LIST",
				"VALUES" => $arYesNo,
				"DEFAULT" => 'true',
			),		
			
			"SKITTER_ENABLE_NAVIGATION_KEYS" => Array(
				"PARENT" => "NAVIGATION_BLOCK",
				"NAME" => GetMessage("TP_AIS_ENABLE_NAVIGATION_KEYS"),
				"TYPE" => "LIST",
				"VALUES" => $arYesNo,
				"DEFAULT" => 'false',
			),
			
			"SKITTER_NAV" => Array(
				"PARENT" => "NAVIGATION_BLOCK",
				"NAME" => GetMessage("TP_AIS_NAV_BLOCK"),
				"TYPE" => "LIST",
				"VALUES" => $arNavModes,
				"DEFAULT" => '',
				"REFRESH" => 'Y'
			),

			"SKITTER_ANIMATION" => Array(
				"PARENT" => "ANIMATION",
				"NAME" => GetMessage("TP_AIS_ANIMATION"),
				"TYPE" => "LIST",
				"VALUES" => $arAnimationsWithDef,
				"DEFAULT" => 'fade',
				"REFRESH" => 'Y'
			),		

			"SKITTER_AUTO_PLAY" => Array(
				"PARENT" => "PLAY_PAUSE_CONTROL_BLOCK",
				"NAME" => GetMessage("TP_AIS_AUTO_PLAY"),
				"TYPE" => "LIST",
				"VALUES" => $arYesNo,
				"DEFAULT" => 'true',
				"REFRESH" => 'Y',
			),		
			
			/*"SKITTER_FOCUS" => Array(
				"PARENT" => "FOCUS_BLOCK",
				"NAME" => GetMessage("TP_AIS_FOCUS"),
				"TYPE" => "LIST",
				"VALUES" => $arYesNo,
				"DEFAULT" => 'false',
				"REFRESH" => 'Y',			
			),*/		

			"SKITTER_LABEL" => Array(
				"PARENT" => "DESC_BLOCK",
				"NAME" => GetMessage("TP_AIS_LABEL"),
				"TYPE" => "LIST",
				"VALUES" => $arYesNo,
				"DEFAULT" => 'true',
				"REFRESH" => 'Y',
			),		
			
			"SKITTER_STOP_OVER" => Array(
				"PARENT" => "CONTROL_BLOCK",
				"NAME" => GetMessage("TP_AIS_STOP_OVER"),
				"TYPE" => "LIST",
				"VALUES" => $arYesNo,
				"DEFAULT" => 'true',
			),		

			"SKITTER_HIDE_TOOLS" => Array(
				"PARENT" => "CONTROL_BLOCK",
				"NAME" => GetMessage("TP_AIS_HIDE_TOOLS"),
				"TYPE" => "LIST",
				"VALUES" => $arYesNo,
				"DEFAULT" => 'false',
			),

			"SKITTER_ON_LOAD" => Array(
				"PARENT" => "JS_EVENT_BLOCK",
				"NAME" => GetMessage("TP_AIS_ON_LOAD"),
				"TYPE" => "STRING",
				"DEFAULT" => '',
			),

			"SKITTER_MOUSE_OVER_OUT_BUTTON_NON_STD" => Array(
				"PARENT" => "JS_EVENT_BLOCK",
				"NAME" => GetMessage("TP_AIS_MOUSE_OVER_OUT_BUTTON_NON_STD"),
				"TYPE" => "LIST",
				"VALUES" => $arYesNo,
				"DEFAULT" => 'false',
				"REFRESH" => 'Y',
			),
			
			"NEED_JQUERY" => Array(
				"PARENT" => "JQUERY",
				"NAME" => GetMessage("TP_AIS_NEED_JQUERY"),
				"TYPE" => "LIST",
				"VALUES" => $arJqueryVariants,
				"DEFAULT" => 'ORION_JQUERY',
			),
		);
		
		if($arCurrentValues['IMAGE_RESIZE'] == 'true'){
			$arTemplateParameters["IMAGE_RESIZE_TYPE"] = Array(
				"PARENT" => "RESIZE_IMG",
				"NAME" => GetMessage("TP_AIS_IMAGE_RESIZE_TYPE"),
				"TYPE" => "LIST",
				"VALUES" => $arImageResizeTypes,
				"DEFAULT" => 'BX_RESIZE_IMAGE_EXACT',
			);
		
			$arTemplateParameters["IMAGE_RESIZE_WIDTH"] = Array(
				"PARENT" => "RESIZE_IMG",
				"NAME" => GetMessage("TP_AIS_IMAGE_RESIZE_WIDTH"),
				"TYPE" => "STRING",
				"DEFAULT" => '',
			);
		
			$arTemplateParameters["IMAGE_RESIZE_HEIGHT"] = Array(
				"PARENT" => "RESIZE_IMG",
				"NAME" => GetMessage("TP_AIS_IMAGE_RESIZE_HEIGHT"),
				"TYPE" => "STRING",
				"DEFAULT" => '',
			);	
		}

		if($arCurrentValues['SKITTER_MOUSE_OVER_OUT_BUTTON_STD'] == 'true'){
			$arTemplateParameters["SKITTER_MOUSE_OVER_BUTTON"] = Array(
				"PARENT" => "JS_EVENT_BLOCK",
				"NAME" => GetMessage("TP_AIS_MOUSE_OVER_BUTTON"),
				"TYPE" => "STRING",
				"DEFAULT" => '',
			);
			
			$arTemplateParameters["SKITTER_MOUSE_OUT_BUTTON"] = Array(
				"PARENT" => "JS_EVENT_BLOCK",
				"NAME" => GetMessage("TP_AIS_MOUSE_OUT_BUTTON"),
				"TYPE" => "STRING",
				"DEFAULT" => '',
			);		
		}

		if($arCurrentValues['SKITTER_ANIMATION'] == 'ext_mode'){
			$arTemplateParameters["SKITTER_ANIMATION_COUNT"] = Array(
				"PARENT" => "ANIMATION",
				"NAME" => GetMessage("TP_AIS_ANIMATION_COUNT"),
				"TYPE" => "STRING",
				"DEFAULT" => '0',
				'REFRESH' => 'Y',
			);	
		}

		if($arCurrentValues['SKITTER_ANIMATION'] == 'ext_mode'){
			$anim_cnt = intval($arCurrentValues['SKITTER_ANIMATION_COUNT']);
			if($anim_cnt > 0){		
				for($i = 1; $i <= $anim_cnt; $i++){
					$arTemplateParameters["SKITTER_ANIMATION_".$i] = Array(
						"PARENT" => "ANIMATION",
						"NAME" => str_replace('N', $i, GetMessage("TP_AIS_ANIMATION_N")),
						"TYPE" => "LIST",
						"VALUES" => $arAnimations,
						"DEFAULT" => "fade",
					);
				}
			}
		}
		
		$arTemplateParameters["SKITTER_INTERVAL"] = Array(
			"PARENT" => "ANIMATION",
			"NAME" => GetMessage("TP_AIS_INTERVAL"),
			"TYPE" => "STRING",
			"DEFAULT" => '2500',
		);		

		$arTemplateParameters["SKITTER_VELOCITY"] = Array(
			"PARENT" => "ANIMATION",
			"NAME" => GetMessage("TP_AIS_VELOCITY"),
			"TYPE" => "STRING",
			"DEFAULT" => '1',
		);	

		
		if($arCurrentValues['SKITTER_NAV'] == 'thumbs'){	
			$arTemplateParameters["SKITTER_NUMBERS_ALIGN"] = Array(
				"PARENT" => "NAVIGATION_BLOCK",
				"NAME" => GetMessage("TP_AIS_NUMBERS_ALIGN"),
				"TYPE" => "LIST",
				"VALUES" => $arHoriz_Align,
				"DEFAULT" => 'left',
			);
		}	
		
		if($arCurrentValues['SKITTER_NAV'] == 'dots' || $arCurrentValues['SKITTER_NAV'] == 'dotsWithPreview'){	
			$arTemplateParameters["SKITTER_NUMBERS_ALIGN"] = Array(
				"PARENT" => "NAVIGATION_BLOCK",
				"NAME" => GetMessage("TP_AIS_NUMBERS_ALIGN"),
				"TYPE" => "LIST",
				"VALUES" => $arHoriz_Align,
				"DEFAULT" => 'left',
			);		
		}	
		
		if($arCurrentValues['SKITTER_NAV'] == 'dotsWithPreview'){	
			$arTemplateParameters["SKITTER_PREVIEW"] = Array(
				"PARENT" => "NAVIGATION_BLOCK",
				"NAME" => GetMessage("TP_AIS_DOTS_PREVIEW"),
				"TYPE" => "LIST",
				"VALUES" => $arYesNo,
				"DEFAULT" => 'true',
			);
		}		

		if($arCurrentValues['SKITTER_NAV'] != ''){
			if($arCurrentValues['SKITTER_NAV'] != 'thumbs'){			
				$arTemplateParameters["SKITTER_THUMBS_VERT_ALIGN"] = Array(
					"PARENT" => "NAVIGATION_BLOCK",
					"NAME" => GetMessage("TP_AIS_THUMBS_VERT_ALIGN"),
					"TYPE" => "LIST",
					"VALUES" => $arVert_Align,
					"DEFAULT" => 'css',
				);		
			}
			
			$arTemplateParameters["SKITTER_NUMBERS_ALIGN"] = Array(
				"PARENT" => "NAVIGATION_BLOCK",
				"NAME" => GetMessage("TP_AIS_NUMBERS_ALIGN"),
				"TYPE" => "LIST",
				"VALUES" => $arHoriz_Align,
				"DEFAULT" => 'left',
			);
			
			$arTemplateParameters["ANIMATE_NUMBER_ACTIVE_BG"] = Array(
				"PARENT" => "NAVIGATION_BLOCK",
				"NAME" => GetMessage("TP_AIS_ANIMATE_NUMBER_ACTIVE_BG"),
				"TYPE" => "STRING",
				"DEFAULT" => '#C00',
			);
			
			$arTemplateParameters["ANIMATE_NUMBER_OUT_BG"] = Array(
				"PARENT" => "NAVIGATION_BLOCK",
				"NAME" => GetMessage("TP_AIS_ANIMATE_NUMBER_OUT_BG"),
				"TYPE" => "STRING",
				"DEFAULT" => '#333',
			);
			
			$arTemplateParameters["ANIMATE_NUMBER_ACTIVE_FG"] = Array(
				"PARENT" => "NAVIGATION_BLOCK",
				"NAME" => GetMessage("TP_AIS_ANIMATE_NUMBER_ACTIVE_FG"),
				"TYPE" => "STRING",
				"DEFAULT" => '#fff',
			);

			$arTemplateParameters["ANIMATE_NUMBER_OUT_FG"] = Array(
				"PARENT" => "NAVIGATION_BLOCK",
				"NAME" => GetMessage("TP_AIS_ANIMATE_NUMBER_OUT_FG"),
				"TYPE" => "STRING",
				"DEFAULT" => '#fff',
			);
			
			$arTemplateParameters["ANIMATE_NUMBER_OVER_FG"] = Array(
				"PARENT" => "NAVIGATION_BLOCK",
				"NAME" => GetMessage("TP_AIS_ANIMATE_NUMBER_OVER_FG"),
				"TYPE" => "STRING",
				"DEFAULT" => '#000',
			);		
		}		
		
		if($arCurrentValues['SKITTER_LABEL'] == 'true'){	
			$arTemplateParameters["SKITTER_WIDTH_LABEL"] = Array(
				"PARENT" => "DESC_BLOCK",
				"NAME" => GetMessage("TP_AIS_WIDTH_LABEL"),
				"TYPE" => "LIST",
				"VALUES" => $arAuto,
				"ADDITIONAL_VALUES" => 'Y',
				"DEFAULT" => '100%',
			);		
		}
		
		if($arCurrentValues['SKITTER_AUTO_PLAY'] == 'true'){	
			$arTemplateParameters["SKITTER_CONTROLS"] = Array(
				"PARENT" => "PLAY_PAUSE_CONTROL_BLOCK",
				"NAME" => GetMessage("TP_AIS_CONTROLS"),
				"TYPE" => "LIST",
				"VALUES" => $arYesNo,
				"DEFAULT" => 'false',
				"REFRESH" => 'Y',
			);
		}
		
		if($arCurrentValues['SKITTER_AUTO_PLAY'] == 'true' && $arCurrentValues['SKITTER_CONTROLS'] == 'true'){	
			$arTemplateParameters["SKITTER_CONTROLS_POSITION"] = Array(
				"PARENT" => "PLAY_PAUSE_CONTROL_BLOCK",
				"NAME" => GetMessage("TP_AIS_CONTROLS_POSITION"),
				"TYPE" => "LIST",
				"VALUES" => $arControlPositions,
				"DEFAULT" => 'center',
			);
		}
		
		/*if($arCurrentValues['SKITTER_FOCUS'] == 'true'){	
			$arTemplateParameters["SKITTER_FOCUS_POSITION"] = Array(
				"PARENT" => "FOCUS_BLOCK",
				"NAME" => GetMessage("TP_AIS_FOCUS_POSITION"),
				"TYPE" => "LIST",
				"VALUES" => $arFocusPositions,
				"DEFAULT" => 'center',
			);
		}*/
		
		if($arCurrentValues['POSITION'] == 'absolute' || $arCurrentValues['POSITION'] == 'relative'){	
			$arTemplateParameters["POSITION_LEFT"] = Array(
				"PARENT" => "TEMPLATE",
				"NAME" => GetMessage("TP_AIS_POSITION_LEFT"),
				"TYPE" => "STRING",
				"DEFAULT" => '',
			);
			$arTemplateParameters["POSITION_TOP"] = Array(
				"PARENT" => "TEMPLATE",
				"NAME" => GetMessage("TP_AIS_POSITION_TOP"),
				"TYPE" => "STRING",
				"DEFAULT" => '',
			);
			$arTemplateParameters["POSITION_RIGHT"] = Array(
				"PARENT" => "TEMPLATE",
				"NAME" => GetMessage("TP_AIS_POSITION_RIGHT"),
				"TYPE" => "STRING",
				"DEFAULT" => '',
			);
			$arTemplateParameters["POSITION_BOTTOM"] = Array(
				"PARENT" => "TEMPLATE",
				"NAME" => GetMessage("TP_AIS_POSITION_BOTTOM"),
				"TYPE" => "STRING",
				"DEFAULT" => '',
			);
		}
		
		return $arTemplateParameters;
	}
	
	function GetAISOptions($skitterId, $arParams){
		$arOptions = array();		
		$arOptions['animation'] = $arParams['SKITTER_ANIMATION'];
		
		if($arParams['ANIMATE_NUMBER_ACTIVE_BG']) $arOptions['animateNumberActive']['backgroundColor'] = $arParams['ANIMATE_NUMBER_ACTIVE_BG'];
		if($arParams['ANIMATE_NUMBER_ACTIVE_FG']) $arOptions['animateNumberActive']['color'] = $arParams['ANIMATE_NUMBER_ACTIVE_FG'];
		
		if($arParams['ANIMATE_NUMBER_OUT_BG']) $arOptions['animateNumberOut']['backgroundColor'] = $arParams['ANIMATE_NUMBER_OUT_BG'];
		if($arParams['ANIMATE_NUMBER_OUT_FG']) $arOptions['animateNumberOut']['color'] = $arParams['ANIMATE_NUMBER_OUT_FG'];
		
		if($arParams['ANIMATE_NUMBER_OVER_BG']) $arOptions['animateNumberOver']['backgroundColor'] = $arParams['ANIMATE_NUMBER_OVER_BG'];
		if($arParams['ANIMATE_NUMBER_OVER_FG']) $arOptions['animateNumberOver']['color'] = $arParams['ANIMATE_NUMBER_OVER_FG'];
		
		if($arParams['SKITTER_AUTO_PLAY']) $arOptions['auto_play'] = $arParams['SKITTER_AUTO_PLAY'];
		if($arParams['SKITTER_CONTROLS']) $arOptions['controls'] = $arParams['SKITTER_CONTROLS'];
		if($arParams['SKITTER_CONTROLS_POSITION']) $arOptions['controls_position'] = $arParams['SKITTER_CONTROLS_POSITION'];
		if($arParams['SKITTER_NAV'] == 'dots' || $arParams['SKITTER_NAV'] == 'dotsWithPreview') $arOptions['dots'] = true;
		
		if($arParams['SKITTER_ENABLE_NAVIGATION_KEYS']) $arOptions['enable_navigation_keys'] = $arParams['SKITTER_ENABLE_NAVIGATION_KEYS'];
		//if($arParams['SKITTER_FOCUS']) $arOptions['focus'] = $arParams['SKITTER_FOCUS'];
		$arOptions['focus'] =false;
		//if($arParams['SKITTER_FOCUS_POSITION']) $arOptions['focus_position'] = $arParams['SKITTER_FOCUS_POSITION'];

		if($arParams['SKITTER_HIDE_TOOLS']) $arOptions['hideTools'] = $arParams['SKITTER_HIDE_TOOLS'];
		if($arParams['SKITTER_INTERVAL']) $arOptions['interval'] = $arParams['SKITTER_INTERVAL'];
		if($arParams['SKITTER_LABEL']) $arOptions['label'] = $arParams['SKITTER_LABEL'];		
		if($arParams['SKITTER_NAVIGATION_ARROWS']) $arOptions['navigation'] = $arParams['SKITTER_NAVIGATION_ARROWS'];		
		
		$arOptions['numbers'] = ($arParams['SKITTER_NAV'] == 'numbers') ? true : false;
		
		if($arParams['SKITTER_NUMBERS_ALIGN']) $arOptions['numbers_align'] = $arParams['SKITTER_NUMBERS_ALIGN'];		
		
		/*if($arParams['SKITTER_MOUSE_OUT_BUTTON'])*/ $arOptions['mouseOutButton'] = 'mouseOut';//$arParams['SKITTER_MOUSE_OUT_BUTTON'];		
		/*if($arParams['SKITTER_MOUSE_OVER_BUTTON'])*/ $arOptions['mouseOverButton'] = 'mouseOver';//$arParams['SKITTER_MOUSE_OVER_BUTTON'];		
		/*if($arParams['SKITTER_ON_LOAD'])*/ $arOptions['onLoad'] = 'onload';//$arParams['SKITTER_ON_LOAD'];
		
		if($arParams['SKITTER_PREVIEW']) $arOptions['preview'] = $arParams['SKITTER_PREVIEW'];
		if($arParams['SKITTER_STOP_OVER']) $arOptions['stop_over'] = $arParams['SKITTER_STOP_OVER'];
		
		if($arParams['SKITTER_NAV'] == 'thumbs') $arOptions['thumbs'] = true;
		
		if($arParams['SKITTER_VELOCITY']) $arOptions['velocity'] = $arParams['SKITTER_VELOCITY'];
		if($arParams['SKITTER_WIDTH_LABEL']) $arOptions['width_label'] = $arParams['SKITTER_WIDTH_LABEL'];
		
		$anim_cnt = intval($arParams['SKITTER_ANIMATION_COUNT']);
		if($anim_cnt > 0){
			for($i = 1; $i <= $anim_cnt; $i++){
				if($arParams["SKITTER_ANIMATION_".$i]) $arOptions['with_animations'][] = $arParams["SKITTER_ANIMATION_".$i];				
			}
		}	

		$sNavAlign = '';
		
		if($arParams['SKITTER_NAV'] == 'numbers'){
			if($arParams['SKITTER_THUMBS_VERT_ALIGN'] == 'bottom') $sNavAlign = "
				$('#$skitterId .skitter .info_slide').addClass('va_bottom'); ";
		}
		
		if($arParams['SKITTER_NAV'] == 'dots'){
			if($arParams['SKITTER_THUMBS_VERT_ALIGN'] == 'top') $sNavAlign = "
				$('#$skitterId .skitter .info_slide_dots').addClass('va_top');";
		}
		
		if($arParams['SKITTER_NAV'] == 'dotsWithPreview'){
			if($arParams['SKITTER_THUMBS_VERT_ALIGN'] == 'top') $sNavAlign = "				
				$('#$skitterId .skitter .info_slide_dots').addClass('va_top'); 
				$('#$skitterId .skitter .info_slide_dots .preview_slide').addClass('va_top'); ";
		}
		
		if($arParams['SKITTER_MOUSE_OVER_OUT_BUTTON_NON_STD'] == 'false'){
			$arParams['SKITTER_MOUSE_OVER_BUTTON'] = "$(this).stop().animate({opacity:0.5}, 2000);";
			$arParams['SKITTER_MOUSE_OUT_BUTTON'] = "$(this).stop().css('opacity','');";
		}
		
		$func_onload = "function(self){obj_$skitterId = self; ".$sNavAlign.$arParams['SKITTER_ON_LOAD']."}";
		$func_btn_over = "function(){".$arParams['SKITTER_MOUSE_OVER_BUTTON']."}";
		$func_btn_out = "function(){".$arParams['SKITTER_MOUSE_OUT_BUTTON']."}";

		$options = str_replace(
			array('"false"', '"true"', ',', '"onload"', '"mouseOut"', '"mouseOver"'), 
			array('false', 'true', ",\n", $func_onload, $func_btn_out, $func_btn_over), 
			json_encode($arOptions)
		);
		
		return $options;
	}
	
}	
?>
