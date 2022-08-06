<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckLoginMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    //kiem tra Tk dang nhap theo role
    public function handle(Request $request, Closure $next , ...$role){
        //kiem tra neu trong data ton tai user
        if($request->session()->has('user')){
            //khoi tao bien chua lenh thi hanh
            $user = $request->session()->get('user');

            //tao bien chua chua lenh check $User->role 
            //dung bieu thuc tam phan neu $user la 1 thi tra ve admin con k thi tra ve user
            $r= $user->role==1?"admin":"customers";
            //kiem tra trong mang neu co bien $r cung voi $role
            if(in_array($r,$role)){
                //chay tiep chuong trinh
                return $next($request);
            }
        }
        //neu k phai thi tra ve trang login
        return redirect('login');
    }
}
