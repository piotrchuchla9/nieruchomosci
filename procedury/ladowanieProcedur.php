
<?php

function add_mieszkanie($connection, $posrednik, $cena, $imie_wlasciciela, $nazwisko_wlasciciela, $telefon_wlasciciela, $miasto, $ulica, $kod, $powierzchnia, $typ, $opis) {

$sql = "call add_mieszkanie(?,?,?,?,?,?,?,?,?,?,?)";
$statement = mysqli_stmt_init($connection);

if (!mysqli_stmt_prepare($statement, $sql)) {
  header("location: ../login.php?error=stmtfailed");

}

mysqli_stmt_bind_param($statement, "iissssssiss", $posrednik, $cena, $imie_wlasciciela, $nazwisko_wlasciciela, $telefon_wlasciciela, $miasto, $ulica, $kod, $powierzchnia, $typ, $opis);
mysqli_stmt_execute($statement);


return mysqli_stmt_get_result($statement);

}


function add_transakcja($connection, $cena, $data_transakcji, $id_posrednika, $id_klienta, $id_mieszkania, $dokonanie_transakcji) {

  $sql = "call add_transakcja(?,?,?,?,?,?)";
  $statement = mysqli_stmt_init($connection);
  
  if (!mysqli_stmt_prepare($statement, $sql)) {
    //echo
    //header("location: ../login.php?error=stmtfailed");
  
  }
  
  mysqli_stmt_bind_param($statement, "dsiiii", $cena, $data_transakcji, $id_posrednika, $id_klienta, $id_mieszkania, $dokonanie_transakcji);
  mysqli_stmt_execute($statement);
  
  
  return mysqli_stmt_get_result($statement);
  
  }




?>