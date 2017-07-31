@section('title', '控制台')

@extends('backend.common.layouts')

{{--要重写的区域--}}
@section('content')
    <ol class="am-breadcrumb">
        <li><a href="#" class="am-icon-home">首页</a></li>
        <li><a href="#">分类</a></li>
        <li class="am-active">内容</li>
    </ol>
    <div class="tpl-content-scope">
        <div class="note note-info">
            <h3>Amaze UI 为移动而生
                <span class="close" data-close="note"></span>
            </h3>
            <p> Amaze UI 含近 20 个 CSS 组件、20 余 JS 组件，更有多个包含不同主题的 Web 组件，可快速构建界面出色、体验优秀的跨屏页面，大幅提升开发效率。</p>
            <p><span class="label label-danger">提示:</span> Amaze UI 关注中文排版，根据用户代理调整字体，实现更好的中文排版效果。
            </p>
        </div>
    </div>

    <div class="row">
        <div class="am-u-lg-3 am-u-md-6 am-u-sm-12">
            <div class="dashboard-stat blue">
                <div class="visual">
                    <i class="am-icon-comments-o"></i>
                </div>
                <div class="details">
                    <div class="number"> 1349 </div>
                    <div class="desc"> 新消息 </div>
                </div>
                <a class="more" href="#"> 查看更多
                    <i class="m-icon-swapright m-icon-white"></i>
                </a>
            </div>
        </div>
        <div class="am-u-lg-3 am-u-md-6 am-u-sm-12">
            <div class="dashboard-stat red">
                <div class="visual">
                    <i class="am-icon-bar-chart-o"></i>
                </div>
                <div class="details">
                    <div class="number"> 62% </div>
                    <div class="desc"> 收视率 </div>
                </div>
                <a class="more" href="#"> 查看更多
                    <i class="m-icon-swapright m-icon-white"></i>
                </a>
            </div>
        </div>
        <div class="am-u-lg-3 am-u-md-6 am-u-sm-12">
            <div class="dashboard-stat green">
                <div class="visual">
                    <i class="am-icon-apple"></i>
                </div>
                <div class="details">
                    <div class="number"> 653 </div>
                    <div class="desc"> 苹果设备 </div>
                </div>
                <a class="more" href="#"> 查看更多
                    <i class="m-icon-swapright m-icon-white"></i>
                </a>
            </div>
        </div>
        <div class="am-u-lg-3 am-u-md-6 am-u-sm-12">
            <div class="dashboard-stat purple">
                <div class="visual">
                    <i class="am-icon-android"></i>
                </div>
                <div class="details">
                    <div class="number"> 786 </div>
                    <div class="desc"> 安卓设备 </div>
                </div>
                <a class="more" href="#"> 查看更多
                    <i class="m-icon-swapright m-icon-white"></i>
                </a>
            </div>
        </div>

    </div>
@endsection