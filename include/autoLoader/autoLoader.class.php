<?php

class autoLoader {
	
    public static function register($path) {

        return spl_autoload_register(function($name) use ($path) {

            $find = $name . '.class.php';

            $dir = new RecursiveDirectoryIterator($path, RecursiveDirectoryIterator::SKIP_DOTS);
            $iterator = new RecursiveIteratorIterator($dir);

            foreach($iterator as $file) {
                if(strpos($file, $find) && is_file($file)) {
                    include_once $file;
                }
            }

        });

    }

}


?>