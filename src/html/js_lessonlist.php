<!DOCTYPE html>
<html lang="zh_CN">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo $type=='dier'?'第二课堂':'空中少年宫';?>课程列表</title>
    <!-- css -->
    <link rel="stylesheet" href="<?php echo PUBLICPATH; ?>dier/js/JsDepend/layui/css/layui.css">
    <link rel="stylesheet" href="<?php echo PUBLICPATH; ?>dier/css/common.css?t=<?php echo time();?>">
    <link rel="stylesheet" href="<?php echo PUBLICPATH; ?>dier/css/index.css?t=<?php echo time();?>">
    <!-- js -->
    <script type="text/javascript" src="<?php echo JSPATH?>new/jweixin-1.4.0.js"></script>
    <script type='text/javascript' src="<?php echo PUBLICPATH; ?>dier/js/JsDepend/jQuery.min.js"></script>
    <!-- 插件核心 -->
    <script src="<?php echo PUBLICPATH; ?>dier/js/JsDepend/webuploader.min.js"></script>
    <script src="<?php echo PUBLICPATH; ?>dier/js/JsDepend/Eleditor.min.js"></script>
    <!-- 实例化编辑器 -->
    <script type='text/javascript' src="<?php echo PUBLICPATH; ?>dier/js/wall-e.js?t=<?php echo time();?>"></script>
</head>

<body>

