#########################################################
What is Datatable Server Side Pagination for Codeigniter
#########################################################

Datatable Server Side Pagination for Codeignter is as small and simpley 
classes for optimise your time when use olde versions this framework with 
JavaScript Datatable component . This classes implements server side pagination
from easy mode throught recover data by CI Query Builder or by ORACLE SQL instructions.
Pherhaps in same cases the SQL Query pode funvionar in other database, we recomend
strengt test in other database and help us do increse this shortcut developer.

*******************
Release Information
*******************

This repo contains the last version for `_Datatable Server Side Pagination for CodeIgniter download <https://github.com/heoliveira/ci-datatables-server-side-pagination`_ page.

*******************
Server Requirements
*******************

PHP version 5.6 or newer is recommended.

It should work on 5.3.7 as well, but we strongly advise you NOT to run
such old versions of PHP, because of potential security and performance
issues, as well as missing features.

************
Resources
************

The oferred tree files : 
- welcome_message.php : Help you when configure Datatabes in your HTML file, this a view file.
- DTparamns.php : This file is a CI Libraby, and need set in your CI autoload.php
- DTController.php : This file is a CI Libraby, and need set in your CI autoload.php
- DTModel.php : This file is a CI Model, and loaded self demmand classes

************
Installation
************

-  _STEP 1

	Implements your HTML view CI file conforme you need, follow example of Datatabes definitions,
	remember name or JavaScript variables follow devem ser MANTIDAS!	
	This step is most importante same others beacuse here, set use Query Builder or SQL Query 
	for recover data.
	
	Fully the variables follow in :
	
	For SQL Query recover data:
			ColumnReplace: is optional, use for replave values for othes or fa icons or others in your datatables
			ColumnSearch: is optinal, define columns name you use for Datatables Global Seach 
			DTFilterView: is optional, define the data in use for HTML forms for filter in tabble
			DbConnectionName: is obrigatory , informe your database CI connection name, default value is db
			DTModelSQL
	
	For SQL Query or CI Query Builder :
			DTUrl: is obrigatory for all use, set your class path your DTController.
	
TableName :  TableJoin, ColumnOrder, ColumnReplace, ColumnSearch, DTFilterView, DbConnectionName, DTModelSQL, DTUrl
	
	
	<script type="text/javascript">

	/* Set variables by model for datatables server side operations 
	   a SQL query have priority about query builder. */

	let TableName       = "USERS"; /** Set principal table name */

	let TableJoin       = [ /** Set relacioship tables  */
		{
			TABLE_LEFT   : "PROFILE", 
			TABLE_RIGHT  : "USERS",
			KEY_TB_LEFT  : "ID",
			KEY_TB_RIGHT : "CD_PROFILE",
			DIRECTION    : "INNER"	
		},
	];

	let ColumnOrder     = [   /** Set complete table.column for recover data */
		"USERS.CD_UNIT", 
		"USERS.USER_PID", 
		"USERS.NM_USER", 
		"USERS.NM_MGMT", 
		"USERS.NM_SECTOR", 
		"USERS.NM_OFFICE", 
		"USERS.BOND", 
		"USERS.EMAIL", 
		"PROFILE.TP_PROFILE", 
		"USERS.STATUS", 
		"USERS.CHIEF"
	];

	let ColumnReplace   = [  /** Set from/to for replace values  */
		{
			INDEX        :  "10",
			REPLACE      : [
				[
					"0",
					"INACTIVE"
				],
				[
					"1",
					"ACTIVE"
				]
			]
		},
		{
			INDEX        :  "11",
			REPLACE      : [
				[
					"0",
					"INACTIVE"
				],
				[
					"1",
					"ACTIVE"
				],
				[
					"", /** This example replace blanck for fa icon */
					"<i class='fa-sharp fa-solid fa-house'></i>"
				]
			]
		}
	];

	let ColumnSearch    = [ /** Set column for datatable search */ 
		"CD_UNIT", 
		"USER_PID", 
		"NM_USER", 
		"NM_MGMT", 
		"NM_SECTOR", 
		"NM_OFFICE", 
		"BOND", 
		"EMAIL", 
		"PROFILE.TP_PROFILE", 
		"USERS.STATUS", 
		"CHIEF"
	];

	let ColumnOrderable = [ /** Set column orderable and direction */ 
		"CD_UNIT DESC", 
		"USER_PID ASC", 
		"NM_USER ASC"
	];

	let DTFilterView    = [ /** Set table.name and forms values for query filter  */
		[
			"USERS.NM_MGMT", /** Sugesting recover this value from html form */
			"GERAL MANANGER"
		],
		[
			"USERS.USER_PID",/** Sugesting recover this value from html form */
			"101202"
		]
	];

	let DbConnectionName = "db"; /** Set CI connection name, db for default  */

	let DTModelSQL       = ""; /** Recover data by SQL Query, tested for Oracle	 */

	let DTUrl           /** Set URL datatable recover data through controller  */
						= "<?= base_url('/index.php/DTController/index') ?>"; 

	$(document).ready( function () {  /** Defines database controls */
		let myTable = $("#myTable").DataTable({
			processing: true,
			lengthMenu: [ 5, 10, 20, 50, 100, 200, 500],
			serverSide: true,
			order: [],
			ajax : { 
				url     : DTUrl,
				dataSrc :"data",
				type    : "POST",
				data    : { 
							DTModelParams   : {
								TableName        : TableName, 
								TableJoin        : TableJoin, 
								ColumnOrder      : ColumnOrder,
								ColumnSearch     : ColumnSearch,
								ColumnOrderable  : ColumnOrderable,
								ColumnReplace    : ColumnReplace,
								DbConnectionName : DbConnectionName
							},
							DTFilterView    : DTFilterView, 
							DTModelSQL      : DTModelSQL,
						} 
			},
			columnDefs: [{
				targets  : [0],
				orderable: true
			}]
		});
	});
</script>

-  _STEP 2

	Download de the files for yours respective folder :

- DTparamns.php : This file is a CI Libraby, and need set in your CI autoload.php
- DTController.php : This file is a CI Controller, and need set in your CI Controller folder
- DTModel.php : This file is a CI Model, and loaded self demmand classes, you no need load them

-  _STEP 3
		Set your database.php conforme your demmand

Report security issues to our `Security Panel <mailto:helto.e.oliveira@gmail.com>`, thank you.

***************
Acknowledgement
***************

The CodeIgniter team would like to thank EllisLab, all the
contributors to the CodeIgniter project and you, the CodeIgniter user.
