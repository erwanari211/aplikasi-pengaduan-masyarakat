@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">Create Feedback</div>

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

            <form method="POST" action="{{ route('feedback.store') }}" enctype="multipart/form-data">
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
                <label for="content" class="col-md-4 col-form-label text-md-right">
                  {{ __('Attachment') }}
                </label>

                <div class="col-md-6">
                  <input
                    type="file"
                    name="attachment"
                    id="attachment"
                    class="form-control">
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
      </div>
    </div>
  </div>
@endsection
