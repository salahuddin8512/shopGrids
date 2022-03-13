<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    private $categories;
    private $subCategory;
    private $subCategories;
    private $image;
    private $imageName;
    private $directory;
    private $imageURL;



    public function index()
    {
        $this->categories = Category::all();
        return view('admin.sub-category.add', ['categories' => $this->categories]);
    }

    public function create(Request $request)
    {
        $this->image = $request->file('image');
        $this->imageName = $this->image->getClientOriginalName();
        $this->directory = 'sub-category-images/';
        $this->image->move($this->directory, $this->imageName);
        $this->imageURL = $this->directory.$this->imageName;

        $this->subCategory = new SubCategory();
        $this->subCategory->category_id = $request->category_id;
        $this->subCategory->name        = $request->name;
        $this->subCategory->description = $request->description;
        $this->subCategory->image       = $this->imageURL;
        $this->subCategory->save();

        return redirect('/add-sub-category')->with('message', 'Sub Category info create successfully.');
    }

    public function manage()
    {
        $this->subCategories = SubCategory::orderBy('id', 'desc')->get();
        return view('admin.sub-category.manage', ['sub_categories' => $this->subCategories]);
    }

    public function edit($id)
    {
        $this->subCategory = SubCategory::find($id );
        $this->categories  = Category::all();
        return view('admin.sub-category.edit', ['sub_category' => $this->subCategory, 'categories' => $this->categories]);
    }

    public function update(Request $request, $id)
    {
        $this->subCategory = SubCategory::find($id);
        if ($request->file('image'))
        {
            if (file_exists($this->subCategory->image))
            {
                unlink($this->subCategory->image);
            }

            $this->image    = $request->file('image');
            $this->imageName = $this->image->getClientOriginalName();
            $this->directory = 'sub-category-images/';
            $this->image->move($this->directory, $this->imageName);
            $this->imageURL = $this->directory.$this->imageName;
        }
        else
        {
            $this->imageURL = $this->subCategory->image;
        }

        $this->subCategory->category_id = $request->category_id;
        $this->subCategory->name        = $request->name;
        $this->subCategory->description = $request->description;
        $this->subCategory->image       = $this->imageURL;
        $this->subCategory->save();

        return redirect('/manage-sub-category')->with('message', 'Category info update successfully.');
    }

    public function delete($id)
    {
        $this->subCategory = SubCategory::find($id);
        if (file_exists($this->subCategory->image))
        {
            unlink($this->subCategory->image);
        }
        $this->subCategory->delete();
        return redirect('/manage-sub-category')->with('message', 'Category info delete successfully.');
    }
}
