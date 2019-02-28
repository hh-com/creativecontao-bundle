<?php

namespace Hhcom\CreativeContaoBundle;

use Contao\Combiner;


class CreativeHooks
{

    public function compile() {}

    /***
     * Loads the default theme or no theme but basic css
     * Wir in der config.php beim initialisieren des System ausgeführt..
     */
    public function setDefaultTheme($objPage, $objLayout, $objPageRegular)
    {

        /* Add Javascript and CSS */
        if (TL_MODE == 'FE')
        {
            global $objPage;

            /* Use the default theme */
            if (\Config::get('useDefaultTheme'))
			{
				$GLOBALS['TL_CSS'][] = "/bundles/creativecontao/css/creative.css|static";
				$GLOBALS['TL_JAVASCRIPT'][] = "/bundles/creativecontao/js/creative.js";
            }
            
			if (\Config::get('pathToCssFramework'))
            $GLOBALS['TL_CSS'][] = \Config::get('pathToCssFramework');
		
			if (\Config::get('pathToJsFramework'))
			$GLOBALS['TL_JAVASCRIPT'][] = \Config::get('pathToJsFramework');
            
            /* Add additional HTML Tag from tl_layout before the closing body tag </body>*/
           
            $layout = \LayoutModel::findById($objPage->layout);
            $GLOBALS['TL_BODY'][] = $layout->footeradds;
        }

        if (TL_MODE == 'BE')
        {
            //$GLOBALS['TL_CSS'][] = "/system/modules/creativeContao/assets/themes/$themeName/bootstrap.css|static";
        }

    }

    /***
     * Hook compileArticle
     * Add css row class to each mod_article template.
     * If it is main column we add also a placeholder token for full width or not full width
     * 
     * @param $objTemplate
     * @param $arrData
     * @param $objModule
     */
    public function setArticleRowClass($objTemplate, $arrData, $objModule)
    {
        /**
         * In a ONE col layout there is no container and row class in the fe_page.
         * We add them in mod_article for a better use of full/not full-width layout.
         * We add here a container-replace-token to replace them in the function setArticleContainerClass
         */
        $objPage = \PageModel::findByPK($objTemplate->pid);
        if ($objTemplate->column == "main" && $objPage->loadDetails()->getRelated('layout')->cols == "1cl") {

            $arrCss = $objModule->cssID;

            /* full width if checked in article configuration */
            if($objTemplate->creative_articleContainerClass == "1" ) {

                $arrCss[1] = trim($arrCss[1] . ' row creativeContaoBSContainerFluidReplaceToken' );

            } else {
                $arrCss[1] = trim($arrCss[1] . ' row creativeContaoBSContainerReplaceToken' );
            }

            $objModule->cssID = $arrCss;
        }
        else {

            $arrCss = $objModule->cssID;
            $arrCss[1] = trim($arrCss[1] . ' row ' );
            $objModule->cssID = $arrCss;

        }
    }

    /**
     * Hook parseFrontendTemplate
     * Add container or container-fluid to every mod_article template when layout is 1cl (one column) 
     * 
     * @param $strBuffer
     * @param $strTemplate
     */
    public function setArticleContainerClass($strBuffer, $strTemplate)
    {
        if ($strTemplate == 'mod_article')
        {
            global $objPage;
            $layout = \LayoutModel::findById($objPage->layout);
            if($layout->cols  == "1cl" )
            {
                if (strpos($strBuffer, "creativeContaoBSContainerFluidReplaceToken") !== false) {
                    $buffer = "<div class='container-fluid'>";
                    $buffer .= str_replace(' creativeContaoBSContainerFluidReplaceToken','',$strBuffer );
                    $buffer .= "</div>";
                    $strBuffer = $buffer;
                }

                if (strpos($strBuffer, "creativeContaoBSContainerReplaceToken") !== false) {
                    $buffer = "<div class='container'>";
                    $buffer .= str_replace(' creativeContaoBSContainerReplaceToken','',$strBuffer );
                    $buffer .= "</div>";
                    $strBuffer = $buffer;
                }
            }
        }

        return $strBuffer;
    }


