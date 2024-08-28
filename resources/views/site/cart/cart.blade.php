@extends('layouts.site-layout')
@section('title', 'Shopping Cart')
@section('content')
    <div class="card-shopping">
        <div class="card-page">

            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Product</th>
                        <th>Image</th>
                        <th>Qty</th>
                        <th>Price</th>
                        <th>Total</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @if ($cartItems->count() > 0)
                        @foreach ($cartItems as $item)
                            @php
                                $product = \App\Models\Product::find($item->id);
                                $productImage = $product ? $product->images->first() : null;
                            @endphp
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td style="display: flex;justify-content:center"><img
                                        src="{{ $productImage ? $productImage->image_path : 'path/to/default/image.jpg' }}"
                                        width="100" alt="{{ $item->name }}"></td>
                                <td>{{ $item->name }}</td>
                                <td>
                                    <input type="number" name="quantity" value="{{ $item->qty }}" class="form-control"
                                        min="1">
                                </td>
                                <td>${{ $item->price }}</td>
                                <td>${{ $item->price * $item->qty }}</td>
                                <td>
                                    <form action="{{ route('cart.remove', $item->rowId) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-remove">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="7" class="text-center">Empty Cart</td>
                            {{-- اضافه زر ذهاب الى المتجر للتسوق --}}
                        </tr>
                    @endif
                </tbody>
            </table>

            <div class="col-lg-4">
                <div class="cart-box">
                    <div class="cart-box-details">
                        <div class="total-details">
                            <div class="top-details">
                                <h3>Cart Totals</h3>
                                <h6>Sub Total <span>${{ Cart::subtotal() }}</span></h6>
                                <h6>Tax <span>${{ Cart::tax() }}</span></h6>
                                <h6>Total <span>${{ Cart::total() }}</span></h6>
                            </div>
                            <div class="bottom-details">
                                <a href="" class="btn btn-primary">Process Checkout</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <style>
        .product-box {
            width: 100%;
        }

        .card-shopping {
            font-family: 'Poppins', sans-serif;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #333;
        }

        .btn-remove {
            background-color: #ff6b6b;
            color: white;
            border: none;
            border-radius: 50px;
            padding: 10px 20px;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.3s ease, box-shadow 0.3s ease, transform 0.3s ease;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        /* تأثير التحويم (Hover) على زر الحذف */
        .btn-remove:hover {
            background-color: #ff4757;
            box-shadow: 0 4px 12px rgba(255, 107, 107, 0.3);
            transform: translateY(-3px);
        }

        /* تأثير النقر (Active) على زر الحذف */
        .btn-remove:active {
            background-color: #e74c3c;
            box-shadow: 0 2px 8px rgba(255, 107, 107, 0.5);
            transform: translateY(0);
        }

        /* إضافة أيقونة للحذف */
        .btn-remove i {
            margin-right: 8px;
            font-size: 16px;
        }

        /* تنسيق العنوان الرئيسي */
        .card-page {
            width: 100%;
        }

        .card-page h2 {
            font-size: 34px;
            font-weight: 700;
            color: #222;
            text-align: center;
            margin-bottom: 30px;
            background: linear-gradient(90deg, #ff6b6b, #f7b731);
            -webkit-background-clip: text;
            color: transparent;
        }

        /* تنسيق الجدول */
        .table {
            width: 100%;
            margin-bottom: 20px;
            border-collapse: separate;
            border-spacing: 0 15px;
        }

        .table th,
        .table td {
            padding: 15px;
            text-align: center;
            vertical-align: middle;
            background-color: #fff;
            border: none;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }

        .table th {
            background-color: #f7f7f7;
            font-weight: 600;
            color: #555;
        }

        .table img {
            border-radius: 12px;
            max-width: 80px;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .table img:hover {
            transform: scale(1.1);
        }

        /* تنسيق حقول الإدخال */
        .form-control {
            width: 70px;
            margin: 0 auto;
            text-align: center;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            padding: 5px;
            font-size: 16px;
            transition: border-color 0.3s ease;
        }

        .form-control:focus {
            border-color: #ff6b6b;
            box-shadow: 0 0 8px rgba(255, 107, 107, 0.5);
        }

        /* تنسيق قسم الإجماليات */
        .cart-box {
            background-color: #fff;
            padding: 25px;
            border-radius: 15px;
            margin-top: 30px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }

        .cart-box:hover {
            transform: translateY(-5px);
        }

        .cart-box .total-details {
            margin-bottom: 25px;
        }

        .total-details h3 {
            font-size: 24px;
            font-weight: 700;
            margin-bottom: 20px;
            color: #222;
        }

        .total-details h6 {
            font-size: 18px;
            margin: 10px 0;
            font-weight: 500;
            color: #666;
        }

        .total-details span {
            float: right;
            font-weight: 700;
            color: #333;
        }

        .bottom-details {
            text-align: center;
        }

        .bottom-details a {
            display: inline-block;
            padding: 12px 30px;
            background: linear-gradient(90deg, #ff6b6b, #f7b731);
            color: white;
            text-decoration: none;
            border-radius: 50px;
            transition: box-shadow 0.3s ease, transform 0.3s ease;
            font-weight: 600;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .bottom-details a:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(255, 107, 107, 0.4);
        }

        /* تنسيق الزر الأحمر لحذف العناصر */
        .btn-danger {
            background-color: #ff6b6b;
            border-color: #ff6b6b;
            color: white;
            border-radius: 50px;
            padding: 10px 20px;
            transition: background-color 0.3s ease, box-shadow 0.3s ease;
        }

        .btn-danger:hover {
            background-color: #ff4757;
            box-shadow: 0 4px 12px rgba(255, 107, 107, 0.3);
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const forms = document.querySelectorAll('.update-cart-form');

            forms.forEach(form => {
                form.addEventListener('submit', async (e) => {
                    e.preventDefault();

                    const formData = new FormData(form);
                    const id = form.getAttribute('data-id');
                    const quantity = form.querySelector(`#quantity-${id}`).value;

                    try {
                        const response = await fetch(`/cart/update/${id}`, {
                            method: 'PUT',
                            headers: {
                                'X-Requested-With': 'XMLHttpRequest',
                                'X-CSRF-TOKEN': formData.get('_token'),
                                'Content-Type': 'application/json'
                            },
                            body: JSON.stringify({
                                quantity: quantity
                            })
                        });

                        const result = await response.json();

                        if (response.ok) {
                            alert(result.message);
                            location.reload();
                        } else {
                            alert(result.message);
                        }
                    } catch (error) {
                        console.error('حدث خطأ:', error);
                        alert('حدث خطأ أثناء التحديث');
                    }
                });
            });
        });
    </script>

@endsection
