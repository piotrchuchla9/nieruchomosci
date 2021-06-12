DELIMITER $$

CREATE OR REPLACE PROCEDURE add_klient(
    IN   _imie VARCHAR(50),
    IN   _nazwisko varchar(100),
    IN   _telefon varchar(15)
)
BEGIN

	INSERT INTO klient (
        imie,
        nazwisko,
        telefon
    )
        VALUES (
        _imie,
        _nazwisko,
        _telefon
   );

END $$
DELIMITER ;

----------------------------------------------------------

DELIMITER $$
CREATE OR REPLACE FUNCTION add_klient(
      _imie VARCHAR(50),
      _nazwisko varchar(100),
      _telefon varchar(15)
)RETURNS integer 
BEGIN
	DECLARE result integer;
    set result = -1;
    
   SELECT 
   	 telefon into result
     FROM klient
     WHERE imie = _imie AND nazwisko = _nazwisko AND telefon = _telefon; 
     
     
	IF result = -1 THEN
	INSERT INTO klient (
        imie,
        nazwisko,
        telefon
    )
        VALUES (
        _imie,
        _nazwisko,
        _telefon
   );
   	RETURN 1;
   ELSE
   	RETURN 0;
   END IF;

END $$
DELIMITER ;


--------------------------------------------------

DELIMITER $$
CREATE OR REPLACE FUNCTION add_posrednik(
      _imie VARCHAR(50),
      _nazwisko varchar(100),
      _telefon varchar(15)
)RETURNS integer 
BEGIN
	DECLARE result integer;
    set result = -1;
    
   SELECT 
   	 telefon into result
     FROM posrednik
     WHERE imie = _imie AND nazwisko = _nazwisko AND telefon = _telefon; 
     
     
	IF result = -1 THEN
	INSERT INTO posrednik (
        imie,
        nazwisko,
        telefon
    )
        VALUES (
        _imie,
        _nazwisko,
        _telefon
   );
   	RETURN 1;
   ELSE
   	RETURN 0;
   END IF;

END $$
DELIMITER ;

--------------------------------------------------

DELIMITER $$
CREATE OR REPLACE FUNCTION delete_posrednik(
      _id_posrednika integer
)RETURNS integer 
BEGIN
	DECLARE result integer;
    set result = 0;
    
    SELECT COUNT(*) INTO result FROM mieszkanie WHERE id_posrednika = _id_posrednika;
	IF result = 0 THEN
	    SELECT COUNT(*) INTO result FROM transakcja WHERE id_posrednika = _id_posrednika;
        IF result = 0 THEN
            DELETE FROM posrednik WHERE id_posrednika = _id_posrednika;
            RETURN 0;
        ELSE 
            RETURN 1;
        END IF;
   ELSE
   	RETURN 1;
   END IF;

END $$
DELIMITER ;

------------------------------------------------

DELIMITER $$
CREATE OR REPLACE FUNCTION delete_klient(
      _id_klienta integer
)RETURNS integer 
BEGIN
	DECLARE result integer;
    set result = 0;
    

	    SELECT COUNT(*) INTO result FROM transakcja WHERE id_klienta = _id_klienta;
        IF result = 0 THEN
            DELETE FROM klient WHERE id_klienta = _id_klienta;
            RETURN 0;
        ELSE 
            RETURN 1;
        END IF;
   

END $$
DELIMITER ;

------------------------------------------------

DELIMITER $$

CREATE OR REPLACE PROCEDURE add_mieszkanie(
    IN   _id_posrednika integer,
    IN   _cena integer,
    IN   _imie_wlasciciela varchar(50),
    IN   _nazwisko_wlasciciela varchar(50),
    IN   _telefon_wlasciciela varchar(15),
    IN   _miasto varchar(100),
    IN   _ulica varchar(250),
    IN   _kod_pocztowy varchar(20),
    IN   _powierzchnia integer,
    IN   _rodzaj_mieszkania varchar(40),
    IN   _opis_mieszkania varchar(3000),
    IN   _sprzedano varchar(10)

)
BEGIN

	INSERT INTO mieszkanie (
        id_posrednika,
        cena,
        imie_wlasciciela,
        nazwisko_wlasciciela,
        telefon_wlasciciela,
        miasto,
        ulica,
        kod_pocztowy,
        powierzchnia,
        rodzaj_mieszkania,
        opis_mieszkania,
        sprzedano
    )
        VALUES (
        _id_posrednika,
        _cena,
        _imie_wlasciciela,
        _nazwisko_wlasciciela,
        _telefon_wlasciciela,
        _miasto,
        _ulica,
        _kod_pocztowy,
        _powierzchnia,
        _rodzaj_mieszkania,
        _opis_mieszkania,
        _sprzedano
   );

