<div data-ng-controller="AdminController">

    <div class="row">
        <div class="col-sm-4 col-xs-12">
            <div class="small-box bg-aqua">
                <div class="inner">
                    <h3><% total.users %></h3>
                    <p>Usuários</p>
                </div>
                <div class="icon"><i class="fa fa-user"></i></div>
                <a href="javascript:void(0)" ng-show="checkAclPermission('users.list')"  ng-click="menuItem('users')" class="small-box-footer">Ver mais <i class="fa fa-arrow-circle-right"></i></a>
                <a href="javascript:void(0)" ng-show="!checkAclPermission('users.list')" class="small-box-footer text-disabled">Ver mais <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-sm-4 col-xs-12">
            <div class="small-box bg-green">
                <div class="inner">
                    <h3><% total.roles %></h3>
                    <p>Perfis</p>
                </div>
                <div class="icon"><i class="fa fa-sitemap"></i></div>
                <a href="javascript:void(0)" ng-show="checkAclPermission('roles.list')" ng-click="menuItem('roles')" class="small-box-footer">Ver mais <i class="fa fa-arrow-circle-right"></i></a>
                <a href="javascript:void(0)" ng-show="!checkAclPermission('roles.list')" class="small-box-footer text-disabled">Ver mais <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-sm-4 col-xs-12">
            <div class="small-box bg-yellow">
                <div class="inner">
                    <h3><% total.permissions %></h3>
                    <p>Permissões</p>
                </div>
                <div class="icon"><i class="fa fa-shield"></i></div>
                <a href="javascript:void(0)" ng-show="checkAclPermission('permissions.list')" ng-click="menuItem('permissions')" class="small-box-footer">Ver mais <i class="fa fa-arrow-circle-right"></i></a>
                <a href="javascript:void(0)" ng-show="!checkAclPermission('permissions.list')" class="small-box-footer text-disabled">Ver mais <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
    </div>
    
</div>
