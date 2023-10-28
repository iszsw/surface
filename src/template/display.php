<?= $styles ?>

<div id="<?=$id?>"></div>

<?= $scripts ?>
<script>
    ;(function (){
        const Surface = window.Surface || Surface;

        let id = '<?=$id?>',
            componentData = <?=$components?>,
            setupHandlers = <?=$setups?>,
            registerData = <?=$registers?>

        /**
         * setup优先执行 数据初始化深度处理通过ref|reactive|v-model 前缀绑定的参数
         *
         * 先将响应式数据绑定到全局 setup前置方法中可以正常读写 渲染前在初始化 onUpdate:实现双向绑定
         *
         * @param data
         * @private
         */
        const _setupBefore = data => {
            ;(function handler(obj, main = null){
                if (typeof obj === 'object') {
                    for (let i in obj) {
                        if (typeof i === 'string' && i.indexOf(":") > 0) {
                            let split = i.split(":", 3)
                            let func = split[0].toLocaleString()
                            if (split.length > 1 && ['ref', 'reactive', 'v-model'].indexOf(func) > -1) {
                                let attrName = split[1];
                                let bindName = split[split.length === 3 ? 2 : 1];
                                let isVModel = func === 'v-model'
                                // 深度绑定
                                let attrs = bindName.split(".");
                                let varName = attrs[0];
                                func = isVModel ? 'ref' : func
                                // ref 自动加上value
                                if ( func === 'ref' && attrs[1] !== 'value' && (!data.hasOwnProperty(varName) || Vue.isRef(data[varName]))) {
                                    attrs.splice(1, 0, 'value')
                                    bindName = attrs.join('.')
                                }
                                if (!data.hasOwnProperty(varName)) {
                                    data[varName] = Vue[func](obj[i])
                                }
                                let onUpdateName = 'onUpdate:' + attrName;
                                if (isVModel && !obj.hasOwnProperty(onUpdateName)) {
                                    obj[onUpdateName] = val => {
                                        try{
                                            eval("(data."+bindName+" = val)")
                                        }catch (e) {
                                            console.error("[ SURFACE ] 变量解析失败："+bindName, e)
                                        }
                                    }
                                }
                                // 延迟绑定数据 data.field 可能还未初始化
                                let _bind = () => {
                                    try{
                                        return eval("(data."+bindName+")")
                                    } catch (e) {
                                        console.error("[ SURFACE ] 变量解析失败："+bindName, e)
                                    }
                                }
                                _bind.__s_computed_exec = true
                                main.__s_computed = true
                                obj[attrName] = _bind
                                delete obj[i]
                                continue;
                            }
                        }
                        if(typeof obj[i] === 'object'){
                            handler(obj[i], main === null ? obj[i] : main)
                        }
                    }
                }
            }(data))

            ;(function (){
                // 延迟初始化bind参数
                const handler = function(obj) {
                    if (typeof obj === 'object') {
                        for (let i in obj) {
                            if (typeof obj[i] === 'function' && obj[i].__s_computed_exec === true) {
                                obj[i] = obj[i]()
                            } else if(typeof obj[i] === 'object'){
                                obj[i] = handler(obj[i])
                            }
                        }
                    }
                    return obj
                }
                for (let k in data) {
                    if (typeof data[k] === 'object' && data[k].__s_computed === true) {
                        let original = Surface.cloneDeep(data[k])
                        data[k] = Vue.computed(() => {
                            return handler(Surface.cloneDeep(original))
                        })
                    }
                }
            }())
        }

        Surface[id] = {}; // 当前实例全局参数
        const app = Vue.createApp({
            setup(){
                const data = {}

                // 解析组件
                const components = Surface.deepParse(componentData)

                // 指定组件前缀，区分组件对象和普通响应式对象
                const COMPONENT_PREF = '__s_component'
                for (let i in components) data[ COMPONENT_PREF + '_' + i ] = components[i]

                Surface.deepParse(setupHandlers.before).map(f => f(data));
                _setupBefore(data)
                Surface.deepParse(setupHandlers.after).map(f => f(data));

                Surface[id] = data;
                return ()=>{
                    const children = []
                    for (let i in data) {
                        if (typeof i === 'string' && i.indexOf(COMPONENT_PREF) === 0) children.push(new Surface.Render(Vue.isRef(data[i]) ? data[i].value : data[i]).render())
                    }
                    return Vue.h('div', {class: 'surface-container'}, children)
                }
            }
        });
        Surface.deepParse(registerData).map(f => f(app));
        app.mount('#' + id);
    }())
</script>
