"use strict";
// Class definition

var KTDatatableJsonRemoteDemo = function () {
	// Private functions

	// basic demo
	var demo = function () {

		var datatable = $('.kt_datatable').KTDatatable({
			// datasource definition
			data: {
				type: 'remote',
				source: 'https://keenthemes.com/keen/tools/preview/inc/api/datatables/datasource/employee.json',
				pageSize: 10,
			},

			// layout definition
			layout: {
				scroll: false, // enable/disable datatable scroll both horizontal and vertical when needed.
				footer: false // display/hide footer
			},

			// column sorting
			sortable: true,

			pagination: true,

			search: {
				input: $('#generalSearch')
			},

			// columns definition
			columns: [
				{
					field: 'id',
					title: '#',
					sortable: false,
					width: 20,
					type: 'number',
					selector: {class: 'kt-checkbox--solid'},
					textAlign: 'center',
				}, {
					field: 'employee_id',
					title: 'Employee ID',
				}, {
					field: 'name',
					title: 'Name',
					template: function(row) {
						return row.first_name + ' ' + row.last_name;
					},
				}, {
					field: 'phone',
					title: 'Phone',
				}, {
					field: 'hire_date',
					title: 'Hire Date',
					type: 'date',
					format: 'MM/DD/YYYY',
				}, {
					field: 'status',
					title: 'Status',
					// callback function support for column rendering
					template: function(row) {
						var status = {
							1: {'title': 'Pending', 'class': 'kt-badge--brand'},
							2: {'title': 'Delivered', 'class': ' kt-badge--metal'},
							3: {'title': 'Canceled', 'class': ' kt-badge--primary'},
							4: {'title': 'Success', 'class': ' kt-badge--success'},
							5: {'title': 'Info', 'class': ' kt-badge--info'},
							6: {'title': 'Danger', 'class': ' kt-badge--danger'},
							7: {'title': 'Warning', 'class': ' kt-badge--warning'},
						};
						return '<span class="kt-badge ' + status[row.status].class + ' kt-badge--inline kt-badge--pill">' + status[row.status].title + '</span>';
					},
				}, {
					field: 'type',
					title: 'Type',
					autoHide: false,
					// callback function support for column rendering
					template: function(row) {
						var status = {
							1: {'title': 'Online', 'state': 'danger'},
							2: {'title': 'Retail', 'state': 'primary'},
							3: {'title': 'Direct', 'state': 'accent'},
						};
						return '<span class="kt-badge kt-badge--' + status[row.type].state + ' kt-badge--dot"></span>&nbsp;<span class="kt-font-bold kt-font-' + status[row.type].state + '">' +
								status[row.type].title + '</span>';
					},
				}, {
					field: 'Actions',
					title: 'Actions',
					sortable: false,
					width: 110,
					autoHide: false,
					overflow: 'visible',
					template: function() {
						return '\
						<div class="dropdown">\
							<a href="javascript:;" class="btn btn-sm btn-clean btn-icon btn-icon-md" data-toggle="dropdown">\
                                <i class="la la-ellipsis-h"></i>\
                            </a>\
						  	<div class="dropdown-menu dropdown-menu-right">\
						    	<a class="dropdown-item" href="#"><i class="la la-edit"></i> Edit Details</a>\
						    	<a class="dropdown-item" href="#"><i class="la la-leaf"></i> Update Status</a>\
						    	<a class="dropdown-item" href="#"><i class="la la-print"></i> Generate Report</a>\
						  	</div>\
						</div>\
						<a href="javascript:;" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Edit details">\
							<i class="la la-edit"></i>\
						</a>\
						<a href="javascript:;" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Delete">\
							<i class="la la-trash"></i>\
						</a>\
					';
					},
				}],

		});

    $('#kt_form_status').on('change', function() {
      datatable.search($(this).val().toLowerCase(), 'status');
    });

    $('#kt_form_type').on('change', function() {
      datatable.search($(this).val().toLowerCase(), 'type');
    });

    $('#kt_form_status,#kt_form_type').selectpicker();

	};

	var animals_datatable = function() {

		var datatable = $('.animals_datatable').KTDatatable({
			// datasource definition
			data: {
				type: 'remote',
				source: 'assets/php/json/animals.json',
				pageSize: 10,
			},

			// layout definition
			layout: {
				scroll: false,
				footer: false,
				
				spinner : {
					message: 'Παρακαλώ περιμένετε',
				},
			},

			// column sorting
			sortable: true,

			pagination: true,

			search: {
				input: $('#generalSearch'),
			},

			// columns definition
			columns: [
				{
					field: 'animal_un_number',
					title: 'Αριθμός Ενωτίου',
					type: 'number',
					textAlign: 'center',
				}, {
					field: 'animal_sex',
					title: 'Φύλο',
					textAlign: 'center',
				}, {
					field: 'animal_type',
					title: 'Είδος',
					textAlign: 'center',
				}, {
					field: 'animal_species',
					title: 'Φυλή',
					textAlign: 'center',
				}, {
					field: 'animal_age_group',
					title: 'Ηλιακιακό Γκρουπ',
					textAlign: 'center',
				},{
					field: 'animal_vaccination',
					title: 'Κατάσταση Εμβολιασμού',
					width: 130,
					textAlign: 'center',
					// callback function support for column rendering
					template: function(row) {
						var status = {
							Ναι: {'animal_vaccination': 'Εμβολιασμένο', 'class': 'kt-badge--brand'},
							Όχι: {'animal_vaccination': 'Μη Εμβολιασμένο', 'class': ' kt-badge--danger'},
							Εκκρεμεί: {'animal_vaccination': 'Εκκρεμεί', 'class': ' kt-badge--primary'},
						};
						return '<span class="kt-badge ' + status[row.animal_vaccination].class + ' kt-badge--inline kt-badge--pill">' + status[row.animal_vaccination].animal_vaccination + '</span>';
					},
				}, {
					field: 'animal_birth',
					title: 'Hμ. Γέννησης',
					type: 'date',
					format: 'YYYY/MM/DD',
					textAlign: 'center',
				},{
					field: 'animal_mother',
					title: 'Αριθμός Ενωτίου Μητέρας',
					autoHide: true
				}, {
					field: 'Actions',
					title: 'Ενέργειες',
					sortable: false,
					width: 110,
					overflow: 'visible',
					autoHide: false,
					template: function() {
						return '\
						<a href="javascript:;" class="btn btn-sm btn-clean btn-icon btn-icon-sm js-edit-animal"  data-toggle="modal" data-target=".edit-modal"  title="Επεξεργασία">\
							<i class="flaticon2-paper"></i>\
						</a>\
						<a href="javascript:;" class="btn btn-sm btn-clean btn-icon btn-icon-sm js-delete-animal" data-toggle="modal" data-target=".delete-modal" title="Διαγραφή">\
							<i class="flaticon2-trash"></i>\
						</a>\
					';
					},
				}],

		});

	$('#record').on('click', function() {
			datatable.reload();	
	});
	
	setInterval(function(){ datatable.reload(); }, 10000);

	
};

var milk_production_datatable = function() {

	var datatable = $('.milk_production_datatable').KTDatatable({
		// datasource definition
		data: {
			type: 'remote',
			source: 'assets/php/json/milk_production.json',
			pageSize: 10,
		},

		// layout definition
		layout: {
			scroll: false,
			footer: false,
			
			spinner : {
				message: 'Παρακαλώ περιμένετε',
			},
		},

			

		// column sorting
		sortable: true,

		pagination: true,

		search: {
			input: $('#generalSearch'),
		},

		// columns definition
		columns: [
			{
				field: 'milk_date',
				title: 'Ημ. Παραγωγής',
				type: 'date',
				format: 'YYYY/MM/DD',
				textAlign: 'center',
				template: function(row) {
					return '<span class="milk_production_id" id="'+row.production_id+'">' +row.milk_date +'</span>'   ;
				},
			}, {
				field: 'milk_type',
				title: 'Είδος',
				textAlign: 'center',
			}, {
				field: 'milk_quantity',
				title: 'Ποσότητα (Λίτρα)',
				textAlign: 'center',
				template: function(row) {
					return row.milk_quantity + ' λ.';
				},
			}, {
				field: 'milk_cellulars',
				title: 'Αριθμός Σώματικών Κυττάρων',
				textAlign: 'center',
			}, {
				field: 'milk_protein',
				title: 'Πρωτεΐνες ',
				textAlign: 'center',
				template: function(row) {
					return row.milk_protein + ' %';
				},
			}, {
				field: 'milk_fat',
				title: 'Λίπος ',
				textAlign: 'center',
				template: function(row) {
					return row.milk_fat + ' %';
				},
			}, {
				field: 'milk_price',
				title: 'Τιμή (Ανά Λίτρο) ',
				textAlign: 'center',
				template: function(row) {
					return row.milk_price + ' €';
				},
			}, {
				field: 'milk_sum',
				title: 'Συνολικό Κέρδος',
				textAlign: 'center',
				width: 100,
				template: function(row) {
					return row.milk_sum + ' €';
				},
			}, {
				field: 'Actions',
				title: 'Ενέργειες',
				sortable: false,
				width: 110,
				overflow: 'visible',
				autoHide: false,
				template: function() {
					return '\
					<a href="javascript:;" class="btn btn-sm btn-clean btn-icon btn-icon-sm js-edit-milk-production"  data-toggle="modal" data-target=".edit-modal" title="Επεξεργασία">\
						<i class="flaticon2-paper"></i>\
					</a>\
					<a href="javascript:;" class="btn btn-sm btn-clean btn-icon btn-icon-sm js-delete-milk-production"  data-toggle="modal" data-target=".delete-milk-modal" title="Διαγραφή">\
						<i class="flaticon2-trash"></i>\
					</a>\
				';
				},
			}],

	});

	$('#milk_record,#up_milk_record,#confirm_milk_delete').on('click', function() {
		datatable.reload();	
	});	

	 
};

var meat_production_datatable = function() {

	var datatable = $('.meat_production_datatable').KTDatatable({
		// datasource definition
		data: {
			type: 'remote',
			source: 'assets/php/json/meat_production.json',
			pageSize: 10,
		},

		// layout definition
		layout: {
			scroll: false,
			footer: false,
			
			spinner : {
				message: 'Παρακαλώ περιμένετε',
			},
		},

			

		// column sorting
		sortable: true,

		pagination: true,

		search: {
			input: $('#generalSearch'),
		},

		// columns definition
		columns: [
			{
				field: 'animal_id',
				title: 'Αριθμός Ενωτίου',
				textAlign: 'center',
			}, {
				field: 'total_weight',
				title: 'Συνολικό Βαρός',
				textAlign: 'center',
				template: function(row) {
					return row.total_weight + ' κ.';
				},
			}, {
				field: 'net_weight',
				title: 'Καθαρό Βαρός',
				textAlign: 'center',
				template: function(row) {
					return row.net_weight + ' κ.';
				},
			}, {
				field: 'price_kilo',
				title: 'Τιμή (Ανά Κιλό)',
				textAlign: 'center',
				template: function(row) {
					return row.price_kilo + ' €';
				},
			}, {
				field: 'total_price',
				title: 'Συνολικό Κέρδος',
				textAlign: 'center',
				template: function(row) {
					return row.total_price + ' €';
				},
			}, {
				field: 'inspection',
				title: 'Επιθεώρηση Σφαγείου',
				textAlign: 'center',
			},{
				field: 'slaughterhouse',
				title: 'Διεύθυνση Σφαγείου',
				textAlign: 'center',
			},{
				field: 'slaughter_date',
				title: 'Ημ. Σφαγής',
				type: 'date',
				format: 'YYYY/MM/DD',
				textAlign: 'center',
			}, {
				field: 'animal_type',
				title: 'Είδος ',
				textAlign: 'center',
			}, {
				field: 'animal_species',
				title: 'Φυλή ',
				textAlign: 'center',
			}, {
				field: 'animal_age_group',
				title: 'Ηλικιακό Γρουπ',
				textAlign: 'center',
			}, {
				field: 'Actions',
				title: 'Ενέργειες',
				sortable: false,
				width: 110,
				overflow: 'visible',
				autoHide: false,
				template: function() {
					return '\
					<a href="javascript:;" class="btn btn-sm btn-clean btn-icon btn-icon-sm js-edit-meat-production" data-toggle="modal" data-target=".edit-meat-modal" title="Επεξεργασία">\
						<i class="flaticon2-paper"></i>\
					</a>\
					<a href="javascript:;" class="btn btn-sm btn-clean btn-icon btn-icon-sm js-delete-meat-production" data-toggle="modal" data-target=".delete-meat-modal" title="Διαγραφή">\
						<i class="flaticon2-trash"></i>\
					</a>\
				';
				},
			}],

	});

	$('#meat_record,#confirm_meat_update,#confirm_meat_delete').on('click', function() {
		datatable.reload();	
	});	

	 
};

var reproduction_datatable = function() {

	var datatable = $('.reproduction_datatable').KTDatatable({
		// datasource definition
		data: {
			type: 'remote',
			source: 'assets/php/json/reproduction.json',
			pageSize: 10,
		},

		// layout definition
		layout: {
			scroll: false,
			footer: false,
			
			spinner : {
				message: 'Παρακαλώ περιμένετε',
			},
		},

			

		// column sorting
		sortable: true,

		pagination: true,

		search: {
			input: $('#generalSearch'),
		},

		// columns definition
		columns: [
			{
				field: 'animal_id',
				title: 'Αριθμός Ενωτίου',
				textAlign: 'center',
			}, {
				field: 'birth_day',
				title: 'Ημ. Γέννας',
				type: 'date',
				format: 'YYYY/MM/DD',
				textAlign: 'center',
			}, {
				field: 'infants_number',
				title: 'Αριθμός Νεογνών',
				textAlign: 'center',
			},{
				field: 'animal_type',
				title: 'Είδος',
				textAlign: 'center',
			}, {
				field: 'animal_species',
				title: 'Φυλή',
				textAlign: 'center',
			}, {
				field: 'Actions',
				title: 'Ενέργειες',
				sortable: false,
				width: 110,
				overflow: 'visible',
				autoHide: false,
				template: function() {
					return '\
					<a href="javascript:;" class="btn btn-sm btn-clean btn-icon btn-icon-sm js-delete-reproduction" data-toggle="modal" data-target=".delete-reproduction-modal" title="Διαγραφή">\
						<i class="flaticon2-trash"></i>\
					</a>\
				';
				},
			}],

	});

	$('#reproduction_record,#confirm_reproduction_delete').on('click', function() {
		datatable.reload();	
	});	

	 
};

var reproduction_statics_datatable = function() {

	var datatable = $('.reproduction_statics_datatable').KTDatatable({
		// datasource definition
		data: {
			type: 'remote',
			source: 'assets/php/json/reproduction_statics.json',
			pageSize: 10,
		},

		// layout definition
		layout: {
			scroll: false,
			footer: false,
			
			spinner : {
				message: 'Παρακαλώ περιμένετε',
			},
		},

			

		// column sorting
		sortable: true,

		pagination: true,

		search: {
			input: $('#generalSearch'),
		},

		// columns definition
		columns: [
			{
				field: 'animal_id',
				title: 'Αριθμός Ενωτίου',
				textAlign: 'center',
				width:240,
				
			}, {
				field: 'births_number',
				title: 'Αριθμός Τοκετών',
				textAlign: 'center',
				width:240,
			
			}, {
				field: 'average_infants',
				title: 'Μ.Ο. Νεογνών ανα Γέννα',
				textAlign: 'center',
				width:240,
				
			},{
				field: 'animal_type',
				title: 'Είδος',
				textAlign: 'center',
			}, {
				field: 'animal_species',
				title: 'Φυλή',
				textAlign: 'center',
			}],

	});
};

var income_datatable = function() {

	var datatable = $('.income_datatable').KTDatatable({
		// datasource definition
		data: {
			type: 'remote',
			source: 'assets/php/json/income.json',
			pageSize: 10,
		},

		// layout definition
		layout: {
			scroll: false,
			footer: false,
			
			spinner : {
				message: 'Παρακαλώ περιμένετε',
			},
		},

			

		// column sorting
		sortable: true,

		pagination: true,

		search: {
			input: $('#generalSearch'),
		},

		// columns definition
		columns: [
			{
				field: 'description',
				title: 'Περιγραφή',
				textAlign: 'center',
				template: function(row) {
					return '<span class="economics_id" id="'+row.economics_id+'">' +row.description +'</span>'   ;
				},
			}, {
				field: 'amount',
				title: 'Ποσό',
				textAlign: 'center',
				template: function(row) {
					return row.amount + ' €';
				},
			}, {
				field: 'date',
				title: 'Ημ. Καταχώρισης',
				type: 'date',
				format: 'YYYY/MM/DD',
				textAlign: 'center',
			}, {
				field: 'Actions',
				title: 'Ενέργειες',
				sortable: false,
				width: 110,
				overflow: 'visible',
				autoHide: false,
				template: function() {
					return '\
					<a href="javascript:;" class="btn btn-sm btn-clean btn-icon btn-icon-sm js-edit-incomes" data-toggle="modal" data-target=".edit-income-modal" title="Επεξεργασία">\
						<i class="flaticon2-paper"></i>\
					</a>\
					<a href="javascript:;" class="btn btn-sm btn-clean btn-icon btn-icon-sm js-delete-incomes" data-toggle="modal" data-target=".delete-income-modal" title="Διαγραφή">\
						<i class="flaticon2-trash"></i>\
					</a>\
				';
				},
			}],

	});

	$('#income_record,#confirm_income_update,#confirm_income_delete,.la-dollar').on('click', function() {
		datatable.reload();	
	});	

	 
};

var outgoings_datatable = function() {

	var datatable = $('.outgoings_datatable').KTDatatable({
		// datasource definition
		data: {
			type: 'remote',
			source: 'assets/php/json/outgoings.json',
			pageSize: 10,
		},

		// layout definition
		layout: {
			scroll: false,
			footer: false,
			
			spinner : {
				message: 'Παρακαλώ περιμένετε',
			},
		},
			
		// column sorting
		sortable: true,

		pagination: true,

		search: {
			input: $('#generalSearch'),
		},

		// columns definition
		columns: [
			{
				field: 'description',
				title: 'Περιγραφή',
				textAlign: 'center',
				template: function(row) {
					return '<span class="economics_id" id="'+row.economics_id+'">' +row.description +'</span>'   ;
				},
			}, {
				field: 'amount',
				title: 'Ποσό',
				textAlign: 'center',
				template: function(row) {
					return row.amount + ' €';
				},
			}, {
				field: 'date',
				title: 'Ημ. Καταχώρισης',
				type: 'date',
				format: 'YYYY/MM/DD',
				textAlign: 'center',
				}, {
					field: 'Actions',
					title: 'Ενέργειες',
					sortable: false,
					width: 110,
					overflow: 'visible',
					autoHide: false,
					template: function() {
						return '\
						<a href="javascript:;" class="btn btn-sm btn-clean btn-icon btn-icon-sm js-edit-outgoings" data-toggle="modal" data-target=".edit-outgoings-modal" title="Επεξεργασία">\
							<i class="flaticon2-paper"></i>\
						</a>\
						<a href="javascript:;" class="btn btn-sm btn-clean btn-icon btn-icon-sm js-delete-outgoings" data-toggle="modal" data-target=".delete-outgoings-modal" title="Διαγραφή">\
							<i class="flaticon2-trash"></i>\
						</a>\
					';
					},
				}],

	});

	$('#outgoings_record,#confirm_outgoings_update,#confirm_outgoings_delete').on('click', function() {
		datatable.reload();	
	});	

	 
};

var medical = function() {

	var datatable = $('.medical_datatable').KTDatatable({
		// datasource definition
		data: {
			type: 'remote',
			source: 'assets/php/json/medical.json',
			pageSize: 10,
		},

		// layout definition
		layout: {
			scroll: false,
			footer: false,
			
			spinner : {
				message: 'Παρακαλώ περιμένετε',
			},
		},
			
		// column sorting
		sortable: true,

		pagination: true,

		search: {
			input: $('#generalSearch'),
		},

		// columns definition
		columns: [
			{
				field: 'title',
				title: 'Τίτλος',
				textAlign: 'center',
				template: function(row) {
					return '<span class="economics_id" id="'+row.medical_id+'">' +row.title +'</span>'   ;
				},
			}, {
				field: 'type',
				title: 'Τύπος',
				textAlign: 'center',
			}, {
				field: 'species',
				title: 'Είδος',
				textAlign: 'center',
			}, {
				field: 'notes',
				title: 'Σχόλια',
				textAlign: 'center',
			}, {
				field: 'vet_contact',
				title: 'Εποικ. με κτηνίατρο',
				textAlign: 'center',
			}, {
				field: 'vet_notes',
				title: 'Οδηγίες Κτηνιάτρου',
				textAlign: 'center',
			},{
				field: 'assessment',
				title: 'Εκτίμηση κινδύνου',
				textAlign: 'center'
			},{
				field: 'inspection_details',
				title: 'Ασθενείς',
				textAlign: 'center',
			},{
				field: 'inspection_details',
				title: 'Αριθμός Ενωτίου',
				textAlign: 'center',
			},{
				field: 'animals_number',
				title: 'Αριθμός Ζώων',
				textAlign: 'center',
			},{
				field: 'animals_number',
				title: 'Ηλικιακό Γκρουπ',
				textAlign: 'center',
			},{
				field: 'date',
				title: 'Ημ. Παρατήρησης',
				type: 'date',
				format: 'YYYY/MM/DD',
				textAlign: 'center',
			},{
				field: 'Actions',
				title: 'Ενέργειες',
				sortable: false,
				width: 110,
				overflow: 'visible',
				autoHide: false,
				template: function() {
					return '\
					<a href="javascript:;" class="btn btn-sm btn-clean btn-icon btn-icon-sm js-delete-medical" data-toggle="modal" data-target=".delete-medical-modal" title="Διαγραφή">\
						<i class="flaticon2-trash"></i>\
					</a>\
				';
				},
			}],

	});

	$('#medical_confirm,#medical_update_confirm,#confirm_medical_delete').on('click', function() {
		datatable.reload();	
	});	

	 
};


	return {
		// public functions
		init: function () {
			demo();
			animals_datatable();
			milk_production_datatable();
			meat_production_datatable();
			reproduction_datatable();
			reproduction_statics_datatable();
			income_datatable();
			outgoings_datatable();
			medical();

		}
	};
}();

jQuery(document).ready(function () {
	KTDatatableJsonRemoteDemo.init();
});



