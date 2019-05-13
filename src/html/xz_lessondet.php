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
            <img src="<?=$class_pic?>">
            <!-- 2种情况 名额满了加样式 hadfull 报名结束+ hadover -->
            <span class="img-tag  <?=$sy ==0 ? 'hadfull' : "" ;?>">
                <?=$sy ==0 ? '名额已满' : "剩余：".$sy."人名额" ;?>
            </span>
        </div>
        <div class="lesson-det">
            <dt>
            </dt>
            <div class="detail-one">
                招生人数
                <?=$max_limit?>人 |
                    <?=$sy == 0 ? "满员了" : "报名中"; ?> |
                        <?=$time?>课时
            </div>
            <div class="feiyong-new mob_1px_b">
                <?=$fee == 0 ? "免费课程" : "￥".$fee;?>
            </div>

            <div class="detail-two mob_1px_b">
                <div class="det-item">
                    <i class="layui-icon layui-icon-read"></i>
                    <div class=" det-two-mid one-ellipsis">
                        <?=$target?>
                    </div>
                    <div class="det-two-tt">招生对象</div>
                </div>
                <div class="det-item">
                    <i class="layui-icon layui-icon-notice"></i>
                    <div class="det-two-mid one-ellipsis">
                        <?=$start_time?>
                    </div>
                    <div class="det-two-tt">开课时间</div>
                </div>
                <div class="det-item">
                    <i class="layui-icon layui-icon-log"></i>
                    <div class="det-two-mid one-ellipsis">
                        <?=$class_time?>
                    </div>
                    <div class="det-two-tt">上课时间</div>
                </div>
            </div>
            <div class="the-teacher ">
                <label for="teacher">任课老师</label>
                <div class="teacher-bx">
                    <img src="<?=$teacher['te_pic']?>" alt="<?=$teacher['name']?>">
                    <span>
                        <?=$teacher['name']?>
                    </span>
                </div>
            </div>
            <dd class="mob_1px_t">
                <?=$le_intro?>
            </dd>
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