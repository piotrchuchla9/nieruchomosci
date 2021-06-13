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
    <title>Dodaj Pośrednika</title>
</head>

<body>
    <div class="topnav">
        <a href="../index.php">Home</a>
        <a href="dodajKlienta.php">Klienci</a>
        <a href="dodajMieszkanie.php">Mieszkania</a>
        <a href="dodajTransakcje.php">Transakcje</a>
    </div>
    <div class="wrapper">
    <?php
                if ($_SERVER['REQUEST_METHOD'] === 'GET')  : ?>
        
        <form action="edycjaPosrednika.php" method="post">
            <table>
                <?php
                    $sql = "SELECT * FROM posrednik WHERE id_posrednika = " .$_GET["id"];
                    $result = $connection->query($sql);
                    while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
                        echo '
                    <input name="id" id="id" type="hidden" value="'.$row["id_posrednika"].'">
                    <tr>
                        <th style="float: left">Imię Pośrednika&nbsp;</th>
                        <th><input type="text" name="imie" placeholder="imie" pattern="[A-Za-z]+" value="'.$row["imie"].'" required></th>
                    </tr>
                    <tr>
                        <th style="float: left">Nazwisko Pośrednika&nbsp;</th>
                        <th><input type="text" name="nazwisko" placeholder="nazwisko" pattern="[A-Za-z]+" value="'.$row["nazwisko"].'" required></th>
                    </tr>
                    <tr>
                        <th style="float: left">Telefon Pośrednika&nbsp;</th>
                        <th><input type="text" name="telefon" placeholder="telefon" pattern="\d*" value="'.$row["telefon"].'" required></th>
                    </tr>
                        ';
                    }
                


                ?>
                

            </table>

            <button type="submit" name="edytuj_posrednika">Wyślij</button>

        </form>
        <?php endif; ?>

    </div>

    <?php
    if (isset($_POST['edytuj_posrednika'])) {
        $id_posrednika = $_POST['id'];
        $imie = $_POST['imie'];
        $nazwisko = $_POST['nazwisko'];
        $telefon = $_POST['telefon'];

        $result = update_posrednik($connection, $id_posrednika, $imie, $nazwisko, $telefon);

        if (!empty($result) && $result->num_rows > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $update_posrednik_info = $row['update_posrednik_info'];

                if ($update_posrednik_info == 0) {

                    echo '<div class="modal fade" id="warningModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">';
                    echo '<div class="modal-dialog">';
                    echo '<div class="modal-content">';
                    echo '<div class="modal-header">';
                    echo '<h5 class="modal-title" id="exampleModalLabel">Sukces</h5>';
                    echo '<button type="button" class="btn-close" data-bs-dismiss="modal" onclick="location.href = \'usunPosrednika.php\'" aria-label="Close"></button>';
                    echo '</div>';
                    echo '<div class="modal-body">';
                    echo 'Zedytowano pośrednika!';
                    echo '</div>';
                    echo '<div class="modal-footer">';
                    echo '<button type="button" class="btn btn-secondary" onclick="location.href = \'usunPosrednika.php\'" data-bs-dismiss="modal">Zamknij</button>';
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
                    echo '<button type="button" class="btn-close" data-bs-dismiss="modal" onclick="location.href = \'usunPosrednika.php\'" aria-label="Close"></button>';
                    echo '</div>';
                    echo '<div class="modal-body">';
                    echo 'Popraw dane!';
                    echo '</div>';
                    echo '<div class="modal-footer">';
                    echo '<button type="button" class="btn btn-secondary" onclick="location.href = \'usunPosrednika.php\'" data-bs-dismiss="modal">Close</button>';
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