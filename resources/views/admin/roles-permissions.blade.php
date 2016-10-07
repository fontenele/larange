<div data-ng-controller="RolesPermissionsController">
    
    <form ng-submit="save($event)">
        <div class="panel panel-default" ng-repeat="group in list">
            <div class="panel-heading text-capitalize"><% group.name %></div>
            <ul class="list-group">
                <li class="list-group-item" ng-repeat="item in group.items">
                    <span class="badge" style="height: 30px; font-size: 20px;"><% item.name %></span>
                    <label class="pointer">
                        <input type="checkbox" ng-checked="actives[item.name]" name="active[<% item.id %>]" style="margin-right: 6px;" /><% item.label %>
                    </label>
                </li>
            </ul>
        </div>
        <button ng-click="cancelar()" type="button" class="btn btn-default">Cancelar</button>
        <button type="submit" class="btn btn-primary">Salvar</button>
    </form>

</div>