<div id="jsClassList">
    <div class="layui-tab " lay-filter="tab1">
        <div class="head-bx">
            <ul class="layui-tab-title head-con">
                <li class="layui-this head-tag left">我的课程</li>
                <?php if($type == 'dier'){?>
                    <li class="head-tag right ">开设课程</li>
                <?php }?>
            </ul>
        </div>

        <div class="layui-tab-content">
            <div class="layui-tab-item tab-two layui-show">
                <div class="layui-tab " lay-filter="tab2">
                    <ul class="layui-tab-title">
                        <li>待审核</li>
                        <li class="layui-this">已通过</li>
                        <li>未通过</li>
                        <li>已开课</li>
                    </ul>
                </div>
                <div class="layui-tab-content two-main-screen">
                    <div class="layui-tab-item">
                        <ul class="flow-default js-sh-list" id="daishenhe">
                        </ul>
                    </div>
                    <div class="layui-tab-item layui-show">
                        <ul class="flow-default js-sh-list" id="shenheguo">
                        </ul>
                    </div>
                    <div class="layui-tab-item">
                        <ul class="flow-default js-sh-list" id="weitongguo">
                        </ul>
                    </div>
                    <div class="layui-tab-item">
                        <ul class="flow-default js-sh-list" id="kaike"></ul>
                    </div>
                </div>
            </div>
            <div class="layui-tab-item  ">
                <div class="layui-form sub-new-lesson">
                    <div class="layui-form-item">
                        <div class="layui-form-label">课程名称</div>
                        <div class="layui-form-block">
                            <input type="text" name="title" lay-verify="title" placeholder="输入课程名称" autocomplete="off" class="layui-input ">
                            <img src="<?php echo PUBLICPATH; ?>dier/img/closebtn.png" class="closebtn-input">
                        </div>
                    </div>

                    <!-- 新增 -->
                    <div class="zsdx-bx layui-form-item">
                        <div class="layui-form-label">招生对象</div>
                        <div class="layui-form-block">
                            <input type="text" autocomplete="off" name="target" lay-verify="target" placeholder="请输入招生对象" class="layui-input">
                        </div>
                    </div>
                    <div class="zsdx-bx layui-form-item">
                        <div class="layui-form-label">开课时间</div>
                        <div class="layui-form-block kk-date">
                            <input type="text" name="startdate" value="" class="layui-input" id="date"  lay-verify="startdate" placeholder="请选择开课日期" bind-hasFocus="true" readonly="true" >
                        </div>
                    </div>
                    <div class="zsdx-bx layui-form-item">
                        <div class="layui-form-label">上课时间</div>
                        <div class="layui-form-block sk-time">
                            <input type="text" name="datetime1" class="layui-input" id="datetime1"lay-verify="datetime1" placeholder="上课时间"  bind-hasFocus="true" readonly="true"  >
                        </div>
                        -
                        <div class="layui-form-block sk-time">
                            <input type="text" name="datetime2" class="layui-input" id="datetime2"lay-verify="datetime2" placeholder="下课时间"  bind-hasFocus="true" readonly="true" >
                        </div>
                    </div>
                    <div class="layui-form-item jieshao">
                        <div class="layui-form-label">课程介绍 </div>
                        <span class="little-ts">*苹果手机暂不支持图文编辑，如有需要请登录电脑版微信客户端</span>
                        <div class="layui-form-block  fuwenben-bx">
                            <script id="container" name="le_intro" type="text/plain"></script>
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <div class="layui-label">总课时</div>
                        <div class="layui-form-block">
                            <input type="number" name="time" lay-verify="time" placeholder="请输入总课时数" autocomplete="off" class="layui-input">
                            <img src="<?php echo PUBLICPATH; ?>dier/img/closebtn.png" class="closebtn-input">
                        </div>

                    </div>
                    <div class="layui-form-item">
                        <div class="layui-label">人数上限</div>
                        <div class="layui-form-block">
                            <input type="number" name="max_limit" lay-verify="max_limit" placeholder="请输入课学生人数上限" autocomplete="off" class="layui-input">
                            <img src="<?php echo PUBLICPATH; ?>dier/img/closebtn.png" class="closebtn-input">
                        </div>

                    </div>
                    <div class="layui-form-item">
                        <div class="layui-label">课程收费</div>
                        <div class="layui-form-block">
                            <input type="number" name="fee" lay-verify="fee" placeholder="请输入课程收费" autocomplete="off" class="layui-input">
                            <img src="<?php echo PUBLICPATH; ?>dier/img/closebtn.png" class="closebtn-input">
                        </div>
                    </div>
                    <div class="layui-form-item upload-img">
                        <div class="layui-label">课程封面</div>
                        <input type="text" name="cover" value="" hidden>
                    </div>
                    <div class="outer-bx upload-img-bx" id="uploadcover">
                        <i class="layui-icon layui-icon-picture"></i>
                    </div>
                    <div class="img-show-bx" style="display:none">
                        <img src="https://rin.linovel.net/cover/20190409/100008_0_44547c21fb97eca247475bee9fb199c2.jpg!min300jpg">
                        <span class="reload">重新上传</span>
                    </div>
                    <div class="layui-form-item subbtn">
                        <div class="layui-form-block">
                            <button class="layui-btn jskkBtn" lay-submit lay-filter="subLesson">申请开课</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>

</html>
<!-- js -->
<?php $this->load->view('mobile2/jsweixin'); ?>
<script type='text/javascript' src="<?php echo PUBLICPATH; ?>dier/js/JsDepend/layui/layui.all.js"></script>
<script type="text/javascript" src="<?php echo PUBLICPATH; ?>yz/js/ueditor/ueditor.config.js"></script>
<!-- 编辑器源码文件 -->
<script type="text/javascript" src="<?php echo PUBLICPATH; ?>yz/js/ueditor/ueditor.all.js"></script>
<!-- 实例化编辑器 -->
<script type='text/javascript' src="<?php echo PUBLICPATH; ?>dier/js/index.js?t=<?php echo time();?>"></script>
<script type="text/javascript">
    // layui.use('laydate', function() {
    //     var laydate = layui.laydate;
    //     //执行一个laydate实例
    //     laydate.render({
    //         elem: '#date', //指定元素
    //         type: 'date'
    //     });
    //     laydate.render({
    //         elem: '#datetime1', //指定元素
    //         type: 'time'
    //     });
    //     laydate.render({
    //         elem: '#datetime2', //指定元素
    //         type: 'time'
    //     });
    // });
</script>