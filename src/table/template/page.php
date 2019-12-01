<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <?= implode("\r\n", $this->getStyle()) ?>

    <style>
        @keyframes fadeInRight{
            0% {
                opacity: 0;
                -webkit-transform: translateX(40px);
                transform: translateX(40px);
            }

            100% {
                opacity: 1;
                -webkit-transform: translateX(0);
                transform: translateX(0);
            }
        }
        .fadeInRight{
            animation:fadeInRight 1s ease 0s 1 both;
        }
    </style>
</head>
<body>

<div class="fadeInRight" id="<?= $this->getId(); ?>"></div>

<?= implode("\r\n", $this->getScript()) ?>
<script>
    (function () {
        window.$t = new TableSurface('#<?=$this->getId();?>', <?= json_encode($this->table(), JSON_UNESCAPED_UNICODE) ?>, {
            id: '<?=$this->getId();?>_search',
            constitute : <?=json_encode($this->getSearchParam('constitute'))?>,
            rule : <?=json_encode($this->getSearchParam('rule'))?>,
            global: <?=json_encode($this->getSearchParam('globals'))?>})
    }());
</script>

</body>
</html>