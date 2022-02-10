@extends('layouts.app')

@section('title', 'Book a convoy')

@push('stylesheets')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.css">
    <style>
        .fc-scrollgrid, thead, tbody {
            background-color: #111827;
        }

        .fc-scrollgrid {
            border-radius: 10px;
            border-left-width: 0!important;
            border-top-width: 0!important;
        }

        .fc td, .fc th {
            border-style: none;
        }

        .fc a {
            color: unset;
        }

        .fc .fc-daygrid-day.fc-day-today {
            color: #00ffaf;
            background-color: unset;
        }

        .fc-daygrid-event-dot {
            margin-left: 0;
        }

        .fc-daygrid-dot-event {
            flex-wrap: wrap;
        }

        .fc-event-title {
            flex-basis: 100%;
            white-space: initial;
        }

        .fc .fc-highlight {
            background-color: #00d693;
        }

        .fc .awaiting-for-approval {
            opacity: 0.3;
        }

        .fc .locked {
            background-color: green!important;
        }
    </style>
@endpush

@section('content')
    <div class="flex flex-col justify-center items-center bg-fixed bg-cover bg-center py-52" style="background-image: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), url('{{ config('app.default_banner') }}');">
        <div class="text-center break-words grid gap-4">
            <h1 class="text-5xl m-0 capitalize"><span class="inline-block transform -rotate-45"><i class="flex-shrink-0 fas fa-ticket-alt fa-fw"></i></span> Bookings</h1>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 md:px-6 my-16">
        <div class="px-4 py-5 md:p-6 bg-gray-800 rounded-md shadow overflow-hidden">
            <form action="{{ route('bookings.store') }}" method="POST">
                @csrf

                <div id="calendar"></div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <script src='https://cdn.jsdelivr.net/npm/moment@2.27.0/min/moment.min.js'></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.js"></script>
    <script src='fullcalendar/core/locales-all.js'></script>
    <script src='https://cdn.jsdelivr.net/npm/@fullcalendar/moment@5.5.0/main.global.min.js'></script>

    <script>
        const lang = navigator.language

        let calendar = new FullCalendar.Calendar(document.getElementById('calendar'), {
            locale: lang,
            firstDay: 1,
            editable: false,
            selectable: true,
            initialView: 'dayGridMonth',
            displayEventEnd: true,
            selectOverlap: function(event) {
                return event.display !== 'background';
            },
            selectAllow: function(selectInfo) {
                return moment().diff(selectInfo.start, 'days') <= 0
            },
            select: function (selectInfo) {
                //After selecting a date
            },
            events: [
                {
                    start: '2022-01-28',
                    allDay: true,
                    display: 'background',
                    backgroundColor: 'red'
                },
                {
                    title: 'Event 2',
                    start: '2022-01-26T17:00:00Z',
                    end: '2022-01-26T19:00:00Z'
                },
                {
                    title: 'Event 3',
                    start: '2022-01-26T20:00:00Z',
                    end: '2022-01-26T22:00:00Z'
                },
                {
                    title: 'Awaiting for approval',
                    start: '2022-01-29T20:00:00Z',
                    end: '2022-01-29T22:00:00Z',
                    classNames: 'awaiting-for-approval'
                },
                {
                    title: 'Event 1',
                    start: '2022-01-25',
                    allDay: true
                }
            ]
        });
        calendar.render();
    </script>
@endpush
