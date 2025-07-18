<!-- File: divisible_by_five.php -->
<?php
// divisible_by_five.php
// Display all numbers between 200 and 250 that are divisible by 5

$start = 200;
$end = 250;
$divisibleByFive = [];

for ($i = $start; $i <= $end; $i++) {
    if ($i % 5 === 0) {
        $divisibleByFive[] = $i;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Numbers Divisible by 5</title>
  <style>
    /* Global reset */
    * { margin: 0; padding: 0; box-sizing: border-box; }
    body {
      font-family: 'Segoe UI', Tahoma, sans-serif;
      background: linear-gradient(135deg, #00c6ff, #0072ff);
      color: #333;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }
    .card {
      background: #fff;
      padding: 40px;
      border-radius: 12px;
      box-shadow: 0 8px 30px rgba(0,0,0,0.1);
      max-width: 500px;
      width: 90%;
      text-align: center;
    }
    h1 {
      font-size: 2rem;
      margin-bottom: 20px;
      color: #0072ff;
    }
    .numbers {
      font-size: 1.1rem;
      line-height: 1.6;
      margin: 20px 0;
      background: #f0f8ff;
      padding: 15px;
      border-radius: 8px;
    }
    .back-link {
      display: inline-block;
      margin-top: 20px;
      text-decoration: none;
      background: #0072ff;
      color: #fff;
      padding: 10px 20px;
      border-radius: 6px;
      transition: background 0.3s;
    }
    .back-link:hover {
      background: #005bb5;
    }
  </style>
</head>
<body>
  <div class="card">
    <h1>Divisible by 5 (200–250)</h1>
    <div class="numbers">
      <?php echo implode(', ', $divisibleByFive); ?>
    </div>
    <a href="index.php" class="back-link">&#8592; Back to Home</a>
  </div>
</body>
</html>
