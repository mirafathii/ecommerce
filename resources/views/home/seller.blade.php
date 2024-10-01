        <!-- Seller -->
        <section class="flat-spacing-5 pt_0 flat-seller">
            <div class="container">
                <div class="flat-title">
                    <span class="title wow fadeInUp" data-wow-delay="0s">Products</span>
                </div>
                <div class="grid-layout loadmore-item wow fadeInUp" data-wow-delay="0s" data-grid="grid-4">
                   
                    {{-- @foreach($products as $product)
                    <!-- card product 1 -->
                    <div class="card-product fl-item">
                        <div class="card-product-wrapper">
                            <a href="product-detail.html" class="product-img">
                                <img class="lazyload img-product" data-src="images/{{$product->image}}" src="images/{{$product->image}}" alt="image-product">
                            </a>
                            <div class="list-product-btn">
                                <a href="#" data-bs-toggle="modal" class="box-icon bg_white quick-add tf-btn-loading">
                                    <span class="icon icon-bag"></span>
                                    <span class="tooltip">Add To Cart</span>
                                </a>
                                <a href="#" data-bs-toggle="modal" class="box-icon bg_white quickview tf-btn-loading">
                                    <span class="icon icon-view"></span>
                                    <span class="tooltip">Quick View</span>
                                </a>
                            </div>
                        </div>
                        <div class="card-product-info">
                            <a href="" class="title link">{{ $product->name }}</a>
                            <span class="price">{{ number_format($product->price, 2) }} $</span>
                            @if ($product->discount > 0)
                                <span class="discount">{{ $product->discount }}% Off</span>
                            @endif
                        </div>
                    </div>
                    @endforeach --}}

                    <div class="container">
                        <div class="row">
                            <!-- Loop through the products and display each one in a wider card -->
                            @foreach($products as $product)
                            <div class="col-lg-12 col-md-12 mb-4"> <!-- Increased the width by using col-lg-6 and col-md-8 -->
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

                    {{-- @foreach ($products as $x)
                    <div class="col-sm-9 col-md-9 col-lg-9">
                       <div class="box">
                          <div class="option_container">
                             <div class="options">
                                <a href="" class="option1">
                                {{$x->title}}
                                </a>

                             </div>
                          </div>
                          <div class="img-box">
                             <img src="images/{{$x->image}}" alt="">
                          </div>
                          <div class="detail-box">
                             <h5>
                               {{$x->title}}
                            </h5>
                             <h6>
                                {{$x->price}}$
                             </h6>
                             <a href="" class="option2 btn btn-dark">
                                ADD TO CARD
                                </a>
                          </div>
                       </div>
                    </div>
                    @endforeach --}}

                </div>
            </div>
        </section>