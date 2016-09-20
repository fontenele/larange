<div data-ng-controller="UsersEditController">
    
    <form class="form-horizontal" ng-submit="save()">
        
        <div class="form-group">
            <label class="control-label col-xs-3">Nome</label>
            <div class="col-xs-9">
                <input class="form-control" ng-model="user.name" />
            </div>
        </div>
        
        <div class="form-group">
            <label class="control-label col-xs-3">E-mail</label>
            <div class="col-xs-9">
                <input class="form-control" ng-model="user.email" />
            </div>
        </div>
        
        <div class="form-group">
            <div class="col-sm-offset-3 col-sm-9">
                <button type="submit" class="btn btn-primary">Salvar</button>
            </div>
        </div>
        
    </form>

</div>
