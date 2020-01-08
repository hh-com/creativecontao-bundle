<?php

/**
 * Backend modules
 */
$GLOBALS['BE_MOD']['system']['creativecontao_settings'] = array(
    'tables' => array('tl_creativecontao_settings' ),
    'icon' => 'system/themes/flexible/images/settings.gif',
);

// Style sheet
if (defined('TL_MODE') && TL_MODE == 'BE')
{
	$GLOBALS['TL_CSS'][] = 'bundles/creativecontao/css/backend.scss|static';
	$GLOBALS['TL_JAVASCRIPT'][] = 'bundles/creativecontao/js/backend.js';
}

/* */
$GLOBALS['TL_HOOKS']['generatePage'][] = array('Hhcom\CreativeContaoBundle\CreativeHooks', 'setDefaultTheme');
#$GLOBALS['TL_HOOKS']['initializeSystem'][] = array('Hhcom\CreativeContaoBundle\CreativeHooks', 'setDefaultTheme');



/* Add the class row to article*/
$GLOBALS['TL_HOOKS']['compileArticle'][] = array('Hhcom\CreativeContaoBundle\CreativeHooks', 'setArticleRowClass');

/* Add the class container or container-fluid to article */
$GLOBALS['TL_HOOKS']['parseFrontendTemplate'][] = array('Hhcom\CreativeContaoBundle\CreativeHooks', 'setArticleContainerClass');

/* Add CSS - classes to content elements */
$GLOBALS['TL_HOOKS']['getContentElement'][] = array('Hhcom\CreativeContaoBundle\CreativeHooks', 'setContentWidthClass');

/** CREATIVE CONTAO MODULES **/
$GLOBALS['FE_MOD']['creativeContao']['cc_navigation'] = '\Contao\ModuleNavigation';

/** CREATIVE CONTAO CONTENTELEMENTS **/


/** Elements that **/
$GLOBALS['CC_EXCLUDED'] = $GLOBALS['TL_WRAPPERS']['stop'];
$GLOBALS['CC_EXCLUDED'][] = "article";


/* Prepare number of columns */
$gridColumns = \Config::get('gridColumns')?\Config::get('gridColumns'):12;
for ($i = $gridColumns; $i >= 0 ; $i--) {
    $GLOBALS['CC_GRIDCOLUMNS'][] = $i;
}


?>