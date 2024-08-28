@extends('layouts.dash-layout')
@section('title', 'Product')
@section('content')


    <div class="card">
        <div class="card-body">
            <h5 class="card-title">New Product</h5>
            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            @endif
            <form class="row g-3 d-flex justify-content-around" action="{{ route('products.store') }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                <div style="width: 45% ">
                    <div class="row g-3">
                        <div class="col-md-12">
                            <div class="form-floating">
                                <input type="text" name="name" class="form-control" id="floatingName"
                                    placeholder="Your Name">
                                <label for="floatingName">Product Name</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <select name="category_id" class="form-select" id="floatingSelect" aria-label="State">
                                    @foreach ($category as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                                <label for="floatingSelect">Select Category</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="number" name="price" class="form-control" id="floatingName"
                                    placeholder="Your Name">
                                <label for="floatingName">price</label>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-floating">
                                <textarea class="form-control" placeholder="Address" name="description" id="floatingTextarea" style="height: 100px;"></textarea>
                                <label for="floatingTextarea">description</label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form">
                                <input id="file-input" name="img[]" class="form-control" type="file" accept="image/*"
                                    multiple>
                            </div>

                            <div class="col-md-12 mt-3">
                                <label>Colors and Stock</label>
                                <div id="color-stock-section" class="mt-3">
                                    <div class="color-stock-item mb-1 d-flex align-items-center">
                                        <select name="colors[0][color_id]" class="form-control color-select me-2">
                                            <option value="">Select Color</option>
                                            @foreach ($colors as $color)
                                                <option value="{{ $color->id }}">{{ $color->name }}</option>
                                            @endforeach
                                        </select>
                                        <select name="colors[0][sizes][0][size_id]" class="form-control size-select me-2">
                                            <option value="">Select Size</option>
                                            @foreach ($sizes as $size)
                                                <option value="{{ $size->id }}">{{ $size->name }}</option>
                                            @endforeach
                                        </select>

                                        <input type="number" name="colors[0][sizes][0][stock]" class="form-control me-2"
                                            placeholder="Stock" min="0">

                                        <button type="button" class="btn btn-danger remove-size"><i
                                                class="bi bi-trash"></i></button>
                                    </div>
                                </div>
                                <button type="button" class="btn btn-success mt-2" id="add-color">
                                    <i class="bi bi-check-circle"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div
                    style="width: 45%;display: flex;align-items: center;justify-content: center;border: gray 1px solid;border-radius: 10px;">
                    <div class="slider-container">
                        <div id="image-preview" class="slider-wrapper">

                        </div>
                        <button type="button" id="prev" class="slider-btn">◀️</button>
                        <button type="button" id="next" class="slider-btn">▶️</button>
                    </div>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <button type="reset" class="btn btn-secondary">Reset</button>
                </div>
            </form>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let colorIndex = 1;

            document.getElementById('add-color').addEventListener('click', function() {
                let lastColorSelect = document.querySelector(
                    `#color-stock-section select[name="colors[${colorIndex - 1}][color_id]"]`);
                let lastSizeSelect = document.querySelector(
                    `#color-stock-section select[name="colors[${colorIndex - 1}][sizes][0][size_id]"]`);
                let lastStockInput = document.querySelector(
                    `#color-stock-section input[name="colors[${colorIndex - 1}][sizes][0][stock]"]`);

                if (lastColorSelect && lastSizeSelect && lastStockInput) {
                    if (lastColorSelect.value === "" || lastSizeSelect.value === "" || lastStockInput
                        .value === "") {
                        alert('Please fill in all fields before adding a new one.');
                        return;
                    }
                }

                let colorStockSection = document.getElementById('color-stock-section');
                let newColorStockItem = document.createElement('div');
                newColorStockItem.className = 'color-stock-item mb-2 d-flex align-items-center';

                newColorStockItem.innerHTML = `
                    <select name="colors[${colorIndex}][color_id]" class="form-control color-select me-2">
                        <option value="">Select Color</option>
                        @foreach ($colors as $color)
                            <option value="{{ $color->id }}">{{ $color->name }}</option>
                        @endforeach
                    </select>
                    <select name="colors[${colorIndex}][sizes][0][size_id]" class="form-control size-select me-2">
                        <option value="">Select Size</option>
                        @foreach ($sizes as $size)
                            <option value="{{ $size->id }}">{{ $size->name }}</option>
                        @endforeach
                    </select>
                    <input type="number" name="colors[${colorIndex}][sizes][0][stock]" class="form-control me-2" placeholder="Stock" min="0">
                    <button type="button" class="btn btn-danger remove-color"><i class="bi bi-trash"></i></button>
                `;

                colorStockSection.appendChild(newColorStockItem);
                colorIndex++;

                // Add event listener for removing color items
                newColorStockItem.querySelector('.remove-color').addEventListener('click', function() {
                    newColorStockItem.remove();
                });
            });

            // Ensure that remove button works for dynamically created elements
            document.getElementById('color-stock-section').addEventListener('click', function(event) {
                if (event.target.classList.contains('remove-color') || event.target.closest(
                        '.remove-color')) {
                    event.target.closest('.color-stock-item').remove();
                }
            });
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const fileInput = document.getElementById('file-input');
            const imagePreview = document.getElementById('image-preview');
            const prevButton = document.getElementById('prev');
            const nextButton = document.getElementById('next');

            let currentIndex = 0;

            fileInput.addEventListener('change', function() {
                const files = fileInput.files;
                imagePreview.innerHTML = ''; // Clear previous previews

                if (files.length > 0) {
                    Array.from(files).forEach(file => {
                        if (file) {
                            const reader = new FileReader();
                            reader.onload = function(e) {
                                const img = document.createElement('img');
                                img.src = e.target.result;
                                img.alt = 'Image Preview';
                                img.classList.add('slider-image'); // Add a class for styling
                                imagePreview.appendChild(img);
                            };
                            reader.readAsDataURL(file);
                        }
                    });

                    // Initialize slider
                    updateSlider();
                }
            });

            function updateSlider() {
                const images = imagePreview.getElementsByTagName('img');
                const totalImages = images.length;
                if (totalImages > 0) {
                    imagePreview.style.width = `${totalImages * 100}%`;
                    imagePreview.style.transform = `translateX(${-currentIndex * (100 / totalImages)}%)`;
                }
            }

            prevButton.addEventListener('click', function() {
                const images = imagePreview.getElementsByTagName('img');
                const totalImages = images.length;

                if (totalImages > 0) {
                    currentIndex = (currentIndex > 0) ? currentIndex - 1 : totalImages - 1;
                    updateSlider();
                }
            });

            nextButton.addEventListener('click', function() {
                const images = imagePreview.getElementsByTagName('img');
                const totalImages = images.length;

                if (totalImages > 0) {
                    currentIndex = (currentIndex < totalImages - 1) ? currentIndex + 1 : 0;
                    updateSlider();
                }
            });
        });
    </script>

    <style>
        .slider-container {
            position: relative;
            overflow: hidden;
            width: 100%;
            height: 300px;
        }

        .slider-wrapper {
            display: flex;
            transition: transform 0.5s ease;
            align-items: center;
            justify-content: space-around
        }

        .slider-image {
            width: 350px;
            height: 300px;
            flex-shrink: 0;
        }

        .slider-btn {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            /* background: rgba(0, 0, 0, 0.5); */
            color: white;
            border: none;
            padding: 10px;
            cursor: pointer;
            z-index: 1;
        }

        #prev {
            left: 10px;
        }

        #next {
            right: 10px;
        }
    </style>
@endsection
