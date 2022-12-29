<div id="<?=$id?>"></div>

<script>
    (function (){
        const Surface = window.Surface || Surface

        let id = '<?=$id?>',
            componentData = <?=$components?>,
            setupData = <?=$setups?>,
            registerData = <?=$registers?>

        Surface[id] = {}; // 当前实例全局参数
        const app = Vue.createApp({
            setup(){
                const components = Surface.deepParse(componentData)
                const data = {}
                const PREF = '__s_component'
                for (let i in components) data[ PREF + '_' + i ] = components[i]
                Surface.deepParse(setupData).map(f => f(data));

                Surface[id] = data;
                return ()=>{
                    const children = []
                    for (let i in data) {
                        if (typeof i === 'string' && i.indexOf(PREF) === 0) children.push(new Surface.render(Vue.isRef(data[i]) ? data[i].value : data[i]).render())
                    }
                    return Vue.h('div', {class: 'surface-container'}, children)
                }
            }
        });
        Surface.deepParse(registerData).map(f => f(app));
        app.mount('#' + id);
    }())
</script>
