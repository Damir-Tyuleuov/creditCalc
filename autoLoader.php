
<?php

function autoLoader($Class)
{
    $Class = str_replace('\\','/',$Class).'.php';
    if (file_exists($Class))
    {
       // echo $Class.' Данный класс присутствует';
        require_once $Class;
    }
    else
    {
        echo $Class.' Данный класс отсутствует'; 
    }

}

spl_autoload_register('autoLoader');
?>