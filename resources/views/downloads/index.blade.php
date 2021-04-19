@extends('layouts.staff')

@section('title', 'Downloads - Staff')

@section('content-staff')
    <div>
        <div class="mb-20 text-center">
            <h2>Downloads</h2>
        </div>

        @if ($errors->any())
            <div class="my-10 p-6 text-gray-200 font-bold bg-red-500 rounded-md">
                <ul class="m-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div>
            <ul class="mt-10 mb-20">
                @forelse($downloads as $download)
                    <li>
                        <span class="font-bold">{{ $download->name }}:</span>
                        <a href="{{ $download->link }}" target="_blank">
                            Download
                            <i class="flex-shrink-0 fas fa-download fa-fw"></i>
                        </a>
                        @can('manage-downloads')
                            <a href="{{ route('staff.downloads.edit', $download) }}" class="transition duration-200 text-primary hover:text-primary-dark focus:outline-none">
                                Edit
                                <i class="flex-shrink-0 fas fa-pen fa-fw"></i>
                            </a>

                            <form action="{{ route('staff.downloads.destroy', $download) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')

                                <button type="submit" class="transition duration-200 text-red-500 hover:text-red-700 focus:outline-none">
                                    Delete
                                    <i class="flex-shrink-0 fas fa-trash-alt fa-fw"></i>
                                </button>
                            </form>
                        @endcan
                    </li>
                @empty
                    <span class="text-sm italic text-gray-300">No downloads available for you yet...</span>
                @endforelse
            </ul>
        </div>
    </div>
@endsection
