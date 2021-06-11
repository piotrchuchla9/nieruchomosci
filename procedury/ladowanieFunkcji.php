
<?php

function add_klient($connection, $imie, $nazwisko, $telefon)
{

    $sql = "SELECT add_klient(?,?,?) as add_klient_info";
    $statement = mysqli_stmt_init($connection);


    if (!mysqli_stmt_prepare($statement, $sql)) {
        header("location: ../login.php?error=stmtfailed");
        exit();
      }

    mysqli_stmt_bind_param($statement, 'sss', $imie, $nazwisko, $telefon);
    mysqli_stmt_execute($statement);


    return mysqli_stmt_get_result($statement);
}

function add_posrednik($connection, $imie, $nazwisko, $telefon)
{

    $sql = "SELECT add_posrednik(?,?,?) as add_posrednik_info";
    $statement = mysqli_stmt_init($connection);

    if (!mysqli_stmt_prepare($statement, $sql)) {
        header("location: ../login.php?error=stmtfailed");
        exit();
      }

    mysqli_stmt_bind_param($statement, 'sss', $imie, $nazwisko, $telefon);
    mysqli_stmt_execute($statement);


    return mysqli_stmt_get_result($statement);
}

function delete_posrednik($connection, $id_posrednika)
{

    $sql = "SELECT delete_posrednik(?) as delete_posrednik_info";
    $statement = mysqli_stmt_init($connection);

    if (!mysqli_stmt_prepare($statement, $sql)) {
        header("location: ../login.php?error=stmtfailed");
        exit();
      }

    mysqli_stmt_bind_param($statement, 'i', $id_posrednika);
    mysqli_stmt_execute($statement);


    return mysqli_stmt_get_result($statement);
}

function update_posrednik($connection, $id_posrednika, $imie, $nazwisko, $telefon)
{

    $sql = "SELECT update_posrednik(?,?,?,?) as update_posrednik_info";
    $statement = mysqli_stmt_init($connection);

    if (!mysqli_stmt_prepare($statement, $sql)) {
        header("location: ../login.php?error=stmtfailed");
        exit();
      }

    mysqli_stmt_bind_param($statement, 'isss', $id_posrednika, $imie, $nazwisko, $telefon);
    mysqli_stmt_execute($statement);


    return mysqli_stmt_get_result($statement);
}

function delete_klient($connection, $id_klienta)
{

    $sql = "SELECT delete_klient(?) as delete_klient_info";
    $statement = mysqli_stmt_init($connection);

    if (!mysqli_stmt_prepare($statement, $sql)) {
        header("location: ../login.php?error=stmtfailed");
        exit();
      }

    mysqli_stmt_bind_param($statement, 'i', $id_klienta);
    mysqli_stmt_execute($statement);


    return mysqli_stmt_get_result($statement);
}

function update_klient($connection, $id_klienta, $imie, $nazwisko, $telefon)
{

    $sql = "SELECT update_klient(?,?,?,?) as update_klient_info";
    $statement = mysqli_stmt_init($connection);

    if (!mysqli_stmt_prepare($statement, $sql)) {
        header("location: ../login.php?error=stmtfailed");
        exit();
      }

    mysqli_stmt_bind_param($statement, 'isss', $id_klienta, $imie, $nazwisko, $telefon);
    mysqli_stmt_execute($statement);


    return mysqli_stmt_get_result($statement);
}

function update_mieszkanie($connection, $id_mieszkania, $id_posrednika, $cena, $imie_wlasciciela, $nazwisko_wlasciciela, $telefon_wlasciciela, $miasto, $ulica, $kod_pocztowy, $powierzchnia, $rodzaj_mieszkania, $opis_mieszkania, $sprzedano)
{

    $sql = "SELECT update_mieszkanie(?,?,?,?,?,?,?,?,?,?,?,?,?) as update_mieszkanie_info";
    $statement = mysqli_stmt_init($connection);

    if (!mysqli_stmt_prepare($statement, $sql)) {
        header("location: ../login.php?error=stmtfailed");
        exit();
      }

    mysqli_stmt_bind_param($statement, 'iiissssssisss', $id_mieszkania, $id_posrednika, $cena, $imie_wlasciciela, $nazwisko_wlasciciela, $telefon_wlasciciela, $miasto, $ulica, $kod_pocztowy, $powierzchnia, $rodzaj_mieszkania, $opis_mieszkania, $sprzedano);
    mysqli_stmt_execute($statement);


    return mysqli_stmt_get_result($statement);
}

?>