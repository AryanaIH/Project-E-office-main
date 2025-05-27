<?php

namespace App\Http\Controllers;

use App\Models\master_proyek;
use App\Models\PraProyek;
use App\Models\DokumenProyek;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PraProyekController extends Controller
{
    // Daftar jenis dokumen syarat yang harus diupload
    private $daftarSyarat = [
        'surat_permohonan',
        'rab',
        'dokumen_teknis',
        'proposal_teknis',
        'izin_lokasi',
        'kontrak_kerja'
    ];

    // Tampilkan list pra proyek dengan filter, pagination 10
    public function index()
    {
        $praProyek = PraProyek::with('dokumen')->paginate(10);
        $listProyek = master_proyek::all();
        $listClient = master_proyek::select('client')->distinct()->get();
        $listlokasi = master_proyek::select('lokasi_proyek')->distinct()->get();
        $listJenisProyek = master_proyek::select('jenis_proyek')->distinct()->get();
        $listTanggalMulai = master_proyek::select('tanggal_mulai')->distinct()->orderBy('tanggal_mulai')->get();
        $listTanggalSelesai = master_proyek::select('tanggal_selesai')->distinct()->orderBy('tanggal_selesai')->get();
        $listStatus = master_proyek::select('status_proyek')->distinct()->get();

        return view('pra-proyek', compact(
            'praProyek', 'listProyek', 'listClient', 'listlokasi',
            'listJenisProyek', 'listTanggalMulai', 'listTanggalSelesai', 'listStatus'
        ));
    }

    // Simpan data pra proyek baru berdasarkan master proyek (via dropdown pilihan)
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

    // Form edit pra proyek
    public function edit($id)
    {
        $praProyek = PraProyek::findOrFail($id);
        return view('pra-proyek.edit', compact('praProyek'));
    }

    // Update data pra proyek
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

    // Hapus pra proyek beserta dokumen terkait (jika ingin)
    public function destroy($id)
    {
        $proyek = PraProyek::findOrFail($id);

        // Optional: hapus file dokumen dari storage
        foreach ($this->daftarSyarat as $dokumen) {
            $dok = DokumenProyek::where('pra_proyek_id', $proyek->id)
                ->where('jenis_dokumen', $dokumen)
                ->first();

            if ($dok && $dok->nama_file) {
                Storage::disk('public')->delete('dokumen/' . $dok->nama_file);
                $dok->delete();
            }
        }

        $proyek->delete();

        return redirect()->route('pra-proyek')->with('success', 'Data berhasil dihapus.');
    }

    // Detail proyek dan status dokumen
    public function show($id)
    {
        $proyek = PraProyek::with('dokumen')->findOrFail($id);

        $totalSyarat = count($this->daftarSyarat);
        $dokumenUploaded = $proyek->dokumen()
            ->whereIn('jenis_dokumen', $this->daftarSyarat)
            ->count();

        return view('detail-proyek', compact('proyek', 'daftarSyarat', 'totalSyarat', 'dokumenUploaded'));
    }

    // Simpan atau update file dokumen syarat
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

    // Ambil status dokumen yang sudah diupload
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
}
