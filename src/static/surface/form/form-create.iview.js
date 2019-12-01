/*!
 * @form-create/iview v1.0.4
 * (c) 2018-2019 xaboy
 * Github https://github.com/xaboy/form-create
 * Released under the MIT License.
 */
!function (e, t) {
    "object" == typeof exports && "undefined" != typeof module ? t(exports, require("vue"), require("iview")) : "function" == typeof define && define.amd ? define(["exports", "vue", "iview"], t) : t((e = e || self).formCreate = {}, e.Vue, e.iview)
}(this, function (exports, Vue, iview) {
    "use strict";

    function _typeof(e) {
        return (_typeof = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function (e) {
            return typeof e
        } : function (e) {
            return e && "function" == typeof Symbol && e.constructor === Symbol && e !== Symbol.prototype ? "symbol" : typeof e
        })(e)
    }

    function _classCallCheck(e, t) {
        if (!(e instanceof t)) throw new TypeError("Cannot call a class as a function")
    }

    function _defineProperties(e, t) {
        for (var r = 0; r < t.length; r++) {
            var n = t[r];
            n.enumerable = n.enumerable || !1, n.configurable = !0, "value" in n && (n.writable = !0), Object.defineProperty(e, n.key, n)
        }
    }

    function _createClass(e, t, r) {
        return t && _defineProperties(e.prototype, t), r && _defineProperties(e, r), e
    }

    function _defineProperty(e, t, r) {
        return t in e ? Object.defineProperty(e, t, {
            value: r,
            enumerable: !0,
            configurable: !0,
            writable: !0
        }) : e[t] = r, e
    }

    function ownKeys(e, t) {
        var r = Object.keys(e);
        if (Object.getOwnPropertySymbols) {
            var n = Object.getOwnPropertySymbols(e);
            t && (n = n.filter(function (t) {
                return Object.getOwnPropertyDescriptor(e, t).enumerable
            })), r.push.apply(r, n)
        }
        return r
    }

    function _objectSpread2(e) {
        for (var t = 1; t < arguments.length; t++) {
            var r = null != arguments[t] ? arguments[t] : {};
            t % 2 ? ownKeys(r, !0).forEach(function (t) {
                _defineProperty(e, t, r[t])
            }) : Object.getOwnPropertyDescriptors ? Object.defineProperties(e, Object.getOwnPropertyDescriptors(r)) : ownKeys(r).forEach(function (t) {
                Object.defineProperty(e, t, Object.getOwnPropertyDescriptor(r, t))
            })
        }
        return e
    }

    function _inherits(e, t) {
        if ("function" != typeof t && null !== t) throw new TypeError("Super expression must either be null or a function");
        e.prototype = Object.create(t && t.prototype, {
            constructor: {
                value: e,
                writable: !0,
                configurable: !0
            }
        }), t && _setPrototypeOf(e, t)
    }

    function _getPrototypeOf(e) {
        return (_getPrototypeOf = Object.setPrototypeOf ? Object.getPrototypeOf : function (e) {
            return e.__proto__ || Object.getPrototypeOf(e)
        })(e)
    }

    function _setPrototypeOf(e, t) {
        return (_setPrototypeOf = Object.setPrototypeOf || function (e, t) {
            return e.__proto__ = t, e
        })(e, t)
    }

    function _assertThisInitialized(e) {
        if (void 0 === e) throw new ReferenceError("this hasn't been initialised - super() hasn't been called");
        return e
    }

    function _possibleConstructorReturn(e, t) {
        return !t || "object" != typeof t && "function" != typeof t ? _assertThisInitialized(e) : t
    }

    function _toConsumableArray(e) {
        return _arrayWithoutHoles(e) || _iterableToArray(e) || _nonIterableSpread()
    }

    function _arrayWithoutHoles(e) {
        if (Array.isArray(e)) {
            for (var t = 0, r = new Array(e.length); t < e.length; t++) r[t] = e[t];
            return r
        }
    }

    function _iterableToArray(e) {
        if (Symbol.iterator in Object(e) || "[object Arguments]" === Object.prototype.toString.call(e)) return Array.from(e)
    }

    function _nonIterableSpread() {
        throw new TypeError("Invalid attempt to spread non-iterable instance")
    }

    function _extends() {
        return (_extends = Object.assign || function (e) {
            for (var t, r = 1; r < arguments.length; r++) for (var n in t = arguments[r]) Object.prototype.hasOwnProperty.call(t, n) && (e[n] = t[n]);
            return e
        }).apply(this, arguments)
    }

    Vue = Vue && Vue.hasOwnProperty("default") ? Vue.default : Vue, iview = iview && iview.hasOwnProperty("default") ? iview.default : iview;
    var normalMerge = ["attrs", "props", "domProps"], toArrayMerge = ["class", "style", "directives"],
        functionalMerge = ["on", "nativeOn"], mergeJsxProps = function (e) {
            return e.reduce(function (e, t) {
                for (var r in t) if (e[r]) if (-1 !== normalMerge.indexOf(r)) e[r] = _extends({}, e[r], t[r]); else if (-1 !== toArrayMerge.indexOf(r)) {
                    var n = e[r] instanceof Array ? e[r] : [e[r]], i = t[r] instanceof Array ? t[r] : [t[r]];
                    e[r] = n.concat(i)
                } else if (-1 !== functionalMerge.indexOf(r)) for (var o in t[r]) if (e[r][o]) {
                    var a = e[r][o] instanceof Array ? e[r][o] : [e[r][o]],
                        s = t[r][o] instanceof Array ? t[r][o] : [t[r][o]];
                    e[r][o] = a.concat(s)
                } else e[r][o] = t[r][o]; else if ("hook" == r) for (var u in t[r]) e[r][u] = e[r][u] ? mergeFn(e[r][u], t[r][u]) : t[r][u]; else e[r] = t[r]; else e[r] = t[r];
                return e
            }, {})
        }, mergeFn = function (e, t) {
            return function () {
                e && e.apply(this, arguments), t && t.apply(this, arguments)
            }
        }, helper = mergeJsxProps;

    function $set(e, t, r) {
        Vue.set(e, t, r)
    }

    function $del(e, t) {
        Vue.delete(e, t)
    }

    function isValidChildren(e) {
        return Array.isArray(e) && e.length > 0
    }

    var _toString = Object.prototype.toString;

    function isUndef(e) {
        return null == e
    }

    function toString(e) {
        return null == e ? "" : "object" === _typeof(e) ? JSON.stringify(e, null, 2) : String(e)
    }

    function extend(e, t) {
        for (var r in t) $set(e, r, t[r]);
        return e
    }

    function debounce(e, t) {
        var r = null;
        return function () {
            for (var n = arguments.length, i = new Array(n), o = 0; o < n; o++) i[o] = arguments[o];
            null !== r && clearTimeout(r), r = setTimeout(function () {
                return e.apply(void 0, i)
            }, t)
        }
    }

    function isType(e, t) {
        return _toString.call(e) === "[object " + t + "]"
    }

    function isDate(e) {
        return isType(e, "Date")
    }

    function isPlainObject(e) {
        return isType(e, "Object")
    }

    function isFunction(e) {
        return isType(e, "Function")
    }

    function isString(e) {
        return isType(e, "String")
    }

    function isBool(e) {
        return isType(e, "Boolean")
    }

    function toLine(e) {
        var t = e.replace(/([A-Z])/g, "-$1").toLowerCase();
        return 0 === t.indexOf("-") && (t = t.substr(1)), t
    }

    function toArray(e) {
        return Array.isArray(e) ? e : isUndef(e) || "" === e ? [] : [e]
    }

    function isElement(e) {
        return "object" === _typeof(e) && null !== e && 1 === e.nodeType && !isPlainObject(e)
    }

    function deepExtend(e) {
        var t = arguments.length > 1 && void 0 !== arguments[1] ? arguments[1] : {}, r = !1;
        for (var n in t) if (Object.prototype.hasOwnProperty.call(t, n)) {
            var i = t[n];
            if ((r = Array.isArray(i)) || isPlainObject(i)) {
                var o = void 0 === e[n];
                r ? (r = !1, o && $set(e, n, [])) : o && $set(e, n, {}), deepExtend(e[n], i)
            } else $set(e, n, i)
        }
        return e
    }

    var id = 0;

    function uniqueId() {
        return ++id
    }

    function toDefSlot(e, t) {
        return [e && isFunction(e) ? e(t) : e]
    }

    function timeStampToDate(e) {
        if (isDate(e)) return e;
        var t = new Date(e);
        return "Invalid Date" === t.toString() ? e : t
    }

    function preventDefault(e) {
        e.preventDefault()
    }

    function hasSlot(e, t) {
        return 0 !== e.length && e.some(function (e) {
            if (e.data) {
                if (!e.data.slot && "default" === t || e.data.slot === t) return !0
            } else if ("default" === t) return !0;
            return !1
        })
    }

    function errMsg(e) {
        return "\ngithub:https://github.com/xaboy/form-create\ndocument:http://www.form-create.com" + (e || "")
    }

    var NAME = "fc-iview-checkbox", checkbox = {
        name: NAME, props: {
            options: {
                type: Array, default: function () {
                    return []
                }
            }, children: {
                type: Array, default: function () {
                    return []
                }
            }, ctx: {
                type: Object, default: function () {
                    return {}
                }
            }, value: {
                type: Array, default: function () {
                    return []
                }
            }
        }, watch: {
            value: function () {
                this.update()
            }
        }, data: function () {
            return {trueValue: [], unique: uniqueId()}
        }, methods: {
            onInput: function (e) {
                this.$emit("input", this.options.filter(function (t) {
                    return -1 !== e.indexOf(t.label)
                }).map(function (e) {
                    return e.value
                }))
            }, update: function () {
                var e = this;
                this.trueValue = this.options.filter(function (t) {
                    return -1 !== e.value.indexOf(t.value)
                }).map(function (e) {
                    return e.label
                })
            }
        }, created: function () {
            this.update()
        }, render: function () {
            var e = this, t = arguments[0];
            return t("CheckboxGroup", helper([{}, this.ctx, {
                on: {input: this.onInput},
                model: {
                    value: e.trueValue, callback: function (t) {
                        e.trueValue = t
                    }
                }
            }]), [this.options.map(function (r, n) {
                var i = _objectSpread2({}, r);
                return delete i.value, t("Checkbox", {props: _objectSpread2({}, i), key: NAME + n + e.unique})
            }).concat(this.chlidren)])
        }
    }, iview2 = {
        _v: 2,
        resetBtnType: "ghost",
        resetBtnIcon: "refresh",
        submitBtnIcon: "ios-upload",
        fileIcon: "document-text",
        fileUpIcon: "folder",
        imgUpIcon: "image",
        infoIcon: "ios-information-outline"
    }, iview3 = {
        _v: 3,
        resetBtnType: "default",
        resetBtnIcon: "md-refresh",
        submitBtnIcon: "ios-share",
        fileIcon: "md-document",
        fileUpIcon: "ios-folder-open",
        imgUpIcon: "md-images",
        infoIcon: "ios-information-circle-outline"
    }, iviewConfig = void 0 === iview ? iview2 : iview.version && 3 == iview.version.split(".")[0] ? iview3 : iview2;

    function getConfig() {
        return {
            form: {
                inline: !1,
                labelPosition: "right",
                labelWidth: 125,
                showMessage: !0,
                autocomplete: "off",
                size: void 0
            },
            row: {gutter: 0, type: void 0, align: void 0, justify: void 0, className: void 0},
            info: {type: "poptip", trigger: "hover", placement: "top-start", wordWrap: !0, icon: iviewConfig.infoIcon},
            submitBtn: {
                type: "primary",
                size: "large",
                shape: void 0,
                long: !0,
                htmlType: "button",
                disabled: !1,
                icon: iviewConfig.submitBtnIcon,
                innerText: "提交",
                loading: !1,
                show: !0,
                col: void 0,
                click: void 0
            },
            resetBtn: {
                type: iviewConfig.resetBtnType,
                size: "large",
                shape: void 0,
                long: !0,
                htmlType: "button",
                disabled: !1,
                icon: iviewConfig.resetBtnIcon,
                innerText: "重置",
                loading: !1,
                show: !1,
                col: void 0,
                click: void 0
            }
        }
    }

    var formCreateName = "FormCreate";

    function $FormCreate(e, t) {
        return {
            name: formCreateName, props: {
                rule: {
                    type: Array, required: !0, default: function () {
                        return {}
                    }
                }, option: {
                    type: Object, default: function () {
                        return {}
                    }, required: !1
                }, value: Object
            }, data: function () {
                return {formData: void 0, buttonProps: void 0, resetProps: void 0, $f: void 0, isShow: !0, unique: 1}
            }, components: t, render: function () {
                return this.formCreate.render()
            }, methods: {
                _buttonProps: function (e) {
                    this.$set(this, "buttonProps", deepExtend(this.buttonProps, e))
                }, _resetProps: function (e) {
                    this.$set(this, "resetProps", deepExtend(this.resetProps, e))
                }, _refresh: function () {
                    this.unique += 1
                }
            }, watch: {
                option: "_refresh", rule: function (e) {
                    this.formCreate.handle.reloadRule(e)
                }
            }, beforeCreate: function () {
                var t = this.$options.propsData, r = t.rule, n = t.option;
                this.formCreate = new e(r, n), this.formCreate.beforeCreate(this)
            }, created: function () {
                this.formCreate.created(), this.$f = this.formCreate.api(), this.$emit("input", this.$f)
            }, mounted: function () {
                this.formCreate.mounted(), this.$emit("input", this.$f)
            }, beforeDestroy: function () {
                this.formCreate.handle.reloadRule([]), this.formCreate.handle.$render.clearCacheAll()
            }
        }
    }

    function defVData() {
        return {
            class: {},
            style: {},
            attrs: {},
            props: {},
            domProps: {},
            on: {},
            nativeOn: {},
            directives: [],
            scopedSlots: {},
            slot: void 0,
            key: void 0,
            ref: void 0
        }
    }

    var VData = function () {
            function e() {
                _classCallCheck(this, e), this.init()
            }

            return _createClass(e, [{
                key: "class", value: function (e) {
                    var t = this, r = !(arguments.length > 1 && void 0 !== arguments[1]) || arguments[1];
                    return isUndef(e) ? this : (Array.isArray(e) ? e.forEach(function (e) {
                        $set(t._data.class, toString(e), !0)
                    }) : isPlainObject(e) ? $set(this._data, "class", extend(this._data.class, e)) : $set(this._data.class, toString(e), void 0 === r || r), this)
                }
            }, {
                key: "directives", value: function (e) {
                    return isUndef(e) ? this : ($set(this._data, "directives", this._data.directives.concat(toArray(e))), this)
                }
            }, {
                key: "init", value: function () {
                    return this._data = defVData(), this
                }
            }, {
                key: "get", value: function () {
                    var e = this, t = Object.keys(this._data).reduce(function (t, r) {
                        var n = e._data[r];
                        return void 0 === n ? t : Array.isArray(n) && !n.length ? t : Object.keys(n).length || "props" === r ? (t[r] = n, t) : t
                    }, {});
                    return this.init(), t
                }
            }]), e
        }(), keyList = ["ref", "key", "slot"],
        objList = ["scopedSlots", "nativeOn", "on", "domProps", "props", "attrs", "style"];

    function baseRule() {
        return {
            validate: [],
            options: [],
            col: {},
            children: [],
            emit: [],
            template: void 0,
            emitPrefix: void 0,
            native: void 0,
            info: void 0
        }
    }

    function creatorFactory(e) {
        return function (t, r, n) {
            var i = arguments.length > 3 && void 0 !== arguments[3] ? arguments[3] : {};
            return new Creator(e, t, r, n, i)
        }
    }

    function creatorTypeFactory(e, t) {
        var r = arguments.length > 2 && void 0 !== arguments[2] ? arguments[2] : "type";
        return function (n, i, o) {
            var a = arguments.length > 3 && void 0 !== arguments[3] ? arguments[3] : {}, s = new Creator(e, n, i, o, a);
            return isFunction(t) ? t(s) : s.props(r, t), s
        }
    }

    keyList.forEach(function (e) {
        VData.prototype[e] = function (t) {
            return $set(this._data, e, t), this
        }
    }), objList.forEach(function (e) {
        VData.prototype[e] = function (t, r) {
            return isUndef(t) ? this : (isPlainObject(t) ? $set(this._data, e, extend(this._data[e], t)) : $set(this._data[e], toString(t), r), this)
        }
    });
    var Creator = function (e) {
        function t(e, r, n, i) {
            var o, a = arguments.length > 4 && void 0 !== arguments[4] ? arguments[4] : {};
            return _classCallCheck(this, t), extend((o = _possibleConstructorReturn(this, _getPrototypeOf(t).call(this)))._data, baseRule()), extend(o._data, {
                type: e,
                title: r,
                field: n,
                value: i
            }), isPlainObject(a) && o.props(a), o
        }

        return _inherits(t, VData), _createClass(t, [{
            key: "type", value: function (e) {
                return this.props("type", e), this
            }
        }, {
            key: "getRule", value: function () {
                return this._data
            }
        }, {
            key: "event", value: function () {
                return this.on.apply(this, arguments), this
            }
        }]), t
    }(), keyAttrs = ["emitPrefix", "className", "value", "name", "title", "native", "info"];
    keyAttrs.forEach(function (e) {
        Creator.prototype[e] = function (t) {
            return $set(this._data, e, t), this
        }
    });
    var objAttrs = ["col"];
    objAttrs.forEach(function (e) {
        Creator.prototype[e] = function (t) {
            return $set(this._data, e, extend(this._data[e], t)), this
        }
    });
    var arrAttrs = ["validate", "options", "children", "emit"];

    function toJson(e) {
        return JSON.stringify(e, function (e, t) {
            if (t instanceof Creator) return t.getRule();
            if (!t || !0 !== t._isVue) {
                if ("function" != typeof t) return t;
                if (t.__inject && (t = t.__origin), !t.__emit) return "" + t
            }
        })
    }

    function parseJson(json) {
        return JSON.parse(json, function (k, v) {
            if (v.indexOf && v.indexOf("function") > -1) try {
                return eval("(function(){return " + v + " })()")
            } catch (e) {
                return void console.error("[form-create]解析失败:".concat(v))
            }
            return v
        })
    }

    function enumerable(e) {
        return {value: e, enumerable: !1, configurable: !1}
    }

    function makerFactory() {
        var e = {}, t = creatorFactory("");
        return extend(e, {
            create: function (e, r, n) {
                var i = t("", r);
                return i._data.type = e, i._data.title = n, i
            }, createTmp: function (e, r, n, i) {
                var o = t("", n);
                return o._data.type = "template", o._data.template = e, o._data.title = i, o._data.vm = r, o
            }
        }), e.template = e.createTmp, e.parse = parse, e
    }

    function parse(e) {
        var t = arguments.length > 1 && void 0 !== arguments[1] && arguments[1];
        if (isString(e) && (e = parseJson(e)), e instanceof Creator) return t ? e : e.getRule();
        if (isPlainObject(e)) {
            var r = ruleToMaker(e);
            return t ? r : r.getRule()
        }
        if (Array.isArray(e)) {
            var n = e.map(function (e) {
                return parse(e, t)
            });
            return Object.defineProperties(n, {find: enumerable(findField), model: enumerable(model)}), n
        }
        return e
    }

    function findField(e, t) {
        var r = [];
        for (var n in this) {
            var i = this[n] instanceof Creator ? this[n]._data : this[n];
            if (i.field === e) return !0 === t ? i : this[n];
            isValidChildren(i.children) && (r = r.concat(i.children))
        }
        if (r.length > 0) return findField.call(r, e)
    }

    function model(e) {
        var t = this;
        Object.keys(e).forEach(function (r) {
            var n = t.find(r, !0);
            n && (n.value = e[r])
        })
    }

    function ruleToMaker(e) {
        var t = new Creator;
        return Object.keys(e).forEach(function (r) {
            t._data[r] = e[r]
        }), t
    }

    function parseVData(e) {
        return isString(e) ? e = {domProps: {innerHTML: e}} : e && isFunction(e.get) && (e = e.get()), e
    }

    function getVNode(e) {
        return isFunction(e) ? e() : e || []
    }

    arrAttrs.forEach(function (e) {
        Creator.prototype[e] = function (t) {
            return Array.isArray(t) || (t = [t]), $set(this._data, e, this._data[e].concat(t)), this
        }
    });
    var VNode = function () {
        function e(t) {
            _classCallCheck(this, e), t && this.setVm(t)
        }

        return _createClass(e, [{
            key: "setVm", value: function (e) {
                this.vm = e, this.$h = e.$createElement
            }
        }, {
            key: "make", value: function (e, t, r) {
                var n = this.$h(e, parseVData(t), getVNode(r));
                return n.context = this.vm, n
            }
        }], [{
            key: "use", value: function (t) {
                Object.keys(t).forEach(function (r) {
                    e.prototype[toString(r).toLocaleLowerCase()] = e.prototype[r] = function (e, n) {
                        return this.make(t[r], e, n)
                    }
                })
            }
        }]), e
    }(), BaseParser = function () {
        function e(t, r, n) {
            _classCallCheck(this, e), this.rule = r, this.vData = new VData, this.vNode = new VNode, this.id = n, this.watch = [], this.originType = r.type, this.type = toString(r.type).toLocaleLowerCase(), this.isDef = !0, this.el = void 0, r.field ? this.field = r.field : (this.field = "_def_" + uniqueId(), this.isDef = !1), this.name = r.name, this.unique = "fc_" + n, this.key = "key_" + n, this.refName = "__" + this.field + this.id, this.formItemRefName = "fi" + this.refName, this.update(t), this.init()
        }

        return _createClass(e, [{
            key: "update", value: function (e) {
                this.$handle = e, this.$render = e.$render, this.vm = e.vm, this.options = e.options, this.vNode.setVm(this.vm), this.deleted = !1
            }
        }, {
            key: "init", value: function () {
            }
        }, {
            key: "toFormValue", value: function (e) {
                return e
            }
        }, {
            key: "toValue", value: function (e) {
                return e
            }
        }]), e
    }(), $de = debounce(function (e) {
        return e()
    }, 1), Render = function () {
        function e(t) {
            _classCallCheck(this, e), this.$handle = t, this.fc = t.fc, this.vm = t.vm, this.options = t.options, this.$form = t.$form, this.vNode = new VNode(this.vm), this.vData = new VData, this.cache = {}, this.renderList = {}
        }

        return _createClass(e, [{
            key: "clearCache", value: function (e) {
                var t = !(arguments.length > 1 && void 0 !== arguments[1]) || arguments[1];
                if (this.cache[e.id]) {
                    this.cacheStatus(e) && this.$handle.refresh();
                    var r = this.cache[e.id].parent;
                    this.cache[e.id] = null, r && t && this.clearCache(r, t)
                }
            }
        }, {
            key: "clearCacheAll", value: function () {
                this.cache = {}
            }
        }, {
            key: "setCache", value: function (e, t, r) {
                this.cache[e.id] = {vnode: t, use: !1, parent: r}
            }
        }, {
            key: "cacheStatus", value: function (e) {
                return this.cache[e.id] && (!0 === this.cache[e.id].use || this.cache[e.id].parent)
            }
        }, {
            key: "getCache", value: function (e) {
                var t = this.cache[e.id];
                return t.use = !0, t.vnode
            }
        }, {
            key: "initOrgChildren", value: function () {
                var e = this.$handle.parsers;
                this.orgChildren = Object.keys(e).reduce(function (t, r) {
                    var n = e[r].rule.children;
                    return t[r] = isValidChildren(n) ? _toConsumableArray(n) : [], t
                }, {})
            }
        }, {
            key: "run", value: function () {
                var e = this;
                if (this.vm.isShow) {
                    this.$form.beforeRender();
                    var t = this.$handle.sortList.map(function (t) {
                        var r = e.$handle.parsers[t];
                        if ("hidden" !== r.type) return e.renderParser(r)
                    }).filter(function (e) {
                        return void 0 !== e
                    });
                    return this.$form.render(t)
                }
            }
        }, {
            key: "setGlobalConfig", value: function (e) {
                this.options.global && (this.options.global["*"] && this.toData(e, this.options.global["*"]), this.options.global[e.type] && this.toData(e, this.options.global[e.type]))
            }
        }, {
            key: "renderTemplate", value: function (e) {
                var t = this, r = e.id, n = e.rule, i = e.key;
                if (void 0 === _vue.compile) return console.error("使用的 Vue 版本不支持 compile" + errMsg()), [];
                if (!this.renderList[r]) {
                    var o = n.vm;
                    isUndef(n.vm) ? o = new _vue : isFunction(n.vm) && (o = n.vm(this.$handle.getInjectData(n))), this.renderList[r] = {
                        vm: o,
                        template: _vue.compile(n.template)
                    }
                }
                var a = this.renderList[r], s = a.vm, u = a.template;
                setTemplateProps(s, e, this.$handle.fCreateApi), s.$off("input"), s.$on("input", function (r) {
                    t.onInput(e, r)
                });
                var l = u.render.call(s);
                return void 0 === l.data && (l.data = {}), l.key = i, l
            }
        }, {
            key: "renderParser", value: function (e, t) {
                if (e.vData.get(), this.setGlobalConfig(e), !this.cache[e.id] || "template" === e.type) {
                    var r, n = e.type, i = e.rule, o = this.$form;
                    if ("template" === n && i.template) {
                        if (r = this.renderTemplate(e), t) return this.setCache(e, r, t), r
                    } else if (this.$handle.isNoVal(e)) {
                        if (r = this.defaultRender(e, this.renderChildren(e)), t) return this.setCache(e, r, t), r
                    } else {
                        var a = this.renderChildren(e);
                        r = e.render ? e.render(a) : this.defaultRender(e, a)
                    }
                    return !0 !== i.native && (r = o.container(r, e)), this.setCache(e, r, t), r
                }
                return this.getCache(e)
            }
        }, {
            key: "toData", value: function (e, t) {
                return Object.keys(e.vData._data).forEach(function (r) {
                    void 0 !== t[r] && e.vData[r](t[r])
                }), e.vData
            }
        }, {
            key: "parserToData", value: function (e) {
                return this.toData(e, e.rule)
            }
        }, {
            key: "inputVData", value: function (e, t) {
                var r = this, n = e.refName, i = e.key;
                this.parserToData(e);
                var o = e.vData.ref(n).key("fc_item" + i).props("formCreate", this.$handle.fCreateApi);
                return t || o.on("input", function (t) {
                    r.onInput(e, t)
                }).props("value", this.$handle.getFormData(e)), this.$form.inputVData && this.$form.inputVData(e, t), o
            }
        }, {
            key: "onInput", value: function (e, t) {
                this.$handle.onInput(e, t)
            }
        }, {
            key: "renderChildren", value: function (e) {
                var t = this, r = e.rule.children, n = this.orgChildren[e.id];
                return isValidChildren(r) ? (this.orgChildren[e.id].forEach(function (e) {
                    -1 === r.indexOf(e) && !isString(e) && e.__fc__ && t.$handle.removeField(e.__fc__)
                }), r.map(function (r) {
                    return isString(r) ? r : r.__fc__ ? t.renderParser(r.__fc__, e) : void(r.type && $de(function () {
                        return t.$handle.reloadRule()
                    }))
                })) : (n.forEach(function (e) {
                    !isString(e) && e.__fc__ && t.$handle.removeField(e.__fc__)
                }), this.orgChildren[e.id] = [], [])
            }
        }, {
            key: "defaultRender", value: function (e, t) {
                return this.vNode[e.type] ? this.vNode[e.type](this.inputVData(e), t) : this.vNode[e.originType] ? this.vNode[e.originType](this.inputVData(e), t) : this.vNode.make(e.originType, this.inputVData(e), t)
            }
        }]), e
    }();

    function setTemplateProps(e, t, r) {
        if (e.$props) {
            var n = t.rule, i = Object.keys(e.$props);
            i.forEach(function (t) {
                void 0 !== n.props[t] && (e.$props[t] = n.props[t])
            }), -1 !== i.indexOf("value") && (e.$props.value = t.rule.value), e.$props.formCreate = r
        }
    }

    function baseApi(e) {
        function t(t) {
            var r = arguments.length > 1 && void 0 !== arguments[1] && arguments[1];
            return t ? Array.isArray(t) || (t = [t]) : t = r ? Object.keys(e.fieldList) : e.fields(), t
        }

        return {
            formData: function () {
                var t = e.fieldList;
                return Object.keys(t).reduce(function (e, r) {
                    var n = t[r];
                    return e[n.field] = deepExtend({}, {value: n.rule.value}).value, e
                }, {})
            }, getValue: function (t) {
                var r = e.fieldList[t];
                if (r) return deepExtend({}, {value: r.rule.value}).value
            }, setValue: function (t, r) {
                var n = t;
                isPlainObject(t) || (n = _defineProperty({}, t, r)), Object.keys(n).forEach(function (t) {
                    var r = e.fieldList[t];
                    r && (r.rule.value = n[t])
                })
            }, changeValue: function (e, t) {
                this.setValue(e, t)
            }, changeField: function (e, t) {
                this.setValue(e, t)
            }, removeField: function (t) {
                var r = e.getParser(t);
                if (r) {
                    var n = r.root.map(function (e) {
                        return e.__field__
                    }).indexOf(t);
                    if (-1 !== n) return r.root.splice(n, 1), -1 === e.sortList.indexOf(r.id) && this.reload(), r.rule.__origin__
                }
            }, destroy: function () {
                e.vm.$el.parentNode.removeChild(e.vm.$el), e.vm.$destroy()
            }, fields: function () {
                return e.fields()
            }, append: function (t, r, n) {
                var i = Object.keys(e.fieldList), o = e.sortList.length, a = e.rules;
                if (t.field && -1 !== i.indexOf(t.field)) return console.error("".concat(t.field, " 字段已存在") + errMsg());
                var s = e.getParser(r);
                s && (n ? (a = s.rule.children, o = s.rule.children.length) : o = s.root.indexOf(s.rule.__origin__)), a.splice(o + 1, 0, t)
            }, prepend: function (t, r, n) {
                var i = Object.keys(e.fieldList), o = 0, a = e.rules;
                if (t.field && -1 !== i.indexOf(t.field)) return console.error("".concat(t.field, " 字段已存在") + errMsg());
                var s = e.getParser(r);
                s && (n ? a = s.rule.children : o = s.root.indexOf(s.rule.__origin__)), a.splice(o, 0, t)
            }, hidden: function (r, n) {
                var i = e.$form.hidden;
                t(n, !0).forEach(function (t) {
                    var n = e.getParser(t);
                    n && (r && -1 === i.indexOf(n) ? i.push(n) : r || -1 === i.indexOf(n) || i.splice(i.indexOf(n), 1), e.$render.clearCache(n, !0))
                }), e.refresh()
            }, hiddenStatus: function (t) {
                var r = e.getParser(t);
                return -1 !== e.$form.hidden.indexOf(r)
            }, visibility: function (r, n) {
                var i = e.$form.visibility;
                t(n, !0).forEach(function (t) {
                    var n = e.getParser(t);
                    n && (r && -1 === i.indexOf(n) ? i.push(n) : r || -1 === i.indexOf(n) || i.splice(i.indexOf(n), 1), e.$render.clearCache(n, !0))
                }), e.refresh()
            }, visibilityStatus: function (t) {
                var r = e.getParser(t);
                return -1 !== e.$form.visibility.indexOf(r)
            }, disabled: function (r, n) {
                t(n, !0).forEach(function (t) {
                    var n = e.fieldList[t];
                    n && e.vm.$set(n.rule.props, "disabled", !!r)
                })
            }, model: function () {
                return Object.keys(e.trueData).reduce(function (t, r) {
                    return t[r] = e.trueData[r].rule, t
                }, {})
            }, component: function () {
                return Object.keys(e.customData).reduce(function (t, r) {
                    return t[r] = e.customData[r].rule, t
                }, {})
            }, bind: function () {
                var t = {}, r = {};
                return Object.keys(e.fieldList).forEach(function (t) {
                    var n = e.fieldList[t];
                    r[t] = {
                        get: function () {
                            return n.rule.value
                        }, set: function (e) {
                            n.rule.value = e
                        }, enumerable: !0, configurable: !0
                    }
                }), Object.defineProperties(t, r), t
            }, submitBtnProps: function () {
                var t = arguments.length > 0 && void 0 !== arguments[0] ? arguments[0] : {};
                e.vm._buttonProps(t)
            }, resetBtnProps: function () {
                var t = arguments.length > 0 && void 0 !== arguments[0] ? arguments[0] : {};
                e.vm._resetProps(t)
            }, set: function (t, r, n) {
                e.vm.$set(t, r, n)
            }, reload: function (t) {
                e.reloadRule(t)
            }, updateOptions: function (t) {
                deepExtend(e.options, t), this.refresh(!0)
            }, onSubmit: function (e) {
                this.options({onSubmit: e})
            }, sync: function (t) {
                var r = e.getParser(t);
                r && (e.$render.clearCache(r, !0), e.refresh())
            }, refresh: function (t) {
                t && e.$render.clearCacheAll(), e.refresh()
            }, hideForm: function (t) {
                e.vm.isShow = !t
            }, changeStatus: function () {
                return e.changeStatus
            }, clearChangeStatus: function () {
                e.changeStatus = !1
            }, updateRule: function (t, r, n) {
                var i = e.getParser(t);
                if (i) return n ? Object.keys(r).forEach(function (e) {
                    i.rule[e] = r[e]
                }) : deepExtend(i.rule, r), i.rule.__origin__
            }, getRule: function (t) {
                var r = e.getParser(t);
                if (r) return r.rule
            }, updateRules: function (e, t) {
                var r = this;
                Object.keys(e).forEach(function (n) {
                    r.updateRule(n, e[n], t)
                })
            }, updateValidate: function (t, r, n) {
                var i = e.getParser(t);
                i && (i.rule.validate = n ? i.rule.validate.concat(r) : r)
            }, updateValidates: function (e, t) {
                var r = this;
                Object.keys(e).forEach(function (n) {
                    r.updateValidate(n, e[n], t)
                })
            }, method: function (e, t) {
                var r = this.el(e);
                if (!r || !r[t]) throw new Error("方法不存在" + errMsg());
                return function () {
                    for (var e = arguments.length, n = new Array(e), i = 0; i < e; i++) n[i] = arguments[i];
                    r[t](n)
                }
            }, toJson: function () {
                return toJson(this.rule)
            }, on: function () {
                var t;
                (t = e.vm).$on.apply(t, arguments)
            }, once: function () {
                var t;
                (t = e.vm).$once.apply(t, arguments)
            }, off: function () {
                var t;
                (t = e.vm).$off.apply(t, arguments)
            }, trigger: function (e, t) {
                for (var r = this.el(e), n = arguments.length, i = new Array(n > 2 ? n - 2 : 0), o = 2; o < n; o++) i[o - 2] = arguments[o];
                r && r.$emit.apply(r, [t].concat(i))
            }, el: function (t) {
                var r = e.getParser(t);
                if (r) return r.el
            }
        }
    }

    function getRule(e) {
        return isFunction(e.getRule) ? e.getRule() : e
    }

    var Handle = function () {
        function e(t) {
            _classCallCheck(this, e);
            var r = t.vm, n = t.rules, i = t.options;
            this.watching = !1, this.vm = r, this.fc = t, this.id = uniqueId(), this.options = i, this.validate = {}, this.formData = {}, this.fCreateApi = void 0, this.__init(n), this.$form = new t.drive.formRender(this, this.id), this.$render = new Render(this), this.loadRule(this.rules, !1), this.$render.initOrgChildren(), this.$form.init()
        }

        return _createClass(e, [{
            key: "__init", value: function (e) {
                this.fieldList = {}, this.trueData = {}, this.parsers = {}, this.customData = {}, this.sortList = [], this.rules = e, this.origin = _toConsumableArray(this.rules), this.changeStatus = !1
            }
        }, {
            key: "loadRule", value: function (e, t) {
                var r = this;
                e.map(function (e) {
                    if (!t || !isString(e)) {
                        if (!e.type) return console.error("未定义生成规则的 type 字段" + errMsg());
                        var n;
                        if (e.__fc__) {
                            if ((n = e.__fc__).vm !== r.vm && !n.deleted) return console.error("".concat(e.type, "规则正在其他的 <form-create> 中使用") + errMsg());
                            n.update(r);
                            var i = n.rule;
                            r.parseOn(i), r.parseProps(i)
                        } else n = r.createParser(r.parseRule(e));
                        var o = n.rule.children, a = n.rule;
                        return r.notField(n.field) ? (r.setParser(n), e.__fc__ || bindParser(e, n), isValidChildren(o) && r.loadRule(o, !0), t || r.sortList.push(n.id), r.isNoVal(n) || Object.defineProperty(n.rule, "value", {
                            get: function () {
                                return n.toValue(r.getFormData(n))
                            }, set: function (e) {
                                r.isChange(n, e) && (r.$render.clearCache(n, !0), r.setFormData(n, n.toFormValue(e)))
                            }
                        }), n) : console.error("".concat(a.field, " 字段已存在") + errMsg())
                    }
                }).filter(function (e) {
                    return e
                }).forEach(function (t) {
                    t.root = e
                })
            }
        }, {
            key: "createParser", value: function (e) {
                var t = this.id + "" + uniqueId(), r = this.fc.parsers, n = toString(e.type).toLocaleLowerCase();
                return new (r[n] ? r[n] : BaseParser)(this, e, t)
            }
        }, {
            key: "parseRule", value: function (e) {
                var t = defRule(), r = getRule(e);
                return Object.defineProperties(r, {__origin__: enumerable(e)}), Object.keys(t).forEach(function (e) {
                    isUndef(r[e]) && $set(r, e, t[e])
                }), r.field && void 0 !== this.options.formData[r.field] && (r.value = this.options.formData[r.field]), r.options = parseArray(r.options), this.parseOn(r), this.parseProps(r), r
            }
        }, {
            key: "parseOn", value: function (e) {
                this.parseInjectEvent(e, e.on || {}), this.watching || this.margeEmit(e)
            }
        }, {
            key: "margeEmit", value: function (e) {
                var t = this.parseEmit(e);
                Object.keys(t).length > 0 && extend(e.on, t)
            }
        }, {
            key: "parseProps", value: function (e) {
                this.parseInjectEvent(e, e.props || {})
            }
        }, {
            key: "parseInjectEvent", value: function (e, t) {
                var r = this;
                return (this.options.injectEvent || e.inject) && Object.keys(t).forEach(function (n) {
                    isFunction(t[n]) && (t[n] = r.inject(e, t[n]))
                }), t
            }
        }, {
            key: "getInjectData", value: function (e, t) {
                var r = this.vm.$options.propsData, n = r.option, i = r.rule;
                return {$f: this.fCreateApi, rule: i, self: e.__origin__, option: n, inject: t || i.inject || {}}
            }
        }, {
            key: "inject", value: function (e, t, r) {
                if (t.__inject) {
                    if (this.watching) return t;
                    t = t.__origin
                }
                var n = this, i = function () {
                    for (var i = arguments.length, o = new Array(i), a = 0; a < i; a++) o[a] = arguments[a];
                    o.unshift(n.getInjectData(e, r)), t.apply(void 0, o)
                };
                return i.__inject = !0, i.__origin = t, i
            }
        }, {
            key: "parseEmit", value: function (e) {
                var t = this, r = {}, n = e.emit, i = e.emitPrefix, o = e.field;
                return Array.isArray(n) ? (n.forEach(function (n) {
                    var a, s = n;
                    if (isPlainObject(n) && (s = n.name, a = n.inject), s) {
                        var u = toLine("".concat(i || o, "-").concat(s)).replace("_", "-"), l = function () {
                            for (var e, r = arguments.length, n = new Array(r), i = 0; i < r; i++) n[i] = arguments[i];
                            (e = t.vm).$emit.apply(e, [u].concat(n))
                        };
                        l.__emit = !0, r[s] = t.options.injectEvent || void 0 !== n.inject ? t.inject(e, l, a) : l
                    }
                }), r) : r
            }
        }, {
            key: "run", value: function () {
                return this.vm.unique > 0 ? this.$render.run() : (this.vm.unique = 1, [])
            }
        }, {
            key: "setParser", value: function (e) {
                var t = e.id, r = e.field, n = e.name, i = e.rule;
                this.parsers[t] || (this.parsers[t] = e, n && $set(this.customData, n, e), this.isNoVal(e) || (this.fieldList[r] = e, $set(this.formData, r, e.toFormValue(i.value)), $set(this.validate, r, i.validate || []), $set(this.trueData, r, e)))
            }
        }, {
            key: "notField", value: function (e) {
                return void 0 === this.parsers[e]
            }
        }, {
            key: "isChange", value: function (e, t) {
                return JSON.stringify(e.rule.value) !== JSON.stringify(t)
            }
        }, {
            key: "onInput", value: function (e, t) {
                !this.isNoVal(e) && this.isChange(e, e.toValue(t)) && (this.$render.clearCache(e), this.setFormData(e, t), this.changeStatus = !0)
            }
        }, {
            key: "getParser", value: function (e) {
                return this.fieldList[e] ? this.fieldList[e] : this.customData[e] ? this.customData[e] : this.parsers[e] ? this.parsers[e] : void 0
            }
        }, {
            key: "created", value: function () {
                var e = this.vm;
                e.$set(e, "buttonProps", this.options.submitBtn), e.$set(e, "resetProps", this.options.resetBtn), e.$set(e, "formData", this.formData), void 0 === this.fCreateApi && (this.fCreateApi = this.fc.drive.getGlobalApi(this, baseApi(this))), this.fCreateApi.rule = this.rules, this.fCreateApi.config = this.options
            }
        }, {
            key: "addParserWitch", value: function (e) {
                var t = this, r = this.vm;
                Object.keys(e.rule).forEach(function (n) {
                    if (-1 === ["field", "type", "value", "vm", "template", "name", "config"].indexOf(n) && void 0 !== e.rule[n]) try {
                        e.watch.push(r.$watch(function () {
                            return e.rule[n]
                        }, function (r, i) {
                            void 0 !== i && (t.watching = !0, "validate" === n ? t.validate[e.field] = r : "props" === n ? t.parseProps(e.rule) : "on" === n ? t.parseOn(e.rule) : "emit" === n && t.margeEmit(e.rule), t.$render.clearCache(e), t.watching = !1)
                        }, {deep: "children" !== n, immediate: !0}))
                    } catch (e) {
                    }
                })
            }
        }, {
            key: "mountedParser", value: function () {
                var e = this, t = this.vm;
                Object.keys(this.parsers).forEach(function (r) {
                    var n = e.parsers[r];
                    0 === n.watch.length && e.addParserWitch(n), n.el = t.$refs[n.refName] || {}, void 0 === n.defaultValue && (n.defaultValue = deepExtend({}, {value: n.rule.value}).value), n.mounted && n.mounted()
                })
            }
        }, {
            key: "mounted", value: function () {
                var e = this.options.mounted;
                this.mountedParser(), e && e(this.fCreateApi), this.fc.$emit("mounted", this.fCreateApi)
            }
        }, {
            key: "reload", value: function () {
                var e = this.options.onReload;
                this.mountedParser(), e && e(this.fCreateApi), this.fc.$emit("on-reload", this.fCreateApi)
            }
        }, {
            key: "removeField", value: function (e) {
                var t = e.id, r = e.field, n = this.sortList.indexOf(t);
                delParser(e), $del(this.parsers, t), -1 !== n && this.sortList.splice(n, 1), this.fieldList[r] || ($del(this.validate, r), $del(this.formData, r), $del(this.customData, r), $del(this.fieldList, r), $del(this.trueData, r))
            }
        }, {
            key: "refresh", value: function () {
                this.vm._refresh()
            }
        }, {
            key: "reloadRule", value: function (e) {
                var t = this, r = this.vm;
                if (!e) return this.reloadRule(this.rules);
                this.origin.length || this.fCreateApi.refresh(), this.origin = _toConsumableArray(e);
                var n = _objectSpread2({}, this.parsers);
                this.__init(e), this.loadRule(e, !1), Object.keys(n).filter(function (e) {
                    return void 0 === t.parsers[e]
                }).forEach(function (e) {
                    return t.removeField(n[e])
                }), this.$render.initOrgChildren(), this.created(), r.$nextTick(function () {
                    t.reload()
                }), r.$f = this.fCreateApi, this.$render.clearCacheAll(), this.refresh()
            }
        }, {
            key: "setFormData", value: function (e, t) {
                this.formData[e.field] = t
            }
        }, {
            key: "getFormData", value: function (e) {
                return this.formData[e.field]
            }
        }, {
            key: "fields", value: function () {
                return Object.keys(this.formData)
            }
        }, {
            key: "isNoVal", value: function (e) {
                return !e.isDef
            }
        }]), e
    }();

    function delParser(e) {
        e.watch.forEach(function (e) {
            return e()
        }), e.watch = [], e.deleted = !0, Object.defineProperty(e.rule, "value", {value: extend({}, {value: e.rule.value}).value})
    }

    function parseArray(e) {
        return Array.isArray(e) ? e : []
    }

    function defRule() {
        return {
            validate: [],
            col: {},
            emit: [],
            props: {},
            on: {},
            options: [],
            title: void 0,
            value: "",
            field: "",
            name: void 0,
            className: void 0
        }
    }

    function bindParser(e, t) {
        Object.defineProperties(e, {__field__: enumerable(t.field), __fc__: enumerable(t)})
    }

    var _vue = "undefined" != typeof window && window.Vue ? window.Vue : Vue;

    function createFormCreate(e) {
        var t = {}, r = {}, n = makerFactory(), i = e.getConfig(), o = {};

        function a(e, t) {
            e = toString(e), r[e.toLocaleLowerCase()] = t, h.maker[e] = creatorFactory(e)
        }

        function s() {
            return function (e) {
                function t() {
                    return _classCallCheck(this, t), _possibleConstructorReturn(this, _getPrototypeOf(t).apply(this, arguments))
                }

                return _inherits(t, BaseParser), t
            }()
        }

        function u(e, r) {
            var n = (e = toString(e)).toLocaleLowerCase();
            return "form-create" === n || "formcreate" === n ? c() : void 0 === r ? t[e] : void(t[e] = r)
        }

        function l(e, t) {
            isBool(t.sumbitBtn) && (t.sumbitBtn = {show: t.sumbitBtn}), isBool(t.resetBtn) && (t.resetBtn = {show: t.resetBtn});
            var r = deepExtend(e, t);
            return $set(r, "el", r.el ? isElement(r.el) ? r.el : document.querySelector(r.el) : window.document.body), r
        }

        function c() {
            return _vue.extend($FormCreate(h, t))
        }

        function f(t) {
            extend(t, {
                version: e.version,
                ui: e.ui,
                maker: n,
                component: u,
                setParser: a,
                createParser: s,
                data: o,
                $form: function () {
                    return c()
                },
                parseJson: function (e) {
                    return parseJson(e)
                }
            })
        }

        function d(e, t) {
            var r = new _vue({
                data: function () {
                    return {rule: e, option: isElement(t) ? {el: t} : t}
                }, render: function () {
                    return (0, arguments[0])("form-create", helper([{ref: "fc"}, {props: this.$data}]))
                }
            });
            return r.$mount(), r
        }

        var h = function () {
            function t(n) {
                var o = arguments.length > 1 && void 0 !== arguments[1] ? arguments[1] : {};
                _classCallCheck(this, t), this.fCreateApi = void 0, this.drive = e, this.parsers = r, this.vm = void 0, this.rules = Array.isArray(n) ? n : [], this.options = l(deepExtend({formData: {}}, i), o)
            }

            return _createClass(t, [{
                key: "beforeCreate", value: function (e) {
                    this.vm = e, this.handle = new Handle(this)
                }
            }, {
                key: "created", value: function () {
                    this.handle.created()
                }
            }, {
                key: "api", value: function () {
                    return this.handle.fCreateApi
                }
            }, {
                key: "render", value: function () {
                    return this.handle.run()
                }
            }, {
                key: "mounted", value: function () {
                    this.handle.mounted()
                }
            }, {
                key: "$emit", value: function (e) {
                    for (var t, r, n = arguments.length, i = new Array(n > 1 ? n - 1 : 0), o = 1; o < n; o++) i[o - 1] = arguments[o];
                    this.$parent && (t = this.$parent).$emit.apply(t, ["fc:".concat(e)].concat(i)), (r = this.vm).$emit.apply(r, [e].concat(i))
                }
            }], [{
                key: "create", value: function (e) {
                    var t = arguments.length > 1 && void 0 !== arguments[1] ? arguments[1] : {},
                        r = arguments.length > 2 ? arguments[2] : void 0, n = d(e, t), i = n.$refs.fc.formCreate;
                    return i.parent = r, i.options.el.appendChild(n.$el), i.handle.fCreateApi
                }
            }, {
                key: "install", value: function (e) {
                    var r = function (e) {
                        var r = arguments.length > 1 && void 0 !== arguments[1] ? arguments[1] : {};
                        return t.create(e, r, this)
                    };
                    f(r), e.prototype.$formCreate = r, e.component(formCreateName, c()), _vue = e
                }
            }, {
                key: "init", value: function (e) {
                    var t = d(e, arguments.length > 1 && void 0 !== arguments[1] ? arguments[1] : {}),
                        r = t.$refs.fc.formCreate;
                    return {
                        mount: function (e) {
                            return e && isElement(e) && (r.options.el = e), r.options.el.appendChild(t.$el), r.handle.fCreateApi
                        }, remove: function () {
                            r.options.el.removeChild(t.$el)
                        }, destroy: function () {
                            this.remove(), t.$destroy()
                        }, $f: r.handle.fCreateApi
                    }
                }
            }]), t
        }();
        return f(h), e.components.forEach(function (e) {
            h.component(e.name, e)
        }), e.parsers.forEach(function (e) {
            var t = e.name, r = e.parser;
            h.setParser(t, r)
        }), Object.keys(e.makers).forEach(function (t) {
            h.maker[t] = e.makers[t]
        }), {
            FormCreate: h, install: function (e, t) {
                !0 !== e._installedFormCreate && (e._installedFormCreate = !0, t && isPlainObject(t) && l(i, t), e.use(h))
            }
        }
    }

    var BaseForm = function () {
        function e(t) {
            _classCallCheck(this, e), this.$handle = t, this.vm = t.vm, this.drive = this.$handle.fc.drive, this.options = t.options, this.vNode = new VNode(this.vm), this.vData = new VData, this.unique = t.id
        }

        return _createClass(e, [{
            key: "init", value: function () {
                this.$render = this.$handle.$render
            }
        }, {
            key: "getGetCol", value: function (e) {
                var t = e.rule.col || {}, r = {}, n = {};
                return this.options.global ? (this.options.global["*"] && (r = this.options.global["*"].col || {}), this.options.global[e.type] && (n = this.options.global[e.type].col || {}), t = deepExtend(deepExtend(deepExtend({}, r), n), t)) : t
            }
        }, {
            key: "beforeRender", value: function () {
            }
        }, {
            key: "render", value: function () {
            }
        }, {
            key: "inputVData", value: function () {
            }
        }]), e
    }(), vNode = new VNode, Modal = function (e, t) {
        return {
            name: "fc-modal", data: function () {
                return _objectSpread2({value: !0}, e)
            }, render: function () {
                return vNode.setVm(this), vNode.modal({
                    props: this.$data,
                    on: {"on-visible-change": this.remove}
                }, [t(vNode, this)])
            }, methods: {
                onClose: function () {
                    this.value = !1
                }, remove: function () {
                    this.$el.parentNode.removeChild(this.$el)
                }
            }
        }
    };

    function mount(e, t) {
        var r = (new (_vue.extend(Modal(e, t)))).$mount();
        window.document.body.appendChild(r.$el)
    }

    function defaultOnHandle(e, t) {
        mount({title: t, footerHide: !0}, function (t) {
            return t.make("img", {style: {width: "100%"}, attrs: {src: e}})
        })
    }

    function styleInject(e, t) {
        void 0 === t && (t = {});
        var r = t.insertAt;
        if (e && "undefined" != typeof document) {
            var n = document.head || document.getElementsByTagName("head")[0], i = document.createElement("style");
            i.type = "text/css", "top" === r && n.firstChild ? n.insertBefore(i, n.firstChild) : n.appendChild(i), i.styleSheet ? i.styleSheet.cssText = e : i.appendChild(document.createTextNode(e))
        }
    }

    var css = ".fc-upload-btn, .fc-files {\n    display: inline-block;\n    width: 58px;\n    height: 58px;\n    text-align: center;\n    line-height: 58px;\n    border: 1px solid #c0ccda;\n    border-radius: 4px;\n    overflow: hidden;\n    background: #fff;\n    position: relative;\n    box-shadow: 2px 2px 5px rgba(0, 0, 0, .1);\n    margin-right: 4px;\n    box-sizing: border-box;\n}\n\n.form-create .__fc_h {\n    display: none;\n}\n\n.form-create .__fc_v {\n    visibility: hidden;\n}\n\n.fc-files img {\n    width: 100%;\n    height: 100%;\n    display: inline-block;\n    vertical-align: top;\n}\n\n.fc-upload-btn {\n    border: 1px dashed #c0ccda;\n    cursor: pointer;\n}\n\n.fc-upload .fc-upload-cover {\n    opacity: 0;\n    position: absolute;\n    top: 0;\n    bottom: 0;\n    left: 0;\n    right: 0;\n    background: rgba(0, 0, 0, .6);\n    transition: opacity .3s;\n}\n\n.fc-upload .fc-upload-cover i {\n    color: #fff;\n    font-size: 20px;\n    cursor: pointer;\n    margin: 0 2px;\n}\n\n.fc-files:hover .fc-upload-cover {\n    opacity: 1;\n}\n\n.fc-hide-btn .ivu-upload .ivu-upload {\n    display: none;\n}\n\n.fc-upload .ivu-upload-list {\n    margin-top: 0;\n}",
        style = {
            "fc-upload-btn": "fc-upload-btn",
            "fc-files": "fc-files",
            "form-create": "form-create",
            __fc_h: "__fc_h",
            __fc_v: "__fc_v",
            "fc-upload": "fc-upload",
            "fc-upload-cover": "fc-upload-cover",
            "fc-hide-btn": "fc-hide-btn",
            "ivu-upload": "ivu-upload",
            "ivu-upload-list": "ivu-upload-list"
        };
    styleInject(css);
    var NAME$1 = "fc-iview-frame", frame = {
        name: NAME$1,
        props: {
            type: {type: String, default: "input"},
            field: {type: String, default: ""},
            helper: {type: Boolean, default: !0},
            disabled: {type: Boolean, default: !1},
            src: {type: String, required: !0},
            icon: {type: String, default: iviewConfig.fileUpIcon},
            width: {type: [Number, String], default: 500},
            height: {type: [Number, String], default: 370},
            maxLength: {type: Number, default: 0},
            okBtnText: {type: String, default: "确定"},
            closeBtnText: {type: String, default: "关闭"},
            modalTitle: {type: String, default: "预览"},
            handleIcon: {type: [String, Boolean], default: void 0},
            title: String,
            allowRemove: {type: Boolean, default: !0},
            onOpen: {
                type: Function, default: function () {
                }
            },
            onOk: {
                type: Function, default: function () {
                }
            },
            onCancel: {
                type: Function, default: function () {
                }
            },
            onLoad: {
                type: Function, default: function () {
                }
            },
            onBeforeRemove: {
                type: Function, default: function () {
                }
            },
            onRemove: {
                type: Function, default: function () {
                }
            },
            onHandle: {
                type: Function, default: function (e) {
                    defaultOnHandle(e, this.modalTitle)
                }
            },
            modal: {
                type: Object, default: function () {
                    return {}
                }
            },
            value: [Array, String, Number]
        },
        data: function () {
            return {modalVm: null, fileList: toArray(this.value), unique: uniqueId()}
        },
        watch: {
            value: function (e) {
                this.$emit("on-change", e), this.fileList = toArray(e)
            }, fileList: function (e) {
                this.$emit("input", 1 === this.maxLength ? e[0] || "" : e)
            }
        },
        methods: {
            key: function (e) {
                return NAME$1 + e + this.unique
            }, closeModel: function () {
                this.modalVm && this.modalVm.onClose(), this.modalVm = null
            }, showModel: function () {
                var e = this;
                if (!this.disabled && !1 !== this.onOpen()) {
                    var t = this.$props, r = t.width, n = t.height, i = t.src, o = t.title, a = t.okBtnText,
                        s = t.closeBtnText;
                    mount(_objectSpread2({width: r, title: o}, this.modal), function (t, r) {
                        return e.modalVm = r, [t.make("iframe", {
                            attrs: {src: i},
                            style: {height: n, border: "0 none", width: "100%"},
                            on: {
                                load: function (t) {
                                    e.onLoad(t);
                                    try {
                                        if (!0 === e.helper) t.path[0].contentWindow.form_create_helper = {
                                            close: function (t) {
                                                e.valid(t), r.onClose()
                                            }, set: function (t, r) {
                                                e.valid(t), e.disabled || e.$emit("input", r)
                                            }, get: function (t) {
                                                return e.valid(t), e.value
                                            }
                                        }
                                    } catch (t) {
                                        console.log(t)
                                    }
                                }
                            }
                        }), t.make("div", {slot: "footer"}, [t.button({
                            on: {
                                click: function () {
                                    !1 !== e.onCancel() && r.onClose()
                                }
                            }
                        }, [s]), t.button({
                            props: {type: "primary"}, on: {
                                click: function () {
                                    !1 !== e.onOk() && r.onClose()
                                }
                            }
                        }, [a])])]
                    })
                }
            }, makeInput: function () {
                var e = this, t = this.$createElement,
                    r = {type: "text", value: this.fileList.toString(), icon: this.icon, readonly: !0, clearable: !1};
                return t("Input", helper([{}, {props: r}, {}, {
                    on: {
                        "on-click": function () {
                            return e.showModel()
                        }
                    }
                }, {key: this.key("input")}]))
            }, makeGroup: function (e) {
                var t = this.$createElement;
                return (!this.maxLength || this.fileList.length < this.maxLength) && e.push(this.makeBtn()), t("div", {
                    class: style["fc-upload"],
                    key: this.key("group")
                }, _toConsumableArray(e))
            }, makeItem: function (e, t) {
                return (0, this.$createElement)("div", {
                    class: style["fc-files"],
                    key: this.key("file" + e)
                }, _toConsumableArray(t))
            }, valid: function (e) {
                if (e !== this.field) throw new Error("frame 无效的字段值")
            }, makeIcons: function (e, t) {
                var r = this.$createElement;
                if (!1 !== this.handleIcon || !0 === this.allowRemove) {
                    var n = [];
                    return ("file" !== this.type && !1 !== this.handleIcon || "file" === this.type && this.handleIcon) && n.push(this.makeHandleIcon(e, t)), this.allowRemove && n.push(this.makeRemoveIcon(e, t)), r("div", {
                        class: style["fc-upload-cover"],
                        key: this.key("uc")
                    }, [n])
                }
            }, makeHandleIcon: function (e, t) {
                var r = this;
                return (0, this.$createElement)("icon", helper([{}, {props: {type: !0 === this.handleIcon || void 0 === this.handleIcon ? "ios-eye-outline" : this.handleIcon}}, {
                    on: {
                        click: function () {
                            return r.handleClick(e)
                        }
                    }, key: this.key("hi" + t)
                }]))
            }, makeRemoveIcon: function (e, t) {
                var r = this;
                return (0, this.$createElement)("icon", helper([{}, {props: {type: "ios-trash-outline"}}, {
                    on: {
                        click: function () {
                            return r.handleRemove(e)
                        }
                    }, key: this.key("ri" + t)
                }]))
            }, makeFiles: function () {
                var e = this, t = this.$createElement;
                return this.makeGroup(this.fileList.map(function (r, n) {
                    return e.makeItem(n, [t("icon", helper([{}, {
                        props: {
                            type: iviewConfig.fileIcon,
                            size: 40
                        }
                    }, {
                        on: {
                            click: function () {
                                return e.handleClick(r)
                            }
                        }
                    }])), e.makeIcons(r, n)])
                }))
            }, makeImages: function () {
                var e = this, t = this.$createElement;
                return this.makeGroup(this.fileList.map(function (r, n) {
                    return e.makeItem(n, [t("img", {attrs: {src: r}}), e.makeIcons(r, n)])
                }))
            }, makeBtn: function () {
                var e = this, t = this.$createElement;
                return t("div", {
                    class: style["fc-upload-btn"], on: {
                        click: function () {
                            return e.showModel()
                        }
                    }, key: this.key("btn")
                }, [t("icon", helper([{}, {props: {type: this.icon, size: 20}}]))])
            }, handleClick: function (e) {
                if (!this.disabled) return this.onHandle(e)
            }, handleRemove: function (e) {
                this.disabled || !1 !== this.onBeforeRemove(e) && (this.fileList.splice(this.fileList.indexOf(e), 1), this.onRemove(e))
            }
        },
        render: function () {
            var e = this.type;
            return "input" === e ? this.makeInput() : "image" === e ? this.makeImages() : this.makeFiles()
        }
    }, NAME$2 = "fc-iview-radio", radio = {
        name: NAME$2, functional: !0, props: {
            options: {
                type: Array, default: function () {
                    return []
                }
            }, unique: {
                default: function () {
                    return uniqueId()
                }
            }
        }, render: function (e, t) {
            return e("RadioGroup", helper([{}, t.data]), [t.props.options.map(function (r, n) {
                var i = _objectSpread2({}, r);
                return delete i.value, e("Radio", {props: _objectSpread2({}, i), key: NAME$2 + n + t.props.unique})
            }).concat(t.chlidren)])
        }
    }, NAME$3 = "fc-iview-select", select = {
        name: NAME$3, functional: !0, props: {
            options: {
                type: Array, default: function () {
                    return []
                }
            }, unique: {
                default: function () {
                    return uniqueId()
                }
            }
        }, render: function (e, t) {
            return e("Select", helper([{}, t.data]), [t.props.options.map(function (r, n) {
                var i = r.slot ? toDefSlot(r.slot, e) : [];
                return e("Option", {props: _objectSpread2({}, r), key: NAME$3 + n + t.props.unique}, [i])
            }).concat(t.chlidren)])
        }
    }, tree = {
        name: "fc-iview-tree", props: {
            ctx: {
                type: Object, default: function () {
                    return {props: {}}
                }
            }, children: {
                type: Array, default: function () {
                    return []
                }
            }, type: {type: String, default: "checked"}, value: {
                type: [Array, String, Number], default: function () {
                    return []
                }
            }
        }, data: function () {
            return {treeData: []}
        }, watch: {
            value: function (e) {
                e = toArray(e);
                var t = this.$refs.tree.data;
                "selected" === this.type ? this.selected(t, e) : this.checked(t, e)
            }
        }, methods: {
            selected: function (e, t) {
                var r = this;
                e.forEach(function (e) {
                    r.$set(e, "selected", -1 !== t.indexOf(e.id)), void 0 !== e.children && Array.isArray(e.children) && r.selected(e.children, t)
                })
            }, checked: function (e, t) {
                var r = this;
                e.forEach(function (e) {
                    r.$set(e, "checked", -1 !== t.indexOf(e.id)), void 0 !== e.children && Array.isArray(e.children) && r.checked(e.children, t)
                })
            }, makeTree: function () {
                return (0, this.$createElement)("Tree", helper([{ref: "tree"}, this.ctx]), [this.children])
            }, updateTreeData: function () {
                var e = this.type.toLocaleLowerCase();
                this.treeData = "selected" === e ? this.$refs.tree.getSelectedNodes() : this.$refs.tree.getCheckedNodes(), this.$emit("input", this.treeData.map(function (e) {
                    return e.id
                }))
            }
        }, render: function () {
            return this.makeTree()
        }, mounted: function () {
            var e = this;
            this.$nextTick(function () {
                e.$watch(function () {
                    return e.$refs.tree.flatState
                }, function () {
                    return e.updateTreeData()
                })
            })
        }
    };

    function parseFile(e) {
        return {url: e, name: getFileName(e)}
    }

    function getFileName(e) {
        return toString(e).split("/").pop()
    }

    var NAME$4 = "fc-iview-upload", upload = {
            name: NAME$4, props: {
                ctx: {
                    type: Object, default: function () {
                        return {props: {}}
                    }
                },
                children: {
                    type: Array, default: function () {
                        return []
                    }
                },
                onHandle: {
                    type: Function, default: function (e) {
                        defaultOnHandle(e.url, this.modalTitle)
                    }
                },
                uploadType: {type: String, default: "file"},
                maxLength: {type: Number, default: 0},
                allowRemove: {type: Boolean, default: !0},
                modalTitle: {type: String, default: "预览"},
                handleIcon: [String, Boolean],
                value: [Array, String]
            }, data: function () {
                return {uploadList: [], unique: uniqueId()}
            }, created: function () {
                void 0 === this.ctx.props.showUploadList && (this.ctx.props.showUploadList = !1), this.ctx.props.defaultFileList = toArray(this.value).map(parseFile)
            }, watch: {
                value: function (e) {
                    this.$refs.upload.fileList.every(function (e) {
                        return !e.status || "finished" === e.status
                    }) && (this.$refs.upload.fileList = toArray(e).map(parseFile), this.uploadList = this.$refs.upload.fileList)
                }, maxLength: function (e, t) {
                    1 !== t && 1 !== e || this.update()
                }
            }, methods: {
                key: function (e) {
                    return NAME$4 + e + this.unique
                }, isDisabled: function () {
                    return !0 === this.ctx.props.disabled
                }, onRemove: function (e) {
                    this.isDisabled() || this.$refs.upload.handleRemove(e)
                }, handleClick: function (e) {
                    this.isDisabled() || this.onHandle(e)
                }, makeDefaultBtn: function () {
                    var e = this.$createElement;
                    return e("div", {class: style["fc-upload-btn"]}, [e("icon", helper([{}, {
                        props: {
                            type: "file" === this.uploadType ? "ios-cloud-upload-outline" : iviewConfig.imgUpIcon,
                            size: 20
                        }
                    }]))])
                }, makeItem: function (e, t) {
                    var r = this.$createElement;
                    return "image" === this.uploadType ? r("img", {
                        attrs: {src: e.url},
                        key: this.key("img" + t)
                    }) : r("icon", helper([{}, {props: {type: iviewConfig.fileIcon, size: 40}}, {key: this.key("i" + t)}]))
                }, makeRemoveIcon: function (e, t) {
                    var r = this;
                    return (0, this.$createElement)("icon", {
                        attrs: {type: "ios-trash-outline"}, on: {
                            click: function () {
                                return r.onRemove(e)
                            }
                        }, key: this.key("ri" + t)
                    })
                }, makeHandleIcon: function (e, t) {
                    var r = this;
                    return (0, this.$createElement)("icon", {
                        attrs: {type: !0 === this.handleIcon || void 0 === this.handleIcon ? "ios-eye-outline" : this.handleIcon},
                        on: {
                            click: function () {
                                return r.handleClick(e)
                            }
                        },
                        key: this.key("hi" + t)
                    })
                }, makeProgress: function (e, t) {
                    return (0, this.$createElement)("Progress", helper([{}, {
                        props: {
                            percent: e.percentage,
                            hideInfo: !0
                        }
                    }, {style: "width:90%", key: this.key("pg" + t)}]))
                }, makeIcons: function (e, t) {
                    var r = this.$createElement, n = [];
                    if (this.allowRemove || !1 !== this.handleIcon) return ("file" !== this.uploadType && !1 !== this.handleIcon || "file" === this.uploadType && this.handleIcon) && n.push(this.makeHandleIcon(e, t)), this.allowRemove && n.push(this.makeRemoveIcon(e, t)), r("div", {class: style["fc-upload-cover"]}, [n])
                }, makeFiles: function () {
                    var e = this, t = this.$createElement;
                    return this.uploadList.map(function (r, n) {
                        return t("div", {
                            key: e.key(n),
                            class: style["fc-files"]
                        }, [r.showProgress ? e.makeProgress(r, n) : [e.makeItem(r, n), e.makeIcons(r, n)]])
                    })
                }, makeUpload: function () {
                    return (0, this.$createElement)("Upload", helper([{
                        ref: "upload",
                        style: {display: "inline-block"}
                    }, this.ctx, {key: this.key("upload")}]), [this.children])
                }, initChildren: function () {
                    hasSlot(this.children, "default") || this.children.push(this.makeDefaultBtn())
                }, update: function () {
                    var e = this.$refs.upload.fileList.map(function (e) {
                        return e.url
                    }).filter(function (e) {
                        return void 0 !== e
                    });
                    this.$emit("input", 1 === this.maxLength ? e[0] || "" : e)
                }
            }, render: function () {
                var e, t = arguments[0], r = !this.maxLength || this.maxLength > this.uploadList.length;
                return this.$refs.upload && (void 0 === this.ctx.props.showUploadList && (this.ctx.props.showUploadList = this.$refs.upload.showUploadList), this.ctx.props.defaultFileList = this.$refs.upload.defaultFileList), this.initChildren(), t("div", {class: (e = {}, _defineProperty(e, style["fc-upload"], !0), _defineProperty(e, style["fc-hide-btn"], !r), e)}, [[this.ctx.props.showUploadList ? [] : this.makeFiles(), this.makeUpload()]])
            }, mounted: function () {
                var e = this;
                this.uploadList = this.$refs.upload.fileList, this.$watch(function () {
                    return e.$refs.upload.fileList
                }, function () {
                    e.update()
                }, {deep: !0})
            }
        }, components = [checkbox, frame, radio, select, tree, upload], parser = function (e) {
            function t() {
                return _classCallCheck(this, t), _possibleConstructorReturn(this, _getPrototypeOf(t).apply(this, arguments))
            }

            return _inherits(t, BaseParser), _createClass(t, [{
                key: "render", value: function (e) {
                    var t = this;
                    return this.vNode.checkbox({
                        props: {
                            ctx: this.$render.inputVData(this, !0).get(),
                            options: this.rule.options,
                            value: this.$handle.getFormData(this),
                            children: e
                        }, on: {
                            input: function (e) {
                                t.$render.onInput(t, e)
                            }
                        }
                    })
                }
            }]), t
        }(), name = "checkbox", checkbox$1 = {parser: parser, name: name}, Parser = function (e) {
            function t() {
                return _classCallCheck(this, t), _possibleConstructorReturn(this, _getPrototypeOf(t).apply(this, arguments))
            }

            return _inherits(t, BaseParser), _createClass(t, [{
                key: "init", value: function () {
                    var e = this.rule.props;
                    e.startDate && $set(e, "startDate", timeStampToDate(e.startDate))
                }
            }, {
                key: "mounted", value: function () {
                    var e = this;
                    this.toValue = function (t) {
                        var r = e.el.formatDate(t), n = e.el, i = n.type, o = n.separator,
                            a = -1 !== ["daterange", "datetimerange"].indexOf(i);
                        return r ? a ? r.split(o) : r : a ? ["", ""] : r
                    }
                }
            }]), t
        }(), name$1 = "datePicker", datePicker = {parser: Parser, name: name$1}, Parser$1 = function (e) {
            function t() {
                return _classCallCheck(this, t), _possibleConstructorReturn(this, _getPrototypeOf(t).apply(this, arguments))
            }

            return _inherits(t, BaseParser), _createClass(t, [{
                key: "render", value: function (e) {
                    var t = this.$render.inputVData(this).props("field", this.field);
                    return this.vNode.frame(t, e)
                }
            }, {
                key: "closeModel", value: function () {
                    this.el.closeModel && this.el.closeModel()
                }
            }]), t
        }(), name$2 = "frame", frame$1 = {parser: Parser$1, name: name$2}, name$3 = "hidden", parser$1 = function (e) {
            function t() {
                return _classCallCheck(this, t), _possibleConstructorReturn(this, _getPrototypeOf(t).apply(this, arguments))
            }

            return _inherits(t, BaseParser), _createClass(t, [{
                key: "render", value: function () {
                    return []
                }
            }]), t
        }(), hidden = {parser: parser$1, name: name$3}, Parser$2 = function (e) {
            function t() {
                return _classCallCheck(this, t), _possibleConstructorReturn(this, _getPrototypeOf(t).apply(this, arguments))
            }

            return _inherits(t, BaseParser), _createClass(t, [{
                key: "init", value: function () {
                    var e = this.rule.props;
                    e.autosize && e.autosize.minRows && $set(e, "rows", e.autosize.minRows || 2)
                }
            }]), t
        }(), name$4 = "input", input = {parser: Parser$2, name: name$4}, Parser$3 = function (e) {
            function t() {
                return _classCallCheck(this, t), _possibleConstructorReturn(this, _getPrototypeOf(t).apply(this, arguments))
            }

            return _inherits(t, BaseParser), _createClass(t, [{
                key: "toFormValue", value: function (e) {
                    return this.rule.options.filter(function (t) {
                        return t.value === e
                    }).reduce(function (e, t) {
                        return t.label
                    }, "")
                }
            }, {
                key: "toValue", value: function (e) {
                    return this.rule.options.filter(function (t) {
                        return t.label === e
                    }).reduce(function (e, t) {
                        return t.value
                    }, "")
                }
            }, {
                key: "render", value: function (e) {
                    return this.vNode.radio(this.$render.inputVData(this).props({options: this.rule.options}), e)
                }
            }]), t
        }(), name$5 = "radio", radio$1 = {parser: Parser$3, name: name$5}, Parser$4 = function (e) {
            function t() {
                return _classCallCheck(this, t), _possibleConstructorReturn(this, _getPrototypeOf(t).apply(this, arguments))
            }

            return _inherits(t, BaseParser), _createClass(t, [{
                key: "render", value: function (e) {
                    return this.vNode.select(this.$render.inputVData(this).props("options", this.rule.options), e)
                }
            }]), t
        }(), name$6 = "select", select$1 = {parser: Parser$4, name: name$6}, Parser$5 = function (e) {
            function t() {
                return _classCallCheck(this, t), _possibleConstructorReturn(this, _getPrototypeOf(t).apply(this, arguments))
            }

            return _inherits(t, BaseParser), _createClass(t, [{
                key: "toFormValue", value: function (e) {
                    var t = this.rule, r = Array.isArray(e), n = t.props, i = n.min || 0;
                    return !0 === n.range ? r ? e : [i, parseFloat(e) || i] : r ? parseFloat(e[0]) || i : parseFloat(e)
                }
            }]), t
        }(), name$7 = "slider", slider = {parser: Parser$5, name: name$7}, parser$2 = function (e) {
            function t() {
                return _classCallCheck(this, t), _possibleConstructorReturn(this, _getPrototypeOf(t).apply(this, arguments))
            }

            return _inherits(t, BaseParser), _createClass(t, [{
                key: "render", value: function (e) {
                    var t = this.rule.props.slot || {};
                    return this.vNode.switch(this.$render.inputVData(this).scopedSlots({
                        open: function () {
                            return t.open
                        }, close: function () {
                            return t.close
                        }
                    }).get(), e)
                }
            }]), t
        }(), name$8 = "switch", iswitch = {parser: parser$2, name: name$8}, Parser$6 = function (e) {
            function t() {
                return _classCallCheck(this, t), _possibleConstructorReturn(this, _getPrototypeOf(t).apply(this, arguments))
            }

            return _inherits(t, BaseParser), _createClass(t, [{
                key: "render", value: function (e) {
                    var t = this, r = this.$render.parserToData(this).get();
                    return this.vNode.tree({
                        props: {
                            ctx: r,
                            children: e,
                            value: this.$handle.getFormData(this),
                            type: r.props.type
                        }, ref: this.refName, key: this.key, on: {
                            input: function (e) {
                                t.$render.onInput(t, e)
                            }
                        }
                    })
                }
            }]), t
        }(), name$9 = "tree", tree$1 = {parser: Parser$6, name: name$9}, Parser$7 = function (e) {
            function t() {
                return _classCallCheck(this, t), _possibleConstructorReturn(this, _getPrototypeOf(t).apply(this, arguments))
            }

            return _inherits(t, BaseParser), _createClass(t, [{
                key: "render", value: function (e) {
                    var t = this, r = this.$render.parserToData(this).get(), n = this.key, i = this.refName;
                    delete r.props.defaultFileList;
                    var o = {
                        uploadType: r.props.uploadType,
                        maxLength: r.props.maxLength,
                        modalTitle: r.props.modalTitle,
                        handleIcon: r.props.handleIcon,
                        onHandle: r.props.onHandle,
                        allowRemove: r.props.allowRemove,
                        value: this.$handle.getFormData(this),
                        ctx: r,
                        children: e
                    };
                    return this.vNode.upload({
                        props: o, key: n, ref: i, on: {
                            input: function (e) {
                                t.$render.onInput(t, e)
                            }
                        }
                    })
                }
            }]), t
        }(), name$a = "upload", upload$1 = {parser: Parser$7, name: name$a},
        parsers = [checkbox$1, datePicker, frame$1, hidden, input, radio$1, select$1, slider, iswitch, tree$1, upload$1];

    function getGlobalApi(e, t) {
        function r(t) {
            var r = arguments.length > 1 && void 0 !== arguments[1] && arguments[1];
            return t ? Array.isArray(t) || (t = [t]) : t = r ? Object.keys(e.fieldList) : e.fields(), t
        }

        return _objectSpread2({}, t, {
            validate: function (t) {
                e.$form.getFormRef().validate(function (e) {
                    t && t(e)
                })
            }, validateField: function (t, r) {
                e.fieldList[t] && e.$form.getFormRef().validateField(t, r)
            }, resetFields: function (t) {
                var n = e.fieldList;
                r(t, !0).forEach(function (t) {
                    var r = n[t];
                    r && "hidden" !== r.type && (e.vm.$refs[r.formItemRefName].resetField(), e.$render.clearCache(r, !0))
                })
            }, submit: function (t, r) {
                var n = this;
                this.validate(function (i) {
                    if (i) {
                        var o = n.formData();
                        isFunction(t) ? t(o, n) : (e.options.onSubmit && e.options.onSubmit(o, n), e.fc.$emit("on-submit", o, n))
                    } else r && r(n)
                })
            }, clearValidateState: function (t) {
                r(t).forEach(function (t) {
                    var r = e.fieldList[t];
                    if (r) {
                        var n = e.vm.$refs[r.formItemRefName];
                        n && (n.validateMessage = "", n.validateState = "")
                    }
                })
            }, btn: {
                loading: function () {
                    var t = !(arguments.length > 0 && void 0 !== arguments[0]) || arguments[0];
                    e.vm._buttonProps({loading: !!t})
                }, disabled: function () {
                    var t = !(arguments.length > 0 && void 0 !== arguments[0]) || arguments[0];
                    e.vm._buttonProps({disabled: !!t})
                }, show: function () {
                    var t = !(arguments.length > 0 && void 0 !== arguments[0]) || arguments[0];
                    e.vm._buttonProps({show: !!t})
                }
            }, resetBtn: {
                loading: function () {
                    var t = !(arguments.length > 0 && void 0 !== arguments[0]) || arguments[0];
                    e.vm._resetProps({loading: !!t})
                }, disabled: function () {
                    var t = !(arguments.length > 0 && void 0 !== arguments[0]) || arguments[0];
                    e.vm._resetProps({disabled: !!t})
                }, show: function () {
                    var t = !(arguments.length > 0 && void 0 !== arguments[0]) || arguments[0];
                    e.vm._resetProps({show: !!t})
                }
            }, closeModal: function (t) {
                var r = e.fieldList[t];
                r && r.closeModel && r.closeModel()
            }
        })
    }

    var nodes = {
        modal: "Modal",
        button: "i-button",
        icon: "Icon",
        slider: "Slider",
        rate: "Rate",
        upload: "fc-iview-upload",
        cascader: "Cascader",
        colorPicker: "Color-Picker",
        timePicker: "Time-Picker",
        datePicker: "Date-Picker",
        switch: "i-switch",
        select: "fc-iview-select",
        checkbox: "fc-iview-checkbox",
        radio: "fc-iview-radio",
        inputNumber: "Input-Number",
        input: "i-input",
        formItem: "Form-Item",
        form: "i-form",
        frame: "fc-iview-frame",
        col: "i-col",
        row: "row",
        tree: "fc-iview-tree",
        autoComplete: "AutoComplete"
    };

    function isTooltip(e) {
        return "tooltip" === e.type
    }

    var Form = function (e) {
            function t(e) {
                var r;
                return _classCallCheck(this, t), (r = _possibleConstructorReturn(this, _getPrototypeOf(t).call(this, e))).refName = "cForm".concat(r.id), r.hidden = [], r.visibility = [], r
            }

            return _inherits(t, BaseForm), _createClass(t, [{
                key: "inputVData", value: function (e) {
                    !e.rule.props.size && this.options.form.size && e.vData.props("size", this.options.form.size)
                }
            }, {
                key: "getFormRef", value: function () {
                    return this.vm.$refs[this.refName]
                }
            }, {
                key: "beforeRender", value: function () {
                    this.propsData = this.vData.props(this.options.form).props({
                        model: this.$handle.formData,
                        rules: this.$handle.validate,
                        key: "form" + this.unique
                    }).ref(this.refName).nativeOn({submit: preventDefault}).class("form-create", !0).key(this.unique).get()
                }
            }, {
                key: "render", value: function (e) {
                    return e.length > 0 && e.push(this.makeFormBtn()), this.vNode.form(this.propsData, [this.makeRow(e)])
                }
            }, {
                key: "makeRow", value: function (e) {
                    return this.vNode.row({props: this.options.row || {}, key: "fr" + this.unique}, e)
                }
            }, {
                key: "container", value: function (e, t) {
                    return this.makeFormItem(t, e)
                }
            }, {
                key: "makeFormItem", value: function (e, t) {
                    var r = "fItem".concat(e.key).concat(this.unique), n = e.rule, i = e.field, o = e.formItemRefName,
                        a = this.getGetCol(e), s = a.labelWidth || n.title ? a.labelWidth : 0, u = n.className,
                        l = this.vData.props({
                            prop: i,
                            label: n.title,
                            rules: n.validate,
                            labelWidth: s,
                            required: n.props.required
                        }).key(r).ref(o).class(u).get(), c = this.vNode.formItem(l, [t, this.makeFormPop(e, r)]);
                    return !0 === this.propsData.props.inline ? c : this.makeCol(a, e, r, [c])
                }
            }, {
                key: "makeFormPop", value: function (e, t) {
                    var r = e.rule;
                    if (r.title) {
                        var n = this.options.info || {}, i = [r.title];
                        return r.info && i.push(this.vNode.make(isTooltip(n) ? "Tooltip" : "Poptip", {
                            props: _objectSpread2({}, n, {content: r.info}),
                            key: "pop".concat(t)
                        }, [this.vNode.icon({
                            props: {
                                type: n.icon || iviewConfig.infoIcon,
                                size: 16
                            }
                        })])), this.vNode.make("span", {slot: "label"}, i)
                    }
                }
            }, {
                key: "makeCol", value: function (e, t, r, n) {
                    var i;
                    return void 0 === e.span && (e.span = 24), this.vNode.col({
                        props: e,
                        class: (i = {}, _defineProperty(i, style.__fc_h, -1 !== this.hidden.indexOf(t)), _defineProperty(i, style.__fc_v, -1 !== this.visibility.indexOf(t)), i),
                        key: "".concat(r, "col1")
                    }, n)
                }
            }, {
                key: "makeFormBtn", value: function () {
                    var e = [], t = !1 !== this.vm.buttonProps && !1 !== this.vm.buttonProps.show,
                        r = !1 !== this.vm.resetProps && !1 !== this.vm.resetProps.show;
                    return t && e.push(this.makeSubmitBtn(r ? 19 : 24)), r && e.push(this.makeResetBtn(4)), !0 === this.propsData.props.inline ? e : e.length ? this.vNode.col({
                        props: {span: 24},
                        key: "".concat(this.unique, "col2")
                    }, e) : []
                }
            }, {
                key: "makeResetBtn", value: function (e) {
                    var t = this, r = this.vm.resetProps, n = r.col || {span: e, push: 1};
                    return this.vNode.col({
                        props: n,
                        key: "".concat(this.unique, "col3")
                    }, [this.vNode.button({
                        key: "frsbtn".concat(this.unique), props: r, on: {
                            click: function () {
                                var e = t.$handle.fCreateApi;
                                isFunction(r.click) ? r.click(e) : e.resetFields()
                            }
                        }
                    }, [r.innerText])])
                }
            }, {
                key: "makeSubmitBtn", value: function (e) {
                    var t = this, r = this.vm.buttonProps, n = r.col || {span: e};
                    return this.vNode.col({
                        props: n,
                        key: "".concat(this.unique, "col4")
                    }, [this.vNode.button({
                        key: "fbtn".concat(this.unique), props: r, on: {
                            click: function () {
                                var e = t.$handle.fCreateApi;
                                isFunction(r.click) ? r.click(e) : e.submit()
                            }
                        }
                    }, [r.innerText])])
                }
            }]), t
        }(), name$b = "datePicker",
        datePicker$1 = ["date", "dateRange", "dateTime", "dateTimeRange", "year", "month"].reduce(function (e, t) {
            return e[t] = creatorTypeFactory(name$b, t.toLowerCase()), e
        }, {}), name$c = "frame", types = {
            frameInputs: ["input", 0],
            frameFiles: ["file", 0],
            frameImages: ["image", 0],
            frameInputOne: ["input", 1],
            frameFileOne: ["file", 1],
            frameImageOne: ["image", 1]
        }, maker = Object.keys(types).reduce(function (e, t) {
            return e[t] = creatorTypeFactory(name$c, function (e) {
                return e.props({type: types[t][0], maxLength: types[t][1]})
            }), e
        }, {});
    maker.frameInput = maker.frameInputs, maker.frameFile = maker.frameFiles, maker.frameImage = maker.frameImages;
    var name$d = "input", maker$1 = ["password", "url", "email", "text", "textarea"].reduce(function (e, t) {
        return e[t] = creatorTypeFactory(name$d, t), e
    }, {});
    maker$1.idate = creatorTypeFactory(name$d, "date");
    var name$e = "select", select$2 = {
            selectMultiple: creatorTypeFactory(name$e, !0, "multiple"),
            selectOne: creatorTypeFactory(name$e, !1, "multiple")
        }, name$f = "slider", slider$1 = {sliderRange: creatorTypeFactory(name$f, !0, "range")}, name$g = "timePicker",
        timePicker = {time: creatorTypeFactory(name$g, "time"), timeRange: creatorTypeFactory(name$g, "timerange")},
        name$h = "tree", types$1 = {treeSelected: "selected", treeChecked: "checked"},
        tree$2 = Object.keys(types$1).reduce(function (e, t) {
            return e[t] = creatorTypeFactory(name$h, types$1[t]), e
        }, {}), name$i = "upload",
        types$2 = {image: ["image", 0], file: ["file", 0], uploadFileOne: ["file", 1], uploadImageOne: ["image", 1]},
        maker$2 = Object.keys(types$2).reduce(function (e, t) {
            return e[t] = creatorTypeFactory(name$i, function (e) {
                return e.props({uploadType: types$2[t][0], maxLength: types$2[t][1]})
            }), e
        }, {});
    maker$2.uploadImage = maker$2.image, maker$2.uploadFile = maker$2.file;
    var maker$3 = _objectSpread2({}, datePicker$1, {}, maker, {}, maker$1, {}, select$2, {}, slider$1, {}, timePicker, {}, tree$2, {}, maker$2),
        names = ["autoComplete", "cascader", "colorPicker", "datePicker", "frame", "inputNumber", "radio", "rate", "timePicker"];
    names.forEach(function (e) {
        maker$3[e] = creatorFactory(e)
    }), maker$3.auto = maker$3.autoComplete, maker$3.number = maker$3.inputNumber, maker$3.color = maker$3.colorPicker, maker$3.hidden = function (e, t) {
        return creatorFactory("hidden")("", e, t)
    }, VNode.use(nodes);
    var drive = {
            ui: "iview",
            version: "1.0.4",
            formRender: Form,
            components: components,
            parsers: parsers,
            makers: maker$3,
            getGlobalApi: getGlobalApi,
            getConfig: getConfig
        }, _createFormCreate = createFormCreate(drive), FormCreate = _createFormCreate.FormCreate,
        install = _createFormCreate.install;
    Creator.prototype.event = function (e, t) {
        var r, n = this;
        return r = isPlainObject(e) ? e : _defineProperty({}, e, t), Object.keys(r).forEach(function (e) {
            var t = 0 === toString(e).indexOf("on-") ? e : "on-".concat(e);
            n.on(t, r[e])
        }), this
    }, "undefined" != typeof window && (window.formCreate = FormCreate, window.Vue && install(window.Vue));
    var maker$4 = FormCreate.maker;
    exports.default = FormCreate, exports.maker = maker$4, Object.defineProperty(exports, "__esModule", {value: !0})
});
//# sourceMappingURL=form-create.min.js.map
