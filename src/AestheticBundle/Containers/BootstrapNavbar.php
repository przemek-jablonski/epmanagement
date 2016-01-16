<?php
/**
 * Created by PhpStorm.
 * User: Ciemek
 * Date: 16/01/16
 * Time: 3:15 AM
 */

namespace AestheticBundle\Containers;


class BootstrapNavbar {

    /** standard right side of navbar */
    public function createNavbarStandardRight() {
        $navbarRight = array();
        array_push($navbarRight, (new BootstrapNavbarElements())->getElementUserProfile());
        array_push($navbarRight, (new BootstrapNavbarElements())->getElementLogout());
        return $navbarRight;
    }

    /** navbar for ticket indexAction (and firstIndexAction) */
    public function createNavbarIndexLeft() {
        $navbarLeft = array();
        array_push($navbarLeft, (new BootstrapNavbarElements())->getElementList());
        array_push($navbarLeft, (new BootstrapNavbarElements())->getElementNew());
        array_push($navbarLeft, (new BootstrapNavbarElements())->getElementSort());
        array_push($navbarLeft, (new BootstrapNavbarElements())->getElementSearch());
        array_push($navbarLeft, (new BootstrapNavbarElements())->getElementHelper());
        return $navbarLeft;
    }


    /** navbar for ticket showAction*/
    public function createNavbarShowLeft() {
        $navbarLeft = array();
        array_push($navbarLeft, (new BootstrapNavbarElements())->getElementList());
        array_push($navbarLeft, (new BootstrapNavbarElements())->getElementNew());
        array_push($navbarLeft, (new BootstrapNavbarElements())->getElementHelper());
        return $navbarLeft;
    }


    public function createNavbarEditLeft(){
        $navbarLeft = array();
        array_push($navbarLeft, (new BootstrapNavbarElements())->getElementList());
        array_push($navbarLeft, (new BootstrapNavbarElements())->getElementHelper());
        return $navbarLeft;
    }

    public function createNavbarNewLeft() {
        $navbarLeft = array();
        array_push($navbarLeft, (new BootstrapNavbarElements())->getElementList());
        array_push($navbarLeft, (new BootstrapNavbarElements())->getElementHelper());
        return $navbarLeft;
    }

    public function createNavbarRegisterLeft() {
        $navbarLeft = array();
        array_push($navbarLeft, (new BootstrapNavbarElements())->getElementHelper());
        return $navbarLeft;
    }

    public function createNavbarRegisterRight() {
        $navbarRight = array();
        array_push($navbarRight, (new BootstrapNavbarElements())->getElementLogin());
        return $navbarRight;
    }

    public function createNavbarLoginLeft() {
        $navbarLeft = array();
        array_push($navbarLeft, (new BootstrapNavbarElements())->getElementHelper());
        return $navbarLeft;
    }

    public function createNavbarLoginRight() {
        return $this->createNavbarRegisterRight();
    }

}