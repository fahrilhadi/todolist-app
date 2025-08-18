@extends('master')

@section('title')
    Create Task | To-Do List App
@endsection

@push('styles')
  <style>
    body { font-family: 'Inter', sans-serif; }
    input[type="checkbox"] {
      appearance: none;
      width: 1.25rem;
      height: 1.25rem;
      border: 1.5px solid #000;
      border-radius: 0.25rem;
      background-color: #fff;
      cursor: pointer;
      display: grid;
      place-content: center;
    }
    input[type="checkbox"]::before {
      content: "✔";
      font-size: 0.75rem;
      color: #000;
      transform: scale(0);
      transition: 0.2s ease-in-out;
    }
    input[type="checkbox"]:checked::before {
      transform: scale(1);
    }
  </style>
@endpush

@section('main-content')
    <div class="w-full max-w-md px-4 py-6 bg-white border border-gray-200 rounded-xl shadow-lg">   
      <form action="{{ route('tasks.store') }}" method="POST" class="space-y-4">
        @csrf
        <div class="flex flex-col">
          <label for="title" class="text-sm font-medium mb-1">Task Name</label>
          <input type="text" name="title" value="{{ old('title') }}"
                 class="@error('title') is-invalid @enderror border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-black focus:border-black transition">
        </div>
        <div class="flex gap-2">
          <button type="submit" 
                  class="flex-1 px-4 py-2 bg-black text-white rounded-lg text-sm font-medium hover:bg-gray-800 transition shadow">
            Add Task
          </button>
          <a href="{{ route('tasks.index') }}" 
             class="flex-1 px-4 py-2 border border-gray-300 rounded-lg text-center text-sm font-medium hover:border-black transition shadow">
            Cancel
          </a>
        </div>
      </form>
    </div>
@endsection