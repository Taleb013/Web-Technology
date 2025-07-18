<!-- File: merge_arrays.php -->
<?php
// merge_arrays.php
// Merge two arrays of exactly three integers provided by the user via HTML form

$array1 = '';
$array2 = '';
$merged = [];
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $array1 = trim($_POST['array1'] ?? '');
    $array2 = trim($_POST['array2'] ?? '');

    // Convert comma-separated strings to arrays
    $arr1 = array_filter(array_map('trim', explode(',', $array1)), 'strlen');
    $arr2 = array_filter(array_map('trim', explode(',', $array2)), 'strlen');

    // Validation: exactly 3 elements each and integers
    if (count($arr1) !== 3 || count($arr2) !== 3) {
        $error = '🛑 Please enter exactly three values for each array.';
    } elseif (!array_reduce($arr1, fn($c, $v) => $c && ctype_digit($v), true)
           || !array_reduce($arr2, fn($c, $v) => $c && ctype_digit($v), true)) {
        $error = '🚫 All values must be non-negative integers.';
    } else {
        // Merge arrays
        $merged = array_merge($arr1, $arr2);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Merge Two Arrays</title>
  <style>
    * { margin:0; padding:0; box-sizing:border-box; }
    body {
      font-family: 'Segoe UI', Tahoma, sans-serif;
      background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
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
      width: 90%;
      max-width: 500px;
      text-align: center;
    }
    h1 {
      margin-bottom: 20px;
      color: #c2185b;
      font-size: 2rem;
    }
    label { display: block; margin-top: 15px; text-align: left; }
    input[type="text"] {
      width: 100%;
      padding: 10px;
      margin-top: 5px;
      border: 1px solid #ccc;
      border-radius: 6px;
      font-size: 1rem;
    }
    button {
      margin-top: 25px;
      padding: 12px;
      background: #c2185b;
      color: #fff;
      border: none;
      border-radius: 6px;
      cursor: pointer;
      width: 100%;
      font-size: 1rem;
    }
    button:hover { background: #8e1354; }
    .output, .error {
      margin-top: 20px;
      padding: 15px;
      border-radius: 6px;
      font-size: 1rem;
      text-align: left;
      word-wrap: break-word;
    }
    .output { background: #e8f5e9; color: #2e7d32; }
    .error { background: #ffebee; color: #c62828; }
    .home-link {
      display: block;
      margin-top: 30px;
      color: #c2185b;
      text-decoration: none;
      font-weight: bold;
    }
    .home-link:hover { color: #8e1354; }
  </style>
</head>
<body>
  <div class="container">
    <h1>Merge Two Integer Arrays</h1>
    <form method="post" action="">
      <label for="array1">Array 1 (comma-separated, 3 integers):</label>
      <input type="text" id="array1" name="array1" placeholder="e.g. 10, 20, 30" value="<?php echo htmlspecialchars($array1); ?>" required>

      <label for="array2">Array 2 (comma-separated, 3 integers):</label>
      <input type="text" id="array2" name="array2" placeholder="e.g. 40, 50, 60" value="<?php echo htmlspecialchars($array2); ?>" required>

      <button type="submit">Merge Arrays</button>
    </form>

    <?php if ($error): ?>
      <div class="error"><?php echo $error; ?></div>
    <?php elseif ($merged): ?>
      <div class="output">
        <strong>Merged Result:</strong> <?php echo implode(', ', $merged); ?>
      </div>
    <?php endif; ?>

    <a href="index.php" class="home-link">&#8592; Back to Home</a>
  </div>
</body>
</html>
