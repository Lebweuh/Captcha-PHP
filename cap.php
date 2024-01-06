<?php
// session_start();

// // Generate random captcha text
// $captchaText = substr(md5(mt_rand()), 0,7);

// // Set captcha text in session
// $_SESSION['captcha'] = $captchaText;

// // Create image
// $captchaImage = imagecreatetruecolor(170, 50);

// // Colors
// $bgColor = imagecolorallocate($captchaImage, 255, 255, 255);
// $textColor = imagecolorallocate($captchaImage, 0, 0, 0);

// // Fill background
// imagefilledrectangle($captchaImage, 0, 0, 270, 50, $bgColor);

// // Add text to image
// imagettftext($captchaImage, 20, 0, 10, 35, $textColor, 'noise.otf', $captchaText);

// // Set the content type
// header('Content-type: image/png');

// // Output the image
// imagepng($captchaImage);

// // Free up memory
// imagedestroy($captchaImage);





session_start();

// Generate random captcha text
$captchaText = substr(md5(mt_rand()), 0, 7);

// Set captcha text in session
$_SESSION['captcha'] = $captchaText;

// Create image
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
$font = 'noise.otf';

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
