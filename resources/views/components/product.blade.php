<div class="product-main">
    <h2 class="title">New Products</h2>
    <div class="product-grid">
        @foreach ($data as $product)
            <div class="showcase">
                <div class="showcase-banner">
                    <!-- عرض الصورة الرئيسية للمنتج -->
                    <img src="{{ $product->images->first()->image_path }}" alt="{{ $product->name }}" width="300" class="product-img default">

                    <!-- عرض الصورة الثانية أو الأولى إذا لم تكن موجودة -->
                    @php
                        $secondImage = $product->images->skip(1)->first();
                    @endphp
                    <img src="{{ $secondImage->image_path ?? $product->images->first()->image_path }}" alt="{{ $product->name }}" width="300" class="product-img hover">

                    <p class="showcase-badge">15%</p>

                    <div class="showcase-actions">
                        <!-- إضافة المنتج إلى المفضلة -->
                        <button class="btn-action add-to-favorites" data-product-id="{{ $product->id }}">
                            <ion-icon name="heart-outline"></ion-icon>
                        </button>


                        <!-- إضافة المنتج إلى العربة -->
                        <a href="javascript:void(0)" onclick="event.preventDefault(); document.getElementById('addtocart-{{ $product->id }}').submit();" class="btn btn-solid hover-solid btn-animation">

                            <span class="btn-action">
                                <ion-icon name="bag-add-outline"></ion-icon>
                            </span>
                            <form id="addtocart-{{ $product->id }}" method="post" action="{{ route('cart.add') }}">
                                @csrf
                                <input type="hidden" name="id" value="{{ $product->id }}">
                                <input type="hidden" name="quantity" id="qty" value="1">
                            </form>
                        </a>
                    </div>
                </div>
                <div class="showcase-content">
                    <a href="#" class="showcase-category">{{ $product->name }}</a>
                    <a href="#">
                        <h3 class="showcase-title">{{ $product->description }}</h3>
                    </a>

                    <div class="showcase-rating">
                        <!-- عرض تقييم المنتج -->
                        <ion-icon name="star"></ion-icon>
                        <ion-icon name="star"></ion-icon>
                        <ion-icon name="star"></ion-icon>
                        <ion-icon name="star-outline"></ion-icon>
                        <ion-icon name="star-outline"></ion-icon>
                    </div>

                    <div class="price-box">
                        <p class="price">${{ $product->price }}</p>
                        <del>$75.00</del>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
