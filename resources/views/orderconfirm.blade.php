<!DOCTYPE html>
<html>
<head>
	<title>Weargloeshoes | Status Pembelian</title>
	<link rel="icon" href="{{ asset('/img/logo2.png') }}" />
	<meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">

<!-- General CSS Files -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
</head>
<body>
    @if($status == 1)
    <h1>Pesanan Anda Berhasil Dikonfirmasi</h1>
    <p>Hi, {{$nama}} Terima kasih telah melakukan pemesanan di {{$website}}, Berikut Detail Pesanananmu</p>
    @elseif($status == 2)
    <h1>Pesanan Anda Gagal Dikonfirmasi</h1>
    <p>Hi, {{$nama}} Terima kasih telah melakukan pemesanan di {{$website}}, Namun Pesanan Anda Ditolak oleh Admin (Bisa melakukan upload ulang Bukti Transaksi</p> 
    <p>Berikut Detail Pesanananmu</p>
    @endif
<div class="table-responsive">
    <table class="table table-striped" id="table-1"  style="background-color: #CFD7D4">
      <thead class="table-bordered secondary text-center" style="border:1px #363535;">
        <tr>
            <th>Produk</th>
            <th>Harga Satuan</th>
            <th>Discount</th>
            <th>Kuantitas</th>
            <th>Total Biaya</th>
            <th>Alamat Pengiriman</th>
            <th>No.Telp</th>
            <th>Status</th>
            <th>No.Rekening Seller</th>
            {{-- <th>Bukti</th> --}}
        </tr>
        </thead>
        <tbody style="border-top: 15px solid#CDBABC;">

        <tr>
        <td>

        <div class="row">
            {{-- <div class="col-sm">
              <img src="{{ asset($gambar) }}" alt="Foto" class="img-thumbnail" width="40">
            </div> --}}
            <div class="col-sm">
            <h5><a href="{{$link}}" class="text-dark" style="text-decoration:none;">{{$nama_barang}}</a></h5>
            </div>
            <div class="col-sm">
                <p> Type :  {{$type}}</p>
            </div>
        </div>

        </td>
            <td>
              {{$harga_awal}}
            </td>
            <td>
                @if($diskon == NULL) 0%
                @else {{$diskon}}%
                @endif
            </td>
            <td>
              {{$quantity}}
            </td>
            <td>
              {{$total}}
            </td>
            <td>
              {!! $alamat !!}
            </td>
            <td>
              {{$no_telp}}
            </td>
            <td>
              @if($status == 0)
                  <span class="badge badge-pill badge-warning">Belum Terverifikasi</span>
              @elseif($status == 2)
                  <span class="badge badge-pill badge-danger">Verifikasi Ditolak</span>
              @elseif($status == 1)
                <span class="badge badge-pill badge-success">Verifikasi Diterima</span>
              @endif
           </td>
           <td>
           {{$no_rekening}}
           </td>
           {{-- <td>
            <img src="{{ asset($bukti_tf) }}" class="img-thumbnail" width = "100%">
           </td> --}}
    </tr>   
    <tbody>
  </table>
  </div>


</body>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
</html>