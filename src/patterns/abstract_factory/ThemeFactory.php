<?php
// /var/www/html/hotel/src/patterns/abstract_factory/ThemeFactory.php
interface ThemeFactory
{
    public function createCss();
    public function createJs();
}

class BaseThemeFactory implements ThemeFactory
{
    public function createCss()
    {
        return '/hotel/public/assets/css/style.css';
    }
    public function createJs()
    {
        return '/hotel/public/assets/js/main.js';
    }
}

class ThemeProvider
{
    public static function getFactory($theme)
    {
        switch (strtolower($theme)) {
            case 'base':
                return new BaseThemeFactory();
            default:
                throw new Exception("Unknown theme: $theme");
        }
    }
}
