<!DOCTYPE html>
<html lang="zh_CN">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>家长查看签到情况</title>
    <!-- css -->
    <link rel="stylesheet" href="<?php echo PUBLICPATH; ?>dier/js/JsDepend/layui/css/layui.css">
    <link rel="stylesheet" href="<?php echo PUBLICPATH; ?>dier/css/index.css?t=<?php echo time();?>">
    <link rel="stylesheet" href="<?php echo PUBLICPATH; ?>dier/css/common.css?t=<?php echo time();?>">
    <!-- js -->
    <script type='text/javascript' src="<?php echo PUBLICPATH; ?>dier/js/JsDepend/jQuery.min.js"></script>
    <script type='text/javascript' src="<?php echo PUBLICPATH; ?>dier/js/wall-e.js?t=<?php echo time();?>"></script>
</head>

<body>
    <div id="jzqddet" class="my-com-lessondet" lesson-id="66">
        <div class="img-bx">
            <img src="<?php echo PUBLICPATH; ?>dier/img/kcfengmian.png">
            <!-- 2种情况 课程进行 hadfull 课程已结束+ hadover -->
            <span class="img-tag hadfull">
                课程进行中
            </span>
            <!-- <span class="img-tag hadover">
                报名已结束
            </span> -->
        </div>
        <div class="num-bx mob_1px_t">
            <span>#退款说明：退款金额 = 实付金额 - 已消耗课时(不含抵用金额)</span>
        </div>
        <div class="lesson-det">
            <dt>
               <?php echo $title; ?>
            </dt>
            <dd>
                <?php echo $le_intro; ?>
            </dd>
        </div>
        <div class="num-bx mob_1px_t">
            <span>#人数上限：<?php echo $max_limit; ?>人</span>
            <span>#剩余课时：<?php echo $count; ?>课时</span>
        </div>
        <div class="ks-list">
            <div class="ks-title mob_1px_b">课时数：<?php echo $time; ?>课时</div>
            <ul>
                <!-- 2种情况 已签到+done 未签到 -->
                <?php 
                foreach ($g as $k => $v) {
                ?>
                <li class="lsdone student-qd">
                    <div class="qd-det">
                        <div class="qd-item">
                            <div class="sk-qd"><?php
                            if($v['type']==1){
                            ?>上<?php }else{ ?>下<?php } ?>课时间: <?php echo date("Y-m-d H:i:s",$v['addtime']); ?></div>
                            <?php if ($v['status'] ==1) {
                             ?>
                             <span class="qd-text">未签到</span>
                         <?php }else{ ?>
                            <span class="qd-text done">已签到</span>
                        <?php } ?>
                        </div>
                    </div>
                </li>
            <?php } ?>


               <!--  <li class="lsdone student-qd">
                    <span class="ks-item-left">
                        第2课时
                    </span>
                    <div class="qd-det">
                        <div class="qd-item">
                            <div class="sk-qd">上课时间：2019-03-05 22:22:22</div>
                            <span class="qd-text done">已签到</span>
                        </div>
                        <div class="qd-item">
                            <div class="sk-qd">下课时间：2019-03-05 22:22:22</div>
                            <span class="qd-text done">已签到</span>
                        </div>
                    </div>
                </li> -->
            </ul>
        </div>
    </div>

</body>

</html>
<!-- js -->
<script type='text/javascript' src="<?php echo PUBLICPATH; ?>dier/js/JsDepend/layui/layui.all.js"></script>
<script type='text/javascript' src="<?php echo PUBLICPATH; ?>dier/js/index.js?t=<?php echo time();?>"></script>