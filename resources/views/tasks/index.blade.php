@php
  use App\Models\Task;
@endphp
@extends('layouts.master')
@section('pageTitle', $pageTitle)
@section('main') 
<div class="task-list-container">
  <h1 class="task-list-heading">Task List</h1>
 
  <div class="task-list-task-buttons">
    <a href="{{ route('tasks.create') }}">
      <button class="task-list-button">
        <span class="material-icons">add</span>Add task
      </button>
    </a>
  </div>

  <div class="task-list-table-head">
    <div class="task-list-header-task-name">Task Name</div>
    <div class="task-list-header-detail">Detail</div>
    <div class="task-list-header-due-date">Due Date</div>
    <div class="task-list-header-progress">Progress</div>
    <div class="task-list-header-links">Action</div>
  </div>

  {{-- @foreach ($list as $item) --}}
  @foreach ($list as $item)
  <div class="table-body">
    <div class="table-body-task-name"> 
      @if($item->status == 'completed') 
      <span class="material-icons check-icon-completed ">
      check_circle
    </span>
      @else
      <form action="{{ route('tasks.move', ['id'=> $item->id, 'status'=>Task::STATUS_COMPLETED])}}"
        method="POST" id="complete--{{$item->id}}"
      >
      @csrf
      @method('patch') 
      <span class="material-icons check-icon " onclick="document.getElementById('complete--{{$item->id}}').submit()">
        check_circle
      </span>
      @endif
      
      {{$item->name}}
    </div>
    <div class="table-body-detail">{{$item->detail}}</div>
    <div class="table-body-due-date">{{$item->due_date}}</div>
    <div class="table-body-progress">
    @switch($item->status)
              @case('in_progress')
              In Progress
              @break
              @case('in_review')
              Waiting/In Review
              @break
              @case('completed')
              Completed
              @break
              @default
              Not Started
        @endswitch
    </div>
    <div>
      <a href="{{ route('tasks.edit', ['id' => $item->id]) }}">Edit</a>
      <a href="{{ route('tasks.delete', ['id' => $item->id])}}">Delete</a>

    </div> 
  </div>
  @endforeach
</div>
@endsection