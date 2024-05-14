<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $searchQuery = $request->input('query');

        $categories = Category::when($searchQuery, function ($query) use ($searchQuery) {
            return $query->where('title', 'like', '%' . $searchQuery . '%');
        })->latest()->paginate(4);

        return view('admin.category.index', compact('categories', 'searchQuery'));
    }
    public function create()
    {
        $categories = Category::all();
        return view('admin.category.create', compact('categories'));
    }
    public function validateCategory(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'metaTitle' => 'required|string',
            'metaDescription' => 'required|string',
            'parent_id' => 'nullable|exists:categorys,id'
        ], [
            'title.required' => 'Trường này là bắt buộc',
            'metaTitle.required' => 'Trường này là bắt buộc',
            'metaDescription.required' => 'Trường này là bắt buộc',
            'parent_id.exists' => 'Không có menu này',
        ]);
    }

    public function store(Request $request)
    {

        $this->validateCategory($request);


        Category::create($request->all());
        session()->flash('success', 'Thêm mới thành công!');

        return redirect()->route('categories.index');
    }


    public function edit(Category $category)
    {
        $parentCategories = Category::all();
        return view('admin.category.edit', compact('category', 'parentCategories'));
    }


    public function update(Request $request, Category $category)
    {
        $this->validateCategory($request);

        $category->update([
            'title' => $request->title,
            'metaTitle' => $request->metaTitle,
            'metaDescription' => $request->metaDescription,
            'parent_id' => $request->parent_id,
        ]);

        return redirect()->route('categories.index')->with('success', 'Danh mục đã được cập nhật thành công.');
    }


    public function destroy(Category $category)

    {


        if ($category->title === 'Lịch tháng' || $category->title === 'Lịch năm') {
            return redirect()->back()->with('error', 'Không thể xóa danh mục này.');
        }
        $category->delete();

        return redirect()->route('categories.index')->with('success', 'Danh mục đã được xóa thành công.');
    }

    
}
