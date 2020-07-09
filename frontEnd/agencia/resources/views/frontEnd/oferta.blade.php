@extends('layouts.app')

@section('content')
    <oferta-component csrf="{{ csrf_token() }}"></oferta-component>
@endsection
