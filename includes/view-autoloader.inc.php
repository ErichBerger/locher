<?php
    spl_autoload_register('autoLoader');

    function autoLoader($viewName) {
        $path = "views/";
        $extension = ".php";
        $fullPath = $path.$viewName.$extension;

        include_once $fullPath;
    }
?>