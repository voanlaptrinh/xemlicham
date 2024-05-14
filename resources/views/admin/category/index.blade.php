@extends('admin.index')

@section('content')
    <div class="page-content-wrapper border">
        <div class="col-12 d-sm-flex justify-content-between align-items-center">
            <h1 class="h3 mb-2 mb-sm-0">Quản lý danh mục </h1>
            <a href="{{ route('categories.create') }}" class="btn btn-sm btn-primary mb-0">Thêm mới danh mục</a>
        </div>


        <div class="card bg-transparent border mt-3">

            <!-- Card header START -->
            <div class="card-header bg-light border-bottom">
                <!-- Search and select START -->
                <div class="row g-3 align-items-center justify-content-between">

                    <!-- Search bar -->
                    <div class="col-md-12">
                        <form class="rounded position-relative" action="{{ route('categories.index') }}" method="get">
                            <input name="query" value="{{ $searchQuery }}" class="form-control bg-body" type="search"
                                placeholder="Tìm kiếm" aria-label="Search">
                            <button
                                class="bg-transparent p-2 position-absolute top-50 end-0 translate-middle-y border-0 text-primary-hover text-reset"
                                type="submit">
                                <i class="fas fa-search fs-6 "></i>
                            </button>
                        </form>
                    </div>

                    <!-- Select option -->
                    <div class="col-md-3">
                        <!-- Short by filter -->

                    </div>
                </div>
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
                            <tr>
                                <th scope="col" class="border-0 rounded-start">Tên danh mục</th>
                                <th scope="col" class="border-0">MetaTilte</th>
                                <th scope="col" class="border-0">metaDescription</th>
                                <th scope="col" class="border-0">Danh mục cha</th>
                                <th scope="col" class="border-0 rounded-end">Thao tác</th>
                            </tr>
                            </tr>
                        </thead>

                        <!-- Table body START -->
                        <tbody>

                            @foreach ($categories as $category)
                                <tr>
                                    <!-- Table data -->
                                    <td>{{ $category->title }}</td>

                                    <!-- Table data -->
                                    <td>{{ $category->metaTitle }}</td>

                                    <!-- Table data -->
                                    <td>{{ $category->metaDescription }}</td>
                                    <td>
                                        @if ($category->parent)
                                            {{ $category->parent->title }}
                                        @else
                                            {{ 'Không có' }}
                                        @endif
                                    </td>

                                    <td class="d-flex">
                                        <a href="{{ route('categories.edit', $category->id) }}"
                                            class="btn btn-success-soft btn-round me-1 mb-1 mb-md-0">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                        <form action="{{ route('categories.destroy', $category->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger-soft btn-round me-1 mb-1 mb-md-0">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </td>

                                </tr>
                            @endforeach



                        </tbody>
                        <!-- Table body END -->
                    </table>
                    <!-- Table END -->
                </div>

            </div>

            <div class="card-footer bg-transparent pt-0">

                <div class="d-sm-flex justify-content-sm-between align-items-sm-center">

                    <p class="mb-0 text-center text-sm-start"></p>

                    <nav class="d-flex justify-content-center mb-0" aria-label="navigation">
                        <ul class="pagination pagination-sm pagination-primary-soft d-inline-block d-md-flex rounded mb-0">
                            @if ($categories->currentPage() > 1)
                                <li class="page-item mb-0"><a class="page-link"
                                        href="{{ $categories->url($categories->currentPage() - 1) }}" tabindex=""><i
                                            class="fas fa-angle-left"></i></a></li>
                            @endif
                            @for ($i = 1; $i <= $categories->lastPage(); $i++)
                                <li class=" page-item mb-0 {{ $categories->currentPage() == $i ? 'active' : '' }}">
                                    <a class="page-link" href="{{ $categories->url($i) }}">{{ $i }}</a>
                                </li>
                            @endfor
                            @if ($categories->currentPage() < $categories->lastPage())
                                <li class="page-item mb-0"><a class="page-link"
                                        href="{{ $categories->url($categories->currentPage() + 1) }}"><i
                                            class="fas fa-angle-right"></i></a></li>
                            @endif
                        </ul>
                    </nav>
                </div>

            </div>
            <!-- Card footer END -->
        </div>


    </div>
@endsection
