<?php

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1"> 
    <meta name="author" content="Elliott Hansen">
    <meta name="description" content="Connections Game">
    <meta name="keywords" content="Elliott Hansen UVA CS4640 HW5 Connections Game">    
         
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet/less" type="text/css" href="main.less"/>
    <script src="https://cdn.jsdelivr.net/npm/less"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Bitter:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Outfit:wght@100;200;300;400;500;600;700;800;900&display=swap');
    </style> 
    <title>HW5 - Connections Game</title>
</head>

    <body>

        <div class="main-body">
            <div class="title-block" style="margin-top: 125px;">
                <h1>
                    Connections
                </h1>
                
            </div>
            <div class="login">
                <form action="?command=start", method="post">
                    <input type="text" name="name" class="form-control" placeholder="What is your name?" required/>
                    <input type="email" name="email" class="form-control" placeholder="Enter your email" required/>
                    <input id="_submitButton" type="submit" value="Play Game!" class="btn btn-success"/>
                </form>
            </div>
        </div>

        <!-- Bootstrap script -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    </body>

</html>