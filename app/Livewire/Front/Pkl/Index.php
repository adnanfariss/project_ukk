<?php

namespace App\Livewire\Front\Pkl;

use App\Models\Pkl;
use App\Models\Guru;
use App\Models\Siswa;
use Livewire\Component;
use App\Models\Industri;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;
use Livewire\Volt\Compilers\Mount;
use Illuminate\Support\Facades\Auth;

class Index extends Component
{
    public $siswaId, $industriId, $guruId, $bidangUsaha, $mulai, $selesai;
    public $isOpen = 0;

    use WithPagination;

    public $rowPerPage = 10;
    public $search;
    public $userMail;

    public function mount(){
        //membaca email user yang sedang login
        $this->userMail = Auth::user()->email;
        
        // Auto-fill siswa_id with logged-in user's siswa record
        $siswa_login = Siswa::where('email', '=', $this->userMail)->first();
        if($siswa_login) {
            $this->siswaId = $siswa_login->id;
        }
    }
    
    public function render()
    {
        return view('livewire.front.pkl.index',[
            'pkls' => $this->search === NULL ?
                        Pkl::with(['siswa', 'industri', 'guru'])
                            ->latest()
                            ->paginate($this->rowPerPage) :
                        Pkl::with(['siswa', 'industri', 'guru'])
                            ->latest()
                            ->whereHas('siswa', function ($query) {
                                $query->where('nama', 'like', '%' . $this->search . '%');
                            })
                            ->orWhereHas('industri', function ($query) {
                                $query->where('nama', 'like', '%' . $this->search . '%');
                            })
                            ->orWhere('bidang_usaha', 'like', '%' . $this->search . '%')
                            ->paginate($this->rowPerPage),
            
            //mengakses record siswa yang emailnya sama dengan user yang sedang login
            'siswa_login'=>Siswa::where('email','=',$this->userMail)->first(),
            
            'industris'=>Industri::all(),
            'gurus'=>Guru::all(),
        ]);
    }

    public function create()
    {
        $this->resetInputFields();
        $this->openModal();
    }
    
    public function openModal()
    {
        $this->isOpen = true;
    }

    public function closeModal()
    {
        $this->isOpen = false;
    }

    private function resetInputFields(){
        // Jangan reset siswaId karena sudah di-set dari user login
        $siswa_login = Siswa::where('email', '=', $this->userMail)->first();
        if($siswa_login) {
            $this->siswaId = $siswa_login->id;
        }
        
        $this->industriId   = '';
        $this->guruId       = '';
        $this->bidangUsaha  = '';
        $this->mulai        = '';
        $this->selesai      = '';
    }

    public function store()
    {
        $this->validate([
            'siswaId'       => 'required',
            'industriId'    => 'required',
            'guruId'        => 'required',
            'bidangUsaha'   => 'required|string|max:255',
            'mulai'         => 'required|date',
            'selesai'       => 'required|date|after:mulai',
        ]);
        
        DB::beginTransaction();
        
        try {
            $siswa = Siswa::find($this->siswaId);

            if ($siswa->status_lapor_pkl) {
                DB::rollBack();
                $this->closeModal();
                session()->flash('error', 'Transaksi dibatalkan: Siswa sudah melapor PKL.');
                return;
            }

            // Hitung lama hari PKL
            $mulai = \Carbon\Carbon::parse($this->mulai);
            $selesai = \Carbon\Carbon::parse($this->selesai);
            $lamaHari = $mulai->diffInDays($selesai) + 1; // +1 untuk include hari terakhir

            // Simpan data PKL
            Pkl::create([
                'siswa_id'      => $this->siswaId,
                'industri_id'   => $this->industriId,
                'guru_id'       => $this->guruId,
                'bidang_usaha'  => $this->bidangUsaha,
                'mulai'         => $this->mulai,
                'selesai'       => $this->selesai,
                'lama_hari'     => $lamaHari,
            ]);

            DB::commit();
            
            $this->closeModal();
            $this->resetInputFields();
            session()->flash('success', 'Data PKL berhasil disimpan!');

        } catch (\Exception $e) {
            DB::rollBack();
            $this->closeModal();
            session()->flash('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}