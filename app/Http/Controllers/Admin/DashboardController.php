<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Auth;
use Validator;
use DB;
use App\Models\User;
use App\Models\Vendor;
use App\Models\Lokasi;
use App\Models\Span;
use App\Models\Sensor;

class DashboardController extends Controller
{
    public function index()
    {
        $id = Auth::user()->id;
        $getUser = User::where('id', $id)->first();
        if($getUser->role == 'Admin Vendor' || $getUser->role == 'User'){
            return redirect('/404');
        }else{
            return view('dashboard.index');
        }
    }

    public function listLokasi()
    {
        $getLokasi = DB::table('lokasi')->select('lokasi.*', 'vendor.nama_vendor','vendor.foto as foto_vendor','vendor.slug as slug_vendor')->join('vendor','vendor.id','=','lokasi.id_vendor')->where('lokasi.isDeleted',0)->where('vendor.isDeleted',0)->get();
        $data = array();
        foreach ($getLokasi as $key) {
            if ($key->foto != "" || $key->foto != NULL) {
                $image = $key->foto;
            }else {
                $image = 'default.jpg';
            }
            $status = "green";
            $countSpan = 0;
            $getSpan = DB::table('span')->where('id_lokasi',$key->id)->where('isDeleted',0)->orderBy('id', 'ASC')->get();
            $to_date = date('Y-m-d H:i:s');
            $from_date = date('Y-m-d H:i:s', strtotime('-3 second'));
            $goodSpan = 0;
            $warningSpan = 0;
            $criticalSpan = 0;
            $offlineSpan = 0; 
            foreach ($getSpan as $keys) {
                $countSensor = Sensor::where('id_span',$keys->id)->where('isDeleted',0)->count();
                $good = 0;
                $warning = 0;
                $critical = 0;
                $offline = 0; 
                if($countSensor > 0){
                    $getSensor = Sensor::where('id_span',$keys->id)->where('isDeleted',0)->get();
                    foreach($getSensor as $gs){
                        $batas_atas = $gs->batas_atas;
                        $batas_bawah = $gs->batas_bawah;
                        $getValue = DB::table('log_data')->where('id_sensor',$gs->id)->whereBetween(\DB::raw('time'), [$from_date, $to_date])->orderBy('id','DESC')->limit(1)->count();
                        if($getValue > 0){
                            $gV = DB::table('log_data')->where('id_sensor',$gs->id)->whereBetween(\DB::raw('DATE(time)'), [$from_date, $to_date])->orderBy('id','DESC')->limit(1)->first();
                            $value = $gV->value;
                            if($value == 0 || $value == NULL){
                                $offline++;
                            }elseif($value < $batas_bawah){
                                $good++;
                            }elseif($value > $batas_bawah && $value < $batas_atas){
                                $warning++;
                            }elseif($value > $batas_atas){
                                $critical++;
                            }else{
                                $offline++;
                            }
                        }else{
                            $offline++;
                        }
                       
                    }
                    $rules = $countSensor / 2;  

                    if($offline > 0){
                        $status = "black-pin";
                    }elseif($critical > 0 || $warning >= $rules){
                        $status = "red-pin";
                    }elseif($warning > 0){
                        $status = "yellow-pin";
                    }elseif($good == $countSensor){
                        $status = "green-pin";
                    }
                }else{
                    $status = "black-pin";
                }
                
                if($status == "red-pin"){
                    $criticalSpan++;
                }elseif($status == "orange-pin"){
                    $warningSpan++;
                }elseif($status == "green-pin"){
                    $goodSpan++;
                }elseif($status == "black-pin"){
                    $offlineSpan++;
                }
                $countSpan++;
            }
            $rulesSpan = $countSpan/2;
            if($countSpan > 0){
                if($offlineSpan > 0){
                    $statusSpan = "black";
                }elseif($criticalSpan > 0 || $warningSpan >= $rulesSpan){
                    $statusSpan = "red";
                }elseif($warningSpan > 0){
                    $statusSpan = "yellow";
                }elseif($goodSpan == $countSpan){
                    $statusSpan = "green";
                }
            }else{
                $statusSpan = "black";
            }
            

            $data[] = [
                'id' => $key->id,
                'nama_vendor' => $key->nama_vendor,
                'slug_vendor' => $key->slug_vendor,
                'image' => $image,
                'nama_lokasi' => $key->nama_lokasi,
                'slug' => $key->slug,
                'long' => $key->long,
                'lat' => $key->lat,
                'status' => $statusSpan,
                'created_at' => date('D,j M Y',strtotime($key->created_at))];
            
        }
        return response()->json(['items' => $data]);
    }
}
