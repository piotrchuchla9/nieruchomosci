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
    <title>Dodaj Mieszkanie</title>
</head>

<body>
    <div class="topnav">
        <a href="../index.php">Home</a>
        <a href="dodajKlienta.php">Klienci</a>
        <a href="dodajPosrednika.php">Pośrednicy</a>
        <a href="dodajTransakcje.php">Transakcje</a>
    </div>
    <div class="wrapper">
        <form action="listaMieszkan.php" method="post">
            <table>
                <tr>
                    <th style="float: left">Mieszkanie&nbsp;</th>
                    <th><select name="mieszkanie" id="mieszkanie">

                    <?php
                    echo '<option value=""></option>';
                    $sql = "SELECT id_mieszkania, miasto, ulica, cena FROM mieszkanie";
                    $result = $connection -> query($sql);
                    while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
                        echo '<option value="' .$row["id_mieszkania"]. '">'.$row["miasto"].' '.$row["ulica"].' '.$row["cena"].'</option>';
                    }


                    ?>

                </tr>

                
            </table>
            
            <button type="button" name="edytuj_mieszkanie" onclick="location.href = 'edycjaMieszkania.php?id=' + document.getElementById('mieszkanie').value;" >Wyślij</button>
            
        </form>

        <!-- <button style="margin-top: 100px;"><a href="usunPosrednika.php"></a>Usuń Pośrednika</button> -->
    </div>

    
</body>

</html>