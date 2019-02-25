<?php
/**
 * Created by PhpStorm.
 * User: Harald
 * Date: 26.10.2018
 * Time: 08:18 
 */

// Anpassung der Palette
$GLOBALS['TL_DCA']['tl_article']['palettes']['default'] = str_replace
(
    'stop',
    'stop;{creativecontao_legend:hide},creative_articleContainerClass;',
    $GLOBALS['TL_DCA']['tl_article']['palettes']['default']
);


$GLOBALS['TL_DCA']['tl_article']['fields']['creative_articleContainerClass'] = array(
	'label'                   => &$GLOBALS['TL_LANG']['tl_article']['creative_articleContainerClass'],
	'exclude'                 => true,
	'inputType'               => 'checkbox',
	'eval'                    => array('tl_class'=>'w50'),
	'save_callback'           => array( array('tl_article_cc', 'onlyInOneColumnLayout')),
	'sql'                     => "char(1) NOT NULL default ''"
);


class tl_article_cc extends Contao\Backend
{

	/**  
	 * creative_articleContainerClass container or container-fluid only in one column layout 1col 
	 */
	public function onlyInOneColumnLayout($varValue, \DataContainer $dc)  
	{
		$objPage = \PageModel::findWithDetails($dc->activeRecord->pid); //PageModel Object
		
		if ($objPage->loadDetails()->getRelated('layout')->cols == "1cl") {
			return $varValue;
		}
		else {
			return "";
		}
	}

}


?>
