@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-6">
        @foreach ($feedback as $userFeedback)
          <div class="card mb-4">
            <div class="card-header">
              <a href="{{ route('feedback.show', $userFeedback->id) }}">
                {{ $userFeedback->user->name }} - {{ $userFeedback->posted_at }}
              </a>
            </div>
            <div class="card-body">
              {{ $userFeedback->content }}
            </div>
            @if ($userFeedback->attachment)
              <img src="{{ asset($userFeedback->attachment) }}" alt="Lampiran">
            @endif
            <div class="card-body">
              <span class="btn btn-sm btn-outline-secondary">
                {{ $userFeedback->status }}
              </span>
            </div>
          </div>
        @endforeach

        {{ $feedback->appends(request()->only(['status', 'user_id']))->links() }}
      </div>
    </div>
  </div>
@endsection
