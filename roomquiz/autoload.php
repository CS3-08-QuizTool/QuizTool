<?php

spl_autoload_register(function($class){
    $prefix = 'MyApp\\';//バックスラッシュはエスケープ

    //MyAppから始まる場合
    if(strpos($class, $prefix) === 0){
        $className = substr($class, strlen($prefix));
        $classFilePath = __DIR__ . '/' . $className . '.php';
        if(file_exists($classFilePath)){
            require $classFilePath;
        }else{
            echo 'No such class: ' . $className;
            exit;
        } 
    }
});
?>