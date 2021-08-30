<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>SNMP</title>

    <link rel="stylesheet" href="vistas/css/estilo.css">
</head>
<body>
    <div id="main-container">

        <table border=1 style="border-collapse:collapse">
        <th colspan=4 style="text-align:center"> MONITOREO DE EQUIPOS DE TI</th>
        </table>

        <table style="text-align:center">
            <thead>
                <tr>
                    <th>#</th><th>IP/URL</th><th>ESTADO</th><th>DESCRIPCIÓN</th>
                </tr>
            </thead>

           
        </table>

        <?php
        $iplist = array
        (
            array("192.168.1.12","PC_01"),
            array("192.168.1.87","VM_01"),
            array("192.168.1.36","Smarthphone_01"),
            array("192.168.1.82","Impresora_01"),
            array("192.168.1.41","SmartTV_01"),
            array("192.168.1.1","Router")
            //array()
        );
        $i = count($iplist);
        $results = [];

        for($j=0;$j<$i;$j++){
            $ip = $iplist[$j][0];
            $ping = exec("ping -n 1 $ip", $output, $status);
            $results[] = $status;
        }
        //Table
        echo '<font face=Courier New>';
        echo "<table border=1 style=border-collapse:collapse>
        <th colspan=4> Pin Monitoring </th>
        <tr>
        <td align=right width=20>#</td>
        <td width=100>IP/URL</td>
        <td width=100>Estado</td>
        <td width=250>Descripción</td>
        </tr>";
        foreach($results as $item =>$k){
            echo '<tr>';
            echo '<td align=right>'.$item.'</td>';
            echo '<td>'.$iplist[$item][0].'</td>';
            if($results[$item]==0){
                echo '<td style=color:green>En línea</td>';
            }
            else{
                echo '<td style=color:red>Desconectado</td>';
            }
            echo '<td>'.$iplist[$item][1].'</td>';
            echo '</tr>';
        }
        echo "</table>";
        echo '</font>';
        echo header("refresh: 5");
        ?>
    </div>
</body>
</html>