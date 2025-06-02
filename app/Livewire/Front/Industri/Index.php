<?php

namespace App\Livewire\Front\Industri;

use App\Models\Industri;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;

class Index extends Component
{
    public $nama, $bidangUsaha, $alamat, $kontak, $email, $website;
    public $isOpen = 0;
    public $editingId = null;

    use WithPagination;

    public $rowPerPage = 10;
    public $search;

    public function render()
    {
        return view('livewire.front.industri.index', [
            'industris' => $this->search === NULL ?
                        Industri::latest()
                            ->paginate($this->rowPerPage) :
                        Industri::where('nama', 'like', '%' . $this->search . '%')
                            ->orWhere('bidang_usaha', 'like', '%' . $this->search . '%')
                            ->orWhere('alamat', 'like', '%' . $this->search . '%')
                            ->orWhere('email', 'like', '%' . $this->search . '%')
                            ->latest()
                            ->paginate($this->rowPerPage),
        ]);
    }

    public function create()
    {
        $this->resetInputFields();
        $this->editingId = null;
        $this->openModal();
    }

    public function edit($id)
    {
        $industri = Industri::find($id);
        $this->editingId = $id;
        $this->nama = $industri->nama;
        $this->bidangUsaha = $industri->bidang_usaha;
        $this->alamat = $industri->alamat;
        $this->kontak = $industri->kontak;
        $this->email = $industri->email;
        $this->website = $industri->website;
        $this->openModal();
    }
    
    public function openModal()
    {
        $this->isOpen = true;
    }

    public function closeModal()
    {
        $this->isOpen = false;
        $this->resetInputFields();
    }

    private function resetInputFields()
    {
        $this->nama = '';
        $this->bidangUsaha = '';
        $this->alamat = '';
        $this->kontak = '';
        $this->email = '';
        $this->website = '';
        $this->editingId = null;
    }

    public function store()
    {
        $this->validate([
            'nama' => 'required|string|max:255',
            'bidangUsaha' => 'required|string|max:255',
            'alamat' => 'required|string',
            'kontak' => 'required|string|max:255',
            'email' => 'required|email|max:255' . ($this->editingId ? '|unique:industris,email,' . $this->editingId : '|unique:industris,email'),
            'website' => 'required|string|max:255',
        ]);
        
        DB::beginTransaction();
        
        try {
            if ($this->editingId) {
                // Update existing record
                $industri = Industri::find($this->editingId);
                $industri->update([
                    'nama' => $this->nama,
                    'bidang_usaha' => $this->bidangUsaha,
                    'alamat' => $this->alamat,
                    'kontak' => $this->kontak,
                    'email' => $this->email,
                    'website' => $this->website,
                ]);
                
                $message = 'Data industri berhasil diperbarui!';
            } else {
                // Create new record
                Industri::create([
                    'nama' => $this->nama,
                    'bidang_usaha' => $this->bidangUsaha,
                    'alamat' => $this->alamat,
                    'kontak' => $this->kontak,
                    'email' => $this->email,
                    'website' => $this->website,
                ]);
                
                $message = 'Data industri berhasil disimpan!';
            }

            DB::commit();
            
            $this->closeModal();
            $this->resetInputFields();
            session()->flash('success', $message);

        } catch (\Exception $e) {
            DB::rollBack();
            $this->closeModal();
            session()->flash('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function delete($id)
    {
        try {
            $industri = Industri::find($id);
            if($industri) {
                // Check if industri is being used in PKL
                if($industri->pkls()->count() > 0) {
                    session()->flash('error', 'Industri tidak dapat dihapus karena masih digunakan dalam data PKL!');
                    return;
                }
                
                $industri->delete();
                session()->flash('success', 'Data industri berhasil dihapus!');
            }
        } catch (\Exception $e) {
            session()->flash('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}