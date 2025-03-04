@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-6">
        <h1 class="text-2xl text-red-800 font-bold mb-4">Upload Developer Birthdays</h1>

        @if(session('success'))
            <div class="p-3 mb-4 text-green-600 bg-green-100 rounded">{{ session('success') }}</div>
        @endif

        <form action="{{ url('/upload-birthdays') }}" method="POST" enctype="multipart/form-data"
            class="bg-white p-6 rounded shadow-md">
            @csrf

            <label class="block mb-2 font-semibold">Upload a .txt file:</label>
            <input type="file" name="file" accept=".txt" class="border p-2 w-full mb-4">

            @error('file')
                <div class="text-red-500">{{ $message }}</div>
            @enderror

            <button type="submit"
                class="text-red-800 px-4 py-2 font-bold
                                     rounded hover:bg-blue-700 bg-[url('https://www.fabmood.com/wp-content/uploads/2025/02/5200781240824.jpg')]">
                Upload
            </button>
        </form>
    </div>
@endsection