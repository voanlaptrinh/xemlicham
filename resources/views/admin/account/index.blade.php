@extends('admin.index')

@section('content')
    <div class="page-content-wrapper border">
        <div class="col-12 d-sm-flex justify-content-between align-items-center">
            <h1 class="h3 mb-2 mb-sm-0">Quản lý tài khoản </h1>
            <a href="{{ route('account.create') }}" class="btn btn-sm btn-primary mb-0">Thêm mới tài khoản</a>
        </div>
        <div class="card bg-transparent border mt-3">

            <!-- Card header START -->
            <div class="card-header bg-light border-bottom">
                <!-- Search and select START -->
                <div class="row g-3 align-items-center justify-content-between">
                    <!-- Search bar -->
                    <div class="col-md-12">
                        <form class="rounded position-relative" action="{{ route('account.index') }}" method="get">
                            <input name="query" value="{{ $searchQuery }}" class="form-control bg-body" type="search"
                                placeholder="Tìm kiếm" aria-label="Search">
                            <button
                                class="bg-transparent p-2 position-absolute top-50 end-0 translate-middle-y border-0 text-primary-hover text-reset"
                                type="submit">
                                <i class="fas fa-search fs-6 "></i>
                            </button>
                        </form>
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
                                <th scope="col" class="border-0 rounded-start">Tên tài khỏa</th>

                                <th scope="col" class="border-0">Ngày tạo</th>
                                <th scope="col" class="border-0">Quyền</th>
                               
                                <th scope="col" class="border-0 rounded-end">Thao tác</th>
                            </tr>
                        </thead>

                        <!-- Table body START -->
                        <tbody>

                            @foreach ($users as $user)
                                <tr>
                                    
                                    <!-- Table data -->
                                    <td>
                                        <div class="d-flex align-items-center mb-3">
                                            <!-- Avatar -->
                                            <div class="avatar avatar-xs flex-shrink-0">
                                                <img class="avatar-img rounded-circle" src="{{ $user->image ? asset('storage/' . $user->image) : asset('/images/gallery.svg') }}"
                                                    alt="avatar">
                                            </div>
                                            <!-- Info -->
                                            <div class="ms-2">
                                                <h6 class="mb-0 fw-light">{{$user->name}}</h6>
                                            </div>
                                        </div>
                                    </td>

                                    <!-- Table data -->
                                    <td>{{$user->created_at}}</td>

                                  

                                    <!-- Table data -->
                                    <td>
                                        <span class="badge bg-success bg-opacity-15 text-success">{{$user->role}}</span>
                                    </td>

                                    <!-- Table data -->
                                    <td class="d-flex ">
                                        <a href="{{ route('account.edit', $user->id) }}"
                                            class="btn btn-success-soft btn-round me-1 mb-1 mb-md-0">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                        <form action="{{ route('account.destroy', $user->id) }}" method="POST">
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
                            @if ($users->currentPage() > 1)
                                <li class="page-item mb-0"><a class="page-link"
                                        href="{{ $users->url($users->currentPage() - 1) }}" tabindex=""><i
                                            class="fas fa-angle-left"></i></a></li>
                            @endif
                            @for ($i = 1; $i <= $users->lastPage(); $i++)
                                <li class=" page-item mb-0 {{ $users->currentPage() == $i ? 'active' : '' }}">
                                    <a class="page-link" href="{{ $users->url($i) }}">{{ $i }}</a>
                                </li>
                            @endfor
                            @if ($users->currentPage() < $users->lastPage())
                                <li class="page-item mb-0"><a class="page-link"
                                        href="{{ $users->url($users->currentPage() + 1) }}"><i
                                            class="fas fa-angle-right"></i></a></li>
                            @endif
                        </ul>
                    </nav>
                </div>
                <!-- Pagination END -->
            </div>
            <!-- Card footer END -->
        </div>
    </div>
@endsection
