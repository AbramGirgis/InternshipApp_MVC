<?php

class ProfileStudent
{


    public function __construct()
    {
        $this->render();
    }

    function render()
    {
        $html = '
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<p>Student Home page!!!</p>
<br>

</body>
</html>
        ';
        echo $html;
        echo "<br>";
        echo '<a href="'.ROOTURL.'/logout/'.'">Logout</a>';
    }
}