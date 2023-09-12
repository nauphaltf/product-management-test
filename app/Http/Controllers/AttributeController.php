<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\AttributeRepository;
use App\Http\Requests\StoreAttributeRequest;

class AttributeController extends Controller
{
    public $attributeRepo;

    public function __construct(AttributeRepository $attributeRepo)
    {
        $this->attributeRepo = $attributeRepo;
    }

    public function index()
    {
        $attributes = $this->attributeRepo->getAttributes();

        return view('attribute.list', [
            'attributes' => $attributes
        ]);
    }

    public function create()
    {
        return view('attribute.create');
    }

    public function store(StoreAttributeRequest $request)
    {
        // Retrieve the validated input data...
        $params = $request->safe()->only(['title', 'values']);
        $saved = $this->attributeRepo->store($params);

        return response()->json([
            'status' => 'Saved successfully'
        ]);
    }

    public function delete($id)
    {
        $this->attributeRepo->delete($id);

        return redirect()->back()->with('message', 'Attribute deleted successfully!');
    }
}
