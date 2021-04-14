@foreach (session('flash_notification', collect())->toArray() as $message)
    @if ($message['overlay'])
        @include('flash::modal', [
            'modalClass' => 'flash-modal',
            'title'      => $message['title'],
            'body'       => $message['message']
        ])
    @else
        <div class="fixed top-5 right-5 p-4 w-60 rounded-md
                    alert alert-{{ $message['level'] }}
                    {{ $message['important'] ? 'alert-important' : '' }}"
                    role="alert" style="display: none;"
        >
            <span>
                @switch($message['level'])
                    @case('info')
                        <i class="fas fa-info-circle"></i> <span class="font-bold ml-1">Info</span>
                        @break
                    @case('success')
                        <i class="fas fa-check-circle"></i> <span class="font-bold ml-1">Success</span>
                        @break
                    @case('warning')
                        <i class="fas fa-exclamation-triangle"></i> <span class="font-bold ml-1">Warning</span>
                        @break
                    @case('danger')
                        <i class="fas fa-exclamation-circle"></i> <span class="font-bold ml-1">Error</span>
                        @break
                @endswitch
            </span>

            @if ($message['important'])
                <button type="button"
                        class="alert-close absolute right-4 focus:outline-none"
                        data-dismiss="alert"
                        aria-hidden="true"
                >&times;</button>
            @endif

            <div class="mt-2 text-sm pb-4">
                {!! $message['message'] !!}
            </div>
        </div>
    @endif
@endforeach

{{ session()->forget('flash_notification') }}
