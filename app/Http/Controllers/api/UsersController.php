<?php 
 
namespace App\Http\Controllers\api; 
 
use App\Http\Controllers\Controller; 
use Illuminate\Http\Request; 
use App\Models\Users; 
use Illuminate\Support\Facades\Validator; 
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException; 
 
class UsersController extends Controller 
{ 
  
 
    /** 
     * Show the form for creating a new resource. 
     * 
     * @return \Illuminate\Http\Response 
     */ 
    public function register(Request $request) 
    { 
        $data = $request['users']; 
 
        $validator = Validator::make($data, [ 
            'users.*.email' => ['required', 'array'], 
        ]); 
 
        if ($validator->fails()) { 
            throw new UnprocessableEntityHttpException($validator->errors()); 
        } 
        foreach($data as $val){ 
            $model = new Users; 
            $model->email = $val; 
            $simpan = $model->save(); 
        } 
         
        if ($simpan) { 
            return response()->noContent(); 
        }else{ 
            return response()->json([ 
                'code' => 400, 
                'Status' => 'Gagal' 
            ],400); 
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
        $model = Users::where('id', $id)->first(); 
        if (!empty($model)) { 
            return response()->json([ 
                'code' => 204, 
                'data' => $model 
            ]); 
        }else{ 
            return response()->json([ 
                'code' => 500, 
                'Status' => 'Kosong' 
            ]); 
        } 
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
        $model = Users::where('id', $id)->first(); 
        $model->email = $request->email; 
        if ($model->save()) { 
            return response()->json([ 
                'code' => 204, 
                'Status' => 'Berhasil' 
            ]); 
        }else{ 
            return response()->json([ 
                'code' => 500, 
                'Status' => 'Gagal' 
            ]); 
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
        $model = Users::where('id', $id)->first(); 
        if ($model->delete()) { 
            return response()->json([ 
                'code' => 204, 
                'Status' => 'Berhasil' 
            ]); 
        }else{ 
            return response()->json([ 
                'code' => 500, 
                'Status' => 'Gagal' 
            ]); 
        } 
    } 
}