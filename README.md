- [Readme English](https://github.com/Lebweuh/Captcha-PHP/blob/main/README.md)<br> </br>
- [Readme Türkçe](https://github.com/Lebweuh/Captcha-PHP/blob/main/README.tr.md)<br></br>

# Captcha PHP
Very easy to use advanced captcha system for people who dont want to use third party apps for captcha like me.

## Features

- Noise Generation
- Disortion Generation
- Text Relocating (rotation, position)
- Custom Fonts
- Multiple Font Support
- Optional Math Question
- Optional Color Changing Background And Text
- Oprional Draw Lines
- Everything Is Customizable

## Sections
1. [Setup](#setup) <br />
2. [Code Example](#code-example) <br />
3. [Customization](#customization) <br />
4. [GD Server Setup For Various Webservers](#gd-server-setup-for-various-webservers) <br />
    - [Apache Server on Windows (XAMPP)](#apache-server-on-windows-xampp) <br />
    - [Apache Server on Linux (Ubuntu/Debian/CentOS/RHEL)](#apache-server-on-linux-ubuntudebiancentosrhel) <br />
    - [Nginx Web Server (Ubuntu/Debian/CentOS/RHEL)](#nginx-web-server-ubuntudebiancentosrhel) <br />
<br />

## **REQUIREMENTS**
Actually There Are Just Only Two Requirements You Just Need One Or Multiple Font File To Use And Enable GD Library On Your Web Server. Scroll Bottom To See How To Setup [GD Server On Various Webservers.](#gd-server-setup-for-various-webservers) 
<br />


## **SETUP**
Create a php file and paste ```cap.php``` inside of it. Whenever you refresh the page, the captcha image should look like this based on your settings:

Normal Captcha: Hard For Robots To Solve Through OCR<br />
![1](https://raw.githubusercontent.com/Lebweuh/Captcha-PHP/main/example%20images/cap.png)

Plus Noisy: It Is Now Even Harder To Read It So We Decreased The Chance Of OCR Algorithms Detect What It Says<br />
![1](https://raw.githubusercontent.com/Lebweuh/Captcha-PHP/main/example%20images/cap2.png)

Added Security: More Noise Equals More Secure Right? Now Its OCR's Time To Think<br />
![1](https://raw.githubusercontent.com/Lebweuh/Captcha-PHP/main/example%20images/cap3.png)

Not Secure Enough: I Can Still See What It Says<br />
![1](https://raw.githubusercontent.com/Lebweuh/Captcha-PHP/main/example%20images/cap4.png)

Pure Perfection: If No One Can Read The Image It Is Secure<br />
![1](https://raw.githubusercontent.com/Lebweuh/Captcha-PHP/main/example%20images/cap5.png) <br /> <br /><br />

Disortion + Noise + Lines + Random Text And Background Colors<br />
![1](https://raw.githubusercontent.com/Lebweuh/Captcha-PHP/main/example%20images/cap6.png) <br />

Disortion + Noise + Lines + Random Text + Background Colors And MATH (the resolution can be changed)<br />
![1](https://raw.githubusercontent.com/Lebweuh/Captcha-PHP/main/example%20images/cap7.png) <br />

## **CODE EXAMPLE**
The Answer For Captcha Is Stored As Session Variable Named "captcha"
```php
<?php
<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $captchaAnswer = $_SESSION['captcha'];
    $captchaInput = $_POST['captcha'];
    if ($captchaAnswer == $captchaInput) {
        echo "CORRECT CAPTCHA";
    } else {
        echo "WRONG CAPTCHA";
}
}
?>


<script>
    function reloadCaptcha() {
      var captchaImage = document.getElementById('captcha-img');
      captchaImage.src = 'cap.php?' + new Date().getTime();
    }
</script>

<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
<img type="cap" id="captcha-img" src="cap.php" alt="Captcha Image">
<input type="captcha" name="captcha" placeholder="Code" maxlength="20" required>
<button type="button" onclick="reloadCaptcha()">Change CAPTCHA Code</button>
</form>
```
This is just an example adjust the code for your needs.

Notes To User:
- Always Rate-Limit The Client To Prevent Abuse Or Bruteforce
- Never Trust The Client Input For Obvious Reasons
- Do Not Forget To Sanitize Inputs Before Processing <br />

## **CUSTOMIZATION**
You Can Custoomiza Whatever You Want Based On Your Needs. Code Is Self-Explaining Though But Just Filling The README.md You Know.

### Set character count

```php
$charCount = 7;
```

### Get yourself a font for captcha
get yourself font files to use in your image generation. you can use only one but multiple fonts supported.
```php
$fonts = ['noise.otf', 'noise.otf', 'noise.otf'];
```

### Set the noise amount

```php
$noiseLevel = 600;
```

### Set Resolution
```php
$imageWidth = 170;
$imageHeight = 50;
```

### Set Text Size
```php
$textSize = 20;
```


### Set Disortion
```php
$distortionLevel = 10;
```


### Optionally Add Randomness To Image
```php
$drawLines = true;
$colorChangingBackground = true;
$randomTextColor = true;
```


### Optionally Enable Math Questions For Harder Captchas
```php
$useMathQuestion = true;
$mathMax = 10; // Maximum Value For Math Question
$mathMin  = 1; //Minimum Value For Math Question
```
<br />

## **GD Server Setup For Various Webservers**
Always ensure to check your PHP version and adjust the commands accordingly. The paths and commands might differ based on your system's configuration and version.

#### *Apache Server on Windows (XAMPP):*
Open `php.ini` file in the PHP folder (xampp\php\php.ini) and uncomment (remove the semicolon ; at the beginning) the line `;extension=gd` by editing it to `extension=gd`.

Save the changes to `php.ini` and restart the Apache server through the XAMPP Control Panel.

<br />

#### *Apache Server on Linux (Ubuntu/Debian/CentOS/RHEL):*
Run the following command in your terminal to install the GD library for PHP: 
```
sudo apt-get install php-gd # For Ubuntu/Debian
sudo yum install php-gd # For CentOS/RHEL
```
After installing the GD library, restart your Apache server for changes to take effect:
```
sudo service apache2 restart # For Ubuntu/Debian
sudo systemctl restart httpd # For CentOS/RHEL
```
<br />


#### *Nginx Web Server (Ubuntu/Debian/CentOS/RHEL):*
Use the package manager to install the GD library:
```
sudo apt-get install php-gd # Ubuntu/Debian
sudo yum install php-gd # CentOS/RHEL
```
 After installation, restart the Nginx server:
```
sudo systemctl restart nginx # Ubuntu/Debian
sudo systemctl restart php-fpm # CentOS/RHEL
```

<br />
<br />
<br />


 [![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg)](https://opensource.org/licenses/MIT)

