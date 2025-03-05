<x-app-layout>
    <div class=" mx-auto bg-white p-6 rounded-lg shadow-md">
        <h2 class="text-2xl font-semibold mb-4">Yeni Görev Ekle</h2>

        @if ($errors->any())
            <div class="mb-4 p-4 bg-red-100 text-red-600 rounded-lg">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('tasks.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label class="block text-gray-700 font-semibold">Başlık:</label>
                <input type="text" name="title" class="w-full p-2 border rounded-md" required>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-semibold">Açıklama:</label>
                <textarea name="description" class="w-full p-2 border rounded-md" required></textarea>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-semibold">Kullanıcı Seç:</label>
                <select name="user_id" class="w-full p-2 border rounded-md">
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>

       
<div class="flex justify-end">   <button type="submit" class="px-4 py-2 bg-green-500 text-white rounded-md hover:bg-green-600">
    Görevi Kaydet
</button></div>
         
        </form>
    </div>
</x-app-layout>
