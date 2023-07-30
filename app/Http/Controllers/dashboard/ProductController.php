<?php

namespace App\Http\Controllers\dashboard;

use Illuminate\Support\Facades\DB;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StoreProductRequest;
// use App\Http\Request\UpdateProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\traits\media;




class ProductController extends Controller
{
    use media;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $products = DB::table('products')
            ->select('name', 'brand', 'code', 'quantity', 'price', 'id')
            ->get();
        return view('dashboard.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('dashboard.products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        // required

        $photoName = $this->uploadPhoto($request->image, 'product');
        $data = $request->except('_token', 'image', 'page');
        $data['image'] = $photoName;
        DB::table('products')->insert($data);
        if ($request->page == 'back') {
            return redirect()->back();
        } else {
            return redirect()->route('products.index')->with('seccess', 'successfull creation');
        }
        //  dd($request->all())  ;
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
    public function edit(string $id)
    {
        //
        $product = DB::table('products')->where('id', '=', $id)->first();
        return view('dashboard.products.edit', compact('product'));
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, $id)
    {  //

        $data = $request->except('_token', '_method', 'image');
        // dd($data);
        if ($request->has('image')) {
            # code...
            $photoDel = DB::table('products')->select('image')->where('id', $id)->first()->image;
            $del = public_path('dist/img/product/' . $photoDel);
            $this->deletePhoto($del);



            $photoName = $this->uploadPhoto($request->image, 'product');

            $data['image'] = $photoName;
            DB::table('products')->where('id', $id)->update($data);
        } else {
            # code...
            DB::table('products')
                ->where('id', $id)->update($data);
        }
        return redirect()->route('products.index')->with('seccess', 'successfull update');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {

        $photoDel = DB::table('products')->select('image')->where('id', $id)->first()->image;
        $del = public_path('dist/img/product/' . $photoDel);
        $this->deletePhoto($del);

        DB::table('products')->where('id', $id)->delete();
        return redirect()->route('products.index')->with('seccess', 'successfull delete');
    }
}
