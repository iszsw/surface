<div id="<?=$id?>"><?=$documentNode?></div>

<script>
    (function (){
        let id = '<?=$id?>'
        Surface[id] = {}; // 当前实例全局参数
        const app = Vue.createApp({
            setup(){
                const data = Surface.deepParse(<?=$documentData?>);
                Surface.deepParse(<?=$setups?>).map(f => f(data));
                Surface[id] = data;
                return data
            }
        });
        Surface.deepParse(<?=$registers?>).map(f => f(app));
        app.mount('#' + id);
    }())
</script>
