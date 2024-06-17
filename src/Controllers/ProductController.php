<?php

namespace src\Controllers;

use src\Models\ProductModel;
use src\Models\UserModel;

class ProductController extends BaseController implements ControllerInterface
{
    public function get(...$args): void
    {
        if (isset($args[0])) {
            if ($args[0] === 'new') {
                $this->render('product/post');
                return;
            } elseif ($args[0] === 'new-multiple') {
                $this->render('product/post-multiple');
                return;
            }
            $id = (int)$args[0];
        }
        $data = ProductModel::get($id ?? null);

        $this->render('product/index', ['data' => $data]);
    }

    public function post(...$args): void
    {
        $data = $_POST;
        $result = is_array($data['title']) ? ProductModel::createMultiple($data) : ProductModel::create($data);
        if ($result) {
            $code = 201;
            $message = "Created successfully";
        } else {
            $code = 400;
            $message = "Creation failed";
        }
        $this->throw($code, $message);
    }

    public function update(...$args): void
    {

    }

    public function delete(...$args): void
    {

    }
}