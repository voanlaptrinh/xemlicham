@extends('admin.index')

@section('content')
    <div class="page-content-wrapper border">
        <div class="row justify-content-center">
            <div class="col-md-12 ">
                <div class="card">
                    <div class="card-header fs-3">Create Account</div>
                    <div class="card-body">
                        <form action="{{ route('account.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row text-start g-3">
                                <div class="form-group col-lg-6">
                                    <label for="name">Tên</label>
                                    <input type="text" name="name" class="form-control" value="{{ old('name') }}">
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <label class="error" id="name_error" for="name">{{ $message }}</label>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group col-lg-6">
                                    <label for="role">Role:</label>
                                    <select name="role" id="role" class="form-control">
                                        <option value="user">User</option>
                                        <option value="admin">Admin</option>
                                    </select>
                                    @error('role')
                                        <span class="invalid-feedback" role="alert">
                                            <label class="error" id="name_error" for="name">{{ $message }}</label>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group col-lg-6">
                                    <label for="email">Email</label>
                                    <input type="email" id="email" name="email" class="form-control"
                                        value="{{ old('email') }}">
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <label class="error" id="name_error" for="name">{{ $message }}</label>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group col-lg-6">
                                    <label for="password">Password</label>
                                    <input type="password" id="password" name="password" class="form-control"
                                        value="{{ old('password') }}">
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <label class="error" id="name_error" for="name">{{ $message }}</label>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="image">Image:</label>
                                    <div class="col-12">
                                        <div
                                            class="text-center justify-content-center align-items-center p-4 p-sm-5 border border-2 border-dashed position-relative rounded-3">
                                            <img id="preview-image" src="{{ asset('/images/gallery.svg') }}" class="h-50px"
                                                alt="Preview">
                                            <div>
                                                <h6 class="my-2">Upload course image here, or <a href="#!"
                                                        class="text-primary">Browse</a></h6>
                                                <label style="cursor:pointer;">
                                                    <span>
                                                        <input class="form-control stretched-link" type="file"
                                                            name="image" id="image"
                                                            accept="image/gif, image/jpeg, image/png"
                                                            onchange="previewImage(event)">
                                                    </span>
                                                </label>
                                                <p class="small mb-0 mt-2"><b>Note:</b> Only JPG, JPEG and PNG. Our
                                                    suggested dimensions are 600px * 450px. Larger image will be cropped to
                                                    4:3 to fit our thumbnails/previews.</p>
                                            </div>
                                        </div>
                                    </div>
                                    @error('image')
                                        <span class="invalid-feedback" role="alert">
                                            <label class="error" id="name_error" for="name">{{ $message }}</label>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <button class="btn btn-success mt-4 float-end">Thêm mới</button>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
