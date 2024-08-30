<!DOCTYPE html>
<html>
   <head>
      @include('home.css');
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
      
   </head>
   <body>
      <div class="hero_area">
         
         @include('home.header');

         @include('home.slider');
        
      </div>
     
      @include('home.product');

      <div style="text-align: center; padding-bottom:20px;">
         <h1 style="font-size:30; text-align: center; padding-top:20px; padding-bottom:20px">
            Comments</h1>
            <form action="{{url('add_comment')}}" method="POST">
               @csrf
               <textarea style="height: 150px; width:600px;"placeholder="Comment something here" name="comment"></textarea>
               <br>
              <input type="submit" class="btn btn-primary" value="Comment">
            </form>
      </div>

      <div style="padding-left:20%">
         <h1 style="font-size:20px ; padding-bottom: 20px;">All Comments</h1>
         @foreach($comments as $comment)
         <div>
            <b>{{$comment->name}}</b>
            <p>{{$comment->comment}}</p>
            <a style="color: blue; "href="javascript::void(0);" onclick="reply(this)" data-Commentid="{{$comment->id}}">Reply</a>
            @foreach($reply as $rep)
            @if($rep->comment_id==$comment->id)
                  <div style="padding-left: 3%; padding-bottom: 10px; padding-bottom:10px;">
                  <b>{{$rep->name}}</b>
                  <p>{{$rep->reply}}</p>
                  <a style="color: blue; "href="javascript::void(0);" onclick="reply(this)" data-Commentid="{{$comment->id}}">Reply</a>
                  </div>
            @endif
            @endforeach
         </div>
         @endforeach
         <div style="display: none;" class="replyDiv">
         <form action="{{url('add_reply')}}" method="POST">
         @csrf
          
         <input type="text" id="commentId" name="commentId" hidden="">
         <textarea style="height: 100px; width:500px;" name="reply" placeholder="Reply box"></textarea>
         <br>
           <button type="submit" class="btn btn-warning">Reply</button>
         <a href="javascript::void(0);" class="btn" onclick="reply_close(this)">Close</a>
         </form> 
      </div>
   


      
      </div>
      
     
      @include('home.footer');
      
      
      <script type="text/javascript">
         function reply(caller)
         {
            document.getElementById('commentId').value=$(caller).attr('data-Commentid');
            $('.replyDiv').insertAfter($(caller));
            $('.replyDiv').show();
         }
         function reply_close(caller)
         {
            $('.replyDiv').hide();
         }
      </script>
      @include('home.script');
   </body>
</html>