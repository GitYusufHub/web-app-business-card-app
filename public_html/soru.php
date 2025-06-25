<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DijiKart Portal</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />    
</head>
<style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');
body{
    margin: 0;
    user-select: none;
    background-color: white;
    font-family: "Poppins", sans-serif;
}

.navs{
  display: flex;
  align-items: center;
  margin-left: 10px;
  margin-right: 10px;
}
.navs h1{
  font-family: "Poppins", sans-serif;
  font-weight: 600;
  font-style: normal;
  font-size: 27px;
}

.navs #left{
    margin-left: 15px;
    margin-right: 10px;
    font-size: 25px;
}

.wrapper {
  max-width: 90%;
  margin: auto;
}

.content{
    margin-left: 15px;
    margin-right: 15px;
}

.wrapper > p,
.wrapper > h1 {
  margin: 1.5rem 0;

}

.wrapper > h1 {
  letter-spacing: 3px;
  font-weight: 600;
  font-size: 25px;
  text-align: center;
  font-family: "Poppins", sans-serif;

}



.accordion {
  background-color: #F5F6F7;
  color: rgba(0, 0, 0, 0.8);
  cursor: pointer;
  font-size: 1.1rem;
  width: 100%;
  height: 70px;
  padding: 1rem 0.5rem;
  border: none;
  outline: none;
  transition: 0.4s;
  display: flex;
  justify-content: space-between;
  align-items: center;
  font-weight: 500;
  border-radius: 8px;
  font-family: "Poppins", sans-serif;


}

.accordion i {
  font-size: 1.2rem;
}

.active,
.accordion:hover {
  background-color: #f1f7f5;
}
.pannel {
  padding: 0 2rem 2.5rem 2rem;
  background-color: white;
  overflow: hidden;
  background-color: #f1f7f5;
  display: none;
}
.pannel p {
  color: rgba(0, 0, 0, 0.7);
  font-size: 1.2rem;
  line-height: 1.4;
}

.faq {
  margin: 10px 0;
  border-radius: 8px;
}
.faq.active {
  border-radius: 8px;
}


