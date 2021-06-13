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
    <title>Dodaj Pośrednika</title>
</head>

<body>
    <div class="topnav">
        <a href="../index.php">Home</a>
        <a href="dodajKlienta.php">Klienci</a>
        <a href="dodajPosrednika.php">Pośrednicy</a>
        <a href="dodajMieszkanie.php">Mieszkania</a>
        <a href="dodajTransakcje.php">Transakcje</a>
    </div>
    <div class="wrapper">
        <form action="usunPosrednika.php" method="post">
            <table>
                <tr>
                    <th style="float: left">Pośrednik&nbsp;</th>
                    <th><select name="posrednik" id="posrednik">

                    <?php
                    echo '<option value=""></option>';
                    $sql = "SELECT id_posrednika, imie, nazwisko, telefon FROM posrednik";
                    $result = $connection -> query($sql);
                    while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
                        echo '<option value="' .$row["id_posrednika"]. '">'.$row["imie"].' '.$row["nazwisko"].' '.$row["telefon"].'</option>';
                    }


                    ?>

                    </select></th>
                </tr>
                
            </table>
            
            <button type="submit" name="usun_posrednika">Usuń</button>
            
        </form>

        <!-- <button style="margin-top: 100px;"><a href="usunPosrednika.php"></a>Usuń Pośrednika</button> -->
    </div>

    <?php
    if (isset($_POST['usun_posrednika'])) {
        $id_posrednika = $_POST['posrednik'];

        $result = delete_posrednik($connection, $id_posrednika);

        if (!empty($result) && $result->num_rows > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $delete_posrednik_info = $row['delete_posrednik_info'];

                if ($delete_posrednik_info == 0) {

                    echo '<div class="modal fade" id="warningModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">';
                    echo '<div class="modal-dialog">';
                    echo '<div class="modal-content">';
                    echo '<div class="modal-header">';
                    echo '<h5 class="modal-title" id="exampleModalLabel">Sukces</h5>';
                    echo '<button type="button" class="btn-close" data-bs-dismiss="modal" onclick="location.href = \'usunPosrednika.php\'" aria-label="Close"></button>';
                    echo '</div>';
                    echo '<div class="modal-body">';
                    echo 'Usunięto pośrednika!';
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
                    echo 'Dany pośrednik jest obecny w innych tabelach!';
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