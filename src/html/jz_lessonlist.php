<!DOCTYPE html>
<html lang="zh_CN">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>家长课程列表</title>
    <!-- css -->
    <link rel="stylesheet" href="<?php echo PUBLICPATH; ?>dier/js/JsDepend/layui/css/layui.css">
    <link rel="stylesheet" href="<?php echo PUBLICPATH; ?>dier/css/index.css?t=<?php echo time();?>">
    <link rel="stylesheet" href="<?php echo PUBLICPATH; ?>dier/css/common.css?t=<?php echo time();?>">
    <!-- js -->
    <script type='text/javascript' src="<?php echo PUBLICPATH; ?>dier/js/JsDepend/jQuery.min.js"></script>
    <script type='text/javascript' src="<?php echo PUBLICPATH; ?>dier/js/wall-e.js?t=<?php echo time();?>"></script>
</head>

<body>

    <div id="jzlessonlist">
        <div class="layui-tab" lay-filter="tab1">
            <div class="head-bx">
                <ul class="layui-tab-title head-con">
                    <li class="layui-this head-tag left">课程列表</li>
                    <li class="head-tag right">我的课程</li>
                </ul>
            </div>
            <div class="layui-tab-content two-main-screen">
                <div class="layui-tab-item  layui-show">
                    <ul class="flow-default js-sh-list" id="jzBuyList">
                        <!-- 家长选课列表 插槽 -->
                    </ul>

                </div>

                <div class="layui-tab-item ">
                    <ul class="flow-default js-sh-list" id="jzcheckList">
                        <?php foreach ($le_list as $k => $v) {
    ?>
                        <li class="lesson-item " data-id="">
                            <a href="<?php echo site_url('mobile2/dier_lesson/parent_qd?id='.$v['id'].'&type='.$type)?>">
                                <img src="<?php echo PUBLICPATH; ?>dier/img/classroom_default_cover_vertical.png">
                                <div class="right">
                                    <dt class="one-ellipsis">
                                        <?php echo $v['title']; ?>
                                    </dt>
                                    <dd class="three-ellipsis">
                                        <?php echo strip_tags(trim($v['le_intro'])) ; ?>
                                    </dd>
                                    <?php
                                     $query = $this->db->where('id', $v['te_id'])->get('teacher')->row_array(); ?>
                                        <div class="sf-bx">
                                            教师：
                                            <?php echo $query['name']; ?>
                                        </div>
                                        <div class="max-num">
                                            <div class="check-num">
                                                <div>
                                                    #剩余课时：
                                                    <?php if ($v['time_sy']!=0) {
                                                     ?>
                                                    <?php echo $v['time_sy']; ?>课时
                                                <?php }else{ ?>
                                                    <?php echo $v['time']; ?>课时
                                                <?php } ?>

                                                </div>
                                                <div class="check-qd">
                                                    查看签到 →
                                                </div>
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
            </div>
        </div>
    </div>

</body>

</html>
<!-- js -->
<script type='text/javascript' src="<?php echo PUBLICPATH; ?>dier/js/JsDepend/layui/layui.all.js"></script>
<script type='text/javascript' src="<?php echo PUBLICPATH; ?>dier/js/index.js?t=<?php echo time();?>"></script>
<script>
</script>