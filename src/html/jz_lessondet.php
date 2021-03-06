<!DOCTYPE html>
<html lang="zh_CN">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>家长课程详情</title>
    <!-- css -->
    <link rel="stylesheet" href="<?php echo PUBLICPATH; ?>dier/js/JsDepend/layui/css/layui.css">
    <link rel="stylesheet" href="<?php echo PUBLICPATH; ?>dier/css/StyleDepend/swiper.min.css">
    <link rel="stylesheet" href="<?php echo PUBLICPATH; ?>dier/css/index.css?t=<?php echo time();?>">
    <link rel="stylesheet" href="<?php echo PUBLICPATH; ?>dier/css/common.css?t=<?php echo time();?>">
    <!-- js -->
    <script type='text/javascript' src="<?php echo PUBLICPATH; ?>dier/js/JsDepend/jQuery.min.js"></script>
    <script type='text/javascript' src="<?php echo PUBLICPATH; ?>dier/js/JsDepend/swiper.min.js"></script>
    <script type='text/javascript' src="<?php echo PUBLICPATH; ?>dier/js/wall-e.js?t=<?php echo time();?>"></script>
</head>

<body>

    <div id="jzLessonDet" class="my-com-lessondet">
        <div class="img-bx ">
            <img src="<?php echo PUBLICPATH; ?>dier/img/kcfengmian.png">
            <!-- 两种情况 名额满添加样式hadfull -->
            <span class="img-tag  <?=$sy ==0 ? 'hadfull' : "" ;?>">
                <?=$sy ==0 ? '名额已满' : "剩余：".$sy."人名额" ;?>
            </span>
        </div>
        <div class="lesson-det">
            <div class="detail-one">
                招生人数 <?=$max_limit?>人 | <?=$sy == 0 ? "满员了" : "报名中"; ?> |  <?=$time?>课时
            </div>
            <div class="feiyong-new mob_1px_b">
                <span id="saleoffprice" class="">
                    <?php $trueFee = $fee-$bean_fee;?>
                  实付: <?=$fee == 0 ? "免费课程" : "￥".$trueFee;?>
                </span>
                <span id="realprice" class="line-through">
                  原价:<?=$fee == 0 ? "免费课程" : "￥".$fee;?> 
                </span>
                 <div class="dy-text-ts">
                    <span>
                        <?php if($bean_switch == '2'){echo $bean_num."个聪明豆可抵用".$bean_fee.'元';}?>
                    </span>
                    <div class="layui-form" lay-filter="formTest">
                        <div class="layui-form-item">
                            <div class="layui-input-block switch-btn">
                                <input type="checkbox" checked=""   name="dylock"  lay-skin="switch" lay-filter="dylock"
                                    lay-text="使用|不使用">
                            </div>
                        </div>
                    </div>
                </div>
           
        </div>

            <div class="detail-two mob_1px_b">
                <div class="det-item">
                    <i class="layui-icon layui-icon-read"></i>
                    <div class=" det-two-mid one-ellipsis"><?=$target?></div>
                    <div class="det-two-tt">招生对象</div>
                </div>
                <div class="det-item">
                    <i class="layui-icon layui-icon-notice"></i>
                    <div class="det-two-mid one-ellipsis"><?=$start_time?></div>
                    <div class="det-two-tt">开课时间</div>
                </div>
                <div class="det-item">
                    <i class="layui-icon layui-icon-log"></i>
                    <div class="det-two-mid one-ellipsis"><?=$class_time?></div>
                    <div class="det-two-tt">上课时间</div>
                </div>
            </div>
            <div class="the-teacher ">
                <label for="teacher">任课老师</label>
                <div class="teacher-bx">
                    <img src="<?=$teacher['te_pic']?>">
                    <span><?=$teacher['name']?></span>
                </div>
            </div>
            <dd class="mob_1px_t">
                <?=$le_intro?>
            </dd>
        </div>
        <div class="jz-buy-btn layui-btn layui-btn-radius layui-btn-warm ">
            立即购买
        </div>
    </div>

</body>

</html>
<!-- js -->
<script type='text/javascript' src="<?php echo PUBLICPATH; ?>dier/js/JsDepend/layui/layui.all.js"></script>
<script type='text/javascript' src="<?php echo PUBLICPATH; ?>dier/js/index.js?t=<?php echo time();?>"></script>