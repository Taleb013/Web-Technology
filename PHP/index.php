<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PHP Programming Toolkit</title>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }
    body {
      font-family: 'Roboto', sans-serif;
      background: linear-gradient(to right, #0f2027, #203a43, #2c5364);
      color: #fff;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      min-height: 100vh;
      padding: 20px;
    }
    h1 {
      margin-bottom: 1rem;
      font-size: 2.5rem;
    }
    .container {
      background: rgba(255, 255, 255, 0.1);
      padding: 30px;
      border-radius: 16px;
      max-width: 600px;
      width: 100%;
      box-shadow: 0 4px 20px rgba(0,0,0,0.3);
    }
    .question {
      margin: 15px 0;
      padding: 15px;
      background-color: rgba(255,255,255,0.05);
      border-left: 5px solid #00d2ff;
      transition: 0.3s;
      cursor: pointer;
    }
    .question:hover {
      background-color: rgba(0,210,255,0.1);
    }
    a {
      text-decoration: none;
      color: #00d2ff;
      font-weight: bold;
    }
    a:hover {
      color: #ffffff;
    }
    footer {
      margin-top: 30px;
      font-size: 0.9rem;
      opacity: 0.7;
    }
  </style>
</head>
<body>
  <h1>PHP Programming Toolkit</h1>
  <div class="container">
    <p>Select the functionality you want to explore:</p>
    <div class="question"><a href="check_prime.php">1. Check if a Number is Prime (Optimized)</a></div>
    <div class="question"><a href="string_filter.php">2. Remove Special Characters from String</a></div>
    <div class="question"><a href="divisible_by_five.php">3. Numbers between 200 and 250 divisible by 5</a></div>
    <div class="question"><a href="merge_arrays.php">4. Merge Two Integer Arrays (Length 3)</a></div>
  </div>
  <footer>
    Created by the ICTian
    
  </footer>
</body>
</html>
