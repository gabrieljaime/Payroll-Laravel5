
	<style>
	body {margin-top: 20px;}
	.tab-pane {
		padding-top: 20px;
	}
	</style>
</head>

<body class="skin-blue">
	<!-- Container -->
	<div class="container">

		<!-- Notifications -->
		@include('flash::message')
		<!-- ./ notifications -->

		<div class="page-header">
			<h3>
				{{ $title }}
				<div class="pull-right">
					<button class="btn btn-default btn-small btn-inverse close_popup"><span class="glyphicon glyphicon-circle-arrow-left"></span> Back</button>
				</div>
			</h3>
		</div>

		<!-- Content -->
		@yield('content')
		<!-- ./ content -->

		<!-- Footer -->
		<footer class="clearfix">
			@yield('footer')
		</footer>
		<!-- ./ Footer -->

	</div>
	<!-- ./ container -->

	@yield('scripts')

	<script>
	$(document).ready(function(){
		$('.close_popup').on('click',function(e){
			e.preventDefault();
			parent.jQuery.fn.colorbox.close();
			parent.oTable.fnReloadAjax();
		});
		$('#deleteForm').submit(function(event) {
			var form = $(this);
			$.ajax({
				type: form.attr('method'),
				url: form.attr('action'),
				data: form.serialize()
			}).done(function() {
				parent.jQuery.colorbox.close();
				parent.oTable.fnReloadAjax();
			}).fail(function() {
			});
			event.preventDefault();
		});
	});
	$('.wysihtml5').wysihtml5();
	$(prettyPrint)

	$(document).ready(function() {
    	// select2 style
    	$('.select2').select2();
        // dataTables bootstrap style
        $('.dataTables_length select').select2({width: 80});
        $('.dataTables_filter input').addClass('form-control');
        // Date picker
        $('.datepicker').datepicker({
        	format: 'yyyy-mm-dd'
        });
        // Dual List Box
        $('.select2-multiple').select2({
        	width: '100%'
        });
    });
	</script>
</body>

</html>
