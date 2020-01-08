<?php

/**
 * Add palettes to tl_module
 */
$GLOBALS['TL_DCA']['tl_module']['palettes']['navigation'] = str_replace
(
    'cssID',
    'cssID;{cc_bootstrap:hide},bs_navbar_brand, bs_navbar_fixed_top,bs_navbar_inverse,bs_container_fullwidth,bs_navbar_dropup;bs_search_searchpage,bs_include_search;',
    $GLOBALS['TL_DCA']['tl_module']['palettes']['navigation']
);

$GLOBALS['TL_DCA']['tl_module']['fields']['bs_container_fullwidth'] = array(
    'label'                   => &$GLOBALS['TL_LANG']['tl_module']['bs_container_fullwidth'],
    'exclude'                 => true,
    'inputType'               => 'checkbox',
    'eval'                    => array('tl_class'=>'w50'),
    'sql'                     => "char(1) NOT NULL default ''"
);


$GLOBALS['TL_DCA']['tl_module']['fields']['bs_navbar_brand'] = array(
    'label'                   => &$GLOBALS['TL_LANG']['tl_module']['bs_navbar_brand'],
    'exclude'                 => true,
    'inputType'               => 'text',
    'eval'                    => array('maxlength'=>64),
    'sql'                     => "varchar(64) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_module']['fields']['bs_include_search'] = array(
    'label'                   => &$GLOBALS['TL_LANG']['tl_module']['bs_include_search'],
    'exclude'                 => true,
    'inputType'               => 'checkbox',
    'eval'                    => array('tl_class'=>'w50'),
    'sql'                     => "char(1) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_module']['fields']['bs_search_searchpage'] = array(
    'label'                   => &$GLOBALS['TL_LANG']['tl_module']['bs_search_searchpage'],
    'exclude'                 => true,
    'inputType'               => 'pageTree',
    'foreignKey'              => 'tl_page.title',
    'eval'                    => array('fieldType'=>'radio', 'tl_class'=>'w50'),
    'sql'                     => "int(10) unsigned NOT NULL default '0'",
    'relation'                => array('type'=>'hasOne', 'load'=>'eager')
);
?>