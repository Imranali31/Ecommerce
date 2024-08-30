<html lang="en">
  <head>
    <!-- Required meta tags -->
    <base href="{{ asset('') }}">
    @include('admin.css');
    <style>
    .h2_font{
            margin: auto;
            font-size:25px;
            text-align: center;
            padding: 30px;
            
        }
    label{
        display: inline-block;
        width:200px;
        font-size: 20px;
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
            <h1 class="h2_font">Send email to : {{$order->email}}</h1>
        <form action="{{url('send_user_email',$order->id)}}" method="POST">
            @csrf
            <div style="padding-left: 35%;padding-top: 25px;">
                <label>Email Greeting</label>
                <input style="color: black"type="text" name="greeting">
            </div>

            <div style="padding-left: 35%;padding-top: 25px;">
                <label>Email First line</label>
                <input style="color: black"type="text" name="firstline">
            </div>

            <div style="padding-left: 35%;padding-top: 25px;">
                <label>Email Body</label>
                <input style="color: black"type="text" name="body">
            </div>

            <div style="padding-left: 35%;padding-top: 25px;">
                <label>Email Button name:</label>
                <input style="color: black" type="text" name="button">
            </div>

            <div style="padding-left: 35%;padding-top: 25px;">
                <label>Email Url</label>
                <input style="color: black" type="text" name="url">
            </div>

            <div style="padding-left: 35%;padding-top: 25px;">
                <label>Email last line</label>
                <input style="color: black" type="text" name="lastline">
            </div>
            <div style="padding-left: 35%;padding-top: 25px;">
                <input type="submit" value="Send Email" class="btn btn-primary">
            </div>
        </form>
        </div>
      </div>
      
      </div>
    @include('admin.script');

  </body>
</html>