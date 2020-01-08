<?php

if (Input::get('do') == 'article')
    foreach ($GLOBALS['TL_DCA']['tl_content']['palettes'] as $key=>$value)
    {
        // don't add {contentWidth_legend},selectContentWidth,addBorder,addBottonLine,forceNewRow; to the __selector__, sliderStop, html...
        $dontShowAt = $GLOBALS['TL_WRAPPERS']['stop'];
        $dontShowAt[] = '__selector__';
        if ( !in_array($key, $dontShowAt) )
        {
            $GLOBALS['TL_DCA']['tl_content']['palettes'][$key] = str_replace(',type', ',type;{contentWidth_legend},selectContentWidth,customContentWidth,backgroundColor,fullWidth,forceNewRow,noBottomSpace;', $GLOBALS['TL_DCA']['tl_content']['palettes'][$key]);
        }
    }

    /**
     * 
     * 
     * 
     * only mobile?
     * Kein Abstand unten
     * Inhalt zentrieren
     * Textfarbe
     */
$GLOBALS['TL_DCA']['tl_content']['fields']['selectContentWidth'] = array
(
    'label'                   => &$GLOBALS['TL_LANG']['tl_content']['selectContentWidth'],
    'exclude'                 => true,
    'inputType'               => 'select',
    'default'                 => 12,
    'options'                 => $GLOBALS['CC_GRIDCOLUMNS'],
    'reference'               => &$GLOBALS['TL_LANG']['tl_content']['selectContentWidthOption'],
    'eval'                    => array('mandatory' => false, 'tl_class'=>'w33'),
    'sql'                     => "smallint(5) unsigned NOT NULL default '12'"
);

$GLOBALS['TL_DCA']['tl_content']['fields']['customContentWidth'] = array
(
    'label'                   => &$GLOBALS['TL_LANG']['tl_content']['customContentWidth'],
    'exclude'                 => true,
    'inputType'               => 'text',
    'eval'                    => array('tl_class'=>'w33', 'maxlength'=>255),
    'sql'                     => "varchar(255) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_content']['fields']['backgroundColor'] = array
(
    'label'                   => &$GLOBALS['TL_LANG']['tl_content']['backgroundColor'],
    'exclude'                 => true,
    'inputType'               => 'select',
    'default'                 => 12,
    'options_callback'        => array('tl_content_ccb', 'getBackgroundColors'),
    'reference'               => &$GLOBALS['TL_LANG']['tl_content']['backgroundColorOption'],
    'eval'                    => array('mandatory' => false, 'tl_class'=>'w33'),
    'sql'                     => "varchar(32) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_content']['fields']['forceNewRow'] = array
(
    'label'                   => &$GLOBALS['TL_LANG']['tl_content']['forceNewRow'],
    'exclude'                 => true,
    'inputType'               => 'checkbox',
    'eval'                    => array('tl_class'=>'w33 m12'),
    'sql'                     => "char(1) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_content']['fields']['fullWidth'] = array
(
    'label'                   => &$GLOBALS['TL_LANG']['tl_content']['fullWidth'],
    'exclude'                 => true,
    'inputType'               => 'checkbox',
    'eval'                    => array('tl_class'=>'w33 m12'),
    'sql'                     => "char(1) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_content']['fields']['noBottomSpace'] = array
(
    'label'                   => &$GLOBALS['TL_LANG']['tl_content']['noBottomSpace'],
    'exclude'                 => true,
    'inputType'               => 'checkbox',
    'eval'                    => array('tl_class'=>'w33 m12'),
    'sql'                     => "char(1) NOT NULL default ''"
);


class tl_content_ccb extends Contao\Backend
{
    public function __construct()
	{
		parent::__construct();
		$this->import('Contao\BackendUser', 'User');
    }
    
    /**
     * Return background colors from creativecontao_settings
     */
    public function getBackgroundColors()
	{
        if(\Config::get('backgroundColors') == NULL || empty(deserialize(\Config::get('backgroundColors'))))
            return array(0 => 'No Entry');   
            
        $bgc = deserialize(\Config::get('backgroundColors'));

        $bgcArr = array();
        foreach ($bgc as $val) {
            $bgcArr[$val['value']] = $val['key'];
        }
        return $bgcArr ;
    }
}