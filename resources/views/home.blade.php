<div data-ng-controller="HomeController">
    
    <div class="col-sm-4">
        <div class="panel panel-default">
            <div class="panel-heading text-center">
                Funcionários
            </div>
            <div class="panel-body text-center">
                <h1><% total.total_funcionarios %></h1>
            </div>
        </div>
    </div>
    
    <div class="col-sm-4">
        <div class="panel panel-default">
            <div class="panel-heading text-center">
                Total Horas Trabalhadas
            </div>
            <div class="panel-body text-center">
                <h1><% total.total_horas %> hs</h1>
            </div>
        </div>
    </div>
    
    <div class="col-sm-4">
        <div class="panel panel-default">
            <div class="panel-heading text-center">
                Total a Pagar
            </div>
            <div class="panel-body text-center">
                <h1>R$ <% total.total_pagar %></h1>
            </div>
        </div>
    </div>
    
</div>
