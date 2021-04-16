@extends('layouts.staff')

@section('title', 'Staff Hub')

@section('content-staff')
    <div>
        <div class="mb-20 text-center">
            <h2>Staff Hub</h2>
        </div>

        <div class="grid grid-cols-8 gap-6">
            <div class="col-span-full md:col-span-3">
                <div class="h-full p-4 rounded-md bg-gray-800">
                    <h3 class="mt-0 mb-8">Basic Statistics</h3>

                    <div class="self-center">
                        <div class="grid grid-cols-3 gap-6 text-center">
                            <div class="text-4xl font-bold">
                                {{ $counters['convoys'] }}
                            </div>
                            <div class="text-4xl font-bold">
                                {{ $counters['articles'] }}
                            </div>
                            <div class="text-4xl font-bold">
                                {{ $counters['users'] }}
                            </div>
                        </div>
                        <div class="mt-2 grid grid-cols-3 gap-6 text-center text-sm">
                            <div>
                                Convoys Published
                            </div>
                            <div>
                                Articles Posted
                            </div>
                            <div>
                                Staff Members
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-span-full md:col-span-5">
                <div class="p-4 rounded-md bg-gray-800">
                    <h3 class="mt-0 mb-8">Latest Activities</h3>

                    <div class="grid grid-rows-4 gap-2">
                        <table class="row-span-1 table-fixed border-none p-4 rounded-full bg-gray-200 text-sm text-gray-800">
                            <tr>
                                <td class="border-none font-bold">
                                    <i class="fas fa-user fa-fw"></i> HerissonMan
                                </td>
                                <td class="border-none font-bold">
                                    <span class="p-2 rounded-md bg-red-500 text-gray-200"><i class="fas fa-trash-alt fa-fw"></i> Deleted</span>
                                </td>
                                <td class="border-none font-bold">
                                    <i class="fas fa-images fa-fw"></i> Picture #1
                                </td>
                                <td class="border-none">
                                    <i class="fas fa-comment-dots fa-fw"></i> Custom message...
                                </td>
                                <td class="border-none text-right">
                                    <i class="fas fa-clock fa-fw"></i> 16 Apr 14:23
                                </td>
                            </tr>
                        </table>

                        <table class="row-span-1 table-fixed border-none p-4 rounded-full bg-gray-200 text-sm text-gray-800">
                            <tr>
                                <td class="border-none font-bold">
                                    <i class="fas fa-user fa-fw"></i> HerissonMan
                                </td>
                                <td class="border-none font-bold">
                                    <span class="p-2 rounded-md bg-red-500 text-gray-200"><i class="fas fa-trash-alt fa-fw"></i> Deleted</span>
                                </td>
                                <td class="border-none font-bold">
                                    <i class="fas fa-images fa-fw"></i> Picture #1
                                </td>
                                <td class="border-none">
                                    <i class="fas fa-comment-dots fa-fw"></i> Custom message...
                                </td>
                                <td class="border-none text-right">
                                    <i class="fas fa-clock fa-fw"></i> 16 Apr 14:23
                                </td>
                            </tr>
                        </table>

                        <table class="row-span-1 table-fixed border-none p-4 rounded-full bg-gray-200 text-sm text-gray-800">
                            <tr>
                                <td class="border-none font-bold">
                                    <i class="fas fa-user fa-fw"></i> HerissonMan
                                </td>
                                <td class="border-none font-bold">
                                    <span class="p-2 rounded-md bg-red-500 text-gray-200"><i class="fas fa-trash-alt fa-fw"></i> Deleted</span>
                                </td>
                                <td class="border-none font-bold">
                                    <i class="fas fa-images fa-fw"></i> Picture #1
                                </td>
                                <td class="border-none">
                                    <i class="fas fa-comment-dots fa-fw"></i> Custom message...
                                </td>
                                <td class="border-none text-right">
                                    <i class="fas fa-clock fa-fw"></i> 16 Apr 14:23
                                </td>
                            </tr>
                        </table>

                        <table class="row-span-1 table-fixed border-none p-4 rounded-full bg-gray-200 text-sm text-gray-800">
                            <tr>
                                <td class="border-none font-bold">
                                    <i class="fas fa-user fa-fw"></i> HerissonMan
                                </td>
                                <td class="border-none font-bold">
                                    <span class="p-2 rounded-md bg-red-500 text-gray-200"><i class="fas fa-trash-alt fa-fw"></i> Deleted</span>
                                </td>
                                <td class="border-none font-bold">
                                    <i class="fas fa-images fa-fw"></i> Picture #1
                                </td>
                                <td class="border-none">
                                    <i class="fas fa-comment-dots fa-fw"></i> Custom message...
                                </td>
                                <td class="border-none text-right">
                                    <i class="fas fa-clock fa-fw"></i> 16 Apr 14:23
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
