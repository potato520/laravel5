<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Amaze UI Admin index Examples - 素材牛模板演示</title>
    <meta name="description" content="这是一个 index 页面">
    <meta name="keywords" content="index">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="renderer" content="webkit">
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <link rel="icon" type="image/png" href="{{ asset('/amaze/i/favicon.png') }}">
    <link rel="apple-touch-icon-precomposed" href="{{ asset('/amaze/i/app-icon72x72@2x.png') }}">
    <meta name="apple-mobile-web-app-title" content="Amaze UI" />
    <link rel="stylesheet" href="{{ asset('/amaze/css/amazeui.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('/amaze/css/admin.css') }}">
    <link rel="stylesheet" href="{{ asset('/amaze/css/app.css') }}">
</head>

<body data-type="login">

<div class="am-g myapp-login">
    <div class="myapp-login-logo-block  tpl-login-max">
        <div class="myapp-login-logo-text">
            <div class="myapp-login-logo-text">
                Amaze UI<span> Login</span> <i class="am-icon-skyatlas"></i>

            </div>
        </div>

        <div class="login-font">
            <i>Log In </i> or <span> Sign Up</span>
        </div>
        <div class="am-u-sm-10 login-am-center">
            <form class="am-form">
                <fieldset>
                    <div class="am-form-group">
                        <input type="email" class="" name="email" id="doc-ipt-email-1" placeholder="输入电子邮件">
                    </div>
                    <div class="am-form-group">
                        <input type="password" class="" name="password" id="doc-ipt-pwd-1" placeholder="设置个密码吧">
                    </div>
                    <p><button type="button" id="lg" class="am-btn am-btn-default" onclick="login();">登录</button></p>
                </fieldset>
            </form>
        </div>
    </div>
</div>

<script src="http://apps.bdimg.com/libs/jquery/1.7.2/jquery.js"></script>
<script src="{{ asset('/amaze/js/amazeui.min.js') }}"></script>
<script src="{{ asset('/amaze/js/app.js') }}"></script>
<!--layer-->
<script src="{{ asset('/layer/layer/layer.js') }}"></script>
<link rel="stylesheet" href="{{ asset('/layer/layer/skin/default/layer.css') }}">

</body>

</html>

<script>
    $(document).keyup(function(event){
        if(event.keyCode ==13){
            login();
        }
    });
    function login()
    {
        var email = $('input[name=email]').val();
        var password = $('input[name=password]').val();

        layer.config({
            skin: 'layui-layer-molv' //一旦设定，所有弹层风格都采用此主题。
        });
        function ityzl_SHOW_LOAD_LAYER(){
            return index = layer.load(1, {
                shade: [0.1,'#fff'] //0.1透明度的白色背景
            });
        }
        function ityzl_CLOSE_LOAD_LAYER(index){
            layer.close(index);
        }

        $.ajax({
            type: "POST",
            url: '{{ url('/Backend/toLogin') }}',
            dataType: 'json',
            cache: false,
            data: {email: email, password: password, _token: "{{csrf_token()}}"},
            beforeSend: function () {
                $('#lg').html('登录中..');
                $('#lg').attr('onclick','javascript:void();');

                i =ityzl_SHOW_LOAD_LAYER();
            },
            complete: function () {
                $('#lg').html('登录');
                $('#lg').attr('onclick','login();');
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
                    ityzl_CLOSE_LOAD_LAYER(i);
                    layer.msg(data.message, {time: 3000, icon:1},function(){
                        window.location.href = "{{ url('Backend/Home') }}";
                    });
                }

            },
            error: function(xhr, status, error) {
                console.log(xhr);
                console.log(status);
                console.log(error);
            }
        });
    }
</script>