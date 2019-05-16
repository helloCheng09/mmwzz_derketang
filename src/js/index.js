(function () {
    /**
     * 全局数据
     * data.js
     */
    var baseUrl = 'http://www.mamawozaizhe.com'
    var urlObj = {
        subNewLesson: '/mobile2/dier_lesson/index', // 教师提交新课程接口
        jsLessonList: '/mobile2/dier_lesson/pagelist',
        jzBuyLesson: '', // 家长购买课程
        xzSh: '/mobile2/dier_lesson/school_sh', // 校长审核新课程接口
        qiandaoUrl: '/api/exec_dier/sendqiandaoMsg', // 教师上课签到 1上课 2下课
        xzShSearch: '/mobile2/dier_lesson/schoollist_cx', // 搜索校长审核列表 keywords
        jzFenye: '/mobile2/dier_lesson/ajaxStudentLesson', // 家长选课列表
        startLesUrl: '/mobile2/dier_lesson/endlist', // 教师结束课程发布，正式开始上课
        deleLesUrl: '/mobile2/dier_lesson/del', // 教师删除课程
    };
    // 判断设备
    var u = navigator.userAgent;
    var isAndroid = u.indexOf('Android') > -1 || u.indexOf('Adr') > -1; //android终端
    var isiOS = !!u.match(/\(i[^;]+;( U;)? CPU.+Mac OS X/); //ios终端
    /****************************************************************************** */
    /**
     * 入口
     * index.js
     */
    if (document.getElementById('jsClassList')) {
        // 获取url参数type
        var url_type = (root.getQueryString('type'))
        console.log(url_type);
        // 上传图片到微信接口
        // 展示本地图片地址
        // 传微信服务器id给后台
        function uploadCover() {

            wx.chooseImage({
                count: 1, //最多可以选择的图片张数,
                success: res => {
                    // alert(JSON.stringify(res))
                    // 显示图片
                    $('#uploadcover').hide()
                    $('.img-show-bx img').attr('src', res.localIds[0])
                    $('.img-show-bx').show()
                    wx.uploadImage({
                        localId: res.localIds[0],
                        success: function (res2) {
                            var serverId = res2.serverId
                            // alert(JSON.stringify(res2))
                            // 插入图片微信服务器id
                            $("input[name='cover']").val(serverId)
                        }
                    })
                }, //返回图片的本地文件路径列表 tempFilePaths,
                fail: () => {},
                complete: () => {}
            });
        }
        $("#uploadcover").click(function () {
            uploadCover()
        })

        $('.reload').click(function () {
            $('#uploadcover').show()
            $('.img-show-bx').hide()
            // 清空图片值
            $("input[name='cover']").val('')
            uploadCover()

        })
        layui.use('laydate', function () {

            function getNowFormatDate() {
                var date = new Date();
                var seperator1 = "-";
                var year = date.getFullYear();
                var month = date.getMonth() + 1;
                var strDate = date.getDate();
                if (month >= 1 && month <= 9) {
                    month = "0" + month;
                }
                if (strDate >= 0 && strDate <= 9) {
                    strDate = "0" + strDate;
                }
                var currentdate = year + seperator1 + month + seperator1 + strDate;
                return currentdate;
            }
            var curDate = getNowFormatDate()
            console.log(curDate)
            var laydate = layui.laydate;
            //执行一个laydate实例
            laydate.render({
                elem: '#date', //指定元素
                type: 'date',
                min: curDate
            });
            laydate.render({
                elem: '#datetime1', //指定元素
                type: 'time',
                format: 'HH:mm' //可任意组合
            });
            laydate.render({
                elem: '#datetime2', //指定元素
                type: 'time',
                format: 'HH:mm' //可任意组合
            });
        });

        function IsPC() {
            var userAgentInfo = navigator.userAgent;
            var Agents = ["Android", "iPhone",
                "SymbianOS", "Windows Phone",
                "iPad", "iPod"
            ];
            var flag = true;
            for (var v = 0; v < Agents.length; v++) {
                if (userAgentInfo.indexOf(Agents[v]) > 0) {
                    flag = false;
                    break;
                }
            }
            return flag;
        }

        /**
         * 教师课程列表事件
         * @param {*} url 
         * @param {*} obj 
         */
        function jsClickEvent() {
            // 教师开启课程，结束购买流程
            $('.start-les').click(function () {
                var startLesUrl = baseUrl + urlObj.startLesUrl + '?type=' + url_type // 开始课程
                var deleLesUrl = baseUrl + urlObj.deleLesUrl + '?type=' + url_type // 删除课程
                var elem = $(this).parents('li')
                var le_id = elem.data('id')
                var islock = 1
                var data = {
                    islock: islock,
                    le_id: le_id,
                    type: url_type,
                }
                // 请求后台接口
                layer.confirm('确定结束发布，开始上课吗？', {
                    title: '妈妈我在-这第二课堂',
                    icon: 3,
                }, function () {
                    // 请求成功，删除这个元素
                    $.post(startLesUrl, data, function (res) {
                        if (res.code == 1) { // 成功开始课程
                            layer.msg(res.msg)
                            elem.remove()
                        } else if (res.code == 2) { // 开课失败
                            layer.alert(res.msg, function () {
                                layer.confirm('是否删除此课程？', {
                                    title: '妈妈我在-这第二课堂',
                                    icon: 3,
                                }, function () {
                                    // 请求后台 删除此课程
                                    $.post(deleLesUrl, data, function (res) {
                                        if (res.code == 1) {
                                            // 删除成功
                                            elem.remove()
                                        }
                                        layer.msg(res.msg)
                                    }, "JSON")
                                })
                            })

                        }
                    }, "JSON")
                })
            })

            // 教师查看课程详情跳转
            $('.link-href').click(function () {
                var href = $(this).data('href') + '?type=' + url_type
                window.location.href = href
            })
        }
        root.jsClickEvent = jsClickEvent
        var jsLessonUrl = baseUrl + urlObj.jsLessonList
        // 初始化显示已经审核的课程
        root.jsGetClassList(jsLessonUrl, {
            idEle: '#shenheguo',
            data: {
                ishidden: 1,
                type: url_type,
            },
        }, function () {
            // 执行回调
            root.jsClickEvent()
        })

        // 子选项卡
        layui.use('element', function () {
            var element = layui.element;
            // 选项卡监听
            element.on('tab(tab2)', function (data) {
                $('.tab-two .layui-tab-item').removeClass('layui-show')
                $(".tab-two .layui-tab-item:eq(" + data.index + ")").addClass('layui-show')
                root.curJsListType = data.index
                var idEle
                /**
                 *  ishidden= 0        待审核
                 *  ishidden= 1        已审
                 *  ishidden= 2        审核不通过
                 *  ishidden = 3      已经开始上课了
                 */

                switch (data.index) {
                    case 0:
                        idEle = '#daishenhe'
                        break;
                    case 1:
                        idEle = '#shenheguo'
                        break;
                    case 2:
                        idEle = '#weitongguo'
                        break;
                    case 3:
                        idEle = '#kaike'
                        break;
                }
                console.log(data.index)
                root.jsGetClassList(jsLessonUrl, {
                    idEle: idEle,
                    data: {
                        ishidden: data.index,
                        type: url_type,
                    }
                }, function () {
                    // 执行回调
                    root.jsClickEvent()
                })
            });
        });

        var html
        var editor
        var ispc = IsPC()
        if (!ispc) { // 是移动端
            if (isiOS) {
                // layer.alert("苹果手机暂不支持图文编辑，如有需要请登录电脑版微信客户端")
                html = `
                    <textarea name="le_intro" lay-verify="le_intro" placeholder="输入课程介绍"
                        class="layui-textarea mobile-hide" id=""></textarea>
                    <img src="${baseUrl}/public/dier/img/closebtn.png" class="closebtn-textarea mobile-hide">
                `
                $('.fuwenben-bx').empty().append(html)

            } else {
                editor = UE.getEditor('container');
            }
        } else {
            editor = UE.getEditor('container');
        }
        // 教师申请开课 
        layui.use('form', function () {
            // 清除danger 提示
            var form = layui.form
            form.verify({
                title: function (value, item) {
                    if (!value) {
                        $("input[name='title']").addClass('layui-form-danger')
                        root.removeDanger()
                        return ('未填写课程标题')
                    }
                },
                target: function (value, item) {
                    if (!value) {
                        $("input[name='target']").addClass('layui-form-danger')
                        root.removeDanger()
                        return ('未填写招生对象')
                    }
                },
                startdate: function (value, item) {
                    if (!value) {
                        $("input[name='startdate']").addClass('layui-form-danger')
                        root.removeDanger()
                        return ('未选择开课时间')
                    }
                },
                datetime1: function (value, item) {
                    if (!value) {
                        $("input[name='datetime1']").addClass('layui-form-danger')
                        root.removeDanger()
                        return ('未选择上课时间')
                    }
                },
                datetime2: function (value, item) {
                    if (!value) {
                        $("input[name='datetime2']").addClass('layui-form-danger')
                        root.removeDanger()
                        return ('未下课时间')
                    }
                },
                le_intro: function (value, item) {
                    if (!value) {
                        $("textarea[name='le_intro']").addClass('layui-form-danger')
                        root.removeDanger()
                        return ('未填写课程介绍')
                    }
                },
                time: function (value, item) {
                    if (!value) {
                        $("input[name='time']").addClass('layui-form-danger').focus(function () {
                            root.showFormClose("input[name='time']")
                            root.removeDanger()
                        })
                        root.removeDanger()
                        return ('未填写总课时')
                    }
                    if (value <= 0) {
                        return ('课时总数不正确')
                    }
                },
                max_limit: function (value, item) {
                    if (!value) {
                        $("input[name='max_limit']").addClass('layui-form-danger')
                        root.removeDanger()
                        return ('未填写人数上限')
                    }
                    if (value <= 0) {
                        $("input[name='max_limit']").addClass('layui-form-danger')
                        root.removeDanger()
                        return ('上课人数不正确')
                    }
                },

                fee: function (value, item) {
                    if (!value) {
                        $("input[name='fee']").addClass('layui-form-danger')
                        root.removeDanger()
                        return ('未填写课程收费')
                    }
                    if (value < 0) {
                        $("input[name='fee']").addClass('layui-form-danger')
                        root.removeDanger()
                        return ('课程收费不正确')
                    }
                    // if(value == 0) {
                    //     $("input[name='fee']").addClass('layui-form-danger')
                    //     return ('课程收费不能为0')
                    // }

                    // if (!new RegExp("^[0-9]*$").test(value)) {
                    //     return('只能是数字')
                    // }
                }

            })

            form.on('submit(subLesson)', function (data) {
                var formData = (data.field)
                if (!isiOS) {
                    formData.le_intro = editor.getContent();
                    if (!formData.le_intro) {
                        layer.msg('未填写课程介绍', {
                            icon: 5
                        })
                        return false
                    }
                }

                var url = baseUrl + urlObj.subNewLesson
                // console.log(formData)
                // alert(JSON.stringify(formData))
                root.postSubmit(url, {
                    data: formData,
                    source: 'subNewLesson'
                })
                // 防重复提交
                $('.jskkBtn').removeAttr('lay-submit')
                return false
            })

            root.showFormClose()
        })


    } else if (document.getElementById('qiandaowrap')) {
        var index
        $('html,body').ajaxStart(function () {
            index = layer.load(0, {
                shade: false
            }); //0代表加载的风格，支持0-2
        });
        $('html,body').ajaxStop(function () {
            layer.close(index)
        });
        // url获取课程id
        var le_id = root.getQueryString('le_id')
        // url获取教师id
        var te_id = root.getQueryString('te_id')
        // 全选反选事件
        root.easyxuanze()
        layui.use('form', function () {
            var form = layui.form
            // 上课提交
            // 验证课时数
            form.verify({
                keshiNum: function (val) {
                    if (!val) {
                        $(".num_lesson").addClass('layui-form-danger')
                        // 清除红色提字体
                        root.removeDanger()
                        return '请输入课时数！'
                    }
                },

                xiakeNum: function (val) {
                    if (!val) {
                        $(".xiakeNum").addClass('layui-form-danger')
                        // 清除红色提字体
                        root.removeDanger()
                        return '请输入下课时数！'
                    }
                }
            })

            form.on('submit(shangkeSub)', function (data) {
                var shangkeData = data.field
                var data = {} // 上课签到数据
                var url = baseUrl + urlObj.qiandaoUrl // 上课签到地址
                data = shangkeData
                data.num_lesson = shangkeData.num_lesson
                var num = 0
                // $.each(shangkeData, function (index, item) {
                //     num++
                // })
                data.le_id = le_id
                data.type = 1
                data.te_id = te_id
                console.log(data)
                // 请求
                console.log(tstext)
                var confirmText = '课时数：' + data.num_lesson + ' 节。<br>' + '是否确认提交本次上课签到记录？'
                var confirmBx = layer.confirm(confirmText, {
                    title: tstext,
                }, function () {
                    // 发送请求 发送上课签到消息
                    $.post(url, data, function (res) {
                        // var res = JSON.parse(res)
                        if (res.code == 1) {
                            // 成功
                            layer.msg(res.msg)
                            setTimeout(() => {
                                history.back(-1)
                            }, 1000);
                        } else {
                            layer.msg(res.msg)
                        }
                    }, "JSON")
                    layer.close(confirmBx)
                })
                return false
            })

            // 下课签到
            form.on('submit(xiakeSub)', function (data) {
                var shangkeData = data.field
                var data = {} // 下课签到数据
                var url = baseUrl + urlObj.qiandaoUrl // 下课签到地址
                data = shangkeData
                data.num_lesson = shangkeData.num_lesson
                // var num = 0
                // $.each(shangkeData, function (index, item) {
                //     num++
                // })
                data.le_id = le_id
                data.type = 2
                data.te_id = te_id
                console.log(data)
                // 请求
                var confirmText = '课时数：' + data.num_lesson + ' 节。<br>' + '是否确认提交本次下课签到记录？'
                var confirmBx = layer.confirm(confirmText, {
                    title: '妈妈我在-这第二课堂'
                }, function () {
                    // 发送请求 发送上课签到消息
                    $.post(url, data, function (res) {
                        if (res.code == 1) {
                            // 成功
                            layer.msg(res.msg)
                            setTimeout(() => {
                                history.back()
                            }, 1000);
                        } else {
                            layer.msg(res.msg)
                        }
                    }, "JSON")
                    layer.close(confirmBx)
                })
                return false
            })
            // form.on('checkbox(qdcheckbox)', fu   nction (e) {
            //     // console.log(e)
            // })
            // 清除数字按钮
            root.showFormClose()
        })

    } else if (document.getElementById('jzlessonlist')) {
        // 家长课程列表
        renderJzXkList()
        // 渲染家长端 选课列表
        function renderJzXkList() {
            var url = baseUrl + urlObj.jzFenye
            layui.use('flow', function () {
                var flow = layui.flow;
                flow.load({
                    elem: '#jzBuyList' //指定列表容器
                        ,
                    done: function (page, next) { //到达临界点（默认滚动触发），触发下一页
                        var lis = [];
                        //以jQuery的Ajax请求为例，请求下一页数据（注意：page是从2开始返回）
                        // $.get('/api/list?page='+page, function(res){
                        //   //假设你的列表返回在data集合中
                        //   layui.each(res.data, function(index, item){
                        //     lis.push('<li>'+ item.title +'</li>');
                        //   }); 

                        //   //执行下一页渲染，第二参数为：满足“加载更多”的条件，即后面仍有分页
                        //   //pages为Ajax返回的总页数，只有当前页小于总页数的情况下，才会继续出现加载更多
                        //   next(lis.join(''), page < res.pages);    
                        // });
                        let type = (root.getQueryString('type'));
                        $.post(url, {
                            page: +page, // 分页
                            type: type,
                        }, function (res) {
                            console.log(res)
                            var proccessArr = [] // 进程
                            var zhifuHtml = ''
                            var html = ''
                            var linkUrl = ''
                            layui.each(res.data, function (index, item) {
                                // 进程百分比 推入数组
                                var total = Number(item.max_limit)
                                var remainder = Number(item.count)
                                var percent = (100 - remainder / total * 100) + '%'
                                var proFliter = 'processEle_' + item.id
                                proccessArr.push({
                                    proFliter: proFliter,
                                    percent: percent
                                })
                                zhifuHtml = `
                                    <span class="zhifu">
                                        购买
                                    </span>
                                `
                                linkUrl = `
                                    /mobile2/dier_lesson/parent_xq?id=${item.id}&type=${type}
                                `
                                if (item.count == 0) {
                                    zhifuHtml = `
                                        <span class="mingeman">
                                            名额已满
                                        </span>
                                    `
                                    linkUrl = `
                                        javascript:void(0);
                                    `
                                }
                                var bean_fee = Number(item.fee) - Number(item.bean_fee) 

                                if (item.bean_html != "") {
                                    var shijiprice = `
                                        <div class="line-throught">
                                        ￥ ${item.fee} 
                                        </div>
                                        <div>
                                            <span class="zhehou-price">${item.bean_html}</span>
                                        </div>
                                    `
                                    
                                } else {
                                    var shijiprice = `
                                    <div class="">
                                            ￥ ${item.fee} 
                                    </div>
                                `
                                }

                                html = `
                                    <li class="lesson-item" data-id="22334">
                                        <a href="${linkUrl}">
                                            <img src="/public/dier/img/classroom_default_cover_vertical.png">
                                            <div class="right">
                                                <dt class="one-ellipsis">${item.title}</dt>
                                                <div class="sf-bx">
                                                    <span>
                                                        ${shijiprice} 
                                                    </span>
                                                    ${zhifuHtml}
                                                </div>
                                                <div class="max-num">
                                                    <div>
                                                        #剩余：${item.count} / ${item.max_limit}人
                                                    </div>
                                                    <div class="layui-progress" lay-filter="${proFliter}">
                                                        <div class="layui-progress-bar" lay-percent="${percent}"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                `
                                lis.push(html);
                            });
                            next(lis.join(''), page < res.pages);

                            layui.use('element', function () {
                                var element = layui.element;
                                console.log(proccessArr)
                                // 循环渲染进程百分比
                                proccessArr.forEach(item => {
                                    element.progress(item.proFliter, item.percent);
                                });
                                // element.progress('processEle', '50%');
                            });
                        }, "JSON")
                    }
                });
            });
        }

    } else if (document.getElementById('jzLessonDet')) {
        // 购买课程提交
    //    var ifchecked = $("input[name='fylock']").attr('checked')
    //    if (!ifchecked) {
    //         root.dylock = false //是否使用聪明豆抵扣现金
    //    } else {
    //         root.dylock = true //是否使用聪明豆抵扣现金
    //    }
    layui.use('form', function(){
            var form = layui.form;
            form.val("formTest", {
                // "username": "贤心" // "name": "value"
                // ,"sex": "女"
                // ,"auth": 3
                // ,"check[write]": true
                // ,"open": false
                // ,"desc": "我爱layui"
                "dylock": true,
            })
        //各种基于事件的操作，下面会有进一步介绍
      });
   
      root.dylock = true //是否使用聪明豆抵扣现金
        layui.use('form', function () {
            var form = layui.form;
            form.on('switch(dylock)', function (data) {
                root.dylock = data.elem.checked
                if (!root.dylock) {
                    // 不适用聪明豆抵扣
                    // 隐藏折扣价
                    $("#saleoffprice").hide()
                    $('#realprice').removeClass('line-through')
                } else {
                    $("#saleoffprice").show()
                    $('#realprice').addClass('line-through')
                }
            });
            //各种基于事件的操作，下面会有进一步介绍
        });

        var le_id = root.getQueryString('id')
        let type = (root.getQueryString('type'));
        // 获取课程收费 fee
        var shoufei = ($('.feiyong-new').text())
        if (shoufei == '免费课程') {
            var fee = '免费课程'
        } else {
            var fee = Number($('#realprice').text().split('￥')[1])
        }
        $('.jz-buy-btn').click(function () {
            console.log(root.dylock)

            var wallConfirm = layer.confirm('是否购买此课程？', ['确定', '取消'], function () {
                layer.close(wallConfirm)
                var buyLessonUrl = baseUrl + urlObj.buyLessonUrl
                var data = ''
                // alert('/mobile2/dier_lesson/student?le_id=' + le_id + '&fee=' + fee + '&type=' + type + '&dylock=' + root.dylock);
                window.location.href = '/mobile2/dier_lesson/student?le_id=' + le_id + '&fee=' + fee + '&type=' + type + '&dylock=' + root.dylock

                // layer.msg('购买车成功~', {
                //     icon: 1,
                //     time: 1500
                // })
            })
        })
    } else if (document.getElementById('xzlsDet')) {
        var id = root.getQueryString('id') // 要审核课程id
        var url = baseUrl + urlObj.xzSh
        // 通过课程
        $('.passLes').click(function () {
            console.log(id)
            $.post(url, {
                id: id,
                ishidden: 1, // 1 通过 0 拒绝
            }, function (res) {
                if (res.code == 1) {
                    // 成功
                    setTimeout(() => {
                        history.back(-1)
                    }, 1000);
                } else {
                    // 失败
                }
                layer.msg(res.msg)
            }, 'JSON')
        })
        // 拒绝课程
        $('.danger').click(function () {
            var xzcomfirm = layer.confirm('确定要决绝此课程吗？', {
                title: '第二课堂',
                icon: 3,
                closeBtn: 0,
            }, function (index) {
                layer.close(index)
                console.log('refuse')
                $.post(url, {
                    id: id,
                    ishidden: 2, // 1 通过 0 拒绝
                }, function (res) {
                    if (res.code == 1) {
                        // 成功
                        setTimeout(() => {
                            history.back(-1)
                        }, 1000);
                    } else {
                        // 失败
                    }
                    layer.msg(res.msg)
                }, 'JSON')
            })
        })
    } else if (document.getElementById('xzLessonList')) {
        // 校长搜索课程标题、教师姓名
        // 获取关键字 keywords    
        root.getKeyWords({
            delay: 1500,
            inputname: "keywords"
        }, getDsList)
        root.getKeyWords({
            delay: 1500,
            inputname: "done_keywords"
        }, getShList)
        // 校长列表对教师课程的搜索 请求
        // ishidden 待审核 0 审核过 1
        function getDsList(keywords) {
            if (keywords) {
                // 搜索关键字非空执行
                var url = baseUrl + urlObj.xzShSearch
                $.post(url, {
                    keywords: keywords,
                    ishidden: 0
                }, function (res) {
                    console.log(res)
                    if (res) {
                        renderXzdaishen({
                            elem: '#xzdsList',
                            data: res,
                            source: "daishen"
                        })
                    } else {
                        layer.msg("检索待审核课程失败~")
                    }
                }, "JSON")
            }
        }

        function getShList(keywords) {
            if (keywords) {
                // 搜索关键字非空执行
                var url = baseUrl + urlObj.xzShSearch
                $.post(url, {
                    keywords: keywords,
                    ishidden: 1
                }, function (res) {
                    if (res) {
                        renderXzshenhetou({
                            elem: '#xzshDone',
                            data: res,
                            source: "shenheguo"
                        })
                    } else {
                        layer.msg("检索审核记录失败~")
                    }
                }, "JSON")
            }
        }

        // 渲染待审核列表
        function renderXzdaishen(obj) {
            var elem = obj.elem
            var data = obj.data
            var html = ``

            data.forEach(item => {
                html += `
                <li class="lesson-item">
                    <a href="http://www.mamawozaizhe.com/mobile2/dier_lesson/school.html?id=${item.id}">
                        <img src="/public/dier/img/classroom_default_cover_vertical.png">
                        <div class="right">
                            <dt class="two-ellipsis">
                            【${item.teachername}老师】${item.title}                                     </dt>
                            <dd class="three-ellipsis">
                            ${item.le_intro}                                       </dd>
                            <div class="xz-ds">
                                <div>
                                    <div class="sf-bx">
                                        收费：
                                        ${item.fee} 元                                             </div>
                                    <div class="max-num">
                                        #人数上限：
                                        ${item.max_limit} 人
                                    </div>
                                </div>
                                <div class="waiting-les">
                                    <i class="layui-icon layui-icon-log"></i>
                                    <span>待审核</span>
                                </div>
                            </div>
                        </div>
                    </a>
                </li>
            `
            });
            // 插入插槽
            $(elem).empty().append(html).append('<li class="layui-flow-more">没有更多了</li>')
        }

        // 渲染审核过后列表
        function renderXzshenhetou(obj) {
            var elem = obj.elem
            var data = obj.data
            var html = ``
            // 循环获取搜索到的审核完成课程 数据内部直接是一个数组
            data.forEach(item => {
                // 课程状态
                var statusHtml = ``
                if (item.ishidden == '1') {
                    // 课程审核通过
                    statusHtml = ` 
                        <div class="waiting-les">
                            <img src="/public/dier/img/classroom_headmaster_img_pass@2x.png" class="sh-done">
                        </div>
                    `
                } else if (item.ishidden == '2') {
                    statusHtml = ` 
                    <div class="waiting-les">
                        <img src="/public/dier/img/classroom_headmaster_img_refuse@2x.png" class="sh-done">
                    </div>
                `
                }
                html += `
                <li class="lesson-item">
                    <a href="javascript:;">
                        <img src="/public/dier/img/classroom_default_cover_vertical.png">
                        <div class="right">
                            <dt class="two-ellipsis">
                            【${item.teachername}老师】${item.title}                                  
                            </dt>
                            <dd class="three-ellipsis">
                            ${item.le_intro}                                      
                            </dd>
                            <div class="xz-ds">
                                <div>
                                    <div class="sf-bx">
                                        收费：
                                        ${item.fee} 元                                             
                                    </div>
                                    <div class="max-num">
                                        #人数上限：
                                        ${item.max_limit} 人
                                    </div>
                                </div>
                                ${statusHtml}
                            </div>
                        </div>
                    </a>
                </li>
            `
            });

            // 插入插槽
            $(elem).empty().append(html).append('<li class="layui-flow-more">没有更多了</li>')


        }

    } else if (document.getElementById('jsQdList')) {}
}())