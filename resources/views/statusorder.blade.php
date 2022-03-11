@extends('layouts.transaksi')

@section('content')
<nav class="navbar-lg navbar-light bg-white">
<div class="container px-2">
<a href="/" class="navbar-brand">Weargloeshoes | Status Pembelian</a>

</div>
</nav>
<section class="section">
<div class="card card-danger" style="background-color: #CDBABC">
<div class="card-body">
    @if(Session::has('berhasil'))
    <div class="alert alert-success" role="alert">
        {{Session('berhasil')}}
    </div>
    @endif
    @if(Session::has('gagal'))
    <div class="alert alert-danger" role="alert">
        {{Session('gagal')}}
    </div>
    @endif
<div class="container">
<div class="card card-primary p-2" style="background-color: #CDBABC; border-radius: 5px; background: #CDBABC; box-shadow:  20px 20px 60px #ae9ea0, -20px -20px 60px #ecd6d8;">
  {{-- <div class="card-body-action">
    <div class="btn-group btn-group-lg">
    <a href="/cart" class="btn btn-secondary" style="color: #292b2c; display:block">Cart</a>
      <a href="/statusbeli" class="btn btn-red">Status Pembelian</a>
      <a href="/historybeli" class="btn btn-success">History Pembelian</a>
    </div>
  </div> --}}
  <div class="table-responsive">
    <table class="table table-striped" id="table-1"  style="background-color: #CFD7D4">
      <thead class="table-bordered secondary text-center" style="border:1px #363535;">
        <tr>
            <th>Produk</th>

            <th>Harga Satuan</th>
            <th>Kuantitas</th>
            <th>Total Biaya</th>
            <th>Alamat Pengiriman</th>
            <th>No.Telp</th>
            <th>Status</th>
            <th>No.Rekening Seller</th>
            <th>Bukti</th>
            <th>Aksi</th>
            @if(session()->get('auth')->level == 1)
            <th>Hapus</th>
            @endif
        </tr>
        </thead>
        @if(!empty($payment))
        @foreach($payment as $data)
        <tbody style="border-top: 15px solid#CDBABC;">

        <tr>
        {{--<hr>--}}
        
        <td>

        <div class="row">
            <div class="col-sm">
              <img src="{{ asset($data->product_image) }}" alt="Foto" class="img-thumbnail" width="40">
            </div>
            <div class="col-sm">
            <h5><a href="/detail/{{$data->product_id}}" class="text-dark" style="text-decoration:none;">{{$data->product->product_name}}</a></h5>
            </div>
            <div class="col-sm">
                <p> Type :  {{$data->product->product_type}}</p>
            </div>
        </div>

        </td>
            <td>
              {{$data->price_now}}
            </td>
            <td>
              {{$data->quantity}}
            </td>
            <td>
              {{$data->total_price}}
            </td>
            <td>
              {!! $data->alamat !!}
            </td>
            <td>
              {{$data->no_telp}}
            </td>
            <td>
              @if($data->status == 0)
                  <span class="badge badge-pill badge-warning">Belum Terverifikasi</span>
              @elseif($data->status == 2)
                  <span class="badge badge-pill badge-danger">Verifikasi Ditolak</span>
              @elseif($data->status == 1)
                <span class="badge badge-pill badge-success">Verifikasi Diterima</span>
              @endif
           </td>
           <td>
           {{$data->product->no_rekening}}
           </td>
           <td>
            {{-- <img src="{{asset($data->bukti_tf)}}" alt="Foto" class="img-thumbnail" width="40" > --}}
            <a href="/preview/{{$data->id}}" class="btn btn-dark" data-toggle="modal" data-target="#bukti_tf{{$data->id}}">Lihat Bukti</a>
            <div class="modal fade" id="bukti_tf{{$data->id}}" tabindex="-1" aria-hidden="true" aria-labelledby="exampleModalLabel2">
              <div class="modal-dialog bg-white">
              <div class="modal-content bg-white">
                 <div class="modal-header">
                 <h5 class="modal-title" id="exampleModalLabel">Detail Bukti</h5>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  X
                 </button>
                 </div>
                 <div class="modal-body">
                    <img src="{{ asset($data->bukti_tf) }}" width = "100%">
                 </div>
                 <div class="modal-footer">
                 <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                 
                 </div>
              </div>
              </div>
            </div>
           </td>

        <td>
          @if(session()->get('auth')->level != 1)
            @if($data->status == 2)
            
            <div class="container">
              <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#bukti_ulang{{$data->id}}">
                Bukti Ulang
              </button>
              <div class="modal fade" id="bukti_ulang{{$data->id}}" tabindex="-1" aria-hidden="true" aria-labelledby="exampleModalLabel2">
                <div class="modal-dialog bg-white">
                  <form method="post" action="{{route('bukti.ulang.orders', ['id' => $data->id])}}" enctype="multipart/form-data">
                    @csrf
                    {{method_field('PUT')}}
                <div class="modal-content bg-white">
                   <div class="modal-header">
                   <h5 class="modal-title" id="exampleModalLabel">Upload Ulang Bukti</h5>
                   <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    X
                   </button>
                   </div>
                   <div class="modal-body">
                    <div class="form-group">
                      <label>Bukti Transfer (Silahkan melakukan pembayaran ke Nomor Rekening Berikut : {{$data->product->no_rekening}} )</label>
                      <input type="file" class="form-control" name="bukti_tf">
                  </div>
                   </div>
                   <div class="modal-footer">
                    <div class="mr-auto w-0">
                      <button type="submit" onclick="return confirm('Yakin ingin mengirim Bukti Ulang?')" class="btn btn-primary btn-lg">Simpan</button>
                      <button type="reset" class="btn btn-danger">Reset</button>
                  </div>
                   <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                   
                   </div>
                  </form>
                </div>
                </div>
              </div>
            </div>
            @elseif($data->status == 0)
            <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#order{{$data->id}}">
              Edit
            </button>
            <div class="modal fade" id="order{{$data->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" >
              <div class="modal-dialog">
              <form method="post" action="{{route('update.orders', ['id' => $data->id])}}" enctype="multipart/form-data">
                  @csrf
                  {{method_field('PUT')}}
              <div class="modal-content">
                 <div class="modal-header">
                 <h5 class="modal-title" id="exampleModalLabel">Edit Detail Order</h5>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  X
                 </button>
                 </div>
                 
                 <div class="modal-body">
                  <div class="form-group">
                      <label for="jumlah">Jumlah</label>
                      <div class="input-group inline-group">
                    <div class="input-group-prepend">
                      <a  class="btn btn-outline-secondary btn-minus" id="min">
                        <i class="fa fa-minus"></i>
                      </a>
                    </div>
                    <input value="{{$data->quantity}}" class="form-control quantity" min="0" id="QTY" name="quantity" type="number" value="1" style="min-width : 25%;"/>
                    <div class="input-group-append">
                      <a  class="btn btn-outline-secondary btn-plus" id="plus">
                        <i class="fa fa-plus"></i>
                      </a>
                    </div>
                      </div>
                </div>
                <input type="hidden" id="PRICE" name="price_now" value="{{$data->price_now}}">
                <input type="hidden" id="total_input" name="total_price">    
                      <div class="form-group">
                          <label>Alamat</label>
                          <textarea class="form-control" name="alamat" value="{!! $data->alamat !!}">{!! $data->alamat !!}</textarea>
                      </div>
                     <div class="form-group">
                         <label>Nomor Telepon</label>
                         <input type="number" class="form-control" value={{$data->no_telp}} name="no_telp">
                     </div>
                     <div class="form-group">
                          <label>Bukti Transfer (Silahkan melakukan pembayaran ke Nomor Rekening Berikut : {{$data->product->no_rekening}} )</label>
                          <small>Kosongi jika Anda tidak mengedit bukti</small>
                          <input type="file" class="form-control" name="bukti_tf">
                      </div>
                 </div>
                 <div class="modal-footer">
                     <div class="mr-auto w-0">
                         <button type="submit" onclick="return confirm('Yakin ingin mengedit Pembelian?')" class="btn btn-primary btn-lg">Update Order</button>
                         <button type="reset" class="btn btn-danger">Reset</button>
                     </div>
                     <label>Total Rp: <h3 id="TOTAL"></h3></label>
                 {{-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> --}}
                 {{-- <a href="/user/profile/edit" class="btn btn-primary">Edit Profil</a> --}}
                 </div>
              </form>
              </div>
              </div>
