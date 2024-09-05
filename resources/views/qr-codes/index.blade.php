@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <div class="flex justify-between">
        <!-- Formulario para generar QR Code -->
        <div class="w-2/3 bg-gray-800 text-white rounded-lg shadow-md p-6">
            <h2 class="text-xl font-semibold mb-4">Generar QR Code</h2>

            @if(session('success'))
                <div class="bg-green-600 text-white p-2 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('qr-codes.store') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label for="url" class="block font-medium">URL a convertir en QR:</label>
                    <input type="text" name="url" id="url" class="w-full p-2 border border-gray-700 bg-gray-900 text-white rounded-lg placeholder-gray-400" placeholder="https://example.com">
                </div>
                <button type="submit" class="text-white bg-gradient-to-r from-purple-500 via-purple-600 to-purple-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-purple-300 dark:focus:ring-purple-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Generar QR</button>
            </form>
        </div>

        <!-- Historial de QR Codes -->
        <div class="w-1/3 bg-gray-700 text-white rounded-lg shadow-md ml-4 p-6">
            <h3 class="text-lg font-semibold mb-4">Historial de QR Codes</h3>
            <ul>
                @foreach($qrCodes as $index => $qrCode)
                    <li class="mb-4 flex items-center justify-between">
                        <div class="flex items-center">
                            <span class="mr-4">QR Code #{{ $index + 1 }}</span>
                            <img src="{{ Storage::url($qrCode->qr_code_path) }}" alt="QR Code" class="w-16 h-16 mr-4">
                        </div>
                        <div>
                            <a href="{{ route('qr-codes.show', $qrCode->id) }}" class="text-blue-400 hover:underline">Ver</a>
                            <form action="{{ route('qr-codes.destroy', $qrCode->id) }}" method="POST" class="inline ml-2">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-400 hover:underline">Eliminar</button>
                            </form>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
@endsection
