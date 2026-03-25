<x-app-layout> <x-slot name="header"> Roles </x-slot>
    <div x-data="{ addModalOpen: {{ $errors->has('name') && !old('id') ? 'true' : 'false' }}, editModalOpen: {{ $errors->has('name') && old('id') ? 'true' : 'false' }}, roleId: '{{ old('id') }}', roleName: '{{ old('name') }}', toastOpen: {{ session('success') ? 'true' : 'false' }}, toastMessage: '{{ session('success') }}', openEditModal(id, name) { this.roleId = id;
            this.roleName = name;
            this.editModalOpen = true; }, init() { if (this.toastOpen) { setTimeout(() => this.toastOpen = false, 4000); } } }" class="space-y-8 pb-10"> <!-- Animated Toast Notification -->
        <div x-show="toastOpen" x-transition:enter="transform ease-out duration-500 transition"
            x-transition:enter-start="translate-y-2 opacity-0 sm:translate-y-0 sm:translate-x-4"
            x-transition:enter-end="translate-y-0 opacity-100 sm:translate-x-0"
            x-transition:leave="transition ease-in duration-300" x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            class="fixed top-6 right-6 z-[200] w-full max-w-[320px] bg-white/80 backdrop-blur-xl rounded-2xl shadow-[0_10px_40px_rgba(0,0,0,0.08)] border border-white/40 p-4 pointer-events-auto overflow-hidden group"
            style="display: none;" x-cloak>
            <div class="flex items-start space-x-3">
                <div class="flex-shrink-0 w-8 h-8 rounded-full bg-emerald-500/10 flex items-center justify-center"> <svg
                        class="w-4 h-4 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                    </svg> </div>
                <div class="flex-1 pt-0.5">
                    <p class="text-xs font-black text-gray-900 mb-0.5 tracking-tight uppercase">Notification</p>
                    <p class="text-[10px] text-gray-500 font-bold leading-relaxed" x-text="toastMessage"></p>
                </div> <button @click="toastOpen = false" class="text-gray-300 hover:text-gray-500 transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                            d="M6 18L18 6M6 6l12 12"></path>
                    </svg> </button>
            </div> <!-- Progress Bar -->
            <div x-show="toastOpen" class="absolute bottom-0 left-0 h-1 bg-emerald-500/10 w-full">
                <div class="h-full bg-emerald-500 transition-all duration-[4000ms] ease-linear"
                    :style="toastOpen ? 'width: 100%' : 'width: 0%'"></div>
            </div>
        </div> <!-- Employee-Style Glass Container -->
        <div class="glass-card overflow-hidden"> <!-- Header & Actions -->
            <div
                class="px-8 py-6 border-b border-white/30 flex flex-col md:flex-row justify-between items-center gap-4">
                <h2 class="text-xl font-black text-gray-800 tracking-tighter">Manage Roles</h2>
                <div class="flex flex-col md:flex-row items-center gap-4 w-full md:w-auto"> <!-- Search Bar -->
                    <div class="relative w-full md:w-64">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none"> <svg
                                class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg> </div>
                        <form action="{{ route('roles.index') }}" method="GET"> <input type="text" name="search"
                                value="{{ request('search') }}" placeholder="Search roles..."
                                class="w-full pl-10 pr-4 py-2 bg-white/40 backdrop-blur-md border border-white/50 focus:bg-white focus:border-gray-400 focus:ring-2 focus:ring-gray-500/10 rounded-pill text-sm font-semibold transition-all outline-none shadow-sm">
                        </form>
                    </div> <!-- Add Role Button --> <button @click="addModalOpen = true"
                        class="w-full md:w-auto px-6 py-2 rounded-pill bg-[#004499] text-white font-black tracking-widest shadow-xl shadow-brand-accent/5 transition-all flex items-center justify-center space-x-2 uppercase transform hover:scale-105 active:scale-95">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg> <span class="text-[11px] uppercase tracking-widest">Add Role</span> </button>
                </div>
            </div> <!-- Table (Within glass-card) -->
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead class="bg-black/5">
                        <tr>
                            <th
                                class="px-8 py-5 text-[10px] font-black text-gray-400 uppercase tracking-widest border-b border-white/10">
                                SL #</th>
                            <th
                                class="px-8 py-5 text-[10px] font-black text-gray-400 uppercase tracking-widest border-b border-white/10">
                                Designation</th>
                            <th
                                class="px-8 py-5 text-[10px] font-black text-gray-400 uppercase tracking-widest border-b border-white/10">
                                Scope</th>
                            <th
                                class="px-8 py-5 text-[10px] font-black text-gray-400 uppercase tracking-widest border-b border-white/10">
                                Timeline</th>
                            <th
                                class="px-8 py-5 text-[10px] font-black text-gray-400 uppercase tracking-widest border-b border-white/10">
                                Status</th>
                            <th
                                class="px-8 py-5 text-[10px] font-black text-gray-400 uppercase tracking-widest text-right border-b border-white/10">
                                Operations</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-white/10">
                        @foreach ($roles as $role)
                            <tr class="hover:bg-white/40 transition-all group">
                                <td class="px-8 py-4 text-[11px] font-black text-gray-300 tracking-tighter">
                                    #{{ str_pad(($roles->currentPage() - 1) * $roles->perPage() + $loop->iteration, 2, '0', STR_PAD_LEFT) }}
                                </td>
                                <td class="px-8 py-4"> <span
                                        class="text-sm font-black text-gray-800 tracking-tight">{{ $role->name }}</span>
                                </td>
                                <td class="px-8 py-4"> <span
                                        class="px-3 py-1 bg-white/60 text-gray-500 border border-white/50 rounded-pill text-[9px] font-black uppercase tracking-widest group-hover:bg-white group-hover:scale-105 transition-all">System
                                        Core</span> </td>
                                <td class="px-8 py-4 text-[11px] text-gray-400 font-bold tracking-tight">
                                    {{ $role->created_at->format('M d, Y') }} </td>
                                <td class="px-8 py-4"> <span
                                        class="px-3 py-1 bg-emerald-500/10 text-emerald-600 rounded-pill text-[9px] font-black uppercase tracking-widest border border-emerald-500/20">Authorized</span>
                                </td>
                                <td class="px-8 py-4 text-right">
                                    <div class="flex justify-end items-center space-x-2"> <button
                                            class="w-9 h-9 flex items-center justify-center rounded-pill bg-white/50 text-gray-400 hover:active-bubble transition-all shadow-sm"
                                            title="Inspect"> <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                                </path>
                                            </svg> </button> <button
                                            @click="openEditModal('{{ $role->id }}', '{{ $role->name }}')"
                                            class="w-9 h-9 flex items-center justify-center rounded-pill bg-white/50 text-brand-accent hover:active-bubble transition-all shadow-sm"
                                            title="Modify"> <svg class="w-4 h-4" fill="none"
                                                stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    stroke-width="2.5"
                                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                                </path>
                                            </svg> </button>
                                        @if ($role->name !== 'Super Admin')
                                            <form action="{{ route('roles.destroy', $role) }}" method="POST"
                                                onsubmit="return confirm('Purge access profile?');" class="inline">
                                                @csrf @method('DELETE') <button type="submit"
                                                    class="w-9 h-9 flex items-center justify-center rounded-pill bg-white/50 text-rose-400 hover:bg-rose-500 hover:text-white transition-all shadow-sm"
                                                    title="Purge"> <svg class="w-4 h-4" fill="none"
                                                        stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2.5"
                                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                                        </path>
                                                    </svg> </button> </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                    </tbody>
                </table>
            </div>
        </div> <!-- Pagination -->
        <div class="mt-4 px-2"> {{ $roles->links() }} </div> <!-- Modals --> <!-- Add Role Modal -->
        <div x-show="addModalOpen" class="fixed inset-0 z-[100] overflow-y-auto" style="display: none;" x-cloak>
            <div class="flex items-center justify-center min-h-screen p-4 text-center">
                <div x-show="addModalOpen" x-transition:enter="ease-out duration-300"
                    x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                    class="fixed inset-0 bg-gray-500/20 backdrop-blur-sm transition-opacity"></div>
                <div x-show="addModalOpen" @click.away="addModalOpen = false"
                    x-transition:enter="ease-out duration-300"
                    x-transition:enter-start="opacity-0 translate-y-4 sm:scale-95"
                    x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                    class="inline-block bg-white rounded-2xl text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:max-w-md w-full border border-gray-100">
                    <div class="bg-white p-6">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-xl font-bold text-gray-900">Add New Role</h3> <button
                                @click="addModalOpen = false" class="text-gray-400 hover:text-gray-600"> <svg
                                    class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12"></path>
                                </svg> </button>
                        </div>
                        <form action="{{ route('roles.store') }}" method="POST" id="addRoleForm"> @csrf <div
                                class="space-y-4">
                                <div> <label
                                        class="block text-xs font-bold text-gray-500 uppercase tracking-widest mb-1.5 px-1">Role
                                        Name</label> <input type="text" name="name"
                                        value="{{ old('name') }}" required
                                        class="w-full px-4 py-3 bg-gray-50 border border-gray-200 focus:bg-white focus:border-gray-400 focus:ring-2 focus:ring-gray-500/10 rounded-xl text-sm font-semibold transition-all outline-none"
                                        placeholder="e.g. HR Manager"> @error('name')
                                        <p class="text-red-500 text-[10px] font-bold uppercase mt-1 px-1">
                                            {{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="bg-gray-50/50 px-6 py-4 flex justify-end space-x-3 border-t border-gray-100"> <button
                            @click="addModalOpen = false"
                            class="px-4 py-2 text-sm font-bold text-gray-500 hover:text-gray-700">Cancel</button>
                        <button type="submit" form="addRoleForm"
                            class="btn-primary !px-6 !py-2 !text-xs">Save
                            Role</button> </div>
                </div>
            </div>
        </div> <!-- Edit Role Modal -->
        <div x-show="editModalOpen" class="fixed inset-0 z-[100] overflow-y-auto" style="display: none;" x-cloak>
            <div class="flex items-center justify-center min-h-screen p-4 text-center">
                <div x-show="editModalOpen" x-transition:enter="ease-out duration-300"
                    x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                    class="fixed inset-0 bg-gray-500/20 backdrop-blur-sm transition-opacity"></div>
                <div x-show="editModalOpen" @click.away="editModalOpen = false"
                    x-transition:enter="ease-out duration-300"
                    x-transition:enter-start="opacity-0 translate-y-4 sm:scale-95"
                    x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                    class="inline-block bg-white rounded-2xl text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:max-w-md w-full border border-gray-100">
                    <div class="bg-white p-6">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-xl font-bold text-gray-900">Edit Role</h3> <button
                                @click="editModalOpen = false" class="text-gray-400 hover:text-gray-600"> <svg
                                    class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12"></path>
                                </svg> </button>
                        </div>
                        <form :action="'{{ url('roles') }}/' + roleId" method="POST" id="editRoleForm"> @csrf
                            @method('PUT') <input type="hidden" name="id" x-model="roleId">
                            <div class="space-y-4">
                                <div> <label
                                        class="block text-xs font-bold text-gray-500 uppercase tracking-widest mb-1.5 px-1">Role
                                        Name</label> <input type="text" name="name" x-model="roleName" required
                                        class="w-full px-4 py-3 bg-gray-50 border border-gray-200 focus:bg-white focus:border-gray-400 focus:ring-2 focus:ring-gray-500/10 rounded-xl text-sm font-semibold transition-all outline-none">
                                    @error('name')
                                        <p class="text-red-500 text-[10px] font-bold uppercase mt-1 px-1">
                                            {{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="bg-gray-50/50 px-6 py-4 flex justify-end space-x-3 border-t border-gray-100"> <button
                            @click="editModalOpen = false"
                            class="px-4 py-2 text-sm font-bold text-gray-500 hover:text-gray-700">Cancel</button>
                        <button type="submit" form="editRoleForm"
                            class="btn-primary !px-6 !py-2 !text-xs">Update
                            Role</button> </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
