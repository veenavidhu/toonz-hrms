<x-app-layout>
    <x-slot name="header">
        Edit Department
    </x-slot>

    <div class="px-6 pb-12 max-w-4xl mx-auto">
        <div class="glass-card overflow-hidden bg-white">
            <div class="p-10 border-b border-gray-100">
                <h2 class="text-2xl font-black text-gray-800 tracking-tight">Modify Organizational Unit</h2>
                <p class="text-sm text-gray-500 font-medium mt-1">Update the details for the <strong>{{ $department->name }}</strong> department.</p>
            </div>

            <form action="{{ route('departments.update', $department) }}" method="POST" class="p-10 space-y-8">
                @csrf
                @method('PUT')
                <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-6">
                    <!-- Department Name -->
                    <div class="space-y-1">
                        <label for="name" class="block text-sm font-bold text-gray-700 ml-1">Department Name <span class="text-rose-500">*</span></label>
                        <input type="text" name="name" id="name" required
                            class="w-full px-4 py-3 bg-gray-50 border-2 border-[#E5E7EB] hover:border-gray-400 rounded-xl text-sm font-bold placeholder:text-gray-300 outline-none focus:bg-white duration-300 focus:border-black focus:ring-0 transition-all"
                            value="{{ old('name', $department->name) }}" placeholder="e.g. Engineering">
                        <p class="text-[10px] text-gray-400 mt-1 ml-1 font-medium">Change the name of the department if necessary.</p>
                        @error('name')
                            <p class="text-[10px] text-rose-500 font-bold mt-1 ml-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Manager Assignment -->
                    <div class="space-y-1">
                        <label for="manager_id" class="block text-sm font-bold text-gray-700 ml-1">Assign Manager</label>
                        <select name="manager_id" id="manager_id"
                            class="w-full px-4 py-3 bg-gray-50 border-2 border-[#E5E7EB] hover:border-gray-400 rounded-xl text-sm font-bold text-gray-700 outline-none focus:bg-white duration-300 focus:border-black focus:ring-0 transition-all cursor-pointer">
                            <option value="">Select a Manager</option>
                            @foreach ($managers as $manager)
                                <option value="{{ $manager->id }}" {{ old('manager_id', $department->manager_id) == $manager->id ? 'selected' : '' }}>
                                    {{ $manager->name }}
                                </option>
                            @endforeach
                        </select>
                        <p class="text-[10px] text-gray-400 mt-1 ml-1 font-medium">Update the individual responsible for this unit.</p>
                        @error('manager_id')
                            <p class="text-[10px] text-rose-500 font-bold mt-1 ml-2">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="pt-10 border-t border-gray-100 flex justify-center">
                    <button type="submit" class="btn-primary flex items-center gap-2">
                        Update Information
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>

