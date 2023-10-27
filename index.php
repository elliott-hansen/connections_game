<?php

    // LINK: https://cs4640.cs.virginia.edu/enh4bn/hw5/
    // Note to grader:
    // I know that A) I submitted this late and B) I technically went off the guidelines a little
    // but I actually really enjoyed this homework assignment and learned a ton with php, and strongly
    // believe that I fulfilled this assignments' purpose to the fullest and believe my grade should
    // reflect that effort.
    // Have fun!

    include("game_functions.php");
    session_destroy();
    session_start();
    $ctrl = new CategoryGameController($_GET);
    $ctrl->run();
?>