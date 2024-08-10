<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Slider;

class FrontProductListController extends Controller
{
    public function index()
    {
        $products =  Product::latest()->limit(9)->get();
        $randomActiveProducts = Product::inRandomOrder()->limit(3)->get();
        $randomActiveProductIds = [];
        
        foreach ($randomActiveProducts as $product) {
            array_push($randomActiveProductIds, $product->id);
        }

        $randomItemProducts = Product::whereNotIn('id', $randomActiveProductIds)->limit(3)->get();
        $sliders = Slider::get();


        return view('product', compact('products', 'randomItemProducts', 'randomActiveProducts', 'sliders'));

    }

    public function show($id)
    {
        $product = Product::find($id);
        $productFromSameCategories = Product::inRandomOrder()
            ->where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->limit(3)
            ->get();

        return view('show', compact('product', 'productFromSameCategories'));
    }

    public function moreProducts(Request $request)
    {
        if ($request->search) {
            $products = Product::where('name', 'like', '%' . $request->search . '%')
                ->orWhere('description', 'like', '%' . $request->search . '%')
                ->orWhere('additional_info', 'like', '%' . $request->search . '%')

                ->paginate(50);
            return view('all-product', compact('products'));
        }

        $products  = Product::latest()->paginate(50);
        return view('all-product', compact('products'));
    }
}
