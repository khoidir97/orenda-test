<?php 
 
namespace App\Models; 
 
use Illuminate\Database\Eloquent\Factories\HasFactory; 
use Illuminate\Database\Eloquent\Model; 
 
class Items extends Model 
{ 
    use HasFactory; 
    protected $primaryKey = 'itm_id'; 
    protected $fillable = ['itm_id','itm_koli_id', 'itm_nama' ,'itm_qty', 'created_at' , 'updated_at']; 
}