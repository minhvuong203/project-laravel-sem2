<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use App\Models\Social; //sử dụng model Social
use App\Models\Login;
use Illuminate\Console\View\Components\Alert;
use Laravel\Socialite\Facades\Socialite;

class AccountController extends Controller
{
    public function login()
    {
        return view('login');
    }
    //mot session co cau truc nhu 1 map gom co 2 cot: key va value 
    public function checkLogin(Request $request)
    {
        //kiem tra da tao 1 bien session user nao chua bang has 
        //neu co thi xoa thong tin do di bang forget
        if ($request->session()->has('user')) {
            $request->session()->forget('user');
        }

        $email = $request->email;
        $password = $request->password;

        // dd($email . "," . $pwd);
        //tao bien chua sql
        $user = Login::where('email', $email)->first();
        // tao bien session de luu thong tin TK dang nhap thanh cong
        session::put('user', $user);
        session::put('fullname', $user);
        session::put('users_id', $user);
        //kiem tra thong tin trong bien $user
        if ($user != null && $user->password == $password) {
            // kiem tra role trong $user
            if ($user->role == 1) {
                //users bat tu ben route
                return redirect('admin/users');
            } else {
                return redirect("home/index");
            }
        } else {
            //neu dang nhap sai thi se tra ve trang login bang redirect voi thong bao Login Fail
            return redirect('login')->with('message', 'Email or Password is incorrect');
        }
    }
    //Tao ham de goi bien users
    public function users()
    {
        //lay het du lieu trong bang dung get()
        //lay co dieu kien them where 
        $users = DB::table('users')->get();
        return view('admin.user')->with(['users' => $users]);
    }

    //khoi tao ham de the hien trang addUser
    public function displayAddUser()
    {
        return view('admin.addUser');
    }
    
    //khoi tao ham addUser them thong tin thanh vien
    public function addUser(Request $request)
    {
        $user = DB::table('users')->where('email', 'LIKE', $request->email)->first();
        // $accountId = $request->accountId;
        $fullname = $request->fullname;
        $email = $request->email;
        $phone = $request->phone;
        $password = $request->password;
        $pwd = $request->pwd;
        $gender = $request->gender;
        $address = $request->address;
        $role = $request->role;
        if ($user) {
            return redirect('admin/displayAddUser')->with('Error', 'Vui lòng đặt email khác!');
        } else {
            DB::table('users')->insertGetId([
                // 'accountId'=>intval($accountId),
                'fullname' => $fullname,
                'email' => $email,
                'phone' => $phone,
                'password' => $password,
                'password_confirm' => $pwd,
                'gender' => intval($gender),
                'address' => $address,
                'role' => intval($role),
            ]);
            return redirect('admin/users');
        }
        // DB::table('users')->insertGetId([
        //     // 'accountId'=>intval($accountId),
        //     'fullname' => $fullname,
        //     'email' => $email,
        //     'phone' => $phone,
        //     'password' => $password,
        //     'password_confirm' => $pwd,
        //     'gender' => intval($gender),
        //     'address' => $address,
        //     // dung intval de check dieu kien neu ng dung k nhap dung gia tri
        //     'role' => intval($role),
        // ]);

    }

    //ham xem chi tiet users
    public function view($id)
    {
        $ds = DB::table('users')->where('users_id', $id)->first();
        return view("admin.view", ['ds' => $ds]);
    }
    //khoi tao ham lap trinh cho chuc nang logout
    public function logout()
    {
        session()->forget("user");
        return redirect("login");
    }
    //ham xoa nhan vien
    public function delete($id)
    {
        DB::table('users')->where('users_id', $id)->delete();
        return redirect('admin/users');
    }

    //ham update users
    public function update($id)
    {
        $product = DB::table('users')->where('users_id', $id)->first();
        return view("admin.update", ['ds' => $product]);
    }

    //doc thong tin cua form 'thay doi thong tin san pham' va luu vo database
    public function updatePost(Request $request, $id)
    {
        //doc tat ca du lieu nhap trong form, luu vo bien mang product
        $product = $request->all();
        //luu du lieu vao database
        DB::table('users')->where('users_id', intval($id))->update([
            'fullname' => $product['fullname'],
            'email' => $product['email'],
            'phone' => $product['phone'],
            'password' => $product['password'],
            'password_confirm' => $product['pwd'],
            'gender' => $product['gender'],
            'address' => $product['address'],
            'role' => $product['role'],
        ]);
        return redirect('admin/users');
    }

