<?php

namespace App\Livewire\Front\Industri;

use App\Models\Industri;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class Index extends Component
{
    use WithPagination, WithFileUploads;

    public $nama, $image, $alamat, $kontak, $email, $website;
    public $isOpen = 0;
    public $editingId = null;
    public $oldImage = null; // Untuk menyimpan nama file gambar lama saat edit

    public $rowPerPage = 10;
    public $search;

    public function render()
    {
        return view('livewire.front.industri.index', [
            'industris' => $this->search === NULL ?
                        Industri::latest()
                            ->paginate($this->rowPerPage) :
                        Industri::where('nama', 'like', '%' . $this->search . '%')
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
        $this->oldImage = $industri->image;
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
        $this->image = null;
        $this->alamat = '';
        $this->kontak = '';
        $this->email = '';
        $this->website = '';
        $this->editingId = null;
        $this->oldImage = null;
    }

    public function store()
    {
        $validationRules = [
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string',
            'kontak' => 'required|string|max:255',
            'email' => 'required|email|max:255' . ($this->editingId ? '|unique:industris,email,' . $this->editingId : '|unique:industris,email'),
            'website' => 'required|string|max:255',
        ];

        $validationRules['image'] = $this->editingId ? 
            'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048' : 
            'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048';

        $this->validate($validationRules);

        DB::beginTransaction();

        try {
            $data = [
                'nama' => $this->nama,
                'alamat' => $this->alamat,
                'kontak' => $this->kontak,
                'email' => $this->email,
                'website' => $this->website,
            ];

            // Handle file upload
            if ($this->image) {
                // Hapus file lama jika ada
                if ($this->oldImage && Storage::disk('public')->exists('logo/' . $this->oldImage)) {
                    Storage::disk('public')->delete('logo/' . $this->oldImage);
                }

                // Simpan dengan nama asli
                $originalName = $this->image->getClientOriginalName();
                $this->image->storeAs('logo', $originalName, 'public');
                $data['image'] = $originalName;
            } elseif ($this->editingId && $this->oldImage) {
                // Pertahankan gambar lama jika tidak ada upload baru
                $data['image'] = $this->oldImage;
            }

            if ($this->editingId) {
                Industri::find($this->editingId)->update($data);
                $message = 'Data industri berhasil diperbarui!';
            } else {
                Industri::create($data);
                $message = 'Data industri berhasil disimpan!';
            }

            DB::commit();
            $this->closeModal();
            session()->flash('success', $message);

        } catch (\Exception $e) {
            DB::rollBack();
            session()->flash('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}