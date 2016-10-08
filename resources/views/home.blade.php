<div data-ng-controller="HomeController">

    <div class="row">
        <div class="col-sm-4 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-aqua"><i class="fa fa-users"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Funcionários</span>
                    <span class="info-box-number"><% total.total_funcionarios %> <small>Funcionários</small></span>
                </div>
            </div>
        </div>
        <div class="col-sm-4 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-red"><i class="fa fa-clock-o"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Total Horas Trabalhadas</span>
                    <span class="info-box-number"><% total.total_horas %> <small>hs</small></span>
                </div>
            </div>
        </div>
         <div class="col-sm-4 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-green"><i class="fa fa-money"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Total a Pagar</span>
                    <span class="info-box-number"><small>R$</small> <% total.total_pagar %></span>
                </div>
            </div>
        </div>
    </div>
    
</div>
