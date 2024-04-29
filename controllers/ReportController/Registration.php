<?php

namespace app\controllers\ReportController;

use app\core\Controller;

class Registration extends Controller
{
    public function MotherRegistration(): array|false|string
    {
        $this->setLayout('admin');
        return $this->render('reports/MotherRegistrations');
    }
}