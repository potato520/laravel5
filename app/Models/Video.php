<?php
/**
 * Created by PhpStorm.
 * User: youkaili
 * Date: 2017/7/5
 * Time: 18:07
 */

namespace app\Models;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    protected $table = 'video';
    protected $primarykey = 'id';
    protected $fillable = ['title', 'thumb', 'content','cid','description']; # 批量赋值 Student::create($data)

}