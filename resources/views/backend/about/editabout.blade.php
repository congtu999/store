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
                <h2 style="text-align: center">Edit About</h2>
                <p class="card-description">

                </p>
                <form class="forms-sample" action="{{ route('about.post-edit') }}" method="POST">
                    @csrf
                    @foreach ($aboutDetail as $aboutDetail)
                        <div class="form-group">
                            <label for="exampleInputName1">Title</label>
                            <input type="text" class="form-control" id="exampleInputName1" placeholder="Title"
                                name="title" value="{{ old('title') ?? $aboutDetail->title }}" />

                        </div>
                        <div class="form-group">
                            <label for="exampleInputName1">Content</label>
                            <textarea class="form-control" id="content" placeholder="Content" name="content"> 
                   {{ old('content') ?? $aboutDetail->content }} </textarea>

                        </div>
                        <div class="form-outline mb-4">
                            <label class="form-label" for="form2Example2">Image About</label>
                            <input type="file" id="upload5" class="form-control">
                            <div class="image-show" id="img_show5">
                            </div>
                            <br>
                            <input type="hidden" name="hinhanh5" id="hinhanh5">
                            <img src="{{ $aboutDetail->image }}" alt="" id="img_old5"
                                style="width: 130px;height: 180px">
                        </div>
                    @endforeach
                    <button type="submit" class="btn btn-primary ">Submit</button>

                    <button class="btn btn-light" style="color: black"> <a style="text-decoration: none;"
                            href="{{ route('listabout') }}">Cancel</a></button>

                </form>
            </div>
        </div>
    </div>

@stop
@section('js-custom')
    <script>
        ClassicEditor
            .create(document.querySelector('#content'))
            .catch(error => {
                console.error(error);
            });
    </script>

@endsection
