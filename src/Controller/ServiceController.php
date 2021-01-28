<?php

namespace App\Controller;

class ServiceController extends BaseController
{

    public function list()
    {

        $this->render('../Templates/list-services.php',[]);
    }
}