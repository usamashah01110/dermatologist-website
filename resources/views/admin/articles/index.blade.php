@extends('admin.include.main')
@section('content')
<div class="container p-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="mb-0">Articles</h4>
        <a href="{{ route('article.create') }}" class="btn btn-primary btn-lg">Create New Article</a>
    </div>
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">All Articles</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Author</th>
                            <th>Created At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($articles as $article)
                        <tr>
                            <td>{{ $article->id }}</td>
                            <td>{{ Str::limit($article->title, 50) }}</td>
                            <td>{{ $article->author }}</td>
                            <td>{{ $article->created_at->format('Y-m-d H:i:s') }}</td>
                            <td>
                                <div class="dropdown">
                                    <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                        Actions
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="{{ route('article.edit', $article->id) }}"><i class="bx bx-edit-alt me-1"></i> Edit</a>
                                        <form action="{{ route('article.destroy', $article->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="dropdown-item text-danger"><i class="bx bx-trash me-1"></i> Delete</button>
                                        </form>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center">No articles found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
