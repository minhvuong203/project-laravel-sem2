<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Session;
use SebastianBergmann\CodeCoverage\Report\Xml\Totals;
use App\Models\Order;
use App\Models\Slider;

class CartController extends Controller
{
    public function order(Request $request)
    {
        $product_id = $request->product_id;
        $quantity = $request->quantity;
        $product = DB::table('product')->where('product_id', $product_id)->first();
        $data['id'] = $product->product_id;
        $data['qty'] = $quantity;
        $data['name'] = $product->product_name;
        $data['price'] = $product->product_price;
        $data['weight'] = $product->product_price;
        $data['options']['images'] = $product->product_images;
        Cart::add($data);
        Cart::setGlobalTax(10);
        return Redirect("show_cart");
    }

    public function show_cart()
    {
        $slider = Slider::orderBy('slider_id')->get();
        $cate_pro = DB::table('category')->get();
        return view("cart.show_cart")->with('category', $cate_pro)->with('slider',$slider);
    }

    public function delete_cart($rowId)
    {
        Cart::update($rowId, 0);
        return redirect("show_cart");
    }

    public function update_qty(Request $request)
    {
        $rowId = $request->rowId_cart;
        $quantity = $request->quantity;
        Cart::update($rowId, $quantity);
        return redirect("show_cart");
    }

    //checkout order
    public function checkout()
    {
        $slider = Slider::orderBy('slider_id')->get();
        $cate_pro = DB::table('category')->get();
        return view("cart.checkout")->with('category', $cate_pro)->with('slider',$slider);
    }

    public function save_checkout(Request $request)
    {
        $cate_pro = DB::table('category')->get();
        $data = array();
        $data['fullname'] = $request->fullname;
        $data['email'] = $request->email;
        $data['phone'] = $request->phone;
        $data['address'] = $request->address;
        $data['note'] = $request->note;
        $shipping_id = DB::table('shipping')->insertGetId($data);
        $slider = Slider::orderBy('slider_id')->get();
        Session::put('shipping_id', $shipping_id);
        return view('cart.payment')->with('category', $cate_pro)->with('slider',$slider);
    }

    public function payment()
    {
        $cate_pro = DB::table('category')->get();
        return view("cart.payment")->with('category', $cate_pro);
    }

    public function logout_checkout()
    {
        Session::flush();
        return redirect("login");
    }

    public function payment_order(Request $request)
    {
        //get payment_option
        $data = array();
        $data['payment_method'] = $request->payment_option;
        $data['payment_status'] = 'Đang chờ xử lý';
        $payment_id = DB::table('payment')->insertGetId($data);

        //insert order
        $order_data = array();
        $order_data['users_id'] = Session('user')->users_id;
        $order_data['shipping_id'] = Session::get('shipping_id');
        $order_data['payment_id'] =  $payment_id;
        $order_data['order_total'] = Cart::total(0, ',', '.');
        $order_data['order_status'] = 'Đang chờ xử lý';
        $order = DB::table('order')->insertGetId($order_data);


        //insert order details
        $content = Cart::content();
        foreach ($content as $values) {
            $order_d_data = array();
            $order_d_data['order_id'] = $order;
            $order_d_data['product_id'] = $values->id;
            $order_d_data['product_name'] =  $values->name;
            $order_d_data['product_price'] =  $values->price;
            $order_d_data['product_qty'] = $values->qty;
            DB::table('order_details')->insert($order_d_data);
        }
        if ($data['payment_method'] == 1) {
            echo 'Direct Bank Transfer';
        } else {
            Cart::destroy();
            $cate_pro = DB::table('category')->get();
            $slider = Slider::orderBy('slider_id')->get();
            return view('checkout.handcash')->with('category', $cate_pro)->with('slider',$slider);
        }
    }

    //ham manage_order
    public function manage_order()
    {
        // $all_order = DB::table("order")
        //     ->join('shipping', 'order.shipping_id', '=', 'shipping.shipping_id')
        //     ->select('order.*', 'shipping.fullname')
        //     ->get();

        $all_order = Order::all();    
        return view('order.index')->with('all_order', $all_order);
    }

    public function view($order_id)
    {
        $order_byid = Order::where('order_id',$order_id)->get()->first();
        return view('order.view')->with('order_byid', $order_byid);
    }
    // ham xoa category theo id
    public function delete($order_id)
    {
        DB::table('order')->where('order_id', $order_id)->delete();
        return redirect('admin/order/index');
    }

    // public function add_cart_ajax(Request $request)
    // {
    //     $data = $request->all();
    //     $session_id = substr(md5(microtime()), rand(0, 26), 5);
    //     $cart = Session::get('cart');
    //     if ($cart == true) {
    //         $is_avai = 0;
    //         foreach ($cart as $key => $val) {
    //             if ($val["product_id"] == $data['product_id']) {
    //                 $is_avai++;
    //             }
    //         }
    //         if ($is_avai == 0) {
    //             $cate[] = array(
    //                 'session_id' => $session_id,
    //                 'product_name' => $data['cart_product_name'],
    //                 'product_id' => $data['cart_product_id'],
    //                 'product_images' => $data['cart_product_images'],
    //                 'product_qty' => $data['cart_product_qty'],
    //                 'product_price' => $data['cart_product_price'],
    //             );
    //             Session::put('cart', $cart);
    //         }
    //     } else {
    //         $cate[] = array(
    //             'session_id' => $session_id,
    //             'product_name' => $data['cart_product_name'],
    //             'product_id' => $data['cart_product_id'],
    //             'product_images' => $data['cart_product_images'],
    //             'product_qty' => $data['cart_product_qty'],
    //             'product_price' => $data['cart_product_price'],
    //         );
    //     }
    //     Session::put('cart', $cart);
    //     Session::save();
    // }

    // public function cart_ajax()
    // {
    //     $cate_pro = DB::table('category')->get();
    //     return view("cart.cart_ajax")->with('category', $cate_pro);
    // }
}
