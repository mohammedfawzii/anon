@extends('layouts.dash-layout')
@section('title', ' Edit Category')
@section('content')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title"></h5>

            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            @endif

            <form class="row g-3" method="POST" action="{{ route('categories.update') }}" enctype="multipart/form-data">
                @csrf
                <div class="col-md-12 d-flex align-items-center justify-content-between">
                    <div class="form-floating col-md-6">
                        <input type="text" name="name" class="form-control" id="floatingName"
                            placeholder="Category Name" value="{{ old('name') }}" required>
                        <label for="floatingName">Category Name</label>
                        @error('name')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <input name="img" type="file" class="form-control">
                        @error('img')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="d-flex flex-direction-column mt-3">
                        <button type="submit" class="btn btn-success btn-lg"><i class="bi bi-check-circle"></i>
                            Save</button>
                    </div>
                </div>
            </form>

        </div>
    </div>
@endsection
