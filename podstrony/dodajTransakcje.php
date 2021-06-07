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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" >
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" ></script>
    <title>Dodaj Transakcje</title>
</head>

<body>
    <div class="topnav">
        <a href="../index.php">Home</a>
        <a href="dodajKlienta.php">Dodaj Klienta</a>
        <a href="dodajPosrednika.php">Dodaj Pośrednika</a>
        <a href="dodajMieszkanie.php">Dodaj Mieszkanie</a>
    </div>
    <div class="wrapper">
        <form action="dodajTransakcje.php" method="post">
            <table>
                <tr>
                    <th style="float: left">Cena finalna&nbsp;</th>
                    <th><input type="text" name="cena" placeholder="Cena finalna" pattern="\d*" required></th>
                </tr>
                <tr>
                    <th style="float: left">Data transakcji&nbsp;</th>
                    <th><input type="date" name="data" id="data" required></th>
                </tr>
                <tr>
                    <th style="float: left">Pośrednik&nbsp;</th>
                    <th><select name="posrednik" id="posrednik">

                    <?php
                    echo '<option value=""></option>';
                    $sql = "SELECT id_posrednika, imie, nazwisko FROM posrednik";
                    $result = $connection -> query($sql);
                    while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
                        echo '<option value="' .$row["id_posrednika"]. '">'.$row["imie"].' '.$row["nazwisko"].'</option>';
                    }


                    ?>
                </select></tr>
                <tr>
                    <th style="float: left">Klient&nbsp;</th>
                    <th><select name="klient" id="klient">

                    <?php
                    echo '<option value=""></option>';
                    $sql = "SELECT id_klienta, imie, nazwisko FROM klient";
                    $result = $connection -> query($sql);
                    while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
                        echo '<option value="' .$row["id_klienta"]. '">'.$row["imie"].' '.$row["nazwisko"].'</option>';
                    }


                    ?>
                </select></tr>
                <tr>
                    <th style="float: left">Mieszkanie&nbsp;</th>
                    <th><select name="mieszkanie" id="mieszkanie">

                    <?php
                    echo '<option value=""></option>';
                    $sql = "SELECT id_mieszkania, miasto, ulica FROM mieszkanie";
                    $result = $connection -> query($sql);
                    while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
                        echo '<option value="' .$row["id_mieszkania"]. '">'.$row["miasto"].' '.$row["ulica"].'</option>';
                    }


                    ?>
                </select></tr>
                <tr>
                    <th style="float: left">Dokonano Transakcji?&nbsp;</th>
                    <th><input type="checkbox" name="transakcja"></th>
                </tr>
            </table>

            <button type="submit" name="dodaj_transakcje" style="margin-left: 50px;">Wyślij</button>

        </form>
    </div>

    <?php
    if (isset($_POST['dodaj_transakcje'])) {
        $cena = $_POST['cena'];
        $data_transakcji = $_POST['data'];
        $id_posrednika = $_POST['posrednik'];
        $id_klienta = $_POST['klient'];
        $id_mieszkania = $_POST['mieszkanie'];
        $dokonanie_transakcji = $_POST['transakcja'] === 'on'? 1 : 0;


        $result = add_transakcja($connection, $cena, $data_transakcji, $id_posrednika, $id_klienta, $id_mieszkania, $dokonanie_transakcji);

        echo '<div>'.$result.'</div>';

        if (!empty($result) && $result->num_rows > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $add_transakcja = $row['add_transakcja'];
                

                if ($add_posrednik_info == 0) {

                    echo '<div class="modal fade" id="warningModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">';
                    echo '<div class="modal-dialog">';
                    echo '<div class="modal-content">';
                    echo '<div class="modal-header">';
                    echo '<h5 class="modal-title" id="exampleModalLabel">Błąd!</h5>';
                    echo '<button type="button" class="btn-close" data-bs-dismiss="modal" onclick="location.href = "dodajPosrednika.php"" aria-label="Close"></button>';
                    echo '</div>';
                    echo '<div class="modal-body">';
                    echo 'Dany pośrednik już istnieje!';
                    echo '</div>';
                    echo '<div class="modal-footer">';
                    echo '<button type="button" class="btn btn-secondary" onclick="location.href = "dodajPosrednika.php"" data-bs-dismiss="modal">Zamknij</button>';
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
                    echo '<h5 class="modal-title" id="exampleModalLabel">Sukces!</h5>';
                    echo '<button type="button" class="btn-close" data-bs-dismiss="modal" onclick=location.href = \'dodajPosrednika.php\' aria-label="Close"></button>';
                    echo '</div>';
                    echo '<div class="modal-body">';
                    echo 'Pośrednik został dodany!';
                    echo '</div>';
                    echo '<div class="modal-footer">';
                    echo '<button type="button" class="btn btn-secondary" onclick=location.href = \'dodajPosrednika.php\' data-bs-dismiss="modal">Close</button>';
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

<script>document.getElementById("data").valueAsDate = new Date();</script>

</body>

</html>