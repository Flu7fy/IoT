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

## 19.9.2022 datan siirtäminen tietokantaan rasberrypi:n kautta
### Ryhmä: Vilma, Sisu, Joona
```
import time
// pistää kirjaston jossa on koodia aikaa liittyen
while true:
//"kun on totta" niin pyörittää tätä koodia niin pitkään kun se on false
    try:
//kokeilee tätä koodia ensmmäisenä jos toimisi
       time.sleep(5)
// tarkoittaa kuinka pitkää nukkuu kunnes pyörittää seuraavan koodin uudestaa
       print("toimii")
    execpt:
// jos ei toimi niin pyörittää seuraavan koodin niin pitkään kunnes linja 37 toimii
        print("Ei toimi...")
```
