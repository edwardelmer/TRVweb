<?php if(!defined('IN_PHPVMS') && IN_PHPVMS !== true) { die(); } ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<h3>Airports List</h3>
<div id="results"></div>
<table id="grid"></table>
<div id="pager"></div>
<br />

<link rel="stylesheet" type="text/css" media="screen" href="<?php echo fileurl('/lib/js/jqgrid/css/ui.jqgrid.css');?>" />
<script src="<?php echo fileurl('/lib/js/jqgrid/js/i18n/grid.locale-en.js');?>" type="text/javascript"></script>
<script src="<?php echo fileurl('/lib/js/jqgrid/js/jquery.jqGrid.min.js');?>" type="text/javascript"></script>

<script type="text/javascript">
$("#grid").jqGrid({
   url: '<?php echo adminaction('/operations/airportgrid');?>',
   datatype: 'json',
   mtype: 'GET',
   colNames: ['ICAO', 'Airport Name', 'Country', 'Fuel Cost', 'Lat', 'Long', 'Edit'],
   colModel : [
		{index: 'icao', name : 'icao', width: 30, sortable : true, align: 'center', search: 'true', searchoptions:{sopt:['eq','ne']}},
		{index: 'name', name : 'name', width: 120, sortable : true, align: 'center', searchoptions:{sopt:['in']}},
		{index: 'country', name : 'country', width: 50, sortable : true, align: 'center', searchoptions:{sopt:['in']}},
		{index: 'fuelprice', name : 'fuelprice', width: 30, sortable : true, align: 'center', search:false},
		{index: 'lat', name : 'lat', width: 40, sortable : true, align: 'center', search:false},
		{index: 'lng', name : 'lng', width: 40, sortable : true, align: 'center', search:false},
		{index: '', name : '', width: 40, sortable : true, align: 'center', search: false}
	],
    pager: '#pager', rowNum: 25,
    sortname: 'icao', sortorder: 'asc',
    viewrecords: true, autowidth: true,
    height: '100%'
});

jQuery("#grid").jqGrid('navGrid','#pager', 
	{edit:false,add:false,del:false,search:true,refresh:true},
	{}, // edit 
	{}, // add 
	{}, //del 
	{multipleSearch:true} // search options 
); 

function editairport(icao)
{
	$('#jqmdialog').jqm({
		ajax:'<?php echo adminaction('/operations/editairport?icao=');?>'+icao
	}).jqmShow();
}
</script>
<script type="text/javascript">
jQuery.noConflict(true);
</script>