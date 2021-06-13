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
        <a href="dodajMieszkanie.php">Mieszkania</a>
        <a href="dodajTransakcje.php">Transakcje</a>
    </div>
    <div class="wrapper">
        <form action="listaPosrednikow.php" method="post">
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

                </tr>

                
            </table>
            
            <button type="button" name="edytuj_posrednika" onclick="location.href = 'edycjaPosrednika.php?id=' + document.getElementById('posrednik').value">Wyślij</button>
            
        </form>

        <!-- <button style="margin-top: 100px;"><a href="usunPosrednika.php"></a>Usuń Pośrednika</button> -->
    </div>

    

</body>

</html>