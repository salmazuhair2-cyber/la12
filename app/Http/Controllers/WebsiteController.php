<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\View\View;

class WebsiteController extends Controller
{
    public function index(): View
    {
        $data['categories'] = Category::take(6)->get();
        $data['men_products'] = Product::with('category')
            ->where('gender', 'men')
            ->take(4)
            ->get();
        $data['women_products'] = Product::with('category')
            ->where('gender', 'women')
            ->take(4)
            ->get();
        $data['latest_products'] = Product::with('category')->latest()->take(4)->get();

        return view('website.index', $data);
    }

    public function about(): View
    {
        return view('website.about');
    }

    public function details(): View
    {
        return view('website.details');
    }

    public function view(): View
    {
        return view('website.view');
    }

    public function contact(): View
    {
        return view('website.contact');
    }
}
