<link rel="stylesheet" href="<?php echo base_url('assets/backend/js/select2/select2-bootstrap.css');?>">
<link rel="stylesheet" href="<?php echo base_url('assets/backend/js/select2/select2.css');?>">
<link rel="stylesheet" href="<?php echo base_url('assets/backend/js/selectboxit/jquery.selectBoxIt.css');?>">

	<!-- Bottom Scripts -->
<script src="<?php echo base_url('assets/backend/js/gsap/main-gsap.js');?>"></script>
<script src="<?php echo base_url('assets/backend/js/jquery-ui/js/jquery-ui-1.10.3.minimal.min.js');?>"></script>
<script src="<?php echo base_url('assets/backend/js/bootstrap.js');?>"></script>
<script src="<?php echo base_url('assets/backend/js/joinable.js');?>"></script>
<script src="<?php echo base_url('assets/backend/js/resizeable.js');?>"></script>
<script src="<?php echo base_url('assets/backend/js/neon-api.js');?>"></script>
<script src="<?php echo base_url('assets/backend/js/toastr.js');?>"></script>
<script src="<?php echo base_url('assets/backend/js/jquery.validate.min.js');?>"></script>
<script src="<?php echo base_url('assets/backend/js/fullcalendar/fullcalendar.min.js');?>"></script>
<script src="<?php echo base_url('assets/backend/js/bootstrap-datepicker.js');?>"></script>
<script src="<?php echo base_url('assets/backend/js/bootstrap-timepicker.min.js');?>"></script>
<script src="<?php echo base_url('assets/backend/js/fileinput.js');?>"></script>
<script src="<?php echo base_url('assets/backend/js/jquery.multi-select.js');?>"></script>

<script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
<script src="//cdn.datatables.net/buttons/1.2.4/js/dataTables.buttons.min.js"></script>
<script src="//cdn.datatables.net/buttons/1.2.4/js/buttons.flash.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.4/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.4/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.4/js/buttons.colVis.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>

<script src="<?php echo base_url('assets/backend/js/select2/select2.min.js');?>"></script>
<script src="<?php echo base_url('assets/backend/js/selectboxit/jquery.selectBoxIt.min.js');?>"></script>


<script src="<?php echo base_url('assets/backend/js/neon-calendar.js');?>"></script>
<script src="<?php echo base_url('assets/backend/js/neon-chat.js');?>"></script>
<script src="<?php echo base_url('assets/backend/js/neon-custom.js');?>"></script>
<script src="<?php echo base_url('assets/backend/js/neon-demo.js');?>"></script>

<script src="<?php echo base_url('assets/backend/js/wysihtml5/wysihtml5-0.4.0pre.min.js');?>"></script>
<script src="<?php echo base_url('assets/backend/js/wysihtml5/bootstrap-wysihtml5.js');?>"></script>

<!-- SHOW TOASTR NOTIFIVATION -->
<?php if ($this->session->flashdata('flash_message') != ""):?>

<script type="text/javascript">
	toastr.success('<?php echo $this->session->flashdata("flash_message");?>');
</script>

<?php endif;?>

<?php if ($this->session->flashdata('error_message') != ""):?>

<script type="text/javascript">
	toastr.error('<?php echo $this->session->flashdata("error_message");?>');
</script>

<?php endif;?>


<!---  DATA TABLE EXPORT CONFIGURATIONS -->
<script type="text/javascript">
	jQuery(document).ready(function($)
	{

        $('#table_export').DataTable( {
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ]
        } );
	});
</script>


<script>
    $(function() {
        let copyButtonTrans = 'Copy'
        let csvButtonTrans = 'Csv'
        let excelButtonTrans = 'Excel'
        let pdfButtonTrans = 'Pdf'
        let printButtonTrans = 'Print'
        let colvisButtonTrans = 'Clovis'


        let languages = {
            'en': 'https://cdn.datatables.net/plug-ins/1.10.19/i18n/English.json'
        };

        $.extend(true, $.fn.dataTable.Buttons.defaults.dom.button, { className: 'btn' })
        $.extend(true, $.fn.dataTable.defaults, {
            language: {
                url: languages['{{ app()->getLocale() }}']
            },
            columnDefs: [{
                orderable: false,
                className: 'select-checkbox',
                targets: 0
            }, {
                orderable: false,
                searchable: false,
                targets: -1
            }],
            select: {
                style:    'multi+shift',
                selector: 'td:first-child'
            },
            order: [],
            scrollX: true,
            pageLength: 100,
            dom: 'lBfrtip<"actions">',
            buttons: [
                {
                    extend: 'copy',
                    className: 'btn-default',
                    text: copyButtonTrans,
                    exportOptions: {
                        columns: ':visible'
                    }
                },
                {
                    extend: 'csv',
                    className: 'btn-default',
                    text: csvButtonTrans,
                    exportOptions: {
                        columns: ':visible'
                    }
                },
                {
                    extend: 'excel',
                    className: 'btn-default',
                    text: excelButtonTrans,
                    exportOptions: {
                        columns: ':visible'
                    }
                },
                {
                    extend: 'pdf',
                    className: 'btn-default',
                    text: pdfButtonTrans,
                    exportOptions: {
                        columns: ':visible'
                    }
                },
                {
                    extend: 'print',
                    className: 'btn-default',
                    text: printButtonTrans,
                    exportOptions: {
                        columns: ':visible'
                    }
                },
                {
                    extend: 'colvis',
                    className: 'btn-default',
                    text: colvisButtonTrans,
                    exportOptions: {
                        columns: ':visible'
                    }
                }
            ]
        });

        $.fn.dataTable.ext.classes.sPageButton = '';
    });

</script>
