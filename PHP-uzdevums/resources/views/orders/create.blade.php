@extends('layouts.app')

@section('content')
<h1>Create Order</h1>

{{-- controllers must pass $customers to this view --}}
@include('partials._form_order')
@endsection