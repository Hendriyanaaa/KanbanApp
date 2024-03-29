<div class="task-progress-column">
  <div class="task-progress-column-heading">
    <h2>{{ $title }}</h2>
    <div class="button">
      <a href="{{ route('tasks.create', ['status' => $status])}}">
        <span class="material-icons">add</span>
      </a>
    </div>
  </div>
  <div>
    @foreach ($tasks as $task)
      @include('partials.task_card', [
        'task' => $task,
        'leftStatus' => $leftStatus,
        'rightStatus' => $rightStatus,
      ])
    @endforeach
  </div>
</div>