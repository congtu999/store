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
                <h2 style="text-align: center">Edit Blog</h2>
                <p class="card-description">

                </p>
                <form class="forms-sample" action="{{ route('blog.post-edit') }}" method="POST">
                    @csrf
                    @foreach ($blogDetail as $blogDetail)
                        <div class="form-group">
                            <label for="exampleInputName1">Title</label>
                            <input type="text" class="form-control" id="exampleInputName1" placeholder="Title"
                                name="title" value="{{ old('title') ?? $blogDetail->title }}" />

                        </div>
                        <div class="form-group">
                            <label for="exampleInputName1">Description</label>
                            <textarea class="form-control" id="description" placeholder="description" name="description"> 
                       {{ old('description') ?? $blogDetail->description }} </textarea>

                        </div>
                        <div class="form-group">
                            <label for="exampleInputName1">Content</label>
                            <textarea class="form-control" id="content" placeholder="Content" name="content"> 
                       {{ old('content') ?? $blogDetail->content }} </textarea>

                        </div>
                        <div class="form-group">
                            <label for="exampleInputName1">Content 1</label>
                            <textarea class="form-control" id="content1" placeholder="Content1" name="content1"> 
                       {{ old('content1') ?? $blogDetail->content1 }} </textarea>

                        </div>
                        <div class="form-outline mb-4">
                            <label class="form-label" for="form2Example2">Image Blog</label>
                            <input type="file" id="upload4" class="form-control">
                            <div class="image-show" id="img_show4">
                            </div>
                            <br>
                            <input type="hidden" name="hinhanh4" id="hinhanh4">
                            <img src="{{ $blogDetail->image }}" alt="" id="img_old"
                                style="width: 200px;height: 100px">
                        </div>
                    @endforeach
                    <button type="submit" class="btn btn-primary ">Submit</button>

                    <button class="btn btn-light" style="color: black"> <a style="text-decoration: none;"
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
