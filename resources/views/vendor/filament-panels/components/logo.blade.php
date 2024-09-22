@if (filled($brand = filament()->getBrandName()))
    <div
        {{
            $attributes->class([
                'fi-logo text-xl font-bold leading-5 tracking-tight text-gray-950 dark:text-white',
            ])
        }}
    >
<<<<<<< HEAD
=======
        <img src="{{ asset('roof.jpeg') }}" alt="Logo" class="h-10">
>>>>>>> origin/main
    </div>
@endif
