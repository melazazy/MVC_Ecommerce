(function ($) {
	//    "use strict";


	/*  Data Table
	-------------*/



	$('#cats-data-table').DataTable({
		columns: [
			null, // Name
			null, // Position
			null, // Office
			null, // Salary
		],

		lengthMenu: [[10, 20, 50, -1], [10, 20, 50, "All"]],
	});
	$('#banners-data-table').DataTable({
		columns: [
			null, // Name
			null, // Position
			null, // Office
			null, // Office
			null, // Office
		],

		lengthMenu: [[10, 20, 50, -1], [10, 20, 50, "All"]],
	});

	$('#bootstrap-data-table').DataTable({
		columns: [
			null, // Name
			null, // description
			null, // price
			null, // cat
			null, // img
			null,// stock
			null,// feature
			null,  // Manage
		],
		lengthMenu: [[10, 20, 50, -1], [10, 20, 50, "All"]],
	});




	$('#bootstrap-data-table-export').DataTable({
		dom: 'lBfrtip',
		lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]],
		buttons: [
			'copy', 'csv', 'excel', 'pdf', 'print'
		]
	});

	$('#row-select').DataTable({
		initComplete: function () {
			this.api().columns().every(function () {
				var column = this;
				var select = $('<select class="form-control"><option value=""></option></select>')
					.appendTo($(column.footer()).empty())
					.on('change', function () {
						var val = $.fn.dataTable.util.escapeRegex(
							$(this).val()
						);

						column
							.search(val ? '^' + val + '$' : '', true, false)
							.draw();
					});

				column.data().unique().sort().each(function (d, j) {
					select.append('<option value="' + d + '">' + d + '</option>');
				});
			});
		}
	});






})(jQuery);