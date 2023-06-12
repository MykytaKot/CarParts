<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Part extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 
        'serialnumber',
        'car_id'
    ]; 

    public static function getPartsByCarId($id ,$asc = 'ASC')
    {
        return self::where('car_id', $id)->orderBy('name',$asc)->get();
    }
    public static function deletePartsWithCarId($id)
    {
        return self::where('car_id', $id)->delete();
    }
}
