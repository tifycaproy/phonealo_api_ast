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
        <h1>Baciocas Datatables <small>basic datatable samples</small></h1>
    </div>
    <!-- END PAGE TITLE -->
    <!-- BEGIN PAGE TOOLBAR -->
    <div class="page-toolbar">
        <!-- BEGIN THEME PANEL -->
        <div class="btn-group btn-theme-panel">
            <a href="javascript:;" class="btn dropdown-toggle" data-toggle="dropdown">
                <i class="icon-settings"></i>
            </a>
            <div class="dropdown-menu theme-panel pull-right dropdown-custom hold-on-click">
                <div class="row">
                    <div class="col-md-4 col-sm-4 col-xs-12">
                        <h3>THEME</h3>
                        <ul class="theme-colors">
                            <li class="theme-color theme-color-default active" data-theme="default">
                                <span class="theme-color-view"></span>
                                <span class="theme-color-name">Dark Header</span>
                            </li>
                            <li class="theme-color theme-color-light" data-theme="light">
                                <span class="theme-color-view"></span>
                                <span class="theme-color-name">Light Header</span>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-8 col-sm-8 col-xs-12 seperator">
                        <h3>LAYOUT</h3>
                        <ul class="theme-settings">
                            <li>
Theme Style
<select class="layout-style-option form-control input-small input-sm">
                                    <option value="square" selected="selected">Square corners</option>
                                    <option value="rounded">Rounded corners</option>
                                </select>
                            </li>
                            <li>
Layout
                                <select class="layout-option form-control input-small input-sm">
                                    <option value="fluid" selected="selected">Fluid</option>
                                    <option value="boxed">Boxed</option>
                                </select>
                            </li>
                            <li>
Header
                                <select class="page-header-option form-control input-small input-sm">
                                    <option value="fixed" selected="selected">Fixed</option>
                                    <option value="default">Default</option>
                                </select>
                            </li>
                            <li>
Top Dropdowns
<select class="page-header-top-dropdown-style-option form-control input-small input-sm">
                                    <option value="light">Light</option>
                                    <option value="dark" selected="selected">Dark</option>
                                </select>
                            </li>
                            <li>
Sidebar Mode
<select class="sidebar-option form-control input-small input-sm">
                                    <option value="fixed">Fixed</option>
                                    <option value="default" selected="selected">Default</option>
                                </select>
                            </li>
                            <li>
Sidebar Menu
<select class="sidebar-menu-option form-control input-small input-sm">
                                    <option value="accordion" selected="selected">Accordion</option>
                                    <option value="hover">Hover</option>
                                </select>
                            </li>
                            <li>
Sidebar Position
<select class="sidebar-pos-option form-control input-small input-sm">
                                    <option value="left" selected="selected">Left</option>
                                    <option value="right">Right</option>
                                </select>
                            </li>
                            <li>
Footer
                                <select class="page-footer-option form-control input-small input-sm">
                                    <option value="fixed">Fixed</option>
                                    <option value="default" selected="selected">Default</option>
                                </select>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- END THEME PANEL -->
    </div>
    <!-- END PAGE TOOLBAR -->
</div>
<!-- END PAGE HEAD -->
<!-- BEGIN PAGE BREADCRUMB -->
<ul class="page-breadcrumb breadcrumb">
    <li>
        <a href="index.html">Home</a>
        <i class="fa fa-circle"></i>
    </li>
    <li>
        <a href="#">Data Tables</a>
        <i class="fa fa-circle"></i>
    </li>
    <li>
        <a href="#">Basic Datatables</a>
    </li>
</ul>
<!-- END PAGE BREADCRUMB -->
<!-- END PAGE HEADER-->
<!-- BEGIN PAGE CONTENT-->
<div class="row">
<div class="col-md-6">
    <!-- BEGIN SAMPLE TABLE PORTLET-->
    <div class="portlet box red">
        <div class="portlet-title">
            <div class="caption">
                <i class="fa fa-cogs"></i>Simple Table
