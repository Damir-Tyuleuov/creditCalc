<?php
namespace controllers;
use views\View;

class BaseController
{
   public function render($view, array $params)
   {
new View($view,$params);
   }
}
?>