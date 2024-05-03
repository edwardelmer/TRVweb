<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<h3>Pilots List</h3>

<table id="grid"></table>
<div id="pager"></div>
<br />

<link rel="stylesheet" type="text/css" media="screen" href="<?php echo fileurl('/lib/js/jqgrid/css/ui.jqgrid.css');?>" />
<script src="<?php echo fileurl('/lib/js/jqgrid/js/i18n/grid.locale-en.js');?>" type="text/javascript"></script>
<script src="<?php echo fileurl('/lib/js/jqgrid/js/jquery.jqGrid.min.js');?>" type="text/javascript"></script>

<script type="text/javascript">
$("#grid").jqGrid({
   url: '<?php echo adminaction('/pilotadmin/getpilotsjson');?>',
   datatype: 'json',
   mtype: 'GET',
   colNames: ['','Pilot ID', 'First', 'Last', 'Email', 'Loc', 'Status', 'Rank', 'Flights', 'Hours', 'IP', 'Edit'],
   colModel : [
		{index: 'id', name: 'id', hidden: true, search: false },
		{index: 'pilotid', name: 'pilotid', width: 20, hidden: false, search: true },
		{index: 'firstname', name : 'firstname', width: 30,sortable : true, align: 'left', search: 'true', searchoptions:{sopt:['in']}},
		{index: 'lastname', name : 'lastname', width: 30, sortable : true, align: 'left', searchoptions:{sopt:['in']}},
		{index: 'email', name : 'email', width: 45, sortable : true, align: 'left',searchoptions:{sopt:['li']}},
		{index: 'location', name : 'location', width: 15,  sortable : true, align: 'center',searchoptions:{sopt:['eq','ne']}},
		{index: 'retired', name : 'status', width: 20, sortable : true, align: 'center',searchoptions:{sopt:['in']}},
		{index: 'rank', name : 'rank', width: 30, sortable : true, align: 'center', searchoptions:{sopt:['eq','ne']}},
		{index: 'totalflights', name : 'totalflights', width: 15, sortable : true, align: 'center',searchoptions:{sopt:['lt','gt']}},
		{index: 'totalhours', name : 'totalhours', width: 20, sortable : true, align: 'center',searchoptions:{sopt:['lt','gt']}},
		{index: 'lastip', name : 'lastip', width: 30, sortable : true, align: 'center', searchoptions:{sopt:['in']}},
		{index: '', name : '', width: 15, sortable : true, align: 'center', search: false}
	],
    pager: '#pager', rowNum: 25,
    sortname: 'pilotid', sortorder: 'asc',
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

$('#jqGrid').jqGrid('filterToolbar',{
                // JSON stringify all data from search, including search toolbar operators
                stringResult: true,
                // instuct the grid toolbar to show the search options
                searchOperators: true
            });
</script>
<script type="text/javascript">
jQuery.noConflict(true);
</script>