@extends('backend.master')
@section('search')
    <li class="nav-item">
        <form class="search-form" action="#">
            <i class="icon-search"></i>
            <input type="search" class="form-control" placeholder="Search Here" title="Search here">
        </form>
    </li>

@endsection

@section('content')


    <div class="col-12 grid-margin stretch-card">
        <br>
        <div class="card">
            <div class="card-body">
                <h2 style="text-align: center">Edit Slide</h2>
                <p class="card-description">

                </p>
                <form class="forms-sample" action="{{ route('slide.post-edit') }}" method="POST">
                    @csrf
                    @foreach ($slideDetail as $slideDetail)
                        <div class="form-outline mb-4">
                            <label class="form-label" for="form2Example2">Image Slide</label>
                            <input type="file" id="upload4" class="form-control">
                            <div class="image-show" id="img_show4">
                            </div>
                            <br>
                            <input type="hidden" name="hinhanh4" id="hinhanh4">
                            <img src="{{ $slideDetail->image }}" alt="" id="img_old"
                                style="width: 200px;height: 100px">
                        </div>
                    @endforeach
                    <button type="submit" class="btn btn-primary ">Submit</button>

                    <button class="btn btn-light" style="color: black"> <a style="text-decoration: none;"
                            href="{{ route('listslide') }}">Cancel</a></button>

                </form>
            </div>
        </div>
    </div>

@stop
