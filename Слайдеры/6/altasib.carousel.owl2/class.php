<?
class CCarouselowl2Component extends CBitrixComponent{
	public static $counter;

	public function onPrepareComponentParams($arParams)
	{
		if(!self::$counter)
			self::$counter = 0;

		$arParams['COUNTER'] = self::$counter;
		self::$counter++;
		return $arParams;
	}
}
?>