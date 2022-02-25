<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <?= implode("\r\n", $this->theme) ?>
    <?= implode("\r\n", $this->getStyle()) ?>

</head>
<body>

<?= implode("\r\n", $this->getScript()) ?>

<div id="<?= $id = $this->getId(); ?>"></div>

<script>
    (function () {
        window.__S_TABLE_hasSearch = !!<?= $search == '' ? 0: 1; ?>;

        let pagination = <?= $pagination; ?>;

        window.__S_TABLE = surfaceTable.create(document.getElementById('<?= $id; ?>'), {
            header: <?= $header; ?>,
            pagination,
            options: <?= $options ?>,
            columns: <?= $columns ?>,
        })

        if (window.__S_TABLE_hasSearch) {
            let searchNode = document.getElementById('s-search-collapse');
            if (searchNode) {
                let options = <?= $searchOptions == ''?'""':$searchOptions; ?>;
                if (this.__S_TABLE) {
                    let that = this
                    options.onSubmit = function (value, then) {
                        that.__S_TABLE.searchChange && that.__S_TABLE.searchChange(value)
                    }
                }

                window.__S_FORM = surfaceForm.create(searchNode, {
                    options,
                    columns: <?= $searchColumns == ''?'""':$searchColumns; ?>})

                // 异步多页面下自动提交搜索
                if (pagination) {
                    window.__S_FORM.submit()
                }
            }
        }
    }());
</script>


</body>
</html>