</div>
            <div class="tools">
                <a href="javascript:;" class="collapse">
                </a>
                <a href="#portlet-config" data-toggle="modal" class="config">
                </a>
                <a href="javascript:;" class="reload">
                </a>
                <a href="javascript:;" class="remove">
                </a>
            </div>
        </div>
        <div class="portlet-body">
            <div class="table-scrollable">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th>
                            #
                        </th>
                        <th>
First Name
</th>
                        <th>
Last Name
</th>
                        <th>
Username
                        </th>
                        <th>
Status
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>
1
                        </td>
                        <td>
Mark
                        </td>
                        <td>
Otto
                        </td>
                        <td>
makr124
                        </td>
                        <td>
										<span class="label label-sm label-success">
Approved </span>
                        </td>
                    </tr>
                    <tr>
                        <td>
2
                        </td>
                        <td>
Jacob
                        </td>
                        <td>
Nilson
                        </td>
                        <td>
jac123
                        </td>
                        <td>
										<span class="label label-sm label-info">
Pending </span>
                        </td>
                    </tr>
                    <tr>
                        <td>
3
                        </td>
                        <td>
Larry
                        </td>
                        <td>
Cooper
                        </td>
                        <td>
lar
                        </td>
                        <td>
										<span class="label label-sm label-warning">
Suspended </span>
                        </td>
                    </tr>
                    <tr>
                        <td>
4
                        </td>
                        <td>
Sandy
                        </td>
                        <td>
Lim
                        </td>
                        <td>
sanlim
                        </td>
                        <td>
										<span class="label label-sm label-danger">
Blocked </span>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- END SAMPLE TABLE PORTLET-->
</div>
<div class="col-md-6">
    <!-- BEGIN BORDERED TABLE PORTLET-->
    <div class="portlet box yellow">
        <div class="portlet-title">
            <div class="caption">
                <i class="fa fa-coffee"></i>Bordered Table
</div>
            <div class="tools">
                <a href="javascript:;" class="collapse">
                </a>
                <a href="#portlet-config" data-toggle="modal" class="config">
                </a>
                <a href="javascript:;" class="reload">
                </a>
                <a href="javascript:;" class="remove">
                </a>
            </div>
        </div>
        <div class="portlet-body">
            <div class="table-scrollable">
                <table class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th>
                            #
                        </th>
                        <th>
First Name
</th>
                        <th>
Last Name
</th>
                        <th>
Username
                        </th>
                        <th>
Status
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td rowspan="2">
    1
                        </td>
                        <td>
Mark
                        </td>
                        <td>
Otto
                        </td>
                        <td>
makr124
                        </td>
                        <td>
										<span class="label label-sm label-success">
Approved </span>
                        </td>
                    </tr>
                    <tr>
                        <td>
Jacob
                        </td>
                        <td>
Nilson
                        </td>
                        <td>
jac123
                        </td>
                        <td>
										<span class="label label-sm label-info">
Pending </span>
                        </td>
                    </tr>
                    <tr>
                        <td>
2
                        </td>
                        <td>
Larry
                        </td>
                        <td>
Cooper
                        </td>
                        <td>
lar
                        </td>
                        <td>
										<span class="label label-sm label-warning">
Suspended </span>
                        </td>
                    </tr>
                    <tr>
                        <td>
3
                        </td>
                        <td>
Sandy
                        </td>
                        <td>
Lim
                        </td>
                        <td>
sanlim
                        </td>
                        <td>
										<span class="label label-sm label-danger">
Blocked </span>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- END BORDERED TABLE PORTLET-->
</div>
</div>
<div class="row">
<div class="col-md-6">
    <!-- BEGIN SAMPLE TABLE PORTLET-->
    <div class="portlet box purple">
        <div class="portlet-title">
            <div class="caption">
                <i class="fa fa-comments"></i>Striped Table
</div>
            <div class="tools">
                <a href="javascript:;" class="collapse">
                </a>
                <a href="#portlet-config" data-toggle="modal" class="config">
                </a>
                <a href="javascript:;" class="reload">
                </a>
                <a href="javascript:;" class="remove">
                </a>
            </div>
        </div>
        <div class="portlet-body">
            <div class="table-scrollable">
                <table class="table table-striped table-hover">
                    <thead>
                    <tr>
                        <th>
                            #
                        </th>
                        <th>
