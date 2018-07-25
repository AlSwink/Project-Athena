<style>
	.text-input{
		border: none !important;
		border-bottom: 1px solid #dad9d9 !important;
		border-radius: 0 !important;
	}

	.text-input:focus{
		border: none !important;
		box-shadow: none !important;
		border-bottom: 1.5px solid #62d4e0 !important;
	}	

	.form-control::-webkit-input-placeholder{
		color: #dddddd !important;
		font-size: 15px !important;
		font-style: oblique !important;
	}

	.is-invalid{
	  border-color: red !important;
	}

	.scrollbar::-webkit-scrollbar
	{
	    width: 6px;
	    background-color: #000000;
	}
	 
	.scrollbar::-webkit-scrollbar-thumb
	{
	    border-radius: 10px;
	    -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,.3);
	    background-color: #FFFFFF;
	}

	.dtable td:hover{
		cursor: cell;
	}

	.nav-tabs .nav-link:not(.active){
		border: 1px solid #e9ecef !important;
		color: #495057;
	}

	.nav-tabs .active{
		color: red !important;
	}

	.u_limit{
		font-size: 35% !important;
	}

	.table-form-control,.table-form-control:focus{
		border: none;
		box-shadow: none;
	}

	button[disabled]:hover{
		cursor: not-allowed;
	}

	div.dataTables_scrollBody{
		background-color: white !important;
	}

	label, thead{
		font-size: 12px !important;
	}

	td{
		font-size: 11px;
	}

	@media print{
		@page{
			size : portrait;
		}

		.worksheet{
			page-break-after: always !important;
		}

		 td{
		 	padding: 0;
		 }

		 th{
		 	font-size: 100%;
		 }

		table td{
			font-size: 90% !important;
		}

		
	} 
</style>