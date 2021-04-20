@extends('layouts.staff')

@section('title', 'Activity - Website Settings - Staff')

@section('content-staff')
    <div>
        <div class="mb-20 text-center">
            <h2>Website Settings <span class="font-light">/ Activity</span></h2>
        </div>

        <div class="mb-2 p-4 rounded-md bg-blue-500 text-sm">
            <i class="fas fa-info-circle fa-fw"></i>
            Activities from more than 1 week ago are automatically deleted.
        </div>

        <form action="" method="GET" class="mb-10 p-6 bg-gray-800 rounded-md grid grid-cols-10 gap-4">
            <div class="col-span-full md:col-span-1">
                <input type="text" name="by" class="text-gray-300 bg-gray-700 focus:ring-primary-dark focus:border-primary-dark block w-full shadow-sm md:text-sm border-gray-600 rounded-md" placeholder="By" value="{{ request('by') }}">
            </div>

            <div class="col-span-full md:col-span-1">
                <select name="type" class="capitalize text-gray-300 bg-gray-700 block w-full py-2 px-3 border border-gray-600 bg-white rounded-md shadow-sm focus:outline-none focus:ring-primary-dark focus:border-primary-dark md:text-sm">
                    <option value="all">All</option>
                    @foreach($activityTypes as $activityType)
                        <option @if(request('type') === $activityType->name) selected @endif value="{{ $activityType->name }}" class="capitalize">{{ $activityType->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-span-full md:col-span-2">
                <input type="text" name="resource" class="text-gray-300 bg-gray-700 focus:ring-primary-dark focus:border-primary-dark block w-full shadow-sm md:text-sm border-gray-600 rounded-md" placeholder="Resource" value="{{ request('resource') }}">
            </div>

            <div class="col-span-full md:col-span-2">
                <input type="text" name="description" class="text-gray-300 bg-gray-700 focus:ring-primary-dark focus:border-primary-dark block w-full shadow-sm md:text-sm border-gray-600 rounded-md" placeholder="Description" value="{{ request('description') }}">
            </div>

            <div class="col-span-full md:col-span-1">
                <select name="sortByCreatedAt" class="capitalize text-gray-300 bg-gray-700 block w-full py-2 px-3 border border-gray-600 bg-white rounded-md shadow-sm focus:outline-none focus:ring-primary-dark focus:border-primary-dark md:text-sm">
                    <option @if(request('sortByCreatedAt') === 'desc') selected @endif value="desc">Latest</option>
                    <option @if(request('sortByCreatedAt') === 'asc') selected @endif value="asc">Oldest</option>
                </select>
            </div>

            <div class="col-span-full md:col-span-1">
                <button type="submit" class="w-full md:w-auto transition duration-200 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-bold rounded-md text-gray-700 bg-primary hover:text-gray-700 hover:bg-primary-dark focus:outline-none">
                    OK
                </button>
            </div>
        </form>

        <div class="grid grid-flow-row gap-2">
            @forelse($activities as $activity)
                <div class="grid grid-flow-col md:grid-cols-8 auto-cols-max md:auto-cols-auto gap-6 p-4 overflow-x-auto rounded-full bg-gray-200 text-sm text-gray-800 items-center">
                    <div class="md:col-span-1">
                        <i class="fas fa-user fa-fw"></i>
                        @if($activity->causer)
                            <span class="font-bold">{{ $activity->causer->name }}</span>
                        @else
                            <span>Anonymous</span>
                        @endif
                    </div>
                    <div class="md:col-span-2 font-bold">
                        <span class="inline-block w-full p-2 rounded-md capitalize {{ $activity->type->color }} text-gray-200 text-center"><i class="{{ $activity->type->icon }} fa-fw"></i> {{ $activity->type->name }}</span>
                    </div>
                    <div class="md:col-span-2 font-bold">
                        @if($activity->subject)
                            <i class="{{ $activity->subject_icon }} fa-fw"></i> {{ $activity->subject }}
                        @endif
                    </div>
                    <div class="md:col-span-2">
                        @if($activity->description)
                            <i class="fas fa-comment-dots fa-fw"></i> {{ $activity->description }}
                        @else
                            <i class="fas fa-comment-dots fa-fw"></i> <span class="italic">No description.</span>
                        @endif
                    </div>
                    <div class="md:col-span-1 text-right">
                        <i class="fas fa-clock fa-fw"></i> {{ $activity->created_at->format('d M H:i') }}
                    </div>
                </div>
            @empty
                <span class="text-sm italic text-gray-300">No logged activity yet.</span>
            @endforelse
        </div>

        {{ $activities->onEachSide(1)->withQueryString()->links() }}
    </div>
@endsection
