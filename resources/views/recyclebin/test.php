<!DOCTYPE html>
<html>
  <head>
    <title>Laravel – Data pegawai</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"/>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <style type="text/css">
      .box {
        width:600px;
        margin:0auto;
      }
    </style>
  </head>

  <body>
    <br/>
    <div class="container">
      <h3 align="center">Perpustkaan – Daftar Pegawai</h3>
      <br/>

      <div class="row">
        <div class="col-md-7" align="right">
          <h4>Data Pegawai</h4>
        </div>

        <div class="col-md-5" align="right">
          <a href="{{ url('pegawai/pdf') }}" class="btn btn-danger">Convert PDF</a>
        </div>
      </div>
      <br/>

      <div class="table-responsive">
        <table class="table table-striped table-bordered">
          <thead>
            <tr>
              <th>Nama</th>
              <th>Alamat</th>
              <th>Telepon</th>
            </tr>
          </thead>
          <tbody>
            @foreach($customer_data as $customer)
            <tr>
              <td>{{ $customer->Nama }}</td>
              <td>{{ $customer->Alamat }}</td>
              <td>{{ $customer->Telepon }}</td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>

    </div>
  </body>
</html>
