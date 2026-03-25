<x-app-layout>
    <x-slot name="header">
        User Management
    </x-slot>

    <div class="px-6 pb-12 max-w-2xl mx-auto text-center">
        <div class="glass-card overflow-hidden bg-white">
            <div class="p-10 border-b border-gray-100">
                <h2 class="text-2xl font-black text-gray-800 tracking-tight">Edit User Account</h2>
                <p class="text-sm text-gray-500 font-medium mt-1">Update global permissions and identity for <strong>{{ $user->name }}</strong>.</p>
            </div>

            <form action="{{ route('users.update', $user) }}" method="POST" class="p-10 space-y-8 text-left">
                @csrf
                @method('PUT')
                
                <div class="space-y-6">
                    <!-- Full Name -->
                    <div class="space-y-1">
                        <label for="name" class="block text-sm font-bold text-gray-700 ml-1">Full Name <span class="text-rose-500">*</span></label>
                        <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" required
                            class="w-full px-4 py-3 bg-gray-50 border-2 border-[#E5E7EB] hover:border-gray-400 rounded-xl text-sm font-bold outline-none focus:bg-white duration-300 focus:border-black focus:ring-0 transition-all">
                        @error('name') <p class="text-[10px] text-rose-500 font-bold mt-1 ml-2">{{ $message }}</p> @enderror
                    </div>

                    <!-- Email Address -->
                    <div class="space-y-1">
                        <label for="email" class="block text-sm font-bold text-gray-700 ml-1">Email Address <span class="text-rose-500">*</span></label>
                        <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" required
                            class="w-full px-4 py-3 bg-gray-50 border-2 border-[#E5E7EB] hover:border-gray-400 rounded-xl text-sm font-bold outline-none focus:bg-white duration-300 focus:border-black focus:ring-0 transition-all">
                        @error('email') <p class="text-[10px] text-rose-500 font-bold mt-1 ml-2">{{ $message }}</p> @enderror
                    </div>

                    <!-- System Role -->
                    <div class="space-y-1">
                        <label for="role" class="block text-sm font-bold text-gray-700 ml-1">System Role <span class="text-rose-500">*</span></label>
                        <select name="role" id="role" required
                            class="w-full px-4 py-3 bg-gray-50 border-2 border-[#E5E7EB] hover:border-gray-400 rounded-xl text-sm font-bold outline-none focus:bg-white duration-300 focus:border-black focus:ring-0 transition-all cursor-pointer">
                            @foreach ($roles as $role)
                                <option value="{{ $role->name }}" {{ $user->hasRole($role->name) ? 'selected' : '' }}>
                                    {{ $role->name }}</option>
                            @endforeach
                        </select>
                        <p class="text-[10px] text-gray-400 mt-1 ml-1 font-medium italic">Changes here affect global access permissions.</p>
                    </div>
                </div>

                <div class="pt-10 border-t border-gray-100 flex justify-center gap-6">
                    <a href="{{ route('users.index') }}"
                        class="px-10 py-4 bg-gray-100 text-gray-500 rounded-xl font-bold text-sm hover:bg-gray-200 transition-all active:scale-95 uppercase tracking-widest text-center">
                        Discard
                    </a>
                    <button type="submit" class="btn-primary flex items-center gap-2">
                        Save Updates
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
