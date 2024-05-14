@extends('admin.index')
@section('content')
    <div class="page-content-wrapper border">
        <div class="row">
            <div class="col-lg-4">
                <img class="rounded card-img-top" src="{{ $news->image ? asset('storage/' . $news->image) : asset('/images/gallery.svg') }}" alt="">
            </div>
            <div class="col-lg-8">
                <h3>
                   Tiêu đề: {{ $news->title }}
                </h3>
                <h6>
                   Danh mục: {{$news->category->title}}
                </h6>
                <h6>
                   Trạng thái: {{ $news->status }}
                </h6>
                <h6>
                   Lịch trình đăng bài: {{ date('H:i:s d/m/Y', strtotime($news->schedule)) }}
                </h6>
                <div>
                   Mô tả: {{$news->description}}
                </div>
            </div>
        </div>
        <div class="pt-5 pb-4 fs-3">Nội dung:</div>
        <div class="d-flex justify-content-center">
            <div class="col-xl-10" >
                <div style=" word-wrap: break-word;">
                    {!!$news->content!!}
                </div>
            </div>

        </div>

    </div>
@endsection
