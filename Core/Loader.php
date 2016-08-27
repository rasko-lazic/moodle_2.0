<?php

namespace FDF\Core;

class Loader
{
    public function loadAll()
    {
        spl_autoload_register([$this, 'loadCoreClasses']);
    }

    private function loadCoreClasses($className)
    {
        $this->loader($className);
    }

    private function loader($className)
    {
        $filename = substr($className, 4);
        $fullFilename = $filename . FILE_EXTENSION;

        if(file_exists($fullFilename)) {
            require_once $fullFilename;
        }
    }
}