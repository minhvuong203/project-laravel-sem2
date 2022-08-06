<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\city;
use App\Models\province;
use App\Models\wards;
use App\Models\Feeship;
class DeliveryController extends Controller
{
    public function delivery(Request $request)
    {

        $city = City::orderby('matp', 'ASC')->get();
        return view('delivery.create')->with(compact('city'));
    }

    public function select_delivery(Request $request)
    {
        $data = $request->all();
        if ($data['action']) {
            $output = '';
            if ($data['action'] == "city") {
                $select_province = province::where('matp', $data['ma_id'])->orderby('maqh', 'ASC')->get();
                $output .= '<option>---Chọn quận huyện---</option>';
                foreach ($select_province as $province) {
                    $output .= '<option value="' . $province->maqh . '">' . $province->name_quanhuyen . '</option>';
                }
            } else {
                $select_wards = wards::where('maqh', $data['ma_id'])->orderby('xaid', 'ASC')->get();
                $output .= '<option>---Chọn xã phường---</option>';
                foreach ($select_wards as $wards) {
                    $output .= '<option value="' . $wards->xaid . '">' . $wards->name_xaphuong . '</option>';
                }               
            }
        }
        echo $output;
    }

    public function insert_delivery(Request $request){
        $data = $request->all();
        $fee_ship = new Feeship();
        $fee_ship->fee_matp = $data['city'];
        $fee_ship->fee_maqh = $data['province'];
        $fee_ship->fee_xaid = $data['wards'];
        $fee_ship->ship = $data['fee_ship'];
        $fee_ship->save();
    }

    // public function select_feeship(){
    //     $fee_ship = Feeship::orderBy('fee_id','DESC')->get();
}
