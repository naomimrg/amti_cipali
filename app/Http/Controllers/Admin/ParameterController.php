<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Validator;
use DB;
use App\Models\User;
use App\Models\Vendor;
use App\Models\Sensor;
use App\Models\Span;
use App\Models\Lokasi;
use App\Models\Parameter;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ParameterController extends Controller
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
            return view('parameter.index');
        }
    }

    public function sensor_client()
    {
        $id = Auth::user()->id;
        $getUser = User::where('id', $id)->first();
        if($getUser->role == 'Admin Vendor' || $getUser->role == 'User'){
            return redirect('/404');
        }else{
            return view('parameter.detail');
        }
    }

    public function listParameter()
    {
        $data = Parameter::where('isDeleted', 0)->get();
        $list_data = new Collection;
        $i = 1;
        foreach($data as $ld){
            $list_data->push([
                'id' => $i,
                'nama_parameter' => $ld->nama_parameter,
                'batas_bawah' => $ld->batas_bawah,
                'batas_atas' => $ld->batas_atas,
                'satuan' => $ld->satuan,
                'action' => '<center><button type="button" data-id="'.$ld->id.'" data-action="edit" class="action btn btn-warning btn-sm" data-toggle="tooltip" title="Ubah"><i class="fa fa-pencil"></i> Edit</button></center>',
            ]);
            $i++;
        }
        return Datatables::of($list_data)->rawColumns(['action'])->make(true);
    }

    public function listParameterClient()
    {
        $id = Auth::user()->id;
        $list_data = new Collection;
        $i = 1;
        $getClient = DB::table('vendor')->where('isDeleted',0)->get();
        foreach($getClient as $gC){
            $getLokasi = DB::table('lokasi')->where('id_vendor',$gC->id)->where('isDeleted',0)->get();
            foreach($getLokasi as $gL){
                $getSpan = DB::table('span')->where('id_lokasi',$gL->id)->where('isDeleted',0)->get();
                foreach($getSpan as $gS){
                    $getSensor = DB::table('sensor')->where('isDeleted', 0)->where('id_span',$gS->id)->get();
                    foreach($getSensor as $ld){
                        $parameter = DB::table('parameter')->where('isDeleted',0)->where('id',$ld->id_parameter)->first();
                        $list_data->push([
                            'id' => $i,
                            'nama_client' => $gC->nama_vendor,
                            'lokasi' => $gL->nama_lokasi,
                            'span' => $gS->nama_span,
                            'id_span' => $gS->id,
                            'nama_sensor' => $ld->sensor_name,
                            'nama_parameter' => $parameter->nama_parameter,
                            'sensorId' => $ld->nama_sensor,
                            'Idsensor' => $ld->id,
                            'batas_bawah' => $ld->batas_bawah,
                            'batas_atas' => $ld->batas_atas,
                            'satuan' => $ld->satuan,
                            'x_position' => $ld->x_position,
                            'y_position' => $ld->y_position,
                            'action' => '<center><button style="width: 100%;" type="button" data-id="'.$ld->id.'" data-action="edit" class="action btn btn-warning btn-sm" data-toggle="tooltip" title="Ubah"><i class="fa fa-pencil"></i> Edit</button>&nbsp;<button style="width: 100%;" type="button" data-id="'.$ld->id.'" data-action="hapus" class="action btn btn-danger btn-sm" data-toggle="tooltip" title="Delete"><i class="fa fa-times"></i> Hapus</button></center>',
                        ]);
                        $i++;
                    }
                    
                }
            }
        }
        return Datatables::of($list_data)->rawColumns(['action'])->make(true);
    }

    public function listSensorClient()
    {
        $id = Auth::user()->id;
        $list_data = new Collection;
        $i = 1;
    
        // Mengambil semua vendor yang tidak dihapus
        $getClient = DB::table('vendor')->where('isDeleted', 0)->get();
    
        foreach ($getClient as $gC) {
            // Mengambil lokasi untuk setiap vendor
            $getLokasi = DB::table('lokasi')->where('id_vendor', $gC->id)->where('isDeleted', 0)->get();
    
            foreach ($getLokasi as $gL) {
                // Mengambil span untuk setiap lokasi
                $getSpan = DB::table('span')->where('id_lokasi', $gL->id)->where('isDeleted', 0)->get();
    
                foreach ($getSpan as $gS) {
                    // Mengambil parameter untuk setiap span
                    $getParameters = DB::table('sensor')
                    ->select('sensor_name', DB::raw('MIN(id) as id'), DB::raw('MAX(x_position) as x_position'), DB::raw('MAX(y_position) as y_position'))
                    ->where('id_span', $gS->id)
                    ->where('isDeleted', 0)
                    ->groupBy('sensor_name')
                    ->get();
                
    
                    // Lakukan sesuatu dengan $getParameter jika diperlukan
                    foreach ($getParameters as $sensors) {
                        // Tambahkan ke $list_data atau lakukan operasi lain
                        $list_data->push([
                            'id' => $sensors->id,
                            'sensor_name' => $sensors->sensor_name,
                            'id_span' => $gS->id,
                            'x_position' => $sensors->x_position,
                            'y_position' => $sensors->y_position,
                        ]);
                    }
                }


            }
        }
    
        return response()->json($list_data);

    }
    public function listSensorByLokasi($lokasi_id)
    {
        $lokasi = DB::table('lokasi')
            ->where('id', $lokasi_id)
            ->where('isDeleted', 0)
            ->first();

        if (!$lokasi) {
            return response()->json(['error' => 'Lokasi tidak ditemukan'], 404);
        }

        $list_data = new \Illuminate\Support\Collection;

        // Ambil semua span dari lokasi
        $getSpan = DB::table('span')
            ->where('id_lokasi', $lokasi->id)
            ->where('isDeleted', 0)
            ->get();

        foreach ($getSpan as $gS) {
            // Ambil sensor berdasarkan span
            $getParameters = DB::table('sensor')
                ->select(
                    'sensor_name',
                    DB::raw('MIN(id) as id'),
                    DB::raw('MAX(x_position) as x_position'),
                    DB::raw('MAX(y_position) as y_position')
                )
                ->where('id_span', $gS->id)
                ->where('isDeleted', 0)
                ->groupBy('sensor_name')
                ->get();

            foreach ($getParameters as $sensors) {
                $list_data->push([
                    'id' => $sensors->id,
                    'sensor_name' => $sensors->sensor_name,
                    'id_span' => $gS->id,
                    'x_position' => $sensors->x_position,
                    'y_position' => $sensors->y_position,
                ]);
            }
        }

        $sensorExists = $list_data->isNotEmpty();

        if ($sensorExists) {
            // Kalau data sensor ditemukan, kirim response success dengan data
            return response()->json([
                'status' => 'success',
                'message' => 'Data sensor ditemukan',
                'data' => $list_data
            ]);
        } else {
            // Kalau tidak ada data sensor
            return response()->json([
                'status' => 'empty',
                'message' => 'Tidak ada data sensor ditemukan',
                'data' => []
            ]);
        }
    }

    public function editData($id)
    {
        $getUser = User::where('id', Auth::user()->id)->first();
        
        $data = Sensor::where('id',$id)->first();
        $getParameter = Parameter::where('id',$data->id_parameter)->where('isDeleted',0)->first();
        $getSpan = Span::where('id',$data->id_span)->where('isDeleted',0)->first();
        $getLokasi = Lokasi::where('id',$getSpan->id_lokasi)->where('isDeleted',0)->first();
        $getClient = Vendor::where('id',$getLokasi->id_vendor)->where('isDeleted',0)->first();

        $data = [
            'id' => $data->id,
            'nama_client' => $getClient->nama_vendor,
            'lokasi' => $getLokasi->nama_lokasi,
            'span' => $getSpan->nama_span,
            'jenis_sensor' => $getParameter->nama_parameter,
            'sensorId' => $data->nama_sensor,
            'batas_bawah' => $data->batas_bawah,
            'batas_atas' => $data->batas_atas,
            'nama_sensor' => $data->sensor_name,
            'satuan' => $data->satuan
        ];
        
    
        return response()->json($data);
    }


    public function edit($id)
    {
        $getUser = User::where('id', Auth::user()->id)->first();
        if($getUser->role == "Super Admin" || $getUser->role == "Admin GSI"){
            $data = Parameter::findorfail($id);
        }elseif($getUser->role == "Admin Vendor"){
            $data = Sensor::where('id',$id)->first();
            $getParameter = Parameter::where('id',$data->id_parameter)->where('isDeleted',0)->first();
            $getSpan = Span::where('id',$data->id_span)->where('isDeleted',0)->first();
            $getLokasi = Lokasi::where('id',$getSpan->id_lokasi)->where('isDeleted',0)->first();
            $data = [
                'id' => $data->id,
                'lokasi' => $getLokasi->nama_lokasi,
                'span' => $getSpan->nama_span,
                'jenis_sensor' => $getParameter->nama_parameter,
                'nama_sensor' => $data->sensor_name,
                'sensorId' => $data->nama_sensor,
                'batas_bawah' => $data->batas_bawah,
                'batas_atas' => $data->batas_atas,
                'satuan' => $data->satuan
            ];
        }
        
    
        return response()->json($data);
    }

    public function update(Request $request, $id)
    {
        $getUser = User::where('id', Auth::user()->id)->first();
        if($getUser->role == "Super Admin" || $getUser->role == "Admin GSI"){
            $sensor = Parameter::find($id);
            $sensor->nama_parameter = $request->input('nama_parameter');
            $sensor->batas_atas = $request->input('batas_atas');
            $sensor->batas_bawah = $request->input('batas_bawah');
            $sensor->satuan = $request->input('satuan');
        }elseif($getUser->role == "Admin Vendor"){
            $checkData = Sensor::join('span','span.id','=','sensor.id_span')->join('lokasi','lokasi.id','=','span.id_lokasi')->where('sensor.id',$id)->where('sensor.isDeleted',0)->first();

            if($getUser->id_vendor == $checkData->id_vendor){
                $sensor = Sensor::find($id);
                $sensor->batas_atas = $request->input('batas_atas');
                $sensor->batas_bawah = $request->input('batas_bawah');
                $sensor->satuan = $request->input('satuan');
            }else{
                return response()->json(['error'=>'Akses ditolak.']);
            }
        }
        
        if($sensor->save()){
            return response()->json(['success'=>'Sensor Berhasil Diubah.']);
        }else{
            return response()->json(['error'=>'Sensor Gagal Diubah.']);
        }
    }
    public function updateData(Request $request, $id){
        // Memeriksa apakah sensor dengan ID yang diberikan ada dan tidak dihapus
        $checkData = Sensor::join('span', 'span.id', '=', 'sensor.id_span')
            ->join('lokasi', 'lokasi.id', '=', 'span.id_lokasi')
            ->where('sensor.id', $id)
            ->where('sensor.isDeleted', 0)
            ->first();

        if (!$checkData) {
            return response()->json(['error' => 'Sensor tidak ditemukan atau sudah dihapus.'], 404);
        }

        // Mengambil sensor berdasarkan ID
        $sensor = Sensor::find($id);

        // Memperbarui kolom yang disertakan dalam permintaan
        if ($request->has('batas_atas')) {
            $sensor->batas_atas = $request->input('batas_atas');
        }
        if ($request->has('sensorId')) {
            $sensor->nama_sensor = $request->input('sensorId');
        }
        if ($request->has('batas_bawah')) {
            $sensor->batas_bawah = $request->input('batas_bawah');
        }
        if ($request->has('satuan')) {
            $sensor->satuan = $request->input('satuan');
        }
        if ($request->has('x_position')) {
            $sensor->x_position = $request->input('x_position');
        }
        if ($request->has('y_position')) {
            $sensor->y_position = $request->input('y_position');
        }
        if ($request->has('nama_sensor')) {
            $sensor->sensor_name = $request->input('nama_sensor');
        }

        // Menyimpan perubahan
        if ($sensor->save()) {
            return response()->json(['success' => 'Data sensor berhasil diperbarui.']);
        } else {
            return response()->json(['error' => 'Gagal memperbarui data sensor.'], 500);
        }
    }
    

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
	public function deleteSensor($id)
    {
        $sensor = Sensor::find($id);
        $sensor->isDeleted = 1;
        if($sensor->save()){
            return response()->json(['success'=>'Sensor Berhasil Dihapus.']);
        }else{
            return response()->json(['error'=>'Sensor Gagal Dihapus.']);
        }
    }
	
    public function updateKordinat(Request $request, $id)
    {
        //ambil sensor berdasarkan id
        $sensor = Sensor::find($id);
        if (!$sensor) {
            return response()->json(['error' => 'Sensor tidak ditemukan.'], 404);
        }
        //periksa apakah sensor sudah dihapus
        if ($sensor->isDeleted == 1) {
            return response()->json(['error' => 'Sensor sudah dihapus.'], 400);
        }
        $request->validate([
            'x_position' => 'required|numeric',
            'y_position' => 'required|numeric',
        ]);
        //ambil semua sensor yang memiliki sensor name yang sama
        $affectedRows = Sensor::where('sensor_name', $sensor->sensor_name)
        ->update([
                'x_position' => $request->input('x_position'),
                'y_position' => $request->input('y_position'),
            ]);

        if ($affectedRows > 0) {
            return response()->json(['success' => 'Kordinat sensor berhasil diperbarui.']);
        } else {
            return response()->json(['error' => 'Gagal memperbarui kordinat sensor.'], 500);
        }
    }
}
