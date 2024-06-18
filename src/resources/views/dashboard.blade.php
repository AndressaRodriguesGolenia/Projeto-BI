<!-- resources/views/dashboard.blade.php -->

@extends('layouts.app')

@section('content')
  <div id="app">
    <vendas-dashboard></vendas-dashboard>
  </div>
@endsection

@section('scripts')
  <script src="{{ mix('js/app.js') }}"></script>
@endsection
