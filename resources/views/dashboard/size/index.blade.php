@extends('layouts.dash-layout')
@section('title', 'Sizes')
@section('content')
    <div class="card">
        <div class="card-body p-5">
            <h5 class="card-title">Sizes</h5>
            <form class="row g-3" method="POST" action="{{ route('sizes.store') }}">
                @csrf
                <div class="col-md-12 d-flex justify-content-between align-items-center">
                    <div class="form-floating col-md-11">
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="floatingName"
                            name="name" placeholder="Your Size" value="{{ old('name') }}">
                        <label for="floatingName">Your Size</label>
                        @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </form>
            <table class="table mt-5">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Size</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($size->count() > 0)
                        @foreach ($size as $item)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ $item->name }}</td>

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
                            <td colspan="4" class="text-center">No Size available.</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>

@endsection
