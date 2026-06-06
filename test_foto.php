<?php
$db = new PDO('sqlite:' . __DIR__ . '/database/database.sqlite');
echo "=== TABLES ===\n";
$t = $db->query("SELECT name FROM sqlite_master WHERE type='table' ORDER BY name");
foreach ($t as $r) echo $r['name'] . "\n";

echo "\n=== LAPORANS ===\n";
$s = $db->query('SELECT id, user_id, foto FROM laporans');
foreach ($s as $r) {
    $path = __DIR__ . '/public/' . $r['foto'];
    echo "id={$r['id']} foto={$r['foto']}\n";
    echo "  file_exists=" . (file_exists($path) ? 'YES' : 'NO') . "\n";
}

echo "\n=== PRESENSIS ===\n";
$s2 = $db->query('SELECT id, user_id, foto FROM presensis');
foreach ($s2 as $r) {
    $path = __DIR__ . '/public/' . $r['foto'];
    echo "id={$r['id']} foto={$r['foto']}\n";
    echo "  file_exists=" . (file_exists($path) ? 'YES' : 'NO') . "\n";
}
