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

class MemberController extends Controller
{
    public $m3_result;
    public function __construct()
    {
        $this->m3_result = new M3Result();
    }

    public function login(Request $request){
//        echo '<pre>';
//        print_r($request->getSession());

        return view('backend/login/login');
    }

    public function toLogin(Request $request)
    {
        $email = $request -> input('email', '');
        $password = $request -> input('password', '');

        if(empty($email) || empty($password)){
            $this->m3_result->status = 1;
            $this->m3_result->message = '用户名或密码不能为空';
            return $this->m3_result->toJson();
        }

        // 字符串中是否包含@
        if(strpos($email, '@') == true) {
            $member = Member::where('email', '=', $email)->first();
        }else{
            $member = Member::where('phone', '=', $email)->first();
        }
        if($member == null){
            $this->m3_result->status = 1;
            $this->m3_result->message = '用户名或密码输入有误';
            return $this->m3_result->toJson();
        }else{
            if($member->password != $password){
                $this->m3_result->status = 1;
                $this->m3_result->message = '用户名或密码输入有误';
                return $this->m3_result->toJson();
            }
        }

        // 登录成功
        $request->session()->put('member', $member);
        $request->session()->put('member_id', $member->id);

        $this->m3_result->status = 0;
        $this->m3_result->message = '登录成功,即将跳转';
        return $this->m3_result->toJson();
    }

    // 用户列表
    public function lists(Request $request)
    {
            $search = $request->input('search');
            $search2 = urldecode($search);
            $lists = Member::where('nickname', 'like', "%{$search}%")->orderBy('id', 'DESC')->paginate($perPage = 5, $columns = ['*'], $pageName = "page", $page = null);
            return view('backend/member/lists', compact('lists', $lists, 'search', $search));
//
//            $lists = Member::where('active', '=', 0)->orderBy('id', 'DESC')->paginate($perPage = 5, $columns = ['*'], $pageName = 'page', $page = null);
//            return view('backend/member/lists', compact('lists', $lists));
    }

    // 添加用户
    public function addUser(Request $request)
    {
        if($request->isMethod('post')){
            // TODO 添加用户

            $member = new Member();
            $member->nickname = $request->input('nickname');
            $member->email = $request->input('email');
            $member->password = md5($request->input('password'));
            $member->phone = $request->input('phone');
            if($member->save()){
                $this->m3_result->status = 0;
                $this->m3_result->message = '提交成功';
                return $this->m3_result->toJson();
            }else{
                $this->m3_result->status = 1;
                $this->m3_result->message = '提交失败';
                return $this->m3_result->toJson();
            }
        }
        return view('backend/member/addUser');
    }

    // 编辑用户 视图
    public function modUser(Request $request, $id)
    {
        $find = Member::find($id);
        if($request->isMethod('get')){
            $find = Member::find($id);

            return view('backend/member/modUser', compact('find', $find, 'id', $id));
        }
        return null;

    }

    // 编辑用户 提交
    public function modUserServer(Request $request)
    {
        if($request->isMethod('post')){
            $id = $request->input('id');
            $find = Member::find($id);

            $find->nickname = $request->input('nickname');
            $find->email = $request->input('email');
            $find->password = $request->input('password');
            $find->phone = $request->input('phone');
            if($find->save()){
                $this->m3_result->status = 0;
                $this->m3_result->message = '编辑成功';
                return $this->m3_result->toJson();
            }else{
                $this->m3_result->status = 1;
                $this->m3_result->message = '编辑失败';
                return $this->m3_result->toJson();
            }
        }
        return null;
    }

    public function delUser(Request $request, $id)
    {
        if($request->isMethod('get')){
            $find = Member::find($id);
            if($find){
                if($find->delete()){
                    $this->m3_result->status = 0;
                    $this->m3_result->message = '删除成功';
                    return $this->m3_result->toJson();
                }else{
                    $this->m3_result->status = 1;
                    $this->m3_result->message = '删除失败';
                    return $this->m3_result->toJson();
                }
            }else{
                $this->m3_result->status = 1;
                $this->m3_result->message = '未找到数据';
                return $this->m3_result->toJson();
            }

        }
    }

    // 搜索
    public function search(Request $request)
    {

    }



















    public function toRegister(){
        return view('register');
    }
}