<!DOCTYPE html>
<html lang="zh_CN">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo $schooler_id == '0' ? '第二课堂' : '空中少年宫';?>教师签到</title>
    <!-- css -->
    <link rel="stylesheet" href="<?php echo PUBLICPATH; ?>dier/js/JsDepend/layui/css/layui.css">
    <link rel="stylesheet" href="<?php echo PUBLICPATH; ?>dier/css/index.css?t=<?php echo time();?>">
    <link rel="stylesheet" href="<?php echo PUBLICPATH; ?>dier/css/common.css?t=<?php echo time();?>">
    <!-- js -->
    <script type='text/javascript' src="<?php echo PUBLICPATH; ?>dier/js/JsDepend/jQuery.min.js"></script>
    <script type='text/javascript' src="<?php echo PUBLICPATH; ?>dier/js/wall-e.js?t=<?php echo time();?>"></script>
</head>

<body>

<div id="qiandaowrap">
    <div class="layui-tab" lay-filter="tab1">
        <div class="head-bx">
            <ul class="layui-tab-title head-con">
                <li class="layui-this head-tag left">上课签到</li>
                <li class="head-tag right ">下课签到</li>
            </ul>
        </div>

        <div class="layui-tab-content">
            <div class="layui-tab-item layui-show">
                <div class="control-bx">
                    <div class="tt">
                        学生列表
                    </div>
                    <div class="control-right">
                        <span class="fanxuan">反选</span>
                        <span class="quanxuan">全选</span>
                    </div>
                </div>
                <div class="layui-form skform">
                    <div class="layui-form-item">
                        <div class="layui-input-block checkbox-pn" id="qdform">
                            <?php foreach ($query as $key => $v) {?>
                                <?php $arr = $this->db->where('id', $v['student_id'])->get('student')->row_array(); ?>
                                <input type="checkbox" lay-filter="qdcheckbox" value="<?php echo $v['student_id']; ?>" name="students[]" lay-skin="primary"
                                       title="<?php echo $arr['name']; ?>" checked>
                            <?php }?>
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <div class="layui-form-label">
                            输入课时
                        </div>
                        <div class="layui-form-block">
                            <input type="number" placeholder="输入签到的课时数" lay-verify="keshiNum" class="layui-input num_lesson" autocomplete="off" name="num_lesson">
                            <img src="<?php echo PUBLICPATH; ?>dier/img/closebtn.png" class="closebtn-input">
                        </div>
                    </div>
                    <div class="layui-form-item btn-item">
                        <div class="layui-input-block">
                            <button class="layui-btn" lay-submit lay-filter="shangkeSub">发送上课签到消息</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="layui-tab-item ">
                <div class="control-bx">
                    <div class="tt">
                        学生列表
                    </div>
                    <div class="control-right">
                        <span class="fanxuan">反选</span>
                        <span class="quanxuan">全选</span>
                    </div>
                </div>
                <div class="layui-form skform">
                    <div class="layui-form-item">
                        <div class="layui-input-block checkbox-pn" id="qdform">
                            <?php foreach ($query as $key => $v) {
                                ?>
                                <?php
                                //查询学生表找到学生姓名
                                $arr = $this->db->where('id', $v['student_id'])->get('student')->row_array(); ?>
                                <input type="checkbox" lay-filter="qdcheckbox" value="<?php echo $v['student_id']; ?>" name="students[]" filter="qdcheckbox"
                                       lay-skin="primary" title="<?php echo $arr['name']; ?>" checked>
                                <?php
                            } ?>
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <div class="layui-form-label">
                            课时数
                        </div>
                        <div class="layui-form-block">
                            <?php if ($num_lesson > 0) {
                                ?>
                                <input type="number" placeholder="输入签到的课时数" lay-verify="xiakeNum" class="layui-input xiakeNum" autocomplete="off" name="num_lesson"
                                       value="<?php echo $num_lesson; ?>" disabled>
                            <?php }else{ ?>
                                <input type="number" placeholder="输入签到的课时数" lay-verify="xiakeNum" class="layui-input xiakeNum" autocomplete="off" name="num_lesson">
                            <?php } ?>
                        </div>
                        <img src="<?php echo PUBLICPATH; ?>dier/img/closebtn.png" class="closebtn-input">
                    </div>
                    <div class="layui-form-item btn-item">
                        <div class="layui-input-block">
                            <button class="layui-btn" lay-submit lay-filter="xiakeSub">发送下课签到消息</button>
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
<script>
    // 区别签到类型 
    // 0 第二课堂 1 空中少年宫
    var tstext ="妈妈我在这-" + "<?php echo $schooler_id == '0' ? '第二课堂' : '空中少年宫';?>"
    
</script>
<script type='text/javascript' src="<?php echo PUBLICPATH; ?>dier/js/JsDepend/layui/layui.all.js"></script>
<script type='text/javascript' src="<?php echo PUBLICPATH; ?>dier/js/index.js?t=<?php echo time();?>"></script>