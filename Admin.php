<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Total Tuning | LOGIN</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/Admin.css">
    <link rel="icon" type="image/x-icon" href="img/Logo.jpg">
</head>
<body>
    <!--NAVBAR-->
    <nav class="navbar1 container-fluid">
        <img src="img/Logo.jpg" class="logo" alt="Logo"> 
        <h1>TotalTuning Administrator</h1> 
    </nav>
    <br>

    <?php
    //DB CONNECTION
    session_start();
    
    $mysqli = new mysqli("localhost","root","","totaltuning") or die ("Error occured while connecting to database!");

    //LOGIN WHILE
    
    if(!(isset($_SESSION['LoginStatus'])))
    {
        //UNSET
        ?>
        <!--LOGIN-->
        <section  class="section1 container">
            <div class="container-fluid h-custom">
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col-md-9 col-lg-6 col-xl-5">
                        <img src="img/logo.jpg"
                        class="img-fluid" alt="Sample image">
                    </div>
                    <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
                        <form action="#" method="post">
                            <!-- Email input -->
                            <div data-mdb-input-init class="form-outline mb-4">
                                <input name="Username" type="text" id="form3Example3" class="form-control form-control-lg"
                                placeholder="Username" />
                                <label style="color: white;" class="form-label" for="form3Example3" required>Username</label>
                            </div>
                            <!-- Password input -->
                            <div data-mdb-input-init class="form-outline mb-3">
                                <input name="Password" type="password" id="form3Example4" class="form-control form-control-lg"
                                placeholder="Enter password" />
                                <label style="color: white;" class="form-label" for="form3Example4" required>Password</label>
                            </div>
                            <div class="text-center text-lg-start mt-4 pt-2">
                                <input name="Login" type="submit" style="width:100px; padding-left:1.5rem;" type="button" data-mdb-button-init data-mdb-ripple-init class="button-30" value="Login">
                                <br><br>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    <!--LOGIN END-->
        <?php
        if(isset($_POST['Login']))
        {
            if(!(empty($_POST['Password']) || empty($_POST['Username'])))
            {
                $Username = $_POST['Username'];
                $Password = $_POST['Password'];
                $upit= "SELECT * FROM `Admin` WHERE `Username` like '".$Username."' AND `Password` like '".$Password."'";
                $rezultat = $mysqli -> query($upit);
                if($rezultat->fetch_assoc())
                {
                    $_SESSION['LoginStatus'] = 1;
                }
                else
                {
                    ?>
                    <div class="LoginMessage container"><p>Netacna Lozinka/Username</p></div> 
                    <?php
                    
                }
            }
            else
            {
                ?>
                <div class="LoginMessage container"><p>Popunite podatke!</p></div>  
                <?php
            }
        }
    }
    else
    {   
        if(!isset($_SESSION['active1']))
        {
            $_SESSION['active1'] = "";
        }
        if(!isset($_SESSION['active2']))
        {
            $_SESSION['active2'] = "";
        }
        if(!isset($_SESSION['active3']))
        {
            $_SESSION['active3'] = "";
        }
        if(!isset($_SESSION['active4']))
        {
            $_SESSION['active4'] = "";
        }
        if(!isset($_SESSION['AktivnaStranica']))
        {
            $_SESSION['AktivnaStranica'] = 0;
        }
       
        
            //OPTION 1
            if(isset($_POST['PregledRacuna']))
            {
                $_SESSION['AktivnaStranica'] = "PregledRacuna";
                $_SESSION['active1'] = "active";
                $_SESSION['active2'] = "";
                $_SESSION['active3'] = "";
                $_SESSION['active4'] = "";
            }

            //OPTION 2
            if(isset($_POST['ObradaRacuna']))
            {
                $_SESSION['AktivnaStranica'] = "ObradaRacuna";
                $_SESSION['active2'] = "active";
                $_SESSION['active4'] = "";
                $_SESSION['active3'] = "";
                $_SESSION['active1'] = "";   
            }

            //OPTION 3
            if(isset($_POST['Stavka1']))
            {
                $_SESSION['AktivnaStranica'] = "Stavka1";
                $_SESSION['active4'] = "";
                $_SESSION['active3'] = "active";
                $_SESSION['active2'] = "";
                $_SESSION['active1'] = "";    
            }
            
            //OPTION 4
            if(isset($_POST['Stavka2']))
            {
                $_SESSION['AktivnaStranica'] = "Stavka2";
                $_SESSION['active4'] = "active";
                $_SESSION['active3'] = "";
                $_SESSION['active2'] = "";
                $_SESSION['active1'] = "";     
            }
            
        

        ?><div class="div-center container">
        <form action="#" method="post">
            <ul class="nav nav-tabs">
            <li class="nav-item">
                <input type="submit" name="PregledRacuna" class="nav-link <?php echo $_SESSION['active1'];?>" aria-current="page" value="Pregled racuna">
            </li>
            <li class="nav-item">
                <input type="submit" name="ObradaRacuna" class="nav-link <?php echo $_SESSION['active2'];?>" aria-current="page" value="Poruceni artikli">
            </li>
            <li class="nav-item">
                <input type="submit" name="Stavka1" class="nav-link <?php echo $_SESSION['active3'];?>" aria-current="page" value="Pregled Kataloga">
            </li>
            <li class="nav-item">
                <input type="submit" name="Stavka2" class="nav-link <?php echo $_SESSION['active4'];?>" aria-current="page" value="Option 4">
            </li>
            </ul>   
        </form>


        <br>
         <?php
        
            //OPTION 1
            if($_SESSION['AktivnaStranica']=="PregledRacuna")
            {
                ?>
                <form action="#" method="post">
                    <input type="submit" style="width:fit-content;" class="button-30" name="b1" value="Svi racuni">
                    <input type="submit" style="width:fit-content;" class="button-30" name="b2" value="Poslato">
                    <input type="submit" style="width:fit-content;" class="button-30" name="b3" value="Nije poslato">
                </form>
                <br>
                <?php

                $upit = "SELECT * FROM `racuni` ORDER BY DatumRacuna DESC";
                if(isset($_POST['b1']))
                {
                    $upit = "SELECT * FROM `racuni` ORDER BY DatumRacuna DESC";
                }
                if(isset($_POST['b2']))
                {
                    $upit = "SELECT * FROM `racuni` WHERE `Poslato` Like 'Da' ORDER BY DatumRacuna DESC";
                }
                if(isset($_POST['b3']))
                {
                    $upit = "SELECT * FROM `racuni` WHERE `Poslato` Like 'Ne' ORDER BY DatumRacuna DESC";
                }
                if(!($rezultat = $mysqli->query($upit)))die("Greska pri upitu!");
                ?><table class="container"><th>Sifra Racuna</th><th>Datum</th><th>Ime/Prezime</th><th>Telefon</th><th>Adresa</th><th>Email</th><th>Iznos</th><th>Poslato</th><?php
                while($red = $rezultat->fetch_assoc())
                    {
                        
                        echo 
                        "
                        <tr>
                        <td>".$red['SifraRacuna']."</td>
                        <td>".$red['DatumRacuna']."</td>
                        <td>".$red['ImePrezime']."</td>
                        <td>".$red['BrojTelefona']."</td>
                        <td>".$red['Adresa']."</td>
                        <td>".$red['Email']."</td>
                        <td>".$red['Iznos']."</td>
                        <td>".$red['Poslato']."</td>
                        <td>";
                    }
                    echo "</table>";
                    ?>
                        <form action="#" method="post">
                            <div style=" margin-bottom:50px; margin-top:50px">
                                <select style="width: 200px;" name="select1" id="select1">
                                    <?php
                                    $upit = "SELECT * FROM `racuni` ORDER BY DatumRacuna DESC";
                                    if($rezultat = $mysqli->query($upit))
                                    {   
                                        while($red = $rezultat->fetch_assoc())
                                        {
                                        echo "<option value=".$red['SifraRacuna'].">".$red['SifraRacuna']."</option>";
                                        }
                                        
                                    }
                                    else
                                    {
                                        die("Error occured while running database!");
                                    }
                                    ?>
                                </select>
                                <input style="height:30px;" type="submit" class="button-30" name="btnObrisi" value="Obrisi">
                                <input style="height:30px;width:fit-content;" type="submit" class="button-30" name="btnPoslato" value="Izmeni u Poslato">
                            </div>
                        </form>
                    <?php
                //DUGME OBRISI
                if(isset($_POST['btnObrisi']))
                {
                    if(!isset($_POST['btnObrisi']))
                    {
                        echo "Izaberite racun koji je za brisanje!";
                    }
                    else
                    {
                        $selectValue = $_POST['select1'];
                        $upit1 = "DELETE FROM `porucene stavke` WHERE SifraRacuna like '".$selectValue."'";
                        $mysqli->query($upit1);
                        $upit2 = "DELETE FROM `racuni` WHERE SifraRacuna like '".$selectValue."'";
                        $mysqli->query($upit2);
                        
                    }
                }
                //DUGME POSLATO
                if(isset($_POST['btnPoslato']))
                {
                    
                    if(!isset($_POST['btnPoslato']))
                    {
                        echo "Izaberite racun koji azurirate!";
                    }
                    else
                    {
                        $selectValue = $_POST['select1'];
                        $upit = "UPDATE `racuni` SET `Poslato`='Da' WHERE `SifraRacuna` like '".$selectValue."'";
                        $mysqli->query($upit);
                      
                    }

                }
                
            }









            //OPTION 2 PORUCENI ARTIKLI
            if($_SESSION['AktivnaStranica']=="ObradaRacuna")
            {
                ?>
                <form action="#" method="post">
                    <input style="height:30px;width:fit-content;" type="submit" style="width:fit-content;" class="button-30" name="b1" value="Svi racuni">
                                <select style="width: 200px;" name="select1" id="select1">
                                    <?php
                                    $upit = "SELECT * FROM `racuni` ORDER BY DatumRacuna DESC";
                                    if($rezultat = $mysqli->query($upit))
                                    {   
                                        while($red = $rezultat->fetch_assoc())
                                        {
                                        echo "<option value=".$red['SifraRacuna'].">".$red['SifraRacuna']."</option>";
                                        }
                                        
                                    }
                                    else
                                    {
                                        die("Error occured while running database!");
                                    }
                                    ?>
                                </select>
                    <input style="height:30px;width:fit-content;" type="submit" style="width:fit-content;" class="button-30" name="b2" value="Trazi">
                </form>
                <br>
                <?php
                if(isset($_POST['select1']))
                {
                    $selectValue = $_POST['select1'];
                }
                else{$selectValue = 0;}
                $upit = "SELECT * FROM `porucene stavke` ORDER BY SifraRacuna";
                if(isset($_POST['b1']))
                {
                    $upit = "SELECT * FROM `porucene stavke` ORDER BY SifraRacuna";
                }


                if(isset($_POST['b2']))
                {
                    $upit = "SELECT * FROM `porucene stavke` WHERE `SifraRacuna` Like '".$selectValue."'";
                }

                if(!($rezultat = $mysqli->query($upit)))die("Greska pri upitu!");
                ?><table class="container"><th>Sifra Racuna</th><th>Naziv Artikla</th><th>Proizvodjac</th><th>Model</th><th>Cena</th><th>Kolicina</th><th>Sifra artikla</th><?php
                while($red = $rezultat->fetch_assoc())
                    {
                        
                        echo 
                        "
                        <tr>
                        <td>".$red['SifraRacuna']."</td>
                        <td>".$red['NazivArtikla']."</td>
                        <td>".$red['Proizvodjac']."</td>
                        <td>".$red['Model']."</td>
                        <td>".$red['Cena']."</td>
                        <td>".$red['Kolicina']."</td>
                        <td>".$red['SifraArtikla']."</td>
                        
                        <td>";
                    }
                    echo "</table>";
            
            } //KRAJ OPTION 2






            //OPTION 3
            if($_SESSION['AktivnaStranica']=="Stavka1")
            {
                if(!isset($_SESSION['select1']))
                {
                    $_SESSION['select1'] = 0;
                }
                ?>
                <form action="#" method="post">
                    <label style="margin-right:5px;height:30px;width:fit-content;" class="label-1" for="select1">Kategorija</label>
                    
                                <select style="width: 200px;" name="select1" id="select1">
                                    <?php
                                    $upit = "SELECT * FROM `kategorije` ORDER BY SifraKategorije ASC";
                                    if($rezultat = $mysqli->query($upit))
                                    {   
                                        while($red = $rezultat->fetch_assoc())
                                        {
                                        echo "<option value=".$red['SifraKategorije'].">".$red['NazivKategorije']."</option>";
                                        }
                                        
                                    }
                                    else
                                    {
                                        die("Error occured while running database!");
                                    }
                                    ?>
                                </select>
                                
                    <input style="height:30px;width:fit-content;" type="submit" style="width:fit-content;" class="button-30" name="b1" value="Trazi">
                </form>
                <br>
                <?php
                

               //DUGME TRAZI
                if(isset($_POST['b1']))
                {
                    if(isset($_POST['select1']))
                    {
                        $_SESSION['selectedValue'] = $_POST['select1'];
                    }
                    else{$_SESSION['selectedValue'] = 0;}
                    $upit = "SELECT * FROM `stavka kataloga` WHERE `SifraKategorije` = '".$_SESSION['selectedValue']."' ORDER BY `Sifra` ASC";
                    

                    if(!($rezultat = $mysqli->query($upit)))die("Greska pri upitu!");
                    ?><table class="container"><th>Naziv Artikla</th><th>Sifra</th><th>Cena</th><th>Proizvodjac</th><th>Model</th><th>Stanje</th><?php
                    while($red = $rezultat->fetch_assoc())
                        { 
                            echo 
                            "
                            <tr>
                            <td>".$red['NazivArtikla']."</td> <td>".$red['Sifra']."</td> <td>".$red['Cena']."</td><td>".$red['Proizvodjac']."</td> <td>".$red['Model']."</td><td>".$red['Stanje']."</td>
                            <tr>";
                        }
                        echo "</table><br>"; //ISPIS TABELE O STAVKAMA KATALOGA
                       
                   
                    
                }
                ?>  
                <!--DONJA FORMA!-->
                <form action="#" method="post">
                    <label style="margin-right:5px;height:30px;width:fit-content;" class="label-1" for="select2">Izmenite stanje artikla po sifri</label>
                    
                                <input type="text" style="width: 200px;" name="txtSifra" id="select1">
                            
                    <input style="height:30px;width:fit-content;" type="submit" style="width:fit-content;" class="button-30" name="b2" value="Na stanju">
                    <input style="height:30px;width:fit-content;" type="submit" style="width:fit-content;" class="button-30" name="b3" value="Nema">
                </form>
                <br>
            <?php 

            
            
            if(isset($_POST['b2']) and isset($_POST['b2']))
            {
                $selectValue2 = $_POST['txtSifra'];
                
                $upit = "UPDATE `stavka kataloga` SET `Stanje` = 'Na stanju' WHERE `Sifra` like '".$selectValue2."'";
                if(!($rezultat = $mysqli->query($upit)))die("Greska pri upitu!");
            }
            if(isset($_POST['b3']) and isset($_POST['txtSifra']))
            {
                $selectValue2 = $_POST['txtSifra'];
                
                $upit = "UPDATE `stavka kataloga` SET `Stanje` = 'Nema' WHERE `Sifra` like '".$selectValue2."'";
                if(!($rezultat = $mysqli->query($upit)))die("Greska pri upitu!");  
            }
                    
            }//OPTION 3 KRAJ
            
            //OPTION 4
            if($_SESSION['AktivnaStranica']=="Stavka2")
            {
                echo "Coming soon...";
            }



    }
    ?>
    
    
    
    
    </div>
</body>
</html>