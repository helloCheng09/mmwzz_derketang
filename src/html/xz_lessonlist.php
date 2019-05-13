<!DOCTYPE html>
<html lang="zh_CN">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>校長課程列表</title>
    <!-- css -->
    <link rel="stylesheet" href="<?php echo PUBLICPATH; ?>dier/js/JsDepend/layui/css/layui.css">
    <link rel="stylesheet" href="<?php echo PUBLICPATH; ?>dier/css/common.css?t=<?php echo time();?>">
    <link rel="stylesheet" href="<?php echo PUBLICPATH; ?>dier/css/index.css?t=<?php echo time();?>">
    <!-- js -->
    <script type='text/javascript' src="<?php echo PUBLICPATH; ?>dier/js/JsDepend/jQuery.min.js"></script>
    <script type='text/javascript' src="<?php echo PUBLICPATH; ?>dier/js/wall-e.js?t=<?php echo time();?>"></script>
</head>

<body>

    <div class="my-com-lessondet" id="xzLessonList">
        <div class="layui-tab " lay-filter="tab1">
            <div class="head-bx">
                <ul class="layui-tab-title head-con">
                    <li class="layui-this head-tag left">待审课程</li>
                    <li class="head-tag right ">审核记录</li>
                </ul>
            </div>

            <div class="layui-tab-content">
                <div class="layui-tab-item tab-two layui-show">
                    <div class="search-bx">
                        <div class="search-item">
                            <i class="layui-icon layui-icon-search"></i>
                            <input type="text" name="keywords" placeholder="搜索课程标题/教师姓名" autocomplete="off" class="layui-input">
                        </div>
                    </div>
                    <ul class="flow-default js-sh-list" id="xzdsList">
                        <?php foreach ($school_list as $k => $v) {
    ?>
                        <li class="lesson-item">
                            <a href="<?php echo site_url('mobile2/dier_lesson/school?id='.$v['id'])?>">
                                <img src="<?php echo PUBLICPATH; ?>dier/img/classroom_default_cover_vertical.png">

                                <div class="right">
                                    <dt class="two-ellipsis">
                                        【<?php echo $v['teachername']; ?>老师】
                                        <?php echo $v['title']; ?>
                                    </dt>
                                    <dd class="three-ellipsis">
                                    <?php echo strip_tags(trim($v['le_intro'])) ; ?>
                                    </dd>
                                    <div class="xz-ds">
                                        <div>
                                            <div class="sf-bx">
                                                收费：
                                                <?php echo $v['fee']; ?>
                                            </div>
                                            <div class="max-num">
                                                #人数上限：
                                                <?php echo $v['max_limit']; ?>人
                                            </div>
                                        </div>
                                        <div class="waiting-les">
                                            <i class="layui-icon layui-icon-log"></i>
                                            <span>待审核</span>
                                        </div>
                                    </div>
                                </div>

                            </a>
                        </li>
                        <?php
} ?>

                            <li class="layui-flow-more">没有更多了</li>
                    </ul>
                </div>
                <div class="layui-tab-item  ">
                    <div class="search-bx">
                        <div class="search-item">
                            <i class="layui-icon layui-icon-search"></i>
                            <input type="text" name="done_keywords" placeholder="搜索课程标题/教师姓名" autocomplete="off" class="layui-input">
                        </div>
                    </div>
                    <!-- 2种情况 校长通过 pss图片 校长拒绝 refuse图片  -->
                    <ul class="flow-default js-sh-list" id="xzshDone">
                        <?php foreach ($shenhe_list as $k => $v) {
        ?>
                        <li class="lesson-item">
                            <a href="javascript:;">
                                <img src="<?php echo PUBLICPATH; ?>dier/img/classroom_default_cover_vertical.png">
                                <div class="right">
                                    <dt class="two-ellipsis">
                                        【
                                        <?php echo $v['teachername1']; ?>老师】
                                        <?php echo $v['title']; ?>
                                    </dt>
                                    <dd class="three-ellipsis">
                                    <?php echo strip_tags(trim($v['le_intro'])) ; ?>
                                    </dd>
                                    <div class="xz-ds">
                                        <div>
                                            <div class="sf-bx">
                                                收费：
                                                <?php echo $v['fee']; ?>
                                            </div>
                                            <div class="max-num">
                                                #人数上限：
                                                <?php echo $v['max_limit']; ?>人
                                            </div>
                                        </div>
                                        <?php if ($v['ishidden'] ==1) {
            ?>
                                        <div class="waiting-les">
                                            <img src="<?php echo PUBLICPATH; ?>dier/img/classroom_headmaster_img_pass@2x.png" class="sh-done">
                                        </div>
                                        <?php
        } ?>
                                            <?php if ($v['ishidden'] ==2) {
            ?>
                                            <div class="waiting-les">
                                                <img src="<?php echo PUBLICPATH; ?>dier/img/classroom_headmaster_img_refuse@2x.png" class="sh-done">
                                            </div>
                                            <?php
        } ?>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <?php
    } ?>
                            <li class="layui-flow-more">没有更多了</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

</body>

</html>
<!-- js -->
<script type='text/javascript' src="<?php echo PUBLICPATH; ?>dier/js/JsDepend/layui/layui.all.js"></script>
<script type='text/javascript' src="<?php echo PUBLICPATH; ?>dier/js/index.js?t=<?php echo time();?>"></script>