</div>
            <a class="btn btn-danger" href="{{route('order.delete', ['id' => $data->id])}}" onclick="return confirm('Yakin ingin menghapus data?')">
              Hapus
            </a>
            @elseif($data->status == 1)
            <small>Seller akan segera mengirimkan pesanan Anda</small>
            @endif
          @else
            @if($data->status == 0)
              <a href="{{route('konfirm.order', ['id' => $data->id])}}" class="btn btn-success" onclick="return confirm('Yakin ingin mengkonfirmasi?')">Konfirmasi</a>
              <a href="{{route('batal.konfirm.order', ['id' => $data->id])}}" class="btn btn-danger" onclick="return confirm('Yakin ingin menolak konfirmasi?')">Tolak Konfirmasi</a>
            @elseif($data->status == 1)
              <a href="{{route('batal.konfirm.order', ['id' => $data->id])}}" class="btn btn-danger" onclick="return confirm('Yakin ingin membatalkan konfirmasi?')">Batal Konfirmasi</a>
            @elseif($data->status == 2)
              <a href="{{route('ulang.konfirm.order', ['id' => $data->id])}}" class="btn btn-warning" onclick="return confirm('Yakin ingin mengkonfirmasi Ulang?')">Konfirmasi Ulang</a>
            @endif
          @endif 
        </td>
        @if(session()->get('auth')->level == 1)
        <td>
          <a href="{{route('order.delete', ['id' => $data->id])}}" class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus Order?')">Hapus Order</a>
        </td>
        @endif
    </tr>   
    <tbody>
      @endforeach
  </table>
  </div>
  </div>
  </div>
  </div>
</div>
</div>
</section>


@else
<h1>Kamu Belum melakukan Order</h1>
@endif
        <!-- Bottom Navbar -->
@endsection
