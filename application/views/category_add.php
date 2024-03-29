        <div id="page-wrapper" class="gray-bg">
            <div class="row border-bottom">
                <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
                    <div class="navbar-header">
                        <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
                        <form role="search" class="navbar-form-custom" action="search_results.html">
                            <div class="form-group">
                                <input type="text" placeholder="Search for something..." class="form-control" name="top-search" id="top-search">
                            </div>
                        </form>
                    </div>
                    <ul class="nav navbar-top-links navbar-right">
                        <li>
                            <span class="m-r-sm text-muted welcome-message">Admin Maktam</span>
                        </li>

                        <li>
                            <a href="login.html">
                                <i class="fa fa-sign-out"></i> Log out
                            </a>
                        </li>
                    </ul>

                </nav>
            </div>

            <div class="wrapper wrapper-content animated fadeInRight">

                <div class="row">
                    <div class="col-lg-6">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <h5>Tambah Kategori</h5>
                                <div class="ibox-tools">
                                    <a class="collapse-link">
                                        <i class="fa fa-chevron-up"></i>
                                    </a>

                                </div>
                            </div>
                            <div class="ibox-content">


                                    <div class="ibox float-e-margins">
                                        <div class="ibox-content">
                                            <form method="post" class="form-horizontal">
                                                <div class="form-group"><label class="col-lg-2 control-label">Nama</label>
                                                    <div class="col-lg-10"><input name="name" type="text" class="form-control">
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <div class="col-lg-offset-2 col-lg-10">
                                                        <button name="submit" class="btn btn-sm btn-primary" type="submit">Simpan</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>


                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
        </div>



        <!-- Mainly scripts -->
        <script src="<?= base_url() ?>assets/js/jquery-3.1.1.min.js"></script>
        <script src="<?= base_url() ?>assets/js/bootstrap.min.js"></script>
        <script src="<?= base_url() ?>assets/js/plugins/metisMenu/jquery.metisMenu.js"></script>
        <script src="<?= base_url() ?>assets/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

        <!-- Custom and plugin javascript -->
        <script src="<?= base_url() ?>assets/js/inspinia.js"></script>
        <script src="<?= base_url() ?>assets/js/plugins/pace/pace.min.js"></script>

        <!-- Data picker -->
        <script src="<?= base_url() ?>assets/js/plugins/datapicker/bootstrap-datepicker.js"></script>
        <script src="<?= base_url() ?>assets/js/plugins/dataTables/datatables.min.js"></script>

        <script>
            function downloadFileOverview() {
                var date = "<?= $overview->date; ?>";
                console.log(date);
                window.location.href = 'http://api.susumaktam.com/generate-summary?date=' + date;
            };


            $(document).ready(function() {
                $('.dataTables-example').DataTable({
                    pageLength: 5,
                    responsive: true,
                    dom: '<"html5buttons"B>lTfgitp',
                    buttons: [{
                            extend: 'copy'
                        },
                        {
                            extend: 'csv'
                        },
                        {
                            extend: 'excel',
                            title: 'ExampleFile'
                        },
                        {
                            extend: 'pdf',
                            title: 'ExampleFile'
                        },

                        {
                            extend: 'print',
                            customize: function(win) {
                                $(win.document.body).addClass('white-bg');
                                $(win.document.body).css('font-size', '10px');

                                $(win.document.body).find('table')
                                    .addClass('compact')
                                    .css('font-size', 'inherit');
                            }
                        }
                    ]

                });



                window.onload = function() {
                    $('#data_1 .input-group.date').datepicker({
                            todayBtn: "linked",
                            keyboardNavigation: false,
                            forceParse: false,
                            calendarWeeks: true,
                            autoclose: true,
                            dateFormat: "dd-mm-yyyy",

                        })
                        .on("changeDate", function(e) {

                        })
                        .datepicker("setDate", new Date());

                };



            })
        </script>
        </body>

        </html>

        <?php
        function toRupiah($value)
        {
            return "Rp." . number_format($value, 0, ".", ".");
        }
        ?>