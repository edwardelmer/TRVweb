



<div class="col-md-4">
    <?php
        $bids = SchedulesData::getBids(Auth::$userinfo->pilotid);
        $aircraft = OperationsData::getAircraftByReg($bid->registration);
        $depAirport = OperationsData::getAirportInfo($bid->depicao);
        $arrAirport = OperationsData::getAirportInfo($bid->arricao);
    ?>
    <div class="card">
        <div class="card-header">
            <h4>Testing</h4>
        </div>
        
    </div>
</div>
                            
                                        