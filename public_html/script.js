(function() {
    var script = document.createElement('script');
    script.type = 'text/javascript';
    script.src = 'https://cdn.jsdelivr.net/npm/qrcode-generator/qrcode.min.js';
    document.getElementsByTagName('head')[0].appendChild(script);

    script.onload = function() {
        document.getElementById("qrButton").addEventListener("click", function() {
            var url = window.location.href; // Bulunduğumuz sayfanın URL'sini alırız
            var qrModal = document.getElementById("qrModal");
            var qrCodeDiv = document.getElementById("qrCode");

            // QR kod oluştur
            var qr = qrcode(0, 'M');
            qr.addData(url);
            qr.make();

            // QR kodun SVG içeriğini al ve göster
            qrCodeDiv.innerHTML = qr.createSvgTag({cellSize: 4});

            // Modalı göster ve animasyonu ekle
            qrModal.classList.add("active");

            // Modalı kapat
            document.getElementsByClassName("close")[0].addEventListener("click", function() {
                qrModal.classList.remove("active");
            });
        });
    };
})();