END $$
DELIMITER ;

------------------------------------------------

DELIMITER $$
CREATE OR REPLACE FUNCTION update_posrednik(
    _id_posrednika integer,
      _imie varchar(50),
      _nazwisko varchar(100),
      _telefon varchar(15)
)RETURNS integer 
BEGIN
	DECLARE result integer;
    set result = 0;
    
    UPDATE posrednik
    SET imie = _imie,
    nazwisko = _nazwisko,
    telefon = _telefon
    WHERE id_posrednika = _id_posrednika;

    RETURN 0;

END $$
DELIMITER ;

------------------------------------------------

DELIMITER $$
CREATE OR REPLACE FUNCTION update_klient(
    _id_klienta integer,
      _imie varchar(50),
      _nazwisko varchar(100),
      _telefon varchar(15)
)RETURNS integer 
BEGIN
	DECLARE result integer;
    set result = 0;
    
    UPDATE klient
    SET imie = _imie,
    nazwisko = _nazwisko,
    telefon = _telefon
    WHERE id_klienta = _id_klienta;

    RETURN 0;

END $$
DELIMITER ;

---------------------------------------------------------



DELIMITER $$

CREATE OR REPLACE PROCEDURE add_transakcja(
    IN   _cena decimal(11,2),
    IN   _data_transakcji date,
    IN   _id_posrednika integer,
    IN   _id_klienta integer,
    IN   _id_mieszkania integer,
    IN   _dokonanie_transakcji tinyint
)
BEGIN

	INSERT INTO transakcja (
        cena,
        data_transakcji,
        id_posrednika,
        id_klienta,
        id_mieszkania,
        dokonanie_transakcji
    )
        VALUES (
        _cena,
        _data_transakcji,
        _id_posrednika,
        _id_klienta,
        _id_mieszkania,
        _dokonanie_transakcji
   );

END $$
DELIMITER ;

------------------------------------------------

DELIMITER $$
CREATE OR REPLACE FUNCTION delete_mieszkanie(
      _id_mieszkania integer
)RETURNS integer 
BEGIN
	DECLARE result integer;
    set result = 0;
    

	    SELECT COUNT(*) INTO result FROM transakcja WHERE id_klienta = _id_klienta;
        IF result = 0 THEN
            DELETE FROM klient WHERE id_klienta = _id_klienta;
            RETURN 0;
        ELSE 
            RETURN 1;
        END IF;
   

END $$
DELIMITER ;

---------------------------------------------------------


DELIMITER $$
CREATE OR REPLACE FUNCTION update_mieszkanie(
    _id_mieszkania integer,
      _id_posrednika integer,
      _cena integer,
      _imie_wlasciciela VARCHAR(50),
      _nazwisko_wlasciciela VARCHAR(50),
      _telefon_wlasciciela VARCHAR(15),
      _miasto VARCHAR(100),
      _ulica VARCHAR(250),
      _kod_pocztowy VARCHAR(20),
      _powierzchnia integer,
      _rodzaj_mieszkania VARCHAR(40),
      _opis_mieszkania VARCHAR(3000),
      _sprzedano VARCHAR(10)
)RETURNS integer 
BEGIN
	DECLARE result integer;
    set result = 0;
    
    UPDATE mieszkanie
    SET id_posrednika = _id_posrednika,
    cena = _cena,
    imie_wlasciciela = _imie_wlasciciela,
    nazwisko_wlasciciela = _nazwisko_wlasciciela,
    telefon_wlasciciela = _telefon_wlasciciela,
    miasto = _miasto,
    ulica = _ulica,
    kod_pocztowy = _kod_pocztowy,
    powierzchnia = _powierzchnia,
    rodzaj_mieszkania = _rodzaj_mieszkania,
    opis_mieszkania = _opis_mieszkania,
    sprzedano = _sprzedano
    WHERE id_mieszkania = _id_mieszkania;

    RETURN 0;

END $$
DELIMITER ;

-------------------------------------------------------

DELIMITER $$
CREATE OR REPLACE FUNCTION update_transakcja(
    _id_transakcji integer,
      _cena integer,
      _data_transakcji date,
      _id_posrednika integer,     
      _id_klienta integer,
      _id_mieszkania integer,
      _dokonanie_transakcji tinyint
)RETURNS integer 
BEGIN
	DECLARE result integer;
    set result = 0;
    
    UPDATE transakcja
    SET cena = _cena,
    data_transakcji = _data_transakcji,
    id_posrednika = _id_posrednika,
    id_klienta = _id_klienta,
    id_mieszkania = _id_mieszkania,
    dokonanie_transakcji = _dokonanie_transakcji
    WHERE id_transakcji = _id_transakcji;
    RETURN 0;

END $$
DELIMITER ;

-------------------------------------------------------