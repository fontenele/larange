<div data-ng-controller="UsersController">

    <table class="table table-bordered table-condensed table-hover table-responsive table-striped">
        <thead>
            <tr>
                <th class="text-center">Cod</th>
                <th>Nome</th>
                <th>Email</th>
                <th>Dt. Criação</th>
                <th>Dt. Atualização</th>
            </tr>
        </thead>
        <tbody>
            <tr ng-repeat="item in listItems" ng-click="editItem(item)">
                <td class="text-center"><% item.id %></td>
                <td><% item.name %></td>
                <td><% item.email %></td>
                <td><% item.created_at | dateFormat : 'DD/MM/YYYY HH:mm:ss' %></td>
                <td><% item.updated_at | dateFormat : 'DD/MM/YYYY HH:mm:ss' %></td>
            </tr>
        </tbody>
    </table>

</div>
