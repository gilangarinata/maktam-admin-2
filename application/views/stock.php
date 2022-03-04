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

                <div class="form-group" id="data_1">
                    <form method="post" enctype="multipart/form-data">
                        <div class="input-group date">
                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                            <input name="tanggal" id="date" type="text" class="form-control" value="">
                            <span class="input-group-btn">
                                <button name="submit" type="submit" class="btn btn-sm btn-primary"> Go!</button> </span>
                        </div>
                    </form>
                </div>

                <div class="row">
                    <div class="col-lg-6">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <h5>Laporan Stok Susu</h5>
                                <div class="ibox-tools">
                                    <a class="collapse-link">
                                        <i class="fa fa-chevron-up"></i>
                                    </a>
                                    <a onclick="downloadFileMilk();">
                                        <i class="fa fa-download"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="ibox-content">


                                <table class="table">
                                    <tbody>
                                        <?php $i = 0;
                                        foreach ($stockData[0]->items as $milk) : ?>
                                            <tr>
                                                <td><?= "Total " . $milk->itemName ?></td>
                                                <td><?= $milk->stock ?></td>
                                            </tr>

                                        <?php endforeach; ?>


                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <h5>Laporan Stok Bumbu</h5>
                                <div class="ibox-tools">
                                    <a class="collapse-link">
                                        <i class="fa fa-chevron-up"></i>
                                    </a>

                                    <a onclick="downloadFileSpices();">
                                        <i class="fa fa-download"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="ibox-content">


                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover dataTables-example">
                                        <thead>
                                            <tr>
                                                <th>Bumbu</th>
                                                <th>Stock</th>
                                                <th>Terjual</th>
                                                <th>Sisa</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <?php $i = 0;
                                            foreach ($stockData[2]->items as $spice) : ?>
                                                <tr>
                                                    <td><?= $spice->itemName; ?></td>
                                                    <td><?= $spice->stock; ?></td>
                                                    <td><?= $spice->sold; ?></td>
                                                    <td><?= $spice->left; ?></td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>



                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <h5>Laporan Stok Cup</h5>
                                <div class="ibox-tools">
                                    <a class="collapse-link">
                                        <i class="fa fa-chevron-up"></i>
                                    </a>

                                    <a onclick="downloadFileCup();">
                                        <i class="fa fa-download"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="ibox-content">


                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover dataTables-example">
                                        <thead>
                                            <tr>
                                                <th>Cup</th>
                                                <th>Stock</th>
                                                <th>Terjual</th>
                                                <th>Sisa</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <?php $i = 0;
                                            foreach ($stockData[1]->items as $cup) : ?>
                                                <tr>
                                                    <td><?= $cup->itemName; ?></td>
                                                    <td><?= $cup->stock; ?></td>
                                                    <td><?= $cup->sold; ?></td>
                                                    <td><?= $cup->left; ?></td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>



                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <h5>Cup</h5>
                                <div class="ibox-tools">
                                    <a class="collapse-link">
                                        <i class="fa fa-chevron-up"></i>
                                    </a>

                                </div>
                            </div>
                            <div class="ibox-content">


                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover dataTables-example">
                                        <thead>
                                            <tr>
                                                <th>Cup</th>
                                                <th></th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <?php $i = 0;
                                            foreach ($stockData[1]->items as $cup) : ?>
                                                <tr>
                                                    <td><?= $cup->itemName; ?></td>
                                                    <td><button onclick="location.href = '<?= base_url() ?>stock/delete_cup/<?= $cup->itemId ?>';" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button></td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                                <button onclick="location.href = '<?= base_url() ?>stock/add_cup';" class="btn btn-sm btn-primary">Tambah Cup</button>


                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <h5>Bumbu</h5>
                                <div class="ibox-tools">
                                    <a class="collapse-link">
                                        <i class="fa fa-chevron-up"></i>
                                    </a>

                                </div>
                            </div>
                            <div class="ibox-content">


                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover dataTables-example">
                                        <thead>
                                            <tr>
                                                <th>Bumbu</th>
                                                <th></th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <?php $i = 0;
                                            foreach ($stockData[2]->items as $bumbu) : ?>
                                                <tr>
                                                    <td><?= $bumbu->itemName; ?></td>
                                                    <td><button onclick="location.href = '<?= base_url() ?>stock/delete_spices/<?= $bumbu->itemId ?>';" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button></td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                                <button onclick="location.href = '<?= base_url() ?>stock/add_spices';" class="btn btn-sm btn-primary">Tambah Bumbu</button>


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
            function downloadFileMilk() {
                var url = "<?= $stockData[0]->url; ?>";
                window.location.href = url;
            };

            function downloadFileCup() {
                var url = "<?= $stockData[1]->url; ?>";
                window.location.href = url;
            };

            function downloadFileSpices() {
                var url = "<?= $stockData[2]->url; ?>";
                window.location.href = url;
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