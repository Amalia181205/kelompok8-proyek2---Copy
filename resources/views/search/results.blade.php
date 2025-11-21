@extends('bagianAwal.main')

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
@endsection
