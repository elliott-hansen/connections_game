<!-- <?php
    print("<pre>".print_r($categories,true)."</pre>");

?> -->

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
            <div class="title-block" style="margin-top: 35px;">
                <h1>
                    Connections
                </h1>
                <h1 style="font-family: Bitter; font-size: 80px;">
                    <?php
                        if($loss) {
                            echo "GAME OVER";
                        }
                        else {
                            echo "YOU WIN!";
                        }
                    ?>
                </h1>
            </div>
            <div class="game-over">
                <div class="game-over-answers" style="margin-bottom: 30px">
                    <?php
                        foreach($categories as $category) {
                            $category_color = $category['color'];
                            $category_name = $category['category'];
                            echo "<div class='category' style='background-color: $category_color'> $category_name </div>";
                        }
                    ?>
                </div>
                <div class="game-over-answers" style="height: 60px">
                    <?php
                        $category_color = $categories[0]['color'];
                        foreach($categories[0]["words"] as $item) {
                            echo "<div class='answer' style='background-color: $category_color'> $item </div>";
                        }
                    ?>
                </div>
                <div class="game-over-answers" style="height: 60px">
                    <?php
                        $category_color = $categories[1]['color'];
                        foreach($categories[1]["words"] as $item) {
                            echo "<div class='answer' style='background-color: $category_color'> $item </div>";
                        }
                    ?>
                </div>
                <div class="game-over-answers" style="height: 60px">
                    <?php
                        $category_color = $categories[2]['color'];
                        foreach($categories[2]["words"] as $item) {
                            echo "<div class='answer' style='background-color: $category_color'> $item </div>";
                        }
                    ?>
                </div>
                <div class="game-over-answers" style="height: 60px">
                    <?php
                        $category_color = $categories[3]['color'];
                        foreach($categories[3]["words"] as $item) {
                            echo "<div class='answer' style='background-color: $category_color'> $item </div>";
                        }
                    ?>
                </div>
                <form class="game-row" method="post" style="height: auto; margin-top: 25px; justify-content: space-between;">
                    <button formaction="?command=killgame" class="btn btn-danger">
                        Exit?
                    </button>
                    <?php
                        if($loss) {
                            echo "<span> Better luck next time! </span>";
                        }
                        else {
                            echo "<span> You guessed: $sessionguesses times! </span>";
                        }
                    ?>
                    <button formaction="?command=restart"class="btn btn-success">
                        Play Again?
                    </button>
                </form>
            </div>
        </div>

        <!-- Bootstrap script -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    </body>

</html>