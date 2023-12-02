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
                <h2 style="text-align: center">Edit Menu </h2>
                <p class="card-description">
                    hello mn
                </p>
                <form class="forms-sample" action="{{ route('menu.post-edit') }}" method="POST">
                    @csrf
                    @foreach ($menuDetail as $menuDetail)
                        <div class="form-group">
                            <label for="exampleInputName1">Name</label>
                            <input type="text" class="form-control" id="exampleInputName1" placeholder="Name"
                                name="name" value="{{ old('name') ?? $menuDetail->name }}" />

                        </div>
                        <div class="form-group">
                            <label for="exampleInputName1">Name</label>
                            <input type="text" class="form-control" id="exampleInputName1" placeholder="Name"
                                name="url" value="{{ old('url') ?? $menuDetail->url }}" />

                        </div>
                    @endforeach
                    <button type="submit" class="btn btn-primary ">Submit</button>

                    <button class="btn btn-light" style="color: black"> <a style="text-decoration: none;"
                            href="{{ route('listmenu') }}">Cancel</a></button>

                </form>
            </div>
        </div>
    </div>
@stop
