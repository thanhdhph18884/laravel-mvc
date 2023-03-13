<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Product;

class ProductController extends BaseController
{
    public function index()
    {
    $viewName = 'product.list';

    $products = Product::all();

        return $this->render($viewName, compact('products'));
    }

    public function create()
    {
        $viewName = 'product.create';

        return $this->render($viewName, []);
    }

    public function store()
    {
        $error = [];

        if ($_POST['name'] == '') {
            $error['name'] = 'khong duoc de trong';
        }

        if ($_POST['email'] == '') {
            $error['email'] = 'khong duoc de trong';
        }

        if ($_POST['birthday'] == '') {
            $error['birthday'] = 'khong duoc de trong';
        }

        if ($_FILES['image']['size'] == 0) {
            $error['image'] = 'Phai chon anh';
        }

        if (empty($error)) {
            $product = new Product();

            $product->name = $_POST['name'];
            $product->email = $_POST['email'];
            $product->birthday = $_POST['birthday'];

            $fileName = ''; // giá trị mặc định
            $avatarFile = $_FILES['image']; // lấy file từ form đã submit
            if ($avatarFile['size'] > 0) { // nếu file có kích thước > 0 ~ có tồn tại
                $path = 'App/public/images/'; // định nghĩa đường dẫn lưu file
                $fileName = $path . uniqid() . '_' . $avatarFile['name']; // giá trị đường dẫn đến file để lưu vào DB
                move_uploaded_file($avatarFile['tmp_name'], $fileName); // lưu file (nội dung ở thuộc tính tmp_name) vào đường dẫn $fileName
            }
            $product->image = $fileName;

            $product->save();

            $flash_message = "Thêm thành công";

            $_SESSION['mess'] = $flash_message;

            $url = BASE_URL . 'list';

            header('location:' . $url);
        } else {
            $viewName = 'product.create';

            return $this->render($viewName, compact('error'));
        }
    }

    public function edit($id)
    {
        $viewName = 'product.edit';

        $product = Product::find($id);

        return $this->render($viewName, compact('product'));
    }

    public function update($id)
    {
        $error = [];

        if ($_POST['name'] == '') {
            $error['name'] = 'khong duoc de trong';
        }

        if ($_POST['email'] == '') {
            $error['email'] = 'khong duoc de trong';
        }

        if ($_POST['birthday'] == '') {
            $error['birthday'] = 'khong duoc de trong';
        }

        if (empty($error)) {
            $product = Product::find($id);

            $product->name = $_POST['name'];
            $product->email = $_POST['email'];
            $product->birthday = $_POST['birthday'];

            $fileName = ''; // giá trị mặc định
            $avatarFile = $_FILES['image']; // lấy file từ form đã submit
            if ($avatarFile['size'] > 0) { // nếu file có kích thước > 0 ~ có tồn tại
                $path = 'App/public/images/'; // định nghĩa đường dẫn lưu file
                $fileName = $path . uniqid() . '_' . $avatarFile['name']; // giá trị đường dẫn đến file để lưu vào DB
                move_uploaded_file($avatarFile['tmp_name'], $fileName); // lưu file (nội dung ở thuộc tính tmp_name) vào đường dẫn $fileName
                $product->image = $fileName;
            } else {
                $product->image = $_POST['valueImage'];
            }
        
            $product->save();

            $flash_message = "Update thành công";

            $_SESSION['mess'] = $flash_message;

            $url = BASE_URL . 'list';

            header('location:' . $url);
        } else {
            $viewName = 'product.edit';

            $product = Product::find($id);

            return $this->render($viewName, compact('product'));
        }
    }

    public function destroy($id)
    {
        Product::destroy($id);

        $flash_message = "Xóa thành công";

        $_SESSION['mess'] = $flash_message;

        $url = BASE_URL . 'list';

        header('location:' . $url);
    }}
