<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Image;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::paginate();
        return view('dashboard.products.index', compact('products'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::select('id', 'name')->get();
        $product = new Product();
        $genders = Product::GENDERS;
        return view('dashboard.products.create', compact('categories', 'product', 'genders'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'required|image|max:2048',
            'price' => 'required|numeric|min:1|max:99999',
            'gender' => 'required|in:women,men',
            'description' => 'required|string|max:1000',
            'quantity' => 'required|numeric',
            'category_id' => 'required|exists:categories,id',
        ]);

        $product = Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'category_id' => $request->category_id,
            'gender' => $request->gender,
        ]);

        // Add image to relation
        if ($request->hasFile('image')) {
            $img_name = rand() . time() . '.' . $request->file('image')->getClientOriginalExtension();
            $request->file('image')->move(public_path('images'), $img_name);

            $product->image()->create([
                'path' => $img_name,
                'type' => 'main',
            ]);
        }
        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Product added successfully');
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
    public function edit(Product $product)
    {
        $categories = Category::select('id', 'name')->get();
        $genders = Product::GENDERS;

        return view('dashboard.products.edit', compact('product', 'categories', 'genders'))->with('success', 'Product updated successfully');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
            'price' => 'required|numeric|min:1|max:99999',
            'quantity' => 'required|numeric',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|max:2048',
        ]);

        $product->update([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'category_id' => $request->category_id,
            'gender' => $request->gender,
        ]);

        // Replace main image if uploaded
        if ($request->hasFile('image')) {
            // Delete old image
            if ($product->image) {
                $imagePath = public_path('images/' . $product->image->path);
                if (File::exists($imagePath)) {
                    File::delete($imagePath);
                }
                $product->image()->delete();
            }

            $imgName = rand() . time() . '.' . $request->file('image')->getClientOriginalExtension();
            $request->file('image')->move(public_path('images'), $imgName);

            $product->image()->create([
                'path' => $imgName,
                'type' => 'main',
            ]);
        }

        return redirect()->route('admin.products.index')
            ->with('success', 'Product updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {

        if ($product->image) {
            File::delete(public_path('images/' . $product->image->path));
        }


        $product->image()->delete();
        $product->delete();

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Product deleted successfully!');
    }
    public function gallery(Product $product)
    {
        $product->load('gallery');
        return view('dashboard.products.gallery', compact('product'));
    }

    // Upload new images
    public function uploadGallery(Request $request, Product $product)
    {
        $request->validate([
            'gallery.*' => 'image|max:2048'
        ]);

        if ($request->hasFile('gallery')) {
            foreach ($request->file('gallery') as $img) {
                $img_name = rand() . time() . $img->getClientOriginalName();
                $img->move(public_path('images'), $img_name);

                $product->gallery()->create([
                    'path' => $img_name,
                    'type' => 'gallery',
                ]);
            }
        }

        return back()->with('success', 'Product deleted successfully');
    }

    // Delete image
    public function deleteGalleryImage(Image $image)
    {
        File::delete(public_path('images/' . $image->path));
        $image->delete();

        return back()->with('success', 'Image deleted successfully!')->with('type', 'danger');
    }
}
