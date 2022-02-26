<?php 
 
namespace App\Models; 
 
use Illuminate\Database\Eloquent\Factories\HasFactory; 
use Illuminate\Database\Eloquent\Model; 
 
class Koli extends Model 
{ 
    use HasFactory; 
    protected $primaryKey = 'kli_id'; 
 
    protected $fillable = ['kli_id', 'kli_email' ,'kli_nama_koli', 'created_at' , 'updated_at']; 
    protected $table = 'koli'; 
}