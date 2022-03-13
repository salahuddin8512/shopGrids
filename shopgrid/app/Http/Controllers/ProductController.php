<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\SubCategory;
use App\Models\SubImage;
use App\Models\Unit;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    private $categories;
    private $subCategories;
    private $brands;
    private $units;
    private $product;
    private $products;
    private $imageName;
    private $image;
    private $images;
    private $directory;
    private $imageURL;
    private $subImages;

    public function index()
    {
        $this->categories = Category::all();
        $this->subCategories = SubCategory::all();
        $this->brands = Brand::all();
        $this->units = Unit::all();

        return view('admin.product.add', [
            'categories' => $this->categories,
            'sub_categories' => $this->subCategories,
            'brands'        => $this->brands,
            'units'         => $this->units,
        ]);
    }

    public function create(Request $request)
    {
        $this->image = $request->file('image');
        $this->imageName = $this->image->getClientOriginalName();
        $this->directory = 'product-images/';
        $this->image->move($this->directory, $this->imageName);

        $this->imageURL = $this->directory.$this->imageName;

        $this->product = new Product();
        $this->product->category_id         = $request->category_id;
        $this->product->sub_category_id     = $request->sub_category_id;
        $this->product->brand_id            = $request->brand_id;
        $this->product->unit_id             = $request->unit_id;
        $this->product->name                = $request->name;
        $this->product->code                = $request->code;
        $this->product->regular_price       = $request->regular_price;
        $this->product->selling_price       = $request->selling_price;
        $this->product->short_description   = $request->short_description;
        $this->product->long_description    = $request->long_description;
        $this->product->image               =  $this->imageURL;
        $this->product->save();

        $this->images = $request->file('sub_image');
        foreach ($this->images as $image)
        {
            $this->imageName = $image->getClientOriginalName();
            $this->directory = 'product-sub-images/';
            $image->move($this->directory, $this->imageName);
            $this->imageURL = $this->directory.$this->imageName;

            $this->subImage = new SubImage();
            $this->subImage->product_id = $this->product->id;
            $this->subImage->image      = $this->imageURL;
            $this->subImage->save();
        }

        return redirect('/add-product')->with('message', 'Product info create successfully');
    }

    public function manage()
    {
        $this->products = Product::orderBy('id', 'desc')->get();
        return view('admin.product.manage', ['products' => $this->products]);
    }

    public function edit($id)
    {
        $this->product      = Product::find($id);
        $this->categories   = Category::all();
        $this->subCategories = SubCategory::all();
        $this->brands = Brand::all();
        $this->units = Unit::all();
        $this->subImages = SubImage::where('product_id', $id)->get();

        return view('admin.product.edit', [
            'product' => $this->product,
            'categories' => $this->categories,
            'sub_categories' => $this->subCategories,
            'brands'        => $this->brands,
            'units'         => $this->units,
            'sub_images'    => $this->subImages,
        ]);
    }

    public function update(Request $request, $id)
    {
        $this->category = Category::find($id);

        if($request->file('image'))
        {
            if (file_exists($this->category->image))
            {
                unlink($this->category->image);
            }

            $this->image = $request->file('image');
            $this->imageName = $this->image->getClientOriginalName();
            $this->directory = 'category-images/';
            $this->image->move($this->directory, $this->imageName);

            $this->imageURL = $this->directory.$this->imageName;
        }
        else
        {
            $this->imageURL = $this->category->image;
        }
        $this->product->category_id         = $request->category_id;
        $this->product->sub_category_id     = $request->sub_category_id;
        $this->product->brand_id            = $request->brand_id;
        $this->product->unit_id             = $request->unit_id;
        $this->product->name                = $request->name;
        $this->product->code                = $request->code;
        $this->product->regular_price       = $request->regular_price;
        $this->product->selling_price       = $request->selling_price;
        $this->product->short_description   = $request->short_description;
        $this->product->long_description    = $request->long_description;
        $this->product->image               =  $this->imageURL;
        $this->product->save();



        if ($this->images =$request->file('sub_image'))
        {
           $this->subImages =SubImage::where('product_id', $id)->get();
           foreach ($this->subImages as $subImage)
            {

            }
        }


        return redirect('/manage-category')->with('message','Category info update successfully');
    }

    public function delete($id)
    {
        $this->category = Category::find($id);
        if (file_exists($this->category->image))
        {
            unlink($this->category->image);
        }
        $this->category->delete();
        return redirect('/manage-category')->with('message','Category info delete successfully');
    }
}
