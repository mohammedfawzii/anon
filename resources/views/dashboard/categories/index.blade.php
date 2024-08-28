@extends('layouts.dash-layout')
@section('title', 'Categories')
@section('content')
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="card-title">Category</h5>
                <a href="{{ route('categories.create') }}" type="button" class="btn btn-primary">Add Category</a>
            </div>
            <table class="table mt-5">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Icon</th>
                        <th scope="col">Branch</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($categories->count() > 0)
                        @foreach ($categories as $category)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ $category->name }}</td>
                                <td><img style="width: 50px" src="{{ $category->img }}" alt="{{ $category->name }}"></td>
                                <td>{{ $category->branch->name }}</td>
                                <td>
                                    <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-warning">Edit</a>
                                    <form action="{{ route('categories.destroy', $category->id) }}" method="POST"
                                        style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger"
                                            onclick="return confirm('Are you sure?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="4" class="text-center">No categories available.</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>

@endsection
