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
                    <td>Hiljaista</td>
                </tr>
                <tr>
                    <td>1</td>
                    <td>liikettä</td>
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