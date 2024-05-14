@extends('admin.index')
@section('content')
    <div class="page-content-wrapper border">

        <div class="row justify-content-center">
            <div class="col-md-12 ">
                <div class="card">
                    <div class="card-header fs-3">Create Post</div>

                    <div class="card-body">
                        <form action="{{ route('news.store') }}" method="POST" class="" enctype="multipart/form-data">
                            @csrf
                            <div class="row text-start g-3">
                                <div class="form-group col-lg-6">
                                    <label for="title">Tiêu đề:</label>
                                    <input type="text" name="title" id="title" class="form-control">
                                    @error('title')
                                        <span class="invalid-feedback" role="alert">
                                            <label class="error" id="name_error" for="name">{{ $message }}</label>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group col-lg-6">
                                    <label for="description">Miêu tả:</label>
                                    <input name="description" id="description" class="form-control">
                                    @error('description')
                                        <span class="invalid-feedback" role="alert">
                                            <label class="error" id="name_error" for="name">{{ $message }}</label>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group col-lg-6">
                                    <label for="category_id">Category:</label>
                                    <select name="category_id" id="category_id" class="form-control">
                                        <option value="">Select Category</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->title }}</option>
                                        @endforeach
                                    </select>
                                    @error('category_id')
                                        <span class="invalid-feedback" role="alert">
                                            <label class="error" id="name_error" for="name">{{ $message }}</label>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group col-lg-6">
                                    <label for="status">Status:</label>
                                    <select name="status" id="status" class="form-control">
                                        <option value="draft">Draft</option>
                                        <option value="published">Published</option>
                                    </select>
                                    @error('status')
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
                                <div class="form-group">
                                    <label for="schedule">Lịch trình:</label>
                                    <input type="datetime-local" name="schedule" id="schedule" class="form-control">
                                    @error('schedule')
                                        <span class="invalid-feedback" role="alert">
                                            <label class="error" id="name_error" for="name">{{ $message }}</label>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="content">Nội dung:</label>
                                    <textarea id="content" name="content" id="content"></textarea>
                                    @error('content')
                                        <span class="invalid-feedback" role="alert">
                                            <label class="error" id="name_error" for="name">{{ $message }}</label>
                                        </span>
                                    @enderror
                                </div>
                            </div>


                            <button type="submit" class="btn btn-primary mt-4 float-end">Create Post</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
