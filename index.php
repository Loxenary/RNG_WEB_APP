<?php
include 'config.php';
function rollDice($sides, $numDices){
  global $diceSides;

  $selectedDice = $diceSides[$sides] ?? 4;
  $results = [];

  for($i = 0; $i < $numDices; $i++){
    $results[] = rand(1, $selectedDice);
  }
  
  return $results;
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="./Style.css" />
    <title>Besok RNG Minggu Genereator</title>
  </head>
  <body>
    <main>
      <section class="introduction">
        <h1>
          Besok Minggu RNG Generator
        </h1>
        <div class="empty-line">
        </div>

      </section>
      <section class = "input">
        
        <form method = "post" action = "">
          <div class="box-input-dice">
            <label for="input-dice">Select amount of Dice</label>
            <input id="input-dice" type="number" placeholder="How Many Times the Dice roll?" name="input-dice">
          </div>
          <div class="box-dropdown-dice">
            <label for="dice-side">Select side of dice: </label>
            <select id="dice-side" name="dice-side" >
              <option value="d2">D2</option>
              <option value="d4">D4</option>
              <option value="d8">D8</option>
              <option value="d10">D10</option>
              <option value="d12">D12</option>
              <option value="d20">D20</option>
            </select>
          </div>
          <button class="submit-button" type="submit">Roll Dice</button>
        </form>
      </section>
      <section class="output">
        <div class="empty-line">
        </div>
        <h1 class="title">Output</h1>
        <div class="output-value">
          <?php 

          include 'config.php';
          if($_SERVER['REQUEST_METHOD'] == "POST"){
            $numberOfRolls = isset($_POST['input-dice']) ? (int)$_POST['input-dice'] : 0;

            $selectedSide = isset($_POST['dice-side']) ? $_POST['dice-side'] : 'd2';

            $results = rollDice($selectedSide, $numberOfRolls);
            echo "<h2>Number Dice Rolled : $numberOfRolls </h2>";
            echo "<h2>Dice Side Type : $selectedSide (" . $diceSides[$selectedSide] . " sides) </h2>";
            echo "<h2>Total Count of Dices : ". array_sum($results). "</h2>";

            echo "<h2> Details: </h2>";
            echo "<table border='1' cellpadding='5' cellspacing='0'>";
            echo "<tr><th>Dice Number</th><th>Result</th></tr>";
            
            foreach($results as $i => $number){
              echo "<tr>";
              echo "<td>". ($i + 1) . "</td>";
              echo "<td>" . $number . "</td>";
              echo "<tr>";
            }
            echo "</table>";
          }
          ?>
        </div>
      </section>
    </main>
  </body>
</html>
