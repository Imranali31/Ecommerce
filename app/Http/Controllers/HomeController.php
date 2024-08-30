<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Products;
use App\Models\Cart;
use App\Models\order;
use App\Models\Comment;
use App\Models\Reply;

use Session;
use Stripe;

class HomeController extends Controller
{
    public function index(){
        $product= Products::paginate(15);
        $comments = Comment::orderby('id','desc')->get();
        $reply = Reply::all();
        return view('home.userpage', compact('product','comments','reply'));
    }
    public function redirect(){
        $usertype = Auth::user()->usertype;

        if($usertype =='1'){
            $total_product =Products::all()->count();
            $total_order =order::all()->count();
            $total_user =user::all()->count();
            $order = order::all();
            $total_revenue=0;
            foreach($order as $order){
                $total_revenue +=$order->price;
            }
            $total_delivered = order::where('delivery_status','=','Delivered')->get()->count();
            $total_processing= order::where('delivery_status','=','Processing')->get()->count();
            return view('admin.home',compact('total_processing','total_product','total_delivered','total_order','total_user','total_revenue'));
        }
        else 
        {
            $product = Products::paginate(15);
            $comments = Comment::orderby('id','desc')->get();
            $reply = Reply::all();
        return view('home.userpage', compact('product','comments','reply'));
        }
    }
    public function product_details($id){
        $products= Products::find($id);
        return view('home.product_details',compact('products'));
    }
    public function all_products(){
        $product= Products::paginate(100);
        return view('home.all_products',compact('product'));
    }
    public function add_cart(Request $request, $id){
        if(Auth::id()){
            $user = Auth::user();
            $product =Products::find($id);
            $cart= new Cart;

            $cart->name= $user->name;
            $cart->email= $user->email;
            $cart->phone= $user->phone;
            $cart->address= $user->address;
            $cart->user_id= $user->id;
            
            $cart->product_title= $product->title;
            if($product->discount_price){
                $cart->price= $product->discount_price * $request->quantity;
            }
            else{
                $cart->price= $product->price *$request->quantity;
            }
            
            $cart->image= $product->image;
            $cart->product_id= $product->id;
            $cart->quantity= $request->quantity;

            $cart->save();
            return redirect()->back();


        }
        else{
            return redirect('login');
        }
    }

    public function show_cart(){
        if(Auth::id()){
            $id = Auth::user()->id;
            $cart= Cart::where('user_id','=',$id)->get();
            return view('home.show_cart',compact('cart'));
        }

        else{
            return redirect('login');
        }
    }

    public function remove_cart($id){
        $cart = Cart::find($id);
        $cart->delete();
        return redirect()->back();
    }
    public function cash_order(){
        $id =Auth::user()->id;
        $cart= Cart::where('user_id','=',$id)->get();
        foreach($cart as $data){
            $order = new order;
            $order->name = $data->name;
            $order->email = $data->email;
            $order->phone = $data->phone;
            $order->address = $data->address;
            $order->user_id = $data->user_id;
            $order->product_title = $data->product_title;
            $order->product_id = $data->product_id;
            $order->quantity = $data->quantity;
            $order->price = $data->price;
            $order->image = $data->image;

            $order->payment_status = 'cash on delivery';
            $order->delivery_status = 'Processing';

            $order->save();

            $cart_id = $data->id;
            $cart= Cart::find($cart_id);

            $cart->delete();
        }
        return redirect()->back()->with('message','We have received your order. We will connect with you soon..');;
    }


    public function stripe($totalPrice){
        return view('home.stripe',compact('totalPrice'));
    }

    public function stripePost(Request $request, $totalPrice){
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
                Stripe\Charge::create ([
                "amount" => $totalPrice * 100,
                "currency" => "usd",
                "source" => $request->stripeToken,
                "description" => "Thanks for payment" 
        ]);
        $id =Auth::user()->id;
        $cart= Cart::where('user_id','=',$id)->get();
        foreach($cart as $data){
            $order = new order;
            $order->name = $data->name;
            $order->email = $data->email;
            $order->phone = $data->phone;
            $order->address = $data->address;
            $order->user_id = $data->user_id;
            $order->product_title = $data->product_title;
            $order->product_id = $data->product_id;
            $order->quantity = $data->quantity;
            $order->price = $data->price;
            $order->image = $data->image;

            $order->payment_status = 'Paid';
            $order->delivery_status = 'Processing';

            $order->save();

            $cart_id = $data->id;
            $cart= Cart::find($cart_id);

            $cart->delete();
        }
        Session::flash('success', 'Payment successful!');            

        return back();
    }

    public function show_order(){
        if(Auth::id()){
            $id = Auth::user()->id;
            $order= order::where('user_id','=',$id)->get();
            return view('home.order',compact('order'));
        }
        else return redirect('login');
    }

    public function cancel_order($id){
        $order = order::find($id);

        $order->delivery_status ='You cancel this order';
        $order->save();
        return redirect()->back();


    }
    public function add_comment(Request $request){
        if(Auth::id()){

            $comment= new Comment;
            $comment->user_id= Auth::user()->id;
            $comment->name= Auth::user()->name;
            $comment->comment= $request->comment;
            $comment->save();
            
            return  redirect()->back();
        }
        else return redirect('login');
    }
    public function add_reply(Request $request){
        if(Auth::id()){

            $reply= new Reply;
            $reply->user_id= Auth::user()->id;
            $reply->name= Auth::user()->name;
            $reply->reply= $request->reply;
            $reply->comment_id= $request->commentId;
            $reply->save();
            
            return  redirect()->back();
        }
        else return redirect('login');
    }

    

}
