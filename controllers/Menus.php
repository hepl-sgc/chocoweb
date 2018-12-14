<?php

class Menus
{
    public $menus;

    function __construct()
    {
        $this->menus = $this->getMenus();
    }

    public function getMenus() 
    {
        require_once('models/Menu.php');

        $menu1 = new Menu(1, 'fr');
        $menu2 = new Menu(2, 'fr');
        $menu3 = new Menu(3, 'fr');
        $menu4 = new Menu(4, 'fr');
        $menu5 = new Menu(5, 'fr');
        $menu6 = new Menu(6, 'fr');

        return [$menu1, $menu2, $menu3, $menu4, $menu5, $menu6];
    }
}