@extends('layouts.main')
@section('title', 'Dashboard')
@if ($errors->any())
    <h4>{{ $errors->first() }}</h4>
@endif
