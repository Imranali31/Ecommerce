<!DOCTYPE html>
<html>
   <head>
      <base href="{{ asset('') }}">
      @include('home.css');
      <style>
         .center{
            margin: auto;
            width: 50%;
            text-align: center;
            padding: 30px;
         }
         table,th,td
         {
            border: 1px solid gray;

         }
         .th_design{
            font-size: 30px;
            padding : 5px;
            background : skyblue;
         }
         .img_size
        {
          width: 150px;
          height: 150px;
        }
        .text_size{
             font-size: 30px;
             padding 20px;
             font-style: bold;
        }
      </style>
   </head>
   <body>
        <div class="hero_area">
            @include('home.header'); 
            @if(session()->has('message'))
                    <div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">X</button>
                        {{session()->get('message')}}
                    </div>
                @endif 
      <div>
         <table class="center">
            <tr>
               <th  class="th_design">Product title</th>
               <th class="th_design">Product quantity</th>
               <th class="th_design">Price</th>
               <th class="th_design">Image</th>
               <th class="th_design">Action</th>
            </tr>
            <?php $totalPrice=0 ?>
            @foreach($cart as $cart)
            <tr>
               <td>{{$cart->product_title}}</td>
               <td>{{$cart->quantity}}</td>
               <td>Tk.{{$cart->price}}</td>
               <td>
                  <img class="img_size" src="product/{{$cart->image}}">
               </td>
               <td>
               <a href="{{url('remove_cart',$cart->id)}}" class="btn btn-danger"onclick="return confirm('Are you sure to remove product')">Delete</a>
               </td>
            </tr>
            <?php $totalPrice= $totalPrice +$cart->price ?>
            @endforeach
         </table>
      </div>
         
      <div class="center">
            <h1 class= "text_size">Total Price : Tk.{{$totalPrice}}</h1>
      </div>
      <div class="center">
         <h1 style = "font-size : 25px; padding :15px;"> Proceed to Order </h1>
         <a href="{{url('cash_order')}}"  class= "btn btn-danger">Cash on Delivery</a>
         <a href="{{url('stripe',$totalPrice)}}"  class= "btn btn-danger">Pay Using Card</a>
      </div>
         
      
   </div>   
      
     
      
      @include('home.script');
   </body>
</html>