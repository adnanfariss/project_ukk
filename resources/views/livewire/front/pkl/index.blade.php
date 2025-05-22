<div class="container mt-5">
    <h2 class="mb-4">Form Pengisian Data PKL</h2>

    @if(session()->has('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(session()->has('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    @if(session()->has('info'))
        <div class="alert alert-info">{{ session('info') }}</div>
    @endif

    <form wire:submit.prevent="simpan">
        <div class="mb-3">
            <label>Nama Siswa</label>
            <input type="text" class="form-control" value="{{ $siswa?->nama }}" disabled>
        </div>

        <div class="mb-3">
            <label>Industri</label>
            <select wire:model="industri_id" class="form-control">
                <option value="">-- Pilih Industri --</option>
                @foreach($industris as $industri)
                    <option value="{{ $industri->id }}">{{ $industri->nama }}</option>
                @endforeach
            </select>
            @error('industri_id') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="mb-3">
            <label>Bidang Usaha</label>
            <input type="text" wire:model="bidang_usaha" class="form-control">
            @error('bidang_usaha') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="mb-3">
            <label>Guru Pembimbing</label>
            <select wire:model="guru_id" class="form-control">
                <option value="">-- Pilih Guru --</option>
                @foreach($gurus as $guru)
                    <option value="{{ $guru->id }}">{{ $guru->nama }}</option>
                @endforeach
            </select>
            @error('guru_id') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label>Mulai PKL</label>
                <input type="date" wire:model="mulai_pkl" class="form-control">
                @error('mulai_pkl') <span class="text-danger">{{ $message }}</span> @enderror
            </div>

            <div class="col-md-6 mb-3">
                <label>Akhir PKL</label>
                <input type="date" wire:model="akhir_pkl" class="form-control">
                @error('akhir_pkl') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="mb-3">
            <strong>Durasi PKL:</strong> {{ $durasi }} hari
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>