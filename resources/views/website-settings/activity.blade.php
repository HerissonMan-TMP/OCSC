@extends('layouts.staff')

@section('title', 'Activity - Website Settings - Staff')

@section('content-staff')
    <div>
        <div class="mb-20 text-center">
            <h2>Website Settings <span class="font-light">/ Activity</span></h2>
        </div>

        <div class="mb-10 p-6 bg-gray-800 rounded-md italic">
            Filter and sort features coming soon...
        </div>

        <div class="grid grid-flow-row gap-2">
            @forelse($activities as $activity)
                <div class="grid grid-cols-8 gap-6 p-4 rounded-full bg-gray-200 text-sm text-gray-800 items-center">
                    <div class="col-span-1">
                        <i class="fas fa-user fa-fw"></i>
                        @if($activity->causer)
                            <span class="font-bold">{{ $activity->causer->name }}</span>
                        @else
                            <span>Anonymous</span>
                        @endif
                    </div>
                    <div class="col-span-2 font-bold">
                        <span class="inline-block w-full p-2 rounded-md capitalize {{ $activity->type->color }} text-gray-200 text-center"><i class="{{ $activity->type->icon }} fa-fw"></i> {{ $activity->type->name }}</span>
                    </div>
                    <div class="col-span-2 font-bold">
                        @if($activity->subject)
                            <i class="{{ $activity->subject_icon }} fa-fw"></i> {{ $activity->subject }}
                        @endif
                    </div>
                    <div class="col-span-2">
                        @if($activity->description)
                            <i class="fas fa-comment-dots fa-fw"></i> {{ $activity->description }}
                        @else
                            <i class="fas fa-comment-dots fa-fw"></i> <span class="italic">No description.</span>
                        @endif
                    </div>
                    <div class="col-span-1 text-right">
                        <i class="fas fa-clock fa-fw"></i> {{ $activity->created_at->format('d M H:i') }}
                    </div>
                </div>
            @empty
                <span class="italic">No logged activity yet.</span>
            @endforelse
        </div>
    </div>
@endsection
