<x-app-layout>
    <div class="abc-page-header">
        <div class="flex justify-between items-center relative z-10">
            <div class="flex items-center gap-3">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-amber-300" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75m-3-7.036A11.959 11.959 0 0 1 3.598 6 11.99 11.99 0 0 0 3 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285Z" />
                </svg>
                <div>
                    <h2 class="text-2xl font-bold tracking-tight">Permisos de Acceso</h2>
                    <p class="text-white/70 text-sm mt-1">Gestionar los módulos visibles del menú para cada usuario</p>
                </div>
            </div>
        </div>
    </div>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- Filtros --}}
            <div class="abc-filter-bar">
                <form method="GET" action="{{ route('permissions.index') }}" class="flex flex-col sm:flex-row gap-4 items-end">
                    <div class="flex-1">
                        <label class="abc-label">Buscar</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"/>
                                </svg>
                            </span>
                            <input type="text" name="search" value="{{ request('search') }}"
                                   placeholder="Nombre o correo..."
                                   class="abc-input pl-10">
                        </div>
                    </div>
                    <div>
                        <label class="abc-label">Rol</label>
                        <select name="role" class="abc-input">
                            <option value="">-- Todos --</option>
                            <option value="ADMIN" @selected(request('role') === 'ADMIN')>ADMIN</option>
                            <option value="USUARIO" @selected(request('role') === 'USUARIO')>USUARIO</option>
                        </select>
                    </div>
                    <div class="flex gap-2">
                        <button type="submit" class="abc-btn abc-btn-primary">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M3 3a1 1 0 011-1h12a1 1 0 011 1v3a1 1 0 01-.293.707L12 11.414V15a1 1 0 01-.293.707l-2 2A1 1 0 018 17v-5.586L3.293 6.707A1 1 0 013 6V3z" clip-rule="evenodd"/>
                            </svg>
                            Filtrar
                        </button>
                        <a href="{{ route('permissions.index') }}" class="abc-btn abc-btn-ghost">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
                            </svg>
                            Limpiar
                        </a>
                    </div>
                </form>
            </div>

            {{-- Lista de usuarios con sus módulos --}}
            @forelse($users as $user)
                <div class="abc-card" x-data="{ expanded: false }">
                    <div class="px-5 py-4">
                        {{-- Cabecera del usuario --}}
                        <div class="flex items-center justify-between flex-wrap gap-3">
                            <div class="flex items-center gap-4">
                                <div class="w-11 h-11 rounded-full flex items-center justify-center text-white text-sm font-bold flex-shrink-0 {{ $user->is_active ? 'gradient-navy' : 'bg-gray-400' }}">
                                    {{ strtoupper(substr($user->name, 0, 2)) }}
                                </div>
                                <div>
                                    <div class="flex items-center gap-2 flex-wrap">
                                        <span class="font-semibold text-base" style="color: var(--text-primary)">{{ $user->name }}</span>
                                        @if($user->role === 'ADMIN')
                                            <span class="abc-badge bg-red-50 text-red-700 border border-red-200 text-[10px]">ADMIN</span>
                                        @else
                                            <span class="abc-badge bg-blue-50 text-blue-700 border border-blue-200 text-[10px]">USUARIO</span>
                                        @endif
                                        @if(!$user->is_active)
                                            <span class="abc-badge bg-red-100 text-red-700 border border-red-200 text-[10px]">BLOQUEADO</span>
                                        @endif
                                    </div>
                                    <p class="text-xs mt-0.5" style="color: var(--text-muted)">{{ $user->email }}</p>
                                </div>
                            </div>
                            <div class="flex items-center gap-3">
                                {{-- Contador de módulos --}}
                                @php
                                    $userModules = $user->getAllowedModules();
                                    $totalModules = count(\App\Models\User::ALL_MODULES);
                                    $activeModules = count($userModules);
                                @endphp
                                <span class="text-xs font-medium px-2.5 py-1 rounded-lg" style="background-color: var(--surface-border-light); color: var(--text-secondary)">
                                    {{ $activeModules }}/{{ $totalModules }} módulos
                                </span>

                                @if($user->id !== auth()->id())
                                    <button @click="expanded = !expanded" type="button"
                                            class="abc-btn abc-btn-primary !px-4 !py-2 text-xs">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 transition-transform duration-200"
                                             :class="expanded ? 'rotate-180' : ''" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"/>
                                        </svg>
                                        <span x-text="expanded ? 'Cerrar' : 'Configurar'"></span>
                                    </button>
                                @elseif($user->id === auth()->id())
                                    <span class="text-xs italic px-3 py-2" style="color: var(--text-muted)">Tu cuenta</span>
                                @else
                                    <span class="text-xs italic px-3 py-2" style="color: var(--text-muted)">Sin permisos</span>
                                @endif
                            </div>
                        </div>

                        {{-- Resumen de módulos (visible cuando NO está expandido) --}}
                        <div class="flex flex-wrap gap-1.5 mt-3" x-show="!expanded">
                            @foreach(\App\Models\User::ALL_MODULES as $key => $label)
                                @if(in_array($key, $userModules))
                                    <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded text-[10px] font-medium bg-emerald-50 text-emerald-700 border border-emerald-200">
                                        <svg class="w-2.5 h-2.5" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                                        {{ $label }}
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded text-[10px] font-medium bg-red-50 text-red-400 border border-red-100 line-through">
                                        <svg class="w-2.5 h-2.5" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/></svg>
                                        {{ $label }}
                                    </span>
                                @endif
                            @endforeach
                        </div>
                    </div>

                    {{-- Panel expandido: configurar módulos --}}
                    <div x-show="expanded"
                         x-transition:enter="transition ease-out duration-200"
                         x-transition:enter-start="opacity-0 -translate-y-2"
                         x-transition:enter-end="opacity-100 translate-y-0"
                         x-transition:leave="transition ease-in duration-150"
                         x-transition:leave-start="opacity-100 translate-y-0"
                         x-transition:leave-end="opacity-0 -translate-y-2"
                         x-cloak
                         class="border-t px-5 py-5" style="border-color: var(--border-primary); background-color: var(--surface-secondary)">

                        <form method="POST" action="{{ route('permissions.update-modules', $user) }}" id="form-modules-{{ $user->id }}">
                            @csrf
                            @method('PUT')

                            <div class="mb-4">
                                <p class="text-sm font-semibold mb-1" style="color: var(--text-primary)">Módulos del menú</p>
                                <p class="text-xs" style="color: var(--text-muted)">Desmarca los módulos que quieras quitar del menú de este usuario. El Dashboard siempre es visible.</p>
                            </div>

                            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-5 gap-3">
                                @foreach(\App\Models\User::ALL_MODULES as $key => $label)
                                    @php
                                        $isChecked = in_array($key, $userModules);
                                        $isDashboard = $key === 'dashboard';
                                    @endphp
                                    <label class="relative flex items-center gap-2.5 p-3 rounded-lg border cursor-pointer transition-all duration-150 hover:shadow-sm
                                                  {{ $isDashboard ? 'opacity-50 cursor-not-allowed' : '' }}"
                                           style="border-color: var(--border-primary); background-color: var(--surface-card)">
                                        <input type="checkbox"
                                               name="modules[]"
                                               value="{{ $key }}"
                                               {{ $isChecked ? 'checked' : '' }}
                                               {{ $isDashboard ? 'checked disabled' : '' }}
                                               class="w-4 h-4 rounded border-gray-300 text-blue-600 focus:ring-blue-500 transition">
                                        @if($isDashboard)
                                            <input type="hidden" name="modules[]" value="dashboard">
                                        @endif
                                        <div>
                                            <span class="text-xs font-semibold block" style="color: var(--text-primary)">{{ $label }}</span>
                                            @if($isDashboard)
                                                <span class="text-[9px]" style="color: var(--text-muted)">Siempre visible</span>
                                            @endif
                                        </div>
                                    </label>
                                @endforeach
                            </div>

                            <div class="flex justify-end gap-3 mt-5">
                                <button @click="expanded = false" type="button" class="abc-btn abc-btn-ghost">
                                    Cancelar
                                </button>
                                <button type="button" onclick="confirmarGuardarModulos({{ $user->id }}, '{{ addslashes($user->name) }}')"
                                        class="abc-btn abc-btn-primary">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                    </svg>
                                    Guardar Permisos
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            @empty
                <div class="abc-card">
                    <div class="text-center py-12">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75m-3-7.036A11.959 11.959 0 0 1 3.598 6 11.99 11.99 0 0 0 3 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285Z" />
                        </svg>
                        <p class="font-medium mt-3" style="color: var(--text-muted)">No se encontraron usuarios.</p>
                    </div>
                </div>
            @endforelse

            {{-- Paginación --}}
            <div class="px-2">
                {{ $users->links() }}
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        function confirmarGuardarModulos(userId, userName) {
            const form = document.getElementById(`form-modules-${userId}`);
            const checked = form.querySelectorAll('input[name="modules[]"]:checked');
            const count = checked.length;

            Swal.fire({
                title: '¿Guardar permisos?',
                html: `Se asignarán <strong class="text-blue-600">${count} módulos</strong> al usuario <strong>${userName}</strong>.<br><small class="text-gray-500">Los módulos no seleccionados desaparecerán de su menú.</small>`,
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#1d4ed8',
                cancelButtonColor: '#6b7280',
                confirmButtonText: 'Sí, guardar',
                cancelButtonText: 'Cancelar',
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        }
    </script>
    @endpush
</x-app-layout>
