<?php
session_start();
include "db_connection.php";

// Bağlantıyı kontrol et
if ($conn->connect_error) {
    die("Veritabanı bağlantısında hata: " . $conn->connect_error);
}

// vCard indirme işlemi
if (isset($_GET['download_vcard']) && isset($_GET['id'])) {
    $id = $_GET['id'];

    // Veritabanından veriyi al
    $sql = "SELECT * FROM kartvizit WHERE id = $id";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $name = $row['name'];
        $title = $row['title'];
        $phone = $row['phone'];
        $email = $row['email'];
        $web = $row['web'];

        // vCard içeriği oluştur
        $vcard = "BEGIN:VCARD\n";
        $vcard .= "VERSION:3.0\n";
        $vcard .= "FN:" . $name . "\n";
        $vcard .= "TITLE:" . $title . "\n";
        $vcard .= "TEL;TYPE=CELL:" . $phone . "\n";
        $vcard .= "EMAIL;TYPE=INTERNET:" . $email . "\n";
        $vcard .= "URL:" . $web . "\n";
        $vcard .= "END:VCARD";

        // vCard dosyasını indir
        header('Content-Type: text/vcard');
        header('Content-Disposition: attachment; filename="' . $name . '.vcf"');
        echo $vcard;
        exit();
    } else {
        echo "Profil bulunamadı.";
        exit();
    }
}

// Sayfa URL'sini dinamik olarak almak
$page_url = "https://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

