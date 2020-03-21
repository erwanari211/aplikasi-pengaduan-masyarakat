@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card mb-4">
          <div class="card-header">
            <a href="{{ route('feedback.show', $feedback->id) }}">
              {{ $feedback->user->name }} - {{ $feedback->posted_at }}
            </a>
          </div>
          <div class="card-body">
            {{ $feedback->content }}
          </div>
          @if ($feedback->attachment)
            <img src="{{ asset($feedback->attachment) }}" alt="Lampiran">
          @endif
          <div class="card-body">
            <span class="btn btn-sm btn-outline-secondary">
              {{ $feedback->status }}
            </span>
          </div>
        </div>

        @php
          $isAdmin = false;
          if (auth()->check()) {
            $user = auth()->user();
            $isAdmin = $user->is_admin;
          }
        @endphp
        @if ($isAdmin)

        <!-- response form -->
        <div class="card mb-4">
          <div class="card-header">
            Add Response
          </div>

          <div class="card-body">
            @if (session('successMessage'))
              <div class="alert alert-success">
                {{ session('successMessage') }}
              </div>
            @endif

            @if ($errors->any())
              <div class="alert alert-danger">
                <ul>
                  @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                  @endforeach
                </ul>
              </div>
            @endif

            <form method="POST" action="{{ route('feedback.responses.store', $feedback->id) }}" enctype="multipart/form-data">
              @csrf

              <div class="form-group row">
                <label for="content" class="col-md-4 col-form-label text-md-right">
                  {{ __('Content') }}
                </label>

                <div class="col-md-6">
                  <textarea
                    id="content"
                    name="content"
                    class="form-control @error('content') is-invalid @enderror"
                    required
                    rows="5">{{ old('content') }}</textarea>

                  @error('content')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
              </div>

              <div class="form-group row">
                <label for="status" class="col-md-4 col-form-label text-md-right">
                  {{ __('Status') }}
                </label>

                <div class="col-md-6">
                  <select
                    name="status"
                    id="status"
                    class="form-control  @error('status') is-invalid @enderror"
                    required>
                    <option value="">
                      Please Select
                    </option>
                    <option value="process" {{ old('status') == 'process' ? 'selected' : '' }}>
                      Process
                    </option>
                    <option value="complete" {{ old('status') == 'complete' ? 'selected' : '' }}>
                      Complete
                    </option>
                    <option value="spam" {{ old('status') == 'spam' ? 'selected' : '' }}>
                      Spam
                    </option>
                  </select>

                  @error('status')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
              </div>

              <div class="form-group row mb-0">
                <div class="col-md-8 offset-md-4">
                  <button type="submit" class="btn btn-primary">
                    {{ __('Submit') }}
                  </button>
                </div>
              </div>
            </form>
          </div>
        </div>
        <!-- /response form -->

        @endif

        <!-- responses -->
        @if ($feedback->responses)
          <div class="card mb-4">
            <div class="card-header">
              Responses
            </div>
            <div class="card-body">
              @foreach ($feedback->responses as $response)
                <div class="mb-4">
                  <span class="text-muted">
                    [{{ $response->posted_at }}]
                  </span>

                  <span>
                    {{ $response->content }}
                  </span>

                  <strong>
                    ({{ $response->status }})
                  </strong>
                </div>
              @endforeach
            </div>
          </div>
        @endif
        <!-- /responses -->

      </div>
    </div>
  </div>
@endsection
