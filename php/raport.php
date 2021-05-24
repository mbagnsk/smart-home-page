<?php
    $db = mysqli_connect('localhost','root','password','projekt_zespolowy')
    or die('Error connecting to MySQL server.');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <table align="center" border="1px" style="line-height: 30px;">
        <tr>
            <th colspan="7">
                <h2>Aktualne wyniki</h2>
            </th>
        </tr>
        <t>
            <th>Czas pomiaru</th>
            <th>Strefa czasowa</th>
            <th>ID urządzenia</th>
            <th>ID kanału</th>
            <th>Pomiar</th>
            <th>Jednostki</th>
            <th>Typ pomiaru</th>
        </t>

        <?php
            $query_last_temperature = "SELECT * FROM measurements WHERE measurement_type = 'temperature' ORDER BY ID DESC LIMIT 1;";
            $result = mysqli_query($db, $query_last_temperature);
            $row = mysqli_fetch_array($result);
        ?>
            <tr>
                <td><?php echo $row['datetime'] ?></td>
                <td><?php echo $row['timezone'] ?></td>
                <td><?php echo $row['id_device'] ?></td>
                <td><?php echo $row['id_channel'] ?></td>
                <td><?php echo $row['measurement'] ?></td>
                <td><?php echo $row['measurement_units'] ?></td>
                <td><?php echo $row['measurement_type'] ?></td>
            </tr>

        <?php
            $query_last_alarm = "SELECT * FROM measurements WHERE measurement_type = 'alarm' ORDER BY ID DESC LIMIT 1;";
            $result = mysqli_query($db, $query_last_alarm);
            $row = mysqli_fetch_array($result);
        ?>
            <tr>
                <td><?php echo $row['datetime'] ?></td>
                <td><?php echo $row['timezone'] ?></td>
                <td><?php echo $row['id_device'] ?></td>
                <td><?php echo $row['id_channel'] ?></td>
                <td><?php echo $row['measurement'] ?></td>
                <td><?php echo $row['measurement_units'] ?></td>
                <td><?php echo $row['measurement_type'] ?></td>
            </tr>

        <?php
        $query_last_lighting = "SELECT * FROM measurements WHERE measurement_type = 'lighting' ORDER BY ID DESC LIMIT 1;";
        $result = mysqli_query($db, $query_last_lighting);
        $row = mysqli_fetch_array($result);
        ?>
            <tr>
                <td><?php echo $row['datetime'] ?></td>
                <td><?php echo $row['timezone'] ?></td>
                <td><?php echo $row['id_device'] ?></td>
                <td><?php echo $row['id_channel'] ?></td>
                <td><?php echo $row['measurement'] ?></td>
                <td><?php echo $row['measurement_units'] ?></td>
                <td><?php echo $row['measurement_type'] ?></td>
            </tr>
            
    </table>

    <table align="center" border="1px" style="line-height: 30px;">
        <tr>
            <th colspan="7">
                <h2>Ostatnie pomiary temperatury</h2>
            </th>
        </tr>
        <t>
            <th>Czas pomiaru</th>
            <th>Strefa czasowa</th>
            <th>ID urządzenia</th>
            <th>ID kanału</th>
            <th>Pomiar</th>
            <th>Jednostki</th>
            <th>Typ pomiaru</th>
        </t>

        <?php
            $query_lastTen_temperature = "SELECT * FROM measurements WHERE measurement_type = 'temperature' ORDER BY ID DESC LIMIT 10;";
            $result = mysqli_query($db, $query_lastTen_temperature);
            while($row = mysqli_fetch_assoc($result)) 
            {
        ?>
            <tr>
                <td><?php echo $row['datetime']; ?></td>
                <td><?php echo $row['timezone']; ?></td>
                <td><?php echo $row['id_device']; ?></td>
                <td><?php echo $row['id_channel']; ?></td>
                <td><?php echo $row['measurement']; ?></td>
                <td><?php echo $row['measurement_units']; ?></td>
                <td><?php echo $row['measurement_type']; ?></td>
            </tr>
        <?php 
            } 
        ?>

        <?php
            $query_lastTen_temperature = "SELECT AVG(measurement)
            FROM measurements
            WHERE measurement_type = 'temperature'
            ORDER BY ID DESC
            LIMIT 10;";
            $result = mysqli_query($db, $query_lastTen_temperature);
            $row = mysqli_fetch_assoc($result)
        ?>

            <tr>
                <td><?php echo '' ?></td>
                <td><?php echo '' ?></td>
                <td><?php echo '' ?></td>
                <td><?php echo 'średnia' ?></td>
                <td><?php echo $row['AVG(measurement)'] ?></td>
                <td><?php echo 'C' ?></td>
                <td><?php echo '' ?></td>
            </tr>
    </table>

    <table align="center" border="1px" style="line-height: 30px;">
        <tr>
            <th colspan="7">
                <h2>Czas ostatniego alarmu</h2>
            </th>
        </tr>
        <t>
            <th>Czas pomiaru</th>
            <th>Strefa czasowa</th>
            <th>ID urządzenia</th>
            <th>ID kanału</th>
            <th>Pomiar</th>
            <th>Jednostki</th>
            <th>Typ pomiaru</th>
        </t>
        <?php
            $query_last_alarm = "SELECT * FROM measurements WHERE measurement_type = 'alarm' and measurement = 1 ORDER BY ID DESC LIMIT 1;";
            $result = mysqli_query($db, $query_last_alarm);
            $row = mysqli_fetch_array($result);
        ?>
            <tr>
                <td><?php echo $row['datetime'] ?></td>
                <td><?php echo $row['timezone'] ?></td>
                <td><?php echo $row['id_device'] ?></td>
                <td><?php echo $row['id_channel'] ?></td>
                <td><?php echo $row['measurement'] ?></td>
                <td><?php echo $row['measurement_units'] ?></td>
                <td><?php echo $row['measurement_type'] ?></td>
            </tr>
    </table>
    
    
    <?php
    mysqli_close($db);
    ?>
</body>
</html>