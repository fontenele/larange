<div data-ng-controller="UsersEditController">
    
    <form class="form-horizontal" ng-submit="save($event)">
        
        <div class="form-group">
            <label class="control-label col-xs-3">Nome</label>
            <div class="col-xs-9">
                <input class="form-control" ng-model="item.name" />
            </div>
        </div>
        
        <div class="form-group">
            <label class="control-label col-xs-3">E-mail</label>
            <div class="col-xs-9">
                <input class="form-control" ng-model="item.email" />
            </div>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading text-capitalize">Perfis</div>
            <ul class="list-group">
                <li class="list-group-item" ng-repeat="role in list">
                    <span class="badge" style="height: 30px; font-size: 20px;"><% role.name %></span>
                    <label>
                        <input type="checkbox" ng-checked="actives[role.name]" name="active[<% role.id %>]" style="margin-right: 6px;" /><% role.label %>
                    </label>
                </li>
            </ul>
        </div>
        
        <div class="form-group">
            <div class="col-sm-offset-3 col-sm-9">
                <button ng-click="cancelar()" type="button" class="btn btn-default">Cancelar</button>
                <button type="submit" class="btn btn-primary">Salvar</button>
            </div>
        </div>
        
    </form>

</div>
