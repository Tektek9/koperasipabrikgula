@extends('admin.layout.core')

@section('content')
<div class="container">
    <div class="row">
        <div class="col">
            <p class="text-white mt-5 mb-5">Welcome back, <b>Admin</b></p>
        </div>
    </div>
    <style>
        .form-container {
            background-color: #494848;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .form-group {
            margin-bottom: 20px;
        }
        label {
            font-weight: bold;
        }
    </style>
    <!-- row -->
    <div class="row tm-content-row">
        <div class="form-container">
            <form method="POST" action="/nomor_perkiraans">
                @csrf
                <div class="form-group">
                    <label for="kode">Kode:</label>
                    <input type="text" class="form-control" id="kode" name="kode" maxlength="10" required>
                    @error('kode')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                </div>
                <div class="form-group">
                    <label for="uraian">Uraian:</label>
                    <input type="text" class="form-control" id="uraian" name="uraian" required>
                    <input type="hidden" class="form-control" id="uraian" name="created_by" value="{{Auth::user()->name}}">
                    @error('uraian')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
            
        </div>
       
       
    </div>
</div>
@endsection

