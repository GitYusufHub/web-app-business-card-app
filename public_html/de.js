<script>
        window.onload = function() {
            // Sayfanın URL'sini al
            var url = window.location.href;
            // QR kod oluştur
            var qr = qrcode(0, 'M');
            qr.addData(url);
            qr.make();
            var qrImage = qr.createImgTag(2, 0); // QR kodunun boyutunu 1 olarak belirle (daha küçük)
            // QR kodu göster
            document.getElementById("qrcode").innerHTML = qrImage;
        };
		</script>