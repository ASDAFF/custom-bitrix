<?
$MESS["FGSOFT_AUTOLOADER_OPTIONS_CONNECT_JQUERY"] = "Подключение JQuery";
$MESS['FGSOFT_AUTOLOADER_OPTIONS_HOW_TO_LAUNCH'] = '
<strong>Настройка модуля</strong><br /><br />
При установке автоматически генерируется плагин и размещается в следующей папке:
<pre style="color: green; font-weight: 600;"> /bitrix/js/fgsoft.autoloader/autoloader.plugin.js </pre>
<hr/>
Для подключения модуля на странице, в шаблоне следует подключить <b>сгенерированный плагин</b> и вызвать его, указав следующий код:<br />
<pre style="font-weight: 600;">
(function($){
    if ($(\'#wrap-news\').length && $(\'#wrap-news font.text\').length) {
        $(\'#wrap-news\').showMorePlugin({
            item: \'.page-ajax\',
            wrapNavigation: \'.pagination\',
            buttonClass: \'show-more\',
            divButtonClass: \'div-show-more\',
        });
    }
})(jQuery);
</pre><br/>
<strong>#wrap-news</strong> - это обертка для стандартного компонента Новости, к которому надо применять автоматическую подгрузку страниц, <br/>
<strong>.page-ajax</strong> - это класс тега, который следует выводить (по сути 1 страница)<br/>
<strong>.pagination</strong> - это класс тега, в котором располагается стандартная постранчная навигация (может располагаться отдельно от основного контейнера)<br/><br/>
<hr/>
Добавлено событие <strong>"autoloaderComplete"</strong>, которое вызывается после получения новых элементов. Позволяет сделать дополнительную обработку элементов, например JS. Пример вызова события:
<pre style="font-weight: 600;">
$(\'#wrap-news\').on("autoloaderComplete", function (event) {
    console.log(event.items);
});
</pre><br/>
<hr/>
Обращаем внимание, что данный плагин заменяет стандартную постраничную навигацию, она должна присутствовать в шаблоне, поэтому не удаляйте следующие строки:
<pre style="color: green; font-weight: 600;">
if($arParams["DISPLAY_BOTTOM_PAGER"]):
    $arResult["NAV_STRING"]
endif;
</pre>
<hr/>
Плагин использует библиотеку JQuery. Если на вашем сайте нет подключения этой библиотеки, то в настройках модуля поставьте галочку "Подключение JQuery", и библиотека подключится автоматически.
';
$MESS["FGSOFT_AUTOLOADER_OPTIONS_GENERAL"] = "Общие настройки";
$MESS["FGSOFT_AUTOLOADER_OPTIONS_ADDITIONAL"] = "Дполнительные настройки";
$MESS["FGSOFT_AUTOLOADER_OPTIONS_PRELOADER"] = "Прелоадер";
$MESS["FGSOFT_AUTOLOADER_OPTIONS_PRELOADER_DEFAULT"] = "Вы можете использовать прелоадер по умолчанию";
$MESS["FGSOFT_AUTOLOADER_OPTIONS_PRELOADER_OWN"] = "или использовать свой (укажите путь или ссылку)";
$MESS["FGSOFT_AUTOLOADER_OPTIONS_BUTTON_TEMPLATE"] = "Шаблон для кнопки \"Показать еще\"";
$MESS["FGSOFT_AUTOLOADER_OPTIONS_CHECK_TEMPLATE"] = "Использовать расширенный шаблон";
$MESS["FGSOFT_AUTOLOADER_OPTIONS_TEMPLATE_1_ELEMENT"] = "элемент";
$MESS["FGSOFT_AUTOLOADER_OPTIONS_TEMPLATE_2_ELEMENTS"] = "элемента";
$MESS["FGSOFT_AUTOLOADER_OPTIONS_TEMPLATE_5_ELEMENTS"] = "элементов";
$MESS["FGSOFT_AUTOLOADER_OPTIONS_TEMPLATE_ABOUT"] = "По умолчанию шаблон будет в виде текста 
<pre><b>Показать еще . . .</b></pre><br />
При необходимости можно использовать расширенный шаблон вида 
<pre><b>Показано (кол-во) элементов из (кол-ва). Показать еще (кол-во)</b></pre>";
$MESS["FGSOFT_AUTOLOADER_OPTIONS_SHOW_AUTOLOAD"] = "Показывать галочку \"Подгружать автоматически\"";
$MESS["FGSOFT_AUTOLOADER_OPTIONS_SHOW_AUTOLOAD_ABOUT"] = "Если на странице будет поставлена галочка \"Подгружать автоматически\", то, при нажатии на нее, 
страница будет подгружаться автоматически по скроллингу <br/>
Вы можете изменять момент срабатывания автоматической подгрузки, для этого настройте поле \"Размер отступа автоподгрузки\".";
$MESS["FGSOFT_AUTOLOADER_OPTIONS_AUTOLOADSIZE"] = "Размер отступа автоподгрузки";
$MESS["FGSOFT_AUTOLOADER_OPTIONS_CHECK_COORDS_CONSOLE_LOG"] = "Выводить координаты в консоль, для настройки автопрокрутки";
$MESS["FGSOFT_AUTOLOADER_OPTIONS_SAVE"] = "Сохранить";
$MESS["FGSOFT_AUTOLOADER_OPTIONS_SHOW_PRELOADER_ABOUT"] = "Для прелоадера вы можете указать ссылку типа <b>http://сайт.ру/preloader/preloader.gif</b> 
или относительный путь на вашем сайте <b>/local/templates/main/img/preloader.gif</b>";
$MESS["FGSOFT_AUTOLOADER_OPTIONS_SCRIPT_buttonName"] = "Показать еще . . .";
$MESS["FGSOFT_AUTOLOADER_OPTIONS_SCRIPT_autoloadText"] = "Подгружать автоматически";
$MESS["FGSOFT_AUTOLOADER_OPTIONS_SCRIPT_showElementsText"] = "Показано";
$MESS["FGSOFT_AUTOLOADER_OPTIONS_SCRIPT_showElementsFrom"] = "элементов из";
$MESS["FGSOFT_AUTOLOADER_OPTIONS_SCRIPT_downloadElementsText"] = "Загрузить еще";
$MESS["FGSOFT_AUTOLOADER_OPTIONS_SCRIPT_downloadElementsTo"] = "элементов";

$MESS["FGSOFT_AUTOLOADER_OPTIONS_SCRIPT_textElementsFrom"] = "из";

$MESS["FGSOFT_AUTOLOADER_OPTIONS_CHECK_AJAXMODE"] = "Включить режим AJAX";
$MESS["FGSOFT_AUTOLOADER_OPTIONS_CHECK_STANDART_PAGINATION"] = "Показать стандартную постраничную навигацию";
$MESS["FGSOFT_AUTOLOADER_OPTIONS_OWN_BUTTON_NAME"] = "Текст для ссылки 'Показать еще'";


?>