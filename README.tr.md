![TR](https://img.shields.io/badge/README-T%C3%BCrk%C3%A7e-blue?link=https%3A%2F%2Fgithub.com%2FLebweuh%2FCaptcha-PHP%2Fblob%2Fmain%2FREADME.tr.md)
![EN](https://img.shields.io/badge/README-English-blue?link=https%3A%2F%2Fgithub.com%2FLebweuh%2FCaptcha-PHP%2Fblob%2Fmain%2FREADME.md)


# Captcha PHP
Benim gibi üçüncü taraf uygulamalar kullanmak istemeyen insanlar için kullanımı çok kolay gelişmiş bir captcha sistemidir.

## Özellikler

- Noise Oluşturma
- Disortion Oluşturma
- Metin Yer Değiştirme (döndürme, konum)
- Özel Fontlar
- Birden Fazla Font Desteği
- İsteğe Bağlı Matematik Sorusu
- İsteğe Bağlı Renk Değişen Arka Plan ve Metin
- İsteğe Bağlı Çizgiler Çizme
- Her Şey Kişiselleştirilebilir

## Bölümler
1. [Kurulum](#kurulum) <br />
2. [Örnek Kod](#örnek-kod) <br />
3. [Kişiselleştirme](#ki̇şi̇selleşti̇rme) <br />
4. [Çeşitli Web Sunucuları için GD Sunucusu Kurulumu](#çeşitli-web-sunucuları-i̇çin-gd-server-kurulumu) <br />
    - [Windows'da Apache Sunucusu (XAMPP)](#windows-i̇çin-apache-sunucusu-xampp) <br />
    - [Linux'ta Apache Sunucusu (Ubuntu/Debian/CentOS/RHEL)](#linux-i̇çin-apache-sunucusu-ubuntudebiancentosrhel) <br />
    - [Nginx Web Sunucusu (Ubuntu/Debian/CentOS/RHEL)](#nginx-web-sunucusu-ubuntudebiancentosrhel) <br />
<br />

## **GEREKSİNİMLER**
Aslında sadece iki gereksinim var, kullanım için bir veya birden fazla font dosyası ve Web Sunucunuzda GD Kütüphanesini etkinleştirmeniz gerekiyor. [Çeşitli Web Sunucuları için GD Sunucusu Kurulumu](#çeşitli-web-sunucuları-için-gd-sunucusu-kurulumu) nasıl yapılacağını görmek için aşağıya kaydırın. 
<br />


## **KURULUM**
Bir PHP dosyası oluşturun ve içine `cap.php` dosyasının içinde bulunan captcha kodunu yapıştırın. Sayfayı yenilediğinizde, ayarlarınıza göre captcha resmi aşağıdaki gibi görünmelidir:

Normal Captcha: OCR için zor<br />
![1](https://raw.githubusercontent.com/Lebweuh/Captcha-PHP/main/example%20images/cap.png)

Artı Noise: Şimdi Okumak Daha Zor, OCR Algoritmalarının Ne Söylediğini Algılama Şansını Azalttık<br />
![1](https://raw.githubusercontent.com/Lebweuh/Captcha-PHP/main/example%20images/cap2.png)

Daha Fazla Güvenlik: Daha Fazla Noise Daha Güvenli Demek Değil Mi, Şimdi OCR Algoritmaları Bunu Çözsünlerde Görelim<br />
![1](https://raw.githubusercontent.com/Lebweuh/Captcha-PHP/main/example%20images/cap3.png)

Yeterince Güvenli Değil: Hala Ne Olduğunu Görebiliyorum<br />
![1](https://raw.githubusercontent.com/Lebweuh/Captcha-PHP/main/example%20images/cap4.png)

Saf Mükemmellik: En Güvenli Captcha En Zor Captchadır. Kimse Okuyamıyor İse OCR Algoritmaları Da Okuyamaz Sisteminiz Güvenli<br />
![1](https://raw.githubusercontent.com/Lebweuh/Captcha-PHP/main/example%20images/cap5.png) <br /> <br /><br />

Disortion + Noise + Çizgiler + Rastgele Metin ve Arka Plan Renkleri<br />
![1](https://raw.githubusercontent.com/Lebweuh/Captcha-PHP/main/example%20images/cap6.png) <br />

Disortion + Noise + Çizgiler + Rastgele Metin + Arka Plan Renkleri ve MATEMATİK (çözünürlük değiştirilebilir)<br />
![1](https://raw.githubusercontent.com/Lebweuh/Captcha-PHP/main/example%20images/cap7.png) <br />

## **ÖRNEK KOD**
Captcha'nın cevabı, `$_SESSION['captcha'];` adında bir oturum değişkeninde depolanır.

```php
<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $captchaAnswer = $_SESSION['captcha'];
    $captchaInput = $_POST['captcha'];
    if ($captchaAnswer == $captchaInput) {
        echo "DOĞRU CAPTCHA";
    } else {
        echo "YANLIŞ CAPTCHA";
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
<img type="cap" id="captcha-img" src="cap.php" alt="Captcha Görseli">
<input type="captcha" name="captcha" placeholder="Kod" maxlength="20" required>
<button type="button" onclick="reloadCaptcha()">CAPTCHA Kodunu Değiştir</button>
</form>
```

Bu sadece bir örnektir, kodu ihtiyaçlarınıza göre ayarlayın.

Kullanıcıya Notlar:
- Abuse veya bruteforce saldırılarını önlemek için her zaman kullanıcıyı rate limit sınırlamasına tabi tutun.
- Açıkça görülebilen nedenlerden dolayı istemci girdilerine güvenmeyin.
- Kullanıcıdan gelen verileri her zaman gözden geçirin ve önlem alın


## KİŞİSELLEŞTİRME

İhtiyaçlarınıza göre istediğiniz her şeyi özelleştirebilirsiniz. Kod kendini açıklıyor ancak README.md'yi doldurmaya çalışıyoruz işte.

### Karakter sayısı belirleyin

```php
$charCount = 7;
```

### Captcha için kendinize bir veya birden fazla font edinin
Resim oluşumunda kullanabilmek için bir veya birden fazla font dosyası edinin. Bir tane de kullanabilirsiniz fakat ekstra güvenlik can yakmaz.
```php
$fonts = ['noise.otf', 'noise.otf', 'noise.otf'];
```

### Noise miktarını belirleyin

```php
$noiseLevel = 600;
```

### Çözünürlüğü belirleyin
```php
$imageWidth = 170;
$imageHeight = 50;
```

### Yazı boyutunu belirleyin
```php
$textSize = 20;
```


### Disortion miktarını belirleyin
```php
$distortionLevel = 10;
```


### İsteğe bağlı çizgi ve renk katarak rastgelelik sağlayın
```php
$drawLines = true;
$colorChangingBackground = true;
$randomTextColor = true;
```


### İsteğe bağlı daha zor captchalar için matematik problemlerine çevirin
```php
$useMathQuestion = true;
$mathMax = 10; // Maximum Value For Math Question
$mathMin  = 1; //Minimum Value For Math Question
```
<br />



## **Çeşitli Web Sunucuları İçin GD Server Kurulumu**
Her zaman PHP sürümünüzü kontrol edin ve komutları buna göre ayarlayın. Yollar ve komutlar, sistem yapılandırmanıza ve sürümünüze bağlı olarak değişebilir.

#### *Windows İçin Apache Sunucusu (XAMPP):*
PHP klasöründe (xampp\php\php.ini) `php.ini` dosyasını açın ve `;extension=gd` satırındaki baştaki noktalı virgülü (;) kaldırarak `extension=gd` şeklinde düzenleyin.

Değişiklikleri `php.ini` dosyasına kaydedin ve XAMPP Kontrol Paneli aracılığıyla Apache sunucusunu yeniden başlatın.

<br />

#### *Linux İçin Apache Sunucusu (Ubuntu/Debian/CentOS/RHEL):*
Terminalinizde GD kütüphanesini PHP için yüklemek için aşağıdaki komutu çalıştırın:
```
sudo apt-get install php-gd # Ubuntu/Debian
sudo yum install php-gd # CentOS/RHEL
```
GD kütüphanesini yükledikten sonra değişikliklerin etkili olması için Apache sunucunuzu yeniden başlatın:
```
sudo service apache2 restart # Ubuntu/Debian
sudo systemctl restart httpd # CentOS/RHEL
```
<br />


#### *Nginx Web Sunucusu (Ubuntu/Debian/CentOS/RHEL):*
Paket yöneticisini kullanarak GD kütüphanesini kurun:
```
sudo apt-get install php-gd # Ubuntu/Debian
sudo yum install php-gd # CentOS/RHEL
```
Kurulumu tamamladıktan sonra Nginx sunucusunu yeniden başlatın:
```
sudo systemctl restart nginx # Ubuntu/Debian
sudo systemctl restart php-fpm # CentOS/RHEL
```

<br />
<br />
<br />


 [![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg)](https://opensource.org/licenses/MIT)
