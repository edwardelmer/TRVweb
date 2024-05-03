<?php if(!defined('IN_PHPVMS') && IN_PHPVMS !== true) { die(); } ?>
<div class="section-header">
	<h1>SimBrief Flight Briefing</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="<?php echo SITE_URL; ?>">Dashboard</a></div>
        <div class="breadcrumb-item"><a href="javascript::">Flight Operations</a></div>
        <div class="breadcrumb-item"><a href="javascript::">My Reservations</a></div>
        <div class="breadcrumb-item">SimBrief Flight Briefing</div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4>Flight Plan Briefing</h4>
            </div>
            <div class="card-body">
                <table width="98%" align="center" cellpadding="4">
                    <!-- Flight ID -->
                    <tr style="background-color: #333; color: #FFF;">
                        <td>Flight Number</td>
                        <td>AIRAC Version</td>
                        <td width="36%">Download FlightPlan</td>
                    </tr>
                    
                    <tr>
                        <td width="34%" ><?php echo (string) $info->general[0]->icao_airline.''.(string) $info->general[0]->flight_number; ?></td>
                        <td><?php echo (string) $info->params[0]->airac; ?></td>
                        
                        <td>
                            <script type="text/javascript">
                                function download(d) {
                                        if (d == 'Select Format') return;
                                        window.open('https://www.simbrief.com/ofp/flightplans/' + d);
                                }
                            </script>
                
                            <select name="download" class="form-control" onChange="download(this.value)">
                                <option>Select Format</option>
                                
                                <option disabled>- Aircraft -</option>
                                <option value="<?php echo $info->files->file[0]->link; ?>"><?php echo $info->files->file[0]->name; ?></option> 
                                <option value="<?php echo $info->files->file[1]->link; ?>"><?php echo $info->files->file[1]->name; ?></option>
                                <option value="<?php echo $info->files->file[7]->link; ?>"><?php echo $info->files->file[7]->name; ?></option>
                                <option value="<?php echo $info->files->file[9]->link; ?>"><?php echo $info->files->file[9]->name; ?></option>
                                <option value="<?php echo $info->files->file[13]->link; ?>"><?php echo $info->files->file[13]->name; ?></option>
                                <option value="<?php echo $info->files->file[17]->link; ?>"><?php echo $info->files->file[17]->name; ?></option>
                                <option value="<?php echo $info->files->file[29]->link; ?>"><?php echo $info->files->file[29]->name; ?></option>
                                <option value="<?php echo $info->files->file[30]->link; ?>"><?php echo $info->files->file[30]->name; ?></option>
                                <option value="<?php echo $info->files->file[52]->link; ?>"><?php echo $info->files->file[52]->name; ?></option>
                                <option disabled>- Tools - </option>
                                <option value="<?php echo $info->files->file[5]->link; ?>"><?php echo $info->files->file[5]->name; ?></option>
                                <option value="<?php echo $info->files->file[6]->link; ?>"><?php echo $info->files->file[6]->name; ?></option>
                                <option value="<?php echo $info->files->file[24]->link; ?>"><?php echo $info->files->file[24]->name; ?></option>
                                <option value="<?php echo $info->files->file[27]->link; ?>"><?php echo $info->files->file[27]->name; ?></option>
                                <option value="<?php echo $info->files->file[49]->link; ?>"><?php echo $info->files->file[49]->name; ?></option>
                                <option value="<?php echo $info->files->file[50]->link; ?>"><?php echo $info->files->file[50]->name; ?></option>
                                <option value="<?php echo $info->files->file[51]->link; ?>"><?php echo $info->files->file[51]->name; ?></option>
                                <option value="<?php echo $info->files->file[53]->link; ?>"><?php echo $info->files->file[53]->name; ?></option>
                                <option disabled>- Simulator -</option>
                                <option value="<?php echo $info->files->file[16]->link; ?>"><?php echo $info->files->file[16]->name; ?></option>
                                <option value="<?php echo $info->files->file[18]->link; ?>"><?php echo $info->files->file[18]->name; ?></option>
                                <option value="<?php echo $info->files->file[54]->link; ?>"><?php echo $info->files->file[54]->name; ?></option>
                                <option value="<?php echo $info->files->file[55]->link; ?>"><?php echo $info->files->file[55]->name; ?></option>

                                <!--
                                <option value="<?php echo $info->files->pdf->link; ?>"><?php echo $info->files->pdf->name; ?></option>
                                <?php foreach($info->files->file as $file) { ?>
                                    <option value="<?php echo $file->link; ?>"><?php echo $file->name; ?></option>
                                <?php } ?>-->
                            </select>            
                        </td>
                    </tr> 
                    
                    <tr style="background-color: #333; color: #FFF;">
                        <td>Departure</td>
                        <td>Arrival</td>
                        <td width="36%">Alternate</td>
                    </tr>
                    
                    <tr>
                        <td width="34%" ><?php echo (string) $info->origin[0]->name.'('.(string) $info->origin[0]->icao_code.') <br>Planned RWY '.$info->origin[0]->plan_rwy; ?></td>
                        <td width="30%" ><?php echo (string) $info->destination[0]->name.'('.(string) $info->destination[0]->icao_code.') <br>Planned RWY '.$info->destination[0]->plan_rwy; ?></td>
                        <td><?php echo (string) $info->alternate[0]->name.'('.(string) $info->alternate[0]->icao_code.') <br>Planned RWY '.$info->alternate[0]->plan_rwy; ?></td>                                 </td>
                    </tr>

                    <!-- Times Row -->
                    <tr  style="background-color: #333; color: #FFF;">
                        <td>Departure Time</td>
                        <td>Arrival Time</td>
                        <td width="36%">Flight Time</td>
                    </tr>
                    
                    <tr>
                        <td width="34%" >
                            <?php
                                $epoch = (string) $info->times[0]->sched_out; 
                                $dt = new DateTime("@$epoch");  // convert UNIX timestamp to PHP DateTime
                                echo $dt->format('H:i'); // output = 2012-08-15 00:00:00  
                            ?>
                        </td>
                        <td width="30%" >
                            <?php
                                $epoch = (string) $info->times[0]->est_in; 
                                $dt = new DateTime("@$epoch");  // convert UNIX timestamp to PHP DateTime
                                echo $dt->format('H:i'); // output = 2012-08-15 00:00:00  
                            ?>
                        </td>
                        <td>
                            <?php
                                $epoch = (string) $info->times[0]->est_block; 
                                $dt = new DateTime("@$epoch");  // convert UNIX timestamp to PHP DateTime
                                echo $dt->format('H:i'); // output = 2012-08-15 00:00:00  
                            ?>                                      
                        </td>
                    </tr>   

                    <!-- Aircraft and Distance Row -->       
                    <tr style="background-color: #333; color: #FFF;">
                        <td>Crew</td>
                        <td>Aircraft</td>
                        <td width="36%">Distance</td>
                    </tr>
                    
                    <tr>
                        <td width="34%" ><?php echo (string) $info->crew[0]->cpt ; ?></td>
                        <td width="30%" ><?php echo (string) $info->aircraft[0]->reg.'('.(string) $info->aircraft[0]->icaocode.')'; ?></td>
                        <td><?php echo (string) $info->general[0]->route_distance.'(Nm)'; ?></td>            
                    </tr>

                    <!-- Metar and TAF -->
                    <tr style="background-color: #333; color: #FFF;">
                        <td>Departure METAR</td>
                        <td>Arrival METAR</td>
                        <td colspan="2">Alternate METAR</td>
                    </tr>
                    <tr>
                        <td width="34%" ><?php echo (string) $info->weather[0]->orig_metar; ?></td>
                        <td width="34%" ><?php echo (string) $info->weather[0]->dest_metar; ?></td>
                        <td width="34%" ><?php echo (string) $info->weather[0]->altn_metar; ?></td>
                    </tr>
                    
                    <tr style="background-color: #333; color: #FFF;">
                        <td>Departure TAF</td>
                        <td>Arrival TAF</td>
                        <td colspan="2">Alternate TAF</td>
                    </tr>
                    <tr>
                        <td width="34%" ><?php echo (string) $info->weather[0]->orig_taf; ?></td>
                        <td width="34%" ><?php echo (string) $info->weather[0]->dest_taf; ?></td>
                        <td width="34%" ><?php echo (string) $info->weather[0]->altn_taf; ?></td>
                    </tr>

                    <!-- Route -->
                    <tr style="background-color: #333; color: #FFF;">
                        <td colspan="2">ATC Flight Plan</td>
                        <td>Prefile</td>
                    </tr>
                    <tr>
                        <td colspan="2"><?php echo preg_replace("~[\n]~", "<br>",$info->atc[0]->flightplan_text); ?></td>
                        <td><a onclick="window.open ('<?php echo (string) $info->prefile->ivao[0]->link;?>', ''); return false" href="javascript:void(0);" class="btn btn-icon btn-primary" style="width: 40%">IVAO Pre File</a>
                        <br>Login Required
                        </td>
                    </tr>
                    
                    <!-- Notes -->
                    <tr style="background-color: #333; color: #FFF;">
                        <td colspan="3">Pilot Folder</td>
                    </tr>
                    <tr>
                        <td colspan="3" style="padding: 6px;">
                            <iframe src="https://www.simbrief.com/ofp/flightplans/<?php echo $info->files->pdf->link; ?>" width="100%" height="700px"></iframe>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>