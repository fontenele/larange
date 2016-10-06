<div data-ng-controller="UsersController">

    <button class="btn btn-info" ng-click="newItem()">Novo</button>
    <br />
    <br />

    <table class="table table-bordered table-condensed table-hover table-responsive table-striped">
        <thead>
            <tr>
                <th class="text-center">Cod</th>
                <th>Nome</th>
                <th>Email</th>
                <th>Perfis</th>
                <th>Últ. Login</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <tr ng-repeat="item in list.data">
                <td class="text-center"><a href="javascript:void(0)" ng-click="editItem(item)"><% item.id %></a></td>
                <td><% item.name %></td>
                <td><% item.email %></td>
                <td><span class="badge text-capitalize pointer" ng-click="viewRole(role)" style="margin-right: 3px;" ng-repeat="role in item.roles"><% role.name %></span></td>
                <td><% item.updated_at | dateFormat : 'DD/MM/YYYY HH:mm:ss' %></td>
                <td class="text-center">
                    <a href="javascript:void(0)" ng-click="editItem(item)">
                        <span class="glyphicon glyphicon-edit" aria-hidden="true"></span> 
                    </a>
                    <a href="javascript:void(0)" ng-click="removeItem(item)">
                        <span class="glyphicon glyphicon-remove-sign" aria-hidden="true"></span>
                    </a>
                </td>
            </tr>
        </tbody>
    </table>

    <nav paginator callback="getItemsList" current="<% list.current_page %>" maxpages="<% list.last_page %>" perpage="<% list.per_page %>" class='text-center col-xs-12'></nav>

</div>
