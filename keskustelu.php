<!DOCTYPE html>
<html>
    <head>
        <title>minun varashälytin</title>
    </head>
    <body style="background-color: aquamarine;">
        <?php

        $servername = "hyvis.mysql.database.azure.com";
        $username = "db_projekti";
        $password = "Sivyh2022";
        $dbname ="joona_db";

        $conn = new mysqli($servername, $username, $password, $dbname);
        if ($conn->connect_error){
            die("connection failed: " . $conn->connect_error);
        }
        $sql = "SELECT * FROM Keskustelu";
        $result = $conn->query($sql);

        while($row = $result->fetch_assoc()){
           echo "<b>".$row["nimi"].  "</b><br>" . $row["viesti"]. "<br>";
        }
        $conn->close();
        ?>
            <form action="handle.php" method="post">
                Nimi: <input type="text" name="nimi"><br>
                viesti: <textarea name="viesti"></textarea><br>
                <input type="submit">
            </form>
        
            powered by joona<br>
            <a href="http://www.salpaus.fi">Koulutuskeskus Salpaus</a>
            <a href="index.php">varashälytin</a>
            </div>
        </div> 
    </body>
</html>