@extends('errors::minimal')

@section('title', __('Hayoo Mau Ngapain >:('))
@section('code', '403')
@section('message', __($exception->getMessage() ?: 'Hayoo Mau Ngapain >:('))
