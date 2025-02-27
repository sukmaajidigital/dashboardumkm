<x-layouts>
    <x-slot name="header">

        Sample Data
    </x-slot>
    <div class="bg-base-100 flex flex-col rounded-md shadow" data-datatable='{
  "pageLength": 5,
  "pagingOptions": {
    "pageBtnClasses": "btn btn-text btn-circle btn-sm"
  },
  "selecting": true,
  "rowSelectingOptions": {
    "selectAllSelector": "#table-search-all"
  },
  "language": {
      "zeroRecords": "<div class=\"py-10 px-5 flex flex-col justify-center items-center text-center\"><span class=\"icon-[tabler--search] shrink-0 size-6 text-base-content\"></span><div class=\"max-w-sm mx-auto\"><p class=\"mt-2 text-sm text-base-content/80\">No search results</p></div></div>"
    }
}'>
        <div class="py-3 ps-5 border-b border-base-content/25">
            <div class="input-group max-w-[15rem]">
                <span class="input-group-text">
                    <span class="icon-[tabler--search] shrink-0 size-4 text-base-content"></span>
                </span>
                <label class="sr-only" for="table-input-search"></label>
                <input type="search" class="input input-sm grow" id="table-input-search" placeholder="Search for items" data-datatable-search="" />
            </div>
        </div>
        <div class="horizontal-scrollbar overflow-x-auto">
            <div class="inline-block min-w-full align-middle">
                <div class="overflow-hidden">
                    <table class="table min-w-full">
                        <thead>
                            <tr>
                                <th scope="col" class="--exclude-from-ordering w-3.5 pe-0">
                                    <div class="flex h-5 items-center">
                                        <input id="table-search-all" type="checkbox" class="checkbox checkbox-sm" />
                                        <label for="table-search-all" class="sr-only">Checkbox</label>
                                    </div>
                                </th>
                                <th scope="col" class="group w-fit">
                                    <div class="flex items-center justify-between">
                                        Product Name
                                        <span class="icon-[tabler--chevron-up] datatable-ordering-asc:block hidden"></span>
                                        <span class="icon-[tabler--chevron-down] datatable-ordering-desc:block hidden"></span>
                                    </div>
                                </th>
                                <th scope="col" class="group w-fit">
                                    <div class="flex items-center justify-between">
                                        Price
                                        <span class="icon-[tabler--chevron-up] datatable-ordering-asc:block hidden"></span>
                                        <span class="icon-[tabler--chevron-down] datatable-ordering-desc:block hidden"></span>
                                    </div>
                                </th>
                                <th scope="col" class="group w-fit">
                                    <div class="flex items-center justify-between">
                                        Availability
                                        <span class="icon-[tabler--chevron-up] datatable-ordering-asc:block hidden"></span>
                                        <span class="icon-[tabler--chevron-down] datatable-ordering-desc:block hidden"></span>
                                    </div>
                                </th>
                                <th scope="col" class="--exclude-from-ordering">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @for ($i = 0; $i < 10; $i++)
                                <tr>
                                    <td class="w-3.5 pe-0">
                                        <div class="flex h-5 items-center">
                                            <input id="table-search-14" type="checkbox" class="checkbox checkbox-sm" data-datatable-row-selecting-individual="" />
                                            <label for="table-search-14" class="sr-only">Checkbox</label>
                                        </div>
                                    </td>
                                    <td class="text-nowrap">NVIDIA GeForce RTX 4090</td>
                                    <td>$1,599</td>
                                    <td><span class="badge badge-soft badge-warning badge-sm">Limited</span></td>
                                    <td>
                                        <button class="btn btn-circle btn-text btn-sm" aria-label="Action button">
                                            <span class="icon-[tabler--pencil] size-5"></span>
                                        </button>
                                        <button class="btn btn-circle btn-text btn-sm" aria-label="Action button">
                                            <span class="icon-[tabler--trash] size-5"></span>
                                        </button>
                                        <button class="btn btn-circle btn-text btn-sm" aria-label="Action button">
                                            <span class="icon-[tabler--dots-vertical] size-5"></span>
                                        </button>
                                    </td>
                                </tr>
                            @endfor

                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="border-base-content/25 flex items-center justify-between gap-3 border-t p-3 max-md:flex-wrap max-md:justify-center">
            <div class="text-base-content/80 text-sm" data-datatable-info="">
                Showing
                <span data-datatable-info-from="1"></span>
                to
                <span data-datatable-info-to="30"></span>
                of
                <span data-datatable-info-length="50"></span>
                products
            </div>
            <div class="flex hidden items-center space-x-1" data-datatable-paging="">
                <button type="button" class="btn btn-text btn-circle btn-sm" data-datatable-paging-prev="">
                    <span aria-hidden="true">«</span>
                    <span class="sr-only">Previous</span>
                </button>
                <div class="[&>.active]:text-bg-soft-primary flex items-center space-x-1" data-datatable-paging-pages=""></div>
                <button type="button" class="btn btn-text btn-circle btn-sm" data-datatable-paging-next="">
                    <span class="sr-only">Next</span>
                    <span aria-hidden="true">»</span>
                </button>
            </div>
        </div>
    </div>
    @push('script')
        <script>
            window.addEventListener('load', () => {
                ...

                const inputs = document.querySelectorAll('.dt-container thead input');

                inputs.forEach((input) => {
                    input.addEventListener('keydown', function(evt) {
                        if ((evt.metaKey || evt.ctrlKey) && evt.key === 'a') this.select();
                    });
                });
            });
        </script>
    @endpush
</x-layouts>
