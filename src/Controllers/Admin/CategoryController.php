<?php
namespace Ducna\XOop\Controllers\Admin;

use Ducna\XOop\Commons\Controller;
use Ducna\XOop\Commons\Helper;
use Ducna\XOop\Models\Category;
use Ducna\XOop\Models\Product;
use Rakit\Validation\Validator;

class CategoryController extends Controller
{
    private Category $category;

    private Product $product;

    public function __construct()
    {
        $this->category = new Category();
        $this->product = new Product();
    }

    public function index()
    {
        [$categories, $totalPage] = $this->category->paginate($_GET['page'] ?? 1);
        
        $this->renderViewAdmin('categories.index', [
            'totalPage' => $totalPage,
            'categories' => $categories
        ]);
    }

    public function create()
    {
        $this->renderViewAdmin('categories.create');
    }

    public function store()
    {
        // VALIDATE
        $validator = new Validator;
        $validation = $validator->make($_POST, [
            'name' => 'required|max:100',
        ]);
        $validation->validate();

        if ($validation->fails()) {
            $_SESSION['errors'] = $validation->errors()->firstOfAll();

            header('Location: ' . url('admin/categories/create'));
            exit;
        } else {
            $data = [
                'name' => $_POST['name'],
            ];

            $this->category->insert($data);

            $_SESSION['status'] = true;
            $_SESSION['msg'] = 'Thao tác thành công!';

            header('Location: ' . url('admin/categories'));
            exit;
        }
    }

    public function show($id)
    {
        $category = $this->category->findByID($id);

        $this->renderViewAdmin('categories.show', [
            'category' => $category
        ]);
    }

    public function edit($id)
    {
        $category = $this->category->findByID($id);

        $this->renderViewAdmin('categories.edit', [
            'category' => $category,
        ]);
    }

    public function update($id)
{
    $category = $this->category->findByID($id);

    // VALIDATE
    $validator = new Validator;
    $validation = $validator->make($_POST, [
        'name' => 'required|max:100',
    ]);
    $validation->validate();

    if ($validation->fails()) {
        $_SESSION['errors'] = $validation->errors()->firstOfAll();

        header('Location: ' . url("admin/categories/$id/edit"));
        exit;
    } else {
        $data = [
            'name' => $_POST['name'],
        ];

        $this->category->update($id, $data);

        $_SESSION['status'] = true;
        $_SESSION['msg'] = 'Thao tác thành công!';

        header('Location: ' . url('admin/categories'));
        exit;
    }
}


    public function delete($id)
    {
        try {
            $this->category->delete($id);

            $_SESSION['status'] = true;
            $_SESSION['msg'] = 'Thao tác thành công!';
        } catch (\Throwable $th) {
            $_SESSION['status'] = false;
            $_SESSION['msg'] = 'Thao tác KHÔNG thành công!';
        }

        header('Location: ' . url('admin/categories'));
        exit();
    }
}
