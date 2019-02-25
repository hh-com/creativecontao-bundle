<?php
namespace Hhcom\CreativeContaoBundle;

use Contao\LayoutModel;

class CreativePage extends \Module
{

    public function compile() {}


    /**
     * @return LayoutModel|null
     */
    public static function getLayoutInformationxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx()
    {
        global $objPage;
        return LayoutModel::findById($objPage->layout);
    }
	
	public static function testxy()
	{
		echo "test method ... ";
	}

}

?>
