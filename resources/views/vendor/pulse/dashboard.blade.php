<x-pulse>
    {{-- Servidor: CPU, Memoria, Almacenamiento de tu laptop --}}
    <livewire:pulse.servers cols="full" />

    {{-- Actividad de Usuarios: Top usuarios haciendo requests + jobs --}}
    <livewire:pulse.usage cols="4" rows="2" />

    {{-- Colas de trabajo --}}
    <livewire:pulse.queues cols="4" />

    {{-- Caché del sistema --}}
    <livewire:pulse.cache cols="4" />

    {{-- Solicitudes lentas: qué rutas tardan más --}}
    <livewire:pulse.slow-requests cols="6" />

    {{-- Excepciones/Errores del sistema --}}
    <livewire:pulse.exceptions cols="6" />

    {{-- Consultas SQL lentas --}}
    <livewire:pulse.slow-queries cols="8" />

    {{-- Actividad de usuarios en Jobs --}}
    <livewire:pulse.usage cols="4" type="jobs" />

    {{-- Jobs lentos --}}
    <livewire:pulse.slow-jobs cols="6" />

    {{-- Solicitudes externas lentas --}}
    <livewire:pulse.slow-outgoing-requests cols="6" />
</x-pulse>
