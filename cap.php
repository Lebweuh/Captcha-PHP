<?php
session_start();

// Variables for captcha generation
$noiseLevel = 600; // Number of noise pixels
$imageWidth = 170; // Width of the captcha image
$imageHeight = 50; // Height of the captcha image
$textSize = 20; // Size of the captcha text
$charCount = 7; // Number of characters in captcha
$font = 'noise.otf'; // Path To The Font File

// Generate random captcha text
$captchaText = substr(md5(mt_rand()), 0, $charCount);

// Set captcha text in session
$_SESSION['captcha'] = $captchaText;

// Create image
$captchaImage = imagecreatetruecolor($imageWidth, $imageHeight);

// Colors
$bgColor = imagecolorallocate($captchaImage, 255, 255, 255);
$textColor = imagecolorallocate($captchaImage, 0, 0, 0);

// Fill background with noise
imagefilledrectangle($captchaImage, 0, 0, $imageWidth, $imageHeight, $bgColor);
for ($i = 0; $i < $noiseLevel; $i++) {
    imagesetpixel($captchaImage, mt_rand(0, $imageWidth), mt_rand(0, $imageHeight), $textColor);
}



for ($i = 0; $i < strlen($captchaText); $i++) {
    $x = 20 * $i + 10;
    $y = mt_rand(30, 35);
    $angle = mt_rand(-30, 30);
    $char = $captchaText[$i];
    imagettftext($captchaImage, $textSize, $angle, $x, $y, $textColor, $font, $char);
}

// Set the content type
header('Content-type: image/png');

// Output the image
imagepng($captchaImage);

// Free up memory
imagedestroy($captchaImage);
?>
