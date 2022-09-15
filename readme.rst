#########################################################
What is Datatable Server Side Pagination for Codeigniter
#########################################################

Datatable Server Side Pagination for Codeignter is solution small and simple 
that implements through classes a way for optimise your time when use old versions from CI framework together with 
JavaScript Datatable component . 

This classes implements server side pagination
from easy mode throught recover data by CI Query Builder or by ORACLE SQL instructions.

Pherhaps recover by SQL Query correctly work in distincts databases diferents the ORCALE, we strength recomend make 
tests in your database and report to us result so we can improve this solution for developers community.

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

The files oferred are :

- View File (ex.: welcome_message.php) : Example for when to set up Datatables in your HTML file, this is principal step for this solucion correctly work . You must change only this file, i.e. your view file . You can rename this file as necessary.

- DTparams.php : This file is a CI Library, and needs to be placed your CI Library folder. No need change this file.

- DTController.php : This file is a CI Controller, and needs to be placed your CI Controller folder. No need change this file.

- DTModel.php : This file is a CI Model, and needs to be placed your CI Model folder. No need change this file.

****************************
Installation and utilization
****************************

- **STEP 1**
Save files in your due location according your type, i.e. Controller DTController.php in your controller folder, Model DTModel.php in your model folder and finnaly Library DTparams.php in your library folder.

- **STEP 2**
Change your autoload.php for load the library file DTparams. Maybe you preffer load this file in Controller __construct , this alternative is possible too.

	$autoload['libraries'] = array('dtparams'); /** Define dtparams do autoload */

- **STEP 3**
Remember the name database connection for use in Datatables in call parameter.

- **STEP 4**
Implements your HTML view CI file according you need, follow example of Datatabes definitions,
watch out for no change!!! name JavaScript , they need be preserved!	
This step is most as  important as same them others beacuse here, you set use Query Builder or SQL Query 
for recover data.

*For SQL Query recover data you need ony fill :* 

- DTModelSQL       = "SELECT COLUMN_NAME FROM TABLE_NAME";   /** WHERE condition must be defined only DTFilterView array, no defined here, ok?! */

- DbConnectionName = "db";  /** Set CI connection name, db for default. is obrigatory , informe your database CI connection name, default value is db  */

- DTUrl             = "<?= base_url('/index.php/DTController/index') ?>";  /** Set URL datatable recover data through controller  */

**When fill variable DTModelSQL with a query, the controller set SQL Query as principal method to recover data and not use CI Query Builder, but, if you fill ColumnReplace, ColumnSearch and/or DTFilterView , this values be used to recover data together your query and your data presentention.  This variables not required for DTModelSQL recover.**


*For CI Query Builder recover data you need ony fill :*

- DTModelSQL       = "" /** For use CI Query Bulder let this variable blank or null */

- TableName        = "TABLE_NAME"; /** Set principal table name */

- TableJoin       = [ /** Set relacioship tables  */
		{
			TABLE_LEFT   : "PROFILE", 
			TABLE_RIGHT  : "USERS",
			KEY_TB_LEFT  : "ID",
			KEY_TB_RIGHT : "CD_PROFILE",
			DIRECTION    : "INNER"	
		},
	];

- DbConnectionName = "db";  /** Set CI connection name, db for default. is obrigatory , informe your database CI connection name, default value is db  */

- DTUrl             = "<?= base_url('/index.php/DTController/index') ?>";  /** Set URL datatable recover data through controller  */

- ColumnReplace     = [{}];  /** Define replace value , is optional, use for replave values for othes or fa icons or others in your datatables */

- ColumnSearch      =[];  /** Define column for datatable search, is optinal, define columns name you use for Datatables Global Seach  */

- ColumnOrder       =[];  /** Set column orderable and direction */ 

- DTFilterView      =[]; /** Define table.name and forms values for query filter , is optional, define the data in use for HTML forms for WHERE filter in table */

- **STEP 5**

*Configuration example:*

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

** Report security issues and improvement suggestions for `<mailto:helto.e.oliveira@gmail.com>`, thank you. **
