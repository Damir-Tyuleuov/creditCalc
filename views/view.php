<?php
namespace views;

class View
{
    public function __construct($viewPath, array $params)
    {
       extract($params);
       include $viewPath;
    }
}


?>