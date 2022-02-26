<?php 
 
namespace App\Http\Controllers\api; 
 
use App\Http\Controllers\Controller; 
use Illuminate\Http\Request; 
use App\Models\Koli; 
use Illuminate\Support\Facades\DB; 
use App\Models\Items; 
use Illuminate\Support\Facades\Validator; 
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException; 
 
class KoliController extends Controller 
{ 
 
    public function index(){ 
        $model = Koli::all(); 
        return response()->json($model); 
    } 
    /** 
     * Show the form for creating a new resource. 
     * 
     * @return \Illuminate\Http\Response 
     */ 
    public function putin(Request $request) 
    { 
        $data= [ 
            'kli_email' => $request->user, 
            'kli_nama_koli' => $request->koli   
        ]; 
        $validator = Validator::make($data, [ 
            'kli_email' => ['required'], 
            'kli_nama_koli' => ['required'], 
        ]); 
 
        if ($validator->fails()) { 
            throw new UnprocessableEntityHttpException($validator->errors()); 
        } 
        $simpan = Koli::create($data); 
        if ($simpan) { 
            $reqitem = $request['item']; 
            foreach($reqitem as $val){ 
                $items = new Items; 
                $items->itm_koli_id = $simpan->id; 
                $items->itm_nama = $val['itm_nama']; 
                $items->itm_qty = $val['itm_qty']; 
                $simpan = $items->save(); 
            } 
            if ($simpan) { 
                return response()->noContent(); 
            }else{ 
                return response()->json([ 
                    'code' => 400, 
                    'status' => 'Gagal' 
                ],400); 
            } 
        }else{ 
            return response()->json([ 
                'code' => 500, 
                'status' => 'Data gagl disimpan di koli' 
            ],500); 
        } 
    } 
 
    /** 
     * Show the form for editing the specified resource. 
     * 
     * @param  int  $id 
     * @return \Illuminate\Http\Response 
     */ 
    public function takeout(Request $request) 
    { 
        $email = $request->user; 
        $koli = $request->koli; 
        $model = Koli::where([['kli_email','=', $email],['kli_nama_koli','=',$koli]])->first(); 
        $data = Items::where('itm_koli_id', $model->kli_id)->delete(); 
        $reqitem = $request['item']; 
        if ($data) { 
            foreach($reqitem as $val){ 
                $item = new Items; 
                $item->itm_koli_id = $model->kli_id; 
                $item->itm_nama = $val['name']; 
                $item->itm_qty = $val['qty']; 
                $simpan = $item->save(); 
            } 
        } 
        if ($simpan) { 
            return response()->noContent();; 
        }else{ 
            return response()->json([ 
                'code' => 400, 
                'status' => 'Gagal' 
            ]); 
        } 
    } 
 
    /** 
     * Display a listing of the resource. 
     * 
     * @return \Illuminate\Http\Response 
     */ 
    public function common(Request $request) 
    { 
        $getuser = $request->input('user'); 
        $temp = []; 
 
        foreach($getuser as $value){ 
            $modelKoli = Koli::where('kli_email', $value)->get(); 
            foreach($modelKoli as $key => $val){  
                $modelItems = Items::select(['itm_nama', 'itm_qty'])->where('itm_koli_id', $val->kli_id)->get()->toArray(); 
                $temp[] = [ 
                    'koli' => $val->kli_nama_koli, 
                    'items' => $modelItems 
                ]; 
            }  
 
        }  
        return response()->json($temp); 
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
        $model = Koli::where('kli_id', $id)->first(); 
        $model->kli_email = $request->kli_email; 
        $model->kli_nama_koli = $request->kli_nama_koli; 
        if ($model->save()){ 
            return response()->noContent(); 
        }else{ 
            return response()->json([ 
                'code' => 400, 
                'status' => 'Gagal' 
            ]); 
        }         
    } 
}