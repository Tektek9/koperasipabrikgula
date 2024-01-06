
@foreach($namaPerkiraans as $namaPerkiraan)
    <div class="dropdown-item">{{ $namaPerkiraan->kode | $namaPerkiraan->uraian }}</div>
@endforeach