    /**
     * Add Container class to each content element
     */
    public function setContentWidthClass($objModel, $strBuffer, $objElement)
    {
        if (TL_MODE != 'BE') 
        {
            $addContainer = true;
        
            /****
             *
             *
             * ÜÜÜÜÜÜERlegen ob es notwendig ist, das insert_article berücksichtigt werden
             * wenn man einen artikel irgenwo insertet darf das ja NIE über das Textfeld erfolgen.
             * Wenn, muss das über das html element erfolgen.
             * Wenn man sowas macht, muss man über das HTML Element halt eine ROW hinzufügen...
             * Das ist ein andwender problem.
             *
             *
             */

            $article = \Contao\ArticleModel::findById($objElement->pid);

            if ($objModel->customContentWidth)
            {
                $contentWidth = $objModel->customContentWidth;

            } elseif ( $objModel->selectContentWidth > 0 ) {
                $contentWidth = "col-md-".$objModel->selectContentWidth;
            }
            else {
                /* Dont create a creative container  */
                $addContainer = false;
            }
        
            if ($addContainer)
            {
                /**
                 * Handle all Wrappers ".$contentWidth."
                 */
                if (
                    in_array($objModel->type, $GLOBALS['TL_WRAPPERS']['start']) OR
                    in_array($objModel->type, $GLOBALS['TL_WRAPPERS']['stop'])
                ) {
                    if ( in_array($objModel->type, $GLOBALS['TL_WRAPPERS']['start']) ) {
                        $buffer = "<div class='creative creative-" . $objModel->id . " " . $contentWidth . "'>";
                        $buffer .= $strBuffer;
                        $strBuffer = $buffer;
                    }

                    if ( in_array($objModel->type, $GLOBALS['TL_WRAPPERS']['stop']) ) {
                        $buffer .= $strBuffer;
                        $buffer .= "</div>";
                        $strBuffer = $buffer;
                    }
                }
                /**
                 * Handle all Elements but not wrappers
                 */
                else
                {
                    /**
                     * Dont handle article ... evtl auch keine insert tagse,... insert content elements
                     */
                    if ($objModel->type != 'article') {
                        $buffer = "<div class='creative creative-" . $objModel->id . " " . $contentWidth . "'>";
                        $buffer .= $strBuffer;
                        $buffer .= "</div>";
                        $strBuffer = $buffer;
                    }
                }
            }
          

            if ($objModel->forceNewRow) {
                $strBuffer = '<div class="w-100"></div>' . $strBuffer;
            }

        }

        if (TL_MODE == 'BE')
        {
            $backendIcon = "";
            $contentWidth = 12;
            $contentWidthLabel = $GLOBALS['TL_LANG']['tl_content']['selectContentWidthOption'][0];
    
            # Force a new Row
            if ($objModel->forceNewRow == 1)
            {
               $backendIcon .= "<span title='".$GLOBALS['TL_LANG']['tl_content']['forceNewRow'][0]."'>&#182;</span>";
            }

            if ($objModel->customContentWidth)
            {
                $contentWidthLabel = "Custom: " . $objModel->customContentWidth;
            } elseif ( $objModel->selectContentWidth > 0 ) {
                $contentWidthLabel = "Custom: " . $GLOBALS['TL_LANG']['tl_content']['selectContentWidthOption'][$objModel->selectContentWidth];
            }

            $noElemInfo = $GLOBALS['TL_WRAPPERS']['stop'];
            if (\Input::get('do') == 'article' && !in_array($objModel->type, $noElemInfo))
            {
                $GLOBALS['TL_MOOTOOLS'][] = "<style>.tl_content.indent .selectContentWidth{display: none;}</style> ";
                $strBuffer =  "<div class='selectContentWidth' style=' border: 1px solid #ddd; width: 99,6%; margin-bottom: 0px;'> 
                        <div style='background-color: #f8f8f8; border-right: 1px solid #ddd;'><b>".$contentWidthLabel."</b> ".$backendIcon." </div>
                        <div class='clear'></div>
                        </div>
                        ".$strBuffer;
            }
        }

        return $strBuffer;
    }


}
?>
