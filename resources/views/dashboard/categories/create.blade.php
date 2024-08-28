@extends('layouts.dash-layout')
@section('title', 'Categories')
@section('content')
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <div>{{ $error }}</div>
        @endforeach
    @endif
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Floating labels Form</h5>
            <form class="row g-3" method="POST" action="{{ route('categories.store') }}" enctype="multipart/form-data">
                <div class="col-lg-6 row g-3" style="display: flex;align-items: flex-start;flex-direction: column;">

                    <div class="col-md-12">
                        <div class="form-floating">
                            <input type="text" class="form-control" required id="floatingName" name="name"
                                placeholder="Your Name">
                            @csrf
                            <label for="floatingName">categories name</label>
                            @error('name')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form">
                            <input id="file-input" required name="img" class="form-control" type="file"
                                accept="image/*">
                            @error('img')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-floating mb-3">
                            <select name="branch_id" class="form-select" id="floatingSelect" aria-label="State">
                                @foreach ($branches as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                            <label for="floatingSelect">Branch</label>
                        </div>
                    </div>
                </div>
                <div id="image-preview" class="col-lg-6"
                    style="width: 45%; height:450px; display: flex;align-items: center;justify-content: center;padding:15px; border: gray 1px solid;border-radius: 10px;">
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <button type="reset" class="btn btn-secondary">Reset</button>
                </div>
            </form>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const fileInput = document.getElementById('file-input');
                const imagePreview = document.getElementById('image-preview');

                fileInput.addEventListener('change', function() {
                    const file = fileInput.files[0];
                    if (file) {
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            imagePreview.innerHTML =
                                `<img src="${e.target.result}" alt="Image Preview" class="img-fluid" />`;
                        };
                        reader.readAsDataURL(file);
                    } else {
                        imagePreview.innerHTML = '';
                    }
                });
            });
        </script>
    @endsection
