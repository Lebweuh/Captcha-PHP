<?php
session_start();

// Variables For CAPTCHA Generation
$noiseLevel = 600; // Number Of Noise Pixels
$imageWidth = 170; // Width Of The Captcha Image
$imageHeight = 50; // Height Of the Captcha Image
$textSize = 20; // Size Of The Captcha Text
$charCount = 7; // Number Of Characters In Captcha
$fonts = ['noise.otf', 'noise.otf', 'noise.otf']; // Array Of Font Files, Multiple Or One Font File (path)
$distortionLevel = 10; // Level Of Distortion
$drawLines = true; // Option To Draw Lines And Curves (true or false)
$colorChangingBackground = true; // Option To Have A Color-Changing Background (true or false)
$randomTextColor = true; // Option For Random Text Color (true or false)
$useMathQuestion = true; // Option To Use Math Question (true or false)
$mathMin = 1; // Minimum Value For Math Question
$mathMax = 9; // Maximum Value For Math Question

// Function To Generate A Math Question
function generateMathQuestion($mathMin, $mathMax){
    $operators = ['+', '-', 'x']; // Add More Operator If Needed
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
        // Add More Cases For Other Operators If Needed
    }

    $question = "$operand1 $operator $operand2";
    return ['question' => $question, 'answer' => $answer];
}

// Generate Either A Text Captcha Or A Math Question Captcha
if ($useMathQuestion) {
    $mathQuestion = generateMathQuestion($mathMin, $mathMax);
    $captchaText = $mathQuestion['question']; // Set The Math Question As Captcha Text
    $_SESSION['captcha'] = $mathQuestion['answer']; // Set The Answer In Session
} else {
    // Generate Random Captcha Text
    $captchaText = substr(md5(mt_rand()), 0, $charCount);
    // Set Captcha Text In Session
    $_SESSION['captcha'] = $captchaText;
}

// Create Image
$captchaImage = imagecreatetruecolor($imageWidth, $imageHeight);


// Generate Random Background Color If Enabled
if ($colorChangingBackground) {
    $bgColor = imagecolorallocate($captchaImage, mt_rand(0, 255), mt_rand(0, 255), mt_rand(0, 255));
    imagefilledrectangle($captchaImage, 0, 0, $imageWidth, $imageHeight, $bgColor);
} else {
    // Use A Fixed Background Color If Disabled
    $bgColor = imagecolorallocate($captchaImage, 255, 255, 255); // You can change this color as needed
    imagefilledrectangle($captchaImage, 0, 0, $imageWidth, $imageHeight, $bgColor);
}

// Colors
$textColor = imagecolorallocate($captchaImage, 0, 0, 0);

// Fill Background With Noise
for ($i = 0; $i < $noiseLevel; $i++) {
    imagesetpixel($captchaImage, mt_rand(0, $imageWidth), mt_rand(0, $imageHeight), $textColor);
}

// DistortAnd Write Text
for ($i = 0; $i < strlen($captchaText); $i++) {
    $x = ($imageWidth / $charCount) * $i + 10;
    $y = mt_rand($imageHeight - 10, $imageHeight - 5);
    $angle = mt_rand(-$distortionLevel, $distortionLevel);
    $char = $captchaText[$i];
    $fontFile = $fonts[array_rand($fonts)];

    $fontSize = $textSize + rand(-3, 3); // Vary Font Size Slightly
    if ($randomTextColor) {
        $charColor = imagecolorallocate($captchaImage, mt_rand(0, 150), mt_rand(0, 150), mt_rand(0, 150)); // Randomize character color
    } else {
        $charColor = $textColor; // Use Single Color For Text
    }
    imagettftext($captchaImage, $fontSize, $angle, $x, $y, $charColor, $fontFile, $char);
}

// Draw Lines And Curves If Enabled
if ($drawLines) {
    for ($i = 0; $i < 3; $i++) {
        $lineColor = imagecolorallocate($captchaImage, mt_rand(0, 255), mt_rand(0, 255), mt_rand(0, 255));
        imageline($captchaImage, mt_rand(0, $imageWidth), mt_rand(0, $imageHeight), mt_rand(0, $imageWidth), mt_rand(0, $imageHeight), $lineColor);
        imagearc($captchaImage, mt_rand(0, $imageWidth), mt_rand(0, $imageHeight), mt_rand(0, $imageWidth), mt_rand(0, $imageHeight), mt_rand(0, 360), mt_rand(0, 360), $lineColor);
    }
}

// Set The Content Type
header('Content-type: image/png');

// Output The Image
imagepng($captchaImage);

// Free Up Memory
imagedestroy($captchaImage);
?>
