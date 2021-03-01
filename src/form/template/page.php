<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <?= implode("\r\n", $this->getStyle()) ?>
</head>
<body>

<div id="<?= $id; ?>"></div>

<?= implode("\r\n", $this->getScript()) ?>

<script>
    (function () {
        let form = <?= $form; ?>;
        const parent = window.parent
        if (form.search && undefined == form.onSubmit && parent && parent.$surfaceTable) {
            let $table = parent.$surfaceTable,
            surfaceSearchData = parent.surfaceSearchData || []
            let key = btoa(location.pathname + location.search)
            let formData = {}
            if (surfaceSearchData.length > 0) {
                console.log(surfaceSearchData, key)
                for (let i = 0; i < surfaceSearchData.length; i++){
                    if (surfaceSearchData[i].key == key ) {
                        formData = surfaceSearchData[i].value
                        break;
                    }
                }
            }
            form.formData = formData
            form.onSubmit = function (value, then) {
                $table.searchChange(value)
                let exist = false;search = {key, value}
                for (let i = 0; i < surfaceSearchData.length; i++){
                    if (surfaceSearchData[i].key == key ) {
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
        }

        window.$surfaceForm = surfaceForm.create(<?= $columns; ?>, {el: document.getElementById('<?= $id; ?>'), ...form})

    }());
</script>

</body>
</html>
