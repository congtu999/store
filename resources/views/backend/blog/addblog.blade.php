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
                <h2 style="text-align: center">Add New Blog</h2>
                <p class="card-description right">
                </p>
                <form class="forms-sample" enctype="multipart/form-data" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="exampleInputName1">Title</label>
                        <input type="text" class="form-control" id="exampleInputName1" placeholder="Title" name="title"
                            value="{{ old('title') }}" />

                    </div>
                    <div class="form-group">
                        <label for="exampleInputName1">Description</label>
                        <textarea name="description" placeholder="Description" id="description" cols="1000" rows="10">{{ old('description') }}</textarea>


                    </div>
                    <div class="form-group">
                        <label for="exampleInputName1">Content</label>
                        <textarea name="content" placeholder="Content" id="content" cols="1000" rows="10">{{ old('content') }}</textarea>


                    </div>
                    <div class="form-group">
                        <label for="exampleInputName1">Content1</label>
                        <textarea name="content1" placeholder="Content - 1" id="content1" cols="1000" rows="10">{{ old('content1') }}</textarea>


                    </div>

                    <div class="form-group">
                        <label class="form-label" for="form2Example2">Image blog</label>
                        <input type="file" id="upload4" class="form-control">
                        <div class="image-show" id="img_show4">
                        </div>
                        <input type="hidden" name="hinhanh4" id="hinhanh4">
                    </div>

                    <button type="submit" class="btn btn-primary ">Submit</button>
                    <button class="btn btn-light"><a style="text-decoration: none;"
                            href="{{ route('listblog') }}">Cancel</a></button>

                </form>
            </div>
        </div>
    </div>
@stop
@section('js-custom')
    <script>
        ClassicEditor
            .create(document.querySelector('#description'))
            .catch(error => {
                console.error(error);
            });

        ClassicEditor
            .create(document.querySelector('#content'))
            .catch(error => {
                console.error(error);
            });

        ClassicEditor
            .create(document.querySelector('#content1'))
            .catch(error => {
                console.error(error);
            });
    </script>

@endsection
