@extends('layouts.dash-layout')

@section('title', 'Product')
@section('content')
    <div class="card">
        <div class="card-body">
            <div class=" d-flex justify-content-between align-items-center">
                <h5 class="card-title">products</h5>
                <a href="{{ route('products.create') }}" type="button" class="btn btn-primary">New Product</a>
            </div>

            <table class="table table-borderless">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Product</th>
                        <th scope="col">Stock</th>
                        <th scope="col">branch</th>
                        <th scope="col">category</th>
                        <th scope="col">Image</th>
                        <th scope="col">Rate</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $item)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->stock }}</td>
                            <td>{{ $item->category->branch->name }}</td>
                            <td>{{ $item->category->name }}</td>
                            <td> <img style="width:100px" src="{{ $item->images->first()->image_path }}" alt="{{ $item->name }}"></td>
                            <td>{{ $item->rate }}</td>
                            <td>
                                <a href="{{ route('products.edit', $item->id) }}" class="btn btn-warning">Edit</a>
                                <form action="{{ route('products.destroy', $item->id) }}" method="POST"
                                    style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger"
                                        onclick="return confirm('Are you sure?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
@endsection
