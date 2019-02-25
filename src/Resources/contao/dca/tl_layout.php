<?php


$GLOBALS['TL_DCA']['tl_layout']['palettes']['default'] = str_replace
(
    ',head',
    ',head;{creativecontao_legend:hide},footeradds',
    $GLOBALS['TL_DCA']['tl_layout']['palettes']['default']
);

$GLOBALS['TL_DCA']['tl_layout']['fields']['footeradds'] = array(
    'label'                   => &$GLOBALS['TL_LANG']['tl_layout']['footeradds'],
    'exclude'                 => true,
    'search'                  => true,
    'inputType'               => 'textarea',
    'eval'                    => array('style'=>'height:60px', 'preserveTags'=>true, 'rte'=>'ace|html', 'tl_class'=>'clr'),
    'sql'                     => "text NULL"
); 

?>