    public function displayaddCustomer()
    {
        return view('customer.addCustomers');
    }

    public function addCustomers(Request $request)
    {
        $user = DB::table('users')->where('email', 'LIKE', $request->email)->first();
        $fullname = $request->fullname;
        $email = $request->email;
        $phone = $request->phone;
        $password = $request->password;
        $pwd = $request->pwd;
        $gender = $request->gender;
        $address = $request->address;
        if ($user) {
            return redirect('addCustomer')->with('Error', 'Vui lòng đặt email khác!');
        } else {
            $users_id = DB::table('users')->insertGetId([
                // 'accountId'=>intval($accountId),
                'fullname' => $fullname,
                'email' => $email,
                'phone' => $phone,
                'password' => $password,
                'password_confirm' => $pwd,
                'gender' => intval($gender),
                'address' => $address,

            ]);
            Session::put('user_id', $users_id);
            return redirect('login');
        }
    }

    //ham tim kiem bang ajax
    public function search()
    {
        $users = DB::table('users')->get();
        return view('user.search', compact('users'));
    }

    public function searchPost(Request $request)
    {
        if ($request->ajax()) {
            $output = '';
            $product = DB::table('users')->where('fullname', 'LIKE', '%' . $request->search . '%')->get();
            if ($product) {
                foreach ($product as $p) {
                    $v = "admin/view/" . $p->users_id;
                    $v1 = "admin/update/" . $p->users_id;
                    $v2 = "admin/delete/" . $p->users_id;
                    $output .=
                        '<tr>
                    <td>' . $p->users_id . '</td>
                    <td>' . $p->fullname . '</td>
                    <td>' . $p->email . '</td>
                    <td>' . $p->phone . '</td>
                    <td>' . $p->password . '</td>
                    <td>' . ($p->role == 1 ? 'Admin' : 'Customers') . '</td>
                    <td>' .
                        '<a class="btn btn-primary btn-sm" href="' . url($v) . '"><i class="fas fa-folder"></i> View </a>' .
                        '<a class="btn btn-info btn-sm" href="' . url($v1) . '"><i class="fas fa-pencil-alt"></i> 
                        Edit </a>' .
                        '<a class="btn btn-danger btn-sm" href="' . url($v2) . '"><i class="fas fa-trash"></i> 
                        Delete </a>'
                        . '</td>
                        </tr>';
                }
            }
            return Response($output);
        }
    }

    //ham check gia tri da ton tai bang ajax
    public function test()
    {
        $test = DB::table('users')->get();
        return view('addUser.test', compact('users'));
    }

    public function testEmail(Request $request)
    {
        if ($request->ajax()) {
            $output = '';
            $user = DB::table('users')->where('email', 'LIKE', $request->email)->first();
            if ($user) {
                $output = "Email đã tồn tại!";
            } else {
                $output = "";
            }
            return Response($output);
        }
    }

    //ham login facebook
    public function login_facebook()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function callback_facebook()
    {
        $provider = Socialite::driver('facebook')->user();
        // dd($provider);
        $account = Social::where('provider', 'facebook')->where('provider_id', $provider->getId())->get();
        // dd($account);
        if ($account) {
            //login in vao trang quan tri
            $account_name = Login::where('users_id', $account->users)->first();
            // dd($account_name);
            Session::put('fullname', $account_name->fullname);
            Session::put('users_id', $account_name->users_id);
            return redirect('/admin/users')->with('message', 'Đăng nhập Admin thành công');
        } else {

            $admin_login = new Social([
                'provider_id' => $provider->getId(),
                'provider' => 'facebook'
            ]);
            // dd($admin_login);
            $orang = Login::where('email', $provider->getEmail())->first();
            // dd($orang);
            if (!$orang) {
                $orang = Login::create([

                    'fullname' => $provider->getName(),
                    'email' => $provider->getEmail(),
                    'password' => '',
                    'password_confirm' => '',
                    'phone' => '',
                    'gender' => '',
                    'address' => '',
                    'role' => '',

                ]);
            }
            $admin_login->login()->associate($orang);
            $admin_login->save();

            $account_name = Login::where('users_id', $admin_login->users)->first();

            Session::put('fullname', $admin_login->fullname);
            Session::put('users_id', $admin_login->users_id);
            return redirect('/admin/users')->with('message', 'Đăng nhập Admin thành công');
        }
    }
}
