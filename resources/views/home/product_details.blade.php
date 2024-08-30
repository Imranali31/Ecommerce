<!DOCTYPE html>
<html>
   <head>
      <base href="{{ asset('') }}">
      @include('home.css');
      
   </head>
   <body>
        <div class="hero_area">
            @include('home.header');
        <div class="col-sm-6 col-md-4 col-lg-4" style="margin:auto; width: 50%; padding:30px;">
                     <div class="img-box">
                        <img src="product/{{$products->image}}" alt="product image" style="width:350px; height:300px;">
                     </div>
                     <div class="detail-box">
                        <h5>
                           {{$products->title}}
                        </h5>
                        @if($products->discount_price !=null)
                        <h6 style="text-decoration: line-through;color: red;">
                        Price
                        ${{$products->price}}
                        </h6>
                        <h6 style="color: green">
                        Discount Price
                        ${{$products->discount_price}}
                        </h6>
      
                        @else 
                        <h6 style="color: green">
                        Price
                        ${{$products->price}}
                        </h6>
                        @endif
                        <h6>
                            Product Category : 
                           {{$products->category}}
                        </h6>
                        <h6>
                            Product Description : 
                           {{$products->description}}
                        </h6>
                        <h6>
                            Available Quantity : 
                           {{$products->quantity}}
                        </h6>
                        
                        <form action="{{ url('add_cart', $products->id) }}" method="POST">

                           @csrf

                           <div class="row">
                              <div class="col-md-4">
                                 <input type="number" name="quantity" value="1" min="1" max="10" style="width:100px">
                              </div>
                              <div class="col-md-4">
                                 <input type="submit" value="Add to Cart">
                              </div>
                           </div>

                           </form>

                     </div>
                  </div>
               </div>

      @include('home.footer');
     
      
      @include('home.script');
   </body>
</html>