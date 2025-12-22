
@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
<div class="content-header d-flex">
    <div class="container-fluid">
        <h1 class="m-0">Listpost</h1>
    </div>
    <div>
        <a href="{{ route('user.create') }}">ADD POST</a>

    </div>
</div>

<div class="content">
    <div class="container-fluid">

            <div class="col-lg-12 col-12">
                <div class="small-box">
                    <div class="content">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Tiêu đề</th>
                                    <th>Nội dung</th>
                                    <th>Ngày tạo</th>
                                    <th>Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($data as $post)
                                    <tr>
                                        <td>
                                            {{ ($data->currentPage() - 1) * $data->perPage() + $loop->iteration }}
                                        </td>
                                        <td>{{ $post->title }}</td>
                                        <td>{{ Str::limit($post->content, 50) }}</td>
                                        <td>{{ $post->created_at->format('d/m/Y') }}</td>
                                        <td>
                                            <a href="{{ route('user.post.edit',$post->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                            <form action="{{ route('user.post.destroy',$post->id) }}" method="POST" style="display:inline">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-sm btn-danger"
                                                        onclick="return confirm('Delete?')">
                                                    Delete
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center">No post</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
    </div>
    {{-- <div>
        <form action="{{ route('user.logout') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-danger">Logout</button>
        </form>

    </div> --}}
</div>
@endsection
