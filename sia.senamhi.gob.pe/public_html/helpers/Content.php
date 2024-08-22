<?php

class Content
{
    public static function view($file)
    {
        switch ($file) {
            case 'header':
            case 'panel':
            case 'page':
            case 'footer':
            case 'modal-menu':
            case 'movil-tabs':
                include 'resources/base/' . $file . '.php';
                break;
            case 'tab-info':
            case 'tab-services':
                include 'resources/base/movil/' . $file . '.php';
                break;
            case 'modal-template':
                include 'resources/modal/template.php';
                break;
            case 'css-template':
                include 'resources/css/template.php';
                break;
            case 'js-template':
                include 'resources/js/template.php';
                break;
        }
    }
}
