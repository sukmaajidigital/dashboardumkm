@props([
    'tablename' => '',
    'barisdata' => 5,
    // filter 1
    'hiddenfilter1' => true,
    'filter1array' => [],
    'filter1collumn' => '',
    'filter1name' => '',
    'filter1colnumber' => '',
    // filter 2
    'hiddenfilter2' => true,
    'filter2array' => [],
    'filter2collumn' => '',
    'filter2name' => '',
    'filter2colnumber' => '',
])

<div id="datatable-filter" class="bg-base-100 flex flex-col rounded-md">
    <div class="border-base-content/25 flex items-center border-b px-5 py-3 gap-3">
        <div class="input-group max-w-[15rem]">
            <span class="input-group-text">
                <span class="icon-[tabler--search] text-base-content size-4"></span>
            </span>
            <input type="search" class="input input-sm grow" id="filter-search" placeholder="Search for items" />
        </div>
        <div class="flex flex-1 items-center justify-end gap-3">
            <select id="select-paginate" class="input input-sm advance-select-sm w-12 justify-between content-center">
                <option value="{{ $barisdata }}">{{ $barisdata }}</option>
                <option value="10">10</option>
                <option value="20">20</option>
                <option value="50">50</option>
                <option value="100">100</option>
            </select>
            <label for="select-filter1" class="{{ $hiddenfilter1 ? 'hidden' : '' }}">{{ $filter1name }}</label>
            <select id="select-filter1" class="input input-sm advance-select-sm w-36 justify-between {{ $hiddenfilter1 ? 'hidden' : '' }}">
                <option value="">All</option>
                @foreach ($filter1array as $filter)
                    <option value="{{ $filter->{$filter1collumn} }}">{{ $filter->{$filter1collumn} }}</option>
                @endforeach
            </select>
            <label for="select-filter2" class="{{ $hiddenfilter2 ? 'hidden' : '' }}">{{ $filter2name }}</label>
            <select id="select-filter2" class="input input-sm advance-select-sm w-36 justify-between {{ $hiddenfilter2 ? 'hidden' : '' }}">
                <option value="">All</option>
                @foreach ($filter2array as $filter)
                    <option value="{{ $filter->{$filter2collumn} }}">{{ $filter->{$filter2collumn} }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="horizontal-scrollbar overflow-x-auto">
        <table id="datatable-{{ $tablename }}" class="table min-w-full">
            {{ $slot }}
        </table>
    </div>
</div>

@push('componentscript')
    <script>
        $(document).ready(function() {
            var table = $('#datatable-{{ $tablename }}').DataTable({
                language: {
                    "search": "",
                    "infoEmpty": "Tidak ada data",
                    "sEmptyTable": "Tidak ada data",
                    "sInfoFiltered": "(Difilter dari _MAX_ total data)"
                },
                responsive: false,
                autoWidth: true,
                scrollY: false,
                scrollX: false,
                searching: true,
                lengthChange: false,
                pageLength: {{ $barisdata }},
            });
            $('#filter-search').on('keyup', function() {
                table.search(this.value).draw();
            });
            $('#select-filter1').on('change', function() {
                table.column({{ $filter1colnumber }}).search(this.value).draw();
            });
            $('#select-filter2').on('change', function() {
                table.column({{ $filter2colnumber }}).search(this.value).draw();
            });
            $('#select-paginate').on('change', function() {
                table.page.len(this.value).draw();
            });
            $('#select-all').on('click', function() {
                $('.row-checkbox').prop('checked', this.checked);
            });
        });
    </script>
@endpush
