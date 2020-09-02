/**
 * surface 表单
 *
 * @author zsw zswemail@qq.com
 */

!function (e, t) {
    "object" == typeof exports && "undefined" != typeof module ? t(exports, require("vue")) : "function" == typeof define && define.amd ? define(["exports", "vue"], t) : t((e = e || self).FormSurface = {}, e.Vue)
}(this, function (exports, Vue) {
    "use strict"

    function _defineProperties(e, t) {
        for (var r = 0; r < t.length; r++) {
            var n = t[r];
            n.enumerable = n.enumerable || !1, n.configurable = !0, "value" in n && (n.writable = !0), Object.defineProperty(e, n.key, n)
        }
    }

    function hookInject(w){
        var _h = {}
        return _defineProperties(_h, [{
            key: 'set',value:function (k, v) {_defineProperties(w, [{key: k, value: v}])}
        },{
            key: 'has',value:function (k) {return Object.prototype.hasOwnProperty.call(w, k)}
        },{
            key: 'handle',value:function (k) {
                var l = arguments.length, n = new Array(l - 1);
                if(l > 1) for (let i = 1; i < l; i++) n[i - 1] = arguments[i];
                return _h.has(k) ? w[k].apply({}, n) : null
            }
        }]), _h
    }

    function markInit () {
        var m = document.querySelectorAll('[mark]')
        var desc,deep = 1
        m.forEach((v) => {
            desc = v.mark
            if (!desc) {
                desc = v.getAttribute('mark')
            }
            let span = document.createElement('div')
            span.innerHTML = desc
            span.className = "z-marker"
            var n = v.parentElement
            while (deep < 4) {
                if ('el-form-item__content'.indexOf(n.classList) >= 0) {
                    n.appendChild(span)
                    break
                }
                n = n.parentNode
                deep++
            }
            deep = 1
        })
    }

    function _createForm(_h) {
        function updateQueryStringParam(uri, key, value = null) {
            if (uri) {
                if (typeof key == 'string' && value !== null) {
                    var re = new RegExp("([?&])" + key + "=.*?(&|$)", "i");
                    var separator = uri.indexOf('?') !== -1 ? "&" : "?";
                    if (uri.match(re)) {
                        return uri.replace(re, '$1' + key + "=" + value + '$2');
                    } else {
                        return uri + separator + key + "=" + value;
                    }
                } else if (typeof key == 'object') {
                    for (let k in key) {
                        uri = updateQueryStringParam(uri, k, key[k])
                    }
                }
            }
            return uri;
        }

        let load = false
        function request(c = {}, success = null, error = null, fail = null, final = null){
            if (load) return;
            load = true;
            let options = Object.assign({}, {
                url: '',
                data: {},
                method: 'post',
                responseType: "json",
                timeout: 3000,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                },
            }, c)
            return axios(options).then((a) => {
                let data = a.data || ''
                if (data.code === 0) {
                    success && success(data)
                } else {
                    error && error(data)
                }
            }).catch((e) => {
                let msg
                if (typeof e === 'string') {
                    msg = e
                } else if (e.response) {
                    switch (e.response.status) {
                        case 400:
                            msg = '请求参数错误';
                            break
                        case 401:
                            msg = '未授权，请登录';
                            break
                        case 403:
                            msg = '跨域拒绝访问';
                            break;
                        case 404:
                            msg = `请求地址出错: ${e.response.config.url}`;
                            break;
                        case 408:
                            msg = '请求超时';
                            break;
                        case 500:
                            msg = '服务器内部错误' + e.message;
                            break;
                        case 501:
                            msg = '服务未实现';
                            break;
                        case 502:
                            msg = '网关错误';
                            break;
                        case 503:
                            msg = '服务不可用';
                            break;
                        case 504:
                            msg = '网关超时';
                            break;
                        case 505:
                            msg = 'HTTP版本不受支持';
                            break;
                        default:
                            msg = e.message || '系统错误'
                            break;
                    }
                } else {
                    msg = '系统错误: ' + e.toString()
                }
                fail && fail(e, msg)
            }).finally(() => {
                load = false
                final && final()
            });
        }

        function styleInject(e, t) {
            void 0 === t && (t = {});
            var r = t.insertAt;
            if (e && "undefined" != typeof document) {
                var n = document.head || document.getElementsByTagName("head")[0],
                    i = document.createElement("style");
                i.type = "text/css", "top" === r && n.firstChild ? n.insertBefore(i, n.firstChild) : n.appendChild(i), i.styleSheet ? i.styleSheet.cssText = e : i.appendChild(document.createTextNode(e))
            }
        }

        function selVal(keys, option, val) { // 深度赋值children
            let l = keys.length
            for (let i in keys) {
                l--
                for (let n in option) {
                    if (option[n].value == keys[i]) {
                        if (l == 0) {
                            option[n].children = val
                        } else {
                            option[n].children = selVal(keys.slice(1), option[n].children, val)
                        }
                        return option
                    }
                }
            }
        }

        function createComponent(components){
            return function (c) {
                c.forEach(function (e) {
                    Vue.component(e.name, e)
                })
            }(components)
        }

        var EDITOR_NAME = "editor", EDITOR_DATA = {
            name: EDITOR_NAME,
            render(h){
                return h('textarea', {"name": this.name}, [this.value])
            },
            data() {
                return {}
            },
            props: {
                value: String,
                name: String,
                theme: {
                    type: String,
                    default: "black"
                },
                items: Array,
                editorUploadUrl: String,
                editorManageUrl: String,
                editorMediaUrl: String,
                editorFlashUrl: String,
                editorFileUrl: String
            },
            methods: {},
            mounted() {
                KindEditor.ready((K) => {
                    K.create('textarea[name="' + this.name + '"]', {
                        items: this.items ? this.items : [
                            'source', 'undo', 'redo', 'preview', 'print', 'template', 'code', 'quote', 'selectall', 'cut', 'copy', 'paste', 'plainpaste', 'wordpaste', 'quickformat',
                            '/', 'image', 'multiimage', 'graft', 'flash', 'media', 'insertfile', 'table', 'hr', 'emoticons', 'baidumap', 'pagebreak', 'anchor', 'link', 'unlink', 'fullscreen', 'removeformat', 'clearhtml',
                            '/', 'justifyleft', 'justifycenter', 'justifyright', 'justifyfull', 'insertorderedlist', 'insertunorderedlist', 'indent', 'outdent', 'subscript',
                            'superscript', 'formatblock', 'fontname', 'fontsize', 'forecolor', 'hilitecolor', 'bold', 'italic', 'underline', 'strikethrough', 'lineheight'
                        ],
                        width: '100%',
                        filePostName: 'file',
                        uploadJson: updateQueryStringParam(this.editorUploadUrl, 'from', 'editor'),
                        fileManagerJson: updateQueryStringParam(this.editorManageUrl, 'from', 'editor'),
                        allowImageUpload: this.editorManageUrl ? true : false,
                        allowMediaUpload: this.editorMediaUrl ? true : false,
                        allowFileUpload: this.editorFileUrl ? true : false,
                        allowFileManager: this.editorFileUrl ? true : false,
                        allowFlashUpload: this.editorFlashUrl ? true : false,
                        allowFlashManage: this.editorFlashUrl ? true : false,
                        themeType: this.theme,
                        afterChange: () => {
                            this.$emit('input', $('textarea[name="' + this.name + '"]').val());
                        },
                        errorMsgHandler: (message, type) => {
                            if (type === 'ok') {
                                this.$message.success(message);
                            } else {
                                this.$message.error(message);
                            }
                        }
                    });
                });
            }
        },JSON_NAME='json',JSON_DATA={
            name: JSON_NAME,
            template: `<div>
                            <el-row>
                                <el-col :span="8"><b>键名</b></el-col>
                                <el-col :span="12" style="margin-left: 6px"><b>键值</b></el-col>
                            </el-row>
                            <el-row v-for="(v, k) in values" :key="k">
                                <el-col :span="8">
                                    <el-input size="small" v-model="v.key" @change="textChange"></el-input>
                                </el-col>
                                
                                <el-col :span="12" style="margin-left: 6px">
                                    <el-input size="small" v-model="v.val" @change="textChange"></el-input>
                                </el-col>
                                
                                <el-col :span="2" :offset="1">
                                    <i class="el-icon-delete" @click.stop="delVal(k)"></i>
                                </el-col>
                            </el-row>
                            <el-row>
                                <el-col :span="2" :offset="1">
                                    <i class="el-icon-circle-plus" style="font-size: 25px;color: #353535" @click.stop='values.splice(values.length,0, {key:"",val:""})'></i>
                                </el-col>
                            </el-row>
                            </div>`,
            data() {
                return {
                    values: null
                }
            },
            props: {
                value: [String, Number],
                name: String,
                placeholder: String,
            },
            methods: {
                textChange() {
                    this.$emit('input', this.parseV(this.values));
                },
                delVal(k) {
                    this.values.splice(k, 1) && this.textChange()
                },
                parseJ(j) {
                    let _d = []
                    try {
                        for (let k in j) {
                            _d.push({
                                key: k,
                                val: j[k],
                            })
                        }
                    } catch (e) {
                    }
                    return _d;
                },
                parseV(o) {
                    let _d = {}
                    try {
                        for (let k in o) {
                            if (o[k].key) {
                                _d[o[k].key] = o[k].val
                            }
                        }
                    } catch (e) {
                    }
                    return JSON.stringify(_d);
                },
                strIsJson(str) {
                    if (typeof str == 'string') {
                        try {
                            var obj = JSON.parse(str);
                            return obj;
                        } catch (e) {
                            return false;
                        }
                    } else if (typeof str == 'object') {
                        return str;
                    }
                    return false;
                }
            },
            created() {
                let _v = this.strIsJson(this.value) || (this.values = {"": ""})
                this.values = this.parseJ(_v)
            }
        },components = [EDITOR_DATA, JSON_DATA];

        createComponent(components)

        function rule(r, vm){
            var _check = (c) => {
                switch (c.type) {
                    case 'cascader':
                        if (c.props.options && typeof(c.props.options) == 'string') { // 加载外部资源
                            let result = /(\w+)\((.*)\)/.exec(c.props.options);
                            if (result.length !== 3) {
                                c.props.options = []
                            }
                            switch (result[1]) {
                                case 'eval':
                                    c.props.options = eval(result[2])
                                    break;
                            }
                        } else if (c.props.lazy) { // 异步加载
                            c.on = {
                                'active-item-change': value => {
                                    let url = c.props.url || ''
                                    let params = c.props.params || {}
                                    params.value = value
                                    request({
                                        url: url,
                                        data: params,
                                        method: 'post'
                                    }, (res) => {
                                        if (res.code === 0) {
                                            c.props.options = selVal(value, c.props.options, res.data)
                                        } else {
                                            throw res.msg
                                        }
                                    }, (r) => {
                                        vm.$message.error(r.msg || '返回数据格式错误');
                                    }, (e, msg) => {
                                        vm.$message.error(msg);
                                    })
                                }
                            }

                            c.props.multiple = true
                        }
                        break;
                    case 'frame':
                        isNaN(c.props.maxLength) && (c.props.maxLength = 1)
                        c.props.modal = {modal: false}
                        if (c.props.src === undefined) {
                            vm.$message.error('未配置frame src属性');
                            c.props.src = '';
                        }
                        c.props.src = updateQueryStringParam(c.props.src, {
                            _field: c.field,
                            _limit: c.props.maxLength || 1,
                            _type: c.props.type,
                        })
                        if (c.value == undefined || c.value == '') {
                            c.value = []
                        } else if (typeof c.value == "number" || typeof c.value == "string") {
                            c.value = [c.value]
                        }
                        const e = this;

                        let _fromHandle = false
                        let _defaultSrc = c.props.src
                        c.props.unique = false

                        c.props.onHandle = function (v) {
                            const h = this.$createElement;
                            if (this.type == 'image') {
                                e.$msgbox({
                                    title: '图片',
                                    message: h('p', {style: {padding: "10px 5px"}}, [
                                        h("img", {style: {width: "100%"}, attrs: {src: v}}),
                                    ]),
                                    center: true
                                });
                            } else if (this.type == 'file' || this.type == 'input') {
                                _fromHandle = true
                                if (c.props.unique != false) {
                                    $f.model()[c.field].props.src = updateQueryStringParam(_defaultSrc, 'pk', v)
                                }
                                this.showModel()
                            }
                        }

                        c.props.onOpen = () => {
                            if (!_fromHandle) {
                                $f.model()[c.field].props.src = _defaultSrc
                            }
                            _fromHandle = false
                        }

                        c.props.onOk = () => {
                            let frame = document.querySelector('iframe[src="' + c.props.src + '"]')
                            if (frame.contentWindow.$t && frame.contentWindow.$t.v.checkList) {
                                var oldV = c.value.concat(frame.contentWindow.$t.v.checkList)
                                if (!Array.isArray(oldV)) {
                                    oldV = [oldV]
                                }
                                if (c.props.unique != false) { // 只允许选中一次
                                    var res = [];
                                    var obj = {};
                                    for (var i = 0; i < oldV.length; i++) {
                                        if (!obj[oldV[i]]) {
                                            obj[oldV[i]] = 1;
                                            res.push(oldV[i]);
                                        }
                                    }
                                    oldV = res;
                                }
                                if (c.props.maxLength > 0 && oldV.length > c.props.maxLength) {
                                    vm.$message.error(`只能选取${c.props.maxLength}个`);
                                    return false;
                                }
                                c.value = oldV
                            }
                        }
                        break;
                    case 'upload':
                        const _v = vm
                        c.props.data || (c.props.data = {})
                        if (!c.props.data.type) {
                            c.props.data.type = c.props.uploadType
                        }
                        c.props.onSuccess = (r, f, fl) => {
                            if (r.code === 0) {
                                f.url = r.data.url
                            } else {
                                _v.$message.error(f.name + " " + (r.msg || "上传失败"));
                                fl.pop()
                            }
                        }
                        c.props.onError = (r, f, fl) => {
                            _v.$message.error('上传失败, 【 ' + r + ' 】');
                        }
                        if (c.props.manageShow) {
                            var manageShowClick = (event) => {
                                if (event) {
                                    event.stopPropagation ? event.stopPropagation() : event.cancelBubble = true;
                                }
                                let id = 'manageImg' + Date.now()
                                c.props.manageUrl = updateQueryStringParam(c.props.manageUrl, {
                                    _field: c.field,
                                    _type: c.props.data.type,
                                    _limit: c.props.limit,
                                })

                                _v.$confirm(_v.$createElement("iframe", {
                                    attrs: {src: c.props.manageUrl, class: 'manage-img', id: id}
                                }), '图库', {
                                    confirmButtonText: '确定',
                                    showCancelButton: false,
                                    customClass: 'upload-box',
                                    dangerouslyUseHTMLString: true,
                                }).then(action => {
                                }).catch(r => {
                                })
                            }
                            c.children = [
                                {
                                    type: "div",
                                    slot: "tip",
                                    class: "fc-upload-btn",
                                    children: [{
                                        type: "i",
                                        class: "el-icon-folder",
                                    }],
                                    on: {
                                        click: manageShowClick
                                    }
                                }
                            ]
                        }
                        break;
                    case 'json':
                        c.props.name = c.field
                        break;
                    case 'editor':
                        c.props.name = c.field
                        break;
                }
                return c
            }
            var _checkRule = (c) => {
                if (c.type == 'tab') {
                    c.type = 'el-tabs'
                    c.value || (c.children[0] && (c.value = c.children[0].name))
                    var children;
                    for (let ch in c.children) {
                        children = {}
                        children.type = 'el-tab-pane'
                        children.name = c.children[ch].name
                        children.props = {label: c.children[ch].title, name: c.children[ch].name}
                        for (let child in c.children[ch].children) {
                            c.children[ch].children[child] = _checkRule(c.children[ch].children[child])
                        }
                        children.children = c.children[ch].children
                        c.children[ch] = children
                    }
                } else {
                    c = _check(c)
                }
                return c;
            }
            r.forEach(d => {
                d = _checkRule(d)
            });
            return r;
        }

        function getCreateForm(el, c, r, vm, global)
        {
            let _form = vm.$formCreate(r, Object.assign({
                el: el || document.body,
                mounted: ($f) => {
                    if (parent != self) {
                        _h.set('submitHook', () => {
                            return $f.submit()
                        })
                    }
                },
                onSubmit: (formData) => {
                    let options = {
                        url: c.url,
                        data: formData,
                        method: c.type,
                        responseType: "json",
                        timeout: 3000,
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                        },
                    }
                    return request(options, (data) => {
                        // 触发当前页|上级页面事件页面
                        if (_h.handle('selfSubmitHook', data, _form) === true) {
                            return;
                        }
                        if (parent.submitHook && parent.submitHook(data, _form) === true) {
                            return;
                        }
                        vm.$message.success(data.msg);
                    }, (r) => {
                        vm.$message.error(r.msg || '提交失败');
                    }, (e, msg) => {
                        vm.$message.error(msg);
                    })
                },
                form: c.form,
                row: c.row,
                submitBtn: c.submitBtn,
                resetBtn: c.resetBtn
            }, global));
            markInit()
            return _form
        }

        function _style(el){
            var css = `@media screen and (max-height: 768px) {.el-dialog{margin-top:10px !important;}}.el-dialog__body{padding: 0px;}.wrapper{padding: 0px;}.upload-box{width:98%;max-width:970px;max-height:620px;}.upload-box .manage-img{width:100%;max-height:500px;height:74vh;border:none;}.el-button{border-radius:0px;}.el-input__inner{border-radius:0px}.el-form-item__content{margin-left: 100px;}.el-form-item .el-form-item{margin-bottom:5px}.ivu-input,.ivu-select-selection{border-radius:0}.ql-formats{line-height:normal}body{margin:0px}${el}{background-color:white;padding:20px;min-height:calc(100vh - 40px)}.z-marker{padding: 3px 0px;line-height:15px;margin-bottom: 0;font-style: italic;font-size: 12px;color: #a4a4a4;}.v-modal{background: rgba(241,243,246, .8)}.el-message-box{box-shadow: 0 2px 12px 0 rgba(0,0,0,.3);}`
            styleInject(css)
        }

        return function () {
            return {
                register: createComponent,
                render: function (el, c, r, global = {}) { // 渲染
                    var vm = new Vue
                    return _style(el || 'body'), getCreateForm(el, c, rule(r, vm), vm, global)
                }
            }
        }()
    }

    "undefined" != typeof window && (window.FormSurface = _createForm(hookInject(window)));
});
