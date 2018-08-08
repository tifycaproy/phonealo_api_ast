<html>
<head>
    <?php if ($pedi_cod > 0 ) : ?>
        <script type="text/javascript">
            setTimeout("location.href = 'do_com?pedi=<?php echo $pedi_cod;?>';",600);
        </script>
    <?php endif; ?>
</head>
<body >
<?php
if ($proy_nid>0) echo "doing... ".$proy_nid;
else echo "Done";
?>
</body>
</html>