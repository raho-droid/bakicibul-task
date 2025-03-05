<x-app-layout>
    <div class=" mx-auto bg-white p-6 rounded-lg shadow-md">
        <h2 class="text-2xl font-semibold mb-4">Görevi Düzenle</h2>

        @if ($errors->any())
            <div class="mb-4 p-4 bg-red-100 text-red-600 rounded-lg">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('tasks.update', $task->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="block text-gray-700 font-semibold">Başlık:</label>
                <input type="text" name="title" class="w-full p-2 border rounded-md" value="{{ $task->title }}" required>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-semibold">Açıklama:</label>
                <textarea name="description" class="w-full p-2 border rounded-md" required>{{ $task->description }}</textarea>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-semibold">Kullanıcı Seç:</label>
                <select name="user_id" class="w-full p-2 border rounded-md">
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}" @if($task->user_id == $user->id) selected @endif>
                            {{ $user->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-semibold">Durum:</label>
                <select name="status" class="w-full p-2 border rounded-md">
                    <option value="0" @if($task->status == 0) selected @endif>Aktif</option>
                    <option value="1" @if($task->status == 1) selected @endif>Tamamlandı</option>
                </select>
            </div>

            <button type="submit" class="px-4 py-2 bg-green-500 text-white rounded-md hover:bg-green-600">
                Kaydet
            </button>
        </form>
    </div>
</x-app-layout>
