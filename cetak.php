<?php


session_start();
 if (!isset($_SESSION['username'])){
    header('location: ../login.php');
  }
require 'system/config.php';

$id = $_GET['id'];

require_once __DIR__ . '/vendor/autoload.php';

$mpdf = new \Mpdf\Mpdf();
$html = '<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Cetak Struk</title>
</head>
<style>
  th, td{
    border-right: 2px dotted;
  }
  h1, h4{
    text-align : center;
    margin-bottom :5px;
  }
</style>
<body>';

$ambil   = $conn->query("SELECT * FROM transaksi WHERE id_transaksi = '$_GET[id]'");
  $hasil   = $ambil->fetch_assoc();
  $kasir   = $hasil['id_kasir'];
  $ambill  = $conn->query("SELECT nama FROM kasir WHERE id_kasir = '$kasir'");
  $resultt = $ambill->fetch_assoc();
  
$html .='<h1>Gorengan Makknyyuuss</h1>
         <h4>Jl. Doang Jadian Kaga no di 3in</h4>
  <p>Kasir : '.$resultt['nama'].'</p>
  <p>Tanggal : '.$hasil['tanggal'].'</p>

  <table  cellpadding="10" cellspacing="1">
    
    <tr>
      <th width="220" style="border-left: 2px dotted;">Gorengan</th>
      <th width="150">Harga</th>
      <th>Jumlah</th>
      <th width="200">Sub Harga</th>
    </tr>';

    $ambil = $conn->query("SELECT * FROM detail_transaksi JOIN gorengan ON detail_transaksi.id_gorengan = gorengan.id_gorengan WHERE id_transaksi = '$_GET[id]'");
                
      $no = 1;
      $sebelumpajak = 0;
      while($result = $ambil -> fetch_assoc()){

$html .='<tr>
          <td style="border-left: 2px dotted;">'.$result["gorengan"].'</td>
          <td style="text-align: center;">Rp. '.number_format($result['harga']).'</td>
          <td style="text-align: center;">'.$result["jumlah"].'</td>';
          $sub = $result['harga']*$result['jumlah'];
$html .='<td style="text-align: center;">Rp. '.number_format($sub).' </td>
        </tr>';
        $sebelumpajak += $sub;
      }
      $pajak = $sebelumpajak*0.05;

  $html.='
          <tr>
              <td colspan="4" style="border-top: 2px dotted; border-left: 2px dotted; "></td>
          </tr>
          <tr>
              <td colspan="3" style="border-left: 2px dotted;">Total Harga</td>
              <td style="text-align: center;">Rp. '.number_format($sebelumpajak).'</td>
          </tr>
          <tr>
              <td colspan="3" style="border-left: 2px dotted;">Pajak 5%</td>
              <td style="text-align: center;">Rp. '.number_format($pajak).' </td>
          </tr>
          <tr>
              <td colspan="3" style="border-left: 2px dotted;">Total Harga + Pajak 5%</td>
              <td style="text-align: center;">Rp. '.number_format($hasil['totalharga']).'</td>
          </tr>';
          if(isset($_SESSION['bayar'])){
  $html.='<tr>
                <td colspan="3" style="border-left: 2px dotted;">Bayar</td>
                <td style="text-align: center;">Rp. ' .number_format($_SESSION['bayar']).'</td>
            </tr>
            <tr>
                <td colspan="3" style="border-left: 2px dotted;">Kembalian</td>';
                $kembalian = $_SESSION['bayar'] - $hasil['totalharga']; 
        $html.='<td style="text-align: center;">Rp. ' .number_format($kembalian). '</td>';
      }
        $html.='</tr>
            </table>
            
            <h4>Terima Kasih</h4>
  
</body>
</html>';
unset($_SESSION['bayar']);
$mpdf->WriteHTML($html);
$mpdf->Output('Struk.pdf','I');