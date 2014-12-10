</div> <!-- /container -->

<!-- BEGIN JAVASCRIPTS (Load javascripts at bottom, this will reduce page load time) -->
<!-- BEGIN CORE PLUGINS -->
<!--[if lt IE 9]>
<script src="<?php echo URL; ?>public/vendor/metronic/global/plugins/respond.min.js"></script>
<script src="<?php echo URL; ?>public/vendor/metronic/global/plugins/excanvas.min.js"></script> 
<![endif]-->
<script src="<?php echo URL; ?>public/vendor/metronic/global/plugins/jquery.min.js" type="text/javascript"></script>
<script src="<?php echo URL; ?>public/vendor/metronic/global/plugins/jquery-migrate.min.js" type="text/javascript"></script>
<!-- IMPORTANT! Load jquery-ui-1.10.3.custom.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->
<script src="<?php echo URL; ?>public/vendor/metronic/global/plugins/jquery-ui/jquery-ui-1.10.3.custom.min.js" type="text/javascript"></script>
<script src="<?php echo URL; ?>public/vendor/metronic/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="<?php echo URL; ?>public/vendor/metronic/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js" type="text/javascript"></script>
<script src="<?php echo URL; ?>public/vendor/metronic/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<script src="<?php echo URL; ?>public/vendor/metronic/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
<script src="<?php echo URL; ?>public/vendor/metronic/global/plugins/jquery.cokie.min.js" type="text/javascript"></script>
<script src="<?php echo URL; ?>public/vendor/metronic/global/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>
<!-- END CORE PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="<?php echo URL; ?>public/vendor/metronic/global/plugins/jqvmap/jqvmap/jquery.vmap.js" type="text/javascript"></script>
<script src="<?php echo URL; ?>public/vendor/metronic/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.russia.js" type="text/javascript"></script>
<script src="<?php echo URL; ?>public/vendor/metronic/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.world.js" type="text/javascript"></script>
<script src="<?php echo URL; ?>public/vendor/metronic/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.europe.js" type="text/javascript"></script>
<script src="<?php echo URL; ?>public/vendor/metronic/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.germany.js" type="text/javascript"></script>
<script src="<?php echo URL; ?>public/vendor/metronic/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.usa.js" type="text/javascript"></script>
<script src="<?php echo URL; ?>public/vendor/metronic/global/plugins/jqvmap/jqvmap/data/jquery.vmap.sampledata.js" type="text/javascript"></script>
<!-- IMPORTANT! fullcalendar depends on jquery-ui-1.10.3.custom.min.js for drag & drop support -->
<script src="<?php echo URL; ?>public/vendor/metronic/global/plugins/morris/morris.min.js" type="text/javascript"></script>
<script src="<?php echo URL; ?>public/vendor/metronic/global/plugins/morris/raphael-min.js" type="text/javascript"></script>
<script src="<?php echo URL; ?>public/vendor/metronic/global/plugins/jquery.sparkline.min.js" type="text/javascript"></script>
<script src="<?php echo URL; ?>public/vendor/metronic/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js" type="text/javascript" ></script>
<script src="<?php echo URL; ?>public/vendor/metronic/global/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js" type="text/javascript" ></script>
<script src="<?php echo URL; ?>public/vendor/metronic/global/plugins/clockface/js/clockface.js" type="text/javascript" ></script>
<script src="<?php echo URL; ?>public/vendor/metronic/global/plugins/bootstrap-daterangepicker/moment.min.js" type="text/javascript" ></script>
<script src="<?php echo URL; ?>public/vendor/metronic/global/plugins/bootstrap-daterangepicker/daterangepicker.js" type="text/javascript" ></script>
<script src="<?php echo URL; ?>public/vendor/metronic/global/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.js" type="text/javascript" ></script>
<script src="<?php echo URL; ?>public/vendor/metronic/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js" type="text/javascript" ></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="<?php echo URL; ?>public/vendor/metronic/global/scripts/metronic.js" type="text/javascript"></script>
<script src="<?php echo URL; ?>public/vendor/metronic/admin/layout3/scripts/layout.js" type="text/javascript"></script>
<script src="<?php echo URL; ?>public/vendor/metronic/admin/layout3/scripts/demo.js" type="text/javascript"></script>
<script src="<?php echo URL; ?>public/vendor/metronic/admin/pages/scripts/components-pickers.js"></script>
<script src="<?php echo URL; ?>public/vendor/metronic/admin/pages/scripts/index3.js" type="text/javascript"></script>
<script src="<?php echo URL; ?>public/vendor/metronic/admin/pages/scripts/tasks.js" type="text/javascript"></script>
<!-- END PAGE LEVEL SCRIPTS -->
<script>
jQuery(document).ready(function() {    
   Metronic.init(); // init metronic core componets
   Layout.init(); // init layout
   Demo.init(); // init demo(theme settings page)
   ComponentsPickers.init();
   Index.init(); // init index page
   Tasks.initDashboardWidget(); // init task dashboard widget
});
</script>

<script src="<?php echo URL; ?>public/js/application.js" type="text/javascript"></script>

<!-- END JAVASCRIPTS -->

</body>
</html>
