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

<div id="<?= $id = $this->getId(); ?>"></div>

<?= implode("\r\n", $this->getScript()) ?>
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

</body>
</html>
