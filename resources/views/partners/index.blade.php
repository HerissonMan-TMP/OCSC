@extends('layouts.staff')

@section('title', 'Partners - Staff')

@section('content-staff')
    <div>
        <div class="mb-20 break-words text-center">
            <h2>Partners</h2>
        </div>

        <div class="grid grid-flow-row gap-16">
            @foreach($partnerCategories as $category)
                <div class="col-span-full flex flex-col items-center">
                    <h3>{{ $category->name }}</h3>
                    <div class="grid grid-cols-4 gap-6 mt-5 w-full">
                        @forelse($category->partners as $partner)
                            <div class="col-span-full md:col-span-1 text-center">
                                <img src="{{ $partner->logo }}" alt="{{ $partner->name }} Logo" class="p-4 w-3/4 mx-auto">

                                <span class="font-bold">{{ $partner->name }}</span>

                                <div class="mt-2">
                                    @isset($partner->truckersmp_link)
                                        <a href="{{ $partner->truckersmp_link }}">
                                            <i class="fas fa-truck fa-fw"></i>
                                        </a>
                                    @endisset
                                    @isset($partner->trucksbook_link)
                                        <a href="{{ $partner->trucksbook_link }}">
                                            <i class="fas fa-shipping-fast fa-fw"></i>
                                        </a>
                                    @endisset
                                    @isset($partner->website_link)
                                        <a href="{{ $partner->website_link }}">
                                            <i class="fas fa-globe fa-fw"></i>
                                        </a>
                                    @endisset
                                    @isset($partner->twitter_link)
                                        <a href="{{ $partner->twitter_link }}">
                                            <i class="fab fa-twitter fa-fw"></i>
                                        </a>
                                    @endisset
                                    @isset($partner->instagram_link)
                                        <a href="{{ $partner->instagram_link }}">
                                            <i class="fab fa-instagram fa-fw"></i>
                                        </a>
                                    @endisset
                                </div>

                                @can('manage-partners')
                                    <div class="grid grid-cols-6 gap-2 mt-2">
                                        <div class="col-span-full md:col-span-3">
                                            <a href="{{ route('staff.partners.edit', $partner) }}" class="w-full h-full transition duration-200 w-full flex items-center justify-center px-4 py-2 border border-transparent rounded-md shadow-sm text-base font-semibold text-gray-700 bg-primary hover:text-gray-800 hover:bg-primary-dark focus:outline-none">
                                                <i class="fas fa-pen fa-fw fa-md mr-1"></i> Edit
                                            </a>
                                        </div>
                                        <form action="{{ route('staff.partners.destroy', $partner) }}" method="POST" class="col-span-full md:col-span-3">
                                            @csrf
                                            @method('DELETE')

                                            <button type="Submit" class="w-full h-full transition duration-200 w-full flex items-center justify-center px-4 py-2 border border-transparent rounded-md shadow-sm text-base font-semibold text-gray-200 bg-red-500 hover:text-gray-300 hover:bg-red-600 focus:outline-none"><i class="fas fa-trash-alt fa-fw fa-md mr-1"></i> Delete</button>
                                        </form>
                                    </div>
                                @endcan
                            </div>
                        @empty
                            <div class="col-span-full mt-5 text-center">
                                <span class="text-sm italic text-gray-300">No partners for this category yet...</span>
                            </div>
                        @endforelse
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
