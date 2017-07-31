<?php
/**
 * Created by PhpStorm.
 * User: youkaili
 * Date: 2017/7/5
 * Time: 18:07
 */

namespace app\Models;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    protected $table = 'member';
    protected $primarykey = 'id';
    protected $fillable = ['nickname', 'email', 'password', 'phone']; # 批量赋值 Student::create($data)

}