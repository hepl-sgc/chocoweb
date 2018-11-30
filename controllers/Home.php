<?php

class Home
{

    public $slides;
    
    function __construct()
    {
        $this->slides = $this->getSlides();
    }

    public function getSlides()
    {
        require('models/Slide.php');
        $slide1 = new Slide(1, 'fr');
        $slide2 = new Slide(2, 'fr');
        $slide3 = new Slide(3, 'fr');
        return [$slide1, $slide2, $slide3];
    }
}