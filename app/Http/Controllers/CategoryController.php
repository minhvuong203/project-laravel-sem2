<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Slider;

class CategoryController extends Controller
{
    //khoi tao ham 
    public function index()
    {
        //tao mot bien $ds chua cac thong tin trong bang category
        //dung get de xem het tat ca thong tin
        $ds = DB::table("category")->get();
        //tra ve trang 
        return view("category.index", ["category" => $ds]);
    }
    public function create()
    {
        $cate_pro = DB::table('category')->get();
        return view("category.create")->with('category_id', $cate_pro);
    }
    // khoi tao ham doc du lieu cua form 'tao san pham moi' va luu vo DB
    public function createCategory(Request $request)
    {
        //nhan tat ca tham so nhap lieu tu form vao bien mang $category 
        $category = $request->all();
        //kiem tra trong cac phan tu du lieu nhap vao, co phan tu kieu 'file' ten la 'fileImage' khong?
        //dung ham hasFile de kiem tra

        //luu du lieu vao database
        DB::table('category')->insert([
            'category_name' => $category['name'],
        ]);
        return redirect('admin/category/index');
    }

    //open trang thay doi thong tin san pham
    public function update($id)
    {
        $category  = DB::table('category')->where('category_id', $id)->first();
        return view("category.update", ['p' => $category]);
    }

    // doc thong tin cua form 'thay doi thong tin san pham' va luu vo database
    public function updatePost(Request $request, $id)
    {
        //doc tat ca du lieu nhap trong form, luu vo bien mang category 
        $category  = $request->all();
        //luu du lieu vao database
        DB::table('category')->where('category_id', intval($id))->update([
            'category_name' => $category['name'],
        ]);
        return redirect('admin/category/index');
    }

    // ham xoa category theo id
    public function delete($category_id)
    {
        DB::table('category')->where('category_id', $category_id)->delete();
        return redirect('admin/category/index');
    }

    //ham xem category
    public function view($id)
    {
        $caterogy = DB::table('category')->where('category_id', $id)->first();
        return view("category.view", ['p' => $caterogy]);
    }

    //ham show_category
    public function show_category($category_id){
        $slider = Slider::orderBy('slider_id')->get();
        $cate_pro = DB::table('category')->get();
        $category_show= DB::table('product')->join('category','category.category_id','=','product.category_id')->where('product.category_id',$category_id)->get();
        return view('pages.show_category')->with('category',$cate_pro)->with('show_category',$category_show)->with('slider',$slider);
    }
}