First Name
</th>
                        <th>
Last Name
</th>
                        <th>
Username
                        </th>
                        <th>
Status
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>
1
                        </td>
                        <td>
Mark
                        </td>
                        <td>
Otto
                        </td>
                        <td>
makr124
                        </td>
                        <td>
										<span class="label label-sm label-success">
Approved </span>
                        </td>
                    </tr>
                    <tr>
                        <td>
2
                        </td>
                        <td>
Jacob
                        </td>
                        <td>
Nilson
                        </td>
                        <td>
jac123
                        </td>
                        <td>
										<span class="label label-sm label-info">
Pending </span>
                        </td>
                    </tr>
                    <tr>
                        <td>
3
                        </td>
                        <td>
Larry
                        </td>
                        <td>
Cooper
                        </td>
                        <td>
lar
                        </td>
                        <td>
										<span class="label label-sm label-warning">
Suspended </span>
                        </td>
                    </tr>
                    <tr>
                        <td>
4
                        </td>
                        <td>
Sandy
                        </td>
                        <td>
Lim
                        </td>
                        <td>
sanlim
                        </td>
                        <td>
										<span class="label label-sm label-danger">
Blocked </span>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- END SAMPLE TABLE PORTLET-->
</div>
<div class="col-md-6">
    <!-- BEGIN CONDENSED TABLE PORTLET-->
    <div class="portlet box green">
        <div class="portlet-title">
            <div class="caption">
                <i class="fa fa-picture"></i>Condensed Table
</div>
            <div class="tools">
                <a href="javascript:;" class="collapse">
                </a>
                <a href="#portlet-config" data-toggle="modal" class="config">
                </a>
                <a href="javascript:;" class="reload">
                </a>
                <a href="javascript:;" class="remove">
                </a>
            </div>
        </div>
        <div class="portlet-body">
            <div class="table-scrollable">
                <table class="table table-condensed table-hover">
                    <thead>
                    <tr>
                        <th>
                            #
                        </th>
                        <th>
First Name
</th>
                        <th>
Last Name
</th>
                        <th>
Username
                        </th>
                        <th>
Status
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>
1
                        </td>
                        <td>
Mark
                        </td>
                        <td>
Otto
                        </td>
                        <td>
makr124
                        </td>
                        <td>
										<span class="label label-sm label-success">
Approved </span>
                        </td>
                    </tr>
                    <tr>
                        <td>
2
                        </td>
                        <td>
Jacob
                        </td>
                        <td>
Nilson
                        </td>
                        <td>
jac123
                        </td>
                        <td>
										<span class="label label-sm label-info">
Pending </span>
                        </td>
                    </tr>
                    <tr>
                        <td>
3
                        </td>
                        <td>
Larry
                        </td>
                        <td>
Cooper
                        </td>
                        <td>
lar
                        </td>
                        <td>
										<span class="label label-sm label-warning">
Suspended </span>
                        </td>
                    </tr>
                    <tr>
                        <td>
4
                        </td>
                        <td>
Sandy
                        </td>
                        <td>
Lim
                        </td>
                        <td>
sanlim
                        </td>
                        <td>
										<span class="label label-sm label-danger">
Blocked </span>
                        </td>
                    </tr>
                    <tr>
                        <td>
5
                        </td>
                        <td>
Sandy
                        </td>
                        <td>
Lim
                        </td>
                        <td>
sanlim
                        </td>
                        <td>
										<span class="label label-sm label-danger">
Blocked </span>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- END CONDENSED TABLE PORTLET-->
</div>
</div>
<div class="row">
<div class="col-md-6">
    <!-- BEGIN SAMPLE TABLE PORTLET-->
    <div class="portlet box blue">
        <div class="portlet-title">
            <div class="caption">
                <i class="fa fa-comments"></i>Contextual Rows
</div>
            <div class="tools">
                <a href="javascript:;" class="collapse">
                </a>
                <a href="#portlet-config" data-toggle="modal" class="config">
                </a>
                <a href="javascript:;" class="reload">
                </a>
                <a href="javascript:;" class="remove">
                </a>
            </div>
        </div>
        <div class="portlet-body">
            <div class="table-scrollable">
                <table class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th>
                            #
                        </th>
                        <th>
                            Class Name
                        </th>
                        <th>
