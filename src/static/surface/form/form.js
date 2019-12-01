;(function (w) {
    "use strict"
    w.submitHook = false;
    let load = false
    let FormSurface = function(e, c, r, p = {}) {
        this.e = e
        this.c = c
        this.init()
        this.component()
        this.vm = new Vue
        this.r = this._b(r)
        return this._a(p)
    }

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

    var request = (c = {}, success = null, error = null, fail = null, final = null) => {
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
            }else{
                msg = '系统错误: ' + e.toString()
            }
            fail && fail(e, msg)
        }).finally(() => {
            load = false
            final && final()
        });
    }

    FormSurface.prototype = {
        constructor: FormSurface,
        selVal(keys, option, val) { // 深度赋值children
            let l = keys.length
            for (let i in keys) {
                l--
                for(let n in option) {
                    if(option[n].value == keys[i]) {
                        if(l == 0) {
                            option[n].children = val
                        }else{
                            option[n].children = this.selVal(keys.slice(1), option[n].children, val)
                        }
                        return option
                    }
                }
            }
        },
        init(){
            let style = document.createElement("style");
            style.type = "text/css";
            style.innerText = `@media screen and (max-height: 768px) {.el-dialog{margin-top:10px !important;}}.el-dialog__body{padding: 0px;}.wrapper{padding: 0px;}.upload-box{width:98%;max-width:970px;max-height:620px;}.upload-box .manage-img{width:100%;max-height:500px;height:74vh;border:none;}.el-button{border-radius:0px;}.el-input__inner{border-radius:0px}.el-form-item__content{margin-left: 100px;}.el-form-item .el-form-item{margin-bottom:5px}.ivu-input,.ivu-select-selection{border-radius:0}.ql-formats{line-height:normal}${this.e}{background-color:white;padding:5px}.z-marker{padding: 3px 0px;line-height:15px;margin-bottom: 0;font-style: italic;font-size: 12px;color: #a4a4a4;}`
            document.querySelector('head').appendChild(style);
        },
        component(){
            let self = this
            Vue.component('editor', {
                template: `<div><textarea :name="name">{{value}}</textarea></div>`,
                data() {
                    return {
                    }
                },
                props: {
                    value : String,
                    name  : String,
                    theme : {
                        type: String,
                        default: "black"
                    },
                    items: Array,
                    editorUploadUrl  : String,
                    editorManageUrl  : String,
                    editorMediaUrl  : String,
                    editorFlashUrl  : String,
                    editorFileUrl  : String
                },
                methods:{},
                mounted(){
                    KindEditor.ready((K) => {
                        K.create('textarea[name="'+this.name+'"]', {
                            items: this.items ? this.items : [
                                'source', 'undo', 'redo',  'preview', 'print', 'template', 'code', 'quote', 'selectall', 'cut', 'copy', 'paste', 'plainpaste', 'wordpaste', 'quickformat',
                                '/', 'image', 'multiimage','graft', 'flash', 'media', 'insertfile', 'table', 'hr', 'emoticons', 'baidumap', 'pagebreak', 'anchor', 'link', 'unlink','fullscreen', 'removeformat', 'clearhtml',
                                '/', 'justifyleft', 'justifycenter', 'justifyright','justifyfull', 'insertorderedlist', 'insertunorderedlist', 'indent', 'outdent', 'subscript',
                                'superscript', 'formatblock', 'fontname', 'fontsize', 'forecolor', 'hilitecolor', 'bold', 'italic', 'underline', 'strikethrough', 'lineheight'
                            ],
                            width: '100%',
                            filePostName: 'file',
                            uploadJson : updateQueryStringParam(this.editorUploadUrl, 'from', 'editor'),
                            fileManagerJson : updateQueryStringParam(this.editorManageUrl, 'from', 'editor'),
                            allowImageUpload : this.editorManageUrl ? true : false,
                            allowMediaUpload : this.editorMediaUrl ? true : false,
                            allowFileUpload : this.editorFileUrl ? true : false,
                            allowFileManager : this.editorFileUrl ? true : false,
                            allowFlashUpload : this.editorFlashUrl ? true : false,
                            allowFlashManage : this.editorFlashUrl ? true : false,
                            themeType : this.theme,
                            afterChange:()=>{
                                this.$emit('input', $('textarea[name="'+this.name+'"]').val());
                            },
                            errorMsgHandler : (message, type) => {
                                if (type === 'ok') {
                                    this.$message.success(message);
                                }else{
                                    this.$message.error(message);
                                }
                            }
                        });
                    });
                }
            })

            Vue.component('json', {
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
                    value : [String, Number],
                    name  : String,
                    placeholder  : String,
                },
                methods: {
                    textChange(){
                        this.$emit('input', this.parseV(this.values));
                    },
                    delVal(k){
                        this.values.splice(k,1) && this.textChange()
                    },
                    parseJ(j){
                        let _d = []
                        try {
                            for (let k in j) {
                                _d.push({
                                    key : k,
                                    val : j[k],
                                })
                            }
                        }catch(e) {}
                        return _d;
                    },
                    parseV(o){
                        let _d = {}
                        try {
                            for (let k in o) {
                                if (o[k].key) {
                                    _d[o[k].key] = o[k].val
                                }
                            }
                        }catch(e) {}
                        return JSON.stringify(_d);
                    },
                    strIsJson(str) {
                        if (typeof str == 'string') {
                            try {
                                var obj=JSON.parse(str);
                                return obj;
                            } catch(e) {
                                return false;
                            }
                        } else if (typeof str == 'object'){
                            return str;
                        }
                        return false;
                    }
                },
                created(){
                    let _v = this.strIsJson(this.value) || (this.values = {"":""})
                    this.values = this.parseJ(_v)
                }
            })
        },
        _b(r) {
            var _check = (c)=>{
                switch (c.type){
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
                        } else if (c.props.lazy){ // 异步加载
                            c.on = {
                                'active-item-change' : value => {
                                    let url = c.props.url || ''
                                    let params = c.props.params || {}
                                    params.value = value
                                    request({
                                        url: url,
                                        data: params,
                                        method: 'post'
                                    }, (res) => {
                                        if (res.code === 0) {
                                            c.props.options = this.selVal(value, c.props.options, res.data)
                                        }else{
                                            throw res.msg
                                        }
                                    }, (r) => {
                                        this.vm.$message.error(r.msg || '返回数据格式错误');
                                    }, (e, msg) => {
                                        this.vm.$message.error(msg);
                                    })
                                }
                            }

                            c.props.multiple = true
                        }
                        break;
                    case 'frame':
                        isNaN(c.props.maxLength) && (c.props.maxLength = 1)
                        c.props.src = updateQueryStringParam(c.props.src, {
                            field: c.field,
                            limit: c.props.maxLength || 1,
                            type: c.props.type,
                        })
                        if (c.value == undefined || c.value == '') {
                            c.value = []
                        }
                        c.props.onOk = () => {
                            let frame = document.querySelector('iframe[src="'+c.props.src +'"]')
                            if (frame.contentWindow.$t && frame.contentWindow.$t.v.checkList) {
                                if (c.props.maxLength > 0 && frame.contentWindow.$t.v.checkList.length + c.value.length > c.props.maxLength) {
                                    this.vm.$message.error(`只能选取${c.props.maxLength - c.value.length}个`);
                                    return false;
                                }
                                c.value = c.value.concat(frame.contentWindow.$t.v.checkList)
                            }
                        }
                        break;
                    case 'upload':
                        c.props.data || (c.props.data = {})
                        if (!c.props.data.type) {
                            c.props.data.type = c.props.uploadType
                        }
                        c.props.onSuccess = (r, f, fl)=> {
                            if (r.code === 0) {
                                f.url = r.data.url
                            } else {
                                this.vm.$message.error(f.name + " " + (r.msg || "上传失败"));
                                fl.pop()
                            }
                        }
                        c.props.onError = (r, f, fl)=> {
                            this.vm.$message.error('上传失败, 【 ' + r + ' 】');
                        }
                        if (c.props.manageShow) {
                            var manageShowClick = (event)=>{
                                if(event) {
                                    event.stopPropagation ? event.stopPropagation(): event.cancelBubble = true;
                                }
                                let id = 'manageImg' + Date.now()
                                c.props.manageUrl = updateQueryStringParam(c.props.manageUrl, {
                                    field: c.field,
                                    type: c.props.data.type,
                                    limit: c.props.limit,
                                })
                                this.vm.$confirm('<iframe class="manage-img" id="'+id+'" src="'+c.props.manageUrl+'"></iframe>', '图库', {
                                    confirmButtonText: '确定',
                                    showCancelButton: false,
                                    customClass:'upload-box',
                                    dangerouslyUseHTMLString: true,
                                }).then( action => {}).catch( r => {})
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
                }else{
                    c = _check(c)
                }
                return c;
            }
            r.forEach( d => {
                d = _checkRule(d)
            });
            return r;
        },
        _a(p) {
            var _form = this.vm.$formCreate(this.r, Object.assign({
                el: this.e || document.body,
                mounted: ($f)=>{
                    if (parent != self) {
                        w.submitHook = () => {
                            return $f.submit()
                        }
                    }
                },
                onSubmit: (formData) => {
                    let options = {
                        url: this.c.url,
                        data: formData,
                        method: this.c.type,
                        responseType: "json",
                        timeout: 3000,
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                        },
                    }
                    return request(options, (data) => {
                        // 触发当前页|上级页面事件页面
                        if (w.selfSubmitHook && w.selfSubmitHook(data, _form) === true) {return;}
                        if (parent.submitHook && parent.submitHook(data, _form) === true) {return;}
                        this.vm.$message.success(data.msg);
                    }, (r) => {
                        this.vm.$message.error(r.msg || '提交失败');
                    }, (e, msg) => {
                        this.vm.$message.error(msg);
                    })
                },
                form: this.c.form,
                row: this.c.row,
                submitBtn: this.c.submitBtn,
                resetBtn: this.c.resetBtn
            }, p));

            (()=>{//处理mark样式
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
            })()
            return _form;
        }
    }
    w.FormSurface = FormSurface;
}(window));
