<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="img/Logo.jpg">
</head>
<body>
<title>Total Tuning | Katalog delova</title>
<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" href="css/Katalog.css">
<link rel="stylesheet" href="css/Katalogphp.css">
<link rel="stylesheet" href="css/navbar.css">
<script src="js/Katalog.js"></script>

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

<div style="height: 1000px;">
<!--          BODY          -->
<nav class="navbar navbar-expand-lg bg-body-tertiary container">
  <div class="container-fluid">
    <a class="navbar-brand" href="Katalog.html">Nazad na katalog | </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarText">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="index.html">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Cenovnik</a>
        </li>
      </ul>
      <span class="navbar-text">
        Total Tuning ITEMS SHOP
      </span>
    </div>
  </div>
</nav>
<!--          BODY ISPOD NAVBARA          -->

<div class="table1 container">
  <table class="table1 container">
    <th>Naziv artikla</th><th>Marka</th><th>Model</th><th>Stanje</th><th>Cena</th><th>Sifra Artikla</th>

          <?php
            
            session_start();
            
            $parametar = $_GET["katalog"];
            
            


            $mysqli = new mysqli("localhost","root","","totaltuning") or die ("Error occured while connecting to database!");
            $upit = "SELECT * FROM `stavka kataloga` WHERE SifraKategorije = " . $parametar . " ORDER BY Proizvodjac";
            if($rezultat = $mysqli->query($upit))
            {
              
              while($red = $rezultat->fetch_assoc())
              {
                echo 
                "
                <tr>
                <td>".$red['NazivArtikla']."</td>
                <td>".$red['Proizvodjac']."</td>
                <td>".$red['Model']."</td>
                <td>".$red['Stanje']."</td>
                <td>".$red['Cena']."</td>
                <td>".$red['Sifra']."</td>
                <td>";
              }
              
            }
            else
            {
              die("Error occured while running database!");
            }
            
          ?>

  </table>
