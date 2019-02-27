<?php
namespace Hhcom\CreativeContaoBundle;

use Contao\LayoutModel;

class CreativePage extends \Module
{

    public function compile() {}


    /**
     * @return LayoutModel|null
     */
    public static function getLayoutInformation()
    {
        global $objPage;
        return LayoutModel::findById($objPage->layout);
    }
    
}

?>
