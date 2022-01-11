<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>KASIR MAKTAM | Dashboard</title>

    <link href="<?= base_url() ?>css/plugins/dataTables/datatables.min.css" rel="stylesheet">

    <link href="<?= base_url() ?>assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= base_url() ?>assets/font-awesome/css/font-awesome.css" rel="stylesheet">

    <!-- Toastr style -->
    <link href="<?= base_url() ?>assets/css/plugins/toastr/toastr.min.css" rel="stylesheet">

    <!-- Gritter -->
    <link href="<?= base_url() ?>assets/js/plugins/gritter/jquery.gritter.css" rel="stylesheet">

    <link href="<?= base_url() ?>assets/css/animate.css" rel="stylesheet">
    <link href="<?= base_url() ?>assets/css/style.css" rel="stylesheet">


    <link href="<?= base_url() ?>assets/css/plugins/dataTables/datatables.min.css" rel="stylesheet">


</head>

<?php
                                                                        $outlet = $this->session->userdata('outlet');
                                                                        echo $outlet;
$jml = 0;
foreach ($jumlah_produk as $jumlah) :
    $jml = $jml + $jumlah['jumlah'];
endforeach
?>

<ul class="nav navbar-top-links navbar-right">

<li>
        <a href="<?= base_url() ?>pos/pos/">
            <i class="fa fa-home"></i> Home
        </a>
    </li>

    <li>
        <a href="<?= base_url() ?>pos/pos/penjualan">
            <i class="fa fa-dollar"></i> Penjualan
        </a>
    </li>

    <li class="dropdown">
        <a class="count-info" href="<?= base_url() ?>pos/cart/cart">
            Bayar
            <i class="fa fa-shopping-cart"></i> <span class="label label-primary"><?php if ($jml != 0) : ?><?= $jml ?><?php endif ?></span>

        </a>
    </li>


    <li>
        <a href="<?= base_url() ?>pos/login">
            <i class="fa fa-sign-out"></i> Log out
        </a>
    </li>
</ul>

<body style="background-color: #2e3944;">