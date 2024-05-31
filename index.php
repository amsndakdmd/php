<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
<?php

class Automobil{
    public $conn;

    public function __construct($servername, $username, $password, $database){
        $this->conn = new mysqli($servername, $username, $password, $database);

        if($this->conn->connect_error){
            die("Neuspesna konekcija!");
        }
        else{
            echo "Uspesna konekcija sa bazom podataka!";
        }
    }

    public function unos($marka, $model, $godiste, $kilometraza, $kubikaza, $boja, $broj_sedista){
        $sql = "INSERT INTO automobil (marka, model, godiste, kilometraza, kubikaza, boja, broj_sedista) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ssiddsi", $marka, $model, $godiste, $kilometraza, $kubikaza, $boja, $broj_sedista);

        if($stmt->execute()){
            echo "<br>Uspesno ste uneli podatke u bazu!";
        }
        else{
            echo "Niste uspesno uneli podatke u bazu!";
        }

    }

    public function izmena($marka, $model, $godiste, $kilometraza, $kubikaza, $boja, $broj_sedista, $id){
        $sql = "UPDATE automobil SET marka = ?, model = ?, godiste = ?, kilometraza = ?, kubikaza = ?, boja = ?, broj_sedista = ? WHERE automobil_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ssiddsii", $marka, $model, $godiste, $kilometraza, $kubikaza, $boja, $broj_sedista, $id);
        if($stmt->execute()){
            echo "<br>Podaci su uspesno izmenjeni!";
        }
        else{
            echo "<br>Podaci nisu uspesno izmenjeni!";
        }
    }

    public function brisanje($id){
        $sql = "DELETE FROM automobil WHERE automobil_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        if($stmt->execute()){
            echo "<br>Podaci su uspesno obrisan!";
        }
        else{
            echo "<br>Podaci nisu uspesno obrisani!";
        }
    }
}

$auto1 = new Automobil("localhost", "root", "","automobil");
$auto1->unos("Toyota", "Aygo", 2010, 183000, 1000, "plava", 5);
$auto1->izmena("Toyota", "Aygo", 2015, 200000, 1200, "plava", 3, 1);
#$auto1->brisanje(1);

?>
</body>
</html>
