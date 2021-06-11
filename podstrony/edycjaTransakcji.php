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
    <?php
                if ($_SERVER['REQUEST_METHOD'] === 'GET')  : ?>
        
        <form action="edycjaMieszkania.php" method="post">
            <table>
                <tr>
                    <th style="float: left">Pośrednik&nbsp;</th>
                    <th><select name="posrednik" id="posrednik" required>

                    <?php
                    echo '<option value=""></option>';
                    $sql = "SELECT id_posrednika, imie, nazwisko FROM posrednik";
                    $result = $connection -> query($sql);
                    while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
                        echo '<option value=' .$row["id_posrednika"]. '>'.$row["imie"].' '.$row["nazwisko"].'</option>';
                    }


                    ?>

                    </select></th>
                    <!-- <th><input type="text" name="posrednik" placeholder="Pośrednik" pattern="\d*" required></th> -->
                </tr>
                <?php
                $sql = "SELECT * FROM mieszkanie WHERE id_mieszkania = " .$_GET["id"];
                $result = $connection -> query($sql);
                while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
                    echo '
                    <input name="id" id="id" type="hidden" value='.$row["id_mieszkania"].'>

                <tr>
                    <th style="float: left">Cena&nbsp;</th>
                    <th><input type="text" name="cena" placeholder="Cena" pattern="\d*" value='.$row["cena"].' required></th>
                </tr>
                <tr>
                    <th style="float: left">Imię Właściciela&nbsp;</th>
                    <th><input type="text" name="imie_wlasciciela" placeholder="Imię Właściciela" pattern="[A-Za-z]+" value="'.$row["imie_wlasciciela"].'" required></th>
                </tr>
                <tr>
                    <th style="float: left">Nazwisko Właściciela&nbsp;</th>
                    <th><input type="text" name="nazwisko_wlasciciela" placeholder="Nazwisko Właściciela" pattern="[A-Za-z]+" value="'.$row["nazwisko_wlasciciela"].'" required></th>
                </tr>
                <tr>
                    <th style="float: left">Telefon Właściciela&nbsp;</th>
                    <th><input type="text" name="telefon_wlasciciela" placeholder="Telefon Właściciela" pattern="\d*" value="'.$row["telefon_wlasciciela"].'" required></th>
                </tr>
                <tr>
                    <th style="float: left">Miasto&nbsp;</th>
                    <th><input type="text" name="miasto" placeholder="Miasto" pattern="[A-Za-z]+" value="'.$row["miasto"].'" required></th>
                </tr>
                <tr>
                    <th style="float: left">Ulica&nbsp;</th>
                    <th><input type="text" name="ulica" placeholder="Ulica" value="'.$row["ulica"].'" required></th>
                </tr>
                <tr>
                    <th style="float: left">Kod Pocztowy&nbsp;</th>
                    <th><input type="text" name="kod" placeholder="Kod Pocztowy" value="'.$row["kod_pocztowy"].'" required></th>
                </tr>
                <tr>
                    <th style="float: left">Powierzchnia (m3)&nbsp;</th>
                    <th><input type="text" name="powierzchnia" placeholder="Powierzchnia" pattern="\d*" value='.$row["powierzchnia"].' required></th>
                </tr>
                <tr>
                    <th style="float: left">Typ Mieszkania&nbsp;</th>
                    <th><input type="text" name="typ" placeholder="Typ Mieszkania" pattern="[A-Za-z]+" value="'.$row["rodzaj_mieszkania"].'" required></th>
                </tr>
                <tr>
                    <th style="float: left">Opis Mieszkania&nbsp;</th>
                    <th><input type="text" name="opis" placeholder="Opis Mieszkania" value="'.$row["opis_mieszkania"].'" required></th>
                </tr>
                <tr>
                    <th style="float: left">Sprzedano?&nbsp;</th>
                    <th><input type="text" name="sprzedano" placeholder="nie/tak" value="'.$row["sprzedano"].'" required></th>
                </tr>
                <!--<input type="hidden" name="sprzedano" value="nie">-->

                    ';
            }
            ?>
            </table>

            <button type="submit" name="edytuj_mieszkanie" style="margin-left: 50px;">Wyślij</button>

        </form>
        <?php endif; ?>

    </div>

    <?php
    if (isset($_POST['edytuj_mieszkanie'])) {
        $id_mieszkania = $_POST['id'];
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


        $result = update_mieszkanie($connection, $id_mieszkania, $posrednik, $cena, $imie_wlasciciela, $nazwisko_wlasciciela, $telefon_wlasciciela, $miasto, $ulica, $kod_pocztowy, $powierzchnia, $typ, $opis, $sprzedano);
        //mysqli_query($connection,$result) or die (mysqli_error($connection));

        if (!empty($result) && $result->num_rows > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $update_mieszkanie_info = $row['update_mieszkanie_info'];

                if ($update_mieszkanie_info == 0) {

                    echo '<div class="modal fade" id="warningModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">';
                    echo '<div class="modal-dialog">';
                    echo '<div class="modal-content">';
                    echo '<div class="modal-header">';
                    echo '<h5 class="modal-title" id="exampleModalLabel">Sukces</h5>';
                    echo '<button type="button" class="btn-close" data-bs-dismiss="modal" onclick="location.href = \'dodajMieszkanie.php\'" aria-label="Close"></button>';
                    echo '</div>';
                    echo '<div class="modal-body">';
                    echo 'Zedytowano dane mieszkania!';
                    echo '</div>';
                    echo '<div class="modal-footer">';
                    echo '<button type="button" class="btn btn-secondary" onclick="location.href = \'dodajMieszkanie.php\'" data-bs-dismiss="modal">Zamknij</button>';
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';

                    echo "<script type='text/javascript'>
                        $(document).ready(function(){
                        $('#warningModal').modal('show');
                        });
                        </script>";
                } else {

                    echo '<div class="modal fade" id="warningModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">';
                    echo '<div class="modal-dialog">';
                    echo '<div class="modal-content">';
                    echo '<div class="modal-header">';
                    echo '<h5 class="modal-title" id="exampleModalLabel">Błąd!</h5>';
                    echo '<button type="button" class="btn-close" data-bs-dismiss="modal" onclick="location.href = \'dodajMieszkanie.php\'" aria-label="Close"></button>';
                    echo '</div>';
                    echo '<div class="modal-body">';
                    echo 'Popraw dane!';
                    echo '</div>';
                    echo '<div class="modal-footer">';
                    echo '<button type="button" class="btn btn-secondary" onclick="location.href = \'dodajMieszkanie.php\'" data-bs-dismiss="modal">Close</button>';
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';

                    echo "<script type='text/javascript'>
                        $(document).ready(function(){
                        $('#warningModal').modal('show'); });
                        </script>";
                }
            }
        }
    }

    ?>

</body>

</html>