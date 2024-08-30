<!DOCTYPE html>
<html>
   <head>
      @include('home.css');
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
      
   </head>
   <body>
      <div class="hero_area">
         
         @include('home.header');
     
      @include('home.product');
     
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