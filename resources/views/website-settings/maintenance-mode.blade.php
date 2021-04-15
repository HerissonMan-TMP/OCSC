@extends('layouts.staff')

@section('title', 'Maintenance Mode - Website Settings - Staff')

@section('content-staff')
    <div>
        <div class="mb-20 text-center">
            <h2>Website Settings <span class="font-light">/ Maintenance Mode</span></h2>
        </div>

        <div class="bg-gray-700 rounded-md border border-yellow-500">
            <div class="p-4 bg-yellow-500">
                <h4 class="font-semibold text-yellow-100 m-0">Maintenance Mode</h4>
            </div>
            <div class="p-4">
                <div class="text-sm mb-6 text-justify">
                    Anyone who wants to access the website while it is in maintenance mode should navigate to the URL
                    below:
                    <br><br>
                    <pre><span class="opacity-50">{{ config('app.url') }}</span>/your-bypass-token</pre>
                    <br><br>
                    A maintenance mode bypass cookie will be issued to the user's browser.
                    He will then be redirected to the homepage of the website. Once the cookie has been issued to his
                    browser, he will be able to browse the website normally as if it was not in maintenance mode.
                </div>
                @if(app()->isDownForMaintenance())
                    <form action="{{ route('staff.website-settings.maintenance-mode.disable') }}" method="POST">
                        @csrf
                        <div class="grid grid-cols-10 gap-2 items-center">
                            <div class="col-span-full md:col-span-2">
                            <span class="pt-2 text-sm text-yellow-500">
                                Maintenance Mode is enabled.
                            </span>
                            </div>
                            <div class="col-span-full md:col-span-1">
                                <button type="submit" class="w-full transition duration-200 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-bold rounded-md text-red-200 bg-red-700 hover:text-red-300 hover:bg-red-800 focus:outline-none">
                                    Disable
                                </button>
                            </div>
                        </div>
                    </form>
                @else
                    <form action="{{ route('staff.website-settings.maintenance-mode.enable') }}" method="POST">
                        @csrf
                        <div class="grid grid-cols-10 gap-2">
                            <div class="col-span-full md:col-span-3">
                                <label for="secret" class="block text-sm font-medium text-gray-300">Bypass token <span class="text-red-500 font-bold">*</span></label>
                            </div>
                        </div>
                        <div class="grid grid-cols-10 gap-2">
                            <div class="col-span-full md:col-span-3">
                                <input type="password" name="secret" id="secret" class="text-gray-300 bg-gray-700 mt-1 focus:ring-yellow-500 focus:border-yellow-500 block w-full shadow-sm md:text-sm border-gray-600 rounded-md" maxlength="50" value="{{ old('secret') }}" required>
                                @error('secret')
                                <span class="pt-2 text-sm text-red-500">
                                {{ $message }}
                            </span>
                                @enderror
                            </div>
                            <div class="col-span-full md:col-span-1">
                                <button type="submit" class="w-full mt-1 transition duration-200 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-bold rounded-md text-green-200 bg-green-700 hover:text-green-300 hover:bg-green-800 focus:outline-none">
                                    Enable
                                </button>
                            </div>
                        </div>
                    </form>
                @endif
            </div>
        </div>
    </div>
@endsection
