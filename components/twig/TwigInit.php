<?php

class TwigInit
{
    public static function init() {
        $loader = new Twig_Loader_Filesystem(ROOT . "/views");
        return new Twig_Environment($loader);
    }
}