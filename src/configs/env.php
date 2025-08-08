<?php function loadEnv($file = '.env')
{
  if (!file_exists($file)) {
    return;
  }

  $lines = file($file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
  foreach ($lines as $line) {
    if (strpos($line, '=') !== false && strpos($line, '#') !== 0) {
      [$key, $value] = explode('=', $line, 2);
      if (
        ($value[0] === '"' && $value[-1] === '"') ||
        ($value[0] === "'" && $value[-1] === "'")
      ) {
        $value = substr($value, 1, -1);
      }
      $_ENV[trim($key)] = trim($value);
    }
  }
}
