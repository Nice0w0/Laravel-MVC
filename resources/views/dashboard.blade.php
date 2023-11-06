<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                <form id="submitProduct">
                    @csrf
                    <div class="px-4 py-5 bg-white dark:bg-gray-800 sm:p-6 shadow sm:rounded-tl-md sm:rounded-tr-md">
                        <div class="grid grid-cols-4 gap-6">
                            <div class="col-span-6 sm:col-span-4">
                                <input id="sdfsd" name="id" class="hidden">
                                <label class="block font-medium text-sm text-gray-700 dark:text-gray-300"
                                    for="name">
                                    Product Name
                                </label>
                                <input
                                    class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm mt-1 block w-full"
                                    id="name" type="text" required="required" autocomplete="name"
                                    name="name" oninput="textinput(this)">
                            </div>
                            <div class="col-span-6 sm:col-span-4">
                                <label class="block font-medium text-sm text-gray-700 dark:text-gray-300"
                                    for="price">
                                    Product Price
                                </label>
                                <input
                                    class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm mt-1 block w-full"
                                    id="price" type="text" required="required" autocomplete="username"
                                    oninput="decimalFormatter(this)" name="price">
                            </div>
                            <div class="col-span-6 sm:col-span-4">
                                <label class="block font-medium text-sm text-gray-700 dark:text-gray-300"
                                    for="unit">
                                    Product Unit
                                </label>
                                <input
                                    class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm mt-1 block w-full"
                                    id="unit" type="text" required="required" autocomplete="username"
                                    name="unit" oninput="textinput(this)">
                            </div>
                            <div class="col-span-6 sm:col-span-4">
                                <label class="block font-medium text-sm text-gray-700 dark:text-gray-300"
                                    for="countries">
                                    Product Status
                                </label>
                                <select id="status" name="status"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option value="active" selected>active</option>
                                    <option value="inactive">inactive</option>
                                </select>
                            </div>



                        </div>
                    </div>
                    <div
                        class="flex items-center justify-end px-4 py-3 bg-gray-50 dark:bg-gray-800 text-end sm:px-6 shadow sm:rounded-bl-md sm:rounded-br-md">
                        <button type="submit"
                            class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                            Save
                        </button>
                    </div>
                </form>
                <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    #
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Product name
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Product Price
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Product unit
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Status
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Action
                                </th>
                            </tr>
                        </thead>
                        <tbody id="product_list">

                        </tbody>

                </div>


            </div>
        </div>
    </div>
    <script>
        var products = @json($products);

        var act = "add";


        $(function() {
            displayProducts(products);
            $("form#submitProduct").submit(function(e) {
               
                e.preventDefault();
                let form = new FormData(this);
                ajax(form, act == "add" ? "{{ url('/create') }}" : "{{ url('/edit') }}").then(function(res) {
                    products = res['products'];
                    displayProducts(products);
                    act = "add";
                    clearForm();
                }).catch(function(error) {
                    Swal.fire(
                        'เกิดข้อผิดพลาด',
                        'ทาง Server',
                        'error'
                    )
                })
            })
        })

        function ajax(form, url) {
            return new Promise((resolve, reject) => {
                $.ajax({
                    method: "POST",
                    url: url,
                    data: form,
                    async: false,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function(res) {
                        resolve(res);
                    },
                    error: function(xhr, status, error) {
                        reject(error);
                    }
                })
            })
        }

        function edit(id) {
            act = "edit";
            let find = products.find(item => item.id == id);
            $("#sdfsd").val(id);
            $("#name").val(find.name);
            $("#price").val(find.price);
            $("#unit").val(find.unit);
            $("#status").val(find.status).change();
        }

        function clearForm(){
            $("#sdfsd").val("");
            $("#name").val("");
            $("#price").val("");
            $("#unit").val("");
            $("#status").val("active").change();
        }

        function del(id) {
            $.post("{{ url('/del') }}", {
                id: id,
                _token: "{{ csrf_token() }}"
            }, function(res) {
                products = res['products'];
                displayProducts(products)
            }).fail(function(error) {

            })
        }

        function displayProducts(products) {
            $("#product_list").empty();
            products.forEach(product => {
                let status = (product.status === 'active') ? 'เปิดใช้งานอยู่' : 'ปิดใช้งานอยู่';

                let productRow = `
            <tr>
                <th scope="row" class="px-6 py-4 font-medium text-color_black">${product.id}</th>
                <th scope="row" class="px-6 py-4 font-medium text-color_black">${product.name}</th>
                <td class="px-6 py-4 text-color_black">${product.price}</td>
                <td class="px-6 py-4 text-color_black">${product.unit}</td>
                <td class="px-6 py-4 text-color_black">${status}</td>
                <td class="px-6 py-4 text-color_black">
                    <a href="#" class="">
                        <span class="mx-2 text-blue-600" onclick="edit('${product.id}')">
                            <i class="fa-solid fa-pen-to-square "></i>Edit
                        </span>
                        <span class="mx-2 text-red-700" onclick="del('${product.id}')">
                            <i class="fa-solid fa-trash "></i>Delete
                        </span>
                    </a>
                </td>
            </tr>
        `;
                $("#product_list").append(productRow);
            });
        }

        function decimalFormatter(input) {
            input.value = input.value.replace(/[^0-9]/g, '');
            if (input.value.length > 14) {
                input.value = input.value.substring(0, 13);
            }

        }
        function textinput(input) {
            if (input.value.length > 50) {
                input.value = input.value.substring(0, 49);
            }

        }
    </script>
</x-app-layout>
