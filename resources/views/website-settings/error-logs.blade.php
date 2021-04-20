@extends('layouts.staff')

@section('title', 'Error logs - Website Settings - Staff')

@section('content-staff')
    <div>
        <div class="mb-20 break-words text-center">
            <h2>Website Settings <span class="font-light">/ Error logs</span></h2>
        </div>

        <form action="" method="GET" class="mb-10 p-6 bg-gray-800 rounded-md grid grid-cols-10 gap-4">
            <div class="col-span-full md:col-span-2">
                <input type="text" name="statusCode" class="text-gray-300 bg-gray-700 focus:ring-primary-dark focus:border-primary-dark block w-full shadow-sm md:text-sm border-gray-600 rounded-md" placeholder="Status code" value="{{ request('statusCode') }}">
            </div>

            <div class="col-span-full md:col-span-2">
                <input type="text" name="uri" class="text-gray-300 bg-gray-700 focus:ring-primary-dark focus:border-primary-dark block w-full shadow-sm md:text-sm border-gray-600 rounded-md" placeholder="URI" value="{{ request('uri') }}">
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

        <div class="shadow overflow-x-auto rounded-lg">
            <table class="min-w-full divide-y divide-gray-800 border-none">
                <thead class="bg-gray-700">
                    <tr>
                        <th scope="col" class="border-none px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">
                            ID
                        </th>
                        <th scope="col" class="border-none px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">
                            IP Address
                        </th>
                        <th scope="col" class="border-none px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">
                            Status code
                        </th>
                        <th scope="col" class="border-none px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">
                            URI
                        </th>
                        <th scope="col" class="border-none px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">
                            Occurred at (UTC)
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-gray-800">
                @forelse($errors as $error)
                    <tr>
                        <td class="border-none px-6 py-4 whitespace-nowrap text-sm">
                            {{ $error->id }}
                        </td>
                        <td class="border-none px-6 py-4 whitespace-nowrap text-sm">
                            {{ $error->ip_address }}
                        </td>
                        <td class="border-none px-6 py-4 whitespace-nowrap text-sm">
                            @switch($error->status_code)
                                @case(strval($error->status_code)[0] === '5')
                                    <span class="p-2 rounded-md bg-red-500 font-bold">
                                        {{ $error->status_code }}
                                    </span>
                                    @break
                                @case(strval($error->status_code)[0] === '4')
                                    <span class="p-2 rounded-md bg-yellow-500 font-bold">
                                        {{ $error->status_code }}
                                    </span>
                                    @break

                                @default
                                    <span class="p-2 rounded-md bg-blue-500 font-bold">
                                        {{ $error->status_code }}
                                    </span>
                                    @break
                            @endswitch
                        </td>
                        <td class="border-none px-6 py-4 whitespace-nowrap text-sm">
                            {{ $error->uri }}
                        </td>
                        <td class="border-none px-6 py-4 whitespace-nowrap text-sm">
                            {{ $error->created_at->format('d M H:i') }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="border-none px-6 py-4 whitespace-nowrap text-sm italic text-gray-300">No errors logged yet...</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>

        {{ $errors->onEachSide(1)->withQueryString()->links() }}
    </div>
@endsection
