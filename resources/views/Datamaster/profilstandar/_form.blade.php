@php
    // untuk edit: $profil ada. untuk create: bisa null
    $selectedKriteria = old('kriteria_id', $profil['kriteria_id'] ?? '');
    $selectedSub      = old('sub_id', $profil['sub_id'] ?? '');
    $nilaiSelected    = old('nilai', $profil['nilai'] ?? '');
@endphp

<div class="mb-3">
    <label class="form-label">Kriteria</label>
    <select id="kriteria_id" name="kriteria_id" class="form-control" required>
        <option value="">-- pilih kriteria --</option>
        @foreach($kriteria as $k)
            <option value="{{ $k['id_kriteria'] }}" {{ (string)$selectedKriteria === (string)$k['id_kriteria'] ? 'selected' : '' }}>
                {{ $k['nama_kriteria'] }}
            </option>
        @endforeach
    </select>
    @error('kriteria_id') <small class="text-danger">{{ $message }}</small> @enderror
</div>

<div class="mb-3">
    <label class="form-label">Sub Kriteria yg Dipilih</label>
    <select id="sub_id" name="sub_id" class="form-control" required>
        <option value="">-- pilih sub kriteria --</option>
        {{-- option akan diisi via JS (AJAX) --}}
    </select>
    @error('sub_id') <small class="text-danger">{{ $message }}</small> @enderror
</div>

<div class="mb-3">
    <label class="form-label">Nilai Profil Standar yg Dipilih</label>
    <input id="nilai" name="nilai" class="form-control" value="{{ $nilaiSelected }}" readonly>
</div>

<script>
(function() {
    const kriteriaEl = document.getElementById('kriteria_id');
    const subEl = document.getElementById('sub_id');
    const nilaiEl = document.getElementById('nilai');

    const selectedSub = @json((string)$selectedSub);

    async function loadSubkriteria(kriteriaId) {
        subEl.innerHTML = `<option value="">-- pilih sub kriteria --</option>`;
        nilaiEl.value = '';

        if (!kriteriaId) return;

        const res = await fetch(`{{ route('profil-standar.sub-by-kriteria') }}?kriteria_id=${kriteriaId}`);
        const data = await res.json();

        data.forEach(item => {
            const opt = document.createElement('option');
            opt.value = item.id_sub;
            opt.textContent = item.nama_sub_kriteria;
            opt.dataset.nilai = item.nilai;
            subEl.appendChild(opt);
        });

        // kalau mode edit, set pilihan sub yang lama
        if (selectedSub) {
            subEl.value = selectedSub;
            const chosen = subEl.options[subEl.selectedIndex];
            if (chosen && chosen.dataset.nilai) nilaiEl.value = chosen.dataset.nilai;
        }
    }

    kriteriaEl.addEventListener('change', () => {
        loadSubkriteria(kriteriaEl.value);
    });

    subEl.addEventListener('change', () => {
        const opt = subEl.options[subEl.selectedIndex];
        nilaiEl.value = (opt && opt.dataset.nilai) ? opt.dataset.nilai : '';
    });

    // initial load (create/edit)
    const initialKriteria = kriteriaEl.value;
    if (initialKriteria) {
        loadSubkriteria(initialKriteria);
    }
})();
</script>
