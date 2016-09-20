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
            <tr ng-repeat="item in listItems" ng-click="editItem(item)">
                <td class="text-center"><% item.id %></td>
                <td><% item.name %></td>
                <td><% item.email %></td>
                <td><% item.updated_at | dateFormat : 'DD/MM/YYYY HH:mm:ss' %></td>
                <td>
                    edit remove
                </td>
            </tr>
        </tbody>
    </table>

</div>
