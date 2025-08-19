@extends('master')

@section('title')
    To-Do List App
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
  <div class="w-full max-w-2xl px-4 py-6 space-y-4">
    @if($tasks->isEmpty())
      <div class="text-center py-12">
        <p class="text-gray-500 text-lg font-medium">
          No tasks yet. Start by adding your first task today.
        </p>
      </div>
    @else
        @foreach ($tasks as $task)
          <div class="bg-white border border-gray-200 rounded-xl p-4 flex justify-between items-center shadow hover:shadow-lg transition">
              <div class="flex items-center gap-3">
                  <input type="checkbox" {{ $task->is_completed ? 'checked' : '' }} onchange="event.preventDefault(); document.getElementById('toggle-{{ $task->id }}').submit();">
                  <span class="{{ $task->is_completed ? 'line-through text-gray-400' : '' }}">{{ $task->title }}</span>
              </div>
              <form action="{{ route('tasks.destroy', $task->id) }}" method="POST">
                <div class="flex items-center gap-2">
                  <a href="{{ route('tasks.edit', $task->id) }}" 
                    class="px-3 py-1 rounded-lg border border-gray-300 hover:border-black text-sm transition shadow">
                      Edit
                  </a>
                  <button type="button" onclick="openDeleteModal({{ $task->id }}, '{{ addslashes($task->title) }}')" class="px-3 py-1 rounded-lg border border-gray-300 hover:border-red-500 hover:text-red-500 text-sm transition shadow">
                      Delete
                  </button>
                </div>
              </form>
          </div>

          <form id="toggle-{{ $task->id }}" action="{{ route('tasks.toggle', $task->id) }}" method="POST" style="display:none;">
              @csrf
              @method('PATCH')
          </form>
        @endforeach
        <x-pagination :paginator="$tasks" />
    @endif
  </div>
  <div id="deleteModal" class="fixed inset-0 backdrop-blur-sm z-[9999] hidden items-center justify-center">
    <div class="bg-white rounded-xl shadow-lg p-6 w-full max-w-sm text-center">
      <h2 class="text-lg font-semibold mb-2">Delete Task</h2>
      <p class="text-gray-600 text-sm mb-4">Are you sure you want to delete <span id="taskTitle" class="font-medium"></span>?</p>
      <form id="deleteForm" method="POST" class="flex justify-center gap-3">
        @csrf
        @method('DELETE')
        <button type="button" onclick="closeDeleteModal()" 
                class="px-4 py-2 border border-gray-300 rounded-lg text-sm font-medium hover:border-black transition shadow">
          Cancel
        </button>
        <button type="submit" 
                class="px-4 py-2 rounded-lg border border-gray-300 hover:border-red-500 hover:text-red-500 text-sm transition shadow">
          Delete
        </button>
      </form>
    </div>
  </div>
@endsection

@push('addon-script')
  <script>
    function openDeleteModal(taskId, taskTitle) {
        const modal = document.getElementById('deleteModal');
        const form = document.getElementById('deleteForm');
        const titleSpan = document.getElementById('taskTitle');

        form.action = '/tasks/' + taskId;
        titleSpan.textContent = taskTitle;
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }

    function closeDeleteModal() {
        const modal = document.getElementById('deleteModal');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }
  </script>
@endpush