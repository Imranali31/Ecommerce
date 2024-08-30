<html lang="en">
  <head>
    <!-- Required meta tags -->
    <base href="{{ asset('') }}">
     @include('admin.css');
     <style type="text/css">
        .center
        {
            margin: auto;
            width: 50%;
            text-align:center;
            margin-top: 40px;
            border: 2px solid white;
        }
        .h2_font
        {
            font-size: 40px;
            text-align: center; 
            padding-top:20px;       
        }
        .img_size
        {
          width: 100px;
          height: 100px;
        }
        .tr_design
        {
          background: skyblue;
        }
        .th_design
        {
          padding: 20px;
        }
     </style>

    </head>
  <body>
    <div class="container-scroller">
      <!-- partial:partials/_sidebar.html -->
      @include('admin.sidebar');
      <!-- partial -->
      @include('admin.header');
        <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          @if(session()->has('message'))
              <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">X</button>
                  {{session()->get('message')}}
              </div>
          @endif
        <h2 class= "h2_font">All Product</h2>
            <table class="center">
                <tr class="tr_design">
                    <th class= "th_design">Product title</th>
                    <th class= "th_design">Description</th>
                    <th class= "th_design">Quantity</th>
                    <th class= "th_design">Category</th>
                    <th class= "th_design">Price</th>
                    <th class= "th_design">Discount price</th>
                    <th class= "th_design">Product image</th>
                    <th class= "th_design">Delete</th>
                    <th class= "th_design">Edit</th>
                </tr>
                @foreach($product as $product)
                <tr>
                    <td>{{$product->title}}</td>
                    <td>{{$product->description}}</td>
                    <td>{{$product->quantity}}</td>
                    <td>{{$product->category}}</td>
                    <td>{{$product->price}}</td>
                    <td>{{$product->discount_price}}</td>
                    <td>
                      <img class="img_size" src="product/{{$product->image}}">
                    </td>
                    <td >
                      <a href="{{url('delete_product',$product->id)}}" class="btn btn-danger"onclick="return confirm('Are you sure to delete product')">Delete</a>
                    </td>
                    <td >
                      <a href="{{url('update_product',$product->id)}}" class="btn btn-success">Edit</a>
                    </td>
                </tr>
                @endforeach
            </table>
        </div>
      </div>
    </div>
      @include('admin.script');
  </body>
</html>