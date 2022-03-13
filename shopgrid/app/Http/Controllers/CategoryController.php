<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    protected $category;
    public $categories;
    private $imageName;
    private $image;
    private $directory;
    private $imageURL;

    public function index()
    {
        return view('admin.category.add');
    }

    public function create(Request $request)
    {
        $this->image = $request->file('image');
        $this->imageName = $this->image->getClientOriginalName();
        $this->directory = 'category-images/';
        $this->image->move($this->directory, $this->imageName);

        $this->imageURL = $this->directory.$this->imageName;

        $this->category = new Category();
        $this->category->name           = $request->name;
        $this->category->description    = $request->description;
        $this->category->image          =  $this->imageURL;
        $this->category->save();
        return redirect('/add-category')->with('message', 'Category info create successfully');
    }

    public function manage()
    {
        $this->categories = Category::orderBy('id', 'desc')->get();
        return view('admin.category.manage', ['categories' => $this->categories]);
    }

    public function edit($id)
    {
        $this->category = Category::find($id);
        return view('admin.category.edit', ['category' => $this->category]);
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
        $this->category->name           = $request->name;
        $this->category->description    = $request->description;
        $this->category->image          =  $this->imageURL;
        $this->category->save();
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
