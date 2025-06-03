<?php

namespace App\Http\Controllers;

use App\Models\master_proyek;
use App\Models\PraProyek;
use App\Models\DokumenProyek;
use App\Models\UploadedDocument;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PraProyekController extends Controller
{
    private $daftarSyarat = [
        'surat_permohonan',
        'rab',
        'dokumen_teknis',
        'proposal_teknis',
        'izin_lokasi',
        'kontrak_kerja'
    ];

    public function index(Request $request)
    {
        $query = PraProyek::query();

        $query->when($request->filled('status_proyek'), function ($q) use ($request) {
            $q->where('status_proyek', $request->status_proyek);
        });

        $query->when($request->filled('tanggal_mulai'), function ($q) use ($request) {
            $q->whereDate('tanggal_mulai', '>=', $request->tanggal_mulai);
        });

        $query->when($request->filled('tanggal_selesai'), function ($q) use ($request) {
            $q->whereDate('tanggal_selesai', '<=', $request->tanggal_selesai);
        });

        $query->when($request->filled('jenis_proyek'), function ($q) use ($request) {
            $q->where('jenis_proyek', $request->jenis_proyek);
        });

        $query->when($request->filled('search'), function ($q) use ($request) {
            $q->where(function ($q) use ($request) {
                $q->where('nama_proyek', 'like', '%' . $request->search . '%')
                    ->orWhere('client', 'like', '%' . $request->search . '%')
                    ->orWhere('lokasi_proyek', 'like', '%' . $request->search . '%');
            });
        });

        $praProyek = $query->latest()->paginate(10);

        $listProyek = master_proyek::all();
        $listClient = master_proyek::select('client')->distinct()->get();
        $listlokasi = master_proyek::select('lokasi_proyek')->distinct()->get();
        $listJenisProyek = master_proyek::select('jenis_proyek')->distinct()->get();
        $listTanggalMulai = master_proyek::select('tanggal_mulai')->distinct()->orderBy('tanggal_mulai')->get();
        $listTanggalSelesai = master_proyek::select('tanggal_selesai')->distinct()->orderBy('tanggal_selesai')->get();
        $listStatus = master_proyek::select('status_proyek')->distinct()->get();
        $dropdownOptions = DokumenProyek::pluck('nama_file', 'id_dokumen');

        return view('pra-proyek', compact(
            'praProyek', 'listProyek', 'listClient', 'listlokasi',
            'listJenisProyek', 'listTanggalMulai', 'listTanggalSelesai', 'listStatus', 'dropdownOptions'
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_proyek' => 'required|exists:master_proyeks,id',
        ]);

        $master = master_proyek::findOrFail($request->nama_proyek);

        PraProyek::create([
            'id_master_proyek' => $master->id,
            'nama_proyek' => $master->nama_proyek,
            'client' => $master->client,
            'lokasi_proyek' => $master->lokasi_proyek,
            'jenis_proyek' => $master->jenis_proyek,
            'tanggal_mulai' => $master->tanggal_mulai,
            'tanggal_selesai' => $master->tanggal_selesai,
            'status_proyek' => $master->status_proyek,
        ]);

        return redirect()->back()->with('success', 'Pra-Proyek berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $praProyek = PraProyek::findOrFail($id);
        return view('pra-proyek.edit', compact('praProyek'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_proyek'      => 'required|string|max:255',
            'client'           => 'required|string|max:255',
            'lokasi_proyek'    => 'required|string|max:255',
            'jenis_proyek'     => 'required|string|max:255',
            'tanggal_mulai'    => 'required|date',
            'tanggal_selesai'  => 'required|date|after_or_equal:tanggal_mulai',
            'status_proyek'    => 'required|string|max:255',
        ]);

        $praProyek = PraProyek::findOrFail($id);

        $praProyek->update($request->only([
            'nama_proyek',
            'client',
            'lokasi_proyek',
            'jenis_proyek',
            'tanggal_mulai',
            'tanggal_selesai',
            'status_proyek',
        ]));

        return redirect()->route('pra-proyek')->with('success', 'Data berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $proyek = PraProyek::findOrFail($id);

        foreach ($this->daftarSyarat as $dokumen) {
            $dok = DokumenProyek::where('id_proyeks', $proyek->id)
                ->first();

            if ($dok && $dok->nama_file) {
                unlink('templates/' . $dok->nama_file);
                $dok->delete();
            }
        }

        $proyek->delete();

        return redirect()->route('pra-proyek.index')->with('success', 'Data berhasil dihapus.');
    }

    public function show($id)
    {
        $proyek = PraProyek::with('dokumen')->findOrFail($id);

        $totalSyarat = count($this->daftarSyarat);
        $dokumenUploaded = $proyek->dokumen()
            ->whereIn('jenis_dokumen', $this->daftarSyarat)
            ->count();

        return view('detail-proyek', compact('proyek', 'daftarSyarat', 'totalSyarat', 'dokumenUploaded'));
    }

    public function storeDokumen(Request $request)
    {
        $rules = [
            'pra_proyek_id' => 'required|exists:pra_proyeks,id',
        ];

        foreach ($this->daftarSyarat as $field) {
            $rules[$field] = 'nullable|file|mimes:pdf|max:2048';
        }

        $request->validate($rules);

        $praProyekId = $request->input('pra_proyek_id');

        foreach ($this->daftarSyarat as $field) {
            if ($request->hasFile($field)) {
                $file = $request->file($field);
                $filename = time() . '_' . $field . '.' . $file->getClientOriginalExtension();
                $file->storeAs('dokumen', $filename, 'public');

                $existingDokumen = DokumenProyek::where('pra_proyek_id', $praProyekId)
                    ->where('jenis_dokumen', $field)
                    ->first();

                if ($existingDokumen && $existingDokumen->nama_file) {
                    Storage::disk('public')->delete('dokumen/' . $existingDokumen->nama_file);
                }

                DokumenProyek::updateOrCreate(
                    [
                        'pra_proyek_id' => $praProyekId,
                        'jenis_dokumen' => $field,
                    ],
                    [
                        'nama_file' => $filename,
                    ]
                );
            }
        }

        return redirect()->back()->with('success', 'Dokumen berhasil disimpan.');
    }

    public function getDokumenStatus($praProyekId)
    {
        $status = [];

        foreach ($this->daftarSyarat as $field) {
            $dokumen = DokumenProyek::where('pra_proyek_id', $praProyekId)
                ->where('jenis_dokumen', $field)
                ->first();

            $status[$field] = $dokumen && $dokumen->nama_file ? true : false;
        }

        return response()->json($status);
    }
    public function showForm()
    {
        $docs = [
            'ktp' => 'KTP',
            'npwp' => 'NPWP',
            // Tambah jenis dokumen lain jika perlu
        ];

        $existingFiles = [];
        foreach ($docs as $id => $label) {
            $existingFiles[$id] = UploadedDocument::where('document_type', $id)
                ->where('user_id', auth()->id())
                ->get();
        }

        return view('dokumen.form', compact('docs', 'existingFiles'));
    }
    public function upload(Request $request)
    {
        $docs = ['ktp', 'npwp'];

        foreach ($docs as $docType) {
            $option = $request->input("upload_option_{$docType}");

            if ($option === 'upload' && $request->hasFile("file_{$docType}")) {
                $file = $request->file("file_{$docType}");
                $filePath = $file->store('uploads', 'public');

                UploadedDocument::create([
                    'user_id' => auth()->id(),
                    'document_type' => $docType,
                    'file_name' => $file->getClientOriginalName(),
                    'file_path' => $filePath,
                ]);
            }

            if ($option === 'existing') {
                $existingPath = $request->input("existing_{$docType}");
                // Anda bisa menyimpan referensi atau menghubungkannya sesuai kebutuhan
            }
        }

        return redirect()->back()->with('success', 'Dokumen berhasil diproses.');
    }
    
}
