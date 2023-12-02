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
                <h2 style="text-align: center">Add New Product</h2>
                <p class="card-description">
                </p>
                <form class="forms-sample" enctype="multipart/form-data" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="exampleInputName1">Name</label>
                        <input type="text" class="form-control" id="exampleInputName1" placeholder="Name" name="name"
                            value="{{ old('name') }}" />

                    </div>
                    <div class="form-group">
                        <label class="form-label" for="form2Example2">Image Product</label>
                        <input type="file" id="upload" class="form-control">
                        <div class="image-show" id="img_show">
                            
                        </div>
                        <input type="hidden" name="hinhanh" id="hinhanh">
                    </div>
                    <div class="form-group">
                        <label for="form2Example2">Image Product Detail 1 </label>
                        <input type="file" id="upload1" class="form-control">
                        <div class="image-show" id="img_show1">
                        </div>
                        <input type="hidden" name="hinhanh1" id="hinhanh1">
                    </div>
                    <div class="form-group">
                        <label for="form2Example2">Image Product Detail 2</label>
                        <input type="file" id="upload2" class="form-control">
                        <div class="image-show" id="img_show2">
                        </div>
                        <input type="hidden" name="hinhanh2" id="hinhanh2">
                    </div>
                    <div class="form-group">
                        <label for="form2Example2">Image Product Detail 3</label>
                        <input type="file" id="upload3" class="form-control">
                        <div class="image-show" id="img_show3">
                        </div>
                        <input type="hidden" name="hinhanh3" id="hinhanh3">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword4">Description</label>
                        <textarea name="description" id="description" cols="1000" rows="10">{{ old('description') }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail3">Price</label>
                        <input type="text" class="form-control" placeholder="Price" name="price"
                            value="{{ old('price') }}">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail3">Quantity</label>
                        <input type="text" class="form-control" placeholder="Quantity" name="quantity"
                            value="{{ old('quantity') }}">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail3">Color</label>
                        <input type="text" id="form2Example2" class="form-control" name="color"
                            value="{{ old('color') }}" />
                    </div>
                    <div class="form-group">
                        <label for="exampleSelectGender">Category</label>
                        <select class="form-select" class="category_id" name="category_id">
                            @foreach ($categories as $item)
                                <option class="form-control" value="{{ $item->id }}">
                                    {{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary ">Submit</button>
                    <button class="btn btn-light"><a style="text-decoration: none;"
                            href="{{ route('listproduct') }}">Cancel</a></button>
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
    </script>

@endsection
