<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Validator;
use DB;
use App\Models\User;
use App\Models\Vendor;
use App\Models\Parameter;
use App\Models\Sensor;
use App\Models\Lokasi;
use App\Models\Span;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class VendorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
   
    public function index()
    {
        $id = Auth::user()->id;
        $getUser = User::where('id', $id)->first();
        if($getUser->role == 'Admin Vendor' || $getUser->role == 'User'){
            return redirect('/404');
        }else{
            return view('vendor.index');
        }
        
    }

    public function listVendor()
    {
        //$infoUser = DB::table('users')->where('id', Auth::user()->id)->first();
        $getVendor = DB::table('vendor')->where('isDeleted',0)->get();
        $data = array();
        foreach ($getVendor as $key) {
            if ($key->foto != "" || $key->foto != NULL) {
                $image = $key->foto;
            }else {
                $image = 'default.jpeg';
            }
            $data[] = ['id' => $key->id,'image' => $image,'nama_vendor' => $key->nama_vendor,'slug' => $key->slug,'created_at' => date('D,j M Y',strtotime($key->created_at))];
            
        }
        return response()->json(['items' => $data]);
    }

    public function listLokasi($id)
    {
        
        $getVendor = Vendor::where('slug',$id)->where('isDeleted',0)->first();
        $getLokasi = DB::table('lokasi')->where('id_vendor',$getVendor->id)->where('isDeleted',0)
        ->get();
        $data = array();
        foreach ($getLokasi as $key) {
            if ($key->foto != "" || $key->foto != NULL) {
                $image = $key->foto;
            }else {
                $image = 'default.jpg';
            }
            $data[] = [
                'id' => $key->id,
                'image' => $image,
                'nama_lokasi' => $key->nama_lokasi,
                'slug' => $key->slug,
                'long' => $key->long,
                'lat' => $key->lat,
                'created_at' => date('D,j M Y',strtotime($key->created_at))];
        }
        return response()->json(['items' => $data]);
    }

    public function listSpan($id)
    {
        $getLokasi = DB::table('lokasi')->where('slug',$id)->where('isDeleted',0)->first();
        $getSpan = DB::table('span')->where('id_lokasi',$getLokasi->id)->where('isDeleted',0)->orderBy('id', 'ASC')
        ->get();
        $data = array();
        $no = 1;
        $to_date = date('Y-m-d H:i:s');
        $from_date = date('Y-m-d H:i:s', strtotime('-3 second'));

        foreach ($getSpan as $key) {
            $countSensor = Sensor::where('id_span',$key->id)->where('isDeleted',0)->count();
            $good = 0;
            $warning = 0;
            $critical = 0;
            $offline = 0; 
            if($countSensor > 0){
                $getSensor = Sensor::where('id_span',$key->id)->where('isDeleted',0)->get();
                foreach($getSensor as $gs){
                    $batas_atas = $gs->batas_atas;
                    $batas_bawah = $gs->batas_bawah;
                    $getValue = DB::table('log_data')->where('id_sensor',$gs->id)->whereBetween(\DB::raw('time'), [$from_date, $to_date])->orderBy('id','DESC')->limit(1)->count();
                    if($getValue > 0){
                        $getValue = DB::table('log_data')->where('id_sensor',$gs->id)->whereBetween(\DB::raw('DATE(time)'), [$from_date, $to_date])->orderBy('id','DESC')->limit(1)->get();
                        foreach($getValue as $gV){
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
            $data[] = [
                'id' => $key->id,
                'no' => $no,
                'nama_span' => $key->nama_span,
                'foto' => $key->foto,
                'y' => $key->y_position,
                'x' => $key->x_position,
                'status' => $status];
            $no++;
        }
        return response()->json(['items' => $data]);
    }

    public function listSensor($id)
    {
        $getSensor = DB::table('sensor')->where('id_span',$id)->where('isDeleted',0)->get();
        $data = array();
        foreach ($getSensor as $key) {
            $getParameter = DB::table('parameter')->where('id',$key->id_parameter)->first();
            $data[] = [
                'id' => $key->id,
                'nama_sensor' => $getParameter->nama_parameter,
                'sensor_id' => $key->nama_sensor,
                'batas_bawah' => $key->batas_bawah,
                'batas_atas' => $key->batas_atas,
                'satuan' => $key->satuan];
        }
        return response()->json(['items' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $preSlug = $request->input('nama_vendor');
        $slug = Str::slug($preSlug, '-');
        
        $vendor = new Vendor;
        $vendor->nama_vendor = $request->input('nama_vendor');
        $vendor->slug = $slug;
        
        if($request->hasFile('image')){
            $validation = Validator::make($request->all(), [
                'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:20000'
            ]);
            if($validation->passes()) {
                $image = $request->file('image');
                $new_name = date('Ymd') . time() . '_'.$image->getClientOriginalName(). '.' . $image->getClientOriginalExtension();
                $image->move(public_path('assets/img/vendor'), $new_name);
                $vendor->foto = $new_name;
            }
        }
        if($vendor->save()){
            return response()->json(['success'=>'Vendor Berhasil Disimpan.']);
        }else {
            return response()->json(['error'=>'Vendor Gagal Disimpan.']);
        }
    }

    public function insertLokasi(Request $request)
    {
        $preSlug = $request->input('nama_lokasi');
        $slug = Str::slug($preSlug, '-');

        $lokasi = new Lokasi;
        $lokasi->nama_lokasi = $request->input('nama_lokasi');
        $lokasi->id_vendor = $request->input('id_vendor');
        $lokasi->long = $request->input('longitude');
        $lokasi->lat = $request->input('latitude');
        $lokasi->slug = $slug;
        
        if($request->hasFile('image')){
            $validation = Validator::make($request->all(), [
                'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:20000'
            ]);
            if($validation->passes()) {
                $image = $request->file('image');
                $new_name = date('Ymd') . time() . '_'.$image->getClientOriginalName(). '.' . $image->getClientOriginalExtension();
                $image->move(public_path('assets/img/lokasi'), $new_name);
                $lokasi->foto = $new_name;
            }
        }
        if($lokasi->save()){
            /*$lokasiId = $lokasi->id;
            $spanCount = $request->input('span');
            if($spanCount != "" && $spanCount > 0){
                for($i=1;$i<=$spanCount;$i++){
                    $nama_span = 'Span '.$i.'';
                    $span = new Span;
                    $span->nama_span = $nama_span;
                    $span->id_lokasi = $lokasiId;
                    $span->save(); 
                }
            }*/
            
            return response()->json(['success'=>'Data Berhasil Disimpan.']);
        }else{
            return response()->json(['error'=>'Data Gagal Disimpan.']);
        }
    }

    public function insertSpan(Request $request)
    {       
        $span = new Span;
        $span->nama_span = $request->input('nama_span');
        $span->stationId = $request->input('station_id');
        $span->id_lokasi = $request->input('id_lokasi');
        if($span->save()){ 
            return response()->json(['success'=>'Span Berhasil Ditambah.']);
        }else{
            return response()->json(['error'=>'Span Gagal Ditambah.']);
        }
    }
    public function insertSensor(Request $request)
    {
        $id_sensor = $request->input('id_sensor');
        $getParameter = Parameter::where('id',$id_sensor)->where('isDeleted',0)->first();
        $namaSensor = $request->input('nama_sensor');
        $checkId = Sensor::join('span','span.id','=','sensor.id_span')->join('lokasi','lokasi.id','=','span.id_lokasi')->join('vendor','vendor.id','=','lokasi.id_vendor')->where('nama_sensor', $namaSensor)->where('sensor.isDeleted',0)->where('vendor.isDeleted',0)->count();
        if($checkId == 0){
            $sensor = new Sensor;
            $sensor->id_span = $request->input('id_span');
            $sensor->nama_sensor = $namaSensor;
            $sensor->id_parameter = $getParameter->id;
            $sensor->satuan = $getParameter->satuan;
            $sensor->batas_bawah = $getParameter->batas_bawah;
            $sensor->batas_atas = $getParameter->batas_atas;    
            if($sensor->save()){ 
                return response()->json(['success'=>'Sensor Berhasil Ditambah.']);
            }else{
                return response()->json(['error'=>'Sensor Gagal Ditambah.']);
            }
        }else{
            return response()->json(['error'=>'Nama sensor sudah ada, silahkan ubah nama sensor.']);
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $getVendor = Vendor::where('slug',$id)->where('isDeleted',0)->first();
        $data['vendor'] = $getVendor;
        $id = Auth::user()->id;
        $getUser = User::where('id', $id)->first();
        if($getUser->role == 'Admin Vendor' || $getUser->role == 'User'){
            return redirect('/404');
        }else{
            return view('vendor.vendor',$data);
        }
        
    }

    public function lokasiList($id, $lokasiId)
    {

        $getVendor = Vendor::where('slug',$id)->where('isDeleted',0)->first();
        $getLokasi = DB::table('lokasi')->where('slug',$lokasiId)->where('isDeleted',0)->first();
        $data['vendor'] = $getVendor;
        $data['lokasi'] = $getLokasi;
        $id = Auth::user()->id;
        $getUser = User::where('id', $id)->first();
        if($getUser->role == 'Admin Vendor' || $getUser->role == 'User'){
            return redirect('/404');
        }else{
            return view('vendor.lokasi',$data);
        }
    }

    public function spanList($id, $lokasiId, $spanId)
    {
        $getVendor = Vendor::where('slug',$id)->where('isDeleted',0)->first();
        $getLokasi = DB::table('lokasi')->where('slug',$lokasiId)->where('isDeleted',0)->first();
        $getSpan = DB::table('span')->where('id',$spanId)->where('isDeleted',0)->first();
        $getParameter = DB::table('parameter')->where('isDeleted',0)->get();
        $data['vendor'] = $getVendor;
        $data['lokasi'] = $getLokasi;
        $data['span'] = $getSpan;
        $data['sensor'] = $getParameter;
        $id = Auth::user()->id;
        $getUser = User::where('id', $id)->first();
        if($getUser->role == 'Admin Vendor' || $getUser->role == 'User'){
            return redirect('/404');
        }else{
            return view('vendor.span',$data);
        }
    }

    public function listLiveSensor($id, $lokasiId){
        $getUser = DB::table('users')->where('id', Auth::user()->id)->first();
        $getVendor = Vendor::where('slug',$id)->where('isDeleted',0)->first();
        $getLokasi = DB::table('lokasi')->where('slug', $lokasiId)->where('isDeleted',0)->where('id_vendor',$getVendor->id)->first();
        $data['vendor'] = $getVendor;
        $data['lokasi'] = $getLokasi;
        return view('vendor.live_sensor',$data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
    }

    public function editVendor($id)
    {
        $vendor = Vendor::find($id);
        echo json_encode($vendor);
    }
    public function editLokasi($id)
    {
        $lokasi = Lokasi::find($id);
        echo json_encode($lokasi);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $preSlug = $request->input('nama_vendor');
        $slug = Str::slug($preSlug, '-');
        
        $vendor = Vendor::find($id);
        $vendor->nama_vendor = $request->input('nama_vendor');
        $vendor->slug = $slug;
        
        if($request->hasFile('image')){
            $validation = Validator::make($request->all(), [
                'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:20000'
            ]);
            if($validation->passes()) {
                $image = $request->file('image');
                $new_name = date('Ymd') . time() . '_'.$image->getClientOriginalName(). '.' . $image->getClientOriginalExtension();
                $image->move(public_path('assets/img/vendor'), $new_name);
                $vendor->foto = $new_name;
            }
        }
        if($vendor->save()){
            return response()->json(['success'=>'Vendor Berhasil Diubah.']);
        }else {
            return response()->json(['error'=>'Vendor Gagal Diubah.']);
        }
    }
    public function updateVendor(Request $request)
    {
        $preSlug = $request->input('nama_vendors');
        $slug = Str::slug($preSlug, '-');
        $id = $request->input('id_vendors');
        $vendor = Vendor::find($id);
        $vendor->nama_vendor = $request->input('nama_vendors');
        $vendor->slug = $slug;
        
        if($request->hasFile('foto')){
            $validation = Validator::make($request->all(), [
                'foto' => 'required|image|mimes:jpeg,png,jpg,gif|max:20000'
            ]);
            if($validation->passes()) {
                $image = $request->file('foto');
                $new_name = date('Ymd') . time() . '_'.$image->getClientOriginalName(). '.' . $image->getClientOriginalExtension();
                $image->move(public_path('assets/img/vendor'), $new_name);
                $vendor->foto = $new_name;
            }
        }
        if($vendor->save()){
            return response()->json(['success'=>'Vendor Berhasil Diubah.']);
        }else {
            return response()->json(['error'=>'Vendor Gagal Diubah.']);
        }
    }

    public function updateLokasi(Request $request)
    {
        $preSlug = $request->input('nama_lokasis');
        $slug = Str::slug($preSlug, '-');
        $id = $request->input('id_lokasis');

        $lokasi = Lokasi::find($id);
        $lokasi->nama_lokasi = $request->input('nama_lokasis');
        $lokasi->long = $request->input('longitudes');
        $lokasi->lat = $request->input('latitudes');
        $lokasi->slug = $slug;
        
        if($request->hasFile('foto')){
            $validation = Validator::make($request->all(), [
                'foto' => 'required|image|mimes:jpeg,png,jpg,gif|max:20000'
            ]);
            if($validation->passes()) {
                $image = $request->file('foto');
                $new_name = date('Ymd') . time() . '_'.$image->getClientOriginalName(). '.' . $image->getClientOriginalExtension();
                $image->move(public_path('assets/img/lokasi'), $new_name);
                $lokasi->foto = $new_name;
            }
        }
        if($lokasi->save()){
            return response()->json(['success'=>'Lokasi Berhasil Diubah.']);
        }else {
            return response()->json(['error'=>'Lokasi Gagal Diubah.']);
        }
    }

    public function updateLiveSpan(Request $request)
    {
        $getUser = User::where('id', Auth::user()->id)->first();
        $id = $request->input('id_span');
        $checkData = Span::join('lokasi','lokasi.id','=','span.id_lokasi')->where('span.id',$id)->where('span.isDeleted',0)->first();
        $span = Span::find($id);
        $span->nama_span = $request->input('nama_span');
        $span->stationId = $request->input('station_id');        
        if($request->hasFile('foto')){
            $validation = Validator::make($request->all(), [
                'foto' => 'required|image|mimes:jpeg,png,jpg,gif|max:20000'
            ]);
            if($validation->passes()) {
                $image = $request->file('foto');
                $new_name = date('Ymd') . time() . '_'.$image->getClientOriginalName(). '.' . $image->getClientOriginalExtension();
                $image->move(public_path('assets/img/span'), $new_name);
                $span->foto = $new_name;
            }
        }
        if($span->save()){
            return response()->json(['success'=>'Span Berhasil Diubah.']);
        }else {
            return response()->json(['error'=>'Span Gagal Diubah.']);
        }
        
    }
    public function updatePositionSpan(Request $request)
    {
        $getUser = User::where('id', Auth::user()->id)->first();
        $id = $request->input('id');
        
        $delimiter = "_";
        $parts = explode($delimiter, $id);
        $newId = $parts[1];

        $checkData = Span::join('lokasi','lokasi.id','=','span.id_lokasi')->where('span.id',$newId)->where('span.isDeleted',0)->count();
        if($checkData > 0){
            $span = Span::find($newId);
            $span->x_position = $request->input('left');
            $span->y_position = $request->input('top');   
            if($span->save()){
                return response()->json(['success'=>'Span Berhasil Diubah.']);
            }else {
                return response()->json(['error'=>'Span Gagal Diubah.']);
            }
        }else{
            return response()->json(['error'=>'Span Gagal Diubah.']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $vendor = Vendor::find($id);
        $vendor->isDeleted=1;
        if($vendor->save()){
            return response()->json(['success'=>'Vendor Berhasil Dihapus.']);
        }else{
            return response()->json(['error'=>'Vendor Gagal Dihapus.']);
        }
    }
    public function deleteLokasi($id)
    {
        $lokasi = Lokasi::find($id);
        $lokasi->isDeleted=1;
        if($lokasi->save()){
            return response()->json(['success'=>'Lokasi Berhasil Dihapus.']);
        }else{
            return response()->json(['error'=>'Lokasi Gagal Dihapus.']);
        }
    }
}
