<div data-ng-controller="PermissionsController">

    <button class="btn btn-info" ng-click="newItem()" ng-permission="permissions.edit">Novo</button>
    <br />
    <br />

    <table class="table table-bordered table-condensed table-hover table-responsive table-striped">
        <thead>
        <tr>
            <th class="text-center">Cod</th>
            <th>Nome</th>
            <th>Descrição</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        <tr ng-repeat="item in list.data">
            <td class="text-center"><button class="btn-sm btn btn-link" ng-click="editItem(item)" ng-permission="permissions.edit"><% item.id %></button></td>
            <td><% item.name %></td>
            <td><% item.label %></td>
            <td class="text-center">
                <div class="btn-group">
                    <button class="btn-sm btn btn-link" ng-click="editItem(item)" ng-permission="permissions.edit">
                        <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
                    </button>
                    <button class="btn-sm btn btn-link" ng-click="removeItem(item)" ng-permission="permissions.delete">
                        <span class="glyphicon glyphicon-remove-sign" aria-hidden="true"></span>
                    </button>
                </div>
            </td>
        </tr>
        </tbody>
    </table>

    <nav paginator callback="getItemsList" current="<% list.current_page %>" maxpages="<% list.last_page %>" perpage="<% list.per_page %>" class='text-center col-xs-12'></nav>

</div>