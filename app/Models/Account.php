<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
   protected $fillable=['number','type','client_id','amount'];
}
