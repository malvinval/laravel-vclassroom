@extends('layouts.core')

@section('container')
    <div class="container forum-edit-form-container">
        <div class="col-lg-6">
            <form method="POST" action="/f/{{ $forum->id }}" enctype="multipart/form-data">
                @csrf
                @method("PUT")
                <div class="mb-3">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" autofocus
                    value="{{ $forum->title }}" autocomplete="off">
                    @error("title")
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="caption" class="form-label">Caption</label>
                    <input id="caption" type="hidden" name="caption" class="@error('caption') is-invalid @enderror" value="{{ $forum->caption }}">
                    <trix-editor input="caption"></trix-editor>
                    @error("caption")
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="formFileMultiple" class="form-label">Attach file (optional)</label>
                    <input class="form-control @error('teacher_file_attachment') is-invalid @enderror" type="file" id="formFileMultiple" name="teacher_file_attachment" multiple>
                    @error("teacher_file_attachment")
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <label class="mb-3">Student attach file ?</label>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="isAttachFile" id="flexRadioDefault1" value="Y">
                    <label class="form-check-label" for="flexRadioDefault1">
                    Yes
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="isAttachFile" id="flexRadioDefault2" value="N" checked>
                    <label class="form-check-label" for="flexRadioDefault2">
                    No
                    </label>
                </div>

                <button type="submit" class="btn btn-success mt-3">Confirm</button>
            </form>
        </div>
    </div>
@endsection