<?php
// code developed by Subhraneel Chowdhury
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class verifyUser extends Model
{
    use HasFactory;
    public $timestamps=false;

    public function user(){
        return $this->belongsto('App\Models\User');
    }
}
