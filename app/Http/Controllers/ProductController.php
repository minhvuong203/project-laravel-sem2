<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Slider;

class ProductController extends Controller
{
    //khoi tao ham 
    public function index()
    {
        //tao mot bien $ds chua cac thong tin trong bang tbproduct
        //dung get de xem het tat ca thong tin
        $ds = DB::table("product")
            ->join('category', 'category.category_id', '=', 'product.category_id')
            ->get();
        //tra ve trang 
        return view("product.index", ["product" => $ds]);
    }
    public function create()
    {
        $cate_pro = DB::table('category')->get();
        return view("product.create")->with('category_product', $cate_pro);
    }
    // khoi tao ham doc du lieu cua form 'tao san pham moi' va luu vo DB
    public function createPost(Request $request)
    {
        //nhan tat ca tham so nhap lieu tu form vao bien mang $product
        $product = $request->all();
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
                return redirect('product/create')->with('Error', 'chi duoc chon file JPEG,PNG,JPG,GIF !');
            }
            if ($file->getSize() > 100000) {
                return redirect('product/create')->with('Error', 'File upload phai nho hon 100k!');
            }
            //doi ten luu hinh anh va luu vao bien $image
            $imagesName = $file->getClientOriginalName();
            //chuyen tu folder tam thoi vao folder images cua wed voi ten $imagesName
            $file->move('images', $imagesName);
        }

        //luu du lieu vao database
        DB::table('product')->insert([
            'category_id' => $product['product_cate'],
            'product_name' => $product['name'],
            'product_price' => $product['price'],
            'product_des' => $product['description'],
            'product_content' => $product['content'],
            'product_images' => $imagesName
        ]);
        return redirect('admin/product/index');
    }

    //open trang thay doi thong tin san pham
    public function update($id)
    {
        $cate_pro = DB::table('category')->get();
        $product = DB::table('product')->where('product_id', $id)->first();
        return view("product.update", ['p' => $product])->with('category_product', $cate_pro);
    }

    //doc thong tin cua form 'thay doi thong tin san pham' va luu vo database
    public function updatePost(Request $request, $id)
    {
        //doc tat ca du lieu nhap trong form, luu vo bien mang product
        $product = $request->all();
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
                return redirect('product/update/' . $id)->with('Error', 'chỉ được chọn file JPEG,PNG,JPG,GIF !');
            }
            if ($file->getSize() > 100000) {
                return redirect('product/update/' . $id)->with('Error', 'File upload phải nhỏ hơn 100k!');
            }
            //doi ten luu hinh anh va luu vao bien $image
            $imagesName = $file->getClientOriginalName();
            //chuyen tu folder tam thoi vao folder images cua wed voi ten $imagesName
            $file->move('images', $imagesName);
        } else {
            //truong hop neu khong cap nhat hinh moi thi tra ve hinh cu
            $imagesName = DB::table('product')->where('product_id', intval($id))->first()->product_images;
        }

        //luu du lieu vao database
        DB::table('product')->where('product_id', intval($id))->update([
            'category_id' => $product['product_cate'],
            'product_name' => $product['name'],
            'product_price' => $product['price'],
            'product_des' => $product['description'],
            'product_content' => $product['content'],
            'product_images' => $imagesName
        ]);
        return redirect('admin/product/index');
    }

    //ham xoa san pham theo id
    public function delete($id)
    {
        DB::table('product')->where('product_id', $id)->delete();
        return redirect('admin/product/index');
    }
    public function view($id)
    {
        $product = DB::table('product')
            ->join('category', 'category.category_id', '=', 'product.category_id')
            ->where('product_id', $id)->first();
        return view("product.view", ['p' => $product]);
    }

    public function search()
    {
        $users = DB::table('product')
            ->join('category', 'category.category_id', '=', 'product.category_id')
            ->get();
        return view('index.search', compact('product'));
    }

    public function searchPost(Request $request)
    {
        if ($request->ajax()) {
            $output = '';
            $product = DB::table('product')->where('product_name', 'LIKE', '%' . $request->search . '%')->get();
            if ($product) {
                foreach ($product as $p) {
                    $image = "images/" . $p->product_images;
                    $m = "admin/product/view/" . $p->product_id;
                    $m1 = "admin/product/update/" . $p->product_id;
                    $m2 = "admin/delete/delete/" . $p->product_id;
                    $output .=
                        '<tr>
                    <td>' . $p->product_id  . '</td>
                    <td>' . $p->category_id . '</td>
                    <td>' . $p->product_name . '</td>
                    <td>' . $p->product_price . '</td>
                    <td>' . '<img width="100px" src="' . url($image) . '" />' . '</td>
                    <td>' .
                        '<a class="btn btn-primary btn-sm" href="' . url($m) . '">
                    <i class="fas fa-folder"></i> Xem
                     </a>' .
                        '<a class="btn btn-info btn-sm" href="' . url($m1) . '">
                    <i class="fas fa-pencil-alt"></i> Sửa
                     </a>' .
                        '<a class="btn btn-danger btn-sm" href="' . url($m2) . '">
                    <i class="fas fa-trash"></i> Xoá
                     </a>'
                        . '</td>
                    </tr>';
                }
            }
            return Response($output);
        }
    }

    //detaisl_product
    public function show_details($product_id)
    {
        $slider = Slider::orderBy('slider_id')->get();
        $cate_pro = DB::table('category')->get();
        $product_details = DB::table('product')->join('category', 'category.category_id', '=', 'product.category_id')->where('product_id', $product_id)->get();
        return view('pages.single')->with('category', $cate_pro)->with('details_product', $product_details)->with('slider',$slider);
    }
}
