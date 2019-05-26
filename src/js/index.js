(function (wall) {
    var baseUrl = "http://www.mamawozaizhe.com";
    var indexUrl = "/api/index/sundryStatics";
    var chartUrl = "/api/index/ajaxCharts";
    /**
     * Limit Public
     * Bind wall
     */
    wall.extend({
        show: function () {
            console.log('hello world')
        },
        myName: "xiaoxoxo"
    })

    // 入口
    if (document.getElementById('jfindexwrap')) {
        // 缴费统计首页
        indexwrap();
         // 切换学校
         layui.use('form', function () {
            var form = layui.form;
            form.on('select(school)', function(data){
                console.log(data.value); //得到被选中的值
                var url = baseUrl + indexUrl;
                window.location.href = url + '?school_id=' + data.value;
            });
        });
    }

    /**
     * Functions
     * #1 indexwrap
     */



    // login
    function indexwrap() {
        var maxnum  = 60;
        var url = baseUrl + chartUrl;
        var school_id = $('#school_id').val();
        $.post(url, {
            school_id: school_id
        }, function (data) {
            console.log(data['charts']);
            var data = data['charts'];
            // var data = [{
            //     label: '六年级.',
            //     type: '已缴费人数',
            //     value: 500
            // }, {
            //     label: '六年级.',
            //     type: '未缴费人数',
            //     value: 20
            // }, {
            //     label: '五年级.',
            //     type: '已缴费人数',
            //     value: 542
            // }, {
            //     label: '五年级.',
            //     type: '未缴费人数',
            //     value: 15
            // }, {
            //     label: '四年级.',
            //     type: '已缴费人数',
            //     value: 414
            // }, {
            //     label: '四年级.',
            //     type: '未缴费人数',
            //     value: 55
            // }, {
            //     label: '三年级.',
            //     type: '已缴费人数',
            //     value: 762
            // }, {
            //     label: '三年级.',
            //     type: '未缴费人数',
            //     value: 10
            // }, {
            //     label: '二年级.',
            //     type: '已缴费人数',
            //     value: 456
            // }, {
            //     label: '二年级.',
            //     type: '未缴费人数',
            //     value: 3
            // }, {
            //     label: '一年级.',
            //     type: '已缴费人数',
            //     value: 511
            // }, {
            //     label: '一年级.',
            //     type: '未缴费人数',
            //     value: 36
            // }];
            console.log(data);
            loadCharts(data);
        },'json');


        function loadCharts(data) {
            var staticnum = Number(data.length) * 20
            // console.log(staticnum)
            var chart = new F2.Chart({
                id: 'mountNode',
                pixelRatio: window.devicePixelRatio,
                height: staticnum,
            });

            chart.source(data.reverse(), {
                value: {
                    tickInterval: maxnum / 2
                }
            });
            chart.coord({
                transposed: true
            });

            chart.tooltip({
                custom: true, // 自定义 tooltip 内容框
                onChange: function onChange(obj) {
                    var legend = chart.get('legendController').legends.top[0];
                    var tooltipItems = obj.items;
                    var legendItems = legend.items;
                    var map = {};
                    legendItems.map(function (item) {
                        map[item.name] = _.clone(item);
                    });
                    tooltipItems.map(function (item) {
                        var name = item.name;
                        var value = item.value;
                        if (map[name]) {
                            map[name].value = value;
                        }
                    });
                    legend.setItems(_.values(map));
                },
                onHide: function onHide() {
                    var legend = chart.get('legendController').legends.top[0];
                    legend.setItems(chart.getLegendItems().country);
                }
            });
            chart.axis('label', {
                line: F2.Global._defaultAxis.line,
                grid: null
            });
            chart.axis('value', {
                line: null,
                grid: F2.Global._defaultAxis.grid,
                label: function label(text, index, total) {
                    var textCfg = {};
                    if (index === 0) {
                        textCfg.textAlign = 'left';
                    } else if (index === total - 1) {
                        textCfg.textAlign = 'right';
                    }
                    return textCfg;
                }
            });
            chart.interval().position('label*value').color('type').adjust({
                type: 'dodge',
                marginRatio: 1 / 32
            });
            chart.render();
        }
    }


})(window.wall || (window.wall = {}))