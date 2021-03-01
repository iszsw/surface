<?php

$images = "";

for ($i = 0; $i < 20; $i++) {
    $images .= "<img src='http://q1.qlogo.cn/g?b=qq&nk=191587".rand(100, 999)."&s=640' onclick=\"add(event)\">";
}

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <style>
        .container{
            padding: 20px;
        }
        .container>img{
            width: 150px;
            margin: 10px;
        }
        .container>img.check{
            border: 10px solid red;
            width: 130px;
        }
    </style>
</head>
<body>

<script>
    var surface_selection = []

    function add(event) {
        event.srcElement.className = event.srcElement.className == 'check' ? '' : 'check'
        surface_selection.push('http://q1.qlogo.cn/g?b=qq&nk=19158734'+Math.floor((Math.random()*10)+1)+'&s=640')
    }
</script>

<div class="container">
    <?=$images?>
</div>

</body>
</html>
