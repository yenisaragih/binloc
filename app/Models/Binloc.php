<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Binloc extends Model
{
    use HasFactory;
    
    protected $table = 'binlocs';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'part_number', 
        'description', 
        'stock_oh_s79', 
        'stock_code_s79', 
        'ip_prestocking', 
        'stock_oh_s38', 
        'stock_code_s38'
    ];

    /**
     * Insert data into binlocs
     */
    public static function insertData($data){

        $value = DB::table('binlocs')->where('part_number',$data['part_number'])->get();
            DB::table('binlocs')->insert($data);
    }
}
