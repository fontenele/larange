<!doctype html>
<html lang="en">
    <head>
        <title>larAnge</title>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta name="description" content="larAnge - PHP5 Framework PHP+JS (laravel, requirejs, angular, bootstrap)">
        <meta name="author" content="Guilherme Fontenele <http://github.com/fontenele>">
        <link rel="stylesheet" href="css/plugins/loading.css" />
        <link rel="stylesheet" href="vendor/bootstrap/dist/css/bootstrap.css" />
        <link rel="stylesheet" href="vendor/font-awesome/css/font-awesome.css" />
        <link rel="stylesheet" href="vendor/ionicons/css/ionicons.css" />
        <link rel="stylesheet" href="vendor/admin-lte/dist/css/AdminLTE.css" />
        <link rel="stylesheet" href="vendor/admin-lte/dist/css/skins/_all-skins.css" />
        <link rel="stylesheet" href="vendor/admin-lte/plugins/iCheck/all.css" />
        <link rel="stylesheet" href="vendor/admin-lte/plugins/morris/morris.css" />
        <link rel="stylesheet" href="vendor/admin-lte/plugins/jvectormap/jquery-jvectormap-1.2.2.css" />
        <link rel="stylesheet" href="vendor/admin-lte/plugins/datepicker/datepicker3.css" />
        <link rel="stylesheet" href="vendor/admin-lte/plugins/daterangepicker/daterangepicker.css" />
        <link rel="stylesheet" href="vendor/admin-lte/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.css" />
        <link rel="stylesheet" href="vendor/admin-lte/plugins/select2/select2.css" />
        <link rel="stylesheet" href="vendor/animate.css/animate.css" />
        <style>
            .logo img {
                height: 100%;
                padding: 15px;
                width: auto;
                width: 64px;
                padding: 7px 14px;
                border-radius: 50%;
                -webkit-transition: -webkit-transform .8s ease-in-out;
                transition: transform .8s ease-in-out;
            }
            .logo img:hover {
                -webkit-transform: rotate(360deg);
                transform: rotate(360deg);
            }
            .logo-mini {
                margin-left: -22px !important;
            }
            .profileAvatarSelected {
                border: 3px solid #357CA5;
            }
            .modal-body form label { color: #080808; }
            .ng-cloak { display:none; }
        </style>
        <script type="text/javascript" src="vendor/requirejs/require.js" data-main="js/main"></script>
    </head>
    <body data-ng-controller="PrincipalController" ng-cloak ng-class="profileThemeTemp || currentUser.theme" class="ng-cloak hold-transition sidebar-collapse sidebar-mini" layout="column">

        <div class="wrapper">

            <header class="main-header">
                <a href="javascript:void(0)" class="logo" ng-click="menuItem('home')">
                    <span class="logo-mini"><img src="{{ asset('images/larange.png') }}" /></span>
                    <span class="logo-lg"><img src="{{ asset('images/larange.png') }}" /></span>
                    
                </a>

                <nav class="navbar navbar-static-top" role="navigation">
                    <a href="javascript:void(0)" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                        <span class="sr-only">Toggle navigation</span>
                    </a>

                    <div class="navbar-custom-menu">
                        <ul class="nav navbar-nav">
                            
                            <!--li class="dropdown messages-menu" ng-show="authenticated">
                                <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="fa fa-envelope-o"></i>
                                    <span class="label label-success"><% currentUser.totals.messages %></span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li class="header">You have <% currentUser.totals.messages %> messages</li>
                                    <li>
                                        <ul class="menu">
                                            <li>
                                                <a href="javascript:void(0)">
                                                    <div class="pull-left">
                                                        <img ng-src="<% currentUser.avatar %>" class="img-circle" alt="User Image">
                                                    </div>
                                                    <h4>
                                                        Support Team
                                                        <small><i class="fa fa-clock-o"></i> 5 mins</small>
                                                    </h4>
                                                    <p>Why not buy a new awesome theme?</p>
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="footer"><a href="javascript:void(0)">See All Messages</a></li>
                                </ul>
                            </li>

                            <li class="dropdown notifications-menu" ng-show="authenticated">
                                <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="fa fa-bell-o"></i>
                                    <span class="label label-warning"><% currentUser.totals.notifications %></span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li class="header">You have <% currentUser.totals.notifications %> notifications</li>
                                    <li>
                                        <ul class="menu">
                                            <li>
                                                <a href="javascript:void(0)">
                                                    <i class="fa fa-users text-aqua"></i> <% currentUser.totals.notifications %> new members joined today
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="footer"><a href="javascript:void(0)">View all</a></li>
                                </ul>
                            </li>

                            <li class="dropdown tasks-menu" ng-show="authenticated">
                                <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="fa fa-flag-o"></i>
                                    <span class="label label-danger"><% currentUser.totals.tasks %></span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li class="header">You have <% currentUser.totals.tasks %> tasks</li>
                                    <li>
                                        <ul class="menu">
                                            <li>
                                                <a href="javascript:void(0)">
                                                    <h3>
                                                        Design some buttons
                                                        <small class="pull-right">20%</small>
                                                    </h3>
                                                    <div class="progress xs">
                                                        <div class="progress-bar progress-bar-aqua" style="width: 20%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                                                            <span class="sr-only">20% Complete</span>
                                                        </div>
                                                    </div>
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="footer">
                                        <a href="javascript:void(0)">View all tasks</a>
                                    </li>
                                </ul>
                            </li-->

                            <li class="dropdown user user-menu" ng-show="authenticated">
                                <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown">
                                    <img ng-src="<% currentUser.avatar %>" class="user-image" alt="User Image">
                                    <span class="hidden-xs"><% currentUser.name %></span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li class="user-header">
                                        <img ng-src="<% currentUser.avatar %>" class="img-circle" alt="User Image">
                                        <p>
                                            <% currentUser.name %>
                                            <small>Usuário desde <% currentUser.created_at | dateFormat : 'DD [de] MMMM [de] YYYY' %></small>
                                        </p>
                                    </li>
                                    <li class="user-footer">
                                        <div class="pull-left">
                                            <button type="button" class="btn btn-default btn-flat" data-toggle="modal" data-target="#profile-modal">Configurar</button>
                                        </div>
                                        <div class="pull-right">
                                            <button type="button" ng-click="menuItem('login', true)" class="btn btn-default btn-flat">Sair</button>
                                        </div>
                                    </li>
                                </ul>
                            </li>

                            <!--li ng-show="authenticated">
                                <a href="javascript:void(0)" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
                            </li-->
                            
                        </ul>
                    </div>
                </nav>
            </header>

            <aside class="main-sidebar">
            
                <section class="sidebar">
                    
                    <div class="user-panel" ng-show="authenticated">
                        <div class="pull-left image">
                            <img ng-src="<% currentUser.avatar %>" class="img-circle" alt="User Image">
                        </div>
                        <div class="pull-left info">
                            <p><% currentUser.name %></p>
                            <a href="javascript:void(0)"><i class="fa fa-circle text-success"></i> Online</a>
                        </div>
                    </div>
                    
                    <ul class="sidebar-menu" >
                        <li class="header text-capitalize"><% menu.header %></li>
                        <menu items="menu.items"></menu>
                    </ul>
                </section>
            </aside>

            <div class="content-wrapper">
                <section class="content-header">
                    <h1 class="ng-cloak" ng-cloak>
                        <% pageHeader %>
                        <small><% pageSubheader %></small>
                    </h1>
                    <ol class="breadcrumb">
                        <li ng-repeat="bc in namespace" ng-class="{'active':$last}">
                            <a ng-if="!$last" href="javascript:void(0)" ng-click="bcItem(bc[1], $last)"><% bc[0] %></a>
                            <span ng-if="$last"><% bc[0] %></span>
                        </li>
                    </ol>
                </section>
                <section class="content">
                    <ng-view id="ng-view" ng-cloak class="ng-cloak"></ng-view>
                </section>
            </div>

            <footer class="main-footer">
                <div class="pull-right hidden-xs">
                    <a href="https://github.com/fontenele" target="_blank">@fontenele</a>
                </div>
                <strong>Powered by <a href="https://github.com/fontenele/larange" target="_blank">Larange</a>.</strong>
            </footer>

            <!--aside class="control-sidebar control-sidebar-dark">
                <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
                    <li class="active"><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
                    <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="control-sidebar-home-tab">
                        <h3 class="control-sidebar-heading">Recent Activity</h3>
                        <ul class="control-sidebar-menu">
                            <li>
                                <a href="javascript::;">
                                    <i class="menu-icon fa fa-birthday-cake bg-red"></i>
                                    <div class="menu-info">
                                        <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>
                                        <p>Will be 23 on April 24th</p>
                                    </div>
                                </a>
                            </li>
                        </ul>
                        
                        <h3 class="control-sidebar-heading">Tasks Progress</h3>
                        <ul class="control-sidebar-menu">
                            <li>
                                <a href="javascript::;">
                                    <h4 class="control-sidebar-subheading">
                                        Custom Template Design
                                        <span class="pull-right-container">
                                            <span class="label label-danger pull-right">70%</span>
                                        </span>
                                    </h4>
                                    
                                    <div class="progress progress-xxs">
                                        <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div>
                    <div class="tab-pane" id="control-sidebar-settings-tab">
                        <form method="post">
                            <h3 class="control-sidebar-heading">General Settings</h3>
                            
                            <div class="form-group">
                                <label class="control-sidebar-subheading">
                                    Report panel usage
                                    <input type="checkbox" class="pull-right" checked>
                                </label>
                                
                                <p>Some information about this general settings option</p>
                            </div>
                        </form>
                    </div>
                </div>
            </aside>
            <div class="control-sidebar-bg"></div-->
            
        </div>

        <div class="modal fade modal-primary" id="profile-modal" tabindex="-1" role="dialog" aria-labelledby="profile-modal-label">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" ng-click="profileCleanTheme()"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="profile-modal-label">Configurar conta</h4>
                    </div>
                    <div class="modal-body">
                        <div class="box box-info">
                            
                            <form class="form-horizontal">
                                <div class="box-body">

                                    <div class="form-group">
                                        <label class="control-label col-xs-2">Avatar</label>
                                        <div class="col-xs-9">
                                            <img ng-click="profileSelectAvatar($event, avatar)"  class="img-circle" ng-class="avatar.icon" ng-repeat="avatar in profileAvatars" ng-src="<% avatar.filename %>" style="cursor:pointer; max-width: 30px;margin-right: 5px;" />
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label class="control-label col-xs-2">Nome</label>
                                        <div class="col-xs-9">
                                            <input class="form-control" ng-model="currentUser.name" />
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-xs-2">E-mail</label>
                                        <div class="col-xs-9">
                                            <input class="form-control" ng-model="currentUser.email" />
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label class="control-label col-xs-2">Tema</label>
                                        <div class="col-xs-9 text-blue">
                                            <ul class="list-inline">
                                                <li ng-click="profileSelectTheme($event, color)" title="<% color.label %>" ng-repeat="color in profileColors" style="cursor: pointer;font-size: 30px;color: <% color.hex %>">
                                                    <i ng-class="color.icon"></i>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal" ng-click="profileCleanTheme()">Cancelar</button>
                        <button type="button" class="btn btn-primary" ng-click="saveProfile(profileAvatars, profileColors, currentUser)">Salvar</button>
                    </div>
                </div>
            </div>
        </div>

        <!--nav class="navbar navbar-default navbar-fixed-top">
            <div class="container-fluid">
                
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-top" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="javascript:void(0)" ng-click="menuItem('home')"><img src="{{ asset('images/larange.png') }}" /></a>
                </div>
                
                <div id="navbar-top" class="collapse navbar-collapse">
                    <menu ng-show="authenticated" items="menu" location=''></menu>
                    <ul class="nav navbar-nav navbar-right">
                        <li ng-hide="authenticated" ng-click="menuItem('login')"><a href="javascript:void(0)">Entrar</a></li>
                        <li ng-show="authenticated" class="dropdown">
                            <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><% currentUser.name %> <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li ng-click="menuItem('admin')"><a href="javascript:void(0)">Admin Panel</a></li>
                                <li role="separator" class="divider"></li>
                                <li ng-click="menuItem('login', true)"><a href="javascript:void(0)">Sair</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
                
            </div>
        </nav>

        <div class="container-fluid" style="padding-bottom: 20px;">
            <div class="row">
                <div class="col-sm-3 col-md-2 sidebar" ng-show="authenticated">
                    <menu items="menu" location='nav-pills nav-stacked"'></menu>
                </div>
                <div ng-class="container_class">
                    <ol class="breadcrumb" ng-show="authenticated">
                        <li ng-repeat="bc in namespace">
                            <button class="btn btn-sm btn-link" ng-click="bcItem(bc[1], $last)"><% bc[0] %></button>
                        </li>
                    </ol>
                    <ng-view id="ng-view" ng-cloak class="ng-cloak"></ng-view>
                </div>
            </div>
        </div>
        <div class="footer">
            <div class="container-fluid">
                <div class="col-sm-4">
                    <p><a href="https://github.com/fontenele/larange" target="_blank">Larange Github project</a></p>
                    <p><a href="https://github.com/fontenele" target="_blank">@fontenele</a></p>
                </div>
                <div class="col-sm-4">
                    
                </div>
                <div class="col-sm-4">
                    <p><a href="https://github.com/laravel/laravel" target="_blank">Laravel</a></p>
                    <p><a href="https://github.com/angular/angular" target="_blank">AngularJS</a></p>
                    <p><a href="https://github.com/requirejs/requirejs" target="_blank">RequireJS</a></p>
                    <p><a href="https://github.com/twbs/bootstrap" target="_blank">Twitter Bootstrap</a></p>
                </div>
            </div>
        </div-->


    </body>
</html>
