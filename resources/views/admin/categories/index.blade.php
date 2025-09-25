@extends('admin.navbar')

@section('dashboard')
    <main class="p-6 flex-1">
        <h1 class="text-2xl font-bold mb-6 text-gray-800">📚 Categories</h1>
        @if (session('success'))
            <div class="p-4 text-green-700 bg-green-100">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="p-4 text-red-700 bg-red-100">{{ session('error') }}</div>
        @endif

        <table class="w-full text-left">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-3">ID</th>
                    <th class="px-4 py-3">Name</th>
                    <th class="px-4 py-3">Delete</th>
                </tr>
            </thead>
            <tbody>
                @forelse($categories as $cat)
                    <tr class="border-t">
                        <td class="px-4 py-3">{{ $cat->id }}</td>
                        <td class="px-4 py-3">{{ $cat->category ?? '-' }}</td>
                        <td class="px-4 py-3">
                            <form action="{{ route('admin.deletecategories', $cat->id) }}" method="POST"
                                onsubmit="return confirm('Delete this category?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline ml-3">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td class="px-4 py-6 text-center" colspan="5">No products yet. <a
                                href="{{ route('admin.addcategories') }}" class="text-purple-600">Add one</a>.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        </div>
    </main>
@endsection
