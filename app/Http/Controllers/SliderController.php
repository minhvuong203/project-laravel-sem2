<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Slider;
use Illuminate\Support\Facades\DB;

class SliderController extends Controller
{
    public function manager_slider()
    {
        $all_slider = Slider::all();
        return view('slider.list_slider')->with(compact('all_slider'));
    }

    public function create()
    {
        return view('slider.create');
    }

    public function create_slider(Request $request)
    {
        $slider = $request->all();
        //nhan tat ca tham so nhap lieu tu form vao bien mang $product
        $imagesName = null;
        //kiem tra trong cac phan tu du lieu nhap vao, co phan tu kieu 'file' ten la 'fileImage' khong?
        //dung ham hasFile de kiem tra
        if ($request->hasFile('fileImage')) {
            //lay doi tuong file ra gan vao bien $file
            $file = $request->file('fileImage');
            //lay ten mo rong cua file
            $extention = strtolower($file->getClientOriginalExtension());
            if ($extention != 'png' && $extention != 'jpg' && $extention != 'jpeg' && $extention != 'gif') {
                //neu extention k phai cac thong so tren thi tra ve trang
                return redirect('admin/slider/create')->with('Error', 'chi duoc chon file JPEG,PNG,JPG,GIF !');
            }
            if ($file->getSize() > 10000000) {
                return redirect('admin/slider/create')->with('Error', 'File upload phai nho hon 100000k!');
            }
            //doi ten luu hinh anh va luu vao bien $image
            $imagesName = $file->getClientOriginalName();
            //chuyen tu folder tam thoi vao folder images cua wed voi ten $imagesName
            $file->move('images', $imagesName);
        }

        //luu du lieu vao database
        DB::table('slider')->insert([
            'slider_name' => $slider['name'],
            'slider_des' => $slider['description'],
            'slider_images' => $imagesName
        ]);
        return redirect('admin/manager_slider');
    }

    public function delete($id)
    {
        DB::table('slider')->where('slider_id', $id)->delete();
        return redirect('admin/manager_slider');
    }
}
