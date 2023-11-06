{{-- <tbody>
    @foreach ($products as $product)
        <tr>
            <th scope="row" class="px-6 py-4 font-medium text-color_black">
                {{ $product->id }}
            </th>
            <th scope="row" class="px-6 py-4 font-medium text-color_black">
                {{ $product->name }}
            </th>
            <td class="px-6 py-4 text-color_black">
                {{ $product->price }}
            </td>
            <td class="px-6 py-4 text-color_black">
                {{ $product->unit }}
            </td>
            <td class="px-6 py-4 text-color_black">
                @if ($product->status === 'active')
                    เปิดใช้งานอยู่
                @else
                    ปิดใช้งานอยู่
                @endif
            </td>
            <td class="px-6 py-4 text-color_black">
                <a href="#" class="">
                    <span class="mx-2 text-blue-600" onclick="edit('{{ $product->id }}')"><i
                            class="fa-solid fa-pen-to-square "></i>Edit</span>
                    <span class="mx-2 text-red-700" onclick="del('{{ $product->id }}')"><i
                            class="fa-solid fa-trash "></i>Delete</span>
                </a>
            </td>
        </tr>
    @endforeach
</tbody> --}}
