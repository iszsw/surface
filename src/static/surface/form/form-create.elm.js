/*!
 * @form-create/element-ui v1.0.16
 * (c) 2018-2020 xaboy
 * Github https://github.com/xaboy/form-create
 * Released under the MIT License.
 */
!function (e, t) {
    "object" == typeof exports && "undefined" != typeof module ? t(exports, require("vue")) : "function" == typeof define && define.amd ? define(["exports", "vue"], t) : t((e = e || self).formCreate = {}, e.Vue)
}(this, function (exports, Vue) {
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

    Vue = Vue && Vue.hasOwnProperty("default") ? Vue.default : Vue;
    var normalMerge = ["attrs", "props", "domProps"],
        toArrayMerge = ["class", "style", "directives"], functionalMerge = ["on", "nativeOn"],
        mergeJsxProps = function (e) {
            return e.reduce(function (e, t) {
                for (var r in t) if (e[r]) if (-1 !== normalMerge.indexOf(r)) e[r] = _extends({}, e[r], t[r]); else if (-1 !== toArrayMerge.indexOf(r)) {
                    var n = e[r] instanceof Array ? e[r] : [e[r]],
                        i = t[r] instanceof Array ? t[r] : [t[r]];
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

    function toString$1(e) {
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
        var t = arguments.length > 1 && void 0 !== arguments[1] ? arguments[1] : {},
            r = arguments.length > 2 ? arguments[2] : void 0, n = !1;
        for (var i in t) if (Object.prototype.hasOwnProperty.call(t, i)) {
            var o = t[i];
            if ((n = Array.isArray(o)) || isPlainObject(o)) {
                var a = void 0 === e[i];
                if (n) n = !1, a && $set(e, i, []); else if (o._clone) {
                    if (o = o._clone(), !r) {
                        $set(e, i, o);
                        continue
                    }
                    o = o.getRule(), a && $set(e, i, {})
                } else a && $set(e, i, {});
                deepExtend(e[i], o, r)
            } else $set(e, i, o)
        }
        return e
    }

    function deepExtendArgs(e) {
        for (var t = arguments.length, r = new Array(t > 1 ? t - 1 : 0), n = 1; n < t; n++) r[n - 1] = arguments[n];
        return r.forEach(function (t) {
            e = deepExtend(e, t)
        }), e
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

    function dateFormat(e) {
        var t = arguments.length > 1 && void 0 !== arguments[1] ? arguments[1] : new Date, r = {
            "M+": t.getMonth() + 1,
            "d+": t.getDate(),
            "h+": t.getHours(),
            "m+": t.getMinutes(),
            "s+": t.getSeconds(),
            "q+": Math.floor((t.getMonth() + 3) / 3),
            S: t.getMilliseconds()
        };
        for (var n in/(y+)/.test(e) && (e = e.replace(RegExp.$1, (t.getFullYear() + "").substr(4 - RegExp.$1.length))), r) new RegExp("(" + n + ")").test(e) && (e = e.replace(RegExp.$1, 1 == RegExp.$1.length ? r[n] : ("00" + r[n]).substr(("" + r[n]).length)));
        return e
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

    var NAME = "fc-elm-checkbox", checkbox = {
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
            }, type: String
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
                this.trueValue = this.value ? this.options.filter(function (t) {
                    return -1 !== e.value.indexOf(t.value)
                }).map(function (e) {
                    return e.label
                }) : []
            }
        }, created: function () {
            this.update()
        }, render: function () {
            var e = this, t = arguments[0];
            return t("ElCheckboxGroup", helper([{}, this.ctx, {
                on: {input: this.onInput},
                model: {
                    value: e.trueValue, callback: function (t) {
                        e.trueValue = t
                    }
                }
            }]), [this.options.map(function (r, n) {
                var i = _objectSpread2({}, r),
                    o = "button" === e.type ? "ElCheckboxButton" : "ElCheckbox";
                return delete i.value, t(o, {
                    props: _objectSpread2({}, i),
                    key: NAME + o + n + e.unique
                })
            }).concat(this.chlidren)])
        }
    };

    function styleInject(e, t) {
        void 0 === t && (t = {});
        var r = t.insertAt;
        if (e && "undefined" != typeof document) {
            var n = document.head || document.getElementsByTagName("head")[0],
                i = document.createElement("style");
            i.type = "text/css", "top" === r && n.firstChild ? n.insertBefore(i, n.firstChild) : n.appendChild(i), i.styleSheet ? i.styleSheet.cssText = e : i.appendChild(document.createTextNode(e))
        }
    }

    var css = ".fc-upload-btn, .fc-files {\n    display: inline-block;\n    width: 58px;\n    height: 58px;\n    text-align: center;\n    line-height: 58px;\n    border: 1px solid #c0ccda;\n    border-radius: 4px;\n    overflow: hidden;\n    background: #fff;\n    position: relative;\n    -webkit-box-shadow: 2px 2px 5px rgba(0, 0, 0, .1);\n    box-shadow: 2px 2px 5px rgba(0, 0, 0, .1);\n    margin-right: 4px;\n    -webkit-box-sizing: border-box;\n    box-sizing: border-box;\n}\n\n.form-create .form-create .el-form-item {\n    margin-bottom: 22px;\n}\n\n.form-create .form-create .el-form-item .el-form-item {\n    margin-bottom: 0px;\n}\n\n.__fc_h {\n    display: none;\n}\n\n.__fc_v {\n    visibility: hidden;\n}\n\n.fc-files img {\n    width: 100%;\n    height: 100%;\n    display: inline-block;\n    vertical-align: top;\n}\n\n.fc-upload-btn {\n    border: 1px dashed #c0ccda;\n    cursor: pointer;\n}\n\n.fc-upload .fc-upload-cover {\n    opacity: 0;\n    position: absolute;\n    top: 0;\n    bottom: 0;\n    left: 0;\n    right: 0;\n    background: rgba(0, 0, 0, .6);\n    -webkit-transition: opacity .3s;\n    -o-transition: opacity .3s;\n    transition: opacity .3s;\n}\n\n.fc-upload .fc-upload-cover i {\n    color: #fff;\n    font-size: 20px;\n    cursor: pointer;\n    margin: 0 2px;\n}\n\n.fc-files:hover .fc-upload-cover {\n    opacity: 1;\n}\n\n.fc-upload .el-upload {\n    display: block;\n}\n\n\n.form-create .el-form-item .el-rate {\n    margin-top: 10px;\n}\n\n.form-create .el-form-item .el-tree {\n    margin-top: 7px;\n}\n\n.fc-hide-btn .el-upload {\n    display: none;\n}\n",
        style = {
            "fc-upload-btn": "fc-upload-btn",
            "fc-files": "fc-files",
            "form-create": "form-create",
            "el-form-item": "el-form-item",
            __fc_h: "__fc_h",
            __fc_v: "__fc_v",
            "fc-upload": "fc-upload",
            "fc-upload-cover": "fc-upload-cover",
            "el-upload": "el-upload",
            "el-rate": "el-rate",
            "el-tree": "el-tree",
            "fc-hide-btn": "fc-hide-btn"
        };
    styleInject(css);
    var NAME$1 = "fc-elm-frame", frame = {
        name: NAME$1,
        props: {
            type: {type: String, default: "input"},
            field: {type: String, default: ""},
            helper: {type: Boolean, default: !0},
            disabled: {type: Boolean, default: !1},
            src: {type: String, required: !0},
            icon: {type: String, default: "el-icon-upload2"},
            width: {type: String, default: "500px"},
            height: {type: String, default: "370px"},
            maxLength: {type: Number, default: 0},
            okBtnText: {type: String, default: "确定"},
            closeBtnText: {type: String, default: "关闭"},
            modalTitle: String,
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
                    this.previewImage = this.getSrc(e), this.previewVisible = !0
                }
            },
            modal: {
                type: Object, default: function () {
                    return {}
                }
            },
            srcKey: {type: [String, Number]},
            value: [Array, String, Number, Object],
            footer: {type: Boolean, default: !0},
            reload: {type: Boolean, default: !0},
            closeBtn: {type: Boolean, default: !0},
            okBtn: {type: Boolean, default: !0}
        },
        data: function () {
            return {
                fileList: toArray(this.value),
                unique: uniqueId(),
                previewVisible: !1,
                frameVisible: !1,
                previewImage: ""
            }
        },
        watch: {
            value: function (e) {
                this.fileList = toArray(e)
            }, fileList: function (e) {
                var t = 1 === this.maxLength ? e[0] || "" : e;
                this.$emit("input", t), this.$emit("change", t)
            }, src: function (e) {
                this.modalVm && (this.modalVm.src = e)
            }
        },
        methods: {
            key: function (e) {
                return NAME$1 + e + this.unique
            }, closeModel: function (e) {
                this.$emit(e ? "$close" : "$ok"), this.reload && (this.$off("$ok"), this.$off("$close")), this.frameVisible = !1
            }, handleCancel: function () {
                this.previewVisible = !1
            }, showModel: function () {
                this.disabled || !1 === this.onOpen() || (this.frameVisible = !0)
            }, makeInput: function () {
                var e = this, t = this.$createElement, r = {
                    type: "text", value: this.fileList.map(function (t) {
                        return e.getSrc(t)
                    }).toString(), readonly: !0
                };
                return t("ElInput", helper([{}, {props: r}, {key: this.key("input")}]), [this.fileList.length ? t("i", {
                    slot: "suffix",
                    class: "el-input__icon el-icon-circle-close",
                    on: {
                        click: function () {
                            return e.fileList = []
                        }
                    }
                }) : null, t("ElButton", helper([{attrs: {icon: this.icon}}, {
                    on: {
                        click: function () {
                            return e.showModel()
                        }
                    }
                }, {slot: "append"}]))])
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
                return (0, this.$createElement)("i", {
                    class: !0 === this.handleIcon || void 0 === this.handleIcon ? "el-icon-view" : this.handleIcon,
                    on: {
                        click: function () {
                            return r.handleClick(e)
                        }
                    },
                    key: this.key("hi" + t)
                })
            }, makeRemoveIcon: function (e, t) {
                var r = this;
                return (0, this.$createElement)("i", {
                    class: "el-icon-delete",
                    on: {
                        click: function () {
                            return r.handleRemove(e)
                        }
                    },
                    key: this.key("ri" + t)
                })
            }, makeFiles: function () {
                var e = this, t = this.$createElement;
                return this.makeGroup(this.fileList.map(function (r, n) {
                    return e.makeItem(n, [t("i", {
                        class: "el-icon-tickets",
                        on: {
                            click: function () {
                                return e.handleClick(r)
                            }
                        }
                    }), e.makeIcons(r, n)])
                }))
            }, makeImages: function () {
                var e = this, t = this.$createElement;
                return this.makeGroup(this.fileList.map(function (r, n) {
                    return e.makeItem(n, [t("img", {attrs: {src: e.getSrc(r)}}), e.makeIcons(r, n)])
                }))
            }, makeBtn: function () {
                var e = this, t = this.$createElement;
                return t("div", {
                    class: style["fc-upload-btn"], on: {
                        click: function () {
                            return e.showModel()
                        }
                    }, key: this.key("btn")
                }, [t("i", {class: this.icon})])
            }, handleClick: function (e) {
                if (!this.disabled) return this.onHandle(e)
            }, handleRemove: function (e) {
                this.disabled || !1 !== this.onBeforeRemove(e) && (this.fileList.splice(this.fileList.indexOf(e), 1), this.onRemove(e))
            }, getSrc: function (e) {
                return isUndef(this.srcKey) ? e : e[this.srcKey]
            }, frameLoad: function (e) {
                var t = this;
                this.onLoad(e);
                try {
                    if (!0 === this.helper) e.currentTarget.contentWindow.form_create_helper = {
                        close: function (e) {
                            t.valid(e), t.closeModel()
                        }, set: function (e, r) {
                            t.valid(e), t.disabled || t.$emit("input", r)
                        }, get: function (e) {
                            return t.valid(e), t.value
                        }, onOk: function (e) {
                            return t.$on("$ok", e)
                        }, onClose: function (e) {
                            return t.$on("$close", e)
                        }
                    }
                } catch (e) {
                    console.log(e)
                }
            }, makeFooter: function () {
                var e = this, t = this.$createElement, r = this.$props, n = r.okBtnText,
                    i = r.closeBtnText, o = r.closeBtn, a = r.okBtn;
                if (r.footer) return t("div", {slot: "footer"}, [o ? t("ElButton", {
                    on: {
                        click: function () {
                            return !1 !== e.onCancel() && e.closeModel(!0)
                        }
                    }
                }, [i]) : null, a ? t("ElButton", {
                    attrs: {type: "primary"},
                    on: {
                        click: function () {
                            return !1 !== e.onOk() && e.closeModel()
                        }
                    }
                }, [n]) : null])
            }
        },
        render: function () {
            var e, t = this, r = arguments[0], n = this.type;
            e = "input" === n ? this.makeInput() : "image" === n ? this.makeImages() : this.makeFiles();
            var i = this.$props, o = i.width, a = void 0 === o ? "30%" : o, s = i.height, u = i.src,
                l = i.title;
            return r("div", [e, r("el-dialog", {
                attrs: {
                    title: i.modalTitle,
                    visible: this.previewVisible
                }, on: {close: this.handleCancel}
            }, [r("img", {
                attrs: {alt: "example", src: this.previewImage},
                style: "width: 100%"
            })]), r("el-dialog", helper([{}, {
                props: _objectSpread2({
                    width: a,
                    title: l
                }, this.modal)
            }, {
                attrs: {visible: this.frameVisible}, on: {
                    close: function () {
                        return t.closeModel(!0)
                    }
                }
            }]), [this.frameVisible || !this.reload ? r("iframe", {
                attrs: {
                    src: u,
                    frameBorder: "0"
                }, style: {height: s, border: "0 none", width: "100%"}, on: {load: this.frameLoad}
            }) : null, this.makeFooter()])])
        }
    }, NAME$2 = "fc-elm-radio", radio = {
        name: NAME$2, functional: !0, props: {
            options: {
                type: Array, default: function () {
                    return []
                }
            }, type: String, unique: {
                default: function () {
                    return uniqueId()
                }
            }
        }, render: function (e, t) {
            return e("ElRadioGroup", helper([{}, t.data]), [t.props.options.map(function (r, n) {
                var i = _objectSpread2({}, r),
                    o = "button" === t.props.type ? "ElRadioButton" : "ElRadio";
                return delete i.value, e(o, {
                    props: _objectSpread2({}, i),
                    key: NAME$2 + o + n + t.unique
                })
            }).concat(t.chlidren)])
        }
    }, NAME$3 = "fc-elm-select", select = {
        name: NAME$3,
        functional: !0,
        props: {
            options: {
                type: Array, default: function () {
                    return []
                }
            }, unique: {
                default: function () {
                    return uniqueId()
                }
            }
        },
        render: function (e, t) {
            return e("ElSelect", helper([{}, t.data]), [t.props.options.map(function (r, n) {
                var i = r.slot ? toDefSlot(r.slot, e) : [];
                return e("ElOption", {
                    props: _objectSpread2({}, r),
                    key: NAME$3 + n + t.props.unique
                }, [i])
            }).concat(t.chlidren)])
        }
    }, tree = {
        name: "fc-elm-tree", props: {
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
            type: {type: String, default: "checked"},
            value: {
                type: [Array, String, Number], default: function () {
                    return []
                }
            }
        }, watch: {
            value: function () {
                this.setValue()
            }
        }, methods: {
            makeTree: function () {
                var e = this;
                return (0, this.$createElement)("ElTree", helper([{
                    ref: "tree",
                    on: {
                        "check-change": function () {
                            return e.updateValue()
                        }, "node-click": function () {
                            return e.updateValue()
                        }
                    }
                }, this.ctx]), [this.children])
            }, onChange: function () {
                this.updateValue()
            }, updateValue: function () {
                var e;
                e = "selected" === this.type.toLocaleLowerCase() ? this.$refs.tree.getCurrentKey() : this.$refs.tree.getCheckedKeys(), this.$emit("input", e)
            }, setValue: function () {
                "selected" === this.type.toLocaleLowerCase() ? this.$refs.tree.setCurrentKey(this.value) : this.$refs.tree.setCheckedKeys(toArray(this.value))
            }
        }, render: function () {
            return this.makeTree()
        }, mounted: function () {
            this.setValue(), this.updateValue()
        }
    };

    function parseFile(e) {
        return {url: e, name: getFileName(e)}
    }

    function getFileName(e) {
        return toString$1(e).split("/").pop()
    }

    var NAME$4 = "fc-elm-upload", upload = {
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
                    this.previewImage = e.url, this.previewVisible = !0
                }
            },
            uploadType: {type: String, default: "file"},
            maxLength: {type: Number, default: 0},
            allowRemove: {type: Boolean, default: !0},
            modalTitle: String,
            handleIcon: [String, Boolean],
            value: [Array, String]
        }, data: function () {
            return {uploadList: [], unique: uniqueId(), previewVisible: !1, previewImage: ""}
        }, created: function () {
            void 0 === this.ctx.props.showFileList && (this.ctx.props.showFileList = !1), this.ctx.props.fileList = toArray(this.value).map(parseFile)
        }, watch: {
            value: function (e) {
                this.$refs.upload.uploadFiles.every(function (e) {
                    return !e.status || "success" === e.status
                }) && (this.$refs.upload.uploadFiles = toArray(e).map(parseFile), this.uploadList = this.$refs.upload.uploadFiles)
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
                return e("div", {class: style["fc-upload-btn"]}, [e("i", {class: "el-icon-upload2"})])
            }, makeItem: function (e, t) {
                var r = this.$createElement;
                return "image" === this.uploadType ? r("img", {
                    attrs: {src: e.url},
                    key: this.key("img" + t)
                }) : r("i", {class: "el-icon-tickets", key: this.key("i" + t)})
            }, makeRemoveIcon: function (e, t) {
                var r = this;
                return (0, this.$createElement)("i", {
                    class: "el-icon-delete",
                    on: {
                        click: function () {
                            return r.onRemove(e)
                        }
                    },
                    key: this.key("ri" + t)
                })
            }, makeHandleIcon: function (e, t) {
                var r = this;
                return (0, this.$createElement)("i", {
                    class: !0 === this.handleIcon || void 0 === this.handleIcon ? "el-icon-view" : this.handleIcon,
                    on: {
                        click: function () {
                            return r.handleClick(e)
                        }
                    },
                    key: this.key("hi" + t)
                })
            }, makeProgress: function (e, t) {
                return (0, this.$createElement)("ElProgress", helper([{}, {
                    props: {
                        percentage: e.percentage,
                        type: "circle",
                        width: 52
                    }
                }, {style: "margin-top:2px;", key: this.key("pg" + t)}]))
            }, makeIcons: function (e, t) {
                var r = this.$createElement, n = [];
                if (this.allowRemove || !1 !== this.handleIcon) return ("file" !== this.uploadType && !1 !== this.handleIcon || "file" === this.uploadType && this.handleIcon) && n.push(this.makeHandleIcon(e, t)), this.allowRemove && n.push(this.makeRemoveIcon(e, t)), r("div", {class: style["fc-upload-cover"]}, [n])
            }, makeFiles: function () {
                var e = this, t = this.$createElement;
                return this.uploadList.map(function (r, n) {
                    return t("div", {
                        key: e.key(n),
                        class: style["fc-files"]
                    }, [void 0 !== r.percentage && "success" !== r.status ? e.makeProgress(r, n) : [e.makeItem(r, n), e.makeIcons(r, n)]])
                })
            }, makeUpload: function () {
                return (0, this.$createElement)("ElUpload", helper([{
                    ref: "upload",
                    style: {display: "inline-block"}
                }, this.ctx, {key: this.key("upload")}]), [this.children])
            }, initChildren: function () {
                hasSlot(this.children, "default") || this.children.push(this.makeDefaultBtn())
            }, update: function () {
                var e = this.$refs.upload.uploadFiles.map(function (e) {
                    return e.url
                }).filter(function (e) {
                    return void 0 !== e
                });
                this.$emit("input", 1 === this.maxLength ? e[0] || "" : e)
            }, handleCancel: function () {
                this.previewVisible = !1
            }
        }, render: function () {
            var e, t = arguments[0], r = !this.maxLength || this.maxLength > this.uploadList.length;
            return this.$refs.upload && (void 0 === this.ctx.props.showFileList && (this.ctx.props.showFileList = this.$refs.upload.showFileList), this.ctx.props.fileList = this.$refs.upload.fileList), this.initChildren(), t("div", {class: (e = {}, _defineProperty(e, style["fc-upload"], !0), _defineProperty(e, style["fc-hide-btn"], !r), e)}, [[this.ctx.props.showFileList ? [] : this.makeFiles(), this.makeUpload()], t("el-dialog", {
                attrs: {
                    title: this.modalTitle,
                    visible: this.previewVisible
                }, on: {close: this.handleCancel}
            }, [t("img", {
                attrs: {alt: "example", src: this.previewImage},
                style: "width: 100%"
            })])])
        }, mounted: function () {
            var e = this;
            this.uploadList = this.$refs.upload.uploadFiles, this.$watch(function () {
                return e.$refs.upload.uploadFiles
            }, function () {
                e.update()
            }, {deep: !0})
        }
    }, formCreateName = "FormCreate";

    function $FormCreate(e, t) {
        return {
            name: formCreateName,
            componentName: formCreateName,
            props: {
                rule: {type: Array, required: !0}, option: {
                    type: Object, default: function () {
                        return {}
                    }, required: !1
                }, value: Object
            },
            data: function () {
                return {
                    formData: void 0,
                    buttonProps: void 0,
                    resetProps: void 0,
                    $f: void 0,
                    isShow: !0,
                    unique: 1
                }
            },
            components: t,
            render: function () {
                return this.formCreate.render()
            },
            methods: {
                _buttonProps: function (e) {
                    this.$set(this, "buttonProps", deepExtend(this.buttonProps, e))
                }, _resetProps: function (e) {
                    this.$set(this, "resetProps", deepExtend(this.resetProps, e))
                }, _refresh: function () {
                    ++this.unique
                }
            },
            watch: {
                option: "_refresh", rule: function (e) {
                    this.formCreate.handle.reloadRule(e)
                }
            },
            beforeCreate: function () {
                var t = this.$options.propsData, r = t.rule, n = t.option;
                this.formCreate = new e(r, n), this.formCreate.beforeCreate(this)
            },
            created: function () {
                this.formCreate.created(), this.$f = this.formCreate.api(), this.$emit("input", this.$f)
            },
            mounted: function () {
                this.formCreate.mounted(), this.$emit("input", this.$f)
            },
            beforeDestroy: function () {
                this.formCreate.handle.reloadRule([]), this.formCreate.handle.$render.clearCacheAll()
            }
        }
    }

    var normalMerge$1 = ["attrs", "props", "domProps"],
        toArrayMerge$1 = ["class", "style", "directives"], functionalMerge$1 = ["on", "nativeOn"],
        mergeJsxProps$1 = function (e, t) {
            return e.reduce(function (e, t) {
                for (var r in t) if (e[r]) if (-1 !== normalMerge$1.indexOf(r)) e[r] = _objectSpread2({}, e[r], {}, t[r]); else if (-1 !== toArrayMerge$1.indexOf(r)) {
                    var n = e[r] instanceof Array ? e[r] : [e[r]],
                        i = t[r] instanceof Array ? t[r] : [t[r]];
                    e[r] = [].concat(_toConsumableArray(n), _toConsumableArray(i))
                } else if (-1 !== functionalMerge$1.indexOf(r)) for (var o in t[r]) if (e[r][o]) {
                    var a = e[r][o] instanceof Array ? e[r][o] : [e[r][o]],
                        s = t[r][o] instanceof Array ? t[r][o] : [t[r][o]];
                    e[r][o] = [].concat(_toConsumableArray(a), _toConsumableArray(s))
                } else e[r][o] = t[r][o]; else if ("hook" === r) for (var u in t[r]) e[r][u] ? e[r][u] = mergeFn$1(e[r][u], t[r][u]) : e[r][u] = t[r][u]; else e[r] = t[r]; else e[r] = t[r];
                return e
            }, t)
        }, mergeFn$1 = function (e, t) {
            return function () {
                e && e.apply(this, arguments), t && t.apply(this, arguments)
            }
        };

    function defVData() {
        return {props: {}, on: {}}
    }

    var VData = function () {
            function e() {
                _classCallCheck(this, e), this.init()
            }

            return _createClass(e, [{
                key: "merge", value: function (e) {
                    return mergeJsxProps$1([e], this._data), this
                }
            }, {
                key: "class", value: function (e) {
                    var t = !(arguments.length > 1 && void 0 !== arguments[1]) || arguments[1];
                    return isUndef(e) ? this : (Array.isArray(e) ? this.merge({class: e}) : isPlainObject(e) ? this.merge(e) : this.merge({class: _defineProperty({}, toString$1(e), !!t)}), this)
                }
            }, {
                key: "init", value: function () {
                    return this._data = defVData(), this
                }
            }, {
                key: "get", value: function () {
                    var e = this, t = Object.keys(this._data).reduce(function (t, r) {
                        var n = e._data[r];
                        return void 0 === n ? t : Array.isArray(n) && !n.length ? t : isPlainObject(n) && !Object.keys(n).length && "props" !== r ? t : (t[r] = n, t)
                    }, {});
                    return this.init(), t
                }
            }]), e
        }(), keyList = ["ref", "key", "slot"],
        objList = ["scopedSlots", "nativeOn", "on", "domProps", "props", "attrs", "style", "directives"];
    keyList.forEach(function (e) {
        VData.prototype[e] = function (t) {
            return this.merge(_defineProperty({}, e, t)), this
        }
    }), objList.forEach(function (e) {
        VData.prototype[e] = function (t, r) {
            return isUndef(t) ? this : (isPlainObject(t) ? this.merge(_defineProperty({}, e, t)) : this.merge(_defineProperty({}, e, _defineProperty({}, toString$1(t), r))), this)
        }
    });
    var vdataField = objList.concat(keyList, "class");

    function baseRule() {
        return {
            validate: [],
            options: [],
            col: {},
            children: [],
            control: [],
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
            var a = arguments.length > 3 && void 0 !== arguments[3] ? arguments[3] : {},
                s = new Creator(e, n, i, o, a);
            return isFunction(t) ? t(s) : s.props(r, t), s
        }
    }

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
                key: "_clone", value: function () {
                    var e = new this.constructor;
                    return e._data = deepExtend({}, this._data), e
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
        }(),
        keyAttrs = ["emitPrefix", "className", "value", "name", "title", "native", "info", "hidden", "visibility", "inject", "model"];
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
    var arrAttrs = ["validate", "options", "children", "emit", "control"];
    arrAttrs.forEach(function (e) {
        Creator.prototype[e] = function (t) {
            return Array.isArray(t) || (t = [t]), $set(this._data, e, this._data[e].concat(t)), this
        }
    });
    var PREFIX = "[[FORM-CREATE-PREFIX-", SUFFIX = "-FORM-CREATE-SUFFIX]]";

    function toJson(e) {
        return JSON.stringify(deepExtend([], e, !0), function (e, t) {
            if (!t || !0 !== t._isVue) {
                if ("function" != typeof t) return t;
                if (t.__inject && (t = t.__origin), !t.__emit) return PREFIX + t + SUFFIX
            }
        })
    }

    function makeFn(fn) {
        return eval("(function(){return " + fn + " })()")
    }

    function parseJson(e, t) {
        return JSON.parse(e, function (e, r) {
            if (isUndef(r) || !r.indexOf) return r;
            try {
                if (r.indexOf(SUFFIX) > 0 && 0 === r.indexOf(PREFIX)) return makeFn(-1 === (r = r.replace(SUFFIX, "").replace(PREFIX, "")).indexOf("function") && 0 !== r.indexOf("(") ? "function " + r : r);
                if (!t && r.indexOf("function") > -1) return makeFn(r)
            } catch (e) {
                return void console.error("[form-create]解析失败:".concat(r))
            }
            return r
        })
    }

    function enumerable(e) {
        return {value: e, enumerable: !1, configurable: !1}
    }

    function copyRule(e, t) {
        return copyRules([e], t)[0]
    }

    function copyRules(e, t) {
        return deepExtend([], e, t)
    }

    var commonMaker = creatorFactory("");

    function create(e, t, r) {
        var n = commonMaker("", t);
        return n._data.type = e, n._data.title = r, n
    }

    function createTmp(e, t, r, n) {
        var i = commonMaker("", r);
        return i._data.type = "template", i._data.template = e, i._data.title = n, i._data.vm = t, i
    }

    function makerFactory() {
        var e = {};
        return extend(e, {
            create: create,
            createTmp: createTmp
        }), e.template = createTmp, e.parse = parse, e
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
            return Object.defineProperties(n, {
                find: enumerable(findField),
                model: enumerable(model)
            }), n
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
                    e.prototype[toString$1(r).toLocaleLowerCase()] = e.prototype[r] = function (e, n) {
                        return this.make(t[r], e, n)
                    }
                })
            }
        }]), e
    }();
    VNode.use({fragment: "fcFragment"});
    var BaseParser = function () {
        function e(t, r, n) {
            _classCallCheck(this, e), this.rule = r, this.vData = new VData, this.vNode = new VNode, this.id = n, this.watch = [], this.originType = r.type, this.type = toString$1(r.type).toLocaleLowerCase(), this.isDef = !0, this.el = void 0, r.field ? this.field = r.field : (this.field = "_def_" + uniqueId(), this.isDef = !1), this.name = r.name, this.key = "key_" + n, this.refName = "__" + this.field + this.id, this.formItemRefName = "fi" + this.refName, this.root = [], this.ctrlRule = null, this.modelEvent = "input", this.update(t), this.init()
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
                        return e.renderParser(e.$handle.parsers[t])
                    }).filter(function (e) {
                        return void 0 !== e
                    });
                    return this.$form.render(t)
                }
            }
        }, {
            key: "setGlobalConfig", value: function (e) {
                if (this.options.global) {
                    var t = this.options.global;
                    t["*"] && this.toData(e, t["*"]), t[e.type] ? this.toData(e, t[e.type]) : t[e.originType] && this.toData(e, t[e.originType])
                }
            }
        }, {
            key: "renderTemplate", value: function (e) {
                var t = this, r = e.id, n = e.rule, i = e.key;
                if (isUndef(_vue.compile)) return console.error("使用的 Vue 版本不支持 compile" + errMsg()), [];
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
                return isUndef(l.data) && (l.data = {}), l.key = i, l
            }
        }, {
            key: "renderParser", value: function (e, t) {
                if ("hidden" !== e.type) {
                    if (!this.cache[e.id] || "template" === e.type) {
                        e.vData.get(), this.setGlobalConfig(e);
                        var r, n = e.type, i = e.rule, o = this.$form;
                        if ("template" === n && i.template) {
                            if (r = this.renderTemplate(e), t && isUndef(i.native)) return this.setCache(e, r, t), r
                        } else if (this.$handle.isNoVal(e)) {
                            if (r = this.defaultRender(e, this.renderChildren(e)), t && isUndef(i.native)) return this.setCache(e, r, t), r
                        } else {
                            var a = this.renderChildren(e);
                            r = e.render ? e.render(a) : this.defaultRender(e, a)
                        }
                        return !0 !== i.native && (r = o.container(r, e)), this.setCache(e, r, t), r
                    }
                    return this.getCache(e)
                }
            }
        }, {
            key: "toData", value: function (e, t) {
                return vdataField.forEach(function (r) {
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
                var o = e.vData.ref(n).key("fc_item" + i).props("formCreate", this.$handle.fCreateApi).on("fc.subForm", function (t) {
                    return r.$handle.addSubForm(e, t)
                }), a = this.$handle.modelEvent(e);
                return t || o.on(a.event || a, function (t) {
                    r.onInput(e, t)
                }).props(a.prop || "value", this.$handle.getFormData(e)), this.$form.inputVData && this.$form.inputVData(e, t), o
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
                    return isString(r) ? r : r.__fc__ ? t.renderParser(r.__fc__, e) : void(!t.$handle.isset(r) && r.type && $de(function () {
                        return t.$handle.reloadRule()
                    }))
                })) : (n.forEach(function (e) {
                    !isString(e) && e.__fc__ && t.$handle.removeField(e.__fc__)
                }), this.orgChildren[e.id] = [], [])
            }
        }, {
            key: "defaultRender", value: function (e, t) {
                var r = this.inputVData(e);
                return this.vNode[e.type] ? this.vNode[e.type](r, t) : this.vNode[e.originType] ? this.vNode[e.originType](r, t) : this.vNode.make(e.originType, r, t)
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

    function Api(e) {
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
                    var n = r.root.indexOf(r.rule.__origin__);
                    if (-1 !== n) return r.root.splice(n, 1), -1 === e.sortList.indexOf(r.id) && this.reload(), r.rule.__origin__
                }
            }, destroy: function () {
                e.vm.$el.parentNode.removeChild(e.vm.$el), e.vm.$destroy()
            }, fields: function () {
                return e.fields()
            }, append: function (t, r, n) {
                var i, o = Object.keys(e.fieldList), a = e.sortList.length;
                if (t.field && -1 !== o.indexOf(t.field)) return console.error("".concat(t.field, " 字段已存在") + errMsg());
                var s = e.getParser(r);
                s ? n ? (i = s.rule.children, a = s.rule.children.length) : (a = s.root.indexOf(s.rule.__origin__), i = s.root) : i = e.rules, i.splice(a + 1, 0, t)
            }, prepend: function (t, r, n) {
                var i, o = Object.keys(e.fieldList), a = 0;
                if (t.field && -1 !== o.indexOf(t.field)) return console.error("".concat(t.field, " 字段已存在") + errMsg());
                var s = e.getParser(r);
                s ? n ? i = s.rule.children : (a = s.root.indexOf(s.rule.__origin__), i = s.root) : i = e.rules, i.splice(a, 0, t)
            }, hidden: function (r, n) {
                t(n, !0).forEach(function (t) {
                    var n = e.getParser(t);
                    n && ($set(n.rule, "hidden", !!r), e.$render.clearCache(n, !0))
                }), e.refresh()
            }, hiddenStatus: function (t) {
                var r = e.getParser(t);
                if (r) return !!r.rule.hidden
            }, visibility: function (r, n) {
                t(n, !0).forEach(function (t) {
                    var n = e.getParser(t);
                    n && ($set(n.rule, "visibility", !!r), e.$render.clearCache(n, !0))
                }), e.refresh()
            }, visibilityStatus: function (t) {
                var r = e.getParser(t);
                if (r) return !!r.rule.visibility
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
                this.updateOptions({onSubmit: e})
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
                    return r[t].apply(r, arguments)
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
            }, validate: function (t) {
                var r, n = this, i = !1, o = _objectSpread2({}, {
                    ___this: {
                        validate: function (t) {
                            e.$form.validate(function (e) {
                                t && t(e)
                            })
                        }
                    }
                }, {}, e.subForm), a = Object.keys(o).filter(function (e) {
                    var t = o[e];
                    return Array.isArray(t) ? t.length : !isUndef(t)
                }), s = a.length, u = function (e, o) {
                    e ? r > 1 ? r-- : s > 1 ? s-- : t(!0) : (i || (t(!1), i = !0), o && n.clearValidateState(o, !1))
                };
                a.forEach(function (e) {
                    var t = o[e];
                    Array.isArray(t) ? (r = t.length, t.forEach(function (t) {
                        t.validate(function (t) {
                            return u(t, e)
                        })
                    })) : t && (r = 1, t.validate(u))
                })
            }, validateField: function (t, r) {
                e.fieldList[t] && e.$form.validateField(t, r)
            }, resetFields: function (r) {
                var n = e.fieldList;
                t(r, !0).forEach(function (t) {
                    var r = n[t];
                    r && "hidden" !== r.type && (e.$form.resetField(r), e.refreshControl(r), e.$render.clearCache(r, !0))
                })
            }, submit: function (t, r) {
                var n = this;
                this.validate(function (i) {
                    if (i) {
                        var o = n.formData();
                        isFunction(t) ? t(o, n) : (e.options.onSubmit && e.options.onSubmit(o, n), e.fc.$emit("on-submit", o, n))
                    } else r && r(n)
                })
            }, clearValidateState: function (r) {
                var n = this,
                    i = !(arguments.length > 1 && void 0 !== arguments[1]) || arguments[1];
                t(r).forEach(function (t) {
                    i && n.clearSubValidateState(t);
                    var r = e.fieldList[t];
                    r && e.$form.clearValidateState(r)
                })
            }, clearSubValidateState: function (r) {
                t(r).forEach(function (t) {
                    var r = e.subForm[t];
                    r && (Array.isArray(r) ? r.forEach(function (e) {
                        e.clearValidateState()
                    }) : r && r.clearValidateState())
                })
            }, getSubForm: function (t) {
                return e.subForm[t]
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
        }
    }

    function getRule(e) {
        return isFunction(e.getRule) ? e.getRule() : e
    }

    var Handle = function () {
        function e(t) {
            _classCallCheck(this, e);
            var r = this.fc = t, n = r.vm, i = r.rules, o = r.options;
            this.watching = !1, this.vm = n, this.options = o, this.validate = {}, this.formData = {}, this.subForm = {}, this.fCreateApi = void 0, this.__init(i), this.$form = new t.drive.formRender(this), this.$render = new Render(this), this.loadRule(this.rules, !1), this.$render.initOrgChildren(), this.$form.init()
        }

        return _createClass(e, [{
            key: "__init", value: function (e) {
                this.fieldList = {}, this.trueData = {}, this.parsers = {}, this.customData = {}, this.sortList = [], this.rules = e, this.origin = _toConsumableArray(this.rules), this.changeStatus = !1, this.issetRule = []
            }
        }, {
            key: "modelEvent", value: function (e) {
                var t = this.fc.modelEvents;
                return t[e.type] || t[e.originType] || e.rule.model || e.modelEvent
            }
        }, {
            key: "isset", value: function (e) {
                return this.issetRule.indexOf(e) > -1
            }
        }, {
            key: "loadRule", value: function (e, t) {
                var r = this;
                e.map(function (n, i) {
                    if (!t || !isString(n)) {
                        if (!n.type) return console.error("未定义生成规则的 type 字段" + errMsg());
                        var o;
                        if (n.__fc__) if ((o = n.__fc__).deleted || o.vm === r.vm && !r.parsers[o.id]) {
                            o.update(r);
                            var a = o.rule;
                            r.parseOn(a), r.parseProps(a)
                        } else e[i] = n = copyRule(n), o = r.createParser(r.parseRule(n)); else o = r.createParser(r.parseRule(n));
                        var s = o.rule.children, u = o.rule;
                        return r.notField(o.field) ? (r.setParser(o), n.__fc__ || bindParser(n, o), isValidChildren(s) && r.loadRule(s, !0), t || r.sortList.push(o.id), r.isNoVal(o) || Object.defineProperty(o.rule, "value", r.valueHandle(o)), o) : (r.issetRule.push(n), console.error("".concat(u.field, " 字段已存在") + errMsg()))
                    }
                }).filter(function (e) {
                    return e
                }).forEach(function (t) {
                    t.root = e
                })
            }
        }, {
            key: "valueHandle", value: function (e) {
                var t = this;
                return {
                    enumerable: !0, get: function () {
                        return e.toValue(t.getFormData(e))
                    }, set: function (r) {
                        t.isChange(e, r) && (t.$render.clearCache(e, !0), t.setFormData(e, e.toFormValue(r)), t.valueChange(e, r), t.refresh())
                    }
                }
            }
        }, {
            key: "createParser", value: function (e) {
                return new (this.fc.parsers[toString$1(e.type).toLocaleLowerCase()] || BaseParser)(this, e, "" + uniqueId())
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
                return {
                    $f: this.fCreateApi,
                    rule: i,
                    self: e.__origin__,
                    option: n,
                    inject: t || i.inject || {}
                }
            }
        }, {
            key: "inject", value: function (e, t, r) {
                if (t.__inject) {
                    if (this.watching) return t;
                    t = t.__origin
                }
                var n = this, i = function () {
                    for (var i = arguments.length, o = new Array(i), a = 0; a < i; a++) o[a] = arguments[a];
                    return o.unshift(n.getInjectData(e, r)), t.apply(void 0, o)
                };
                return i.__inject = !0, i.__origin = t, i
            }
        }, {
            key: "parseEmit", value: function (e) {
                var t = this, r = {}, n = e.emit, i = e.emitPrefix, o = e.field, a = e.name;
                if (!Array.isArray(n)) return r;
                var s = i || (o || a);
                return s ? (n.forEach(function (n) {
                    var i, o = n;
                    if (isPlainObject(n) && (o = n.name, i = n.inject), o) {
                        var a = toLine("".concat(s, "-").concat(o)).replace("_", "-"),
                            u = function () {
                                for (var e, r = arguments.length, n = new Array(r), i = 0; i < r; i++) n[i] = arguments[i];
                                (e = t.vm).$emit.apply(e, [a].concat(n))
                            };
                        u.__emit = !0, r[o] = t.options.injectEvent || void 0 !== n.inject ? t.inject(e, u, i) : u
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
            key: "addSubForm", value: function (e, t) {
                this.subForm[e.field] = t
            }
        }, {
            key: "notField", value: function (e) {
                return void 0 === this.fieldList[e]
            }
        }, {
            key: "isChange", value: function (e, t) {
                return JSON.stringify(e.rule.value) !== JSON.stringify(t)
            }
        }, {
            key: "valueChange", value: function (e) {
                this.validateControl(e)
            }
        }, {
            key: "onInput", value: function (e, t) {
                var r;
                !this.isNoVal(e) && this.isChange(e, r = e.toValue(t)) && (this.$render.clearCache(e), this.setFormData(e, t), this.changeStatus = !0, this.valueChange(e), this.vm.$emit("change", e.field, r, this.fCreateApi))
            }
        }, {
            key: "getParser", value: function (e) {
                return this.fieldList[e] || this.customData[e] || this.parsers[e]
            }
        }, {
            key: "created", value: function () {
                var e = this, t = this.vm;
                if (t.$set(t, "buttonProps", this.options.submitBtn), t.$set(t, "resetProps", this.options.resetBtn), t.$set(t, "formData", this.formData), void 0 === this.fCreateApi && (this.fCreateApi = Api(this)), this.fCreateApi.rule = this.rules, this.fCreateApi.config = this.options, this.fCreateApi.form) {
                    var r = this.fCreateApi.form;
                    Object.keys(r).forEach(function (e) {
                        delete r[e]
                    })
                } else Object.defineProperty(this.fCreateApi, "form", {
                    value: {},
                    writable: !1,
                    enumerable: !0
                });
                Object.defineProperties(this.fCreateApi.form, Object.keys(this.fCreateApi.formData()).reduce(function (t, r) {
                    var n = e.getParser(r), i = e.valueHandle(n);
                    return i.configurable = !0, t[r] = i, t
                }, {}))
            }
        }, {
            key: "addParserWitch", value: function (e) {
                var t = this, r = this.vm;
                Object.keys(e.rule).forEach(function (n) {
                    if (-1 === ["field", "type", "value", "vm", "template", "name", "config", "control"].indexOf(n) && void 0 !== e.rule[n]) try {
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
            key: "refreshControl", value: function (e) {
                !this.isNoVal(e) && e.rule.control && this.validateControl(e)
            }
        }, {
            key: "validateControl", value: function (e) {
                var t = this, r = getControl(e), n = r.length, i = e.ctrlRule;
                if (n) {
                    for (var o = function (n) {
                        var o = r[n];
                        if ((o.handle || function (e) {
                                return e === o.value
                            })(e.rule.value, t.fCreateApi)) {
                            if (i) {
                                if (i.children === o.rule) return {v: void 0};
                                removeControl(e)
                            }
                            var a = {type: "fcFragment", native: !0, children: o.rule};
                            return e.root.splice(e.root.indexOf(e.rule.__origin__) + 1, 0, a), e.ctrlRule = a, t.vm.$emit("control", e.rule.__origin__, t.fCreateApi), t.refresh(), {v: void 0}
                        }
                    }, a = 0; a < n; a++) {
                        var s = o(a);
                        if ("object" === _typeof(s)) return s.v
                    }
                    i && (removeControl(e), this.vm.$emit("control", e.rule.__origin__, this.fCreateApi), this.refresh())
                }
            }
        }, {
            key: "mountedParser", value: function () {
                var e = this, t = this.vm;
                Object.keys(this.parsers).forEach(function (r) {
                    var n = e.parsers[r];
                    0 === n.watch.length && e.addParserWitch(n), e.refreshControl(n), n.el = t.$refs[n.refName] || {}, void 0 === n.defaultValue && (n.defaultValue = deepExtend({}, {value: n.rule.value}).value), n.mounted && n.mounted()
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
            key: "removeField", value: function (e, t) {
                var r = e.id, n = e.field, i = this.sortList.indexOf(r);
                return delParser(e, t), $del(this.parsers, r), -1 !== i && this.sortList.splice(i, 1), this.fieldList[n] || ($del(this.validate, n), $del(this.formData, n), $del(this.customData, n), $del(this.fieldList, n), $del(this.trueData, n)), this.subForm[e.field] && $del(this.subForm, n), e
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
                var n = _objectSpread2({}, this.parsers), i = this.fCreateApi.formData();
                this.__init(e), this.loadRule(e, !1), Object.keys(n).filter(function (e) {
                    return void 0 === t.parsers[e]
                }).forEach(function (e) {
                    return t.removeField(n[e], i[n[e].field])
                }), this.$render.initOrgChildren(), this.formData = _objectSpread2({}, this.formData), this.created(), r.$f = this.fCreateApi, this.$render.clearCacheAll(), this.refresh(), r.$nextTick(function () {
                    t.reload()
                })
            }
        }, {
            key: "setFormData", value: function (e, t) {
                $set(this.formData, e.field, t)
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

    function delParser(e, t) {
        e.ctrlRule && removeControl(e), e.watch.forEach(function (e) {
            return e()
        }), e.watch = [], e.deleted = !0, e.root = [], Object.defineProperty(e.rule, "value", {value: t})
    }

    function parseArray(e) {
        return Array.isArray(e) ? e : []
    }

    function getControl(e) {
        var t = e.rule.control || [];
        return isPlainObject(t) ? [t] : t
    }

    function removeControl(e) {
        var t = e.root.indexOf(e.ctrlRule);
        -1 !== t && e.root.splice(t, 1), e.ctrlRule = null
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
            value: null,
            field: "",
            name: void 0,
            className: void 0
        }
    }

    function bindParser(e, t) {
        Object.defineProperties(e, {__field__: enumerable(t.field), __fc__: enumerable(t)})
    }

    var NAME$5 = "fcFragment", fragment = {
        name: NAME$5,
        functional: !0,
        props: {children: Array},
        render: function (e, t) {
            return t.children
        }
    }, _vue = "undefined" != typeof window && window.Vue ? window.Vue : Vue;

    function createFormCreate(e) {
        var t = _defineProperty({}, fragment.name, fragment), r = {}, n = makerFactory(),
            i = e.getConfig(), o = {}, a = {};

        function s(e, t) {
            e = toString$1(e), r[e.toLocaleLowerCase()] = t, p.maker[e] = creatorFactory(e)
        }

        function u() {
            return function (e) {
                function t() {
                    return _classCallCheck(this, t), _possibleConstructorReturn(this, _getPrototypeOf(t).apply(this, arguments))
                }

                return _inherits(t, BaseParser), t
            }()
        }

        function l(e, r) {
            var n = (e = toString$1(e)).toLocaleLowerCase();
            return "form-create" === n || "formcreate" === n ? f() : void 0 === r ? t[e] : void(t[e] = r)
        }

        function c(e, t) {
            isBool(t.submitBtn) && (t.submitBtn = {show: t.submitBtn}), isBool(t.resetBtn) && (t.resetBtn = {show: t.resetBtn});
            var r = deepExtend(e, t);
            return $set(r, "el", r.el ? isElement(r.el) ? r.el : document.querySelector(r.el) : window.document.body), r
        }

        function f() {
            return _vue.extend($FormCreate(p, t))
        }

        function h(t) {
            extend(t, {
                version: e.version,
                ui: e.ui,
                maker: n,
                component: l,
                setParser: s,
                createParser: u,
                data: o,
                copyRule: copyRule,
                copyRules: copyRules,
                $form: function () {
                    return f()
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

        var p = function () {
            function t(n) {
                var o = arguments.length > 1 && void 0 !== arguments[1] ? arguments[1] : {};
                _classCallCheck(this, t), this.fCreateApi = void 0, this.drive = e, this.parsers = r, this.modelEvents = a, this.vm = void 0, this.rules = Array.isArray(n) ? n : [], this.options = c(deepExtend({formData: {}}, i), o)
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
                        r = arguments.length > 2 ? arguments[2] : void 0, n = d(e, t),
                        i = n.$refs.fc.formCreate;
                    return i.parent = r, i.options.el.appendChild(n.$el), i.handle.fCreateApi
                }
            }, {
                key: "install", value: function (e, r) {
                    if (r && isPlainObject(r) && c(i, r), !0 !== e._installedFormCreate) {
                        e._installedFormCreate = !0;
                        var n = function (e) {
                            var r = arguments.length > 1 && void 0 !== arguments[1] ? arguments[1] : {};
                            return t.create(e, r, this)
                        };
                        h(n), e.prototype.$formCreate = n, e.component(formCreateName, f()), e.component(fragment.name, _vue.extend(fragment)), _vue = e
                    }
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
        return h(p), e.components.forEach(function (e) {
            p.component(e.name, e)
        }), e.parsers.forEach(function (e) {
            var t = e.name, r = e.parser;
            p.setParser(t, r)
        }), Object.keys(e.makers).forEach(function (t) {
            p.maker[t] = e.makers[t]
        }), e.modelEvents && Object.keys(e.modelEvents).forEach(function (t) {
            return r = t, n = e.modelEvents[t], void(a[r.toLocaleLowerCase()] = n);
            var r, n
        }), {FormCreate: p, install: p.install}
    }

    var BaseForm = function () {
            function e(t) {
                _classCallCheck(this, e), this.$handle = t, this.vm = t.vm, this.drive = this.$handle.fc.drive, this.options = t.options, this.vNode = new VNode(this.vm), this.vData = new VData, this.unique = uniqueId(), this.refName = "cForm".concat(this.unique)
            }

            return _createClass(e, [{
                key: "getFormRef", value: function () {
                    return this.vm.$refs[this.refName]
                }
            }, {
                key: "init", value: function () {
                    this.$render = this.$handle.$render
                }
            }, {
                key: "getGetCol", value: function (e) {
                    var t = arguments.length > 1 && void 0 !== arguments[1] ? arguments[1] : "col",
                        r = e.rule[t] || {}, n = {}, i = {}, o = this.options.global;
                    return o ? (o["*"] && (n = o["*"][t] || {}), o[e.type] ? i = o[e.type][t] || {} : o[e.originType] && (i = o[e.originType][t] || {}), r = deepExtendArgs({}, n, i, r)) : r
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
        }(), NAME$6 = "fc-elm-group", group = {
            name: NAME$6,
            props: {
                rule: Object,
                rules: Array,
                button: {type: Boolean, default: !0},
                formCreate: Object,
                max: {type: Number, default: 0},
                min: {type: Number, default: 0},
                value: {
                    type: Array, default: function () {
                        return []
                    }
                },
                disabled: {type: Boolean, default: !1},
                fontSize: {type: Number, default: 28}
            },
            data: function () {
                return {
                    option: deepExtendArgs({}, this.formCreate.config || {}, {
                        submitBtn: !1,
                        resetBtn: !1,
                        mounted: void 0,
                        onReload: void 0
                    }), len: 0, cacheRule: {}, group$f: {}, fieldRule: {}
                }
            },
            computed: {
                formRule: function () {
                    return this.rule ? [this.rule] : this.rules ? this.rules : []
                }, formData: function () {
                    var e = this;
                    return Object.keys(this.fieldRule).map(function (t) {
                        var r = Object.keys(e.fieldRule[t]);
                        return e.rule ? void 0 === r[0] ? null : e.fieldRule[t][r[0]].value : r.reduce(function (r, n) {
                            return r[n] = e.fieldRule[t][n].value, r
                        }, {})
                    })
                }
            },
            watch: {
                disabled: function (e) {
                    var t = this.group$f;
                    Object.keys(t).forEach(function (r) {
                        t[r].disabled(e)
                    })
                }, formData: function (e) {
                    this.$emit("input", e), this.$emit("change", e)
                }, value: {
                    handler: function (e) {
                        var t = this, r = Object.keys(this.cacheRule), n = r.length, i = n - e.length;
                        if (i < 0) {
                            for (var o = i; o < 0; o++) this.addRule();
                            for (var a = 0; a < n; a++) this.setValue(this.group$f[r[a]], e[a])
                        } else {
                            if (i > 0) {
                                for (var s = 0; s < i; s++) this.removeRule(r[n - s - 1]);
                                this.subForm()
                            }
                            e.forEach(function (n, i) {
                                t.setValue(t.group$f[r[i]], e[i])
                            })
                        }
                    }, deep: !0, immediate: !0
                }
            },
            methods: {
                setValue: function (e, t) {
                    if (this.rule) {
                        var r = e.fields();
                        if (!r[0]) return;
                        e.setValue(r[0], t)
                    } else e.setValue(t)
                }, addRule: function (e) {
                    var t = this, r = this.copyRule();
                    this.$set(this.cacheRule, ++this.len, r), e && this.$nextTick(function () {
                        return t.$emit("add", r, Object.keys(t.cacheRule).length - 1)
                    })
                }, add$f: function (e, t, r) {
                    this.group$f[t] = r, this.setValue(r, this.value[e]), this.syncData(t, r), this.subForm(), this.$emit("itemMounted", r, Object.keys(this.cacheRule).indexOf(t))
                }, subForm: function () {
                    var e = this;
                    this.$emit("fc.subForm", Object.keys(this.group$f).map(function (t) {
                        return e.group$f[t]
                    }))
                }, syncData: function (e, t) {
                    var r = this;
                    this.$set(this.fieldRule, e, {}), t.fields().forEach(function (n) {
                        r.fieldRule[e][n] = t.getRule(n)
                    })
                }, removeRule: function (e, t) {
                    var r = this, n = Object.keys(this.cacheRule).indexOf(e);
                    this.$delete(this.cacheRule, e), this.$delete(this.fieldRule, e), this.$delete(this.group$f, e), t && this.$nextTick(function () {
                        return r.$emit("remove", n)
                    })
                }, copyRule: function () {
                    return copyRules(this.formRule)
                }, add: function () {
                    !this.disabled && this.addRule(!0)
                }, del: function (e) {
                    this.disabled || (this.removeRule(e, !0), this.subForm())
                }, addIcon: function (e) {
                    return (0, this.$createElement)("i", {
                        key: "a".concat(e),
                        class: "el-icon-circle-plus-outline",
                        style: "font-size:".concat(this.fontSize, "px;cursor:").concat(this.disabled ? "not-allowed;color:#c9cdd4" : "pointer", ";"),
                        on: {click: this.add}
                    })
                }, delIcon: function (e) {
                    var t = this;
                    return (0, this.$createElement)("i", {
                        key: "d".concat(e),
                        class: "el-icon-remove-outline",
                        style: "font-size:".concat(this.fontSize, "px;cursor:").concat(this.disabled ? "not-allowed;color:#c9cdd4" : "pointer;color:#606266", ";"),
                        on: {
                            click: function () {
                                return t.del(e)
                            }
                        }
                    })
                }, makeIcon: function (e, t, r) {
                    var n = this;
                    return this.$scopedSlots.button ? this.$scopedSlots.button({
                        total: e,
                        index: t,
                        vm: this,
                        key: r,
                        del: function () {
                            return n.del(r)
                        },
                        add: this.add
                    }) : 0 === t ? [0 !== this.max && e >= this.max ? null : this.addIcon(r), 0 === this.min || e > this.min ? this.delIcon(r) : null] : t >= this.min ? this.delIcon(r) : void 0
                }
            },
            created: function () {
                for (var e = 0; e < this.value.length; e++) this.addRule()
            },
            render: function () {
                var e = this, t = arguments[0], r = Object.keys(this.cacheRule), n = this.button;
                return 0 === r.length ? this.$scopedSlots.default ? this.$scopedSlots.default({
                    vm: this,
                    add: this.add
                }) : t("i", {
                    key: "a_def",
                    class: "el-icon-circle-plus-outline",
                    style: "font-size:".concat(this.fontSize, "px;vertical-align:middle;color:").concat(this.disabled ? "#c9cdd4;cursor: not-allowed" : "#606266;cursor:pointer", ";"),
                    on: {click: this.add}
                }) : t("div", {key: "con"}, [r.map(function (i, o) {
                    var a = e.cacheRule[i];
                    return t("ElRow", {
                        attrs: {align: "middle", type: "flex"},
                        key: i,
                        style: "background-color:#f5f7fa;padding:10px;border-radius:5px;margin-bottom:10px;"
                    }, [t("ElCol", {attrs: {span: n ? 20 : 24}}, [t("ElFormItem", [t("FormCreate", {
                        on: {
                            mounted: function (t) {
                                return e.add$f(o, i, t)
                            }, "on-reload": function (t) {
                                return e.syncData(i, t)
                            }
                        }, attrs: {rule: a, option: e.option}
                    })])]), n ? t("ElCol", {
                        attrs: {
                            span: 2,
                            pull: 1,
                            push: 1
                        }
                    }, [e.makeIcon(r.length, o, i)]) : null])
                })])
            }
        }, components = [checkbox, frame, radio, select, tree, upload, group], parser = function (e) {
            function t() {
                return _classCallCheck(this, t), _possibleConstructorReturn(this, _getPrototypeOf(t).apply(this, arguments))
            }

            return _inherits(t, BaseParser), _createClass(t, [{
                key: "render", value: function (e) {
                    var t = this, r = this.$render.inputVData(this, !0).get();
                    return this.vNode.checkbox({
                        props: {
                            ctx: r,
                            type: r.props.type,
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
                key: "toFormValue", value: function (e) {
                    var t, r = Array.isArray(e), n = this.rule.props, i = n.type || "date";
                    return t = -1 !== ["daterange", "datetimerange", "dates"].indexOf(i) ? r ? e.map(function (e) {
                        return e ? timeStampToDate(e) : ""
                    }) : ["", ""] : "date" === i && !0 === n.multiple ? toString(e) : (t = r ? e[0] || "" : e) ? timeStampToDate(t) : ""
                }
            }, {
                key: "mounted", value: function () {
                    var e = this;
                    this.toValue = function (t) {
                        return e.el.formatToString(t) || ""
                    }, this.toFormValue = function (t) {
                        return e.el.parseString(t)
                    }
                }
            }]), t
        }(), name$1 = "datePicker", datePicker = {parser: Parser, name: name$1},
        Parser$1 = function (e) {
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
        }(), name$2 = "frame", frame$1 = {parser: Parser$1, name: name$2}, name$3 = "hidden",
        parser$1 = function (e) {
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
                    return this.vNode.switch(this.$render.inputVData(this).get(), e)
                }
            }]), t
        }(), name$8 = "switch", iswitch = {parser: parser$2, name: name$8};

    function getTime(e) {
        return isDate(e) ? dateFormat("hh:mm:ss", e) : e
    }

    function toDate(e) {
        return new Date("2018/02/14 " + e)
    }

    var Parser$6 = function (e) {
            function t() {
                return _classCallCheck(this, t), _possibleConstructorReturn(this, _getPrototypeOf(t).apply(this, arguments))
            }

            return _inherits(t, BaseParser), _createClass(t, [{
                key: "toFormValue", value: function (e) {
                    var t, r = Array.isArray(e);
                    return !0 === this.rule.props.isRange ? r ? 2 !== (t = e.map(function (e) {
                        return e ? toDate(getTime(timeStampToDate(e))) : ""
                    }).filter(function (e) {
                        return !!e
                    })).length && (t = null) : t = null : (r && (e = e[0]), t = e ? toDate(getTime(timeStampToDate(e))) : null), t
                }
            }, {
                key: "mounted", value: function () {
                    var e = this;
                    this.toValue = function (t) {
                        return e.el.formatToString(t)
                    }
                }
            }]), t
        }(), name$9 = "timePicker", timePicker = {parser: Parser$6, name: name$9},
        Parser$7 = function (e) {
            function t() {
                return _classCallCheck(this, t), _possibleConstructorReturn(this, _getPrototypeOf(t).apply(this, arguments))
            }

            return _inherits(t, BaseParser), _createClass(t, [{
                key: "init", value: function () {
                    var e = this.rule.props;
                    isUndef(e.nodeKey) && $set(e, "nodeKey", "id"), isUndef(e.props) && $set(e, "props", {label: "title"})
                }
            }, {
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
        }(), name$a = "tree", tree$1 = {parser: Parser$7, name: name$a}, Parser$8 = function (e) {
            function t() {
                return _classCallCheck(this, t), _possibleConstructorReturn(this, _getPrototypeOf(t).apply(this, arguments))
            }

            return _inherits(t, BaseParser), _createClass(t, [{
                key: "render", value: function (e) {
                    var t = this, r = this.$render.parserToData(this).get(), n = this.key,
                        i = this.refName;
                    delete r.props.fileList;
                    var o = {
                        uploadType: r.props.uploadType,
                        maxLength: r.props.limit,
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
        }(), name$b = "upload", upload$1 = {parser: Parser$8, name: name$b},
        parsers = [checkbox$1, datePicker, frame$1, hidden, input, radio$1, select$1, slider, iswitch, timePicker, tree$1, upload$1];

    function getConfig() {
        return {
            form: {
                inline: !1,
                labelPosition: "right",
                labelSuffix: void 0,
                hideRequiredAsterisk: !1,
                labelWidth: "125px",
                showMessage: !0,
                inlineMessage: !1,
                statusIcon: !1,
                validateOnRuleChange: !0,
                disabled: !1,
                size: void 0
            },
            row: {gutter: 0, type: void 0, align: void 0, justify: void 0, tag: "div"},
            info: {
                type: "popover",
                trigger: "hover",
                placement: "top-start",
                icon: "el-icon-warning"
            },
            submitBtn: {
                type: "primary",
                size: "medium",
                plain: !1,
                round: !1,
                circle: !1,
                loading: !1,
                disabled: !1,
                icon: "el-icon-upload",
                width: "100%",
                autofocus: !1,
                nativeType: "button",
                innerText: "提交",
                show: !0,
                col: void 0,
                click: void 0
            },
            resetBtn: {
                type: "default",
                size: "medium",
                plain: !1,
                round: !1,
                circle: !1,
                loading: !1,
                disabled: !1,
                icon: "el-icon-refresh",
                width: "100%",
                autofocus: !1,
                nativeType: "button",
                innerText: "重置",
                show: !1,
                col: void 0,
                click: void 0
            }
        }
    }

    var nodes = {
        button: "el-button",
        icon: "i",
        slider: "el-slider",
        rate: "el-rate",
        upload: "fc-elm-upload",
        cascader: "el-cascader",
        colorPicker: "el-color-picker",
        timePicker: "el-time-picker",
        datePicker: "el-date-picker",
        switch: "el-switch",
        select: "fc-elm-select",
        checkbox: "fc-elm-checkbox",
        radio: "fc-elm-radio",
        inputNumber: "el-input-number",
        input: "el-input",
        formItem: "el-form-Item",
        form: "el-form",
        frame: "fc-elm-frame",
        col: "el-col",
        row: "el-row",
        tree: "fc-elm-tree",
        autoComplete: "el-autocomplete",
        group: "fc-elm-group"
    }, upperCaseReg = /[A-Z]/;

    function isAttr(e, t) {
        return !upperCaseReg.test(e) && (isString(t) || isType(t, "Number"))
    }

    function isTooltip(e) {
        return "tooltip" === e.type
    }

    var Form = function (e) {
            function t() {
                return _classCallCheck(this, t), _possibleConstructorReturn(this, _getPrototypeOf(t).apply(this, arguments))
            }

            return _inherits(t, BaseForm), _createClass(t, [{
                key: "inputVData", value: function (e) {
                    var t = e.rule.props || {};
                    e.vData.attrs(Object.keys(t).reduce(function (e, r) {
                        return isAttr(r, t[r]) && (e[r] = t[r]), e
                    }, {})), !t.size && this.options.form.size && e.vData.props("size", this.options.form.size)
                }
            }, {
                key: "validate", value: function (e) {
                    this.getFormRef().validate(function (t) {
                        e && e(t)
                    })
                }
            }, {
                key: "validateField", value: function (e, t) {
                    this.getFormRef().validateField(e, t)
                }
            }, {
                key: "resetField", value: function (e) {
                    this.vm.$refs[e.formItemRefName].resetField()
                }
            }, {
                key: "clearValidateState", value: function (e) {
                    var t = this.vm.$refs[e.formItemRefName];
                    t && (t.validateMessage = "", t.validateState = "")
                }
            }, {
                key: "beforeRender", value: function () {
                    this.propsData = this.vData.props(this.options.form).props({
                        model: this.$handle.formData,
                        rules: this.$handle.validate,
                        key: "form" + this.unique
                    }).ref(this.refName).nativeOn({submit: preventDefault}).class(this.options.form.className).class("form-create", !0).key(this.unique).get()
                }
            }, {
                key: "render", value: function (e) {
                    return e.length > 0 && e.push(this.makeFormBtn()), this.vNode.form(this.propsData, [!1 === this.options.row ? e : this.makeRow(e)])
                }
            }, {
                key: "makeRow", value: function (e) {
                    var t = {}, r = this.options.row || {};
                    return r.class && (t[r.class] = !0), this.vNode.row({
                        props: r || {},
                        key: "fr" + this.unique,
                        class: t
                    }, e)
                }
            }, {
                key: "container", value: function (e, t) {
                    return this.makeFormItem(t, e)
                }
            }, {
                key: "makeFormItem", value: function (e, t) {
                    var r = "fItem".concat(e.key).concat(this.unique), n = e.rule, i = e.field,
                        o = e.formItemRefName, a = this.getGetCol(e),
                        s = a.labelWidth || n.title ? a.labelWidth : 0, u = this.propsData.props,
                        l = u.inline, c = u.col, f = this.vData.props({
                            prop: i,
                            rules: n.validate,
                            labelWidth: toString$1(s),
                            required: n.props.required
                        }).key(r).ref(o).class(n.className).get(),
                        h = this.vNode.formItem(f, [t, this.makeFormPop(e, r)]);
                    return !0 === l || !1 === c ? h : this.makeCol(a, e, r, [h])
                }
            }, {
                key: "makeFormPop", value: function (e, t) {
                    var r = e.rule;
                    if (r.title) {
                        var n = this.options.info || {}, i = [r.title];
                        return r.info && i.push(this.vNode.make(isTooltip(n) ? "el-tooltip" : "el-popover", {
                            props: _objectSpread2({}, n, {content: r.info}),
                            key: "pop".concat(t)
                        }, [this.vNode.icon({
                            class: [n.icon || "el-icon-warning"],
                            slot: isTooltip(n) ? "default" : "reference"
                        })])), this.vNode.make("span", {slot: "label"}, i)
                    }
                }
            }, {
                key: "makeCol", value: function (e, t, r, n) {
                    var i;
                    void 0 === e.span && (e.span = 24);
                    var o = (_defineProperty(i = {}, style.__fc_h, !!t.rule.hidden), _defineProperty(i, style.__fc_v, !!t.rule.visibility), i);
                    return e.class && (o[e.class] = !0), this.vNode.col({
                        props: e,
                        class: o,
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
                        key: "frsbtn".concat(this.unique),
                        props: r,
                        on: {
                            click: function () {
                                var e = t.$handle.fCreateApi;
                                isFunction(r.click) ? r.click(e) : e.resetFields()
                            }
                        },
                        style: {width: r.width}
                    }, [r.innerText])])
                }
            }, {
                key: "makeSubmitBtn", value: function (e) {
                    var t = this, r = this.vm.buttonProps, n = r.col || {span: e};
                    return this.vNode.col({
                        props: n,
                        key: "".concat(this.unique, "col4")
                    }, [this.vNode.button({
                        key: "fbtn".concat(this.unique),
                        props: r,
                        on: {
                            click: function () {
                                var e = t.$handle.fCreateApi;
                                isFunction(r.click) ? r.click(e) : e.submit()
                            }
                        },
                        style: {width: r.width}
                    }, [r.innerText])])
                }
            }]), t
        }(), name$c = "datePicker",
        datePicker$1 = ["year", "month", "date", "dates", "week", "datetime", "datetimeRange", "dateRange"].reduce(function (e, t) {
            return e[t] = creatorTypeFactory(name$c, t.toLowerCase()), e
        }, {}), name$d = "frame", types = {
            frameInputs: ["input", 0],
            frameFiles: ["file", 0],
            frameImages: ["image", 0],
            frameInputOne: ["input", 1],
            frameFileOne: ["file", 1],
            frameImageOne: ["image", 1]
        }, maker = Object.keys(types).reduce(function (e, t) {
            return e[t] = creatorTypeFactory(name$d, function (e) {
                return e.props({type: types[t][0], maxLength: types[t][1]})
            }), e
        }, {});
    maker.frameInput = maker.frameInputs, maker.frameFile = maker.frameFiles, maker.frameImage = maker.frameImages;
    var name$e = "input",
        maker$1 = ["password", "url", "email", "text", "textarea"].reduce(function (e, t) {
            return e[t] = creatorTypeFactory(name$e, t), e
        }, {});
    maker$1.idate = creatorTypeFactory(name$e, "date");
    var name$f = "select", select$2 = {
            selectMultiple: creatorTypeFactory(name$f, !0, "multiple"),
            selectOne: creatorTypeFactory(name$f, !1, "multiple")
        }, name$g = "slider", slider$1 = {sliderRange: creatorTypeFactory(name$g, !0, "range")},
        name$h = "timePicker", timePicker$1 = {
            time: creatorTypeFactory(name$h, function (e) {
                return e.props.isRange = !1
            }), timeRange: creatorTypeFactory(name$h, function (e) {
                return e.props.isRange = !0
            })
        }, name$i = "tree", types$1 = {treeSelected: "selected", treeChecked: "checked"},
        tree$2 = Object.keys(types$1).reduce(function (e, t) {
            return e[t] = creatorTypeFactory(name$i, types$1[t]), e
        }, {}), name$j = "upload", types$2 = {
            image: ["image", 0],
            file: ["file", 0],
            uploadFileOne: ["file", 1],
            uploadImageOne: ["image", 1]
        }, maker$2 = Object.keys(types$2).reduce(function (e, t) {
            return e[t] = creatorTypeFactory(name$j, function (e) {
                return e.props({uploadType: types$2[t][0], maxLength: types$2[t][1]})
            }), e
        }, {});
    maker$2.uploadImage = maker$2.image, maker$2.uploadFile = maker$2.file;
    var maker$3 = _objectSpread2({}, datePicker$1, {}, maker, {}, maker$1, {}, select$2, {}, slider$1, {}, timePicker$1, {}, tree$2, {}, maker$2),
        names = ["autoComplete", "cascader", "colorPicker", "datePicker", "frame", "inputNumber", "radio", "rate"];
    names.forEach(function (e) {
        maker$3[e] = creatorFactory(e)
    }), maker$3.auto = maker$3.autoComplete, maker$3.number = maker$3.inputNumber, maker$3.color = maker$3.colorPicker, maker$3.hidden = function (e, t) {
        return creatorFactory("hidden")("", e, t)
    }, VNode.use(nodes);
    var drive = {
            ui: "element-ui",
            version: "".concat("1.0.16"),
            formRender: Form,
            components: components,
            parsers: parsers,
            makers: maker$3,
            getConfig: getConfig
        }, _createFormCreate = createFormCreate(drive), FormCreate = _createFormCreate.FormCreate,
        install = _createFormCreate.install;
    "undefined" != typeof window && (window.formCreate = FormCreate, window.Vue && install(window.Vue));
    var maker$4 = FormCreate.maker;
    exports.default = FormCreate, exports.maker = maker$4, Object.defineProperty(exports, "__esModule", {value: !0})
});
