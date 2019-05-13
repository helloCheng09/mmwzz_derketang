<!DOCTYPE html>
<html lang="zh_CN">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>校长审核课程详情</title>
    <!-- css -->
    <link rel="stylesheet" href="<?php echo PUBLICPATH; ?>dier/js/JsDepend/layui/css/layui.css">
    <link rel="stylesheet" href="<?php echo PUBLICPATH; ?>dier/css/index.css?t=<?php echo time();?>">
    <link rel="stylesheet" href="<?php echo PUBLICPATH; ?>dier/css/common.css?t=<?php echo time();?>">
    <!-- js -->
    <script type='text/javascript' src="<?php echo PUBLICPATH; ?>dier/js/JsDepend/jQuery.min.js"></script>
    <script type='text/javascript' src="<?php echo PUBLICPATH; ?>dier/js/wall-e.js?t=<?php echo time();?>"></script>
</head>

<body>

    <div id="xzlsDet" class="my-com-lessondet" lesson-id="66">
        
        <div class="img-bx">
            <img src="<?php echo PUBLICPATH; ?>dier/img/kcfengmian.png">
            <!-- 3种情况 名额满了加样式 hadfull 报名结束+ hadover -->
            <?php if ($sy != 0) {
            ?>
            <span class="img-tag">
                剩余：<?php echo $sy; ?>人名额
            </span>
        <?php }else{ ?>
            <span class="img-tag hadfull">
                名额已满
            </span>
        <?php } ?>

            <!-- <span class="img-tag hadover">
                报名已结束
            </span> -->
        </div>
        <div class="lesson-det">
            <dt>
                <?php echo $title; ?>
            </dt>
            <dd>
                <?php echo ($le_intro) ; ?>
            </dd>
        </div>
        <div class="num-bx mob_1px_t">
            <span>#人数上限：<?php echo $max_limit; ?>人</span>
            <span class="money-num">收费：<?php echo $fee; ?>元</span>
        </div>
        <div class="ks-list">
            <div class="ks-title mob_1px_b">课时数：<?php echo $time; ?>课时</div>
        </div>
        <div class="xzsh-btns">
            <button class="layui-btn xzshbtn passLes">通过</button>
            <button class="layui-btn xzshbtn danger">拒绝</button>
        </div>

    </div>

</body>

</html>
<!-- js -->
<script type='text/javascript' src="<?php echo PUBLICPATH; ?>dier/js/JsDepend/layui/layui.all.js"></script>
<script type='text/javascript' src="<?php echo PUBLICPATH; ?>dier/js/index.js?t=<?php echo time();?>"></script>