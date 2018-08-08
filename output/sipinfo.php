<html>

<style type="text/css">
    table {
        width: 650px;
    }
</style>
<body>
<?php
echo '<h4>Ultima hora</h4>';
echo $table1h->print_table();

echo '<h4>Ultimas 6 horas</h4>';
echo $table6h->print_table();

echo '<h4>Dia de hoy</h4>';
echo $table0h->print_table();

?>
<h4>Saldos de proveedores</h4>
<table>
    <tr>
        <td>TELECO 3</td>
        <td><?php echo $saldoTeleco3; ?></td>
    </tr>
</table>
</body>
</html>

