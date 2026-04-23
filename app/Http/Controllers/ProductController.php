<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function index(Request $request): View
    {

        $query = Product::query();
        $data = [];

        // Default category to null
        $category = null;

        // Filter by gender
        if ($request->has('gender') && $request->gender !== 'all') {
            $query->where('gender', $request->gender);
        }

        // Filter by category and fetch it for the view
        if ($request->has('category') && $request->category !== 'all') {
            $category = Category::find($request->category);
            $query->where('category_id', $request->category);
        }

        // Always pass category (can be null)
        $data['category'] = $category;
        $data['products'] = $query->paginate(5);
        $data['genders'] = Product::GENDERS;
        $data['categories'] = Category::all();

        return view('website.products.index', $data);
    }


    public function show($id)
    {
        $product = Product::with(['reviews', 'category'])->findOrFail($id);
        $bestSellers = Product::orderByDesc('quantity')->limit(4)->get();
        $newProducts = Product::latest()->take(4)->get();

        return view('website.products.show', compact('product', 'bestSellers', 'newProducts'));
    }


    public function storeRevieew(Request $request, $productId)
    {
        $request->validate([
            'star' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|max:1000',
        ]);

        Review::create([
            'product_id' => $productId,
            'user_id' => auth()->id(),
            'star' => $request->star,
            'comment' => $request->comment,
        ]);

        return back()->with('success', 'شكرا على تقييمك!');
    }
}
