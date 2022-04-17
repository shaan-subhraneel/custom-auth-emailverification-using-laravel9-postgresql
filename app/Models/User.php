<?php
// code developed by Subhraneel Chowdhury
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;
    public $timestamps=false;

    public function verifyUser(){
        return $this->hasOne('App\Models\verifyUser', 'id', 'id');
    }
}
