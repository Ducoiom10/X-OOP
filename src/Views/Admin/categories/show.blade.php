@extends('layouts.master')

@section('title')
    Xem chi tiết: {{ $category['name'] }}
@endsection

@section('content')
    <table class="table table-striped">
        <thead>
            <tr>
                <th>TRƯỜNG</th>
                <th>GIÁ TRỊ</th>
            </tr>
        </thead>
        <tbody>

            @foreach ($category as $key => $value)
                @if ($key !== 'img_thumbnail')
                    <tr>
                        <td>{{ $key }}</td>
                        <td>{!! $value !!}</td>
                    </tr>
                @endif
            @endforeach

        </tbody>
    </table>
@endsection
