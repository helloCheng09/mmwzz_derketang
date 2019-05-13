<!DOCTYPE html>
<html lang="zh_CN">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>教师签到管理列表</title>
    <!-- css -->
    <link rel="stylesheet" href="<?php echo PUBLICPATH; ?>dier/js/JsDepend/layui/css/layui.css">
    <link rel="stylesheet" href="<?php echo PUBLICPATH; ?>dier/css/common.css?t=<?php echo time();?>">
    <link rel="stylesheet" href="<?php echo PUBLICPATH; ?>dier/css/index.css?t=<?php echo time();?>">
    <!-- js -->
    <script type='text/javascript' src="<?php echo PUBLICPATH; ?>dier/js/JsDepend/jQuery.min.js"></script>
    <script type='text/javascript' src="<?php echo PUBLICPATH; ?>dier/js/wall-e.js?t=<?php echo time();?>"></script>
</head>

<body>

    <div id="jsQdList">
        <div class="layui-tab " lay-filter="tab1">
            <div class="head-bx">
                <ul class="layui-tab-title head-con">
                    <li class="layui-this head-tag left">课程签到管理</li>
                </ul>
            </div>

            <div class="layui-tab-content">
                <div class="layui-tab-item tab-two layui-show">
                    <div class="layui-tab-content two-main-screen">
                        <div class="layui-tab-item layui-show">
                            <ul class="flow-default js-sh-list" id="shenheguo">
                                <?php


                                foreach ($lesson_list as $k => $v) {
                                    if ($v['islock'] !=0 && $v['ishidden'] ==1) {
                                        ?>
                                    <li class="lesson-item">
                                        <div class="lesson-link">
                                            <img src="<?php echo PUBLICPATH; ?>dier/img/classroom_default_cover_vertical.png">
                                            <div class="right">
                                                <dt class="one-ellipsis">
                                                    <?php echo $v['title']; ?>
                                                </dt>
                                                <dd class="three-ellipsis">
                                                    <a href="<?php echo site_url('/mobile2/dier_lesson/teacher_xq?id='.$v['id'])?>">
                                                        <?php echo strip_tags($v['le_intro']); ?>
                                                    </a>
                                                </dd>
                                                <?php
                                             $le_id = $v['id'];
                                        $qu = $this->db->where('le_id', $le_id)->get('dier_time')->row_array();
                                        if ($qu) {
                                            $time = $qu['time'];
                                            $time_dq = $qu['time_dq'];
                                            $sy = $time-$time_dq;
                                        } else {
                                            $sy = $v['time'];
                                        } ?>
                                                    <div class="qd-gl">
                                                        <div>
                                                            <div class="sf-bx">
                                                                剩余:
                                                                <?php echo $sy; ?>课时
                                                            </div>
                                                            <div class="max-num">
                                                                #学生数：
                                                                <?php echo $v['count']; ?>人
                                                            </div>
                                                        </div>
                                                        <div class="r-btns">
                                                            <div class="right-btn-link layui-btn ">
                                                                <a href="<?php echo site_url('mobile2/dier_lesson/lelist?te_id='.$te_id.'&le_id='.$v['id'])?>">
                                                                    签到管理
                                                                </a>
                                                            </div>
                                                            <div class="right-btn-link layui-btn link-fazuoye">
                                                                <a href="<?php echo site_url('mobile2/teacher/workTest_dier?memberid=62&type=1&dierle_id='.$v['id'])?>">
                                                                    发布作业
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                            </div>
                                        </div>
                                    </li>
                                    <?php
                                    } ?>
                                        <?php
                                } ?>
                                            <li class="layui-flow-more">没有更多了</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>
<!-- js -->
<script type='text/javascript' src="<?php echo PUBLICPATH; ?>dier/js/JsDepend/layui/layui.all.js"></script>
<script type='text/javascript' src="<?php echo PUBLICPATH; ?>dier/js/index.js?t=<?php echo time();?>"></script>