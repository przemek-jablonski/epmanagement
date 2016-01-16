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
        return $this;
    }

    public function createHelperEdit() {
        $this->helpTitle = "edit view";
        $this->helpText = (file_get_contents('/Users/Ciemek/dev/projects/newSymfony/epmanagement/src/AestheticBundle/Dialogue/helperEdit.html'));
        return $this;
    }

    public function createHelperLogin() {
        $this->helpTitle = "logging in";
        $this->helpText = (file_get_contents('/Users/Ciemek/dev/projects/newSymfony/epmanagement/src/AestheticBundle/Dialogue/helperLogin.html'));
        return $this;
    }

    public function createHelperNew() {
        $this->helpTitle = "new ticket form";
        $this->helpText = (file_get_contents('/Users/Ciemek/dev/projects/newSymfony/epmanagement/src/AestheticBundle/Dialogue/helperNew.html'));
        return $this;
    }

    public function createHelperRegister() {
        $this->helpTitle = "user registration";
        $this->helpText = (file_get_contents('/Users/Ciemek/dev/projects/newSymfony/epmanagement/src/AestheticBundle/Dialogue/helperRegister.html'));
        return $this;
    }

    public function createHelperShow() {
        $this->helpTitle = "single ticket view";
        $this->helpText = (file_get_contents('/Users/Ciemek/dev/projects/newSymfony/epmanagement/src/AestheticBundle/Dialogue/helperShow.html'));
        return $this;
    }

    public function createHelperUserProfile() {
        $this->helpTitle = "user profile screen";
        $this->helpText = (file_get_contents('/Users/Ciemek/dev/projects/newSymfony/epmanagement/src/AestheticBundle/Dialogue/helperUserProfile.html'));
        return $this;
    }


}