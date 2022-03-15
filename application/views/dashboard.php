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
                                <h5>Tinjauan</h5>
                                <div class="ibox-tools">
                                    <a class="collapse-link">
                                        <i class="fa fa-chevron-up"></i>
                                    </a>
                                    <a onclick="downloadFileOverview();">
                                        <i class="fa fa-download"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="ibox-content">

                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <td>Tanggal</td>
                                            <td><?= date('d-m-Y', strtotime($overview->date)) ?></td>
                                        </tr>
                                        <tr>
                                            <td>Total Modal</td>
                                            <td><?= toRupiah($overview->totalFund) ?></td>
                                        </tr>
                                        <tr>
                                            <td>Total Pengeluaran</td>
                                            <td><?= toRupiah($overview->totalExpense) ?></td>
                                        </tr>
                                        <tr>
                                            <td>Total Pendapatan</td>
                                            <td><?= toRupiah($overview->totalIncome) ?></td>
                                        </tr>
                                        <tr>
                                            <td>Saldo</td>
                                            <td><?= toRupiah($overview->balance) ?></td>
                                        </tr>
                                        <tr>
                                            <td>Omset</td>
                                            <td><?= toRupiah($overview->totalFund + $overview->totalIncome - $overview->totalExpense) ?></td>
                                        </tr>
                                    </tbody>
                                </table>

                            </div>
                        </div>

                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <h5>Pengeluaran Gudang</h5>
                                <div class="ibox-tools">
                                    <a class="collapse-link">
                                        <i class="fa fa-chevron-up"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="ibox-content">

                                <table class="table">
                                    <tbody>
                                        <?php $i = 0;
                                            foreach ($inventory_expense as $inv) : 
                                                $id = $inv["id"];
                                            ?>
                                                <tr class="gradeX">
                                                    <td><?= $inv["name"] ?></td>
                                                    <td><?= $inv["total"] ?></td>
                                                    <td><button onclick="location.href = '<?= base_url() ?>dashboard/delete_inventory?id=<?= $id ?>';" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button></td></td>
                                                </tr>
                                            <?php endforeach; ?>
                                        <tr>
                                            <td><input id="keterangan" id="date" placeholder="Keterangan" type="text" class="form-control" value=""></td>
                                            <td><input id="total" id="date" placeholder="Jumlah" type="text" class="form-control" value=""></td>
                                            <td></td>
                                        </tr>
                                    </tbody>
                                </table>

                                <button onclick="inventorySaveButton('<?= $overview->date ?>');"  class="btn btn-sm btn-primary">Simpan</button>

                            </div>
                        </div>
                        
                    </div>
                    <div class="col-lg-6">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <h5>Data Penjualan</h5>
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
                                                <th>Produk</th>
                                                <th>Penjualan</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $i = 0;
                                            foreach ($products as $product) : ?>
                                                <tr class="gradeX">
                                                    <td><?= $product->name . ' (' . $product->categoryName . ')' ?></td>
                                                    <td><?= $product->sold ?></td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>

                                    </table>
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

            function inventorySaveButton(tanggal){
                var name = $('#keterangan').val();
                var total = $('#total').val();

                if(name){
                    window.location = '<?= base_url() ?>dashboard/add_inventory?date=' + tanggal + '&name='+ name + '&total=' + total;
                }
            }

            function downloadFileOverview() {
                var url = "<?= $overview->urlExcel; ?>";
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