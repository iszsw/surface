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
        window.$surfaceTable = surfaceTable.create(document.getElementById('<?= $id; ?>'), {
            header: <?= $header; ?>,
            pagination: <?= $pagination; ?>,
            options: <?= $options ?>,
            columns: <?= $columns ?>,
        })
    }());
</script>

<?php
if ($search){
?>
<script>
    (function () {
        let searchNode = document.getElementById('s-search-collapse')
        if ( searchNode ) {
            let options = <?= $searchOptions ?>;
            if (this.$surfaceTable) {
                let that = this
                options.onSubmit = function (value, then) {
                    that.$surfaceTable.searchChange && that.$surfaceTable.searchChange(value)
                }
            }

            window.$surfaceForm = surfaceForm.create(searchNode, {options, columns: <?= $searchColumns ?>})
        }
    }());
</script>
<?php
}
?>

</body>
</html>
