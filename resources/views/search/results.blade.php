@extends('bagianAwal.main')

@section('content')
<div class="container my-5">
    <h4>Hasil Pencarian untuk: "{{ $query }}"</h4>

    @if($results->isEmpty())
        <p>Tidak ditemukan hasil.</p>
    @else
        <div class="row">
            @foreach($results as $item)
                <div class="col-md-4 mb-3">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h5>{{ $item->title }}</h5>
                            <p>{{ Str::limit($item->description, 100) }}</p>
                            <a href="#" class="btn btn-primary btn-sm">
                                Detail
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection


{{-- @extends('bagianAwal.main')

@section('content')
<div class="container">
    <h4>Hasil Pencarian untuk: "{{ $query }}"</h4>

    @if($results->isEmpty())
        <p>Tidak ditemukan hasil.</p>
    @else
        <ul class="list-group">
            @foreach($results as $item)
                <li class="list-group-item">
                    <a href="{{ url('/posts/' . $item->id) }}">{{ $item->title }}</a>
                </li>
            @endforeach
        </ul>
    @endif
</div>
@endsection --}}
