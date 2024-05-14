@extends('admin.index')

@section('content')
    <div class="page-content-wrapper border">
        <div class="col-12 d-sm-flex justify-content-between align-items-center">
            <h1 class="h3 mb-2 mb-sm-0">Thêm mới danh mục</h1>

        </div>
        <div class="container card shadow p-4  mt-5">
            <div class=" bg-transparent  rounded-3 h-100">
                <form action="{{ route('categories.store') }}" method="POST" class="" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="title">Tiêu đề</label>
                        <input type="text" name="title" class="form-control" value="{{ old('title') }}">
                        @error('title')
                            <span class="invalid-feedback" role="alert">
                                <label class="error" id="name_error" for="name">{{ $message }}</label>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group mt-2">
                        <label for="metaTitle">metaTitle</label>
                        <input type="text" name="metaTitle" class="form-control" value="{{ old('metaTitle') }}">
                        @error('metaTitle')
                            <span class="invalid-feedback" role="alert">
                                <label class="error" id="name_error" for="name">{{ $message }}</label>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group mt-2">
                        <label for="metaDescription">metaDescription</label>
                        <textarea name="metaDescription" id="metaDescription"  class="form-control" cols="30" rows="10">{{old('metaDescription')}}</textarea>
                        {{-- <input type="text" name="metaDescription" class="form-control" value="{{ old('metaDescription') }}"> --}}
                        @error('metaDescription')
                            <span class="invalid-feedback" role="alert">
                                <label class="error" id="name_error" for="name">{{ $message }}</label>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group mt-2">
                        <label for="parent_id">Danh mục cha</label>
                        <select name="parent_id"  class="form-control" id="parent_id">
                            <option value="">Select Parent Category</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->title }}</option>
                            @endforeach
                        </select>
                        {{-- <input type="text" name="metaDescription" class="form-control" value="{{ old('metaDescription') }}"> --}}
                        @error('parent_id')
                            <span class="invalid-feedback" role="alert">
                                <label class="error" id="name_error" for="name">{{ $message }}</label>
                            </span>
                        @enderror
                    </div>
                    <button type="submit" class="float-end mt-3 btn btn-success">Thêm mới danh mục</button>
                </form>
            </div>
        </div>
      
    </div>
@endsection
