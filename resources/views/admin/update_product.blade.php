<html lang="en">
  <head>
    <!-- Required meta tags -->
    <base href="{{ asset('') }}">
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
            <h2 class= "h2_font"> Update Product</h2>
            <div class= "div_design">
            <form action="{{url('/update_product_confirm',$product->id)}}" method="post" enctype="multipart/form-data">
                @csrf
            <lebel>Product Title :</lebel>
            <input class="text_color" type="text" name="title" placeholder="Write a Title" required="" value="{{$product->title}}">
            </div>
            <div class= "div_design">
            <lebel>Product description :</lebel>
            <input class="text_color" type="text" name="description" placeholder="Write a Description" required="" value="{{$product->description}}">
            </div>
            <div class= "div_design">
            <lebel>Product Price :</lebel>
            <input class="text_color" type="number" name="price" placeholder="Price of Product" required="" value="{{$product->price}}">
            </div>
            <div class= "div_design">
            <lebel>Discount Price :</lebel>
            <input class="text_color" type="number" name="discount_price" placeholder="Discount Price" value="{{$product->discount_price}}">
            </div>
            <div class= "div_design">
            <lebel>Product Quantity:</lebel>
            <input class="text_color" type="number" min="0"name="quantity" placeholder="Number of product Quantity" required="" value="{{$product->quantity}}">
            </div>

            <div class= "div_design">
            <lebel>Product Category:</lebel>
            <select class="text_color" name= "category" required="">
                    <option value="{{$product->category}}" selected="">{{$product->category}}</option>
                    @foreach($category as $category)
                    <option value="{{$category->category_name}}">{{$category->category_name}}</option>
                    @endforeach
                </select>
            </div>

            <div class= "div_design">
            <lebel>Current Product Image :</lebel>
            <img style="margin: auto;"width="100" height="100" src="/product/{{$product->image}}">
            </div>

            <div class= "div_design">
            <lebel>Change Product Image :</lebel>
            <input  type="file" name="image" >
            </div>

            <div class= "div_design">
            <input  type="submit" value="Update Product" class="btn btn-prinary">
            </div>
    </form>
            </div>
        </div>
    </div>
    
    @include('admin.script');
    <!-- End custom js for this page -->
  </body>
</html>