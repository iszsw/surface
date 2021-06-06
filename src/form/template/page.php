<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <?= implode("\r\n", $this->theme) ?>
    <?= implode("\r\n", $this->getStyle()) ?>

    <style>
        body{
            padding-bottom: 60px !important;
        }
        .s-foot-btn{
            width: 100%;
            position:fixed;
            left: 0;
            bottom: 0;
            padding:10px !important;
            margin-bottom: 0 !important;
            text-align:center;
            z-index:1999;
            background-color: #fff
        }
        .s-foot-btn > .el-form-item__content {
            margin-left: 0 !important;
        }
    </style>
</head>
<body>

<div id="<?= $id = $this->getId(); ?>"></div>

<?= implode("\r\n", $this->getScript()) ?>

<script>
    (function () {
        let options = <?= $options ?>,
            columns = <?= $columns ?>,
            id = '<?= $id; ?>',
            searchPage = !!'<?= $search ?>'

        const parent = window.parent
        if (parent && parent.$surfaceTable) {
            let $table = parent.$surfaceTable
            if (searchPage) {
                let surfaceSearchData = parent.surfaceSearchData || []
                let key = btoa(location.pathname + location.search)
                let formData = {}
                if (surfaceSearchData.length > 0) {
                    for (let i = 0; i < surfaceSearchData.length; i++) {
                        if (surfaceSearchData[i].key == key) {
                            formData = surfaceSearchData[i].value
                            break;
                        }
                    }
                }
                if (!options.hasOwnProperty('props')) {
                    options.props = {}
                }
                options.props.model = formData
                options.onSubmit = function (value, then) {
                    $table.searchChange(value)
                    let exist = false;
                    search = {key, value}
                    for (let i = 0; i < surfaceSearchData.length; i++) {
                        if (surfaceSearchData[i].key == key) {
                            surfaceSearchData.splice(i, 1, search)
                            exist = true
                            break;
                        }
                    }
                    if (!exist) {
                        surfaceSearchData.push(search)
                    }
                    parent.surfaceSearchData = surfaceSearchData
                    $table.hideDialog()
                }
            }else{
                options.onSubmit = function (value, then) {
                    then(value).then(()=>{
                        setTimeout(function () {
                            $table.hideDialog()
                        }, 1500)
                    }).catch(()=>{})
                }
            }
        }

        window.$surfaceForm = surfaceForm.create(document.getElementById(id), {options, columns})

    }());
</script>

</body>
</html>
