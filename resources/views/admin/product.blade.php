<html lang="en">
  <head>
    <!-- Required meta tags -->
    @include('admin.css');
    <style type="text/css">
        .div_center
        {
            text-align: center;
            padding-top: 40px;
        }

        .h2_font
        {
            font-size: 40px;
            padding-bottom: 40px;
        
        }
        lebel
        {
            display: inline-block;
            width: 200px;
        }
        .text_color
        {
            color: black;
            padding-bottom: 20px;
        }
        .div_design
        {
            padding-bottom: 15px;
        }
     </style>
   </head>
  <body>
    <div class="container-scroller">
      <!-- partial:partials/_sidebar.html -->
      @include('admin.sidebar');
      <!-- partial -->
      @include('admin.header');
      <div class="main-panel">
        <div class="content-wrapper">
            <div class="div_center">
            <h2 class= "h2_font"> Add Product</h2>
            <div class= "div_design">
            @if(session()->has('message'))
                    <div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">X</button>
                        {{session()->get('message')}}
                    </div>
                @endif
            <form action="{{url('/add_product')}}" method="post" enctype="multipart/form-data">
                @csrf
            <lebel>Product Title :</lebel>
            <input class="text_color" type="text" name="title" placeholder="Write a Title" required="">
            </div>
            <div class= "div_design">
            <lebel>Product description :</lebel>
            <input class="text_color" type="text" name="description" placeholder="Write a Description" required="">
            </div>
            <div class= "div_design">
            <lebel>Product Price :</lebel>
            <input class="text_color" type="number" name="price" placeholder="Price of Product" required="">
            </div>
            <div class= "div_design">
            <lebel>Discount Price :</lebel>
            <input class="text_color" type="number" name="discount_price" placeholder="Discount Price">
            </div>
            <div class= "div_design">
            <lebel>Product Quantity:</lebel>
            <input class="text_color" type="number" min="0"name="quantity" placeholder="Number of product Quantity" required="">
            </div>
            <div class= "div_design">
            <lebel>Product Category:</lebel>
            <select class="text_color" name= "category" required="">
                    <option value="" selected="">Add a category</option>
                    @foreach($category as $category)
                    <option value="{{$category->category_name}}">{{$category->category_name}}</option>
                    @endforeach
                </select>
            </div>
            <div class= "div_design">
            <lebel>Product Image :</lebel>
            <input  type="file" name="image" required="" >
            </div>
            <div class= "div_design">
            <input  type="submit" value="Add Product" class="btn btn-prinary">
            </div>
    </form>
            </div>
        </div>
    </div>
    
    @include('admin.script');
    <!-- End custom js for this page -->
  </body>
</html>