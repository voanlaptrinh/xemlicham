<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class NewsController extends Controller
{
    public function index(Request $request)
    {
       
        $categories = Category::all();
        $searchTitle = $request->input('search_title');
        $searchCategory = $request->input('search_category');

        $posts = Post::when($searchTitle, function ($query) use ($searchTitle) {
            $query->where('title', 'like', '%' . $searchTitle . '%');
        })
            ->when($searchCategory, function ($query) use ($searchCategory) {
                $query->whereHas('category', function ($categoryQuery) use ($searchCategory) {
                    $categoryQuery->where('id', 'like', '%' . $searchCategory . '%');
                });
            })
            ->latest()
            ->paginate(5)
            ->appends(['search_title' => $searchTitle, 'search_category' => $searchCategory]);


        return view('admin.news.index', compact('posts', 'categories'));
    }
    public function validateNews(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'required|image|max:2048', // 2MB
            'category_id' => 'required|exists:categorys,id',
            'status' => 'required|in:draft,published',
            'schedule' => 'nullable|date_format:Y-m-d\TH:i',
        ], [
            'title.required' => 'Trường này là bắt buộc',
            'description.required' => 'Trường này là bắt buộc',
            'image.image' => 'Phải là dạng ảnh',
            'image.required' => 'Ảnh là bắt buộc',
            'category_id.exists' => 'Không có menu này',
            'category_id.required' => 'Trường này là bắt buộc',
            'status.required' => 'Trường này là bắt buộc',
            'in.required' => 'Chỉ có 2 dạng là draft và punlished',
            'schedule.date_format' => 'Dạng ngày tháng',

        ]);
    }


    public function create()
    {
        $categories = Category::all();
        return view('admin.news.create', compact('categories'));
    }
    public function store(Request $request)
    {
        $this->validateNews($request);

        // Xử lý upload ảnh đại diện nếu có
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
        } else {
            $imagePath = null;
        }

        // Lưu bài viết vào cơ sở dữ liệu
        $post = new Post;
        $post->title = $request->title;
        $post->description = $request->description;
        $post->image = $imagePath;
        $post->content = $request->content;
        $post->category_id = $request->category_id;
        $post->status = $request->status;
        $post->schedule = $request->schedule;
        $post->save();

        // Chuyển hướng về trang danh sách bài viết hoặc trang chi tiết bài viết
        return redirect()->route('news.index')->with('success', 'Bài viết đã được tạo thành công.');
    }
    public function edit(Post $news)
    {
        $categories = Category::all();
        return view('admin.news.edit', compact('news', 'categories'));
    }
    public function detail(Post $news)
    {
        $categories = Category::all();
        return view('admin.news.detail', compact('news', 'categories'));
    }
    public function update(Request $request, Post $news)
    {
        $this->validateNews($request);
        if ($request->hasFile('image')) {
            // Xóa ảnh cũ
            Storage::disk('public')->delete($news->image);

            // Lưu ảnh mới
            $imagePath = $request->file('image')->store('images', 'public');
        }

        $news->update([
            'title' => $request->title,
            'description' => $request->description,
            'image' => $imagePath,
            'category_id' => $request->category_id,
            'status' => $request->status,
            'schedule' => $request->schedule,
            'content' => $request->content,
        ]);

        return redirect()->route('news.index')->with('success', 'Danh mục đã được cập nhật thành công.');
    }

    public function destroy(Post $new)
    {
        $new->delete();

        return redirect()->route('news.index')->with('success', 'Tin tức đã được xóa thành công.');
    }
}
