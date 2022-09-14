<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="utf-8">
	<title>Datatable Server-Side Pagination for CodeIgniter</title>

    <script src="https://code.jquery.com/jquery-3.5.0.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.11.2/datatables.min.css" />
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" />
    <script src="https://cdn.datatables.net/v/dt/dt-1.11.2/datatables.min.js"></script>

	<style type="text/css">

	::selection { background-color: #E13300; color: white; }
	::-moz-selection { background-color: #E13300; color: white; }

	body {
		background-color: #fff;
		margin: 40px;
		font: 13px/20px normal Helvetica, Arial, sans-serif;
		color: #4F5155;
	}

	a {
		color: #003399;
		background-color: transparent;
		font-weight: normal;
	}

	h1 {
		color: #444;
		background-color: transparent;
		border-bottom: 1px solid #D0D0D0;
		font-size: 19px;
		font-weight: normal;
		margin: 0 0 14px 0;
		padding: 14px 15px 10px 15px;
	}

	code {
		font-family: Consolas, Monaco, Courier New, Courier, monospace;
		font-size: 12px;
		background-color: #f9f9f9;
		border: 1px solid #D0D0D0;
		color: #002166;
		display: block;
		margin: 14px 0 14px 0;
		padding: 12px 10px 12px 10px;
	}

	#body {
		margin: 0 15px 0 15px;
	}

	p.footer {
		text-align: right;
		font-size: 11px;
		border-top: 1px solid #D0D0D0;
		line-height: 32px;
		padding: 0 10px 0 10px;
		margin: 20px 0 0 0;
	}

	#container {
		margin: 10px;
		border: 1px solid #D0D0D0;
		box-shadow: 0 0 8px #D0D0D0;
	}
	</style>
</head>
<body>

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

<div id="container">
	<h1>Welcome Datatable Server-Side Pagination for CodeIgniter!</h1>
	
	<div id="body">
		<h2>Datatable Server-Side Pagination for CodeIgniter</h2>

		<p>This page contain a alternative for CI(CodeIgniter) pagination server side using Datatables.</p>

		<p>For download and/or contribute in this access font code in my github.
			In my github have details for utilization:
		</p>
		<code>https://github.com/heoliveira/ci-datatables-server-side-pagination</code>

		<p>Follow exemple using component for data pagination:</p>
		<section> <!-- Define HTML datatable --> 
			<div>
				<table id="myTable" class="display" style="font-size: 0.8em;">
					<thead>
						<tr>
							<th >Id</th>
							<th >Unidade</th>
							<th >Masp/Registro</th>
							<th >Nome</th>
							<th >Gerência</th>
							<th >Setor</th>
							<th >Cargo</th>
							<th >BOND</th>
							<th >E-mail</th>
							<th >PROFILE</th>
							<th >Status</th>
							<th >CHIEF</th>
						</tr>
					</thead>
					<tbody>
					</tbody>
				</table>
			</div>
		</section>

		<p>If you are exploring CodeIgniter for the very first time, you should start by reading the <a href="user_guide/">User Guide</a>.</p>
	</div>

	<p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds. <?php echo  (ENVIRONMENT === 'development') ?  'CodeIgniter Version <strong>' . CI_VERSION . '</strong>' : '' ?></p>
</div>

</body>
</html>