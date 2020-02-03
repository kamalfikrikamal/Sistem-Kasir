<?php 
  // Ambil Inhiretance paling Akhir
  require 'Transaksi.php';
  // Inisiasi Class
  $app = new App();
  $product = new Product();
  $transaksi = new Transaksi();
  $row = mysqli_fetch_object( $transaksi->get_transaksi($_GET['id']));
  $data_product = $transaksi->get_produk_transaksi($_GET['id']);
?>
<html moznomarginboxes mozdisallowselectionprint>
    <head>
        <title>
            <?php echo $app->get_app('company_name'); ?> - Cetak Nota
        </title>
        <style type="text/css">
            html {
                font-family: "Verdana";
            }
            .content {
                width: 80mm;
                font-size: 12px;
                padding: 5px;
            }
            .content .title {
                text-align: center;
            }
            .content .head-desc {
                margin-top: 20px;
                display: table;
                width: 100%;
            }
            .content .head-desc > div {
                display: table-cell;
            }
            .content .head-desc .user {
                text-align: right;
            }
            .content .nota {
                text-align: center;
                margin-top: 5px;
                margin-bottom: 5px;
            }
            .content .separate {
                margin-top: 20px;
                margin-bottom: 15px;
                border-top: 1px dashed #000;
            }
            .content .transaction-table {
                width: 100%;
                font-size: 12px;
            }
            .content .transaction-table .name {
                width: 185px;
            }
            .content .transaction-table .qty {
                text-align: center;
            }
            .content .transaction-table .sell-price, .content .transaction-table .final-price {
                text-align: right;
                width: 65px;
            }
            .content .transaction-table tr td {
                vertical-align: top;
            }
            .content .transaction-table .price-tr td {
                padding-top: 5px;
                padding-bottom: 7px;
            }
            .content .transaction-table .discount-tr td {
                padding-top: 7px;
                padding-bottom: 7px;
            }
            .content .transaction-table .separate-line {
                height: 1px;
                border-top: 1px dashed #000;
            }
            .content .thanks {
                margin-top: 25px;
                text-align: center;
            }
            .content .azost {
                margin-top:5px;
                text-align: center;
                font-size:10px;
            }
            @media print {
                @page  { 
                    width: 80mm;
                    margin: 0mm;
                }
            }

        </style>
    </head>
    <body onload=" window.print();"><!-- window.print(); -->
        <div class="content">
            <div class="title">
                <?php echo $app->get_app('company_name'); ?><br><?php echo $app->get_app('company_address'); ?>            
            </div>
            <div class="head-desc">
                <div class="date"><?php echo $row->tanggal; ?></div>
                
                <div class="user">Nota : <?php echo $row->no_faktur; ?> </div>
            </div>
          

            <div class="separate"></div> 
            <table class="transaction-table" cellspacing="0" cellpadding="0">
                <table class="transaction-table" cellspacing="1" cellpadding="1">
                <tr>
                    <td class='name'>Nama Barang</td>
                    <td class='qty'>Jumlah</td>
                    <td class='sell-price'>Harga Satuan</td>
                    <td class='final-price'>Total Harga</td>
                </tr>
                <tr class="price-tr">
                      <td colspan="4"><div class="separate-line"></div></td>
                    </tr>
            
            <div class="transaction">
                <table class="transaction-table" cellspacing="0" cellpadding="0">
                <?php $sub = 0; while($produk = mysqli_fetch_object($data_product)) : ?>
                    
                    <tr>
                      <td class='name'><?php echo $produk->nama_produk; ?></td>
                      <td class='qty'><?php echo $produk->quantity; ?></td>  
                      <td class='sell-price'><?php echo number_format($produk->harga); ?></td>  
                      <td class='final-price'><?php echo number_format($produk->subtotal); ?></td>
                    </tr>                    
                    <tr class="price-tr">
                      <td colspan="4"><div class="separate-line"></div></td>
                    </tr>
                <?php $sub += $produk->subtotal;  endwhile; ?>
                  <!--   <tr>
                        <td colspan="3" class="final-price"></td>
                        <td class="final-price"><?php echo number_format($sub); ?></td>
                    </tr>
                   <tr class="price-tr">
                      <td colspan="4"><div class="separate-line"></div></td>
                    </tr> -->
                    <tr>
                        <td colspan="3" class="final-price">Total Belanja</td>
                        <td class="final-price"><?php echo number_format($row->total); ?></td>
                    </tr>
                    <tr>
                        <td colspan="3" class="final-price"> Bayar</td>
                        <td class="final-price"><?php echo number_format($row->bayar); ?></td>
                    </tr>
                    <tr>
                        <td colspan="3" class="final-price">Kembali</td>
                        <td class="final-price"><?php $hitung = $row->bayar - $row->total; echo number_format($hitung); ?></td>
                    </tr>
                </table>
            </div>
            <div class="thanks">
                ~~~ Terima Kasih ~~~
            </div>
            <div class="azost">
            </div>
        </div>
    </body>
</html>