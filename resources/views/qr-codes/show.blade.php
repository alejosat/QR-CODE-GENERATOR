@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <div class="bg-gray-800 text-white rounded-lg shadow-md p-6">
        <h2 class="text-xl font-semibold mb-4">Detalles del QR Code</h2>

        <img src="{{ Storage::url($qrCode->qr_code_path) }}" alt="QR Code" class="w-64 h-64 mb-4 mx-auto">

        <p class="text-lg mb-4">URL: {{ $qrCode->url }}</p>

        <a href="{{ route('qr-codes.index') }}" class="text-blue-400 hover:underline">Volver al Historial</a>
    </div>
</div>
@endsection
