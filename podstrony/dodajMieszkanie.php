<?php
include_once "../database.php";
include_once "../procedury/ladowanieProcedur.php";
include_once "../procedury/ladowanieFunkcji.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.slim.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"></script>
    <title>Dodaj Mieszkanie</title>
</head>

<body>
    <div class="topnav">
        <a href="../index.php">Home</a>
        <a href="dodajKlienta.php">Dodaj Klienta</a>
        <a href="dodajPosrednika.php">Dodaj Pośrednika</a>
        <a href="dodajTransakcje.php">Dodaj Transakcje</a>
    </div>
    <div class="wrapper">
        <form action="dodajMieszkanie.php" method="post">
            <table>
                <tr>
                    <th style="float: left">Pośrednik&nbsp;</th>
                    <th><select name="posrednik" id="posrednik" required>

                    <?php
                    echo '<option value=""></option>';
                    $sql = "SELECT id_posrednika, imie, nazwisko FROM posrednik";
                    $result = $connection -> query($sql);
                    while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
                        echo '<option value="' .$row["id_posrednika"]. '">'.$row["imie"].' '.$row["nazwisko"].'</option>';
                    }


                    ?>

                    </select></th>
                    <!-- <th><input type="text" name="posrednik" placeholder="Pośrednik" pattern="\d*" required></th> -->
                </tr>
                <tr>
                    <th style="float: left">Cena&nbsp;</th>
                    <th><input type="text" name="cena" placeholder="Cena" pattern="\d*" required></th>
                </tr>
                <tr>
                    <th style="float: left">Imię Właściciela&nbsp;</th>
                    <th><input type="text" name="imie_wlasciciela" placeholder="Imię Właściciela" pattern="[A-Za-z]+" required></th>
                </tr>
                <tr>
                    <th style="float: left">Nazwisko Właściciela&nbsp;</th>
                    <th><input type="text" name="nazwisko_wlasciciela" placeholder="Nazwisko Właściciela" pattern="[A-Za-z]+" required></th>
                </tr>
                <tr>
                    <th style="float: left">Telefon Właściciela&nbsp;</th>
                    <th><input type="text" name="telefon_wlasciciela" placeholder="Telefon Właściciela" pattern="\d*" required></th>
                </tr>
                <tr>
                    <th style="float: left">Miasto&nbsp;</th>
                    <th><input type="text" name="miasto" placeholder="Miasto" pattern="[A-Za-z]+" required></th>
                </tr>
                <tr>
                    <th style="float: left">Ulica&nbsp;</th>
                    <th><input type="text" name="ulica" placeholder="Ulica" required></th>
                </tr>
                <tr>
                    <th style="float: left">Kod Pocztowy&nbsp;</th>
                    <th><input type="text" name="kod" placeholder="Kod Pocztowy" required></th>
                </tr>
                <tr>
                    <th style="float: left">Powierzchnia (m3)&nbsp;</th>
                    <th><input type="text" name="powierzchnia" placeholder="Powierzchnia" pattern="\d*" required></th>
                </tr>
                <tr>
                    <th style="float: left">Typ Mieszkania&nbsp;</th>
                    <th><input type="text" name="typ" placeholder="Typ Mieszkania" pattern="[A-Za-z]+" required></th>
                </tr>
                <tr>
                    <th style="float: left">Opis Mieszkania&nbsp;</th>
                    <th><input type="text" name="opis" placeholder="Opis Mieszkania" required></th>
                </tr>
                <input type="hidden" name="sprzedano" value="nie">




            </table>

            <button type="submit" name="dodaj_mieszkanie" style="margin-left: 50px;">Wyślij</button>

        </form>

        <button style="margin-top: 40px;" onclick="location.href='listMieszkan.php'">Lista Mieszkań</button>
    </div>

    <?php
    if (isset($_POST['dodaj_mieszkanie'])) {
        $posrednik = $_POST['posrednik'];
        $cena = $_POST['cena'];
        $imie_wlasciciela = $_POST['imie_wlasciciela'];
        $nazwisko_wlasciciela = $_POST['nazwisko_wlasciciela'];
        $telefon_wlasciciela = $_POST['telefon_wlasciciela'];
        $miasto = $_POST['miasto'];
        $ulica = $_POST['ulica'];
        $kod_pocztowy = $_POST['kod'];
        $powierzchnia = $_POST['powierzchnia'];
        $typ = $_POST['typ'];
        $opis = $_POST['opis'];
        $sprzedano = $_POST['sprzedano'];




        $result = add_mieszkanie($connection, $posrednik, $cena, $imie_wlasciciela, $nazwisko_wlasciciela, $telefon_wlasciciela, $miasto, $ulica, $kod_pocztowy, $powierzchnia, $typ, $opis, $sprzedano);

        if (!empty($result) && $result->num_rows > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $add_mieszkanie = $row['add_mieszkanie'];

                echo '
                    <div class="modal fade" id="warningModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                     <div class="modal-dialog">
                     <div class="modal-content">
                     <div class="modal-header">
                     <h5 class="modal-title" id="exampleModalLabel">Komunikat</h5>
                     <button type="button" class="btn-close" data-bs-dismiss="modal" onclick=location.href = \'dodajMieszkanie.php\' aria-label="Close"></button>
                     </div>
                     <div class="modal-body">
                     Mieszkanie zostało dodane!
                     </div>
                     <div class="modal-footer">
                     <button type="button" class="btn btn-secondary" onclick=location.href = \'dodajMieszkanie.php\' data-bs-dismiss="modal">Close</button>
                     </div>
                     </div>
                     </div>
                     </div>

                     <script type="text/javascript">
                        $(document).ready(function(){
                        $("#warningModal").modal("show"); });
                        </script> 
                        ';
            }
        }
    }

    ?>

</body>

</html>