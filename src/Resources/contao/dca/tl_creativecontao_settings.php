<?php

$GLOBALS['TL_DCA']['tl_creativecontao_settings'] = array
(

    // Config
    'config' => array
    (
        'dataContainer'               => 'File',
        'closed'                      => true
    ),

    // Palettes
    'palettes' => array
    (
       # '__selector__'                => array(''),
        'default'                     => '{creativecontao_defaultTheme_legend},useDefaultTheme;{creativecontao_customTheme_legend},customThemeInformation,pathToCssFramework,pathToJsFramework;{creativecontao_columns_legend},gridColumns;col1MainColWidth;col2MainColWidth,col2LeRiColWidth;col3MainColWidth,col3LeColWidth,col3RiColWidth;'
    ),
    // Fields
    'fields' => array
    (
        'useDefaultTheme' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_creativecontao_settings']['useDefaultTheme'],
            'inputType'               => 'checkbox',
            'eval'                    => array('tl_class'=>'w50 m12')
        ),
        'customThemeInformation' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_creativecontao_settings']['customThemeInformation'],
            'exclude'                 => true,
            'search'                  => false,
            'eval'                    => array('maxlength'=>255, 'tl_class'=>'long'),
            'input_field_callback'    => array('tl_creativecontao_settings', 'helpMode')
        ),
        'pathToCssFramework' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_creativecontao_settings']['pathToCssFramework'],
            'inputType'               => 'text',
            'eval'                    => array('mandatory'=>false, 'decodeEntities'=>true, 'tl_class'=>'long')
        ),
		'pathToJsFramework' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_creativecontao_settings']['pathToJsFramework'],
            'inputType'               => 'text',
            'eval'                    => array('mandatory'=>false, 'decodeEntities'=>true, 'tl_class'=>'long')
        ),
        'gridColumns' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_creativecontao_settings']['gridColumns'],
            'inputType'               => 'text',
            'eval'                    => array('mandatory'=>true, 'tl_class'=>'w50', 'rgxp'=>'digit')
        ),
        'col1MainColWidth' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_creativecontao_settings']['col1MainColWidth'],
            'inputType'               => 'text',
            'eval'                    => array('mandatory'=>false, 'tl_class'=>'w50')
        ),
        'col2MainColWidth' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_creativecontao_settings']['col2MainColWidth'],
            'inputType'               => 'text',
            'eval'                    => array('mandatory'=>false, 'tl_class'=>'w50')
        ),
        'col2LeRiColWidth' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_creativecontao_settings']['col2LeRiColWidth'],
            'inputType'               => 'text',
            'eval'                    => array('mandatory'=>false, 'tl_class'=>'w50')
        ),
        'col3MainColWidth' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_creativecontao_settings']['col3MainColWidth'],
            'inputType'               => 'text',
            'eval'                    => array('mandatory'=>false, 'tl_class'=>'w50')
        ),
        'col3LeColWidth' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_creativecontao_settings']['col3LeColWidth'],
            'inputType'               => 'text',
            'eval'                    => array('mandatory'=>false, 'tl_class'=>'w50')
        ),
        'col3RiColWidth' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_creativecontao_settings']['col3RiColWidth'],
            'inputType'               => 'text',
            'eval'                    => array('mandatory'=>false, 'tl_class'=>'w50')
        ),

        /*
        'leftColumnWidth' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_creativecontao_settings']['leftColumnWidth'],
            'inputType'               => 'select',
            'options'                 => array(1=>'1', 2=>'2', 3=>'3', 4=>'4', 5=>'5', 6=>'6', 7=>'7', 8=>'8', 9=>'9', 10=>'10', 11=>'11', 12=>'12'),
            'eval'                    => array('mandatory'=>false, 'decodeEntities'=>true, 'tl_class'=>'w50')
        ),
        'rightColumnWidth' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_creativecontao_settings']['leftColumnWidth'],
            'inputType'               => 'select',
            'options'                 => array(1=>'1', 2=>'2', 3=>'3', 4=>'4', 5=>'5', 6=>'6', 7=>'7', 8=>'8', 9=>'9', 10=>'10', 11=>'11', 12=>'12'),
            'eval'                    => array('mandatory'=>false, 'decodeEntities'=>true, 'tl_class'=>'w50')
        ),
        */

    )
);

class tl_creativecontao_settings extends Backend
{
    public function __construct()
    {
        parent::__construct();
        $this->import('BackendUser', 'User');
    }


    public function helpMode(\DataContainer $dc, $xlabel)
    {
        $icon = $this->generateImage('show.gif', $GLOBALS['TL_LANG']['tl_calendar_events']['helpmode'][0], ' style="vertical-align:-4px"');
        return '<div class="long widget">
			<h3><label style="color:#8ab858">'.$icon. ' '.$GLOBALS['TL_LANG']['tl_creativecontao_settings']['customThemeInformation'][0].'</label></h3>
			<p class="m12">'.$GLOBALS['TL_LANG']['tl_creativecontao_settings']['customThemeInformation'][1].'</p>
		</div>';
    }


    public function getParticipantTableColumnNames()
    {
        $couples = array();
        // Get all the active couples
        $obj = $this->Database->prepare("SELECT *
                                                FROM tl_training_participants
                                                ")
            ->limit(1)
            ->execute();

        return array_keys($obj->fetchAssoc());
    }
}
?>