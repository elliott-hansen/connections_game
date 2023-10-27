<?php

class CategoryGameController {

    private $input = [];
    public $category_array = [];
    public $box_ids = ["0", "1", "2", "3", "4", "5", "6", "7", "8", "9", "10", "11", "12", "13", "14", "15"];

    public function __construct($input) {
        session_start();
        $this->category_array = $this->decodeJSON("./categories.json");
        $this->input = $input;
    }    
    // private function validateAccess() {
    //     if(!isset($_POST["email"]) || !isset($_POST["name"])) {
    //         if(isset($_SESSION["initialized"])) {
    //             return;
    //         }
    //         $this->debug_logToConsole("Access Denied");
    //         session_destroy();
    //     }
    //     $this->debug_logToConsole("Access Granted");
    // }

    public function generateCategories() {
        $category_color = ["#a295c9", "#95c9bf", "#ccad83", "#d996a4"];
        $cur_color = 0;
        $cats = range(0, count($this->category_array)-1);
        shuffle($cats);
        $cat_nums = array_slice($cats, 0, 4);
        $selected_cats = [];
        foreach($cat_nums as $i) {
            $to_push = $this->category_array[$i];
            $to_push["color"] = $category_color[$cur_color];
            $cur_color++;
            array_push($selected_cats, $to_push);
        }
        return $selected_cats;
    }

    public function run() {
        $this->initializeSessionData();

        $command = "welcome";
        if (isset($this->input["command"]))
            $command = $this->input["command"];
        $this->debug_logToConsole($command);

        switch($command) {
            case "welcome":
                $this->showWelcomePage();
                break;
            case "start":
                $this->startGame();
                break;
            case "giveup":
                $this->GiveUp();
                break;
            case "makeguess":
                $this->makeGuess();
                break;
            case "killgame":
                $this->killGame();
                break;
            case "restart":
                $this->restartGame();
                break;
            case "wingame":
                $this->winGame();
                break;
        }
        
    }

    public function killGame() {
        session_destroy();
        $this->debug_logToConsole("Session destroyed");
        include("./homepage.php");
    }
    public function showWelcomePage() {
        include("./homepage.php");
    }
    public function GiveUp() {
        $loss = true;
        $categories = $_SESSION["categories"];
        include("./gameover.php");
    }

    public function winGame() {
        $loss = false;
        $sessionguesses = $_SESSION["guesses"];
        $categories = $_SESSION["categories"];
        include("./gameover.php");
    }

    private function login() {
        if(isset($_POST["name"]) && isset($_POST["email"])) {
            $this->debug_logToConsole("Logging In...");
            $_SESSION["user"] = $_POST["name"];
            $_SESSION["email"] = $_POST["email"];
        }
    }

    public function restartGame() {
        $this->debug_logToConsole("Restarting...");
        $hold_username = $_SESSION["user"];
        $hold_email = $_SESSION["email"];
        session_destroy();
        session_start();
        $_SESSION["user"] = $hold_username;
        $_SESSION["email"] = $hold_email;
        $this->initializeSessionData();
        $this->startGame();
    }

    public function startGame($message="") {
        if(!isset($_SESSION["user"]) || !isset( $_SESSION["email"])) {
            $this->login();
        }
        $this->debug_logToConsole("Starting game...");
        $categories = $_SESSION["categories"];
        $category_words = $_SESSION["category_words"];
        $email = $_SESSION["email"];
        $user = $_SESSION["user"];
        $guesses = $_SESSION["guesses"];
        $foundboxes = $_SESSION["guessed_boxes"];
        $errormessage = $message;
        $guessarray = $_SESSION["past_guesses"];
        $this->debug_logToConsole($user);
        $this->debug_logToConsole($email);
        include("./game.php");
    }

