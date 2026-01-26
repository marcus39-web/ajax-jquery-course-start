<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

/**
 * TN-Kursindex
 * Trainer-Modus ist standardmäßig AUS.
 * Er wird nur aktiviert, wenn lokale Trainer-Dateien existieren.
 */

$isTrainerMode = false;

$trainerDir  = __DIR__ . '/_trainer';
$secretFile  = $trainerDir . '/trainer-secret.php';
$trainerView = $trainerDir . '/trainer-view.html';

if (is_dir($trainerDir) && is_file($secretFile) && is_file($trainerView)) {
  $secret = require $secretFile;

  $enabled = is_array($secret) && !empty($secret['enabled']);
  $codeRequired = is_array($secret) && array_key_exists('code', $secret) && $secret['code'] !== '';

  if ($enabled) {
    if ($codeRequired) {
      $code = $_GET['code'] ?? '';
      if (hash_equals((string) $secret['code'], (string) $code)) {
        $isTrainerMode = true;
      }
    } else {
      $isTrainerMode = true;
    }
  }
}

?>
<!doctype html>
<html lang="de">

<head>
  <meta charset="utf-8">
  <title>AJAX & jQuery – Kursübersicht</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/style.css">
</head>

<body>

  <header class="container">
    <h1>AJAX & jQuery – Kursübersicht</h1>
    <p class="subtitle"><?= $isTrainerMode ? 'Traineransicht (lokal)' : 'Teilnehmenden-Ansicht' ?></p>
  </header>

  <main class="container">

    <?php if ($isTrainerMode): ?>

      <!-- TRAINER-INHALT (nur lokal) -->
      <?php include $trainerView; ?>

    <?php endif; ?>

    <!-- TN-AUTO-INDEX -->
    <?php
    function listDirs(string $path): array
    {
      return array_values(array_filter(scandir($path), function ($item) use ($path) {
        return $item[0] !== '.' && is_dir($path . '/' . $item) && $item !== '_trainer';
      }));
    }

    function listHtml(string $path): array
    {
      return array_values(array_filter(scandir($path), function ($item) use ($path) {
        return is_file($path . '/' . $item) && (str_ends_with($item, '.html') || str_ends_with($item, '.php'));
      }));
    }

    $days = listDirs(__DIR__);
    sort($days);

    foreach ($days as $day):
      if (!preg_match('/^kap\d+$/', $day)) continue;
    ?>
      <section class="day">
        <h2><?= htmlspecialchars(strtoupper($day)) ?></h2>
        <ul>
          <?php
          $subs = listDirs(__DIR__ . '/' . $day);
          sort($subs);
          foreach ($subs as $sub):
            $files = listHtml(__DIR__ . '/' . $day . '/' . $sub);
            foreach ($files as $file):
          ?>
              <li>
                <a href="<?= htmlspecialchars("$day/$sub/$file") ?>">
                  <?= htmlspecialchars("$sub / $file") ?>
                </a>
              </li>
          <?php endforeach;
          endforeach; ?>
        </ul>
      </section>
    <?php endforeach; ?>

  </main>

  <footer class="container footer">
    <p>Kursmaterial – AJAX & jQuery</p>
  </footer>

</body>

</html>