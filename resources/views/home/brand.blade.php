<!-- categories -->
<section class="flat-spacing-5 pt_0">
    <div class="container">
        <div class="swiper tf-sw-category" data-loop="false" data-play="false" data-preview="6" data-tablet="3" data-mobile="2" data-space-lg="0" data-space-md="0">
            <div class="swiper-wrapper">
                @foreach($categories as $category) <!-- Assuming you are passing 'categories' from the controller -->
                    <div class="swiper-slide">
                        <div class="category-item">
                            <img class="lazyload" data-src="images/categories/{{ $category->image }}" src="images/categories/{{ $category->image }}" alt="{{ $category->name }}">
                            <h1>{{ $category->name }}</h1> <!-- Display category name -->
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="sw-dots style-2 sw-pagination-category justify-content-center"></div>
    </div>
</section>
