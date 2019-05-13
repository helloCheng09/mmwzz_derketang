<!DOCTYPE html>
<html lang="zh_CN">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>教师课程详情</title>
    <!-- css -->
    <link rel="stylesheet" href="<?php echo PUBLICPATH; ?>dier/js/JsDepend/layui/css/layui.css">
    <link rel="stylesheet" href="<?php echo PUBLICPATH; ?>dier/css/index.css?t=<?php echo time();?>">
    <link rel="stylesheet" href="<?php echo PUBLICPATH; ?>dier/css/common.css?t=<?php echo time();?>">
    <!-- js -->
    <script type='text/javascript' src="<?php echo PUBLICPATH; ?>dier/js/JsDepend/jQuery.min.js"></script>
    <script type='text/javascript' src="<?php echo PUBLICPATH; ?>dier/js/wall-e.js?t=<?php echo time();?>"></script>
</head>

<body>

    <div id="jsLessonDet" class="my-com-lessondet">
        <div class="img-bx">
            <img src="<?php echo PUBLICPATH; ?>dier/img/kcfengmian.png">
            <!-- 3种情况 名额满了加样式 hadfull 报名结束+ hadover -->
            <?php
            if ($sy != 0) {
                ?>
                <span class="img-tag">
                    剩余：
                    <?php echo $sy; ?>人名额
                </span>
                <?php
            } else {
                ?>
                    <span class="img-tag hadfull">
                        名额已满
                    </span>
                    <?php
            } ?>
                        <!-- <span class="img-tag hadover">
                报名已结束
            </span> -->
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
            <span>#人数上限：
                <?php echo $max_limit; ?>人</span>
            <span class="money-num">收费：
                <?php echo $fee; ?>元</span>
        </div>
        <div class="ks-list">
            <div class="ks-title mob_1px_b">课时数：
                <?php echo $time; ?>课时</div>
           <!--  <ul> -->
                <!-- 两种情况 已经上的课加 lsdone -->
            <!--     <?php
                  //$timedq=5;
                  //for ($n=1;$n< $timedq;$n++) {
                      ?> -->
               <!--      <li class="lsdone">
                        <span class="ks-item-left">
                            第
                            <?php //echo $n; ?>课时
                        </span>
                        <span class="ks-item-right ">
                            已结束
                        </span>
                    </li> -->
                  <!--   <?php
                 // }

           // if ($timedq==0) {
               // $timedq=1;
            //}
            //for ($i=$timedq; $i <=$time ; $i++) {
                ?> -->
             <!--            <li class="">
                            <span class="ks-item-left">
                                第
                                <?php //echo $i; ?>课时
                            </span>
                            <span class="ks-item-right ">
                                未开始
                            </span>
                        </li>
                        <?php
            //} ?> -->





                            <!-- <li  class="lsdone">
                    <span class="ks-item-left">
                        第2课时
                    </span>
                    <span class="ks-item-right ">
                        已结束
                    </span>
                </li>
                <li  class="">
                    <span class="ks-item-left">
                        第3课时
                    </span>
                    <span class="ks-item-right ">
                        未开始
                    </span>
                </li>
                <li>
                    <span class="ks-item-left">
                        第4课时
                    </span>
                    <span class="ks-item-right ">
                        未开始
                    </span>
                </li>
                <li>
                    <span class="ks-item-left">
                        第5课时
                    </span>
                    <span class="ks-item-right ">
                        未开始
                    </span>
                </li>
                <li>
                    <span class="ks-item-left">
                        第6课时
                    </span>
                    <span class="ks-item-right">
                        未开始
                    </span>
                </li> -->
            </ul>
        </div>
    </div>

</body>

</html>
<!-- js -->
<script type='text/javascript' src="<?php echo PUBLICPATH; ?>dier/js/JsDepend/layui/layui.all.js"></script>
<script type='text/javascript' src="<?php echo PUBLICPATH; ?>dier/js/index.js?t=<?php echo time();?>"></script>