@extends('layouts.staff')

@section('title', 'Recruitment Management')

@section('breadcrumb', 'Staff - Recruitment Management')

@section('content-staff')
<div class="px-4 py-5 md:p-6 bg-gray-800 rounded-md shadow overflow-hidden">
    <div class="flex justify-between items-center">
        <div>
            <h3 class="font-bold text-2xl text-gray-300 mt-2 mb-6">Recruitment Sessions</h3>
        </div>
        <div>
            <a href="{{ route('staff.recruitments.create') }}" class="transition duration-200 ml-8 whitespace-nowrap inline-flex items-center justify-center px-4 py-2 border border-transparent rounded-md shadow-sm text-gray-700 font-bold bg-primary hover:text-gray-800 hover:bg-primary-dark">
                New Recruitment
            </a>
        </div>
    </div>
    <div class="overflow-x-auto md:-mx-6 lg:-mx-8">
        <div class="py-2 align-middle inline-block min-w-full md:px-6 lg:px-8">
            <div class="shadow overflow-hidden border-b border-gray-700 rounded-lg">
                <table class="min-w-full divide-y divide-gray-900 border-none">
                    <thead class="bg-gray-900">
                        <tr>
                            <th scope="col" class="border-none px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">
                                Name
                            </th>
                            <th scope="col" class="border-none px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">
                                Status
                            </th>
                            <th scope="col" class="border-none px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">
                                Start datetime (UTC)
                            </th>
                            <th scope="col" class="border-none px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">
                                End datetime (UTC)
                            </th>
                            <th scope="col" class="border-none px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">
                                Opened by
                            </th>
                            <th scope="col" class="border-none px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">
                                Applications sent
                            </th>
                            <th scope="col" class="border-none relative px-6 py-3">
                                <span class="sr-only">Edit</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-gray-700 divide-y divide-gray-700">
                        @forelse($recruitments as $recruitment)
                        <tr>
                            <td class="border-none px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-10 w-10 flex items-center">
                                        <i style="color: {{ $recruitment->role->color }}" class="flex-shrink-0 fas fa-{{ $recruitment->role->icon_name }} fa-fw fa-2x"></i>
                                    </div>
                                    <div style="color: {{ $recruitment->role->color }}" class="ml-4 text-sm text-gray-300 font-bold">
                                        {{ $recruitment->role->name }}
                                    </div>
                                </div>
                            </td>
                            <td class="border-none px-6 py-4 whitespace-nowrap">
                                @if($recruitment->is_open)
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                    Open
                                </span>
                                @else
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                    Closed
                                </span>
                                @endif
                            </td>
                            <td class="border-none px-6 py-4 whitespace-nowrap text-sm text-gray-300">
                                {{ $recruitment->start_at }}
                            </td>
                            <td class="border-none px-6 py-4 whitespace-nowrap text-sm text-gray-300">
                                {{ $recruitment->end_at }}
                            </td>
                            <td style="color: {{ $recruitment->user->roles->first()->color }}" class="border-none px-6 py-4 whitespace-nowrap text-sm">
                                {{ $recruitment->user->name }}
                            </td>
                            <td class="border-none px-6 py-4 whitespace-nowrap text-sm text-gray-300">
                                <a href="{{ route('staff.recruitments.applications.index', $recruitment) }}" class="text-gray-300 hover:text-gray-400">See applications</a> ({{ $recruitment->applications_count }})
                            </td>
                            <td class="border-none px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <a href="{{ route('staff.recruitments.edit', $recruitment) }}" class="transition duration-200 text-primary hover:text-primary-dark">Edit</a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="border-none px-6 py-4 whitespace-nowrap text-sm italic text-gray-300">No recruitment sessions stored yet...</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="mt-10">
        <h3 class="font-bold text-2xl text-gray-300">Global Requirements</h3>
        <form action="{{ route('staff.global-requirements.update') }}" method="POST">
            @csrf
            @method('PATCH')
            <label for="global_requirements" class="block text-sm font-medium text-gray-300">Global Requirements <span class="text-red-500 font-bold">*</span> <i class="ml-1 flex-shrink-0 fab fa-markdown fa-fw"></i></label>
            <textarea name="global_requirements" id="global_requirements" class="text-gray-300 bg-gray-700 mt-1 focus:ring-primary-dark focus:border-primary-dark block w-full shadow-sm md:text-sm border-gray-600 rounded-md" cols="30" rows="10">{{ old('global_requirements') ?? setting('global-requirements') }}</textarea>
            @error('global_requirements')
            <span class="pt-2 text-sm text-red-500">
                    {{ $message }}
                </span>
            @enderror
            <div class="mt-6 text-right">
                <button type="submit" class="w-full md:w-auto transition duration-200 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-bold rounded-md text-gray-700 bg-primary hover:text-gray-700 hover:bg-primary-dark focus:outline-none">Update the requirements</button>
            </div>
        </form>
    </div>
</div>
@endsection
