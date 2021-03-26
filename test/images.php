<?php

$images = "";

for ($i = 0; $i < 20; $i++) {
    $id = '191587' . rand(100, 999);
    $images .= "<img src='http://q1.qlogo.cn/g?b=qq&nk=".$id."&s=640' onclick=\"add(event, $id)\">";
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

    function getQueryVariable(variable)
    {
        var query = window.location.search.substring(1);
        var vars = query.split("&");
        for (var i=0;i<vars.length;i++) {
            var pair = vars[i].split("=");
            if(pair[0] == variable){return pair[1];}
        }
        return(false);
    }

    let isTake = getQueryVariable('take') !== false

    function add(event, id) {
        if (event.srcElement.className == 'check') {
            event.srcElement.className = ''
            surface_selection.pop()
        }else{
            event.srcElement.className = 'check'
            let url = 'http://q1.qlogo.cn/g?b=qq&nk='+id+'&s=640'

            surface_selection.push(isTake ? {
                label: '<img src="http://q1.qlogo.cn/g?b=qq&nk='+id+'&s=640">',
                value: id
            } : url)
        }
    }

</script>

<div class="container">
    <?=$images?>
</div>

</body>
</html>
