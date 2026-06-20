@props(['items' => []])

<nav aria-label="breadcrumb">
    <ol class="breadcrumb bg-transparent p-0 mb-3">
        <li class="breadcrumb-item">
            <a href="{{ route('dashboard') }}" class="text-primary">
                <i class="fas fa-home"></i> Dashboard
            </a>
        </li>

        @foreach ($items as $item)
            @if (isset($item['url']) && !$loop->last)
                <li class="breadcrumb-item">
                    <a href="{{ $item['url'] }}" class="text-primary">
                        {{ $item['name'] }}
                    </a>
                </li>
            @else
                <li class="breadcrumb-item active" aria-current="page">
                    {{ $item['name'] }}
                </li>
            @endif
        @endforeach
    </ol>
</nav>
