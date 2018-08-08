<!DOCTYPE html>
<html>
<head>
    <title></title>
</head>
<body>
    <?php if ($strform != ''): ?>
        <textarea cols="150" rows="30"><?php echo htmlentities($strform); ?></textarea>
    <?php endif; ?>
    <form action="gform" method="post">
        <div>
            <input type="submit" value="Generar form">
            <a href="<?php echo path('gform'); ?>">Inicio</a>
        </div>
        <div>
            Tabla: <input type="text" name="tabla" required value="<?php echo $tdata['tabla']; ?>">
        </div>
        <?php if (count($tinfo)): ?>
        <div>
            Prefijo: <input type="text" name="prefijo" required value="<?php echo $tdata['prefijo']; ?>">
        </div>
        <div>
            Variable PHP de Valores: <input type="text" name="phpvar" required value="<?php echo $tdata['phpvar']; ?>">
        </div>
        <div>
            Form Horizontal?:<select name="formh"><option value="S">Si</option><option value="N">No</option></select>
        </div>
        <div>
            Número de columnas: <input type="text" name="ncols" required value="<?php echo $tdata['ncols']; ?>">
        </div>
        <div>

            <table>
                <tr>
                    <td>Campo</td><td>Etiqueta</td><td>Placeholder</td>
                </tr>
                <?php foreach ($tinfo as $i => $field): ?>
                    <tr>
                    <td><input type="text" name="field[]" value="<?php echo $field['Field']; ?>"></td>
                    <td><input type="text" name="label[]" value="<?php echo $tdata['label'][$i]; ?>"></td>
                    <td><input type="text" name="placeholder[]" value="<?php echo $tdata['placeholder'][$i]; ?>"></td>
                    </tr>
                <?php endforeach; ?>

            </table>

        </div>
        <?php endif; ?>



    </form>

</body>
</html>