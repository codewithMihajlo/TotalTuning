
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Total Tuning | Narucivanje</title>
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/Katalog.css">
  <link rel="stylesheet" href="css/Katalogphp.css">
  <link rel="stylesheet" href="css/navbar.css">
  <link rel="stylesheet" href="css/Racun.css">
  <link rel="icon" type="image/x-icon" href="img/Logo.jpg">
  
</head>
<body>
  <!--NAVBAR-->
  <nav class="navbar1">
    <img src="img/Logo.jpg" class="logo" alt="Logo"> 
    <h1 class="navh1">TotalTuning prodavnica auto delova</h1> 
    <div class="grupa_dugmica1">
      <a href="index.html" class="button-30">Home</a>
      <a href="Katalog.html" class="button-30">Katalog</a>
      <a href="O nama.html" class="button-30">O nama</a>
      <a href="Kontakt.html" class="button-30">Kontakt</a>
      
    </div>
  </nav>
  <br>
  <div class="bodi container">
    
  <div class="racun container">
    <p class="h2k container">Racun</p>
    
    <table >
            <th>Naziv Artikla</th><th>Proizvodjac</th><th>Model</th><th>Cena</th><th>Kolicina</th>
            <?php session_start();
            if(isset($_POST['SifraRacuna'])){$SifraRacuna = $_POST['SifraRacuna'];}else{$SifraRacuna="";}
           
        $ukupnaCena = 0;
        if(isset($_SESSION['korpa']))
        {

          
          foreach ($_SESSION['korpa'] as $artikli)
          {
          $ukupnaCena = $ukupnaCena + $artikli->Cena * $artikli->kolicina;
          $_SESSION['Ukupno'] = $ukupnaCena;
          echo 
          "
          <tr>
          <td>".$artikli->NazivArtikla."</td>
          <td>".$artikli->Proizvodjac."</td>
          <td>".$artikli->Model."</td>
          <td>".$artikli->Cena."</td>
          <td>".$artikli->kolicina."</td>
          </tr>";
          } 
        }?>
    </table>
    <p class="h2k">Ukupan iznos: <?php echo $ukupnaCena?> dinara</p>
    <p class="h1k">Datum: <?php echo $_SESSION['Datum'] = $today = date("Y-m-d H:i:s");?></p>
    <p class="h0k">Sifra racuna: <?php echo $SifraRacuna?></p>
    <p class="h0k">Molimo vas unesite ispravne podatke da bi racun mogao biti obradjen</p>
    

    <form action="ObradaRacuna.php" method="post">
      <table>
        <tr>
          <td><label for="txtImePrezime">Ime i prezime</label></td>
          <td><input type="text" required name="txtImePrezime" id="ImePrezimeID" placeholder="Ime i prezime"></td>
        </tr>
        <tr>
          <td><label for="txtAdresa">Adresa za isporuku</label></td>
          <td><input type="text" required name="txtAdresa" id="AdresaID" placeholder="Adresa"></td>
        </tr>
        <tr>
          <td><label for="txtTelefon">Broj telefona</label></td>
          <td><input type="text" required name="txtTelefon" id="TelefonID" placeholder="Broj telefona"></td>
        </tr>
        <tr>
          <td><label for="txtEmail">Email adresa (opcionalno)</label></td>
          <td><input type="email" name="txtEmail" id="EmailAdresaID" placeholder="Email Adresa"></td>
        </tr>
        <tr>
          <td colspan=2><input type="submit" name="btnSubmit" ></td>
        </tr>
      </table>
      
      
    </form>
    <p class="h0k">U slucaju nevazecih podataka, porudzbina se nece obaviti</p>
    <br>
  </div>
  
  
  
  
  
  
  
  
</div>
<!-- FOOTER -->
<div class="container-md12">
  
  
  <footer
  class="text-center text-lg-start text-white"
  style="background-color: #141d21"
  >
  <!-- Section: Social media -->
  <section>
    
    <div>
      <a href="" class="text-white me-4">
        <i class="fab fa-facebook-f"></i>
      </a>
      <a href="" class="text-white me-4">
        <i class="fab fa-twitter"></i>
      </a>
      <a href="" class="text-white me-4">
        <i class="fab fa-google"></i>
      </a>
      <a href="" class="text-white me-4">
        <i class="fab fa-instagram"></i>
      </a>
      <a href="" class="text-white me-4">
        <i class="fab fa-linkedin"></i>
      </a>
      <a href="" class="text-white me-4">
        <i class="fab fa-github"></i>
      </a>
    </div>
    <!-- Right -->
  </section>
  <!-- Section: Social media -->
  
  <!-- Section: Links  -->
  <section class="">
    <div class="container text-center text-md-start mt-5">
      <!-- Grid row -->
      <div class="row mt-3">
        <!-- Grid column -->
        <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
          <!-- Content -->
          <h6 class="text-uppercase fw-bold">Total Tuning</h6>
          <hr
          class="mb-4 mt-0 d-inline-block mx-auto"
          style="width: 60px; background-color: #7c4dff; height: 2px"
          />
          <p>
            Total Tuning je specijalizovana radnja auto delova i opreme koja nudi širok asortiman proizvoda za poboljšanje performansi i estetike vozila.
            U ponudi su sportski izduvni sistemi, filteri za vazduh, felne, LED osvetljenje, kao i ostali delovi za servisiranje i odrzavanje automobila.
          </p>
        </div>
        <!-- Grid column -->
        
        <!-- Grid column -->
        <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4">
          <!-- Links -->
          <h6 class="text-uppercase fw-bold">Kategorije</h6>
          <hr
          class="mb-4 mt-0 d-inline-block mx-auto"
          style="width: 60px; background-color: #7c4dff; height: 2px"
          />
          <p>
            <a href="#!" class="text-white">O nama</a>
          </p>
          <p>
            <a href="#!" class="text-white">Katalog</a>
          </p>
          <p>
            <a href="#!" class="text-white">Kontaktirajte nas</a>
          </p>
          <p>
            <a href="#!" class="text-white">Pracenje posiljke</a>
          </p>
        </div>
        <!-- Grid column -->
        
        
        <!-- Grid column -->
        <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
          <!-- Links -->
          <h6 class="text-uppercase fw-bold">Kontakt</h6>
          <hr
          class="mb-4 mt-0 d-inline-block mx-auto"
          style="width: 60px; background-color: #7c4dff; height: 2px"
          />
          <p>Dunavska 555b, Beograd</p>
          <p>info@example.com</p>
          <p>+ 381 234 567 88</p>
          <p>+ 381 234 567 89</p>
        </div>
        <!-- Grid column -->
      </div>
      <!-- Grid row -->
    </div>
  </section>
  <!-- Section: Links  -->
  
  <!-- Copyright -->
  <div
  class="text-center p-3"
  style="background-color: rgba(0, 0, 0, 0.2)"
  >
  © 2020 Copyright: Total Tuning
  
  
</div>
<!-- Copyright -->
</footer>
<!-- Footer -->

</div>
<!-- End of .container -->
</body>
</html>