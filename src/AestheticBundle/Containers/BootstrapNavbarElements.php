<?php

namespace AestheticBundle\Containers;

/**
 * Created by PhpStorm.
 * User: Ciemek
 * Date: 16/01/16
 * Time: 1:29 AM
 */
class BootstrapNavbarElements
{

    public function __construct($link = 'ticketcrud_index',
                                $glyphicon = 'glyphicon-screenshot',
                                $title = "CONSTRUCTOR_ERROR"){
        $this->link = $link;
        $this->glyphicon = $glyphicon;
        $this->title = $title;
        return $this;
    }


    /**
     * @var string $link
     *
     * Contains link to which user is transferred to.
     */
    private $link;

    /**
     * @var string $glyphicon
     *
     * Contains string identifier for bootstrap glyphicon.
     */
    private $glyphicon;

    /**
     * @var string $title
     *
     * Contains title for navbar element.
     */
    private $title;


    /**
     * @return string
     */
    public function getLink()
    {
        return $this->link;
    }

    /**
     * @param string $link
     */
    public function setLink($link)
    {
        $this->link = $link;
    }

    /**
     * @return string
     */
    public function getGlyphicon()
    {
        $prefix = "glyphicon ";
        return ($prefix . $this->glyphicon);
    }

    /**
     * @param string $glyphicon
     */
    public function setGlyphicon($glyphicon)
    {
        $this->glyphicon = $glyphicon;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        $prefix = " ";
        return ($prefix . $this->title);
    }

    /**
     * @param string $title
     */
    public function setTitle($title)
    {

        $this->title = $title;
    }

    public function getElementList() {
        $this->title = 'list';
        $this->glyphicon = 'glyphicon-home';
        $this->link = 'ticketcrud_index';
        return $this;
    }

    public function getElementNew() {
        $this->title = 'new';
        $this->glyphicon = 'glyphicon-plus';
        $this->link = 'ticketcrud_new';
        return $this;
    }

    public function getElementEdit() {
        $this->title = 'edit';
        $this->glyphicon = 'glyphicon-indent-left';
        $this->link = 'ticketcrud_edit';
        return $this;
    }

    public function getElementSort() {
        $this->title = 'sort';
        $this->glyphicon = 'glyphicon-signal';
        $this->link = 'ticketcrud_index';
        return $this;
    }

    public function getElementSearch() {
        $this->title = 'search';
        $this->glyphicon = 'glyphicon-search';
        $this->link = 'ticketcrud_index';
        return $this;
    }

    public function getElementHelper() {
        $this->title = 'helper';
        $this->glyphicon = 'glyphicon-question-sign';
        $this->link = 'ticketcrud_index';
        return $this;
    }

    public function getElementUserProfile() {
        $this->title = 'profile';
        $this->glyphicon = 'glyphicon-user';
        $this->link = 'user_profile';
        return $this;
    }

    public function getElementRegister() {
        $this->title = 'register';
        $this->glyphicon = 'glyphicon-asterisk';
        $this->link = 'ticketcrud_index';
        return $this;
    }

    public function getElementLogin() {
        $this->title = 'login';
        $this->glyphicon = 'glyphicon-ok';
        $this->link = 'user_login_form';
        return $this;
    }

    public function getElementLogout() {
        $this->title = 'logout';
        $this->glyphicon = 'glyphicon-off';
        $this->link = 'logout';
        return $this;
    }




}