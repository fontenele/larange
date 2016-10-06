<div data-ng-controller="PermissionsEditController">
    
    <form class="form-horizontal" ng-submit="save($event)">
        
        <div class="form-group">
            <label class="control-label col-xs-3">Nome</label>
            <div class="col-xs-9">
                <input class="form-control" ng-model="item.name" />
            </div>
        </div>
        
        <div class="form-group">
            <label class="control-label col-xs-3">Descrição</label>
            <div class="col-xs-9">
                <input class="form-control" ng-model="item.label" />
            </div>
        </div>
        
        <div class="form-group">
            <div class="col-sm-offset-3 col-sm-9">
                <button ng-click="cancelar()" type="button" class="btn btn-default">Cancelar</button>
                <button type="submit" class="btn btn-primary">Salvar</button>
            </div>
        </div>
        
    </form>

</div>
