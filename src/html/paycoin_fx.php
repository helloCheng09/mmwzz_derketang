<!DOCTYPE html>
<html lang="zh-CN">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
<title>支付中心</title>
<link rel="stylesheet" href="<?php echo CSSPATH.HOMEPATH;?>/index.css">
</head>
<body>
<header class="container">
</header>
<section class="container" id="buylesson">
    <div class="adr">
        <div class="adr-item fix">
            <div class="adr-item-info">
                <h3><?php echo $goodsname; ?></h3>
                <div class="adr-item-num">
                    <b>￥<label class="price"><?php echo $totalPrice; ?></label></b>
                   
                </div>
            </div>
        </div>
        <div class="total">
            <p>总价格为：<span><label id="total"><?php echo $totalPrice ?></label>元</span></p>
        </div>
    </div>
</section>
<section class="container">
    <div class="paymet">
        <!--<h2>支付方式</h2>-->
        <div class="paymet-a">
            <a href="javascript:;" onClick="callpay();" class="webpay">微信支付</a>
        </div>
    </div>
</section>
</body>
</html>
<script src="<?php echo JSPATH.HOMEPATH;?>jquery.min.js"></script>
<script language="javascript">
    function getQueryString (name) {
        var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)");
        var r = window.location.search.substr(1).match(reg);
        if (r != null) return unescape(r[2]);
        return null;
    }
    

    function jsApiCall()
    {
        var type = getQueryString('type') // 获取参数type
        WeixinJSBridge.invoke(
            'getBrandWCPayRequest',<?php echo $package;?>,
            function (res) {
                WeixinJSBridge.log(res.err_msg);
                if (res.err_msg == 'get_brand_wcpay_request:ok')
                {
                    window.location.href ='http://www.mamawozaizhe.com/mobile2/dier_lesson/studentLesson?type=' + type;
                } else {
                    WeixinJSBridge.log('支付失败，请点击[微信支付]重试');
                }
//                alert(res.err_code + res.err_desc + res.err_msg);
            }
        );
    }
    function callpay()
    {
        if (typeof WeixinJSBridge == "undefined") {
            if (document.addEventListener) {
                document.addEventListener('WeixinJSBridgeReady', jsApiCall, false);
            } else if (document.attachEvent) {
                document.attachEvent('WeixinJSBridgeReady', jsApiCall);
                document.attachEvent('onWeixinJSBridgeReady', jsApiCall);
            }
        } else {
            jsApiCall();
        }
    }
</script>
<?php $this->load->view(HOMEPATH . "jssdk"); ?>