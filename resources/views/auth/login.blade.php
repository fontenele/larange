<div class="col-sm-4 col-sm-offset-4" data-ng-controller="LoginController">
    <div class="well">
        <h3>Login <% name %> </h3>
        <form>
            <p class="alert alert-danger" ng-if="loginError"><strong>Error:</strong> <% loginErrorText %></p>
            <div class="form-group">
                <input type="email" class="form-control" placeholder="Email" ng-model="email">
            </div>
            <div class="form-group">
                <input type="password" class="form-control" placeholder="Password" ng-model="password">
            </div>
            <button class="btn btn-primary" ng-click="login()">Submit</button>
        </form>
    </div>
</div>