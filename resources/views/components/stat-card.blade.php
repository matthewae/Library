<div class="rounded-lg shadow-md p-6 {{ $bgColor }} text-white">
    <div class="flex items-center justify-between">
        <div>
            <p class="text-sm font-medium {{ $textColor }} uppercase">{{ $title }}</p>
            <p class="text-3xl font-bold">{{ $value }}</p>
        </div>
        <div class="text-gray-400">
            {{ $icon }}
        </div>
    </div>
</div>