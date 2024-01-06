@extends('admin.layout.core')

@section('content')
<div class="container">
    <div class="row">
        <div class="col">
            <p class="text-white mt-5 mb-5">Welcome back, <b>Admin</b></p>
        </div>
    </div>
    <!-- row -->
    <div class="row tm-content-row">

        <div class="container mt-5">
            <h2 class="text-white mb-4">Cetak Buku Besar</h2>
        
            <form id="myForm" method="get" action="/cetak/buku_besar">
              <button type="submit" class="btn btn-primary" onclick="submitForm()">Submit</button>
            </form>
          </div>

    </div>
</div>
@endsection