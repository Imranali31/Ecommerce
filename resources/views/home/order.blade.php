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
           
            <div>
         <table class="center">
            <tr>
               <th  class="th_design">Product title</th>
               <th class="th_design">Quantity</th>
               <th class="th_design">Price</th>
               <th class="th_design">Payment Status</th>
               <th class="th_design">Delivery Status</th>
               <th class="th_design">Image</th>
               <th class="th_design">Action</th>
            </tr>
           
            @foreach($order as $order)
            <tr>
               <td>{{$order->product_title}}</td>
               <td>{{$order->quantity}}</td>
               <td>Tk.{{$order->price}}</td>
               <td>{{$order->payment_status}}</td>
               <td>{{$order->delivery_status}}</td>
               <td>
                  <img class="img_size" src="product/{{$order->image}}">
               </td>
               <td>
                @if($order->delivery_status=='Processing')
                     <a href="{{url('cancel_order',$order->id)}}" class="btn btn-danger"onclick="return confirm('Are you sure to cancel order')">Cancel</a>
                @else 
                <p>Already delivered</p>
                @endif
               </td>
            </tr>
            @endforeach
         </table>
      </div>
      
   </div>   
      
     
      
      @include('home.script');
   </body>
</html>