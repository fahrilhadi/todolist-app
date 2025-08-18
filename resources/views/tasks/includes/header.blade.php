<header class="w-full">
    <div class="max-w-2xl mx-auto px-4 py-4 flex justify-between items-center">
      <h1 class="text-xl font-semibold">To-Do List</h1>
      @if (request()->routeIs('tasks.create'))
          <a href="{{ route('tasks.index') }}" 
            class="px-4 py-2 bg-black text-white rounded-lg text-sm font-medium hover:bg-gray-800 transition shadow">
            Back
          </a>
      @else
          <a href="{{ route('tasks.create') }}" 
            class="px-4 py-2 bg-black text-white rounded-lg text-sm font-medium hover:bg-gray-800 transition shadow">
            + Add Task
          </a>
      @endif
    </div>
</header>