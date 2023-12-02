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
                <h2 style="text-align: center">Add New Slide</h2>
                <p class="card-description right">
                </p>
                <form class="forms-sample" enctype="multipart/form-data" method="POST">
                    @csrf
                    <div class="form-group">
                        <label class="form-label" for="form2Example2">Image Slide</label>
                        <input type="file" id="upload4" class="form-control">
                        <div class="image-show" id="img_show4">
                        </div>
                        <input type="hidden" name="hinhanh4" id="hinhanh4">
                    </div>
                    <button type="submit" class="btn btn-primary ">Submit</button>
                    <button class="btn btn-light"><a style="text-decoration: none;"
                            href="{{ route('listslide') }}">Cancel</a></button>

                </form>
            </div>
        </div>
    </div>
@stop
