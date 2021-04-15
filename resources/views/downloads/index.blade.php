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

                    @can('manage-downloads')
                        <div id="modal-edit-download-{{ $download->id }}" class="fixed z-10 inset-0 overflow-y-auto" style="display: none;" aria-labelledby="modal-title" role="dialog" aria-modal="true">
                            <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                                <!--
                                  Background overlay, show/hide based on modal state.

                                  Entering: "ease-out duration-300"
                                    From: "opacity-0"
                                    To: "opacity-100"
                                  Leaving: "ease-in duration-200"
                                    From: "opacity-100"
                                    To: "opacity-0"
                                -->
                                <div id="overlay-edit-download-{{ $download->id }}" class="fixed inset-0 bg-gray-900 bg-opacity-75 transition-opacity" aria-hidden="true"></div>

                                <!-- This element is to trick the browser into centering the modal contents. -->
                                <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

                                <!--
                                  Modal panel, show/hide based on modal state.

                                  Entering: "ease-out duration-300"
                                    From: "opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                                    To: "opacity-100 translate-y-0 sm:scale-100"
                                  Leaving: "ease-in duration-200"
                                    From: "opacity-100 translate-y-0 sm:scale-100"
                                    To: "opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                                -->
                                <div class="inline-block align-bottom bg-gray-700 rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                                    <div class="bg-gray-700 px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                                        <div class="sm:flex sm:items-start">
                                            <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-gray-800 sm:mx-0 sm:h-10 sm:w-10">
                                                <i class="flex-shrink-0 fas fa-pen fa-fw text-primary"></i>
                                            </div>
                                            <div class="w-full mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                                                <h3 class="mb-5 text-lg leading-6 font-medium text-gray-300" id="modal-title">
                                                    Edit "{{ $download->name }}" download
                                                </h3>
                                                <div class="mt-2">
                                                    <form action="{{ route('staff.downloads.update', $download) }}" method="POST">
                                                        @csrf
                                                        @method('PATCH')
                                                        <div class="mb-5">
                                                            <div class="mb-2">
                                                                <label for="name" class="block text-sm font-medium text-gray-300">Name <span class="text-red-500 font-bold">*</span></label>
                                                                <input type="text" name="name" id="name" class="text-gray-300 bg-gray-700 mt-1 focus:ring-primary-dark focus:border-primary-dark block w-full shadow-sm md:text-sm border-gray-600 rounded-md" required value="{{ $download->name }}">
                                                            </div>

                                                            <div>
                                                                <label for="link" class="block text-sm font-medium text-gray-300">Link <span class="text-red-500 font-bold">*</span></label>
                                                                <input type="text" name="link" id="link" class="text-gray-300 bg-gray-700 mt-1 focus:ring-primary-dark focus:border-primary-dark block w-full shadow-sm md:text-sm border-gray-600 rounded-md" required value="{{ $download->link }}">
                                                            </div>
                                                        </div>

                                                        <div class="col-span-full">
                                                            <label for="roles" class="mb-2 block text-sm font-medium text-gray-300">Roles that can see this download <span class="text-red-500 font-bold">*</span></label>
                                                            @foreach($roles as $role)
                                                                <div>
                                                                    <input type="checkbox" id="input-edit-download-{{ $download->id }}-role-{{ $role->id }}" name="roles[]" value="{{ $role->id }}" style="color: {{ $role->color }}" class="form-checkbox rounded-full border-none focus:ring-offset-0 focus:ring-0 cursor-pointer" @if(in_array($role->id, $download->roles->pluck('id')->toArray())) checked @endif>
                                                                    <label for="input-edit-download-{{ $download->id }}-role-{{ $role->id }}" style="color: {{ $role->color }}">{{ $role->name }}</label>
                                                                </div>
                                                            @endforeach
                                                        </div>

                                                        <div class="mt-6 text-right">
                                                            <button type="button" id="modal-edit-cancel-download-{{ $download->id }}" class="transition duration-200 text-sm text-primary hover:text-primary-dark focus:outline-none">
                                                                Cancel
                                                            </button>
                                                            <button type="submit" class="ml-4 transition duration-200 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-bold rounded-md text-gray-700 bg-primary hover:text-gray-700 hover:bg-primary-dark focus:outline-none">
                                                                Edit
                                                            </button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endcan
                @empty
                    <span class="text-sm italic text-gray-300">No downloads available for you yet...</span>
                @endforelse
            </ul>
        </div>
    </div>
@endsection
