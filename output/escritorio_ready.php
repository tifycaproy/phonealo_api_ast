<?php
include('theme/vk/header.php');
?>
<div class="page-content">
<!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->
<div class="modal fade" id="portlet-config" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Modal title</h4>
            </div>
            <div class="modal-body">
Widget settings form goes here
</div>
            <div class="modal-footer">
                <button type="button" class="btn blue">Save changes</button>
                <button type="button" class="btn default" data-dismiss="modal">Close</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<!-- END SAMPLE PORTLET CONFIGURATION MODAL FORM-->
<!-- BEGIN PAGE HEADER-->
<!-- BEGIN PAGE HEAD -->
<div class="page-head">
    <!-- BEGIN PAGE TITLE -->
    <div class="page-title">
        <h1>Mi escritorio Vrikolife <small></small></h1>
    </div>
    <!-- END PAGE TITLE -->
    <!-- BEGIN PAGE TOOLBAR -->
    <div class="page-toolbar">

    </div>
    <!-- END PAGE TOOLBAR -->
</div>
<!-- END PAGE HEAD -->
<!-- BEGIN PAGE BREADCRUMB -->

<!-- END PAGE BREADCRUMB -->
<!-- END PAGE HEADER-->
<!-- BEGIN PAGE CONTENT-->
<div class="row margin-top-10">
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="dashboard-stat2">
            <div class="display">
                <div class="number">
                    <h3 class="font-green-sharp">7800<small class="font-green-sharp">€</small></h3>
                    <small>VENTAS TOTALES</small>
                </div>
                <div class="icon">
                    <i class="icon-pie-chart"></i>
                </div>
            </div>
            <div class="progress-info">
                <div class="progress">
								<span class="progress-bar progress-bar-success green-sharp" style="width: 76%;">
								<span class="sr-only">76% Objetivo</span>
								</span>
                </div>
                <div class="status">
                    <div class="status-title">
                        Objetivo
                    </div>
                    <div class="status-number">
                        76%
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="dashboard-stat2">
            <div class="display">
                <div class="number">
                    <h3 class="font-red-haze">1349</h3>
                    <small>Puntos totales</small>
                </div>
                <div class="icon">
                    <i class="icon-like"></i>
                </div>
            </div>
            <div class="progress-info">
                <div class="progress">
								<span class="progress-bar progress-bar-success red-haze" style="width: 85%;">
								<span class="sr-only">85% objetivo</span>
								</span>
                </div>
                <div class="status">
                    <div class="status-title">
                        objetivo
                    </div>
                    <div class="status-number">
                        85%
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="dashboard-stat2">
            <div class="display">
                <div class="number">
                    <h3 class="font-blue-sharp">567</h3>
                    <small>Pedidos del período</small>
                </div>
                <div class="icon">
                    <i class="icon-basket"></i>
                </div>
            </div>
            <div class="progress-info">
                <div class="progress">
								<span class="progress-bar progress-bar-success blue-sharp" style="width: 45%;">
								<span class="sr-only">45% objetivo</span>
								</span>
                </div>
                <div class="status">
                    <div class="status-title">
                        objetivo
                    </div>
                    <div class="status-number">
                        45%
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="dashboard-stat2">
            <div class="display">
                <div class="number">
                    <h3 class="font-purple-soft">276</h3>
                    <small>nuevos clientes</small>
                </div>
                <div class="icon">
                    <i class="icon-user"></i>
                </div>
            </div>
            <div class="progress-info">
                <div class="progress">
								<span class="progress-bar progress-bar-success purple-soft" style="width: 96%;">
								<span class="sr-only">96% change</span>
								</span>
                </div>
                <div class="status">
                    <div class="status-title">
                        objetivo 399
                    </div>
                    <div class="status-number">
                        57%
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6 col-sm-12">
        <!-- BEGIN PORTLET-->
        <div class="portlet light ">
            <div class="portlet-title">
                <div class="caption caption-md">
                    <i class="icon-bar-chart theme-font-color hide"></i>
                    <span class="caption-subject theme-font-color bold uppercase">Actividad de mi equipo</span>
                    <span class="caption-helper hide">weekly stats...</span>
                </div>
                <div class="actions">
                    <div data-toggle="buttons" class="btn-group btn-group-devided">
                        <label class="btn btn-transparent grey-salsa btn-circle btn-sm active">
                            <input type="radio" id="option1" class="toggle" name="options">Hoy</label>
                        <label class="btn btn-transparent grey-salsa btn-circle btn-sm">
                            <input type="radio" id="option2" class="toggle" name="options">Semana</label>
                        <label class="btn btn-transparent grey-salsa btn-circle btn-sm">
                            <input type="radio" id="option2" class="toggle" name="options">Mes</label>
                    </div>
                </div>
            </div>
            <div class="portlet-body">
                <div class="row number-stats margin-bottom-30">
                    <div class="col-md-6 col-sm-6 col-xs-6">
                        <div class="stat-left">
                            <div class="stat-chart">
                                <!-- do not line break "sparkline_bar" div. sparkline chart has an issue when the container div has line break -->
                                <div id="sparkline_bar">
                                </div>
                            </div>
                            <div class="stat-number">
                                <div class="title">
                                    Total
                                </div>
                                <div class="number">
                                    2460
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-6">
                        <div class="stat-right">
                            <div class="stat-chart">
                                <!-- do not line break "sparkline_bar" div. sparkline chart has an issue when the container div has line break -->
                                <div id="sparkline_bar2">
                                </div>
                            </div>
                            <div class="stat-number">
                                <div class="title">
                                    New
                                </div>
                                <div class="number">
                                    719
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="table-scrollable table-scrollable-borderless">
                    <table class="table table-hover table-light">
                        <thead>
                        <tr class="uppercase">
                            <th colspan="2">
                                Nombre
                            </th>
                            <th>
                                Ventas
                            </th>
                            <th>
                                Puntos
                            </th>
                            <th>
                                Mi beneficio
                            </th>
                            <th>
                                Mi comisión
                            </th>
                        </tr>
                        </thead>
                        <tbody><tr>
                            <td class="fit">
                                Tomas
                            </td>
                            <td>
                                De la cruz
                            </td>
                            <td>
                                345.00
                            </td>
                            <td>
                                45
                            </td>
                            <td>
                                124
                            </td>
                            <td>
                                <span class="bold theme-font-color">80%</span>
                            </td>
                        </tr>
                        <tr>
                            <td class="fit">
                                Santiago
                            </td>
                            <td>
                                Del Mazo
                            </td>
                            <td>
                                560.33
                            </td>
                            <td>
                                12
                            </td>
                            <td>
                                24
                            </td>
                            <td>
                                <span class="bold theme-font-color">67%</span>
                            </td>
                        </tr>
                        <tr>
                            <td class="fit">
                                Hoteles
                            </td>
                            <td>
                                Sovalsa SA
                            </td>
                            <td>
                                1,345.67
                            </td>
                            <td>
                                450
                            </td>
                            <td>
                                46
                            </td>
                            <td>
                                <span class="bold theme-font-color">98%</span>
                            </td>
                        </tr>
                        <tr>
                            <td class="fit">
                                Jose Felix
                            </td>
                            <td>
                                Escudero
                            </td>
                            <td>
                                645.22
                            </td>
                            <td>
                                50
                            </td>
                            <td>
                                89
                            </td>
                            <td>
                                <span class="bold theme-font-color">58%</span>
                            </td>
                        </tr>
                        </tbody></table>
                </div>
            </div>
        </div>
        <!-- END PORTLET-->
    </div>
</div>


<!-- END PAGE CONTENT-->
</div>


<?php include('theme/vk/footer.php'); ?>
