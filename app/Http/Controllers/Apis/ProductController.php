<?php

namespace App\Http\Controllers\Apis;

use App\Http\Controllers\Controller;
use App\Http\traits\media;
use App\Models\Product;
use Illuminate\Http\Request;

use App\Http\Requests\StoreProductRequest;
use App\Http\traits\ApiTrait;

class ProductController extends Controller
{
    use media, ApiTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();
        return $this->Data(compact('products'), 'done');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        // required

        $photoName = $this->uploadPhoto($request->image, 'product');
        $data = $request->except('image');
        $data['image'] = $photoName;
        product::create($data);
        // $product->save();
        return $this->SuccessMessage('successfull store');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
        $products = Product::find($id);
        return $this->Data(compact('products', 'sucessfull edit'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreProductRequest $request, $id)
    {
        //
        // dd($request->all());
        $data = $request->except('image', '_method');
        // dd($data);
        if ($request->has('image')) {
            # code...
            $photoDel = Product::find($id)->image;
            $del = public_path('dist/img/product/' . $photoDel);
            $this->deletePhoto($del);



            $photoName = $this->uploadPhoto($request->image, 'product');

            $data['image'] = $photoName;
            // dd($data);
            Product::find($id)->update($data);
        } else {
            # code...
            Product::find($id)->update($data);
        }
        return $this->SuccessMessage("successfull update", 201);
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //

        $photoDel = Product::find($id)->image;
        $del = public_path('dist/img/product/' . $photoDel);
        $this->deletePhoto($del);

        Product::find($id)->delete();
        return $this->SuccessMessage("successfull delete");
    }
}
