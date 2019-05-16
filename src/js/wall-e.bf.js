(function () {
    /**
     * 全局数据
     * data.js
     */
        
    /****************************************************************************** */
    /**
     * 初始化
     * init.js
     */
    (function ($, root) {
        /**
         * 教师端 流加载
         * url 请求地址
         * obj（data 请求参数）
         */
        function jsGetClassList(url, obj, callback) {
            var data = obj.data
            // var type =  root.getQueryString('type')// 获取地址中的type参数
            $(obj.idEle).empty()
            layui.use('flow', function () {
                var flow = layui.flow;
                flow.load({
                    elem: obj.idEle, //流加载容器
                    done: function (page, next) { //执行下一页的回调
                        data.page = +page
                        // console.log(data)
                        // data.type = type
                        //模拟数据插入
                        var lis = [];
                        $.post(url, data, function (res) {
                            var mydata = JSON.parse(res)
                            // console.log(mydata)
                            if (!mydata.data) {
                                return false
                            }
                            var dataArr = mydata.data
                            // 只有审核通过的课程才有开始上课按钮
                            var startHtml = ''
                            var goumaiNumHtml =  ''
                            dataArr.forEach(v => {
                                if (obj.idEle == '#shenheguo') { // 只有审核通过的课程才有开始上课按钮
                                    if (v.schooler_id == 0) {
                                        startHtml = `
                                            <span class="start-les">开始上课</span>
                                         `
                                    }
                                    goumaiNumHtml = `
                                        #人数上限：${v.max_limit}人 #购买人数：${v.count}人
                                    `

                                } else {
                                    goumaiNumHtml = `
                                        #人数上限：${v.max_limit}人
                                    `
                                }
                                lis.push(`
                                    <li class="lesson-item" data-id="${v.id}">
                                        <a href="javascript:void(0);" class="lesson-link">
                                            <div class="right">
                                                <div class="link-href"  data-href="/mobile2/dier_lesson/teacher_xq?id=${v.id}" >
                                                    <dt class="one-ellipsis"> ${v.title}</dt>
                                                    <dd class="three-ellipsis">
                                                    ${v.le_intro}
                                                    </dd>
                                                </div>
                                            
                                                <div class="sf-bx">
                                                    收费：￥ ${v.fee}
                                                </div>
                                                <div class="max-num">
                                                    ${goumaiNumHtml}
                                                    ${startHtml}
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                `)
                            });
                            //执行下一页渲染，第二参数为：满足“加载更多”的条件，即后面仍有分页
                            //pages为Ajax返回的总页数，只有当前页小于总页数的情况下，才会继续出现加载更多
                            next(lis.join(''), page < mydata.pages);
                            // 执行回调函数
                            callback()
                        });

                        return false
                    }
                });
            });
        }

        root.jsGetClassList = jsGetClassList

    }(window.$, window.myLib || (window.myLib = {})));

    /****************************************************************************** */
    /**
     * 事件委托
     * delegate.js
     */
    (function ($, root) {
        function getQueryString(name) {
            var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)");
            var r = window.location.search.substr(1).match(reg);
            if (r != null) return unescape(r[2]);
            return null;
        }
        root.getQueryString = getQueryString
        // 去除提示红框
        function removeDanger() {
            $('.layui-form-danger').focus(function () {
                $(this).removeClass('layui-form-danger')
            })
        }
        root.removeDanger = removeDanger
        // ele $input 显示清除按钮
        function showFormClose() {
            $('.layui-form-item').each(function () {
                var _self = $(this)
                var _input = _self.find('input')
                var _textarea = _self.find('textarea')
                if (_input.length) {
                    _input.focus(function () {
                        _self.find('.layui-form-block img').show()
                    }).blur(function () {
                        setTimeout(() => {
                            _self.find('.layui-form-block img').hide()
                        }, 500);
                    })
                    _self.find('.layui-form-block img').click(function () {
                        _input.val('')
                    })
                } else if (_textarea.length) {
                    _textarea.focus(function () {
                        _self.find('.layui-form-block img').show()
                    }).blur(function () {
                        setTimeout(() => {
                            _self.find('.layui-form-block img').hide()
                        }, 500);
                    })
                    _self.find('.layui-form-block img').click(function () {
                        _textarea.val('')
                    })
                }
            })
        }
        root.showFormClose = showFormClose

        // 教师提交签到 
        // 全选 + 反选
        function easyxuanze() {
            // 上课反选
            $('.fanxuan').click(function (e) {
                $(this).parents('.layui-tab-item').find('.checkbox-pn input').each(function () {
                    if ($(this).attr('checked')) {
                        // 去掉选中样式
                        $(this).next('.layui-form-checkbox').removeClass('layui-form-checked')
                        // input 加checked
                        $(this).prop('checked', false)
                    } else {
                        // 添加选中样式
                        $(this).next('.layui-form-checkbox').addClass('layui-form-checked')
                        $(this).prop('checked', true)
                    }
                })
                e.preventDefault()
                return false
            })
            // 全选
            $('.quanxuan').click(function () {
                $(this).parents('.layui-tab-item').find('.checkbox-pn').find('input').each(function () {
                    // layui美化dom加样式
                    $(this).parents('.layui-tab-item').find('.layui-form-checkbox').addClass('layui-form-checked')
                    $(this).prop('checked', 'checked')
                })
            })
        }
        root.easyxuanze = easyxuanze

        // 防抖 搜索值获取
        function getKeyWords(obj, callback) {
            // 清除定时器
            var timer
            $("input[name='" + obj.inputname + "']").keydown(function () {
                var _self = $(this)
                if (timer) {
                    clearTimeout(timer)
                }
                timer = setTimeout(() => {
                    // 执行回调
                    callback(_self.val())
                }, obj.delay);
            })
            return root.kw
        }
        root.getKeyWords = getKeyWords

    }(window.$, window.myLib || (window.myLib = {})));

    /****************************************************************************** */
    /**
     * 获取
     * getData.js
     */
    (function ($, root) {
        // alert(1)
        var loginAni
        // obj => {url, data, source}
        let postSubmit = (url, obj) => {
            $.ajax({
                url: url,
                data: obj.data,
                type: 'POST',
                dataType: 'JSON',
                beforeSend: function () {
                    // 加载中
                    if (obj.source == 'login') {
                        loginAni = layer.load(4)
                    } else if (obj.source === 'register') {
                        loginAni = layer.load(4)
                    }
                },
                success: (res) => {
                    if (obj.source == 'subNewLesson') {
                        // alert(JSON.stringify(res))
                        if (res.code == 1) {
                            // 成功提交
                            layer.msg('申请提交成功')
                            setTimeout(() => {
                                window.location.reload()
                            }, 1000);
                        } else {
                            layer.msg('申请开课失败~请重新提交')
                            $('.jskkBtn').attr('lay-submit')
                        }
                    }
                },
                fail: (res) => {
                    layer.msg('服务器报错了~')
                }
            })
        }

        root.postSubmit = postSubmit

         function getQueryString (name) {
            var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)");
            var r = window.location.search.substr(1).match(reg);
            if (r != null) return unescape(r[2]);
            return null;
        }
        root.getQueryString = getQueryString

    }(window.$, window.myLib || (window.myLib = {})));
    /****************************************************************************** */
    /**
     * 渲染
     * render.js
     */
    (function ($, root) {}(window.$, window.myLib || (window.myLib = {})));
    /****************************************************************************** */
}())
var root = window.myLib;