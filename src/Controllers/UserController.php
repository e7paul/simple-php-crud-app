<?php

namespace src\Controllers;

use src\Models\UserModel;

class UserController extends BaseController implements ControllerInterface
{
    public function get(...$args): void
    {
        if (isset($args[0])) {
            $id = (int)$args[0];
        }
        $data = UserModel::get($id ?? null);

        $this->render('user/index', ['data' => $data]);
    }

    public function post(...$args): void
    {

    }

    public function update(...$args): void
    {

    }

    public function delete(...$args): void
    {

    }
}