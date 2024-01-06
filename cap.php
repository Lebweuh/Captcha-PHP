<?php
session_start();

// Generate random captcha text (you can change character count. currently it is 7)
$captchaText = substr(md5(mt_rand()), 0, 7);

// Store captcha text in session
$_SESSION['captcha'] = $captchaText;

// Create image (you can set resolution here)
$captchaImage = imagecreatetruecolor(170, 50);

// Colors
$bgColor = imagecolorallocate($captchaImage, 255, 255, 255);
$textColor = imagecolorallocate($captchaImage, 0, 0, 0);

// Fill background with noise
imagefilledrectangle($captchaImage, 0, 0, 170, 50, $bgColor);
for ($i = 0; $i < 600; $i++) {
    imagesetpixel($captchaImage, mt_rand(0, 170), mt_rand(0, 50), $textColor);
}

// Add text to image with distortion
$textSize = 20;

//Use custom font for captcha to make it more complicated (and still readable by humans).
$font = 'font.otf';

//Some php magic happens here to create the image
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
