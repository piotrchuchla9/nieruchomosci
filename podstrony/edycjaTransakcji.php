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
        <a href="dodajMieszkanie.php">Dodaj Mieszkanie</a>
    </div>
    <div class="wrapper">
    <?php
                if ($_SERVER['REQUEST_METHOD'] === 'GET')  : ?>
        
        <form action="edycjaTransakcji.php" method="post">
            <table>
            <?php
                $sql = "SELECT * FROM transakcja WHERE id_transakcji = " .$_GET["id"];
                $result = $connection -> query($sql);
                while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
                    echo '
                    <input name="id" id="id" type="hidden" value='.$row["id_transakcji"].'>

                <tr>
                    <th style="float: left">Cena&nbsp;</th>
                    <th><input type="text" name="cena" placeholder="Cena" pattern="\d*" value='.$row["cena"].' required></th>
                </tr>
                <tr>
                    <th style="float: left">Data transakcji&nbsp;</th>
                    <th><input type="date" name="data" placeholder="data" pattern="[A-Za-z]+" value="'.$row["data_transakcji"].'" required></th>
                </tr>
                

                    ';
            }
            ?>
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
                </tr>
                <tr>
                    <th style="float: left">Klient&nbsp;</th>
                    <th><select name="klient" id="klient" required>

                    <?php
                    echo '<option value=""></option>';
                    $sql = "SELECT id_klienta, imie, nazwisko FROM klient";
                    $result = $connection -> query($sql);
                    while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
                        echo '<option value=' .$row["id_klienta"]. '>'.$row["imie"].' '.$row["nazwisko"].'</option>';
                    }


                    ?>

                    </select></th>
                </tr>
                <tr>
                    <th style="float: left">Mieszkanie&nbsp;</th>
                    <th><select name="mieszkanie" id="mieszkanie" required>

                    <?php
                    echo '<option value=""></option>';
                    $sql = "SELECT id_mieszkania, miasto, ulica, cena FROM mieszkanie";
                    $result = $connection -> query($sql);
                    while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
                        echo '<option value=' .$row["id_mieszkania"]. '>'.$row["miasto"].' '.$row["ulica"].' '.$row["cena"].'zł</option>';
                    }


                    ?>

                    </select></th>
                </tr>
                <tr>
                    <th style="float: left">Dokonano Transakcji?&nbsp;</th>
                    <th><input type="checkbox" name="transakcja" value=""></th>
                </tr>
                
            </table>

            <button type="submit" name="edytuj_transakcje" style="margin-left: 50px;">Wyślij</button>

        </form>
        <?php endif; ?>

    </div>

    <?php
    if (isset($_POST['edytuj_transakcje'])) {
        $id_transakcji = $_POST['id'];
        $cena = $_POST['cena'];
        $data_transakcji = $_POST['data'];
        $id_posrednika = $_POST['posrednik'];
        $id_klienta = $_POST['klient'];
        $id_mieszkania = $_POST['mieszkanie'];
        $dokonanie_transakcji = $_POST['transakcja'] === 'on'? 1 : 0;


        $result = update_transakcja($connection, $id_transakcji, $cena, $data_transakcji, $id_posrednika, $id_klienta, $id_mieszkania, $dokonanie_transakcji);
        //mysqli_query($connection,$result) or die (mysqli_error($connection));

        if (!empty($result) && $result->num_rows > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $update_transakcja_info = $row['update_transakcja_info'];

                if ($update_transakcja_info == 0) {

                    echo '<div class="modal fade" id="warningModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">';
                    echo '<div class="modal-dialog">';
                    echo '<div class="modal-content">';
                    echo '<div class="modal-header">';
                    echo '<h5 class="modal-title" id="exampleModalLabel">Sukces</h5>';
                    echo '<button type="button" class="btn-close" data-bs-dismiss="modal" onclick="location.href = \'dodajTransakcje.php\'" aria-label="Close"></button>';
                    echo '</div>';
                    echo '<div class="modal-body">';
                    echo 'Zedytowano transakcję!';
                    echo '</div>';
                    echo '<div class="modal-footer">';
                    echo '<button type="button" class="btn btn-secondary" onclick="location.href = \'dodajTransakcje.php\'" data-bs-dismiss="modal">Zamknij</button>';
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
                    echo '<button type="button" class="btn-close" data-bs-dismiss="modal" onclick="location.href = \'dodajTransakcje.php\'" aria-label="Close"></button>';
                    echo '</div>';
                    echo '<div class="modal-body">';
                    echo 'Popraw dane!';
                    echo '</div>';
                    echo '<div class="modal-footer">';
                    echo '<button type="button" class="btn btn-secondary" onclick="location.href = \'dodajTransakcje.php\'" data-bs-dismiss="modal">Close</button>';
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