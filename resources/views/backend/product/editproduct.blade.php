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


        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Edit product</h4>

                <form class="forms-sample" action="{{ route('product.post-edit') }} " method="post">
                    @csrf
                    @foreach ($productDetail as $productDetail)
                        <div class="form-group">
                            <label for="exampleInputName1">Name</label>
                            <input type="text" class="form-control" id="exampleInputName1" placeholder="Name"
                                name="name" value="{{ old('name') ?? $productDetail->name }}" />

                        </div>
                        <div class="form-outline mb-4">
                            <label class="form-label" for="form2Example2">Image Product</label>
                            <input type="file" id="upload" class="form-control">
                            <div class="image-show" id="img_show">
                            </div>
                            <br>
                            <input type="hidden" name="hinhanh" id="hinhanh">
                            <img src="{{ $productDetail->image }}" alt="" id="img_old"
                                style="width: 120px;height: 200px">
                        </div>
                        <div class="form-outline mb-4">
                            <label class="form-label" for="form2Example2">Image Detail 1</label>
                            <input type="file" id="upload1" class="form-control">
                            <div class="image-show" id="img_show1">
                            </div>
                            <br>
                            <input type="hidden" name="hinhanh1" id="hinhanh1">
                            <img src="{{ $productDetail->image_detail_1 }}" alt="" id="img_old1"
                                style="width: 120px;height: 200px">
                        </div>
                        <div class="form-outline mb-4">
                            <label class="form-label" for="form2Example2">Image Detail 2</label>
                            <input type="file" id="upload2" class="form-control">
                            <div class="image-show" id="img_show2">
                            </div>
                            <br>
                            <input type="hidden" name="hinhanh2" id="hinhanh2">
                            <img src="{{ $productDetail->image_detail_2 }}" alt="" id="img_old2"
                                style="width: 120px;height: 200px">
                        </div>
                        <div class="form-outline mb-4">
                            <label class="form-label" for="form2Example2">Image Detail 3</label>
                            <input type="file" id="upload3" class="form-control">
                            <div class="image-show" id="img_show3">
                            </div>
                            <br>
                            <input type="hidden" name="hinhanh3" id="hinhanh3">
                            <img src="{{ $productDetail->image_detail_3 }}" alt="" id="img_old3"
                                style="width: 120px;height: 200px">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword4">Description</label>
                            <textarea class="form-control" name="description" id="description" cols="100" rows="10">{{ old('description') ?? $productDetail->description }}</textarea>

                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail3">Price</label>
                            <input type="text" class="form-control" placeholder="Price" name="price"
                                value="{{ old('price') ?? $productDetail->price }}" />
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail3">Quantity</label>
                            <input type="text" class="form-control" placeholder="Quantity" name="quantity"
                                value="{{ old('quantity') ?? $productDetail->quantity }}" />
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail3">Color</label>
                            <input type="text" id="form2Example2" class="form-control" name="color"
                                value="{{ old('color') ?? $productDetail->color }}" />
                        </div>
                        <div class="form-group">
                            <label for="exampleSelectGender">Category</label>
                            <select class="form-select" name="category_id">
                                @foreach ($category as $item)
                                    <option class="form-control"
                                        {{ $productDetail->category_id == $item->id ? 'selected' : '' }}
                                        value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                    @endforeach
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
