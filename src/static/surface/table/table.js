;(function (w, d) {
    "use strict"
    w.submitHook = false
    let TableSurface = function (e, d, s) {
        this.id = e
        this.a()
        this.b()
        this.v = this.c(d)
        if (d.search) {
            this.d(s)
        }
    }

    TableSurface.prototype = {
        constructor: TableSurface,
        a(){
            document.querySelector(this.id).innerHTML = `<div class="tableNav">
                            <div class="nav-top" v-if="description || title">
                                <z-panel :title="title" :description="description"/>
                            </div>
                            <div class="nav-operation">
                                <div class="o-left">
                                    <z-btn v-for="(t,key) in topBtn" :key="key" :title="t.title || ''" @click="modal(t.params, t.type, checkList)" :faclass="t.faClass"></z-btn>
                                </div>
                                <div class="o-right">
                                    <z-btn v-if="refreshBtnShow" @click="getRows" :faclass="'fa fa-refresh'"></z-btn>
                                    <z-btn v-if="search" @click="searchShow = !searchShow" :faclass="'fa fa-search'"></z-btn>
                                </div>
                            </div>
                            <div class="nav-search" v-if="search" v-show="searchShow"></div>
                        </div>
                        <table :class="{tableCard: tableCardView, dataTable: true}">
                            <thead>
                            <tr>
                                <th v-if="checkShow" style="width: 30px;"><input type="checkbox" v-model="checkAll" @change="checkAllChange"></th>
                                <th v-for="c in columns" :style="{width: c.width || 'auto'}" @click.stop="sortable && c.sort ? sort(c.field, $event) : ''">
                                    {{c.title}} <i v-if="sortable && c.sort" class="fa fa-sort"> </i>
                                </th>
                                <th v-if="operationShow">操作</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-if="loading">
                                <td :colspan="colspan" class="tableLoading" style="position: fixed">
                                    <div></div><div></div><div></div><div></div><div></div>
                                </td>
                            </tr>
                    
                            <tr v-if="rows.length > 0" v-for="r in rows" :class="{checked: clickToSelect && checkList.indexOf(r[pk]) >= 0}" @click="doCheck(r[pk])">
                                <td v-if="checkShow" data-label="选择"><input type="checkbox" :value="r[pk]" v-model="checkList"></td>
                    
                                <td v-for="c in columns" :data-label="c.title" :class="['column_'+c.align]">
                                    <span v-if="c.type == 'html'" v-html="getVal(c.field, r)"></span>
                    
                                    <input v-else-if="c.type == 'textEdit'" type="text" :value="getVal(c.field, r)" @blur="changeValue(c, r, $event)" @click.stop="''">
                    
                                    <div v-else-if="c.type == 'switchEdit'" class="table-switch">
                                        <input class="table-switch-checkbox" :id="'switch_'+ c.field +'_'+ r[pk]" type="checkbox" :checked="getVal(c.field, r) == 1" @change="changeValue(c, r, $event)">
                                        <label class="table-switch-label" :for="'switch_'+ c.field +'_'+ r[pk]">
                                            <span class="table-switch-inner" :data-on="c.options[1] || '开启'" :data-off="c.options[0] || 关闭"></span>
                                            <span class="table-switch-switch"></span>
                                        </label>
                                    </div>
                    
                                    <select v-else-if="c.type == 'selectEdit'" @change="changeValue(c, r, $event)" @click.stop="''">
                                        <option v-for="(o_v, o_k) in c.options" :key="o_k" :selected="o_k == getVal(c.field, r)" :value="o_k">{{o_v}}</option>
                                    </select>
                                    
                                    <span v-else-if="c.type == 'in'" v-text="c.options[getVal(c.field, r)] || ''" :class="c.class"></span>
                                    
                                    <div v-else-if="c.type == 'longText'" @click.stop="modal(getVal(c.field, r), 'html')" v-text="getVal(c.field, r).toString().substring(0,10)+'···'" :class="c.class" class="long-text"></div>
                    
                                    <span v-else v-text="getVal(c.field, r)" :class="c.class"></span>
                                </td>
                    
                                <td data-label="操作" v-if="operationShow">
                                    <z-btn v-for="(t,key) in operations" :key="key" v-if="r.operations === undefined || r.operations.indexOf(key) >= 0" :title="t.title || ''" @click="modal(t.params, t.type, r)" :faclass="t.faClass"></z-btn>
                                </td>
                            </tr>
                            
                            <tr v-if="!loading && rows.length == 0">
                                <td :colspan="colspan" class="tableEmpty"><i class="fa fa-envelope-open-o fa-3x"></i>
                                    <p>没有数据</p>
                                </td> 
                            </tr>
                            </tbody>
                        </table>
                        <z-page v-show="pageShow"
                                :pagecountnum="pageCountNum"
                                :pagerownumlist="pageRowNumList"
                                :rownum="pageRowNum"
                                :current="pageCurrent"
                                :pagelistcount="pageListCount"
                                :pagetopshow="pageTopShow"
                                @changepage="changePage"
                        />`
        },
        b() {
            Vue.component('z-btn', {
                template: `<button :class="['t-btn', faclass]" @click.stop="handleClick" :title="title"> {{title}}</button>`,
                props: {
                    'title': {
                        type: String
                    },
                    'faclass': {
                        type: String,
                        default: ''
                    },
                },
                methods: {
                    handleClick() {
                        this.$emit('click')
                    }
                }
            })

            Vue.component('z-panel', {
                template: `<div class="panel">
                                <div class="panel-title">{{title}}</div>
                                <div class="panel-content" v-html="description"></div>
                            </div>`,
                props: {
                    'title': {
                        type: String
                    },
                    'description': {
                        type: String,
                        default: ''
                    },
                }
            })

            Vue.component('z-page', {
                template: `<div class="tablePage">
                                <a href="javascript:;" class="tablePageFirstBtn" v-if="pagetopshow && pagecurrent != 1"
                                   @click="changeCurrent(1)">首页</a>
                                <a href="javascript:;" v-for="p in pageList" :class="{tablePageCurrent: p.page == pagecurrent, tablePageNum:1}"
                                   @click="changeCurrent(p.page)">{{p.title}}</a>
                                <a href="javascript:;" class="tablePageLastBtn" v-if="pagetopshow && pagecurrent != pagenum"
                                   @click="changeCurrent(pagenum)">尾页</a>
                                <div class="tablePageBlock">
                                    <span>
                                        <select class="tablePageInput" @change="changeCurrent($event.target.value)">
                                            <option :value="r" v-for="r in pagenum" :selected="pagecurrent == r">{{r}}</option>
                                        </select>
                                        / <b>{{pagenum}}</b> 页，
                                    </span>
                                    <span>每页显示
                                        <select class="tablePageListCount" @change="changeCurrent(pagecurrent, $event.target.value)">
                                            <option :value="r" v-for="r in pagerownumlist" :selected="pagerownum == r">{{r}}</option>
                                        </select>
                                        条
                                    </span>
                                </div>
                            </div>`,
                props: {
                    pagetopshow: {
                        type: Boolean,
                        default: true
                    },
                    pagecountnum: {
                        type: Number,
                        default: 1
                    },
                    pagerownumlist: {
                        type: Array,
                        default: [5, 10, 20, 50, 100]
                    },
                    rownum: {
                        type: Number,
                        default: 10
                    },
                    current: {
                        type: Number,
                        default: 1
                    },
                    pagelistcount: {  //页面页码数量
                        type: Number,
                        default: 3
                    },
                },
                mounted(){
                    this.pagecurrent = this.current //当前页
                    this.pagerownum = this.rownum  //每页显示条数
                },
                data(){
                    return {
                        pagecurrent: 1,
                        pagerownum: 1,
                    }
                },
                methods:{
                    changeCurrent(c = 0, n = 0){
                        if (c > this.pagenum) {return;}
                        this.pagecurrent = parseInt(c) || this.pagecurrent
                        if (parseInt(n)) {
                            this.pagecurrent = 1
                            this.pagerownum  = parseInt(n)
                        }
                        this.$emit('changepage', {
                            current: this.pagecurrent,
                            rowNum: this.pagerownum,
                        })
                    }
                },
                computed: {
                    pagenum() {
                        return Math.ceil(this.pagecountnum / this.pagerownum)
                    },
                    pageList() {
                        let _p = [],
                            c = Math.floor(this.pagelistcount / 2) <= 0 ? 1 : Math.floor(this.pagelistcount / 2)

                        if (this.pagecurrent >= c && this.pagecurrent < this.pagenum - c) {
                            var start = this.pagecurrent - c, end = this.pagecurrent + c;
                        } else if (this.pagecurrent >= c && this.pagecurrent >= this.pagenum - c) {
                            var start = this.pagecurrent - c, end = this.pagenum;
                        } else {
                            var start = 1, end = c + 2;
                        }
                        if (start > 1 && this.pagenum >= (c * 2 + 1)) {
                            _p.push({page: start - 1, title: '...'})
                        }
                        for (; start <= end; start++) {
                            if (start <= this.pagenum && start >= 1) {
                                _p.push({page: start, title: start})
                            }
                        }
                        if (end < this.pagenum) {
                            _p.push({page: end + 1, title: '...'})
                        }
                        return _p
                    }
                }
            })
        },
        m(d, n) {
            for (let i in d) {
                if (!n[i]) {
                    n[i] = d[i]
                }
            }
            return n
        },
        c(d) {
            let _t = this
            const data = _t.m({
                title: '',
                topBtn: [],
                operations: [],
                rows: [],                                      // 列
                pageCountNum: 1,                               // 数据总数量
                loading: false,                                // 加载中
                checkAll: false,                               // 全选
                checkList: [],                                 // 选中列表
                defaultParams: [],                             // 默认提交参数
            }, d)
            Vue.prototype.$swal = swal
            Vue.prototype.axios = axios
            return new Vue({
                el: _t.id,
                data() {
                    return data
                },
                methods: {
                    modal(param, type = 'alert', data = {}){
                        if(!data.pk) data.pk = data[this.pk];
                        switch (type) {
                            case 'page':
                                param = Object.assign({}, {
                                    title: '',
                                    url: ''
                                }, param)

                                let _q = ''
                                if (param.params && param.params.length > 0) {
                                    param.params.forEach((v) => {
                                        _q += '&' + v + '=' + data[v] || ''
                                    })
                                }

                                var frame = document.createElement("iframe");
                                if (param.url.indexOf('?') >= 0) {
                                    frame.src = param.url + _q;
                                } else {
                                    frame.src = param.url + '?' + _q.substring(1);
                                }
                                frame.className = "surface-table-frame";
                                this.$swal({
                                    className: "table-modal",
                                    title: param.title,
                                    content: frame,
                                    buttons: ['关闭', {
                                        text: "确认",
                                        value: true,
                                        visible: true,
                                        closeModal: false,
                                    }],
                                })
                                // sweet confirm重复提交不能触发promise
                                // 下列代码覆盖 sweet 的 click
                                document.querySelector('.swal-button--confirm').addEventListener('click', ()=>{
                                    w.submitHook = (data, t)=>{
                                        if (data.code === 0 && param.autoClose !== false) {
                                            setTimeout(()=>{
                                                this.$swal.close()
                                                param.refresh && this.getRows()
                                            }, param.closeTime || 1500)
                                        }
                                    }
                                    // 触发子页面的表单提交
                                    frame.contentWindow.submitHook && frame.contentWindow.submitHook()
                                    this.$swal.stopLoading()
                                });

                                break;
                            case 'submit':
                            case 'confirm':
                                switch (type){
                                    case 'submit':
                                        if (data.length === 0 ) {
                                            this.$swal({
                                                text: "请选择操作的列",
                                                icon: 'info',
                                            })
                                            return;
                                        }
                                        param = Object.assign({}, {
                                            text: '确认操作?',
                                            url: '',
                                            method: 'POST',
                                            params: [this.pk]
                                        }, param)

                                        let _data = data
                                        data = []
                                        data[this.pk] = _data
                                        break;
                                    case 'confirm':
                                        param = Object.assign({}, {
                                            text: '确认操作?',
                                            url: '',
                                            method: 'POST',
                                            params: []
                                        }, param)
                                        break;
                                }
                                let queryData = {}
                                param.params.forEach((v)=>{
                                    queryData[v] = data[v] || ''
                                })

                                this.$swal({
                                    text: param.text,
                                    closeOnEsc: true,
                                    dangerMode: true,
                                    buttons: {
                                        cancel: "取消",
                                        confirm: {
                                            text: "确认",
                                        }
                                    }
                                }).then((e)=>{
                                    if (true === e) {
                                        this.request({
                                            url: param.url,
                                            data: queryData,
                                            method: param.method
                                        }, (e)=>{
                                            this.$swal({
                                                text: e.msg,
                                                icon: 'success',
                                            }).then(()=>{
                                                if (param.refresh) {
                                                    this.getRows()
                                                }
                                            })
                                        })
                                    }
                                })
                                break;
                            case 'html':
                                var d = document.createElement("div");
                                d.innerHTML = param;
                                d.className = "surface-table-html";
                                this.$swal({
                                    className: "table-modal",
                                    content: d,
                                })
                                break;
                            case 'alert':
                            default:
                                this.$swal(param);
                        }
                    },
                    getVal(f, r){
                        try {
                            f = ''.toString() + f // 强制转字符串
                            if (!r[f] && f.indexOf(".") != -1) {
                                let v = r,deep = f.split('.')
                                for (let i of deep) {
                                    v = v[i] || ''
                                }
                                return v
                            }else{
                                return r[f] === undefined ? '' : r[f]
                            }
                        } catch (err){
                            console.error(err)
                        }
                    },
                    changePage(data){
                        if (this.pageCurrent != data.current) {
                            this.pageCurrent = data.current
                        }
                        if (this.pageRowNum != data.rowNum) {
                            this.pageRowNum = data.rowNum
                        }
                    },
                    getRows() {
                        let requestData = Object.assign({page: this.pageCurrent, row_num: this.pageRowNum}, this.defaultParams)
                        if (this.sortField) {
                            requestData.sort_field = this.sortField
                            requestData.sort_order = this.sortOrder
                        }
                        this.request({
                            url: this.url,
                            data: requestData,
                            method: this.method
                        }, (r) => {
                            this.pageShow && (r.data.count && (this.pageCountNum = r.data.count))
                            this.rows = r.data.list || {}
                        }, '', '', ()=>{
                            this.checkList = []
                        })
                    },
                    request(c = {}, success = null, error = null, fail = null, final = null) {
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

                        if (options.url === undefined) {
                            this.$swal('请求地址未配置');
                            fail && fail('请求地址未配置')
                            return;
                        }

                        this.loading = true
                        return this.axios(options).then((a) => {
                            let data = a.data || {}
                            if (data.code === 0) {
                                success && success(data)
                            } else {
                                this.$swal('提示', data.msg || '返回数据格式错误', 'error');
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
                                        msg = e.message
                                        break;
                                }
                            }else{
                                msg = '系统错误: ' + e.toString()
                            }
                            this.$swal(msg, '', 'error')
                            fail && fail(e, msg)
                        }).finally(() => {
                            this.loading = false
                            final && final()
                        });
                    },
                    sort(field, e) {
                        if (this.sortable === false) return;
                        let sorts = document.querySelectorAll('th>i[class*=fa-sort-]')
                        sorts.forEach(v => {
                            v.className = 'fa fa-sort'
                        })
                        this.sortField = field
                        this.sortOrder == 'desc' ? this.sortOrder = 'asc' : this.sortOrder = 'desc'
                        let node = '';
                        if (e.srcElement.nodeName == 'I') {
                            node = e.srcElement
                        }else{
                            node = e.srcElement.querySelector('.fa')
                        }
                        node.className = 'fa fa-sort-' + this.sortOrder
                        this.getRows()
                    },
                    checkAllChange() {
                        this.checkList = []
                        if (this.checkAll == true) {
                            this.rows.forEach((val, index) => {
                                this.checkList.push(val[this.pk])
                            })
                        }
                    },
                    doCheck(id) {
                        if (!this.clickToSelect) {
                            return
                        }
                        let i = this.checkList.indexOf(id)
                        i < 0 ? this.checkList.push(id) : this.checkList.splice(i, 1)
                    },
                    changeValue(c, r, e) {
                        let val
                        switch (e.target.type) {
                            case 'checkbox':
                                val = e.target.checked ? 1 : 0;
                                break;
                            default:
                                val = e.target.value
                        }
                        if (val == r[c.field]) return;

                        let _d = {};
                        _d[this.pk] = r[this.pk]
                        // _d['pk'] = r[this.pk]
                        _d[c.field] = val

                        this.request({
                            url: c.edit_url,
                            data: _d,
                            method: 'post'
                        }, (res) => {
                            this.$swal(res.msg, '', 'success')
                            r[c.field] = val
                            c.editRefreshAfter && this.getRows()
                        }, (err) => {
                            e.target.value = r[c.field]

                            if (e.target.nodeName.toLowerCase() == 'input' && e.target.type == 'checkbox') {
                                e.target.checked = !e.target.checked
                            }
                        }, (err) => {
                            e.target.value = r[c.field]

                            if (e.target.nodeName.toLowerCase() == 'input' && e.target.type == 'checkbox') {
                                e.target.checked = !e.target.checked
                            }
                        })
                    },
                    getRequestString() {
                        var url = location.search; //获取url中"?"符后的字串
                        var theRequest = new Object();
                        if (url.indexOf("?") != -1) {
                            var str = url.substr(1);
                            var strs = str.split("&");
                            for(var i = 0; i < strs.length; i ++) {
                                theRequest[strs[i].split("=")[0]]=unescape(strs[i].split("=")[1]);
                            }
                        }
                        return theRequest;
                    },
                },
                created() {
                    this.defaultParams = Object.assign(this.defaultParams, this.getRequestString())
                    this.getRows();
                },
                watch: {
                    pageCurrent(n, o) {
                        this.getRows()
                    },
                    pageRowNum(n, o) {
                        this.getRows()
                    },
                    checkList: {
                        handler(n, o) {
                            if (n.length >= this.rows.length) {
                                this.checkAll = true
                            } else {
                                this.checkAll = false
                            }
                        },
                        deep: true
                    }
                },
                computed: {
                    colspan() {
                        return this.columns.length + (this.checkShow ? 1 : 0) + (this.operationShow ? 1 : 0);
                    }
                }
            })
        },
        d(s) {
            let searchNode = document.createElement('div')
            searchNode.id = s.id
            document.querySelector('.nav-search').appendChild(searchNode)
            let globals = {
                onSubmit: (formData) => {
                    this.v.defaultParams = Object.assign(this.v.defaultParams, formData)
                    this.v.getRows()
                }
            }
            globals.global = s.global
            return new FormSurface('#'+searchNode.id, s.constitute, s.rule, globals)
        }
    }

    w.TableSurface = TableSurface
}(window, document))