
<!--弹出框的样式-->
<link rel="stylesheet" href="{{ asset('/amaze/css/amazeui.min.css') }}" />
<link rel="stylesheet" href="{{ asset('/amaze/css/app.css') }}">
<script src="http://apps.bdimg.com/libs/jquery/1.7.2/jquery.js"></script>
<!--layer-->
<script src="{{ asset('/layer/layer/layer.js') }}"></script>
<link rel="stylesheet" href="{{ asset('/layer/layer/skin/default/layer.css') }}">

<div class="tpl-portlet-components">
<div class="tpl-block ">

    <div class="am-g tpl-amazeui-form">


        <div class="am-u-sm-12 am-u-md-10">
            <form class="am-form am-form-horizontal" id="myForm">
                <div class="am-form-group">
                    <label for="user-name" class="am-u-sm-3 am-form-label">昵称</label>
                    <div class="am-u-sm-9">
                        <input type="text" id="nickname" name="nickname" placeholder="昵称 / Nickname">
                        <small>输入你的名字，让我们记住你。</small>
                    </div>
                </div>

                <div class="am-form-group">
                    <label for="user-email" class="am-u-sm-3 am-form-label">电子邮件</label>
                    <div class="am-u-sm-9">
                        <input type="email" id="email" name="email" placeholder="输入你的电子邮件 / Email">
                        <small>邮箱你懂得...</small>
                    </div>
                </div>

                <div class="am-form-group">
                    <label for="user-name" class="am-u-sm-3 am-form-label">密码</label>
                    <div class="am-u-sm-9">
                        <input type="text" id="password" name="password" placeholder="密码 / Password">
                        <small>输入你的名字，让我们记住你。</small>
                    </div>
                </div>

                <div class="am-form-group">
                    <label for="user-phone" class="am-u-sm-3 am-form-label">电话</label>
                    <div class="am-u-sm-9">
                        <input type="tel" id="phone" name="phone" placeholder="输入你的电话号码 / Phone">
                    </div>
                </div>

                <div class="am-form-group">
                    <div class="am-u-sm-9 am-u-sm-push-3">
                        <button type="button" class="am-btn am-btn-primary" onclick="save();">提交</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
</div>

<script>
    function save()
    {
        var  frameindex= parent.layer.getFrameIndex(window.name);

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
            url: '{{ url('/Backend/Member/addUser') }}',
            headers: { 'X-CSRF-TOKEN' : '{{ csrf_token() }}' },
            dataType: 'json',
            cache: false,
            data: $("#myForm").serialize(),
            beforeSend: function () {
                $('.am-btn-primary').attr('onclick','javascript:void();');
                $('.am-btn-primary').html('提交中..');
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
                        parent.layer.close(frameindex);
                        parent.location.href = "{{ url('/Backend/Member') }}";
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