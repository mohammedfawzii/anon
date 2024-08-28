@extends('layouts.dash-layout')
@section('title', 'branches')
@section('content')
    <div class="card">
        <div class="card-body p-5">
            <table class="table mt-5">
                <div class="d-flex justify-content-between align-items-center"  >
                    <h5 class="card-title">Default Buttons</h5>
                    <a href="{{route('branches.create')}}" type="button" class="btn btn-primary">Add Branch</a>
                </div>
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">icon</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($branches->count() > 0)
                        @foreach ($branches as $item)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ $item->name }}</td>
                                <td><img style="width: 50px" src="{{ $item->img }}" alt="{{ $item->name }}"></td>
                                <td>
                                    <a href="{{ route('branches.edit', $item->id) }}" class="btn btn-warning">Edit</a>
                                    <form action="{{ route('branches.destroy', $item->id) }}" method="POST"
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
                            <td colspan="4" class="text-center">No branches available.</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>

@endsection
