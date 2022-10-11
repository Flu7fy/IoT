# IoT
### 12.9.2022 projekti suunitelma
![image](https://user-images.githubusercontent.com/113332670/189598594-9897606b-a162-49f6-874a-9b8158e528d8.png)


![image](https://user-images.githubusercontent.com/113332670/189598675-5c21c430-396f-4bc1-8901-82f37b86ec59.png)
Kuva

# Ryhmätyö 
## 12.9.2022
#### ryhmä: Vilma(poissa),Sisu,Joona(minä)
- Asennettiin Rasberry pi käyttöjärjestelmä, tietokanta palvelin, php, apache ja mariaDB

- chromium kuoli ja piti ladata firefox että olisi jokin browser sovellus joka toimisi


## 15.9.2022 tietokanta 
### ryhmä: Vilma, Sisu, Joona
 - Luotiiin tietokanta MariaDB palvelimella tietokanta joona_gamestop
 - käytettiin SQL koodi kieltä
 ```
 CREATE DATABASE joona_gamestop;
//tietokannan luominen
 USE joona_gamestop
 //tietokannan käyttöön ottaminen
CREATE TABLE Joona_liike(id int AUTO_INCREMENT NOT NULL PRIMARY KEY, arvo int, bool boolean, aika datetime);
SELECT * FROM liike;
INSERT INTO joona_liike (arvo, aika) VALUES (true, now());
```

## 19.9.2022
## datan siirtäminen tietokantaan rasberrypi:n kautta
### Ryhmä: Vilma, Sisu, Joona

koodi  liike anturille
```
import RPi.GPIO as GPIO
import time
#pistää kirjaston jossa on koodia aikaa liittyen

GPIO.setmode(GPIO.BCM)
GPIO.setup(7, GPIO.IN)
#asettaa liikeanturin
try:
#kokeilee tätä koodia ensmmäisenä jos toimisi
    while True:
    #"kun on totta" niin pyörittää tätä koodia niin pitkään kun se on false
        t = time.localtime()
    #paikallinen aika
        aika = time.strftime("%H:%M:%S", t)
        /pistää kellon ajan tunnit, minuutit ja sekunnit
        if GPIO.input(7):
            print(aika, ": Liikettä")
            laittaa kellon ajan ja tekstin
            time.sleep(2)
            #tarkoittaa kuinka pitkää nukkuu kunnes pyörittää seuraavan koodin uudestaa
        else:
            print(aika, ": Ei liikettä")
            time.sleep(2)
        time.sleep(0.1)
        

except:
#jos ei toimi niin pyörittää seuraavan koodin niin pitkään kunnes linja 43 toimii
    GPIO.cleanup()
```




 ```
#tuo kirjastot 
import RPi.GPIO as GPIO
import mariadb
import time

#Asetetaan liikeanturi
GPIO.setmode(GPIO.BCM)
GPIO.setup(7, GPIO.IN)

# asetetaan muuttuja jonka tunnuksilla ohjelma löytää ja pääsee tietokantaan käsikisi
conn = mariadb.connect(user="root", password = "[salasana]", host = "localhost", database = "[tietokannan_nimi]")
cur = conn.cursor()


try:
    while True:
        #jos huomaa liikettä tallenna taulukkoon Arvo 1
        if GPIO.input(7):
            cur.execute("INSERT INTO liike(arvo, aika) VALUES (1, now())")
            conn.commit()
            time.sleep(5)
        #jos anturi ei huomaa liikettä tallenna taulukkoon Arvo 0
        else:
            cur.execute("INSERT INTO liike(arvo, aika) VALUES (0, now())")
            time.sleep(5)

#jos ei toimi tulosta virhe
except:
    print("Error")
    GPIO.cleanup()
    ```
  

t.1
A)EEPROM on muistimoduuli circuit moduulissa. tämä löytyy arduinosta
b)UART se on lyhenne sanoista: Universal asynchronous receiver and transmission tarkoittaa sarjaliikenne protokollaa, joka tapahtuu kahdella linjalla tai digitaalisella nastalla ,jotka ovat RX (nasta0) ja TX (nasta1)
Arduino sisältää USB-sarjamuuntimen, joka avulla mikro-ohjain alijärjestelmä voi olla suoraan yhteydessä tietoko neeseen (esim raspberry PI:hin)
C)I2C on yksinkertainen kaksisuuntainen ohjaus- ja tiedonsiirtoväylä jonka normaali käyttö on näytön liitinnän kyky  kertoa nimensä ja tarkkuutensa tietokoneille
B)SIP on IP-puhelinyhteyksien luonnista vastaava tietoliikenneprotokolla. jolla voidaan muodostaa puhelinyhteyksiä
D)SIP on nopeampi kuin I2C


##22.9.2022 python- tietokantatesti
### ryhmä: vilma,joona ja sisu


1.
a)SHOW DATABASES;
B)DESCRIBE joona_liike;
2.
```
```
#tuo kirjastot
import RPi.GPIO as GPIO
import mariadb
import time

#asetetaan muuttujat
salasana = "hyvasalasana"
tietokanta = "Joona_gamestop"
odotus_aika = 5

#GPIO setuppi
GPIO_input = 7
GPIO.setmode(GPIO.BCM)
GPIO.setup(GPIO_input, GPIO.IN)

#Tiekokannan tunnukset
conn = mariadb.connect(user="root", password = salasana, host = "localhost", database = tietokanta)
cur = conn.cursor()

try:
    while True:
        #arvo on anturin tulos 
        arvo = GPIO.setup(GPIO_input, GPIO.IN)
        #mysql stirng on komento joka tallentaa tiedon tietokantaan
        mysqlstr = f"INSERT INTO liike(arvo, aika) VALUES (arvo, now())"
        cur.execute(mysqlstr)
        conn.commit()
        #odota määritetty aika
        time.sleep(odotus_aika)
#virhe ilmoittaa virheen
except:
    print("Error")
    GPIO.cleanup()
    
```
# 22.9.2022
## php ja html koodaamista jotta saadaan sivusto tehtyä
### ryhmä: Vilma, Joona, Sisu
```
<!DOCTYPE html>
<html>
    <head>
        <title>minun varashälytin</title>
    </head>
    <body style="background-color: aquamarine;">
        <?php

        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname ="joona_gamestop";

        $conn = new mysqli($servername, $username, $password, $dbname);
        if ($conn->connect_error){
            die("connection failed: " . $conn->connect_error);
        }
        $sql = "SELECT id, arvo FROM joona_liike";
        $result = $conn->query($sql);

        while($row = $result->fetch_assoc()){
           echo $row["id"].  "Arvo:".$row["arvo"]. "<br>";
        }
        $conn->close();
        ?>
        <div style="border:1px solid black;text-align: center;">
        <h1><img src="images/pingviini.png
            " width="80px" height="80px">Joonan varashälytin</h1>
            <table width="50%" style="margin:auto;border:1px solid black;">
                <tr>
                    <th>Id</th>
                    <th>arvo</th>
                </tr>
                <tr>
                    <td>0</td>
                    <td>liikettä</td>
                </tr>
                <tr>
                    <td>1</td>
                    <td>Hiljaista</td>
                </tr>
                </table>
                <br>
                <div>
            powered by joona<br>
            <a href="http://www.salpaus.fi">Koulutuskeskus Salpaus</a>
            </div>
        </div> 
    </body>
</html>
```
CREATE TABLE Keskustelu (id int primary key auto_increment, nimi varchar(50),viesti varchar(1000))
