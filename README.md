
# Captcha PHP
Very easy to use captcha system for people who dont want to use third party apps for captcha like me.

## Features

- Noise Generation
- Text Relocating (rotation, position)
- Custom Fonts
- Everything Is Customizable

## **REQUIREMENTS**
Actually There Are Just Only Two Requirements You Just Need A Font File To Use And Enable GD Library On Your Web Server. Scroll Bottom To See How To Setup GD Server On Various Webservers.


## **SETUP**
Create a php file and paste ```cap.php``` inside of it. Whenever you refresh the page, the captcha image should look like this based on your settings:

Normal Captcha: Hard For Robots To Solve Through OCR
![1](https://raw.githubusercontent.com/Lebweuh/Captcha-PHP/main/example%20images/cap.png)

Plus Noisy: It Is Now Even Harder To Read It So We Decreased The Chance Of OCR Algorithms Detect What It Says
![1](https://raw.githubusercontent.com/Lebweuh/Captcha-PHP/main/example%20images/cap2.png)

Added Security: More Noise Equals More Secure Right? Now Its OCR's Time To Think
![1](https://raw.githubusercontent.com/Lebweuh/Captcha-PHP/main/example%20images/cap3.png)

Not Secure Enough: I Can Still See What It Says
![1](https://raw.githubusercontent.com/Lebweuh/Captcha-PHP/main/example%20images/cap4.png)

Pure Perfection: If No One Can Read The Image It Is Secure
![1](https://raw.githubusercontent.com/Lebweuh/Captcha-PHP/main/example%20images/cap5.png)

## **CODE EXAMPLE**
```php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $captchaAnswer = $_SESSION['captcha'];
    $captchaInput = $conn->real_escape_string($_POST['captcha']);
    if ($rcap != $cap) {
        // Failed Captcha
    } else {
        // Correct Caprcha
}

<script>
    function reloadCaptcha() {
      var captchaImage = document.getElementById('captcha-img');
      captchaImage.src = 'cap.php?' + new Date().getTime();
    }
</script>

<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
<img type="cap" id="captcha-img" src="captcha.php" alt="Captcha Image">
<input type="captcha" name="captcha" placeholder="Code" maxlength="20" required>
<button type="button" onclick="reloadCaptcha()">Change CAPTCHA Code</button>
</form>

```
This is just an example adjust the code for your needs.

Notes To User:
- Always Rate-Limit The Client To Prevent Abuse
- Never Trust The Client For Obvious Reasons
- Do Not Forget To Sanitize Inputs Before Processing

## **USAGE**
You Dont Need To Change Anything Actually The Code Is Self-Explaining Im Just Filling README.md

### Set character count

```php
$charCount = 7;
```

### Get yourself a font for captcha
get yourself some nice font to use in your captcha. you can remove it from code but extra security wont hurt
```php
$font = 'noise.otf';
```

### Set the noise amount

```php
$noiseLevel = 600;
```

### Set Resolution
```php
$imageWidth = 170; // Width of the captcha image
$imageHeight = 50; // Height of the captcha image
```

### Set Text Size
```php
$textSize = 20; // Size of the captcha text
```

## **GD Server Setup For Various Webservers**
Always ensure to check your PHP version and adjust the commands accordingly. The paths and commands might differ based on your system's configuration and version.

#### *Apache Server on Windows (XAMPP):*
Open `php.ini` file in the PHP folder (xampp\php\php.ini) and uncomment (remove the semicolon ; at the beginning) the line `;extension=gd` by editing it to `extension=gd`.

Save the changes to `php.ini` and restart the Apache server through the XAMPP Control Panel.

.

#### *Apache Server on Linux (Ubuntu/Debian/CentOS/RHEL):*
Run the following command in your terminal to install the GD library for PHP: 
```http
sudo apt-get install php-gd # For Ubuntu/Debian
sudo yum install php-gd # For CentOS/RHEL
```
After installing the GD library, restart your Apache server for changes to take effect:
```http
sudo service apache2 restart # For Ubuntu/Debian
sudo systemctl restart httpd # For CentOS/RHEL
```
`


#### *Nginx Web Server (Ubuntu/Debian/CentOS/RHEL):*
Use the package manager to install the GD library:
```http
sudo apt-get install php-gd # Ubuntu/Debian
sudo yum install php-gd # CentOS/RHEL
```
 After installation, restart the Nginx server:
```http
sudo systemctl restart nginx # Ubuntu/Debian
sudo systemctl restart php-fpm # CentOS/RHEL
```

 [![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg)](https://opensource.org/licenses/MIT)

