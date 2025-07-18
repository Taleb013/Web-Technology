<!-- File: string_filter.php -->
<?php
// string_filter.php
// Remove all characters except a-z, A-Z, 0-9, and spaces with user input via HTML form
$inputText = '';
$filteredText = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $inputText = trim($_POST['inputText'] ?? '');
    if ($inputText === '') {
        $error = '🛑 Please enter some text to filter.';
    } else {
        // Filter out unwanted characters
        $filteredText = preg_replace('/[^A-Za-z0-9 ]/', '', $inputText);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>String Filter</title>
  <style>
    /* Reset & base */
    * { margin:0; padding:0; box-sizing:border-box; }
    body {
      font-family: 'Segoe UI', Tahoma, sans-serif;
      background: linear-gradient(135deg, #ff9a9e 0%, #fad0c4 100%);
      display: flex;
      align-items: center;
      justify-content: center;
      height: 100vh;
      color: #333;
    }
    .container {
      background: #fff;
      padding: 40px;
      border-radius: 12px;
      box-shadow: 0 8px 30px rgba(0,0,0,0.1);
      max-width: 600px;
      width: 90%;
      text-align: center;
    }
    h1 {
      margin-bottom: 20px;
      color: #e91e63;
      font-size: 2rem;
    }
    textarea {
      width: 100%;
      height: 120px;
      padding: 12px;
      border: 1px solid #ccc;
      border-radius: 6px;
      font-size: 1rem;
      margin-top: 10px;
    }
    button {
      margin-top: 20px;
      padding: 12px 20px;
      background: #e91e63;
      color: #fff;
      border: none;
      border-radius: 6px;
      cursor: pointer;
      font-size: 1rem;
      width: 100%;
    }
    button:hover { background: #ad1457; }
    .output, .error {
      margin-top: 20px;
      padding: 15px;
      border-radius: 6px;
      font-size: 1rem;
      text-align: left;
      word-wrap: break-word;
    }
    .output { background: #f3e5f5; color: #4a148c; }
    .error { background: #ffebee; color: #c62828; }
    .home-link {
      display: block;
      margin-top: 30px;
      color: #e91e63;
      text-decoration: none;
      font-weight: bold;
    }
    .home-link:hover { color: #ad1457; }
  </style>
</head>
<body>
  <div class="container">
    <h1>Filter Special Characters</h1>
    <form method="post" action="">
      <label for="inputText">Enter your text:</label>
      <textarea id="inputText" name="inputText"><?php echo htmlspecialchars($inputText); ?></textarea>
      <button type="submit">Filter Text</button>
    </form>

    <?php if ($error): ?>
      <div class="error"><?php echo $error; ?></div>
    <?php elseif ($filteredText !== ''): ?>
      <div class="output">
        <strong>Filtered Text:</strong>
        <p><?php echo htmlspecialchars($filteredText); ?></p>
      </div>
    <?php endif; ?>

    <a href="index.php" class="home-link">&#8592; Back to Home</a>
  </div>
</body>
</html>