Column
                        </th>
                        <th>
Column
                        </th>
                        <th>
Column
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr class="active">
                        <td>
1
                        </td>
                        <td>
active
                        </td>
                        <td>
Column heading
</td>
                        <td>
Column heading
</td>
                        <td>
Column heading
</td>
                    </tr>
                    <tr class="success">
                        <td>
2
                        </td>
                        <td>
success
                        </td>
                        <td>
Column heading
</td>
                        <td>
Column heading
</td>
                        <td>
Column heading
</td>
                    </tr>
                    <tr class="warning">
                        <td>
3
                        </td>
                        <td>
warning
                        </td>
                        <td>
Column heading
</td>
                        <td>
Column heading
</td>
                        <td>
Column heading
</td>
                    </tr>
                    <tr class="danger">
                        <td>
4
                        </td>
                        <td>
danger
                        </td>
                        <td>
Column heading
</td>
                        <td>
Column heading
</td>
                        <td>
Column heading
</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- END SAMPLE TABLE PORTLET-->
</div>
<div class="col-md-6">
    <!-- BEGIN SAMPLE TABLE PORTLET-->
    <div class="portlet box red">
        <div class="portlet-title">
            <div class="caption">
                <i class="fa fa-comments"></i>Contextual Columns
</div>
            <div class="tools">
                <a href="javascript:;" class="collapse">
                </a>
                <a href="#portlet-config" data-toggle="modal" class="config">
                </a>
                <a href="javascript:;" class="reload">
                </a>
                <a href="javascript:;" class="remove">
                </a>
            </div>
        </div>
        <div class="portlet-body">
            <div class="table-scrollable">
                <table class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th>
                            #
                        </th>
                        <th>
Column
                        </th>
                        <th>
Column
                        </th>
                        <th>
Column
                        </th>
                        <th>
Column
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>
1
                        </td>
                        <td class="active">
active
                        </td>
                        <td class="success">
success
                        </td>
                        <td class="warning">
warning
                        </td>
                        <td class="danger">
danger
                        </td>
                    </tr>
                    <tr>
                        <td>
2
                        </td>
                        <td class="active">
active
                        </td>
                        <td class="success">
success
                        </td>
                        <td class="warning">
warning
                        </td>
                        <td class="danger">
danger
                        </td>
                    </tr>
                    <tr>
                        <td>
3
                        </td>
                        <td class="active">
active
                        </td>
                        <td class="success">
success
                        </td>
                        <td class="warning">
warning
                        </td>
                        <td class="danger">
danger
                        </td>
                    </tr>
                    <tr>
                        <td>
4
                        </td>
                        <td class="active">
active
                        </td>
                        <td class="success">
success
                        </td>
                        <td class="warning">
warning
                        </td>
                        <td class="danger">
danger
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- END SAMPLE TABLE PORTLET-->
</div>
</div>
<div class="row">
<div class="col-md-6">
    <!-- BEGIN SAMPLE TABLE PORTLET-->
    <div class="portlet">
        <div class="portlet-title">
            <div class="caption">
                <i class="fa fa-bell-o"></i>Advance Table
</div>
            <div class="tools">
                <a href="javascript:;" class="collapse">
                </a>
                <a href="#portlet-config" data-toggle="modal" class="config">
                </a>
                <a href="javascript:;" class="reload">
                </a>
                <a href="javascript:;" class="remove">
                </a>
            </div>
        </div>
        <div class="portlet-body">
            <div class="table-scrollable">
                <table class="table table-striped table-bordered table-advance table-hover">
                    <thead>
                    <tr>
                        <th>
                            <i class="fa fa-briefcase"></i> Company
                        </th>
                        <th class="hidden-xs">
                            <i class="fa fa-user"></i> Contact
                        </th>
                        <th>
                            <i class="fa fa-shopping-cart"></i> Total
                        </th>
                        <th>
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td class="highlight">
                            <div class="success">
                            </div>
                            <a href="#">
    RedBull </a>
                        </td>
                        <td class="hidden-xs">
