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



WIP
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
