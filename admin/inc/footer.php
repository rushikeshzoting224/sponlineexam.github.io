			</section>

		</div>
		
		<!--<script src="click.js"></script>-->
		<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
		<script src="https://cdn.datatables.net/buttons/1.7.0/js/dataTables.buttons.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
		<script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.html5.min.js"></script>
		<script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.print.min.js"></script>
		<script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.colVis.min.js"></script>
		<script>
			$(document).ready(function() {
				$('#dataTable').DataTable(
				{
					dom: 'Bfrtip',
					paging: true,
					lengthMenu: [
						[ 10, 25, 50, -1 ],
						[ '10 rows', '25 rows', '50 rows', 'Show all' ]
					],
					buttons: [
					'excelHtml5',
					'print',
					'pdf',
					'colvis',
					'pageLength',
					]
				}
				);
			});
		</script>
	</body>
</html>