</style>
<body>
    <div class="navs">
        <a href="hesabim.php"><i class="fa-solid fa-arrow-left" id="left"></i></a> 
         <h1>Sıkça Sorulan Sorular</h1>
     </div>
     <div class="content">
        <div class="faq">
            <button class="accordion">
              DijiKart Nedir?
              <i class="fa-solid fa-chevron-down"></i>
            </button>
            <div class="pannel">
              <p>
                Dijital kartvizit, geleneksel kağıt kartvizitlerin dijital ortama taşınmış halidir. Bir kişinin veya
                işletmenin adını, iletişim bilgilerini ve diğer önemli bilgileri içeren bir dijital dosyadır. Genellikle bir
                mobil uygulama veya çevrimiçi platform aracılığıyla oluşturulur ve paylaşılır. Dijital kartvizitler,
                geleneksel kartvizitlere kıyasla daha çevreci, daha erişilebilir ve daha kolay paylaşılabilir bir alternatif
                sunar. Ayrıca, bilgilerin güncellenmesi daha kolaydır ve birden çok kişi veya kuruluşla paylaşılabilir.
              </p>
            </div>
          </div>
      
          <div class="faq">
            <button class="accordion">
              DijiKart ne işe yarar?
              <i class="fa-solid fa-chevron-down"></i>
            </button>
            <div class="pannel">
              <p>
                Dijital kartvizit, kişisel veya işletme bilgilerinizi dijital bir formatta saklamanıza ve paylaşmanıza olanak
                tanır. Geleneksel kağıt kartvizitlerin yerini alarak, iletişim bilgilerinizi kolayca erişilebilir hale getirir
                ve daha çevreci bir alternatif sunar. Dijital kartvizitler sayesinde, bilgilerinizi güncel tutmak ve farklı
                platformlarda kolayca paylaşmak mümkün olur. Ayrıca, QR kodları aracılığıyla hızlıca paylaşılabilir ve dijital
                ortamda daha geniş bir kitleye ulaşabilirsiniz.
              </p>
            </div>
          </div>
      
          <div class="faq">
            <button class="accordion">
              Kartvizitimi nasıl oluşturabilirim?
              <i class="fa-solid fa-chevron-down"></i>
            </button>
            <div class="pannel">
              <p>
                Dijital kartvizit oluşturma süreci oldukça basittir. Hesap oluşturun ve gerekli
                bilgilerinizi girin. Ardından, istediğiniz tasarımı seçip kartvizitinizi oluşturabilirsiniz.
              </p>
            </div>
          </div>
      
          <div class="faq">
            <button class="accordion">
              Kartvizitimi kimlerle paylaşabilirim?
              <i class="fa-solid fa-chevron-down"></i>
            </button>
            <div class="pannel">
              <p>
                Kartvizitinizi istediğiniz kişilerle paylaşabilirsiniz. Bunlar iş ortakları, müşteriler, potansiyel iş
                fırsatları veya herhangi bir kişi olabilir.
              </p>
            </div>
          </div>
      
          <div class="faq">
            <button class="accordion">
              Kartvizitimde hangi bilgiler yer alabilir?
              <i class="fa-solid fa-chevron-down"></i>
            </button>
            <div class="pannel">
              <p>
                Kartvizitinize adınız, unvanınız, şirketinizin adı, iletişim bilgileriniz (telefon numarası, e-posta adresi,
                web sitesi vb.), sosyal medya profilleriniz gibi bilgiler ekleyebilirsiniz.
              </p>
            </div>
          </div>
      
          <div class="faq">
            <button class="accordion">
              Kartvizitimi nasıl güncelleyebilirim?
              <i class="fa-solid fa-chevron-down"></i>
            </button>
            <div class="pannel">
              <p>
                Kartvizitinizi istediğiniz zaman güncelleyebilirsiniz. Uygulamamızı açın, profilinizi düzenleyin ve
                değişiklikleri kaydedin. Kartvizitler otomatik olarak güncellenecektir.
              </p>
            </div>
          </div>
      
          <div class="faq">
            <button class="accordion">
              Kartvizitimdeki bilgileri paylaşmak güvenli mi?
              <i class="fa-solid fa-chevron-down"></i>
            </button>
            <div class="pannel">
              <p>
                Evet, kartvizit bilgileriniz güvende. Verileriniz gizliliğe önem veren güvenli bir platformda saklanır ve
                yalnızca sizin izninizle paylaşılır.
              </p>
            </div>
          </div>
      
          <div class="faq">
            <button class="accordion">
              Kartvizitimi nasıl paylaşabilirim?
              <i class="fa-solid fa-chevron-down"></i>
            </button>
            <div class="pannel">
              <p>
                Kartvizitinizi e-posta ile gönderebilir, sosyal medya üzerinden paylaşabilir, QR kodunu taratarak aktarabilir
                veya doğrudan mesajlaşma uygulamaları aracılığıyla iletebilirsiniz.
              </p>
            </div>
          </div>
      
          <div class="faq">
            <button class="accordion">
              Kartvizitimi istediğim zaman silebilir miyim?
              <i class="fa-solid fa-chevron-down"></i>
            </button>
            <div class="pannel">
              <p>
                Evet, istediğiniz zaman kartvizitinizi silebilirsiniz. Profilinizden kartviziti seçin ve silme seçeneğini
                kullanın.
              </p>
            </div>
          </div>
      
          <div class="faq">
            <button class="accordion">
              Kartvizitimi farklı dillerde oluşturabilir miyim?
              <i class="fa-solid fa-chevron-down"></i>
            </button>
            <div class="pannel">
              <p>
                Elbette, kartvizitinizi farklı dillerde oluşturabilirsiniz. Çoklu dil seçeneklerimizle, kartvizitinizi birden
                fazla dilde tasarlayabilir ve paylaşabilirsiniz.
              </p>
            </div>
          </div>
      
          <div class="faq">
            <button class="accordion">
              Kartvizitimi kaç farklı cihazda kullanabilirim?
              <i class="fa-solid fa-chevron-down"></i>
            </button>
            <div class="pannel">
              <p>
                Kartvizitinizi istediğiniz kadar cihazda kullanabilirsiniz. Uygulamamızı iOS ve Android cihazlarınıza
                indirebilir ve kartvizitinize her zaman erişebilirsiniz.
              </p>
            </div>
          </div>
        </div>   
    </div>
</body>
      
<script>
    var acc = document.getElementsByClassName("accordion");
    var i;

    for (i = 0; i < acc.length; i++) {
      acc[i].addEventListener("click", function () {
        this.classList.toggle("active");
        this.parentElement.classList.toggle("active");

        var pannel = this.nextElementSibling;

        if (pannel.style.display === "block") {
          pannel.style.display = "none";
        } else {
          pannel.style.display = "block";
        }
      });
    }
  </script>
</html>