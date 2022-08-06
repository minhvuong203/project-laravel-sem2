<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Slider;

class HomeController extends Controller
{
    public function index(){
        $slider = Slider::orderBy('slider_id')->get();
        $cate_pro = DB::table('category')->get();
        $all_product = DB::table('product')->get();
        return view("pages.home")->with('category',$cate_pro)->with('all_product',$all_product)->with('slider',$slider);
    }

    public function search(REQUEST $request){
        $slider = Slider::orderBy('slider_id')->get();
        $cate_pro = DB::table('category')->get();
        $search_product= DB::table('product')->where('product_name', 'LIKE', '%' . $request->search . '%')->get();
        return view("pages.search")->with('category', $cate_pro)->with('search_product', $search_product)->with('slider',$slider);
    }

    public function contact(){
        $slider = Slider::orderBy('slider_id')->get();
        $cate_pro = DB::table('category')->get();
        return view('contact.contact')->with('category',$cate_pro)->with('slider',$slider);
    }
}
