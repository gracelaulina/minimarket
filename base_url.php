<?php
$host = $_SERVER['HTTP_HOST'];
$protocol = isset($_SERVER['HTTPS']) ? "https" : "http";

// Cek apakah dia dari XAMPP (localhost)
if ($host === "localhost") {
    $base_url = $protocol . "://" . $host . "/minimarket/";
} else {
    // Diasumsikan Laragon atau hosting lain
    $base_url = $protocol . "://" . $host . "/";
}
