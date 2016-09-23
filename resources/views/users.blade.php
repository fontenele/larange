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
                <th>Últ. Login</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <tr ng-repeat="item in list.data">
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

    <nav paginator callback="getUsersList" current="<% list.current_page %>" maxpages="<% list.last_page %>" perpage="<% list.per_page %>" class='text-center col-xs-12'></nav>

    <!--nav aria-label="Page navigation" class="text-center">
        <ul class="pagination">
            <li>
                <a href="#" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                </a>
            </li>
            <li><a href="javascript:void(0);">1</a></li>
            <li><a href="javascript:void(0);">2</a></li>
            <li><a href="javascript:void(0);">3</a></li>
            <li><a href="javascript:void(0);">4</a></li>
            <li><a href="javascript:void(0);">5</a></li>
            <li>
                <a href="#" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                </a>
            </li>
        </ul>
    </nav-->

</div>
