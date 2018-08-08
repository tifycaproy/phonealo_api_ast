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
        <h1><?=t('Mi escritorio')?> Vrikolife <small><?=t('datos de mis gestiones')?></small></h1>
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
    <div class="row">
        <div class="col-md-12">
            <div class="portlet light">
                <div class="porlet-body">
                    <div class="row list-separated">
                        <div class="col-md-2 col-sm-2 col-xs-6">
                            <div class="font-grey-mint font-sm">
                                <?=t('Pedidos tramitados')?>:
                            </div>
                            <div class="uppercase font-hg font-red-flamingo">
                                <?=$total_pedidos; ?>
                            </div>
                        </div>
                        <div class="col-md-2 col-sm-2 col-xs-6">
                            <div class="font-grey-mint font-sm">
                                <?=t('Volumen de negocio')?>:
                            </div>
                            <div class="uppercase font-hg font-red-flamingo">
                                <?=number_format($vnegocio, 2); ?> <span class="font-lg font-grey-mint">€</span>
                            </div>
                        </div>
                        <div class="col-md-2 col-sm-2 col-xs-6">
                            <div class="font-grey-mint font-sm">
                                <?=t('Media mensual')?>:
                            </div>
                            <div class="uppercase font-hg theme-font-color">
                                <?=$media_mensual?> <span class="font-lg font-grey-mint">€</span>
                            </div>
                        </div>
                        <div class="col-md-2 col-sm-2 col-xs-6">
                            <div class="font-grey-mint font-sm">
                                <?=t('Comisiones')?> <?=date('Y')?>
                            </div>
                            <div class="uppercase font-hg font-purple">
                                <?=$total_anual_comisiones?> <span class="font-lg font-grey-mint">€</span>
                            </div>
                        </div>
                        <div class="col-md-2 col-sm-2 col-xs-6">
                            <div class="font-grey-mint font-sm">
                                <?=t('Comisiones del mes')?>
                            </div>
                            <div class="uppercase font-hg font-blue-sharp">
                                <?=$current_comision?> <span class="font-lg font-grey-mint">€</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="portlet light">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-users font-blue-sharp"></i>
                        <span class="caption-subject bold font-blue-sharp uppercase">
                            <?=t('Pedidos de mi equipo')?> </span>
                    </div>
                    <div class="actions">
                        <a href="javascript:;" class="btn btn-circle btn-default btn-icon-only fullscreen" data-original-title="" title=""></a>
                    </div>
                </div>
                <div class="portlet-body">
                    <table class="table table-striped table-hover" id="dt_pedidos_equipo"></table>
                </div>
            </div>

        </div>
        <div class="col-md-6">
            <div class="portlet light">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-users font-blue-sharp"></i>
                        <span class="caption-subject bold font-blue-sharp uppercase">
                            <?=t('Mis pedidos')?> </span>
                    </div>
                    <div class="actions">
                        <a href="javascript:;" class="btn btn-circle btn-default btn-icon-only fullscreen" data-original-title="" title=""></a>
                    </div>
                </div>
                <div class="portlet-body">
                    <table class="table table-striped table-hover" id="dt_mis_pedidos"></table>
                </div>
            </div>

        </div>

    </div>

<!-- END PAGE CONTENT-->
</div>


<?php include('theme/vk/footer.php'); ?>
