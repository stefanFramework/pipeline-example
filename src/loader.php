<?php
/** @deprecated  */
function loadModule($directory)
{
    foreach (glob($directory . '/*.php') as $lib) {
        if (!file_exists($lib)) {
            die($lib . ' not found');
        }

        require_once $lib;
    }
}
