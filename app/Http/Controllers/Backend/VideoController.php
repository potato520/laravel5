<?php
/**
 * Created by PhpStorm.
 * User: 月下追魂
 * Date: 2017/7/25
 * Time: 16:54
 */
namespace app\Http\Controllers\Backend;
use App\Http\Controllers\Controller;
use App\Models\Video;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Request;
use App\Models\M3Result;

class VideoController extends Controller
{
    public $m3_result;

    public function __construct()
    {
        $this->m3_result = new M3Result();
    }

    // 视频列表
    public function lists()
    {
        $lists = Video::where('id','>','0')->orderBy('id', 'DESC')->paginate($perPage = 5, $columns = ['*'], $pageName = 'page', $page = null);
        return view('backend/video/lists', compact('lists', $lists));
    }

    // 添加视频
    public function addVideo(Request $request)
    {
        if($request->isMethod('post')){
                $video = new Video();

                $this->validate($request, [
                    'title' => 'required|min:2|max:10',
                    'content' => 'required',
                    'description' => 'required',
                ], [
                    'required' => ':attribute 为必填项',
                    'min' => ':attribute 最小长度为2个字符',
                    'integer' => ':attribute 必须为整数',
                    'max' => ':attribute 姓名长度不超过10个字符'
                ],[
                    'title' =>'标题',
                    'content' =>'视频地址',
                    'description' =>'简介',
                ]);
            $video->title = $request->input('title');
            $video->content = $request->input('content');
            $video->description = $request->input('description');

            if($video->save()){
                echo json_encode(array('status'=>0, 'message' => '添加成功'));exit();
            }else{
                echo json_encode(array('status'=>1, 'message' => '添加失败，请重试'));exit();
            }




        }else{
            return view('backend/video/addVideo');
        }
    }


    // 上传图片
    public function upload(Request $request)
    {
        /* 文件上传 */
        $file = $request->file('file');
        if(!$request->hasFile('file')){
            exit('上传文件为空！');
        }

        if(!$file->isValid()){
            exit('文件上传出错！');
        }else {
            // 获取文件名称
            $clientName = $file->getClientOriginalName();

            $newFileName = md5(time() . rand(0, 10000)) . '.' . $file->getClientOriginalExtension();
            $savePath = 'uploads/' . $newFileName;
            $bytes = Storage::put(
                $savePath,
                file_get_contents($file->getRealPath())
            );
            if (!Storage::exists($savePath)) {
                exit('保存文件失败！');
            }
            # 以下两行是用来预览图片的
            # header("Content-Type: ".Storage::mimeType($savePath));
            # echo Storage::get($savePath);
            /* 文件上传 */
        }
    }
}