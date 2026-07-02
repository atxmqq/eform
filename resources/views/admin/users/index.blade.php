<x-layout title="{{ __('ui.admin.users_title') }}">
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800">{{ __('ui.admin.users_title') }}</h1>
        <p class="text-gray-500 text-sm mt-1">{{ __('ui.admin.users_subtitle') }}</p>
    </div>

    <div class="bg-white border border-gray-200 rounded-xl overflow-hidden">
        <table class="w-full text-sm">
            <thead class="bg-gray-50 border-b border-gray-200">
                <tr>
                    <th class="px-4 py-3 text-left text-gray-600 font-medium">{{ __('ui.admin.user_col') }}</th>
                    <th class="px-4 py-3 text-left text-gray-600 font-medium">{{ __('ui.admin.student_id_col') }}</th>
                    <th class="px-4 py-3 text-left text-gray-600 font-medium">{{ __('ui.admin.department_col') }}</th>
                    <th class="px-4 py-3 text-left text-gray-600 font-medium">{{ __('ui.admin.role_col') }}</th>
                    <th class="px-4 py-3 text-left text-gray-600 font-medium">{{ __('ui.common.status') }}</th>
                    <th class="px-4 py-3"></th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @foreach($users as $user)
                <tr class="hover:bg-gray-50">
                    <td class="px-4 py-3">
                        <div class="flex items-center gap-3">
                            @if($user->avatar)
                                <img src="{{ $user->avatar }}" class="w-8 h-8 rounded-full object-cover">
                            @else
                                <div class="w-8 h-8 rounded-full bg-blue-600 flex items-center justify-center text-white text-xs font-bold">
                                    {{ mb_substr($user->name, 0, 1) }}
                                </div>
                            @endif
                            <div>
                                <div class="font-medium text-gray-800">{{ $user->name }}</div>
                                <div class="text-xs text-gray-400">{{ $user->email }}</div>
                            </div>
                        </div>
                    </td>
                    <td class="px-4 py-3 text-gray-600">{{ $user->student_id ?? '-' }}</td>
                    <td class="px-4 py-3 text-gray-600">{{ $user->department ?? '-' }}</td>
                    <td class="px-4 py-3">
                        <form action="{{ route('admin.users.update', $user) }}" method="POST" class="flex items-center gap-2">
                            @csrf @method('PUT')
                            <input type="hidden" name="is_active" value="{{ $user->is_active ? '1' : '0' }}">
                            <input type="hidden" name="department" value="{{ $user->department }}">
                            <input type="hidden" name="student_id" value="{{ $user->student_id }}">
                            <select name="role" onchange="this.form.submit()"
                                    class="border border-gray-300 rounded-lg px-2 py-1.5 text-xs focus:outline-none focus:ring-2 focus:ring-blue-500">
                                @foreach($roles as $roleKey => $roleLabel)
                                    <option value="{{ $roleKey }}" {{ $user->role === $roleKey ? 'selected' : '' }}>
                                        {{ $roleLabel }}
                                    </option>
                                @endforeach
                            </select>
                        </form>
                    </td>
                    <td class="px-4 py-3">
                        @if($user->is_active)
                            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-700">{{ __('ui.admin.user_active') }}</span>
                        @else
                            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-600">{{ __('ui.admin.user_suspended') }}</span>
                        @endif
                    </td>
                    <td class="px-4 py-3 text-right">
                        <form action="{{ route('admin.users.update', $user) }}" method="POST">
                            @csrf @method('PUT')
                            <input type="hidden" name="role" value="{{ $user->role }}">
                            <input type="hidden" name="department" value="{{ $user->department }}">
                            <input type="hidden" name="student_id" value="{{ $user->student_id }}">
                            <input type="hidden" name="is_active" value="{{ $user->is_active ? '0' : '1' }}">
                            <button class="text-xs {{ $user->is_active ? 'text-red-500 hover:text-red-700' : 'text-green-600 hover:text-green-800' }}">
                                {{ $user->is_active ? __('ui.admin.suspend_btn') : __('ui.admin.activate_btn') }}
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="mt-4">{{ $users->links() }}</div>
</x-layout>
