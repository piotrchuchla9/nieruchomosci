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
        <a href="dodajMieszkanie.php">Pośrednicy</a>
        <a href="dodajTransakcje.php">Transakcje/a>
    </div>
    <div class="wrapper">
        <form action="listaKlientow.php" method="post">
            <table>
                <tr>
                    <th style="float: left">Klient&nbsp;</th>
                    <th><select name="klient" id="klient">

                    <?php
                    echo '<option value=""></option>';
                    $sql = "SELECT id_klienta, imie, nazwisko, telefon FROM klient";
                    $result = $connection -> query($sql);
                    while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
                        echo '<option value="' .$row["id_klienta"]. '">'.$row["imie"].' '.$row["nazwisko"].' '.$row["telefon"].'</option>';
                    }


                    ?>

                </tr>

                
            </table>
            
            <button type="button" name="edytuj_klienta" onclick="location.href = 'edycjaKlienta.php?id=' + document.getElementById('klient').value;" >Wyślij</button>
            
        </form>

        <!-- <button style="margin-top: 100px;"><a href="usunPosrednika.php"></a>Usuń Pośrednika</button> -->
    </div>

    

</body>

</html>