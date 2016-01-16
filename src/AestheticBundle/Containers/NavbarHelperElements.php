<?php
/**
 * Created by PhpStorm.
 * User: Ciemek
 * Date: 16/01/16
 * Time: 7:42 PM
 */

namespace AestheticBundle\Containers;


use Gedmo\Mapping\ExtensionODMTest;

class NavbarHelperElements {

    /** @var  string $helpTitle */
    private $helpTitle;

    private $helpText;



    /**
     * @return string
     */
    public function getHelpTitle()
    {
        return $this->helpTitle;
    }

    /**
     * @param string $helpTitle
     */
    public function setHelpTitle($helpTitle)
    {
        $this->helpTitle = $helpTitle;
    }

    /**
     * @return string
     */
    public function getHelpText()
    {
        return $this->helpText;
    }

    /**
     * @param string $helpText
     */
    public function setHelpText($helpText)
    {
        $this->helpText = $helpText;
    }

    public function createHelperIndex() {
        $this->helpTitle = "index view";
        $this->helpText = (file_get_contents('/Users/Ciemek/dev/projects/newSymfony/epmanagement/src/AestheticBundle/Dialogue/helperIndex.html'));
//        $this->helpText = <<<MY_HTML
//<p>Here you can see all of the tickets you've reported.</p>
//<br>
//<p>They are separated into two groups, upcoming (those which deadline is still ahead) and overdue (deadline passed).</p>
//<p>You can differentiate between those with deadline met and those which are yet to be done with ticket colour</p>
//<p>If you wish to see more information regarding given ticket, please click in the title of it.</p>
//<p>Should this screen be empty - that means no ticket reported by you yet. If so, every option regarding those can be found in left top bar.</p>
//<br>
//<p><b>If so - start by clicking [+NEW] in left top corner of the screen.</b></p>
//MY_HTML;


        return $this;
    }
}