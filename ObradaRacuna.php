<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Total Tuning | Hvala na kupovini</title>
  <link rel="stylesheet" href="css/bootstrap.min.css">
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
    <p class="h2k container">Racun obradjen!</p>
    <?php  session_start(); 
    $mysqli = new mysqli("localhost","root","","totaltuning") or die ("Error occured while connecting to database!");
    //PROMENJIVE KOJE TREBA DA UDJU U BAZU:
    $SifraRacuna = $_SESSION['SifraRacuna'];
    $DatumRacuna = $_SESSION['Datum'];
    if(isset($_POST['txtTelefon'])){$BrojTelefona = $_POST['txtTelefon'];}else{$BrojTelefona = "unsetV";}
    if(isset($_POST['txtImePrezime'])){$ImePrezime = $_POST['txtImePrezime'];}else{$ImePrezime = "unsetV";}
    if(isset($_POST['txtAdresa'])){$Adresa = $_POST['txtAdresa'];}else{$Adresa = "unsetV";} 
    /*
    $BrojTelefona = $_POST['txtTelefon'];
    $ImePrezime = $_POST['txtImePrezime'];
    $Adresa = $_POST['txtAdresa']; 
    */
    /*$Email =*/if(isset($_POST['txtEmail'])){$Email = $_POST['txtEmail'];}else{$Email="";}
    $Iznos = $_SESSION['Ukupno'];

    /*
    
        if(isset($BrojTelefona['txtTelefon'])){$BrojTelefona = $_POST['txtTelefon'];}else{$BrojTelefona="";}
    if(isset($ImePrezime['txtImePrezime'])){$ImePrezime = $_POST['txtImePrezime'];}else{$ImePrezime="";}
    if(isset($Adresa['txtAdresa'])){$Adresa = $_POST['txtAdresa'];}else{$Adresa="";} 
    */

    function ProveriSifruRacuna()
    {
      $mysqli = new mysqli("localhost","root","","totaltuning") or die ("Error occured while connecting to database!");
      $rezultat = $mysqli -> query("SELECT * FROM racuni WHERE SifraRacuna like '".$_SESSION['SifraRacuna']."'");
      while($red = $rezultat->fetch_assoc())
      {
        $_SESSION['SifraRacuna'] = rand(1, 100000);
      }
      return $_SESSION['SifraRacuna'];
    }

    $SifraRacuna = ProveriSifruRacuna();
    
    
    

    if($BrojTelefona == "unsetV" || $ImePrezime == "unsetV" || $Adresa == "unsetV")
    {
      $echoPclass="h0k";
      echo "<p class = ".$echoPclass.">Greska pri obradi racuna, pokusajte kasnije!</p>";
    }
    else
    {
      
      if($mysqli -> query("INSERT INTO `racuni`(`SifraRacuna`, `DatumRacuna`, `ImePrezime`, `BrojTelefona`, `Adresa`, `Email`, `Iznos`,`Poslato`) 
      VALUES ('".$SifraRacuna."','".$DatumRacuna."','".$ImePrezime."','".$BrojTelefona."','".$Adresa."','".$Email."','".$Iznos."','Ne')"))
      {
          

          $ukupnaCena = 0;
        if(isset($_SESSION['korpa']))
        {
            $mysqli = new mysqli("localhost","root","","totaltuning") or die ("Error occured while connecting to database!");
            
          foreach ($_SESSION['korpa'] as $artikli)
          {
            $StavkaID = rand(1, 100000);
            $rezultat = $mysqli -> query("SELECT * FROM `porucene stavke` WHERE `StavkaID` like '".$StavkaID."'");
            while($red = $rezultat->fetch_assoc())
            {
              $StavkaID = rand(1, 100000);
            }
          $SifraRacuna = $SifraRacuna;
          $NazivArtikla = $artikli->NazivArtikla;
          $Proizvodjac = $artikli->Proizvodjac;
          $Model = $artikli->Model;
          $Cena = $artikli->Cena;
          $Kolicina = $artikli->kolicina;
          $SifraArtikla = $artikli ->Sifra;
          $upit = 
          "INSERT INTO `porucene stavke`( `SifraRacuna`,`StavkaID`, `NazivArtikla`, `Proizvodjac`, `Model`, `Cena`, `Kolicina`, `SifraArtikla`) 
          VALUES ('".$SifraRacuna."','".$StavkaID."','".$NazivArtikla."','".$Proizvodjac."','".$Model."','".$Cena."','".$Kolicina."','".$SifraArtikla."')";

          if($mysqli -> query($upit))
          {
            
          }
          else echo "Greska pri obradi racuna, pokusajte kasnije! ";

          } 
          ?><p class="h0k">Hvala na kupovini, uskoro ce vam stici poruka o isporuci porucene robe!</p><?php
        }
      }
      else echo "Greska pri obradi racuna, pokusajte kasnije! " . $mysqli -> error ;
    }
    ?>
    

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