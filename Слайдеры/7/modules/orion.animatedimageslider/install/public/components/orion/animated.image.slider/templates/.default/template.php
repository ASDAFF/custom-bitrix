<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die(); //echo'<pre>';print_r($arResult);echo'</pre>';?>

<div id="<?=$arResult['AIS_BLOCK_ID']?>">
	<div class="box_skitter skitter">
		<ul>		
		<?foreach($arResult["ITEMS"] as $arElement):?>
			<?
			$this->AddEditAction($arElement['ID'], $arElement['EDIT_LINK'], CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_EDIT"));
			$this->AddDeleteAction($arElement['ID'], $arElement['DELETE_LINK'], CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BCS_ELEMENT_DELETE_CONFIRM')));
			?>

			<?if(is_array($arElement["SLIDER"]['PICTURE'])):?>
				<li class="item" id="<?=$this->GetEditAreaId($arElement['ID']);?>">
					<?if(isset($arElement['SLIDER']['URL']) && !empty($arElement['SLIDER']['URL'])):?>
						<a href="<?=$arElement['SLIDER']['URL']?>">
					<?endif?>

					<img border="0" src="<?=$arElement["SLIDER"]['PICTURE']["SRC"]?>" width="<?=$arElement["SLIDER"]['PICTURE']["WIDTH"]?>" height="<?=$arElement["SLIDER"]['PICTURE']["HEIGHT"]?>" />
					
					<?if(isset($arElement['SLIDER']['URL']) && !empty($arElement['SLIDER']['URL'])):?></a><?endif?>				
					
					<div class="label_text"><?if(isset($arElement['SLIDER']['DESCRIPTION']) && !empty($arElement['SLIDER']['DESCRIPTION'])):?>
						<div class="text">
							<?=$arElement['SLIDER']['DESCRIPTION']?>
						</div>
					<?endif?></div>
				</li>
			<?endif?>			
		<?endforeach;?>	
		</ul>
	</div>
</div>	

<script type="text/javascript">
	jQuery(document).ready(function(){
		var box_skitter = jQuery('#<?=$arResult['AIS_BLOCK_ID']?> .box_skitter');
		
		<?if(isset($arParams['BKGRND_COLOR']) && !empty($arParams['BKGRND_COLOR'])):?>
			box_skitter.css('background-color', '<?=$arParams['BKGRND_COLOR']?>');
		<?endif?>
		
		<?if(isset($arParams['WIDTH']) && !empty($arParams['WIDTH'])):?>
			box_skitter.width('<?=$arParams['WIDTH']?>');
		<?endif?>
		
		<?if(isset($arParams['HEIGHT']) && !empty($arParams['HEIGHT'])):?>
			box_skitter.height('<?=$arParams['HEIGHT']?>');
		<?endif?>
		
		<?if(isset($arParams['MARGIN']) && !empty($arParams['MARGIN'])):?>
			box_skitter.css('margin', '<?=$arParams['MARGIN']?>');
		<?endif?>
		
		<?if(isset($arParams['PADDING']) && !empty($arParams['PADDING'])):?>
			box_skitter.css('padding', '<?=$arParams['PADDING']?>');
		<?endif?>
		
		<?if(isset($arParams['POSITION']) && !empty($arParams['POSITION'])):?>
			<?
			switch($arParams['POSITION']){
			case 'absolute':
			case 'relative':?>
				box_skitter.css('position', '<?=$arParams['POSITION']?>');
				
				<?if(isset($arParams['POSITION_LEFT']) && $arParams['POSITION_LEFT'] != ''):?>
					box_skitter.css('left', '<?=$arParams['POSITION_LEFT']?>');
				<?endif?>
				<?if(isset($arParams['POSITION_RIGHT']) && $arParams['POSITION_RIGHT'] != ''):?>
					box_skitter.css('right', '<?=$arParams['POSITION_RIGHT']?>');
				<?endif?>
				<?if(isset($arParams['POSITION_TOP']) && $arParams['POSITION_TOP'] != ''):?>
					box_skitter.css('top', '<?=$arParams['POSITION_TOP']?>');
				<?endif?>
				<?if(isset($arParams['POSITION_BOTTOM']) && $arParams['POSITION_BOTTOM'] != ''):?>
					box_skitter.css('bottom', '<?=$arParams['POSITION_BOTTOM']?>');
				<?endif?>				
				<?break;
			case 'left':
			case 'right':?>
				box_skitter.css('float', '<?=$arParams['POSITION']?>');
				<?break;
			case 'center':?>
				box_skitter.css('marginLeft', 'auto').css('marginRight', 'auto');
				<?break;
			default:
			}		
			?>			
		<?endif?>
		
		<?if(count($arResult['ITEMS'])):?>		
			<?=$arResult['AIS_OBJ_VAR']?> = null;
			jQuery('#<?=$arResult['AIS_BLOCK_ID']?> .skitter').skitter(<?=$arResult['AIS_OPTIONS']?>);
		<?endif?>		
	})
</script>