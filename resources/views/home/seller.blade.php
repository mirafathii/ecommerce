        <!-- Seller -->
        <section class="flat-spacing-5 pt_0 flat-seller">
            <div class="container">
                <div class="flat-title">
                    <span class="title wow fadeInUp" data-wow-delay="0s">Products</span>
                </div>
                <div class="grid-layout loadmore-item wow fadeInUp" data-wow-delay="0s" data-grid="grid-4">
                    <!-- Loop through the products and display each one in a wider card -->
                    @foreach($products as $product)
                    <div class="col-lg-9 col-md-9 mb-4"> <!-- Increased the width by using col-lg-6 and col-md-8 -->
                        <div class="card h-100" style="width: 100%;"> <!-- Full width card inside column -->
                            <!-- Product Image -->
                            <img src="images/{{$product->image}}" class="card-img-top" alt="{{ $product->name }}" style="height: 300px; object-fit: cover;">
            
                            <!-- Card Body -->
                            <div class="card-body">
                                <h5 class="card-title">{{ $product->name }}</h5>
                                <p class="card-text">
                                    {{ Str::limit($product->description, 150) }} <!-- Increased description limit -->
                                </p>
            
                                <!-- Price and Discount -->
                                <p class="card-text">
                                    <strong>Price: </strong>${{ number_format($product->price, 2) }}
                                    @if ($product->discount > 0)
                                        <br>
                                        <small class="text-danger">
                                            <strong>Discount: </strong>{{ $product->discount }}%
                                        </small>
                                    @endif
                                </p>
            
                                <!-- Category -->
                                <p class="card-text">
                                    <strong>Category: </strong>{{ $product->category->category_name }}
                                </p>
                            </div>
            
                            <!-- Card Footer with actions -->
                            <div class="card-footer text-center">
                                {{-- <a href="{{ route('products.index') }}" class="btn btn-info btn-sm">View</a> --}}
                                <form action="{{ route('carts.add', $product->id) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    <button type="submit" class="btn btn-dark btn-sm">ADD TO CART</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </section>