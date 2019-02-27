<?php

if (Input::get('do') == 'article')
    foreach ($GLOBALS['TL_DCA']['tl_content']['palettes'] as $key=>$value)
    {
        // don't add {contentWidth_legend},selectContentWidth,addBorder,addBottonLine,forceNewRow; to the __selector__, sliderStop, html...
        $dontShowAt = $GLOBALS['TL_WRAPPERS']['stop'];
        $dontShowAt[] = '__selector__';
        if ( !in_array($key, $dontShowAt) )
        {
            $GLOBALS['TL_DCA']['tl_content']['palettes'][$key] = str_replace(',type', ',type;{contentWidth_legend},selectContentWidth,customContentWidth,forceNewRow;', $GLOBALS['TL_DCA']['tl_content']['palettes'][$key]);
        }
    }

$GLOBALS['TL_DCA']['tl_content']['fields']['selectContentWidth'] = array
(
    'label'                   => &$GLOBALS['TL_LANG']['tl_content']['selectContentWidth'],
    'exclude'                 => true,
    'inputType'               => 'select',
    'default'                 => 12,
    'options'                 => $GLOBALS['CC_GRIDCOLUMNS'],
    'reference'               => &$GLOBALS['TL_LANG']['tl_content']['selectContentWidthOption'],
    'eval'                    => array('mandatory' => false, 'tl_class'=>'w50'),
    'sql'                     => "smallint(5) unsigned NOT NULL default '12'"
);

$GLOBALS['TL_DCA']['tl_content']['fields']['customContentWidth'] = array
(
    'label'                   => &$GLOBALS['TL_LANG']['tl_content']['customContentWidth'],
    'exclude'                 => true,
    'inputType'               => 'text',
    'eval'                    => array('tl_class'=>'w50', 'maxlength'=>255),
    'sql'                     => "varchar(255) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_content']['fields']['forceNewRow'] = array
(
    'label'                   => &$GLOBALS['TL_LANG']['tl_content']['forceNewRow'],
    'exclude'                 => true,
    'inputType'               => 'checkbox',
    'eval'                    => array('tl_class'=>'w50 m12'),
    'sql'                     => "char(1) NOT NULL default ''"
);