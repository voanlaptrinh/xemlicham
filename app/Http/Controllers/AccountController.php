<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AccountController extends Controller
{
    public function index(Request $request)
    {
        $searchQuery = $request->input('query');

        $users = User::when($searchQuery, function ($query) use ($searchQuery) {
            return $query->where('name', 'like', '%' . $searchQuery . '%');
        })->latest()->paginate(5);
        return view('admin.account.index', compact('users', 'searchQuery'));
    }
    public function create()
    {

        return view('admin.account.create');
    }
    public function validateAccount(Request $request)
    {
        $request->validate(
            [
                'name' => 'required',
                'email' => 'required|email|unique:users,email,',
                'password' => 'required|min:6',
                'role' => 'required|in:user,admin',
                'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            ],
            [
                'name.required' => 'Tên tài khoản là bắt buộc',
                'email.required' => 'Email là bắt buộc',
                'email.email' => 'Email không đúng định dạng',
                'email.unique' => 'Email đã tồn tại',
                'password.required' => 'Mật khẩu là bắt buộc',
                'password.min' => 'Mật khẩu phải có ít nhất :min ký tự',
                'role.required' => 'Vui lòng chọn vai trò',
                'role.in' => 'Vai trò không hợp lệ',
                'image.mimes' => 'Ảnh phải là các định dạng jpeg, png, jpg, gif',
                'image.max' => 'Kích thước ảnh không được vượt quá :max KB',
            ]
        );
    }
    public function store(Request $request)
    {
        $this->validateAccount($request);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
        } else {
            $imagePath = null;
        }

        $account = new User;
        $account->name = $request->name;
        $account->email = $request->email;
        $account->image = $imagePath;
        $account->password = bcrypt($request->password);
        $account->role = $request->role;
        $account->save();
        return redirect()->route('account.index')->with('success', 'Tài khoản đã được tạo thành công.');
    }
    public function destroy(User $user)
    {
        if ($user->email === 'kynn@rivernet.vn') {
            return redirect()->back()->with('error', 'Không thể xóa tài khoản này.');
        }
        $user->delete();

        return redirect()->route('account.index')->with('success', 'User đã được xóa thành công.');
    }
    public function edit(User $user)
    {
        return view('admin.account.edit', compact('user'));
    }
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'role' => 'required|in:user,admin',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
        ], [
            'name.required' => 'Tên tài khoản là bắt buộc',
            'email.required' => 'Email là bắt buộc',
            'email.email' => 'Email không đúng định dạng',
            'role.required' => 'Vui lòng chọn vai trò',
            'role.in' => 'Vai trò không hợp lệ',
            'image.mimes' => 'Ảnh phải là các định dạng jpeg, png, jpg, gif',
            'image.max' => 'Kích thước ảnh không được vượt quá :max KB'
        ]);

        if ($user->email === 'kynn@rivernet.vn') {
            return redirect()->route('account.index')->with('error', 'Không được phép sửa đổi tài khoản này.');
        }

        if ($request->hasFile('image')) {
            if (!empty($user->image) && Storage::disk('public')->exists($user->image)) {
                Storage::disk('public')->delete($user->image);
            }
            $imagePath = $request->file('image')->store('images', 'public');
        }

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'image' => $imagePath ?? $user->image,
            'password' => bcrypt($request->password),
            'role' => $request->role,
        ]);

        return redirect()->route('account.index')->with('success', 'Tài khoản đã được cập nhật thành công.');
    }
}
