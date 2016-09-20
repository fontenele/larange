<div data-ng-controller="UsersController">

    <button class="btn btn-info" ng-click="novo()">Novo</button>
    <br />
    <br />

    <table class="table table-bordered table-condensed table-hover table-responsive table-striped">
        <thead>
            <tr>
                <th class="text-center">Cod</th>
                <th>Nome</th>
                <th>Email</th>
                <th>Últ. Login</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <tr ng-repeat="item in listItems">
                <td class="text-center"><a href="javascript:void(0)" ng-click="editItem(item)"><% item.id %></a></td>
                <td><% item.name %></td>
                <td><% item.email %></td>
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

</div>
