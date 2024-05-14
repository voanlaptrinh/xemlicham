@extends('admin.index')
@section('content')
    <div class="page-content-wrapper border">

        <!-- Title -->
        <div class="row mb-3">
            <div class="col-12 d-sm-flex justify-content-between align-items-center">
                <h1 class="h3 mb-2 mb-sm-0">Quản lý tin tức</h1>
                <a href="{{ route('news.create') }}" class="btn btn-sm btn-primary mb-0">Thêm mới tin tức</a>
            </div>
        </div>

        <!-- Card START -->
        <div class="card bg-transparent border">

            <!-- Card header START -->
            <div class="card-header bg-light border-bottom">
                <!-- Search and select START -->
                <form action="{{ route('news.index') }}" method="GET">
                    <div class="row g-3 align-items-center justify-content-between">

                        <div class="col-md-8">
                            <label for="search_title" class="form-label">Tìm kiếm theo tiêu đề</label>
                            <input type="text" class="form-control" id="search_title" name="search_title"
                                value="{{ request('search_title') }}" placeholder="Tiêu đề">
                        </div>
                        <div class="col-md-2">
                            <label for="search_category" class="form-label">Tìm kiếm theo danh mục</label>
                            <select class="form-select" id="search_category" name="search_category">
                                <option value="">Select category</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ request('search_category') == $category->id ? 'selected' : '' }}>
                                        {{ $category->title }}</option>
                                @endforeach
                            </select>
                        </div>

                        <button class="col-md-2 btn btn-primary mt-5" type="submit">
                            <i class="fas fa-search fs-6 "></i>
                        </button>

                    </div>
                </form>
                <!-- Search and select END -->
            </div>
            <!-- Card header END -->

            <!-- Card body START -->
            <div class="card-body">
                <!-- Course table START -->
                <div class="table-responsive border-0 rounded-3">
                    <!-- Table START -->
                    <table class="table table-dark-gray align-middle p-4 mb-0 table-hover">
                        <!-- Table head -->
                        <thead>
                            <tr>
                                <th scope="col" class="border-0 rounded-start">Tiêu đề</th>
                                <th scope="col" class="border-0">Ngày hẹn đăng bài</th>
                                <th scope="col" class="border-0">Trạng thái</th>
                                <th scope="col" class="border-0">Danh mục</th>
                                <th scope="col" class="border-0 rounded-end">Action</th>
                            </tr>
                        </thead>

                        <!-- Table body START -->
                        <tbody>

                            @foreach ($posts as $post)
                                <tr>
                                    <!-- Table data -->
                                    <td>
                                        <div class="d-flex align-items-center position-relative">
                                            <!-- Image -->
                                            <div class="w-60px">
                                                <img src="{{ $post->image ? asset('storage/' . $post->image) : asset('/images/gallery.svg') }}"
                                                    class="rounded" alt="{{ $post->title }}">
                                            </div>
                                            <!-- Title -->
                                            <h6 class="table-responsive-title mb-0 ms-2">
                                                <a href="#" class="stretched-link">{{ $post->title }}</a>
                                            </h6>
                                        </div>
                                    </td>

                                    <!-- Table data -->
                                    <td>
                                        {{ date('H:i:s d/m/Y', strtotime($post->schedule)) }}
                                    </td>

                                    <!-- Table data -->
                                    <td>
                                        {{ $post->status }}
                                    </td>

                                    <!-- Table data -->
                                    <td>{{ $post->category->title }}</td>

                                    <!-- Table data -->
                                    <td class="d-flex">
                                        <a href="{{ route('news.detail', $post->id) }}" 
                                            class="btn btn-sm btn-info-soft me-1 mb-1 mb-md-0">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('news.edit', $post->id) }}" 
                                            class="btn btn-sm btn-success me-1 mb-1 mb-md-0">
                                             <i class="bi bi-pencil-square"></i>
                                        </a>
                                        <form action="{{ route('news.destroy', $post->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-danger mb-0" type="submit">
                                                <i class="bi bi-trash"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach





                        </tbody>
                        <!-- Table body END -->
                    </table>
                    <!-- Table END -->
                </div>
                <!-- Course table END -->
            </div>
            <!-- Card body END -->

            <!-- Card footer START -->
            <div class="card-footer bg-transparent pt-0">
                <!-- Pagination START -->
                <div class="d-sm-flex justify-content-sm-between align-items-sm-center">
                    <!-- Content -->
                    <p class="mb-0 text-center text-sm-start"></p>
                    <!-- Pagination -->
                    <nav class="d-flex justify-content-center mb-0" aria-label="navigation">
                        <ul class="pagination pagination-sm pagination-primary-soft d-inline-block d-md-flex rounded mb-0">
                            @if ($posts->currentPage() > 1)
                                <li class="page-item mb-0"><a class="page-link"
                                        href="{{ $posts->url($posts->currentPage() - 1) }}" tabindex=""><i
                                            class="fas fa-angle-left"></i></a></li>
                            @endif
                            @for ($i = 1; $i <= $posts->lastPage(); $i++)
                                <li class=" page-item mb-0 {{ $posts->currentPage() == $i ? 'active' : '' }}">
                                    <a class="page-link" href="{{ $posts->url($i) }}">{{ $i }}</a>
                                </li>
                            @endfor
                            @if ($posts->currentPage() < $posts->lastPage())
                                <li class="page-item mb-0"><a class="page-link"
                                        href="{{ $posts->url($posts->currentPage() + 1) }}">
                                        <i class="fas fa-angle-right"></i>
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </nav>
                </div>
                <!-- Pagination END -->
            </div>
            <!-- Card footer END -->
        </div>
        <!-- Card END -->
    </div>
@endsection
