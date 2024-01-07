<?php
session_start();

// Variables for captcha generation
$noiseLevel = 600; // Number of noise pixels
$imageWidth = 170; // Width of the captcha image
$imageHeight = 50; // Height of the captcha image
$textSize = 20; // Size of the captcha text
$charCount = 7; // Number of characters in captcha
$fonts = ['noise.otf', 'noise.otf', 'noise.otf']; // Array of Font Files
$distortionLevel = 10; // Level of distortion
$drawLines = true; // Option to draw lines and curves (true or false)
$colorChangingBackground = true; // Option to have a color-changing background (true or false)
$randomTextColor = true; // Option for random text color (true or false)
$useMathQuestion = true; // Option to use math question (true or false)
$mathMax = 10; // Maximum Value For Math Question
$mathMin  = 1; //Minimum Value For Math Question

// Function to generate a math question
function generateMathQuestion(){
    $operators = ['+', 'x']; // Add more operators if needed
    $operator = $operators[array_rand($operators)];
    $operand1 = mt_rand($mathMin, $mathMax);
    $operand2 = mt_rand($mathMin, $mathMax);
    
    switch ($operator) {
        case '+':
            $answer = $operand1 + $operand2;
            break;
        case 'x':
            $answer = $operand1 * $operand2;
            break;
        // Add more cases for other operators if needed
    }

    $question = "$operand1 $operator $operand2";
    return ['question' => $question, 'answer' => $answer];
}

// Generate either a text captcha or a math question captcha
if ($useMathQuestion) {
    $mathQuestion = generateMathQuestion();
    $captchaText = $mathQuestion['question']; // Set the math question as captcha text
    $_SESSION['captcha'] = $mathQuestion['answer']; // Set the answer in session
} else {
    // Generate random captcha text
    $captchaText = substr(md5(mt_rand()), 0, $charCount);
    // Set captcha text in session
    $_SESSION['captcha'] = $captchaText;
}

// Create image
$captchaImage = imagecreatetruecolor($imageWidth, $imageHeight);

// Generate random background color if enabled
if ($colorChangingBackground) {
    $bgColor = imagecolorallocate($captchaImage, mt_rand(0, 255), mt_rand(0, 255), mt_rand(0, 255));
    imagefilledrectangle($captchaImage, 0, 0, $imageWidth, $imageHeight, $bgColor);
} else {
    // Use a fixed background color if disabled
    $bgColor = imagecolorallocate($captchaImage, 255, 255, 255); // You can change this color as needed
    imagefilledrectangle($captchaImage, 0, 0, $imageWidth, $imageHeight, $bgColor);
}

// Colors
$textColor = imagecolorallocate($captchaImage, 0, 0, 0);

// Fill background with noise
for ($i = 0; $i < $noiseLevel; $i++) {
    imagesetpixel($captchaImage, mt_rand(0, $imageWidth), mt_rand(0, $imageHeight), $textColor);
}

// Distort and write text
for ($i = 0; $i < strlen($captchaText); $i++) {
    $x = ($imageWidth / $charCount) * $i + 10;
    $y = mt_rand($imageHeight - 10, $imageHeight - 5);
    $angle = mt_rand(-$distortionLevel, $distortionLevel);
    $char = $captchaText[$i];
    $fontFile = $fonts[array_rand($fonts)];

    $fontSize = $textSize + rand(-3, 3); // Vary font size slightly
    if ($randomTextColor) {
        $charColor = imagecolorallocate($captchaImage, mt_rand(0, 150), mt_rand(0, 150), mt_rand(0, 150)); // Randomize character color
    } else {
        $charColor = $textColor; // Use single color for text
    }
    imagettftext($captchaImage, $fontSize, $angle, $x, $y, $charColor, $fontFile, $char);
}

// Draw lines and curves if enabled
if ($drawLines) {
    for ($i = 0; $i < 3; $i++) {
        $lineColor = imagecolorallocate($captchaImage, mt_rand(0, 255), mt_rand(0, 255), mt_rand(0, 255));
        imageline($captchaImage, mt_rand(0, $imageWidth), mt_rand(0, $imageHeight), mt_rand(0, $imageWidth), mt_rand(0, $imageHeight), $lineColor);
        imagearc($captchaImage, mt_rand(0, $imageWidth), mt_rand(0, $imageHeight), mt_rand(0, $imageWidth), mt_rand(0, $imageHeight), mt_rand(0, 360), mt_rand(0, 360), $lineColor);
    }
}

// Set the content type
header('Content-type: image/png');

// Output the image
imagepng($captchaImage);

// Free up memory
imagedestroy($captchaImage);
?>
