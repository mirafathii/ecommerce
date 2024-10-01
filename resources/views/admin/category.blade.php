<!doctype html>
<html lang="en" data-bs-theme="light">


<!-- Mirrored from codervent.com/matoxi/demo/vertical-menu/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 08 Sep 2024 08:59:03 GMT -->
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin - Manage Categories</title>
  <!--favicon-->
	<link rel="icon" href="assets/images/favicon-32x32.png" type="image/png">

  <!--plugins-->
  <link href="assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="assets/plugins/metismenu/metisMenu.min.css">
  <link rel="stylesheet" type="text/css" href="assets/plugins/metismenu/mm-vertical.css">
  <link rel="stylesheet" type="text/css" href="assets/plugins/simplebar/css/simplebar.css">
  <!--bootstrap css-->
  <link href="assets/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Noto+Sans:wght@300;400;500;600&amp;display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Material+Icons+Outlined" rel="stylesheet">
  <!--main css-->
  <link href="assets/css/bootstrap-extended.css" rel="stylesheet">
  <link href="sass/main.css" rel="stylesheet">
  <link href="sass/dark-theme.css" rel="stylesheet">
  <link href="sass/semi-dark.css" rel="stylesheet">
  <link href="sass/bordered-theme.css" rel="stylesheet">
  <link href="sass/responsive.css" rel="stylesheet">

</head>

<body>

  @include('parts.header')
  <!--end top header-->


  @include('parts.sidebar')
<!--end sidebar-->
  

  {{-- MAIN CONTENT START --}}

  <main class="main-wrapper">
    <div class="main-content">
      <div class="container mt-4">
        <div class="row">
          <div class="col-lg-12">
            <!-- Add Category Form -->
            <div class="card mb-3">
              <div class="card-header">
                <h5>Add New Category</h5>
              </div>
              <div class="card-body">
                {{-- Check for success message --}}
                @if (session('message'))
                  <div class="alert alert-success">
                    {{ session('message') }}
                  </div>
                @endif

                <form action="{{ route('category.add') }}" method="POST" class="d-flex">
                  @csrf
                  <div class="me-2 flex-grow-1">
                    <input type="text" name="category_name" id="categoryName" class="form-control @error('category_name') is-invalid @enderror" placeholder="Enter category name" value="{{ old('category_name') }}" required>
                    {{-- Error message for category_name field --}}
                    @error('category_name')
                      <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>
                  <button type="submit" class="btn btn-primary">Add Category</button>
                </form>
              </div>
            </div>

            <!-- Categories Table -->
            <div class="card">
              <div class="card-header">
                <h5>All Categories</h5>
              </div>
              <div class="card-body">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Name</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    <!-- Assuming $categories is passed from the controller -->
                    @foreach($categories as $category)
                    <tr>
                      <td>{{ $loop->iteration }}</td>
                      <td>{{ $category->category_name }}</td>
                      <td>
                        <a href="{{ route('category.edit', $category->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('category.destroy', $category->id) }}" method="POST" style="display:inline-block;">
                          @csrf
                          <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>


  {{-- MAIN CONTENT END --}}

  {{-- @include('parts.main_wrapper') --}}
  <!--end main wrapper-->

  <!--start overlay-->
    <div class="overlay btn-toggle"></div>
  <!--end overlay-->

 <!--start footer-->
 <footer class="page-footer">
  <p class="mb-0">Copyright © 2023. All right reserved.</p>
</footer>
<!--top footer-->

@include('parts.cart')
  <!--end cart-->

  @include('parts.switcher')
  <!--start switcher-->


  <!--bootstrap js-->
  <script src="assets/js/bootstrap.bundle.min.js"></script>

  <!--plugins-->
  <script src="assets/js/jquery.min.js"></script>
  <!--plugins-->
  <script src="assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>
  <script src="assets/plugins/metismenu/metisMenu.min.js"></script>
  <script src="assets/plugins/apexchart/apexcharts.min.js"></script>
  <script src="assets/js/index.js"></script>
  <script src="assets/plugins/peity/jquery.peity.min.js"></script>
  <script>
    $(".data-attributes span").peity("donut")
  </script>
  <script src="assets/plugins/simplebar/js/simplebar.min.js"></script>
  <script src="assets/js/main.js"></script>


</body>


<!-- Mirrored from codervent.com/matoxi/demo/vertical-menu/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 08 Sep 2024 08:59:56 GMT -->
</html>