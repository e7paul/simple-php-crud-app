<?php

namespace src\Controllers;

use src\Models\UserModel;

class NotFoundController extends BaseController
{
    public function get(): void {
        $this->throw('404', 'Not found');
    }
}