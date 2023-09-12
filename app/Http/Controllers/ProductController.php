<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\ProductRepository;
use App\Repositories\AttributeRepository;
use App\Http\Requests\ImageUploadRequest;
use App\Http\Requests\ProductCreateRequest;

class ProductController extends Controller
{
    public $productRepo;
    public $attributeRepo;

    public function __construct(ProductRepository $productRepo, AttributeRepository $attributeRepo)
    {
        $this->productRepo = $productRepo;
        $this->attributeRepo = $attributeRepo;
    }

    public function index()
    {
        $products = $this->productRepo->getProducts();

        return view('product.list', [
            'products' => $products
        ]);
    }

    public function create()
    {
        $attributes = $this->attributeRepo->getAttributes();

        return view('product.create', [
            'attributes' => $attributes
        ]);
    }

    public function store(ProductCreateRequest $request)
    {
        $attributes = $this->attributeRepo->getAttributes();
        
        // Retrieve the validated input data...
        $params = $request->all();
        $saved = $this->productRepo->store($params, $request, $attributes);

        return redirect()->back()->with('message', 'Product created successfully!');
    }

    public function uploadImage(ImageUploadRequest $request)
    {
        $filename = time() . '.' . $request->image->extension();

        $request->image->move(public_path('images'), $filename);

        // save uploaded image filename here to your database

        return response()->json([
            'message' => 'Image uploaded successfully.',
           'image' => '/images/' . $filename
        ], 200);
    }

    public function edit($id)
    {
        $attributes = $this->attributeRepo->getAttributes();
        $product = $this->productRepo->getProduct($id);

        return view('product.edit', [
            'product' => $product,
            'attributes' => $attributes
        ]);
    }

    public function delete($id)
    {
        $this->productRepo->delete($id);

        return redirect()->back()->with('message', 'Product deleted successfully!');
    }
}