Mike Nilson
</td>
                        <td>
2560.60$
                        </td>
                        <td>
                            <a href="#" class="btn default btn-xs purple">
                                <i class="fa fa-edit"></i> Edit </a>
                        </td>
                    </tr>
                    <tr>
                        <td class="highlight">
                            <div class="info">
                            </div>
                            <a href="#">
    Google </a>
                        </td>
                        <td class="hidden-xs">
Adam Larson
</td>
                        <td>
560.60$
                        </td>
                        <td>
                            <a href="#" class="btn default btn-xs black">
                                <i class="fa fa-trash-o"></i> Delete </a>
                        </td>
                    </tr>
                    <tr>
                        <td class="highlight">
                            <div class="success">
                            </div>
                            <a href="#">
    Apple </a>
                        </td>
                        <td class="hidden-xs">
Daniel Kim
</td>
                        <td>
3460.60$
                        </td>
                        <td>
                            <a href="#" class="btn default btn-xs purple">
                                <i class="fa fa-edit"></i> Edit </a>
                        </td>
                    </tr>
                    <tr>
                        <td class="highlight">
                            <div class="warning">
                            </div>
                            <a href="#">
    Microsoft </a>
                        </td>
                        <td class="hidden-xs">
Nick
                        </td>
                        <td>
2560.60$
                        </td>
                        <td>
                            <a href="#" class="btn default btn-xs blue">
                                <i class="fa fa-share"></i> Share </a>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- END SAMPLE TABLE PORTLET-->
</div>
<div class="col-md-6">
    <!-- BEGIN SAMPLE TABLE PORTLET-->
    <div class="portlet">
        <div class="portlet-title">
            <div class="caption">
                <i class="fa fa-shopping-cart"></i>Advance Table
</div>
            <div class="tools">
                <a href="javascript:;" class="collapse">
                </a>
                <a href="#portlet-config" data-toggle="modal" class="config">
                </a>
                <a href="javascript:;" class="reload">
                </a>
                <a href="javascript:;" class="remove">
                </a>
            </div>
        </div>
        <div class="portlet-body">
            <div class="table-scrollable">
                <table class="table table-striped table-bordered table-advance table-hover">
                    <thead>
                    <tr>
                        <th>
                            <i class="fa fa-briefcase"></i> From
                        </th>
                        <th class="hidden-xs">
                            <i class="fa fa-question"></i> Descrition
                        </th>
                        <th>
                            <i class="fa fa-bookmark"></i> Total
                        </th>
                        <th>
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>
                            <a href="#">
    Pixel Ltd </a>
                        </td>
                        <td class="hidden-xs">
Server hardware purchase
</td>
                        <td>
52560.10$ <span class="label label-sm label-success label-mini">
Paid </span>
                        </td>
                        <td>
                            <a href="#" class="btn default btn-xs green-stripe">
View </a>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <a href="#">
    Smart House </a>
                        </td>
                        <td class="hidden-xs">
Office furniture purchase
</td>
                        <td>
5760.00$ <span class="label label-sm label-warning label-mini">
Pending </span>
                        </td>
                        <td>
                            <a href="#" class="btn default btn-xs blue-stripe">
View </a>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <a href="#">
    FoodMaster Ltd </a>
                        </td>
                        <td class="hidden-xs">
Company Anual Dinner Catering
</td>
                        <td>
12400.00$ <span class="label label-sm label-success label-mini">
Paid </span>
                        </td>
                        <td>
                            <a href="#" class="btn default btn-xs blue-stripe">
View </a>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <a href="#">
    WaterPure Ltd </a>
                        </td>
                        <td class="hidden-xs">
Payment for Jan 2013
</td>
                        <td>
610.50$ <span class="label label-sm label-danger label-mini">
Overdue </span>
                        </td>
                        <td>
                            <a href="#" class="btn default btn-xs red-stripe">
View </a>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- END SAMPLE TABLE PORTLET-->
</div>
</div>
<!-- END PAGE CONTENT-->
</div>


<?php include('theme/vk/footer.php'); ?>
