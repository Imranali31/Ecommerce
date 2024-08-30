<html lang="en">
  <head>
    <!-- Required meta tags -->
    @include('admin.css');
    <style>
    .h2_font{
            margin: auto;
            width: 50%;
            text-align: center;
            
            
        }
    .center{
            margin: auto;
            width: 100%;
            text-align: center;
            padding: 30px;
         }
         table,th,td
         {
            border: 1px solid gray;

         }
         .th_design{
            font-size: 20px;
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
    <div class="container-scroller">

      @include('admin.sidebar');
    
      @include('admin.header');
      <div class="main-panel">
        <div class="content-wrapper">
        @if(session()->has('message'))
              <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">X</button>
                  {{session()->get('message')}}
              </div>
          @endif
        <h2 class= "h2_font" ><p style="font-size: 40px; font-style: bold">All Orders</p></h2>
        <form action="{{url('search_order')}}" method="POST" >
          @csrf
          <input type="text" style="color: black" name="search" placeholder="Search for something">
          <input type="submit" class="btn btn-outline-primary" value="Search">
        </form>
        <table class="center">
                <tr>
                    <th class="th_design">Name</th>
                    <th class="th_design">Email</th>
                    <th class="th_design">Phone</th>
                    <th class="th_design">Address</th>
                    <th class="th_design">Product_title</th>
                    <th class="th_design">Quantity</th>
                    <th class="th_design">Price</th>
                    <th class="th_design">Payment Status</th>
                    <th class="th_design">Delivery Status</th>
                    <th class="th_design">Image</th>
                    <th class="th_design">Delivered</th>
                    <th class="th_design">Print PDF</th>
                    <th class="th_design">Send Email</th>
                </tr>
            @forelse($order as $order)
                <tr>
               <td>{{$order->name}}</td>
               <td>{{$order->email}}</td>
               <td>{{$order->phone}}</td>
               <td>{{$order->address}}</td>
               <td>{{$order->product_title}}</td>
               <td>{{$order->quantity}}</td>
               <td>{{$order->price}}</td>
               <td>{{$order->payment_status}}</td>
               <td>{{$order->delivery_status}}</td>
               
               <td>
                  <img class="img_size" src="product/{{$order->image}}">
               </td>
               <td>
                @if($order->delivery_status =='Processing')
                    
                <a href="{{url('delivered',$order->id)}}" class="btn btn-danger" onclick="return confirm('Are you sure to delivery product')">Delivery</a>
                @else 
                    <p style="color: green;">Delivered</p>
                @endif
               </td>
               <td>
                <a href="{{url('print_pdf',$order->id)}}" class="btn btn-secondary"> Print pdf</a>
               </td>

               </td>
               <td>
                <a href="{{url('send_email',$order->id)}}" class="btn btn-info">Send Email</a>
               </td>
               
            </tr>
            @empty
            <tr>
              <td colspan="16">No data found</td>
            </tr>
            @endforelse
                    
                    
            </table>

        </div>
      </div>
      
      </div>
    @include('admin.script');

  </body>
</html>