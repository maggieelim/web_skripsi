@if(!empty($previewData))

<div class="modal fade" id="previewModal" tabindex="-1">

    <div class="modal-dialog modal-xl modal-dialog-scrollable">

        <div class="modal-content">

            <div class="modal-header">

                <h5 class="modal-title">
                    Preview Import Tugas Akhir
                </h5>

                <button type="button" class="btn-close" data-bs-dismiss="modal">
                </button>

            </div>

            <div class="modal-body">

                <div class="table-responsive p-0">

                    <table class="table align-items-center mb-0">

                        <thead>

                            <tr>

                                <th class="text-center">No</th>
                                <th class="text-center">NIM</th>
                                <th class="text-center">TA</th>
                                <th class="text-center">Manuskrip</th>
                                <th class="text-center">Video</th>
                                <th class="text-center">Ketua Sidang</th>
                                <th class="text-center">Pembimbing</th>
                                <th class="text-center">Penguji</th>
                                <th class="text-center">Status</th>

                            </tr>

                        </thead>

                        <tbody>

                            @foreach ($previewData as $item)
                            <tr>

                                <td class="text-center">
                                    {{ $loop->iteration }}
                                </td>

                                {{-- NIM --}}
                                <td class="text-center">
                                    {{ $item['nim'] }}
                                </td>

                                {{-- TA --}}
                                <td class="text-center">

                                    @if ($item['thesis_file'])
                                    <a href="{{ $item['thesis_file'] }}" target="_blank">

                                        Link

                                    </a>
                                    @else
                                    -
                                    @endif

                                </td>

                                {{-- MANUSKRIP --}}
                                <td class="text-center">

                                    @if ($item['manuscript_file'])
                                    <a href="{{ $item['manuscript_file'] }}" target="_blank">

                                        Link

                                    </a>
                                    @else
                                    -
                                    @endif

                                </td>

                                {{-- VIDEO --}}
                                <td class="text-center">

                                    @if ($item['presentation_video'])
                                    <a href="{{ $item['presentation_video'] }}" target="_blank">

                                        Link

                                    </a>
                                    @else
                                    -
                                    @endif

                                </td>

                                {{-- KETUA --}}
                                <td class="text-center">

                                    {{ $item['ketua']?->user?->name ?? '-' }}

                                </td>

                                {{-- DOSPEM --}}
                                <td class="text-center">

                                    {{ $item['dospem']?->user?->name ?? '-' }}

                                </td>

                                {{-- PENGUJI --}}
                                <td class="text-center">

                                    {{ $item['penguji']?->user?->name ?? '-' }}

                                </td>

                                {{-- STATUS --}}
                                <td class="text-center">

                                    @if (count($item['errors']) > 0)
                                    <div class="text-danger small">

                                        @foreach ($item['errors'] as $error)
                                        <div>
                                            • {{ $error }}
                                        </div>
                                        @endforeach

                                    </div>
                                    @else
                                    <span class="badge bg-success">
                                        Valid
                                    </span>
                                    @endif

                                </td>

                            </tr>
                            @endforeach

                        </tbody>

                    </table>

                </div>

            </div>

            <div class="modal-footer">

                @php
                $hasError = collect($previewData)->contains(fn($item) => count($item['errors']) > 0);
                @endphp

                <button type="button" class="btn btn-light" data-bs-dismiss="modal">

                    Close

                </button>

                @if (!$hasError)
                <form action="{{ route('admin.thesis.import.store') }}" method="POST">

                    @csrf

                    <button type="submit" class="btn bg-gradient-success">

                        Import

                    </button>

                </form>
                @endif

            </div>

        </div>

    </div>

</div>
<script>
    document.addEventListener('DOMContentLoaded', function () {

        const importModalEl = document.getElementById('importModal');

        if (importModalEl) {

            const importModal = bootstrap.Modal.getInstance(importModalEl);

            if (importModal) {
                importModal.hide();
            }
        }

        const previewEl = document.getElementById('previewModal');

        const previewModal = new bootstrap.Modal(previewEl);

        previewModal.show();

    });
</script>

@endif