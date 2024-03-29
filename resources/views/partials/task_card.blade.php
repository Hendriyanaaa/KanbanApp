@php
use App\Models\Task;
@endphp
<div class="task-progress-card">
  <div class="task-progress-card-left">
    @if ($task->status == 'completed')
      <div class="material-icons task-progress-card-top-checked">check_circle</div>
    @else
    <form action="{{ route('tasks.move', ['id' =>$task->id, 'status'=>Task::STATUS_COMPLETED])}}"
      method="POST" id="setcomplete-{{$task->id}}"
      >
      @csrf
      @method('patch')
      <div class="material-icons task-progress-card-top-check"onclick="document.getElementById('setcomplete-{{$task->id}}').submit()">check_circle</div>
    </form>    
      @endif
    <a href="{{ route('tasks.edit', ['id' => $task->id]) }}" class="material-icons task-progress-card-top-edit">more_vert</a>
  </div>
  <p class="task-progress-card-title">{{ $task->name }}</p>
  <div>
    <p>{{ $task->detail }}</p>
  </div>
  <div>
    <p>Due on {{ $task->due_date }}</p>
  </div>
  <div class="@if ($leftStatus) task-progress-card-left @else task-progress-card-right @endif">
    @if ($leftStatus)
      <form  action="{{ route('tasks.move', ['id' => $task->id, 'status' => $leftStatus]) }}" 
        method="POST"
      >
      @csrf
      @method('patch')
      <button class="material-icons">chevron_left</button>
      </form>
     
    @endif

    @if ($rightStatus)
    <form
    action="{{ route('tasks.move', ['id' => $task->id, 'status' => $rightStatus]) }}"
    method="POST"
  >
    @method('patch')
    @csrf
      <button class="material-icons">chevron_right</button>
    @endif
  </div>
</div>