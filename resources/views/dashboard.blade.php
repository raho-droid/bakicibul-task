<x-app-layout>
    <div class=" mx-auto bg-white p-6 rounded-lg shadow-md">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-2xl font-semibold">Görev Listesi</h2>
            <a href="{{ route('tasks.create') }}" class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600">
                + Görev Ekle
            </a>
        </div>

        <table class="w-full border-collapse border border-gray-300">
            <thead>
                <tr class="bg-gray-200">
                    <th class="border p-2">Başlık</th>
                    <th class="border p-2">Kullanıcı</th>
                    <th class="border p-2">Açıklama</th>
                    <th class="border p-2">Durum</th>
                    <th class="border p-2">İşlemler</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tasks as $task)
                    <tr class="text-center bg-white hover:bg-gray-100 transition">
                        <td class="border p-2">{{ $task->title }}</td>
                        <td class="border p-2">{{ $task->user->name }}</td>
                        <td class="border p-2">{{ $task->description }}</td>
                        <td class="border p-2">
                            @if ($task->status == 0)
                                <span class="px-3 py-1 bg-yellow-500 text-white rounded-full">Aktif</span>
                            @elseif ($task->status == 1)
                                <span class="px-3 py-1 bg-green-500 text-white rounded-full">Tamamlandı</span>
                            @else
                                <span class="px-3 py-1 bg-gray-500 text-white rounded-full">Bilinmiyor</span>
                            @endif
                        </td>
                        <td class="border p-2 flex justify-center gap-2">
                            <a href="{{ route('tasks.edit', $task->id) }}" class="px-3 py-1 bg-blue-500 text-white rounded-md hover:bg-blue-600">
                                Düzenle
                            </a>
                            @if($task->status == 0)
                            <form action="{{ route('tasks.complete', $task->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="px-3 py-1 bg-green-500 text-white rounded-md hover:bg-green-600">
                                    Tamamla
                                </button>
                            </form>
                        @endif
                            <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" onsubmit="return confirm('Bu görevi silmek istediğinizden emin misiniz?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="px-3 py-1 bg-red-500 text-white rounded-md hover:bg-red-600">
                                    Sil
                                </button>
                            </form>
                     
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>