</div>
<br>
<div class="forma">
<form method="post" action="#">
<div style="padding-bottom:20px; padding-top:20px; padding-left:20px;" class="table1 container">
  <p style="margin: auto;">Narudzbenica:</p>
  <select style="width: 200px; " name="select1" id="select1">
    

  <?php
  
  $upit = "SELECT * FROM `stavka kataloga` WHERE SifraKategorije = " . $parametar . " ORDER BY Sifra";
  if($rezultat = $mysqli->query($upit))
  {
    
    while($red = $rezultat->fetch_assoc())
    {
      echo "<option value=".$red['Sifra'].">".$red['Sifra']."</option>";
    }
    
  }
  else
  {
    die("Error occured while running database!");
  }
  ?>
  </select>


  <input type="number" name="kolicina" style="background-color: white; width: 50px;" maxlength="3">
  <input name="btnDodaj" type="submit" style="background-color: white; margin-left:20px;" class="btn btn-white" value="Dodaj u korpu">
  <input name="btnPrikaz" type="submit" style="background-color: white; margin-left:20px;" class="btn btn-white" value="Prikazi korpu">
  <input name="btnPonisti" type="submit" style="background-color: white; margin-left:20px;" class="btn btn-white" value="Ponisti kupovinu">
  <input name="btnUkloniOdredjeni" type="submit" style="background-color: white; margin-left:20px;" class="btn btn-white" value="Unkloni odredjeni artikal">
  <label for="txtRedniBroj">Redni broj stavke racuna:</label>
  <input type="number" name="txtRedniBroj" style="background-color: white; width: 50px;" maxlength="3">
  <p style="margin: auto; font-weight: bold;">Korpa:</p>
  </form>
  <?php 
  if(isset($_POST['btnDodaj']))
  {
    if(empty($_POST['kolicina']) || $_POST['kolicina'] <1 || empty($_POST['select1']))
    {
      echo "<p>Unesite ispravne podatke!</p>";
    }
    else
    {
      ?><table>
        <th></th><th>Naziv Artikla</th><th>Proizvodjac</th><th>Model</th><th>Cena</th><th>Kolicina</th>
        <?php

      if(!isset($_SESSION['korpa'])) {
            $_SESSION['korpa'] = [];
        }  
      $upit = "SELECT * FROM `stavka kataloga` WHERE Sifra = " . $_POST['select1'];
      $rezultat = $mysqli ->query($upit);
      $Korpa = array();
      $redniBroj = 0;
      $ukupnaCena = 0;
      while($red = $rezultat->fetch_assoc())
      {
        if($red["Stanje"] == "Nema")
        {
          ?> <p style="color=red;">Zao nam je, izabrani artikal nije na stanju, pokusajte drugom prilikom.</p><?php
        }
        else
        {
      $artikli = new stdClass();
      $artikli->Stanje = $red["Stanje"];
      $artikli->NazivArtikla = $red["NazivArtikla"];
      $artikli->Proizvodjac = $red["Proizvodjac"];
      $artikli->Model = $red["Model"];
      $artikli->Cena = $red["Cena"];
      $artikli->Sifra = $red["Sifra"];
      $artikli->kolicina = $_POST['kolicina'];
      
      $_SESSION['korpa'][] = $artikli;
        }
      }
      foreach ($_SESSION['korpa'] as $artikli)
      {
        $ukupnaCena = $ukupnaCena + $artikli->Cena * $artikli->kolicina;
        echo 
        "
        <tr>
        <td>".$redniBroj++ ." |</td>
        <td>".$artikli->NazivArtikla."</td>
        <td>".$artikli->Proizvodjac."</td>
        <td>".$artikli->Model."</td>
        <td>".$artikli->Cena."</td>
        <td>".$artikli->kolicina."</td>
        </tr>";
      }
    }
  }
  if(isset($_POST['btnPrikaz']) and isset($_SESSION['korpa']) )
  {
    ?><table>
        <th></th><th>Naziv Artikla</th><th>Proizvodjac</th><th>Model</th><th>Cena</th><th>Kolicina</th>
        <?php
    $redniBroj = 0;
    $ukupnaCena = 0;
    foreach ($_SESSION['korpa'] as $artikli)
    {
      $ukupnaCena = $ukupnaCena + $artikli->Cena * $artikli->kolicina;
      echo 
      "
      <tr>
      <td>".$redniBroj++ ." |</td>
      <td>".$artikli->NazivArtikla."</td>
      <td>".$artikli->Proizvodjac."</td>
      <td>".$artikli->Model."</td>
      <td>".$artikli->Cena."</td>
      <td>".$artikli->kolicina."</td>
      </tr>";
    }
  
  }
  if(isset($_POST['btnPonisti']))
  {
      unset($_SESSION['korpa']);
  } 

  if(isset($_POST['btnUkloniOdredjeni'])) {
    if(!isset($_POST['txtRedniBroj']) || $_POST['txtRedniBroj'] < 0) {
        echo "Unesite validan redni broj stavke racuna!";
    } else {
        // Indeks za PHP niz je 0-based, tako da oduzimamo 1 od unosa
        $ind = $_POST['txtRedniBroj'];

        // Provera da li postoji stavka u korpi sa tim indeksom
        if(isset($_SESSION['korpa'][$ind])) {
            unset($_SESSION['korpa'][$ind]);
            $_SESSION['korpa'] = array_values($_SESSION['korpa']);
           
            echo "Uspesno uklonjena " . ($ind) . ". stavka racuna!";
        } else {
            echo "Nema stavke sa tim rednim brojem u korpi!";
        }
    }
}

  ?>
</table>
<br>
<form action="Racun.php" method="post">
<?php
if(isset($ukupnaCena))
{
  //da se ne ponavlja ista sifra racuna na vise racuna
  $_SESSION['SifraRacuna'] = rand(1, 100000);
  $rezultat = $mysqli -> query("SELECT * FROM racuni WHERE SifraRacuna like '".$_SESSION['SifraRacuna']."'");
  while($red = $rezultat->fetch_assoc())
  {
    $_SESSION['SifraRacuna'] = rand(1, 100000);
  }

  echo "Ukupno: " . $ukupnaCena . " rsd";
  ?>
  <input name="btnKupovina" type="submit" style="background-color: white; margin-left:20px;" class="btn btn-white" value="Kupovina">
  <?php
}
if(isset($_POST['btnKupovina']))
  {
    header("Location: Racun.php");
  }
?>
</form>
</div>
</div>






<script>
    //Da bi se vratio prozor de je bio
    window.onscroll = function() {
        sessionStorage.setItem('scrollPos', window.scrollY);
    };

    // Kada se stranica učita, postavi skrol na prethodnu poziciju
    window.onload = function() {
        var scrollPos = sessionStorage.getItem('scrollPos');
        if (scrollPos) {
            window.scrollTo(0, scrollPos);
        }
    };
</script>
















<!-- FOOTER -->
<div style="margin-top:100px;" class="container-md12">
        
        
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