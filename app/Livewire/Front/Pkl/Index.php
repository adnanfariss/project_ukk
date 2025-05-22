<?php

namespace App\Livewire\Front\Pkl;

use Livewire\Component;
use App\Models\Siswa;
use App\Models\Industri;
use App\Models\Guru;
use App\Models\Pkl;
use Illuminate\Support\Facades\Auth;

class Index extends Component
{
public $siswa;
    public $industri_id;
    public $bidang_usaha;
    public $guru_id;
    public $mulai_pkl;
    public $akhir_pkl;

    public $industris;
    public $gurus;

    public function mount()
    {
        // Ambil data siswa berdasarkan email user yang login
        $this->siswa = Siswa::where('email', Auth::user()->email)->first();

        // Cek apakah sudah ada laporan PKL
        if ($this->siswa && $this->siswa->pkls->count() > 0) {
            session()->flash('info', 'Anda sudah pernah mengisi data PKL.');
        }

        // Load dropdown
        $this->industris = Industri::all();
        $this->gurus = Guru::all();
    }

    protected $rules = [
        'industri_id' => 'required|exists:industris,id',
        'bidang_usaha' => 'required|string|max:255',
        'guru_id' => 'required|exists:gurus,id',
        'mulai_pkl' => 'required|date',
        'akhir_pkl' => 'required|date|after_or_equal:mulai_pkl',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function hitungDurasi()
    {
        if ($this->mulai_pkl && $this->akhir_pkl) {
            $start = \Carbon\Carbon::parse($this->mulai_pkl);
            $end = \Carbon\Carbon::parse($this->akhir_pkl);
            return $start->diffInDays($end) + 1;
        }
        return 0;
    }

    public function simpan()
    {
        $this->validate();

        if ($this->siswa->pkls->count() === 0) {
            Pkl::create([
                'siswa_id' => $this->siswa->id,
                'industri_id' => $this->industri_id,
                'bidang_usaha' => $this->bidang_usaha,
                'guru_id' => $this->guru_id,
                'mulai_pkl' => $this->mulai_pkl,
                'akhir_pkl' => $this->akhir_pkl,
            ]);

            // Update status_lapor_pkl ke true
            $this->siswa->update(['status_lapor_pkl' => true]);

            session()->flash('success', 'Data PKL berhasil disimpan!');
        } else {
            session()->flash('error', 'Data PKL sudah ada dan tidak bisa diubah.');
        }
    }

    public function render()
    {
        return view('livewire.front.pkl.index', [
            'durasi' => $this->hitungDurasi(),
        ]);
    }
}