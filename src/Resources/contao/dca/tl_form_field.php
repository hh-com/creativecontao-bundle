<?php

\System::loadLanguageFile('tl_content');

foreach ($GLOBALS['TL_DCA']['tl_form_field']['palettes'] as $key=>$value)
{
    // don't add {contentWidth_legend},selectContentWidth,addBorder,addBottonLine,forceNewRow; to the __selector__, sliderStop, html...
    $dontShowAt = $GLOBALS['TL_WRAPPERS']['stop'];
    $dontShowAt[] = '__selector__';
    $dontShowAt[] = 'fieldsetStart';
    if ( !in_array($key, $dontShowAt) )
    {
        $GLOBALS['TL_DCA']['tl_form_field']['palettes'][$key] = str_replace(',type', ',type;{contentWidth_legend},selectContentWidth,startRow,endRow;', $GLOBALS['TL_DCA']['tl_form_field']['palettes'][$key]);
    }
}

$GLOBALS['TL_DCA']['tl_form_field']['fields']['selectContentWidth'] = array
(
    'label'                   => &$GLOBALS['TL_LANG']['tl_content']['selectContentWidth'],
    'exclude'                 => true,
    'inputType'               => 'select',
    'default'                 => 12,
    'options'                 => $GLOBALS['CC_GRIDCOLUMNS'],
    'reference'               => &$GLOBALS['TL_LANG']['tl_content']['selectContentWidthOption'],
    'eval'                    => array('mandatory' => true, 'tl_class'=>'w50'),
    'sql'                     => "smallint(5) unsigned NOT NULL default '12'"
);

$GLOBALS['TL_DCA']['tl_form_field']['fields']['startRow'] = array
(
    'label'                   => &$GLOBALS['TL_LANG']['tl_content']['startRow'],
    'exclude'                 => true,
    'inputType'               => 'checkbox',
    'eval'                    => array('mandatory' => false, 'tl_class'=>'w50 m12 clr'),
    'sql'                     => "char(1) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_form_field']['fields']['endRow'] = array
(
    'label'                   => &$GLOBALS['TL_LANG']['tl_content']['endRow'],
    'exclude'                 => true,
    'inputType'               => 'checkbox',
    'eval'                    => array('mandatory' => false, 'tl_class'=>'w50 m12'),
    'sql'                     => "char(1) NOT NULL default ''"
);