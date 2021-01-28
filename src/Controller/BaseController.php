<?php

namespace App\Controller;


class BaseController
{
    public function render($template, $arguments)
    {
        include('../templates/Base.php');
    }
}