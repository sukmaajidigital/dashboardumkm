<x-layouts>
    <div class="card-header">
        <x-modal.buttoncreatemodal title="Tambah Data" routes="{{ route('downpayment.create') }}" />
        <x-modal.createmodal title="Tambah Data" routes="{{ route('downpayment.store') }}" />
        <x-modal.editmodal title="Edit Data" />
    </div>
    <div class="card-body">
        <x-table.datatable barisdata="20" hiddenfilter1=" " hiddenfilter2=" ">
            <thead>
                <tr>
                    {{-- <th><input type="checkbox" id="select-all" class="checkbox checkbox-sm"></th> --}}
                    <th>Id</th>
                    <th>Nama Kategori</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($downpayments as $downpayment)
                    <tr>
                        {{-- <td><input type="checkbox" class="row-checkbox checkbox checkbox-sm"></td> --}}
                        <td>{{ $downpayment->id }}</td>
                        <td>{{ $downpayment->nama_kategori }}</td>
                        <td>
                            <div class=" flex items-center gap-3">
                                <x-modal.buttoneditmodal title="" routes="{{ route('downpayment.edit', $downpayment->id) }}" />
                                <x-button.deletebutton title="" routes="{{ route('downpayment.destroy', $downpayment->id) }}" confirmationMessage="data ini tidak dapat dikembalikan lagi" />
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </x-table.datatable>
    </div>
    @push('script')
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                const penjualanSelect = document.getElementById("penjualan_id");
                const pemesananSelect = document.getElementById("pemesanan_id");
                const pemesananForm = document.getElementById("pemesanan_id").closest(".form-group") || document.getElementById("pemesanan_id").parentElement;
                const penjualanForm = document.getElementById("penjualan_id").closest(".form-group") || document.getElementById("penjualan_id").parentElement;
                const nominalInput = document.getElementById("nominal");

                function toggleForms() {
                    if (penjualanSelect.value) {
                        pemesananForm.style.display = "none";
                        pemesananSelect.value = "";
                    } else {
                        pemesananForm.style.display = "block";
                    }

                    if (pemesananSelect.value) {
                        penjualanForm.style.display = "none";
                        penjualanSelect.value = "";
                    } else {
                        penjualanForm.style.display = "block";
                    }
                }

                function updateTotalNominal() {
                    let selectedInvoice = penjualanSelect.value || pemesananSelect.value;
                    if (selectedInvoice) {
                        fetch(`/get-invoice-total/${selectedInvoice}`)
                            .then(response => response.json())
                            .then(data => {
                                nominalInput.value = data.total;
                            })
                            .catch(error => console.error("Error fetching invoice total:", error));
                    } else {
                        nominalInput.value = "";
                    }
                }

                penjualanSelect.addEventListener("change", function() {
                    toggleForms();
                    updateTotalNominal();
                });
                pemesananSelect.addEventListener("change", function() {
                    toggleForms();
                    updateTotalNominal();
                });

                // Initial check in case of pre-filled data
                toggleForms();
                updateTotalNominal();
            });
        </script>
    @endpush
</x-layouts>
