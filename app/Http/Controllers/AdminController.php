<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Products;
use App\Models\order;
use PDF;
use Notification;
use App\Notifications\chafferNotification;
class AdminController extends Controller
{
    public function view_category(){
        $data = category::all();
        return view('admin.category',compact('data'));
    }
    public function add_category(Request $request){
        $data = new category;

        $data->category_name = $request->category;

        $data->save();
        return redirect()->back()->with('message','Category Added Successfully');
    }

    public function delete_category($id){
        $data = category::find($id);
        $data->delete();
        return redirect()->back()->with('message','Category Deleted Successfully');
    }
    public function view_product(){
        $category = category::all();
        return view('admin.product',compact('category'));
    }
    public function add_product(Request $request){
        $data = new products;

        $data->title = $request->title;
        $data->description = $request->description;
        $data->price = $request->price;
        $data->discount_price = $request->discount_price;
        $data->quantity = $request->quantity;
        $data->category = $request->category;

        $image = $request->image;
        $imagename= time().'.'.$image->getClientOriginalExtension();
        $request->image->move('product',$imagename);

        $data->image = $imagename;

        $data->save();
        return redirect()->back()->with('message','Category Added Successfully');
    }
    public function show_product(){
        $product = products::all();
        return view('admin.show_product',compact('product'));
    }
    public function delete_product($id){
        $data = products::find($id);
        $data->delete();
        return redirect()->back()->with('message','Product Deleted Successfully');
    }

    public function update_product($id)
    {
        $product = products::find($id);
        $category= category::all();
        return view('admin.update_product',compact('product','category'));
    }

    public function update_product_confirm(Request $request,$id)
    {
        $data = products::find($id);

        $data->title = $request->title;
        $data->description = $request->description;
        $data->price = $request->price;
        $data->discount_price = $request->discount_price;
        $data->quantity = $request->quantity;
        $data->category = $request->category;

        $image = $request->image;
        if($image){
        $imagename= time().'.'.$image->getClientOriginalExtension();
        $request->image->move('product',$imagename);
        $data->image = $imagename;
        }
        $data->save();
        $product = products::all();
        return view('admin.show_product',compact('product'))->with('message','Product Updated Successfully');
    }

    public function order()
    {
        $order =order::all();

        return view('admin.order',compact('order'));
    }

    public function delivered($id)
    {
        $order =order::find($id);
        $order->delivery_status="Delivered";
        $order->payment_status="Paid";
        $order->save();

        return redirect()->back()->with('message','Product delivered Successfully');
    }
    public function print_pdf($id)
    {
        $order =order::find($id);
        $pdf =PDF:: loadView('admin.pdf',compact('order'));
        return $pdf->download('order_details.pdf');
        
    }

    public function send_email($id){
        $order =order::find($id);
        return  view('admin.email_info',compact('order'));
    }

    public function send_user_email(Request $request, $id){
        $order= order::find($id);
        $details=[
            'greeting'=>$request->greeting,
            'firstline'=>$request->firstline,
            'body'=>$request->body,
            'button'=>$request->button,
            'url'=>$request->url,
            'lastline'=>$request->lastline,

        ];

        Notification::send($order, new chafferNotification($details));

        return redirect()->back();
    }

    public function search_order(Request $request){
            $search_text= $request->search;
            $order = order::where('name','LIKE',"%$search_text%")->
            orwhere('product_title','LIKE',"%$search_text%")->
            orwhere('email','LIKE',"%$search_text%")->
            orwhere('phone','LIKE',"%$search_text%")->
            orwhere('address','LIKE',"%$search_text%")->
            orwhere('quantity','LIKE',"%$search_text%")->
            orwhere('price','LIKE',"%$search_text%")->get();
            return view('admin.order',compact('order'));
    }
}