// URL'den gelen id'yi al
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Veritabanından veriyi al
    $sql = "SELECT * FROM kartvizit WHERE id = $id";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        // ID bulundu, verileri al
        $row = $result->fetch_assoc();
        $name = $row['name'];
        $title = $row['title'];
        $phone = $row['phone'];
        $email = $row['email'];
        $hakkimda = $row['hakkimda'];
        $web = $row['web'];
        $sos_1 = $row['sos_1'];
        $sos_2 = $row['sos_2'];
        $sos_3 = $row['sos_3'];
        $sos_4 = $row['sos_4'];
        $sos_5 = $row['sos_5'];
        $sos_6 = $row['sos_6'];
        $iban_name = $row['iban_name'];
        $iban = $row['iban'];
        $iban2_name = $row['iban2_name'];
        $iban2 = $row['iban2'];
        $iban3_name = $row['iban3_name'];
        $iban3 = $row['iban3'];
        $iname = $row['iname'];
        $isektor = $row['isektor'];
        $itel = $row['itel'];
        $iposta = $row['iposta'];
        $iweb = $row['iweb'];
        $iadress = $row['iadress'];
        $theme_id = $row['theme_id'];
        $profile_image = !empty($row['img_name']) ? $row['img_name'] : 'user.jpg'; // profil resim sütununu ekleyin ve varsayılan resim ayarlayın

        // Tema CSS dosyasını eklemek için
        if (isset($theme_id)) {
            $theme_query = "SELECT css_file FROM themes WHERE id = $theme_id";
            $theme_result = $conn->query($theme_query);
            if ($theme_result->num_rows == 1) {
                $theme_row = $theme_result->fetch_assoc();
                $css_file = $theme_row['css_file'];
                echo "<link rel='stylesheet' type='text/css' href='$css_file'>";
            }
        }

        // "name" veya "title" NULL ise yönlendir
        if (is_null($name) || is_null($title) || is_null($phone) || is_null($email)) {
            header("Location: kurulum.php?id=$id");
            exit();
        } else {
            // HTML içeriği buraya gelecek
?>
            <!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>DijiKart Profil</title>
                <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
                <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
                <link rel="preconnect" href="https://fonts.googleapis.com">
                <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
                <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
            </head>

            <style>
                            .modal {
                                display: none; /* Başlangıçta modal gizli olsun */
                                position: fixed; /* Pencerenin ortasında görünsün */
                                top: 50%;
                                left: 50%;
                                transform: translate(-50%, -50%);
                                background-color:; /* Arkaplanı biraz opak yap */
                                z-index: 999; /* Diğer elemanların üzerine çıksın */
                                padding: 20px;
                                border-radius: 10px;
                                opacity: 0;
                                transition: opacity 0.3s ease;
                            }

                            .modal-content {
                                background-color:#FFFFFF90;
                                border-radius: 10px;
                                padding: 20px;
                                text-align: center;
                            }

                            .close {
                                color: #aaa;
                                float: right;
                                font-size: 28px;
                                font-weight: bold;
                                cursor: pointer;
                            }

                            .close:hover,
                            .close:focus {
                                color: black;
                                text-decoration: none;
                            }

                            .modal.active {
                                display: block;
                                opacity: 1;
                            }

                            #qrButton, #edit {
                                background-color: rgba(0, 0, 0, 0); /* Buton arka planını şeffaf yap */
                                border: 0px solid #000; /* Buton kenarlık rengi */
                                padding: 5px 5px; /* Buton iç boşluğu */
                                cursor: pointer;
                            }

                            #qrButton:hover {
                                background-color: rgba(0, 0, 0, 0.1); /* Butona hover olduğunda arka plan rengini hafifçe değiştir */
                            }

                            #edit:hover{
                                background-color: rgba(0, 0, 0, 0.1); /* Butona hover olduğunda arka plan rengini hafifçe değiştir */
                            }

                            .sirket{
                                width: auto;
                                height: auto;
                                background-color: #32302f;
                                margin-left: 18px;
                                margin-right: 18px;
                                margin-top: -5px;
                                margin-bottom: 20px;
                                border-radius: 10px;
                                padding-bottom: 10px;
                                font-family: 'Poppins', sans-serif;
                            }

                            .modals {
                                display: none;
                                position: fixed;
                                z-index: 1;
                                left: 0;
                                top: 0;
                                width: 100%;
                                height: 100%;
                                background-color: rgba(0, 0, 0, 0.5);
                            }

                            .modals-content {
                                background-color: white;
                                margin: 10% auto;
                                padding: 20px;
                                border-radius: 10px;
                                width: 80%;
                                max-width: 400px;
                                text-align: center;
                                font-family: 'Poppins', sans-serif;
                                box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
                            }

                            .modal-header {
                                display: flex;
                                justify-content: space-between;
                                align-items: center;
                                margin-bottom: 20px;
                            }

                            .modal-header h3 {
                                margin: 0;
                                font-size: 20px;
                                color: #333;
                            }

                            .closes {
                                font-size: 24px;
                                cursor: pointer;
                                color: #aaa;
                            }

                            .share-icons {
                                display: flex;
                                justify-content: space-around;
                                flex-wrap: wrap;
                                gap: 10px;
                            }

                            .share-icons i{
                                margin-bottom: 5px;
                            }

                            .share-icons a {
                                text-decoration: none;
                                font-size: 24px;
                                color: #333;
                                display: flex;
                                flex-direction: column;
                                align-items: center;
                                width: 80px;
                                height: 80px;
                                border-radius: 10px;
                                background-color: #f0f2f5;
                                justify-content: center;
                                transition: background-color 0.3s;
                            }

                            .share-icons a:hover {
                                background-color: #e4e6eb;
                            }

                            .share-icons span {
                                font-size: 12px;
                                color: #555;
                            }

                            .page-link {
                                margin-top: 20px;
                                font-size: 14px;
                                color: #555;
                                display: flex;
                                align-items: center;
                                gap: 10px;
                            }

                            .page-link input {
                                border: 1px solid #ddd;
                                padding: 8px;
                                width: 90%;
                                border-radius: 5px;
                                font-size: 14px;
                            }

                            .copy-btn {
                                cursor: pointer;
                                font-size: 16px;
                                color: #333;
                            }

                            .copy-btn:hover {
                                color: blueviolet;
                            }
            </style>
            </head>
            <body>
                <div class="profile">
                    <div class="icons">
                        <button id="qrButton"><i class="fa-solid fa-qrcode" id="qr"></i></button>
                        <div id="qrModal" class="modal">
                            <div class="modal-content">
                                <span class="close">&times;</span>
                                <div id="qrCode"></div>
                            </div>
                        </div>
                        <a href="kartlarim.php"><i class="fa-solid fa-pen" id="edit"></i></a>
                    </div>

                    <div class="yuvarlak">
                        <img src="Upload/Profil/<?php echo htmlspecialchars($profile_image); ?>" alt="">
                        <div class="baslik">
                            <h3><?php echo $name; ?></h3>
                            <img class="verified" src="images/verified1.png" alt="">
                        </div>
                        <h4><?php echo $title; ?></h4>
                    </div>
                    <?php if(!empty($sos_1) || !empty($sos_2) || !empty($sos_3) || !empty($sos_4) || !empty($sos_5) || !empty($sos_6)): ?>
                    <div class="socailm">
                        <?php if(!empty($sos_1)): ?>
                            <a href="https://www.instagram.com/<?php echo $sos_1; ?>"><i class="fa-brands fa-instagram"></i></a>
                        <?php endif; ?>

                        <?php if(!empty($sos_2)): ?>
                            <a href="https://www.facebook.com/<?php echo $sos_2; ?>"><i class="fa-brands fa-facebook-f"></i></a>
                        <?php endif; ?>

                        <?php if(!empty($sos_3)): ?>
                            <a href="https://x.com/<?php echo $sos_3; ?>"><i class="fa-brands fa-x-twitter"></i></a>
                        <?php endif; ?>

                        <?php if(!empty($sos_4)): ?>
                            <a href="https://wa.me/<?php echo $sos_4; ?>"><i class="fa-brands fa-whatsapp"></i></a>
                        <?php endif; ?>

                        <?php if(!empty($sos_5)): ?>
                            <a href="https://www.linkedin.com/in/<?php echo $sos_5; ?>"><i class="fa-brands fa-linkedin-in"></i></a>
                        <?php endif; ?>

                        <?php if(!empty($sos_6)): ?>
                            <a href="https://t.me/<?php echo $sos_6; ?>"><i class="fa-brands fa-telegram"></i></a>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>


                    <div class="kydt" style="font-family: 'Poppins', sans-serif; display: flex; align-items: center; justify-content: center; text-align: center; ">
                        <button style="width: 50%; height: 45px; background-color: blueviolet; color: white; border-radius: 7px; border: none; font-size:18px; font-weight: 600; margin-top: 20px; margin-bottom: -15px; font-family: 'Poppins', sans-serif; margin-left: 20px; " id="saveButton"><i class="fa-solid fa-address-book"></i> Kaydet</button>
                        <button style="width: 50%; height: 45px; background-color: blueviolet; color: white; border-radius: 7px; border: none; font-size:18px; font-weight: 600; margin-top: 20px; margin-bottom: -15px; font-family: 'Poppins', sans-serif; margin-left: 5px; margin-right: 20px;" id="shareButton"><i class="fa-solid fa-share-nodes"></i> Bağlan</button>
                    </div>

                    <!-- Modal -->
                    <div id="shareModal" class="modals">
                        <div class="modals-content">
                            <div class="modal-header">
                                <h3>Paylaş</h3>
                                <span class="closes">&times;</span>
                            </div>
                            <div class="share-icons">
                                <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode($page_url); ?>" target="_blank"><i class="fab fa-facebook" style="color: #1877F2" ></i><span>Facebook</span></a>
                                <a href="https://twitter.com/share?url=<?php echo urlencode($page_url); ?>" target="_blank"><i class="fab fa-twitter" style="color: #1DA1F2"></i><span>Twitter</span></a>
                                <a href="https://wa.me/?text=<?php echo urlencode($page_url); ?>" target="_blank"><i class="fab fa-whatsapp" style="color: #25D366"></i><span>WhatsApp</span></a>
                                <a href="https://www.pinterest.com/pin/create/button/?url=<?php echo urlencode($page_url); ?>" target="_blank"><i class="fab fa-pinterest" style="color: #E60023"></i><span>Pinterest</span></a>
                                <a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo urlencode($page_url); ?>" target="_blank"><i class="fab fa-linkedin" style="color: #0A66C2"></i><span>LinkedIn</span></a>
                                <a href="https://t.me/share/url?url=<?php echo urlencode($page_url); ?>" target="_blank"><i class="fab fa-telegram" style="color: #0088CC"></i><span>Telegram</span></a>
                                <a href="https://discord.com/invite/<?php echo urlencode($page_url); ?>" target="_blank"><i class="fab fa-discord" style="color: #5865F2"></i><span>Discord</span></a>
                                <a href="https://www.facebook.com/dialog/send?link=<?php echo urlencode($page_url); ?>" target="_blank"><i class="fab fa-facebook-messenger" style="color: #006AFF"></i><span>Messenger</span></a>
                                <a href="https://www.reddit.com/submit?url=<?php echo urlencode($page_url); ?>" target="_blank"><i class="fab fa-reddit" style="color: #FF4500"></i><span>Reddit</span></a>
                            </div>
                            <div class="page-link">
                                <input type="text" value="<?php echo $page_url; ?>" id="pageLink" readonly>
                                <i class="fas fa-copy copy-btn" onclick="copyLink()" title="Kopyala"></i>
                            </div>
                        </div>
                    </div>
                    <br>
                    <?php if(!empty($hakkimda)): ?>
                        <div class="bio">
                            <p><?php echo $hakkimda; ?></p>
                        </div>
                    <?php endif; ?>

                    <?php if(!empty($phone) || !empty($email) || !empty($web)): ?>
                    <div class="blg">
                        <?php if(!empty($phone)): ?>
                            <div class="blgd">
                                <i class="fa-solid fa-phone-volume"></i>
                                <p><a href="tel:<?php echo $phone; ?>" style="color:white; text-decoration:none;"><?php echo $phone; ?></a></p>
                            </div>
                        <?php endif; ?>

                        <?php if(!empty($email)): ?>
                            <div class="blgd">
                                <i class="fa-solid fa-envelope"></i>
                                <p><a href="mailto:<?php echo $email; ?>" style="color:white; text-decoration:none;"><?php echo $email; ?></a></p>
                            </div>
                        <?php endif; ?>

                        <?php if(!empty($web)): ?>
                            <div class="blgd">
                                <i class="fa-solid fa-globe"></i>
                                <p><a href="https://<?php echo $web; ?>" style="color:white; text-decoration:none;"><?php echo $web; ?></a></p>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>

                    <?php if(!empty($iban) || !empty($iban2) || !empty($iban3)): ?>
                    <div class="bnk">
                        <h1>Banka Bilgileri</h1>
                        <div class="cizgiler"></div>

                        <?php if(!empty($iban_name) && !empty($iban)): ?>
                            <div class="ibn">
                                <h2><?php echo $iban_name; ?></h2>
                                <p onclick="copyToClipboard('<?php echo $iban; ?>')"><?php echo $iban; ?></p> <!-- IBAN kopyalama -->
                            </div>
                        <?php endif; ?>

                        <?php if(!empty($iban2_name) && !empty($iban2)): ?>
                            <div class="ibn">
                                <h2><?php echo $iban2_name; ?></h2>
                                <p onclick="copyToClipboard('<?php echo $iban2; ?>')"><?php echo $iban2; ?></p> <!-- IBAN kopyalama -->
                                </div>  
                        <?php endif; ?>

                        <?php if(!empty($iban3_name) && !empty($iban3)): ?>
                            <div class="ibn">
                                <h2><?php echo $iban3_name; ?></h2>
                                <p onclick="copyToClipboard('<?php echo $iban3; ?>')"><?php echo $iban3; ?></p> <!-- IBAN kopyalama -->
                                </div>
                        <?php endif; ?>

                    </div>
                <?php endif; ?>


                    <?php if(!empty($iname) || !empty($isektor) || !empty($itel) || !empty($iposta) || !empty($iweb) || !empty($iadress)): ?>
                    <div class="bnk" style="text-decoration: none;">
                        <h1>Şirket Bilgileri</h1>
                        <div class="cizgiler"></div>

                        <?php if(!empty($iname)): ?>
                            <div class="ibn" style="display:flex; margin-top: 35px; align-items:center;">
                                <p style=" margin-right:10px" ><i class="fa-solid fa-building"></i></p>
                                <p><?php echo $iname; ?></p>
                            </div>
                        <?php endif; ?>

                        <?php if(!empty($isektor)): ?>
                            <div class="ibn" style="display:flex; margin-top: 35px; align-items:center;">
                                <p style=" margin-right:10px" ><i class="fa-solid fa-layer-group"></i></p>
                                <p><?php echo $isektor; ?></p>
                            </div>
                        <?php endif; ?>

                        <?php if(!empty($itel)): ?>
                            <a href="tel:<?php echo $itel; ?>" style="text-decoration: none;">
                            <div class="ibn" style="display:flex; margin-top: 35px; align-items:center;">
                                <p style=" margin-right:10px" ><i class="fa-solid fa-phone"></i></p>
                                <p><?php echo $itel; ?></p>
                            </div>
                            </a>
                        <?php endif; ?>

                        <?php if(!empty($iposta)): ?>
                            <a href="mailto:<?php echo $iposta; ?>" style="text-decoration: none;"> 
                            <div class="ibn" style="display:flex; margin-top: 35px; align-items:center;">
                                <p style="margin-right:10px" ><i class="fa-solid fa-envelope"></i></p>
                                <p><?php echo $iposta; ?></p>
                            </div>
                            </a>
                        <?php endif; ?>

                        <?php if(!empty($iweb)): ?>
                            <a href="https://<?php echo $iweb; ?>" style="text-decoration: none;">
                            <div class="ibn" style="display:flex; margin-top: 35px; align-items:center;">
                                <p style="margin-right:10px" ><i class="fa-solid fa-globe"></i></p>
                                <p><?php echo $iweb; ?></p>
                            </div>
                            </a>
                        <?php endif; ?>

                        <?php if(!empty($iadress)): ?>
                            <a href="https://www.google.com/maps/place/<?php echo $iadress; ?>" style="text-decoration: none;">
                            <div class="ibn" style="display:flex; margin-top: 35px; align-items:center;">
                                <p style="margin-right:10px" ><i class="fa-solid fa-location-dot"></i></p>
                                <p><?php echo $iadress; ?></p>
                            </div>
                            </a>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>



                    <div class="ypn">
                        <img src="images/djk.png" alt="">
                        <p>Bu profil <b><a href="https://altf4teknoloji.com/">ALTF4 TEKNOLOJİ</a></b> tarafından <b>DijiKart</b> projesi altında yapılmıştır.</p>
                    </div>
                </div>
				
                <script>
                    // QR kod modal açma ve kapama işlemleri
                    var modal = document.getElementById("qrModal");
                    var btn = document.getElementById("qrButton");
                    var span = document.getElementsByClassName("close")[0];

                    btn.onclick = function() {
                        modal.classList.add("active");
                    }

                    span.onclick = function() {
                        modal.classList.remove("active");
                    }

                    window.onclick = function(event) {
                        if (event.target == modal) {
                            modal.classList.remove("active");
                        }
                    }

                    document.getElementById("saveButton").addEventListener("click", function() {
                        window.location.href = "?download_vcard=1&id=<?php echo $id; ?>";
                    });

                    // IBAN'ı panoya kopyalama işlevi
                    function copyToClipboard(text) {
                        navigator.clipboard.writeText(text).then(function() {
                            alert("IBAN kopyalandı: " + text); // Kopyalama başarılıysa mesaj göster
                        }).catch(function(error) {
                            console.error("Kopyalama hatası:", error); // Kopyalama başarısızsa hata göster
                        });
                    }


 
                    // Modal Açma ve Kapama İşlemi 
                    var modal = document.getElementById("shareModal");
                    var btn = document.getElementById("shareButton");
                    var closesBtn = document.querySelector(".closes");  // Kapatma butonunu seçiyoruz

                    // "Bağlan" butonuna tıklandığında modal açılır
                    btn.onclick = function() {
                        modal.style.display = "block";
                    }

                    // Kapatma butonuna (closeBtn) tıklandığında modal kapanır
                    closesBtn.onclick = function() {
                    modal.style.display = "none";
                    }

                    // Modal dışında bir yere tıklanırsa modal kapanır
                    window.onclick = function(event) {
                        if (event.target == modal) {
                            modal.style.display = "none";
                        }
                    }

                    // Link Kopyalama İşlevi
                    function copyLink() {
                        var copyText = document.getElementById("pageLink");
                        copyText.select();
                        copyText.setSelectionRange(0, 99999); // Mobil cihazlar için
                        document.execCommand("copy");
                        alert("Link kopyalandı!");
                    }

                </script>
                <script src="script.js"></script>
            </body>
            </html>
            <?php
        }
    } else {
        echo "Profil Sayfası Bulunamadı 😑.";
        echo "<br>";
        echo "DijiKart ekibi ile iletişime geçiniz. ";
        exit();
    }
} else {
    echo "Invalid request.";
    exit();
}

$conn->close();
?>
