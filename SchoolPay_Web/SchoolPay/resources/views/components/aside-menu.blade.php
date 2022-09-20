<aside
    {{ $attributes->merge(['class' => "w-64 min-h-full bg-white mt-2 mr-2 border-r-2 border-b-2 rounded-r-xl border-[#ffc371]"]) }} aria-label="Sidebar">
    <div class="overflow-y-auto min-h-85 py-4 px-3 bg-white rounded-xl">
        <ul class="space-y-4">
            {{ $slot }}
        </ul>
    </div>
</aside>

