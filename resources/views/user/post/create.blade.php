
@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <h1 class="m-0">Create post</h1>
    </div>
</div>

<div class="content">
    <div class="container-fluid">

            <div class="col-lg-12 col-12">
                <div class="container-fluid">
                    <div class="content">
                        <form action="{{ route('user.post.store') }}" method="POST">
                            @csrf

                            <div class="form-group">
                                <label for="title">Title</label>
                                <input
                                    type="text"
                                    name="title"
                                    id="title"
                                    class="form-control"
                                    value="{{ old('title') }}"
                                    placeholder="Enter post title"
                                    required
                                >
                            </div>

                            <div class="form-group">
                                <label for="content">Content</label>
                                <textarea
                                    name="content"
                                    id="content"
                                    rows="6"
                                    class="form-control"
                                    placeholder="Enter post content"
                                    required
                                >{{ old('content') }}</textarea>
                            </div>

                            <div class="form-group mt-3">
                                <button type="submit" class="btn btn-primary">
                                    Save
                                </button>

                                <a href="{{ route('user.index') }}" class="btn btn-secondary">
                                    Back
                                </a>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
    </div>

</div>
@endsection
