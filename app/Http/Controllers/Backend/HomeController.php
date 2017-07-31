<?php
/**
 * Created by PhpStorm.
 * User: 月下追魂
 * Date: 2017/7/5
 * Time: 16:31
 */
namespace app\Http\Controllers\Backend;
use App\Http\Controllers\Controller;
use App\Models\Member;
use Symfony\Component\HttpFoundation\Request;
use App\Models\M3Result;

class HomeController extends Controller
{
    public $m3_result;

    public function __construct()
    {
        $this->m3_result = new M3Result();
    }

    // 后台首页
    public function index()
    {
        return view('backend/home/home');
    }
}