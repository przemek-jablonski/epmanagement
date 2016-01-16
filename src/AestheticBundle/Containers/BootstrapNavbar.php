<?php
/**
 * Created by PhpStorm.
 * User: Ciemek
 * Date: 16/01/16
 * Time: 3:15 AM
 */

namespace AestheticBundle\Containers;


class BootstrapNavbar {

    public function createNavbarIndex($navbarLeft, $navbarRight) {
        array_push($navbarLeft, (new BootstrapNavbarElements())->getElementList());
        array_push($navbarLeft, (new BootstrapNavbarElements())->getElementNew());
        array_push($navbarLeft, (new BootstrapNavbarElements())->getElementSort());
        array_push($navbarLeft, (new BootstrapNavbarElements())->getElementSearch());
        array_push($navbarLeft, (new BootstrapNavbarElements())->getElementHelper());
        array_push($navbarRight, (new BootstrapNavbarElements())->getElementUserProfile());
        array_push($navbarRight, (new BootstrapNavbarElements())->getElementLogout());
    }

}