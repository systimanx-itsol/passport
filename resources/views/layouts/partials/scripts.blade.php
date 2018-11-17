
<!-- REQUIRED JS SCRIPTS -->
<!-- DataTables -->
<link rel="stylesheet" href="{{ asset('/css/dataTables.bootstrap.css') }}">
<script src="{{ asset('/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('/js/dataTables.bootstrap.min.js') }}"></script> 

<script type="text/javascript" src="<?php echo asset('js/dataTables.buttons.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo asset('js/buttons.flash.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo asset('js/jszip.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo asset('js/pdfmake.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo asset('js/vfs_fonts.js'); ?>"></script>
<script type="text/javascript" src="<?php echo asset('js/buttons.html5.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo asset('js/buttons.print.min.js'); ?>"></script>

<script>
    $(function () {
        $("#example1").DataTable();
        $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false
        });
    });
</script>

<!-- Bootstrap 3.3.2 JS --> 
<script src="{{ asset('bootstrap/js/bootstrap.min.js') }}" type="text/javascript"></script> 
<script src="{{ asset('js/moment-with-locales.min.js') }}"></script>
<script src="{{ asset('js/bootstrap-datetimepicker.min.js') }}"></script>
<!-- FastClick --> 
<script src="{{ asset('plugins/fastclick/fastclick.min.js') }}"></script> 
<!-- Admin App --> 
<script src="{{ asset('js/app.min.js') }}" type="text/javascript"></script> 

<script src="{{ asset('plugins/moment/moment.min.js') }}" type="text/javascript"></script>

<!-- Optionally, you can add Slimscroll and FastClick plugins.
      Both of these plugins are recommended to enhance the
      user experience. Slimscroll is required when using the
      fixed layout. -->
