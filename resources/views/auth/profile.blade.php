<!-- resources/views/profile.blade.php -->
@extends('layouts.app')

@section('title', 'Profile')

@section('content')
  <h1>Profile</h1>
  <p>Hii {{ $data['user']['first_name'] .' '.$data['user']['last_name'] }}</p>
@endsection
