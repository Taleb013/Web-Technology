<!-- File: check_prime.php -->
<?php
// check_prime.php
// Optimized Miller–Rabin Primality Test with User Input and Detailed Steps

function isPrimeMR($n, $k = 5, &$logs = []) {
    $logs[] = "Starting primality test for n = $n with k = $k iterations.";
    if (!is_numeric($n) || $n != (int)$n || $n < 2) {
        $logs[] = "Invalid input: not an integer >= 2.";
        return false;
    }
    $n = (int) $n;
    if ($n <= 3) {
        $logs[] = "n <= 3, trivial prime: return true.";
        return true;
    }
    if ($n % 2 === 0) {
        $logs[] = "Even number >2: composite.";
        return false;
    }

    // Write n - 1 = 2^r * d
    $d = $n - 1;
    $r = 0;
    while ($d % 2 === 0) {
        $d /= 2;
        $r++;
    }
    $logs[] = "Expressed n-1 = 2^$r * $d.";

    // Test rounds with fixed precision k=5
    for ($i = 1; $i <= $k; $i++) {
        $a = rand(2, $n - 2);
        $logs[] = "Iteration $i: random base a = $a.";

        // Compute a^d mod n
        $x = bcpowmod($a, $d, $n);
        $logs[] = "Compute x = a^d mod n = $x.";

        if ($x == 1 || $x == $n - 1) {
            $logs[] = "x == 1 or x == n-1, pass iteration.";
            continue;
        }

        $passed = false;
        for ($j = 1; $j < $r; $j++) {
            $x = bcpowmod($x, 2, $n);
            $logs[] = "  Square x to $x (round $j).";
            if ($x == $n - 1) {
                $logs[] = "  x reached n-1, pass inner loop.";
                $passed = true;
                break;
            }
        }
        if (!$passed) {
            $logs[] = "Composite detected in iteration $i.";
            return false;
        }
    }
    $logs[] = "All iterations passed, n is probably prime.";
    return true;
}

// Handle form submission
$inputNum = '';
$result = '';
$stepLogs = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $inputNum = trim($_POST['number'] ?? '');
    if ($inputNum === '') {
        $result = '🛑 Please enter a number.';
    } elseif (!ctype_digit($inputNum) || $inputNum < 2) {
        $result = '🚫 Invalid input: enter an integer >= 2.';
    } else {
        $isPrime = isPrimeMR($inputNum, 5, $stepLogs);
        $result = $isPrime
            ? "✅ <strong>$inputNum</strong> is <em>probably prime</em>."
            : "❌ <strong>$inputNum</strong> is <em>composite</em>.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Advanced Prime Checker</title>
  <style>
    body { font-family: 'Segoe UI', Tahoma, sans-serif; background: #081c24; color: #e0f7fa; margin: 0; padding: 0; }
    .container { max-width: 600px; margin: 40px auto; background: #0f2830; padding: 30px; border-radius: 12px; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.5); }
    h1 { text-align: center; margin-bottom: 20px; color: #26c6da; }
    form label { display: block; margin-top: 15px; }
    input[type="text"] { width: 100%; padding: 10px; margin-top: 5px; border: none; border-radius: 4px; }
    button { margin-top: 20px; padding: 12px 20px; background: #26a69a; border: none; border-radius: 4px; color: #fff; font-size: 1rem; cursor: pointer; width: 100%; }
    button:hover { background: #00796b; }
    .result { margin-top: 25px; padding: 15px; background: #1b3a41; border-left: 4px solid #26c6da; }
    .logs { margin-top: 20px; max-height: 300px; overflow-y: auto; background: #112a31; padding: 10px; border-radius: 4px; font-size: 0.9rem; line-height: 1.4; }
    .logs pre { margin: 0; white-space: pre-wrap; color: #b2ebf2; }
    .home-link { display: block; text-align: center; margin-top: 30px; color: #26c6da; text-decoration: none; font-weight: bold; }
    .home-link:hover { color: #81d4fa; }
  </style>
</head>
<body>
  <div class="container">
    <h1>Advanced Prime Number Checker</h1>
    <form method="post" action="">
      <label for="number">Enter an integer ≥ 2:</label>
      <input type="text" id="number" name="number" value="<?php echo htmlspecialchars($inputNum); ?>" required>
      <button type="submit">Run Test</button>
    </form>

    <?php if ($result): ?>
      <div class="result">
        <?php echo $result; ?>
      </div>
    <?php endif; ?>

    <?php if (!empty($stepLogs)): ?>
      <div class="logs">
        <pre><?php echo implode("\n", array_map('htmlspecialchars', $stepLogs)); ?></pre>
      </div>
    <?php endif; ?>

    <a class="home-link" href="index.php">&#8592; Back to Home</a>
  </div>
</body>
</html>
