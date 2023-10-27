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
            <div class="title-block" style="margin-top: 20px;">
                <h1>
                    Connections
                </h1>
            </div>
            <div class="title-block">
                <h2>
                    <?=$user?> (<?=$email?>)
                </h2>
            </div>
            <form action="?command=makeguess" method="post" class="game-block">
                <div class="game-row">
                    <?php
                        for($i = 0; $i < 4; $i++) {
                            $j = $i+0;
                            $item = $category_words[$j];
                            foreach($categories as $category) {
                                foreach($category["words"] as $word) {
                                    if ($word == $item) {
                                        $category_color = $category["color"];
                                        break 2;
                                    }
                                }
                            }
                            if(!in_array($j, $foundboxes)) {
                                echo "<label class='game-choice-container'> <input name='$j' type='checkbox'/> <div class='game-choice'> <h3> $item </h3> </div> </label>";
                            }
                            else {
                                echo "<label class='game-choice-container'> <input name='$j' type='checkbox'/> <div class='game-choice' style='user-select:none; color: white; background-color: $category_color'> <h3> $item </h3> </div> </label>";
                            }
                        }
                    ?>
                </div>
                <div class="game-row">
                    <?php
                        for($i = 0; $i < 4; $i++) {
                            $j = $i+4;
                            $item = $category_words[$j];
                            foreach($categories as $category) {
                                foreach($category["words"] as $word) {
                                    if ($word == $item) {
                                        $category_color = $category["color"];
                                        break 2;
                                    }
                                }
                            }
                            if(!in_array($j, $foundboxes)) {
                                echo "<label class='game-choice-container'> <input name='$j' type='checkbox'/> <div class='game-choice'> <h3> $item </h3> </div> </label>";
                            }
                            else {
                                echo "<label class='game-choice-container'> <input name='$j' type='checkbox'/> <div class='game-choice' style='user-select:none; color: white; background-color: $category_color'> <h3> $item </h3> </div> </label>";
                            }
                        }
                    ?>
                </div>
                <div class="game-row">
                    <?php
                        for($i = 0; $i < 4; $i++) {
                            $j = $i+8;
                            $item = $category_words[$j];
                            foreach($categories as $category) {
                                foreach($category["words"] as $word) {
                                    if ($word == $item) {
                                        $category_color = $category["color"];
                                        break 2;
                                    }
                                }
                            }
                            if(!in_array($j, $foundboxes)) {
                                echo "<label class='game-choice-container'> <input name='$j' type='checkbox'/> <div class='game-choice'> <h3> $item </h3> </div> </label>";
                            }
                            else {
                                echo "<label class='game-choice-container'> <input name='$j' type='checkbox'/> <div class='game-choice' style='user-select:none; color: white; background-color: $category_color'> <h3> $item </h3> </div> </label>";
                            }
                        }
                    ?>
                </div>
                <div class="game-row">
                    <?php
                        for($i = 0; $i < 4; $i++) {
                            $j = $i+12;
                            $item = $category_words[$j];
                            foreach($categories as $category) {
                                foreach($category["words"] as $word) {
                                    if ($word == $item) {
                                        $category_color = $category["color"];
                                        break 2;
                                    }
                                }
                            }
                            if(!in_array($j, $foundboxes)) {
                                echo "<label class='game-choice-container'> <input name='$j' type='checkbox'/> <div class='game-choice'> <h3> $item </h3> </div> </label>";
                            }
                            else {
                                echo "<label class='game-choice-container'> <input name='$j' type='checkbox'/> <div class='game-choice' style='user-select:none; color: white; background-color: $category_color'> <h3> $item </h3> </div> </label>";
                            }
                        }
                    ?>
                </div>

                <div class="game-row", method="post" style="height: auto; justify-content: space-between">
                    <button formaction="?command=giveup" type="submit" class="btn btn-danger">
                        Give Up?
                    </button>
                    <div style="text-align: center;">
                        <span>
                            GUESS: <?=$guesses?>
                        </span>
                        <br>
                        <?=$errormessage?>
                    </div>
                    <button type="submit" class="btn btn-success">
                        Make Guess!
                    </button>
                </div>
            </form>
            <div class="guess-tracker" style="border-radius: 20;">
                <div class="guess-tracker-inner">

                    <?php
                        $cold = "#a83240";
                        $cool = "#a87132";
                        $warm = "#a8a832";
                        $hot = "#32a852";

                        foreach($guessarray as $pastguess) {
                            $guesstext = "";
                            foreach($pastguess["words"] as $item) {
                                $guesstext .= " | ". mb_strimwidth($item, 0, 18);
                            }
                            $guesstext .= " |";
                            $score = $pastguess["score"];

                            if($score == 1) {
                                $bgcolor = $cold;
                            }
                            else if($score == 2) {
                                $bgcolor = $cool;
                            }
                            else if($score == 3) {
                                $bgcolor = $warm;
                            }
                            else if($score == 4) {
                                $bgcolor = $hot;
                            }

                            echo "<div class='guess-tracked' style='background-color:$bgcolor'> <span> >> $guesstext </span> <span style='margin-left: auto;'> $score/4 </span> </div>";
                        }
                    ?>

                </div>
            </div>
        </div>
        <!-- Bootstrap script -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    </body>

</html>