    public function makeGuess() {
        $this->debug_logToConsole("Making Guess...");
        //logic for making guess
        $current_guess = [];
        foreach($this->box_ids as $id) {
            if(isset($_POST[$id])) {
                array_push($current_guess, $id);
            }
        }
        if(count($current_guess) != 4) {
            $this->debug_logToConsole("Invalid Guess");
            $message = "<span id='_errorMessage' class='text-danger'> Invalid Guess! </span>";
            $this->startGame($message);
            return;
        }
        $_SESSION["guesses"] += 1;
        $found = 0;
        foreach($_SESSION["categories"] as $guess_category) {
            $this->debug_logToConsole($guess_category["category"]);
            foreach($current_guess as $guess) {
                if(!in_array($_SESSION["category_words"][$guess], $guess_category["words"])) {
                    $this->debug_logToConsole("failed to find");
                    break;
                }
                $this->debug_logToConsole("FOUND");
                $found++;
            }
            if($found == 4) {
                $this->debug_logToConsole("CORRECT GUESS");
                $_SESSION["correct"]++;
                $this->debug_logToConsole($_SESSION["correct"]);
                foreach($current_guess as $i) {
                    array_push($_SESSION["guessed_boxes"], $i);
                }
                $this->pushGuessArray($current_guess);
                $message = "<span id='_errorMessage' class='text-success'> Correct Guess! </span>";
                if($_SESSION["correct"] >= 4) {
                    $this->winGame();
                    return;
                }
                $this->startGame($message);
                return;
            }
        }
        $this->debug_logToConsole("INCORRECT GUESS");
        $this->pushGuessArray($current_guess);
        $message = "<span id='_errorMessage' class='text-danger'> Incorrect Guess! </span>";
        $this->startGame($message);
        return;
    }
    private function initializeSessionData() { //Initializes all session data if the session data is not already set.

        $this->debug_logToConsole("decoding json...");
        $categories = $this->decodeJSON("./categories.json");
        
        if(!isset($_SESSION["initialized"])) {
            $_SESSION["initialized"] = true;
            $_SESSION["guesses"] = 0;
            $_SESSION["correct"] = 0;
            $_SESSION["past_guesses"] = [];
            $_SESSION["guessed_boxes"] = [];
            $categories = $this->generateCategories();
            $_SESSION["categories"] = $categories;
            $category_words = [];

            foreach($categories as $category) {
                foreach($category["words"] as $i) {
                    array_push($category_words, $i);
                }
            }
            shuffle($category_words);
            $_SESSION["category_words"] = $category_words;
        }

    }

    function selectChoice($choice) {
        if ($_SESSION["boxes_checked"] <= 4) {
            $_SESSION["boxes_checked"]++;
            $this->debug_logToConsole($_SESSION["boxes_checked"]);
        }
        else {
            return false;
        }
    }

    public function decodeJSON($FILENAME) {
        $json = file_get_contents($FILENAME);
        $json_data = json_decode($json, true);
        return $json_data;
    }

    public function debug_logToConsole($data) {
        echo "<script>  console.log('DATA: '+'$data')</script>";
    }

    public function calculateScore($guess) {
        $scores = [];
        foreach($_SESSION["categories"] as $category) {
            $scores[$category["category"]] = 0;
        }
        foreach($guess as $i) {
            foreach($_SESSION["categories"] as $category) {
                if(in_array($i, $category["words"])) {
                    $scores[$category["category"]]++;
                }
            }
        }
        $max = max(array_values($scores));
        return $max;
    }
    public function pushGuessArray($guess) {
        $this->debug_logToConsole("Pushing array...");
        $guessarray = $_SESSION["past_guesses"];
        $new_arr = [];
        foreach($guess as $i) {
            array_push($new_arr, $_SESSION["category_words"][$i]);
        }
        $guess = $new_arr;
        $new_guess = [];
        $new_guess["words"] = $guess;
        $new_guess["score"] = $this->calculateScore($guess);
        $guess = $new_guess;


        if(count($guessarray) >= 4) {
            $this->debug_logToConsole("cycling...");
            array_shift($guessarray);
            array_push($guessarray, $guess);
        }
        else {
            array_push($guessarray, $guess);
        }
        $_SESSION["past_guesses"] = $guessarray;
    }

}