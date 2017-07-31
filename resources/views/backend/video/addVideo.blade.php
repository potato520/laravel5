@section('title', '用户管理')

@extends('backend.common.layouts')

@section('content')
    <style>
        .am-active span{padding: 6px 12px!important; border-radius: 4px!important;}
        .am-btn-toolbar a{background: #fff;}
    </style>
    <link rel="stylesheet" href="https://www.helloweba.com/demo/2016/dropzone/dropzone.css">

    <div class="tpl-portlet-components">
        <div class="portlet-title">
            <div class="caption font-green bold">
                <span class="am-icon-code"></span> 视频管理
            </div>
            <div class="tpl-portlet-input tpl-fz-ml">
                <div class="portlet-input input-small input-inline">
                    <!--
                    <div class="input-icon right">
                        <i class="am-icon-search"></i>
                        <input type="text" class="form-control form-control-solid" placeholder="搜索..."> </div>
                        -->
                </div>
            </div>


        </div>
        <div class="tpl-block ">

            <div class="am-g tpl-amazeui-form">


                <div class="am-u-sm-12 am-u-md-9">
                    <form class="am-form am-form-horizontal" id="myForm">
                        <div class="am-form-group">
                            <label for="user-name" class="am-u-sm-3 am-form-label">标题</label>
                            <div class="am-u-sm-9">
                                <input type="text" id="user-name" placeholder="标题" name="title">
                                <small  id="aa"></small>
                            </div>
                        </div>

                        <div class="am-form-group">
                            <label for="user-name" class="am-u-sm-3 am-form-label">相册</label>
                            <div class="am-u-sm-9">
                                <div id="mydropzone" class="dropzone"></div>
                                <small>请选择上传文件</small>
                            </div>
                        </div>

                        <div class="am-form-group">
                            <label for="user-intro" class="am-u-sm-3 am-form-label" >视频地址</label>
                            <div class="am-u-sm-9">
                                <input type="text" id="user-name" placeholder="输入完整的url地址" name="content">
                                <small id="content"></small>
                            </div>
                        </div>

                        <div class="am-form-group">
                            <label for="user-intro" class="am-u-sm-3 am-form-label">简介</label>
                            <div class="am-u-sm-9">
                                <textarea class="" rows="5" id="user-intro" placeholder="250字以内写出你的一生..."  name="description"></textarea>
                                <small id="description"></small>
                            </div>
                        </div>

                        <div class="am-form-group">
                            <div class="am-u-sm-9 am-u-sm-push-3">
                                <button type="button" class="am-btn am-btn-primary" onclick="addVideo();">保存修改</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="tpl-alert"></div>
    </div>
@endsection

@section('my-js')
    <script src="https://www.helloweba.com/demo/2016/dropzone/dropzone.min.js"></script>
    <script type="text/javascript">
        // 上传图片方法
        var myDropzone = new Dropzone("div#mydropzone", {
            headers: { 'X-CSRF-TOKEN' : '{{ csrf_token() }}' },
            method: 'post',
            url: "{{ url('/Backend/Video/upload') }}",
            paramName: "file",
            maxFilesize: 0.5, // MB
            maxFiles: 5,
            acceptedFiles: ".jpg,.png,.gif"
        });
        // 上传图片方法结束

        function ityzl_SHOW_LOAD_LAYER(){
            return index = layer.load(1, {
                shade: [0.1,'#fff'] //0.1透明度的白色背景
            });
        }
        function ityzl_CLOSE_LOAD_LAYER(index){
            layer.close(index);
        }
        function addVideo()
        {
                $.ajax({
                    type: "POST",
                    url: '{{ url('/Backend/Video/addVideo') }}',
                    headers: { 'X-CSRF-TOKEN' : '{{ csrf_token() }}' },
                    dataType: 'json',
                    cache: false,
                     data: $("#myForm").serialize(),
                    beforeSend: function () {
                        i =ityzl_SHOW_LOAD_LAYER();
                    },
                    complete: function () {
                        ityzl_CLOSE_LOAD_LAYER(i);
                    },
                    success: function(data) {
                        if(data == null) {
                            layer.msg('服务端错误', {time: 3000, icon:0});
                            return;
                        }
                        if(data.status != 0) {
                            layer.msg(data.message, {time: 3000, icon:0});
                            return;
                        }else{
                            layer.msg(data.message, {time: 2000, icon:1},function(){
                                parent.layer.closeAll();
                                window.location.reload();
                            });

                        }
                    },
                    error: function(xhr, status, error) {
                        var json=JSON.parse(xhr.responseText);
                        if(json.title){
                            var er = json.title;
                           $('#aa').html(""+json.title+"");
                        }else{
                            $('#aa').html("");
                        }
                        if(json.content){
                            var er = json.title;
                            $('#content').html(""+json.content+"");
                        }else{
                            $('#content').html("");
                        }
                        if(json.description){
                            var er = json.description;
                            $('#description').html(""+json.description+"");
                        }else{
                            $('#description').html("");
                        }
                        console.log(xhr);
                        console.log(status);
                        console.log(error);
                    }
                });
        }

        // 分页样式
        $('.am-fr .active').attr('class', 'am-active');
        $('.am-fr ul').attr('class', 'am-pagination tpl-pagination');
        $('.am-fr .active span').css('padding', '1px');



        // 搜索
        function search1(){
            $('#myform').submit();
        }

    </script>
@endsection