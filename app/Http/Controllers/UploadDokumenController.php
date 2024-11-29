<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Dokumen;
use App\Models\Pendaftaran;
use App\Models\Pembayaran;
use App\Models\Seleksi;
use App\Models\Sistem;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

use function PHPUnit\Framework\isFalse;

class UploadDokumenController extends Controller
{
    public function dokumenSiswaShow1($id, Request $request){
        $cek_file_pembayaran = Pendaftaran::where('user_id', $id)->get();
        // dd($cek_file_pembayaran[0]->file_bukti_pembayaran_pendaftaran);
        if($cek_file_pembayaran[0]->file_bukti_pembayaran_pendaftaran == null){
            $formData = $request->session()->get('form_data', [
                'file_bukti_pembayaran_pendaftaran' => '',
                'file_foto_terbaru' => '',
                'file_kartu_keluarga' => '',
                'file_akta_kelahiran' => '',
                'file_ktp_orang_tua_ayah' => '',
                'file_ktp_orang_tua_ibu' => '',
                'file_ktp_orang_tua_wali' => ''
            ]);
        }else{
            $formData = $request->session()->get('form_data', [
                'file_foto_terbaru' => '',
                'file_kartu_keluarga' => '',
                'file_akta_kelahiran' => '',
                'file_ktp_orang_tua_ayah' => '',
                'file_ktp_orang_tua_ibu' => '',
                'file_ktp_orang_tua_wali' => ''
            ]);
        }
        $dokumen = Dokumen::where('user_id', $id)
        ->get();
        $pendaftaran = Pendaftaran::where('user_id', $id)
        ->get();
        return view('pages.siswa.dokumen.upload-dokumen-page1', compact('dokumen', 'pendaftaran'));
    }

    public function dokumenSiswashow1Save($id, Request $request){
        $formData = $request->session()->get('form_data', []);
        $file_bukti = Pendaftaran::where('user_id', $id)
        ->get();
        if($formData == null){
            if ($file_bukti[0]->file_bukti_pembayaran_pendaftaran == null) {
                $validated = $request->validate([
                    'file_bukti_pembayaran_pendaftaran' => 'required',
                    'file_foto_terbaru' => 'required',
                    'file_kartu_keluarga' => 'required',
                    'file_akta_kelahiran' => 'required',
                    'file_ktp_orang_tua_ayah' => 'nullable',
                    'file_ktp_orang_tua_ibu' => 'nullable',
                    'file_ktp_orang_tua_wali' => 'nullable'
                ]);
                $request->session()->put('form_data', $request->all());
                $path_file_bukti_pembayaran_pendaftaran = $request->file('file_bukti_pembayaran_pendaftaran')->store('temp/' . Auth::user()->name, 'public');
                $path_file_foto_terbaru = $request->file('file_foto_terbaru')->store('temp/' . Auth::user()->name . '/' . 'DokumenSiswa/', 'public');
                $path_file_kartu_keluarga = $request->file('file_kartu_keluarga')->store('temp/' . Auth::user()->name . '/' . 'DokumenSiswa/', 'public');
                $path_file_akta_kelahiran = $request->file('file_akta_kelahiran')->store('temp/' . Auth::user()->name . '/' . 'DokumenSiswa/', 'public');
                if ($request->hasFile('file_ktp_orang_tua_ayah')) {
                    $path_file_ktp_orang_tua_ayah = $request->file('file_ktp_orang_tua_ayah')->store('temp/' . Auth::user()->name . '/' . 'DokumenSiswa/', 'public');
                    $request->session()->put('form_data.file_ktp_orang_tua_ayah', ($path_file_ktp_orang_tua_ayah));
                } else {
                    $request->session()->put('form_data.file_ktp_orang_tua_ayah', null);
                }
                if ($request->hasFile('file_ktp_orang_tua_ibu')) {
                    $path_file_ktp_orang_tua_ibu = $request->file('file_ktp_orang_tua_ibu')->store('temp/' . Auth::user()->name . '/' . 'DokumenSiswa/', 'public');
                    $request->session()->put('form_data.file_ktp_orang_tua_ibu', ($path_file_ktp_orang_tua_ibu));
                } else {
                    $request->session()->put('form_data.file_ktp_orang_tua_ibu', null);
                }
                if ($request->hasFile('file_ktp_orang_tua_wali')) {
                    $path_file_ktp_orang_tua_wali = $request->file('file_ktp_orang_tua_wali')->store('temp/' . Auth::user()->name . '/' . 'DokumenSiswa/', 'public');
                    $request->session()->put('form_data.file_ktp_orang_tua_wali', ($path_file_ktp_orang_tua_wali));
                } else {
                    $request->session()->put('form_data.file_ktp_orang_tua_wali', null);
                }

                $request->session()->put('form_data.file_bukti_pembayaran_pendaftaran', ($path_file_bukti_pembayaran_pendaftaran));
                $request->session()->put('form_data.file_foto_terbaru', ($path_file_foto_terbaru));
                $request->session()->put('form_data.file_kartu_keluarga', ($path_file_kartu_keluarga));
                $request->session()->put('form_data.file_akta_kelahiran', ($path_file_akta_kelahiran));
            } else {
                $validated = $request->validate([
                    'file_foto_terbaru' => 'required',
                    'file_kartu_keluarga' => 'required',
                    'file_akta_kelahiran' => 'required',
                    'file_ktp_orang_tua_ayah' => 'nullable',
                    'file_ktp_orang_tua_ibu' => 'nullable',
                    'file_ktp_orang_tua_wali' => 'nullable'
                ]);
                $request->session()->put('form_data', $request->all());
                $path_file_foto_terbaru = $request->file('file_foto_terbaru')->store('temp/' . Auth::user()->name . '/' . 'DokumenSiswa/', 'public');
                $path_file_kartu_keluarga = $request->file('file_kartu_keluarga')->store('temp/' . Auth::user()->name . '/' . 'DokumenSiswa/', 'public');
                $path_file_akta_kelahiran = $request->file('file_akta_kelahiran')->store('temp/' . Auth::user()->name . '/' . 'DokumenSiswa/', 'public');
                $request->session()->put('form_data.file_foto_terbaru', ($path_file_foto_terbaru));
                $request->session()->put('form_data.file_kartu_keluarga', ($path_file_kartu_keluarga));
                $request->session()->put('form_data.file_akta_kelahiran', ($path_file_akta_kelahiran));

                if ($request->hasFile('file_ktp_orang_tua_ayah')) {
                    $path_file_ktp_orang_tua_ayah = $request->file('file_ktp_orang_tua_ayah')->store('temp/' . Auth::user()->name . '/' . 'DokumenSiswa/', 'public');
                    $request->session()->put('form_data.file_ktp_orang_tua_ayah', ($path_file_ktp_orang_tua_ayah));
                } else {
                    $request->session()->put('form_data.file_ktp_orang_tua_ayah', null);
                }

                if ($request->hasFile('file_ktp_orang_tua_ibu')) {
                    $path_file_ktp_orang_tua_ibu = $request->file('file_ktp_orang_tua_ibu')->store('temp/' . Auth::user()->name . '/' . 'DokumenSiswa/', 'public');
                    $request->session()->put('form_data.file_ktp_orang_tua_ibu', ($path_file_ktp_orang_tua_ibu));
                } else {
                    $request->session()->put('form_data.file_ktp_orang_tua_ibu', null);
                }

                if ($request->hasFile('file_ktp_orang_tua_wali')) {
                    $path_file_ktp_orang_tua_wali = $request->file('file_ktp_orang_tua_wali')->store('temp/' . Auth::user()->name . '/' . 'DokumenSiswa/', 'public');
                    $request->session()->put('form_data.file_ktp_orang_tua_wali', ($path_file_ktp_orang_tua_wali));
                } else {
                    $request->session()->put('form_data.file_ktp_orang_tua_wali', null);
                }

            }
            
            return redirect(route('dokumenSiswaShowPage2', Auth::id()));
        } else {
            return redirect(route('dokumenSiswaShowPage2', Auth::id()));
        }
    }

    public function dokumenSiswaShowPage2($id, Request $request){
        $formData = $request->session()->get('form_data', [
            'file_rapor_kelasv_semester1' => '',
            'file_rapor_kelasv_semester2' => '',
            'file_sertifikat_aspd' => '',
            'file_sertifikat_kejuaraan[]' => '',
            'file_kms_kip' => '',
        ]);
        $dokumen = Dokumen::where('user_id', $id)
        ->get();
        $pendaftaran = Pendaftaran::where('user_id', $id)
        ->get();
        return view('pages.siswa.dokumen.upload-dokumen-page2', compact('dokumen', 'pendaftaran'));
    }

    public function dokumenSiswaBackPage1($id, Request $request){
        $validated = $request->validate([
            'file_rapor_kelasv_semester1' => 'nullable',
            'file_rapor_kelasv_semester2' => 'nullable',
            'file_sertifikat_aspd' => 'nullable',
            'file_sertifikat_kejuaraan' => 'nullable|array',
            'file_kms_kip' => 'nullable',
        ]);
        $request->session()->put('form_data', $request->all());

        if($request->hasFile('file_rapor_kelasv_semester1')){
            $path_file_rapor_kelasv_semester1 = $request->file('file_rapor_kelasv_semester1')->store('temp/' . Auth::user()->name . '/' . 'DokumenSiswa/', 'public');
            $request->session()->put('form_data.file_rapor_kelasv_semester1', ($path_file_rapor_kelasv_semester1));
        } else {
            $request->session()->put('form_data.file_rapor_kelasv_semester1', null);
        }
        if($request->hasFile('file_rapor_kelasv_semester2')){
            $path_file_rapor_kelasv_semester2 = $request->file('file_rapor_kelasv_semester2')->store('temp/' . Auth::user()->name . '/' . 'DokumenSiswa/', 'public');
            $request->session()->put('form_data.file_rapor_kelasv_semester2', ($path_file_rapor_kelasv_semester2));
        } else {
            $request->session()->put('form_data.file_rapor_kelasv_semester2', null);
        }

        if ($request->hasFile('file_sertifikat_aspd')) {
            $path_file_sertifikat_aspd = $request->file('file_sertifikat_aspd')->store('temp/' . Auth::user()->name . '/' . 'DokumenSiswa/', 'public');
            $request->session()->put('form_data.file_sertifikat_aspd', ($path_file_sertifikat_aspd));
        } else {
            $request->session()->put('form_data.file_sertifikat_aspd', null);
        }

        if ($request->hasFile('file_sertifikat_kejuaraan')) {
            if ($path_file_sertifikat_kejuaraan = $request->file('file_sertifikat_kejuaraan')) {
                foreach ($path_file_sertifikat_kejuaraan as $file) {
                    $file->store('temp/' . Auth::user()->name . '/' . 'DokumenSiswa/', 'public');
                    $filepaths[] = $file;
                }
            }
            $request->session()->put('form_data.file_sertifikat_kejuaraan', $filepaths);
        } else {
            $request->session()->put('form_data.file_sertifikat_kejuaraan', null);
        }
        if($request->hasFile('file_kms_kip')){
            $path_file_kms_kip = $request->file('file_kms_kip')->store('temp/' . Auth::user()->name . '/' . 'DokumenSiswa/', 'public');
            $request->session()->put('form_data.file_kms_kip', ($path_file_kms_kip));
        } else {
            $request->session()->put('form_data.file_kms_kip', null);
        }
        return redirect(route('dokumenSiswaShow1', Auth::id()))->with('haveData', 'Anda Sudah Memasukkan data');
    }

    public function dokumenSiswaSave($id, Request $request){
        $formData = $request->session()->get('form_data', []);
        $validated = $request->validate([
            'file_rapor_kelasv_semester1' => 'required',
            'file_rapor_kelasv_semester2' => 'required',
            'file_sertifikat_aspd' => 'nullable',
            'file_sertifikat_kejuaraan' => 'nullable|array',
            'file_kms_kip' => 'nullable',
        ]);
        $request->session()->put('form_data', $request->all());
        if ($request->hasFile('file_rapor_kelasv_semester1')) {
            $path_file_rapor_kelasv_semester1 = $request->file('file_rapor_kelasv_semester1')->store('temp/' . Auth::user()->name . '/' . 'DokumenSiswa/', 'public');
            $request->session()->put('form_data.file_rapor_kelasv_semester1', ($path_file_rapor_kelasv_semester1));
        } else {
            $request->session()->put('form_data.file_rapor_kelasv_semester1', null);
        }
        if ($request->hasFile('file_rapor_kelasv_semester2')) {
            $path_file_rapor_kelasv_semester2 = $request->file('file_rapor_kelasv_semester2')->store('temp/' . Auth::user()->name . '/' . 'DokumenSiswa/', 'public');
            $request->session()->put('form_data.file_rapor_kelasv_semester2', ($path_file_rapor_kelasv_semester2));
        } else {
            $request->session()->put('form_data.file_rapor_kelasv_semester2', null);
        }

        if ($request->hasFile('file_sertifikat_aspd')) {
            $path_file_sertifikat_aspd = $request->file('file_sertifikat_aspd')->store('temp/' . Auth::user()->name . '/' . 'DokumenSiswa/', 'public');
            $request->session()->put('form_data.file_sertifikat_aspd', ($path_file_sertifikat_aspd));
        } else {
            $request->session()->put('form_data.file_sertifikat_aspd', null);
        }

        if ($request->hasFile('file_sertifikat_kejuaraan')) {
            $filePaths = [];
            if ($path_file_sertifikat_kejuaraan = $request->file('file_sertifikat_kejuaraan')) {
                foreach ($path_file_sertifikat_kejuaraan as $file) {
                    $filePath = $file->store('temp/' . Auth::user()->name . '/' . 'DokumenSiswa/', 'public');
                    $filePaths[] = $filePath;
                }
            }
            $request->session()->put('form_data.file_sertifikat_kejuaraan', $filePaths);
        } else {
            $request->session()->put('form_data.file_sertifikat_kejuaraan', null);
        }

        if($request->hasFile('file_kms_kip')){
            $path_file_kms_kip = $request->file('file_kms_kip')->store('temp/' . Auth::user()->name . '/' . 'DokumenSiswa/', 'public');
            $request->session()->put('form_data.file_kms_kip', ($path_file_kms_kip));
        } else {
            $request->session()->put('form_data.file_kms_kip', null);
        }

        $formSekarang = $request->session()->get('form_data', []);
        $formData = array_merge($formData, $formSekarang);

        if (isset($formData['file_bukti_pembayaran_pendaftaran']) == false) {
            
            //file foto terbaru
            if(isset($formData['file_foto_terbaru'])) {
                if($formData['file_foto_terbaru'] != null){
                    $newPath_file_foto_terbaru = str_replace('temp/', 'uploads/', $formData['file_foto_terbaru']);
                    Storage::disk('public')->move($formData['file_foto_terbaru'], $newPath_file_foto_terbaru);
                    $new_path_file_foto_terbaru = $newPath_file_foto_terbaru;
                    Storage::disk('public')->delete($formData['file_foto_terbaru']);
                } else if(isset($request->file_foto_terbaru)) {
                    $new_path_file_foto_terbaru = $request->file('file_foto_terbaru')->store('uploads/' . Auth::user()->name . '/' . 'DokumenSiswa/', 'public');
                } else {
                    $new_path_file_foto_terbaru = null;
                }
            } else {
                $new_path_file_foto_terbaru = null;
            }

            //file kartu keluarga
            if(isset($formData['file_kartu_keluarga'])) {
                if($formData['file_kartu_keluarga'] != null){
                    $newPath_file_kartu_keluarga = str_replace('temp/', 'uploads/', $formData['file_kartu_keluarga']);
                    Storage::disk('public')->move($formData['file_kartu_keluarga'], $newPath_file_kartu_keluarga);
                    $new_path_file_kartu_keluarga = $newPath_file_kartu_keluarga;
                    Storage::disk('public')->delete($formData['file_kartu_keluarga']);
                } else if (isset($request->file_kartu_keluarga)) {
                    $new_path_file_kartu_keluarga = $request->file('file_kartu_keluarga')->store('uploads/' . Auth::user()->name . '/' . 'DokumenSiswa/', 'public');
                } else {
                    $new_path_file_kartu_keluarga = null;
                }
            } else {
                $new_path_file_kartu_keluarga = null;
            }

            //file akta kelahiran
            if(isset($formData['file_akta_kelahiran'])) {
                if($formData['file_akta_kelahiran'] != null){
                    $newPath_file_akta_kelahiran = str_replace('temp/', 'uploads/', $formData['file_akta_kelahiran']);
                    Storage::disk('public')->move($formData['file_akta_kelahiran'], $newPath_file_akta_kelahiran);
                    $new_path_file_akta_kelahiran = $newPath_file_akta_kelahiran;
                    Storage::disk('public')->delete($formData['file_akta_kelahiran']);
                } else if (isset($request->file_akta_kelahiran)) {
                    $new_path_file_akta_kelahiran = $request->file('file_akta_kelahiran')->store('uploads/' . Auth::user()->name . '/' . 'DokumenSiswa/', 'public');
                } else {
                    $new_path_file_akta_kelahiran = null;
                }
            } else {
                $new_path_file_akta_kelahiran = null;
            }

            //file ktp ayah
            if(isset($formData['file_ktp_orang_tua_ayah'])) {
                if ($formData['file_ktp_orang_tua_ayah'] != null) {
                    $newPath_file_ktp_orang_tua_ayah = str_replace('temp/', 'uploads/', $formData['file_ktp_orang_tua_ayah']);
                    Storage::disk('public')->move($formData['file_ktp_orang_tua_ayah'], $newPath_file_ktp_orang_tua_ayah);
                    $new_file_ktp_orang_tua_ayah = $newPath_file_ktp_orang_tua_ayah;
                    Storage::disk('public')->delete($formData['file_ktp_orang_tua_ayah']);
                } else if (isset($request->file_ktp_orang_tua_ayah)) {
                    $new_file_ktp_orang_tua_ayah = $request->file('file_ktp_orang_tua_ayah')->store('uploads/' . Auth::user()->name . '/' . 'DokumenSiswa/', 'public');
                } else {
                    $new_file_ktp_orang_tua_ayah = null;
                }
            } else{
                $new_file_ktp_orang_tua_ayah = null;
            }
            

            //file ktp ibu
            if(isset($formData['file_ktp_orang_tua_ibu'])) {
                if ($formData['file_ktp_orang_tua_ibu'] != null) {
                    $newPath_file_ktp_orang_tua_ibu = str_replace('temp/', 'uploads/', $formData['file_ktp_orang_tua_ibu']);
                    Storage::disk('public')->move($formData['file_ktp_orang_tua_ibu'], $newPath_file_ktp_orang_tua_ibu);
                    $new_file_ktp_orang_tua_ibu = $newPath_file_ktp_orang_tua_ibu;
                    Storage::disk('public')->delete($formData['file_ktp_orang_tua_ibu']);
                } else if (isset($request->file_ktp_orang_tua_ibu)) {
                    $new_file_ktp_orang_tua_ibu = $request->file('file_ktp_orang_tua_ibu')->store('uploads/' . Auth::user()->name . '/' . 'DokumenSiswa/', 'public');
                } else {
                    $new_file_ktp_orang_tua_ibu = null;
                }
            } else {
                $new_file_ktp_orang_tua_ibu = null;
            }
            

            //file ktp wali
            if(isset($formData['file_ktp_orang_tua_wali'])) {
                if ($formData['file_ktp_orang_tua_wali'] != null) {
                    $newPath_file_ktp_orang_tua_wali = str_replace('temp/', 'uploads/', $formData['file_ktp_orang_tua_wali']);
                    Storage::disk('public')->move($formData['file_ktp_orang_tua_wali'], $newPath_file_ktp_orang_tua_wali);
                    $new_file_ktp_orang_tua_wali = $newPath_file_ktp_orang_tua_wali;
                    Storage::disk('public')->delete($formData['file_ktp_orang_tua_wali']);
                } else if (isset($request->file_ktp_orang_tua_wali)) {
                    $new_file_ktp_orang_tua_wali = $request->file('file_ktp_orang_tua_wali')->store('uploads/' . Auth::user()->name . '/' . 'DokumenSiswa/', 'public');
                } else {
                    $new_file_ktp_orang_tua_wali = null;
                }
            } else {
                $new_file_ktp_orang_tua_wali = null;
            }
            

            //file rapor kelas 5 semester 1
            if(isset($formData['file_rapor_kelasv_semester1'])) {
                if ($formData['file_rapor_kelasv_semester1'] != null) {
                    $newPath_file_rapor_kelasv_semester1 = str_replace('temp/', 'uploads/', $formData['file_rapor_kelasv_semester1']);
                    Storage::disk('public')->move($formData['file_rapor_kelasv_semester1'], $newPath_file_rapor_kelasv_semester1);
                    $new_file_rapor_kelasv_semester1 = $newPath_file_rapor_kelasv_semester1;
                    Storage::disk('public')->delete($formData['file_rapor_kelasv_semester1']);
                } else if (isset($request->file_rapor_kelasv_semester1) && $request->file_rapor_kelasv_semester1 != null) {
                    $new_file_rapor_kelasv_semester1 = $request->file('file_rapor_kelasv_semester1')->store('uploads/' . Auth::user()->name . '/' . 'DokumenSiswa/', 'public');
                } else if (isset($request->file_rapor_kelasv_semester1) && $request->file_rapor_kelasv_semester1 == null) {
                    $new_file_rapor_kelasv_semester1 = null;
                } else {
                    $new_file_rapor_kelasv_semester1 = null;
                }
            } else {
                $new_file_rapor_kelasv_semester1 = null;
            }
            

            //file rapor kelas 5 semester 2
            if(isset($formData['file_rapor_kelasv_semester2'])) {
                if ($formData['file_rapor_kelasv_semester2'] != null) {
                    $newPath_file_rapor_kelasv_semester2 = str_replace('temp/', 'uploads/', $formData['file_rapor_kelasv_semester2']);
                    Storage::disk('public')->move($formData['file_rapor_kelasv_semester2'], $newPath_file_rapor_kelasv_semester2);
                    $new_file_rapor_kelasv_semester2 = $newPath_file_rapor_kelasv_semester2;
                    Storage::disk('public')->delete($formData['file_rapor_kelasv_semester2']);
                } else if (isset($request->file_rapor_kelasv_semester2) && $request->file_rapor_kelasv_semester2 != null) {
                    $new_file_rapor_kelasv_semester2 = $request->file('file_rapor_kelasv_semester2')->store('uploads/' . Auth::user()->name . '/' . 'DokumenSiswa/', 'public');
                } else if (isset($request->file_rapor_kelasv_semester2) && $request->file_rapor_kelasv_semester2 == null) {
                    $new_file_rapor_kelasv_semester2 = null;
                } else {
                    $new_file_rapor_kelasv_semester2 = null;
                }
            } else {
                $new_file_rapor_kelasv_semester2 = null;
            }
            

            //file rapor aspd
            if(isset($formData['file_sertifikat_aspd'])) {
                if ($formData['file_sertifikat_aspd'] != null) {
                    $newPath_file_sertifikat_aspd = str_replace('temp/', 'uploads/', $formData['file_sertifikat_aspd']);
                    Storage::disk('public')->move($formData['file_sertifikat_aspd'], $newPath_file_sertifikat_aspd);
                    $new_file_sertifikat_aspd = $newPath_file_sertifikat_aspd;
                    Storage::disk('public')->delete($formData['file_sertifikat_aspd']);
                } else if (isset($request->file_sertifikat_aspd) && $request->file_sertifikat_aspd != null) {
                    $new_file_sertifikat_aspd = $request->file('file_sertifikat_aspd')->store('uploads/' . Auth::user()->name . '/' . 'DokumenSiswa/', 'public');
                } else if (isset($request->file_sertifikat_aspd) && $request->file_sertifikat_aspd == null) {
                    $new_file_sertifikat_aspd = null;
                } else {
                    $new_file_sertifikat_aspd = null;
                }
            } else {
                $new_file_sertifikat_aspd = null;
            }
            
            //file sertifikat kejuaraan
            if (isset($formData['file_sertifikat_kejuaraan'])) {
                if ($formData['file_sertifikat_kejuaraan'] != null) {
                    foreach ($formData['file_sertifikat_kejuaraan'] as $filePath) {
                        $newPath_file_sertifikat_kejuaraan = str_replace('temp/', 'uploads/', $filePath);
                        Storage::disk('public')->move($filePath, $newPath_file_sertifikat_kejuaraan);
                        $new_file_sertifikat_kejuaraan[] = $newPath_file_sertifikat_kejuaraan;
                        Storage::disk('public')->delete($filePath);
                    }
                } else if (isset($request->file_sertifikat_kejuaraan) && $request->file_sertifikat_kejuaraan != null) {
                    foreach ($request->file('file_sertifikat_kejuaraan') as $filePath) {
                        $new_file_sertifikat_kejuaraan = $request->$filePath->store('uploads/' . Auth::user()->name . '/' . 'DokumenSiswa/', 'public');
                    }
                } else if (isset($request->file_sertifikat_kejuaraan) && $request->file_sertifikat_kejuaraan == null) {
                    $new_file_sertifikat_kejuaraan = null;
                } else {
                    $new_file_sertifikat_kejuaraan = null;
                }
            } else {
                $new_file_sertifikat_kejuaraan = null;
            }

            //file kms kip
            if(isset($formData['file_kms_kip'])) {
                if ($formData['file_kms_kip'] != null) {
                    $newPath_file_kms_kip = str_replace('temp/', 'uploads/', $formData['file_kms_kip']);
                    Storage::disk('public')->move($formData['file_kms_kip'], $newPath_file_kms_kip);
                    $new_file_kms_kip = $newPath_file_kms_kip;
                    Storage::disk('public')->delete($formData['file_kms_kip']);
                } else if (isset($request->file_kms_kip) && $request->file_kms_kip != null) {
                    $new_file_kms_kip = $request->file('file_kms_kip')->store('uploads/' . Auth::user()->name . '/' . 'DokumenSiswa/', 'public');
                } else if (isset($request->file_kms_kip) && $request->file_kms_kip == null) {
                    $new_file_kms_kip = null;
                } else {
                    $new_file_kms_kip = null;
                }
            } else {
                $new_file_kms_kip = null;
            }
            
            //Update Database Dokumen
            $dokumenToUpdate = [
                'file_foto_terbaru' => $new_path_file_foto_terbaru,
                'file_kartu_keluarga' => $new_path_file_kartu_keluarga,
                'file_akta_kelahiran' => $new_path_file_akta_kelahiran,
                'file_ktp_orang_tua_ayah' => $new_file_ktp_orang_tua_ayah,
                'file_ktp_orang_tua_ibu' => $new_file_ktp_orang_tua_ibu,
                'file_ktp_orang_tua_wali' => $new_file_ktp_orang_tua_wali,
                'file_rapor_kelasv_semester1' => $new_file_rapor_kelasv_semester1,
                'file_rapor_kelasv_semester2' => $new_file_rapor_kelasv_semester2,
                'file_sertifikat_aspd' => $new_file_sertifikat_aspd,
                'file_kms_kip' => $new_file_kms_kip
            ];
            if($new_file_sertifikat_kejuaraan != null){
                $dokumenToUpdate['file_sertifikat_kejuaraan'] = json_encode($new_file_sertifikat_kejuaraan);
            }else{
                $dokumenToUpdate['file_sertifikat_kejuaraan'] = null;
            }

            Dokumen::where('user_id', $id)->update($dokumenToUpdate);

            $dokumen_id = Dokumen::where('user_id', $id)->get();
            $pendaftaran_id = Pendaftaran::where('user_id', $id)->get();
            $pembayaran_id = Pembayaran::where('user_id', $id)->get();

            $pembayaran_id = $pembayaran_id[0]->id;
            $dokumen_id = $dokumen_id[0]->id;
            $pendaftaran_id = $pendaftaran_id[0]->id;

            Sistem::where('user_id', Auth::user()->id)->update([
                'user_id' => Auth::user()->id,
                'pendaftaran_id' => $pendaftaran_id,
                'dokumen_id' => $dokumen_id,
                'pembayaran_id' => $pembayaran_id,
            ]);

            Storage::disk('public')->deleteDirectory('temp');

            return redirect()->route('seleksiSiswaShow', Auth::user()->id);
        } else {
            //file bukti pembayaran di Table Pendaftaran
            $newPath = str_replace('temp/', 'uploads/', $formData['file_bukti_pembayaran_pendaftaran']);
            Storage::disk('public')->move($formData['file_bukti_pembayaran_pendaftaran'], $newPath);
            $new_path_file_bukti_pembayaran_pendaftaran = $newPath;

            //file foto terbaru
            if (isset($formData['file_foto_terbaru'])) {
                if ($formData['file_foto_terbaru'] != null) {
                    $newPath_file_foto_terbaru = str_replace('temp/', 'uploads/', $formData['file_foto_terbaru']);
                    Storage::disk('public')->move($formData['file_foto_terbaru'], $newPath_file_foto_terbaru);
                    $new_path_file_foto_terbaru = $newPath_file_foto_terbaru;
                    Storage::disk('public')->delete($formData['file_foto_terbaru']);
                } else if (isset($request->file_foto_terbaru)) {
                    $new_path_file_foto_terbaru = $request->file('file_foto_terbaru')->store('uploads/' . Auth::user()->name . '/' . 'DokumenSiswa/', 'public');
                } else {
                    $new_path_file_foto_terbaru = null;
                }
            } else {
                $new_path_file_foto_terbaru = null;
            }

            //file kartu keluarga
            if (isset($formData['file_kartu_keluarga'])) {
                if ($formData['file_kartu_keluarga'] != null) {
                    $newPath_file_kartu_keluarga = str_replace('temp/', 'uploads/', $formData['file_kartu_keluarga']);
                    Storage::disk('public')->move($formData['file_kartu_keluarga'], $newPath_file_kartu_keluarga);
                    $new_path_file_kartu_keluarga = $newPath_file_kartu_keluarga;
                    Storage::disk('public')->delete($formData['file_kartu_keluarga']);
                } else if (isset($request->file_kartu_keluarga)) {
                    $new_path_file_kartu_keluarga = $request->file('file_kartu_keluarga')->store('uploads/' . Auth::user()->name . '/' . 'DokumenSiswa/', 'public');
                } else {
                    $new_path_file_kartu_keluarga = null;
                }
            } else {
                $new_path_file_kartu_keluarga = null;
            }

            //file akta kelahiran
            if (isset($formData['file_akta_kelahiran'])) {
                if ($formData['file_akta_kelahiran'] != null) {
                    $newPath_file_akta_kelahiran = str_replace('temp/', 'uploads/', $formData['file_akta_kelahiran']);
                    Storage::disk('public')->move($formData['file_akta_kelahiran'], $newPath_file_akta_kelahiran);
                    $new_path_file_akta_kelahiran = $newPath_file_akta_kelahiran;
                    Storage::disk('public')->delete($formData['file_akta_kelahiran']);
                } else if (isset($request->file_akta_kelahiran)) {
                    $new_path_file_akta_kelahiran = $request->file('file_akta_kelahiran')->store('uploads/' . Auth::user()->name . '/' . 'DokumenSiswa/', 'public');
                } else {
                    $new_path_file_akta_kelahiran = null;
                }
            } else {
                $new_path_file_akta_kelahiran = null;
            }

            //file ktp ayah
            if (isset($formData['file_ktp_orang_tua_ayah'])) {
                if ($formData['file_ktp_orang_tua_ayah'] != null) {
                    $newPath_file_ktp_orang_tua_ayah = str_replace('temp/', 'uploads/', $formData['file_ktp_orang_tua_ayah']);
                    Storage::disk('public')->move($formData['file_ktp_orang_tua_ayah'], $newPath_file_ktp_orang_tua_ayah);
                    $new_file_ktp_orang_tua_ayah = $newPath_file_ktp_orang_tua_ayah;
                    Storage::disk('public')->delete($formData['file_ktp_orang_tua_ayah']);
                } else if (isset($request->file_ktp_orang_tua_ayah)) {
                    $new_file_ktp_orang_tua_ayah = $request->file('file_ktp_orang_tua_ayah')->store('uploads/' . Auth::user()->name . '/' . 'DokumenSiswa/', 'public');
                } else {
                    $new_file_ktp_orang_tua_ayah = null;
                }
            } else {
                $new_file_ktp_orang_tua_ayah = null;
            }
            //file ktp ibu
            if (isset($formData['file_ktp_orang_tua_ibu'])) {
                if ($formData['file_ktp_orang_tua_ibu'] != null) {
                    $newPath_file_ktp_orang_tua_ibu = str_replace('temp/', 'uploads/', $formData['file_ktp_orang_tua_ibu']);
                    Storage::disk('public')->move($formData['file_ktp_orang_tua_ibu'], $newPath_file_ktp_orang_tua_ibu);
                    $new_file_ktp_orang_tua_ibu = $newPath_file_ktp_orang_tua_ibu;
                    Storage::disk('public')->delete($formData['file_ktp_orang_tua_ibu']);
                } else if (isset($request->file_ktp_orang_tua_ibu)) {
                    $new_file_ktp_orang_tua_ibu = $request->file('file_ktp_orang_tua_ibu')->store('uploads/' . Auth::user()->name . '/' . 'DokumenSiswa/', 'public');
                } else {
                    $new_file_ktp_orang_tua_ibu = null;
                }
            } else {
                $new_file_ktp_orang_tua_ibu = null;
            }


            //file ktp wali
            if (isset($formData['file_ktp_orang_tua_wali'])) {
                if ($formData['file_ktp_orang_tua_wali'] != null) {
                    $newPath_file_ktp_orang_tua_wali = str_replace('temp/', 'uploads/', $formData['file_ktp_orang_tua_wali']);
                    Storage::disk('public')->move($formData['file_ktp_orang_tua_wali'], $newPath_file_ktp_orang_tua_wali);
                    $new_file_ktp_orang_tua_wali = $newPath_file_ktp_orang_tua_wali;
                    Storage::disk('public')->delete($formData['file_ktp_orang_tua_wali']);
                } else if (isset($request->file_ktp_orang_tua_wali)) {
                    $new_file_ktp_orang_tua_wali = $request->file('file_ktp_orang_tua_wali')->store('uploads/' . Auth::user()->name . '/' . 'DokumenSiswa/', 'public');
                } else {
                    $new_file_ktp_orang_tua_wali = null;
                }
            } else {
                $new_file_ktp_orang_tua_wali = null;
            }


            //file rapor kelas 5 semester 1
            if (isset($formData['file_rapor_kelasv_semester1'])) {
                if ($formData['file_rapor_kelasv_semester1'] != null) {
                    $newPath_file_rapor_kelasv_semester1 = str_replace('temp/', 'uploads/', $formData['file_rapor_kelasv_semester1']);
                    Storage::disk('public')->move($formData['file_rapor_kelasv_semester1'], $newPath_file_rapor_kelasv_semester1);
                    $new_file_rapor_kelasv_semester1 = $newPath_file_rapor_kelasv_semester1;
                    Storage::disk('public')->delete($formData['file_rapor_kelasv_semester1']);
                } else if (isset($request->file_rapor_kelasv_semester1) && $request->file_rapor_kelasv_semester1 != null) {
                    $new_file_rapor_kelasv_semester1 = $request->file('file_rapor_kelasv_semester1')->store('uploads/' . Auth::user()->name . '/' . 'DokumenSiswa/', 'public');
                } else if (isset($request->file_rapor_kelasv_semester1) && $request->file_rapor_kelasv_semester1 == null) {
                    $new_file_rapor_kelasv_semester1 = null;
                } else {
                    $new_file_rapor_kelasv_semester1 = null;
                }
            } else {
                $new_file_rapor_kelasv_semester1 = null;
            }


            //file rapor kelas 5 semester 2
            if (isset($formData['file_rapor_kelasv_semester2'])) {
                if ($formData['file_rapor_kelasv_semester2'] != null) {
                    $newPath_file_rapor_kelasv_semester2 = str_replace('temp/', 'uploads/', $formData['file_rapor_kelasv_semester2']);
                    Storage::disk('public')->move($formData['file_rapor_kelasv_semester2'], $newPath_file_rapor_kelasv_semester2);
                    $new_file_rapor_kelasv_semester2 = $newPath_file_rapor_kelasv_semester2;
                    Storage::disk('public')->delete($formData['file_rapor_kelasv_semester2']);
                } else if (isset($request->file_rapor_kelasv_semester2) && $request->file_rapor_kelasv_semester2 != null) {
                    $new_file_rapor_kelasv_semester2 = $request->file('file_rapor_kelasv_semester2')->store('uploads/' . Auth::user()->name . '/' . 'DokumenSiswa/', 'public');
                } else if (isset($request->file_rapor_kelasv_semester2) && $request->file_rapor_kelasv_semester2 == null) {
                    $new_file_rapor_kelasv_semester2 = null;
                } else {
                    $new_file_rapor_kelasv_semester2 = null;
                }
            } else {
                $new_file_rapor_kelasv_semester2 = null;
            }


            //file rapor aspd
            if (isset($formData['file_sertifikat_aspd'])) {
                if ($formData['file_sertifikat_aspd'] != null) {
                    $newPath_file_sertifikat_aspd = str_replace('temp/', 'uploads/', $formData['file_sertifikat_aspd']);
                    Storage::disk('public')->move($formData['file_sertifikat_aspd'], $newPath_file_sertifikat_aspd);
                    $new_file_sertifikat_aspd = $newPath_file_sertifikat_aspd;
                    Storage::disk('public')->delete($formData['file_sertifikat_aspd']);
                } else if (isset($request->file_sertifikat_aspd) && $request->file_sertifikat_aspd != null) {
                    $new_file_sertifikat_aspd = $request->file('file_sertifikat_aspd')->store('uploads/' . Auth::user()->name . '/' . 'DokumenSiswa/', 'public');
                } else if (isset($request->file_sertifikat_aspd) && $request->file_sertifikat_aspd == null) {
                    $new_file_sertifikat_aspd = null;
                } else {
                    $new_file_sertifikat_aspd = null;
                }
            } else {
                $new_file_sertifikat_aspd = null;
            }

            //file sertifikat kejuaraan
            if (isset($formData['file_sertifikat_kejuaraan'])) {
                if ($formData['file_sertifikat_kejuaraan'] != null) {
                    foreach ($formData['file_sertifikat_kejuaraan'] as $filePath) {
                        $newPath_file_sertifikat_kejuaraan = str_replace('temp/', 'uploads/', $filePath);
                        Storage::disk('public')->move($filePath, $newPath_file_sertifikat_kejuaraan);
                        $new_file_sertifikat_kejuaraan[] = $newPath_file_sertifikat_kejuaraan;
                        Storage::disk('public')->delete($filePath);
                    }
                } else if (isset($request->file_sertifikat_kejuaraan) && $request->file_sertifikat_kejuaraan != null
                ) {
                    foreach ($request->file('file_sertifikat_kejuaraan') as $filePath) {
                        $new_file_sertifikat_kejuaraan = $request->$filePath->store('uploads/' . Auth::user()->name . '/' . 'DokumenSiswa/', 'public');
                    }
                } else if (isset($request->file_sertifikat_kejuaraan) && $request->file_sertifikat_kejuaraan == null
                ) {
                    $new_file_sertifikat_kejuaraan = null;
                } else {
                    $new_file_sertifikat_kejuaraan = null;
                }
            } else {
                $new_file_sertifikat_kejuaraan = null;
            }

            //file kms kip
            if (isset($formData['file_kms_kip'])) {
                if ($formData['file_kms_kip'] != null) {
                    $newPath_file_kms_kip = str_replace('temp/', 'uploads/', $formData['file_kms_kip']);
                    Storage::disk('public')->move($formData['file_kms_kip'], $newPath_file_kms_kip);
                    $new_file_kms_kip = $newPath_file_kms_kip;
                    Storage::disk('public')->delete($formData['file_kms_kip']);
                } else if (isset($request->file_kms_kip) && $request->file_kms_kip != null) {
                    $new_file_kms_kip = $request->file('file_kms_kip')->store('uploads/' . Auth::user()->name . '/' . 'DokumenSiswa/', 'public');
                } else if (isset($request->file_kms_kip) && $request->file_kms_kip == null) {
                    $new_file_kms_kip = null;
                } else {
                    $new_file_kms_kip = null;
                }
            } else {
                $new_file_kms_kip = null;
            }

            Pendaftaran::where('user_id', $id)->update([
                'file_bukti_pembayaran_pendaftaran' => $new_path_file_bukti_pembayaran_pendaftaran,
            ]);

            //Update Database Dokumen
            $dokumenToUpdate = [
                'file_foto_terbaru' => $new_path_file_foto_terbaru,
                'file_kartu_keluarga' => $new_path_file_kartu_keluarga,
                'file_akta_kelahiran' => $new_path_file_akta_kelahiran,
                'file_ktp_orang_tua_ayah' => $new_file_ktp_orang_tua_ayah,
                'file_ktp_orang_tua_ibu' => $new_file_ktp_orang_tua_ibu,
                'file_ktp_orang_tua_wali' => $new_file_ktp_orang_tua_wali,
                'file_rapor_kelasv_semester1' => $new_file_rapor_kelasv_semester1,
                'file_rapor_kelasv_semester2' => $new_file_rapor_kelasv_semester2,
                'file_sertifikat_aspd' => $new_file_sertifikat_aspd,
                'file_kms_kip' => $new_file_kms_kip,
            ];
            if ($new_file_sertifikat_kejuaraan != null) {
                $dokumenToUpdate['file_sertifikat_kejuaraan'] = json_encode($new_file_sertifikat_kejuaraan);
            } else {
                $dokumenToUpdate['file_sertifikat_kejuaraan'] = null;
            }

            Dokumen::where('user_id', $id)->update($dokumenToUpdate);

            Pembayaran::where('user_id', $id)->update([
                'itHasFile' => 1,
            ]);

            $dokumen_id = Dokumen::where('user_id', $id)->get();
            $pendaftaran_id = Pendaftaran::where('user_id', $id)->get();
            $pembayaran_id = Pembayaran::where('user_id', $id)->get();

            $pembayaran_id = $pembayaran_id[0]->id;
            $dokumen_id = $dokumen_id[0]->id;
            $pendaftaran_id = $pendaftaran_id[0]->id;

            Sistem::where('user_id', Auth::user()->id)->update([
                'user_id' => Auth::user()->id,
                'pendaftaran_id' => $pendaftaran_id,
                'dokumen_id' => $dokumen_id,
                'pembayaran_id' => $pembayaran_id,
            ]);
            Storage::disk('public')->deleteDirectory('temp');
            return redirect()->route('seleksiSiswaShow', Auth::user()->id);
        }
    }

    public function dokumenKelulusanShow($id){
        $dokumen = Dokumen::where('user_id', $id)->get();
        $pendaftaran = Pendaftaran::where('user_id', $id)->get();
        
        return view('pages.siswa.dokumen.upload-dokumen-kelulusan', compact('dokumen', 'pendaftaran'));
    }

    public function dokumenKelulusanSubmit(Request $request, $id){
        $validated = $request->validate([
            'file_surat_keterangan_lulus' => 'required',
            'file_ijazah' => 'required',
            'file_sertifikat_aspd' => 'nullable',
        ]);

        $new_path_file_surat_keterangan_lulus = $request->file('file_surat_keterangan_lulus')->store('uploads/' . Auth::user()->name . '/' . 'DokumenSiswa/', 'public');
        $new_path_file_ijazah = $request->file('file_ijazah')->store('uploads/' . Auth::user()->name . '/' . 'DokumenSiswa/', 'public');
        if($request->hasFile('file_sertifikat_aspd')){
            $new_path_file_sertifikat_aspd = $request->file('file_sertifikat_aspd')->store('uploads/' . Auth::user()->name . '/' . 'DokumenSiswa/', 'public');
        }else{
            $new_path_file_sertifikat_aspd = null;
        }

        Dokumen::where('user_id', $id)->update([
            'file_surat_keterangan_lulus' => $new_path_file_surat_keterangan_lulus,
            'file_ijazah' => $new_path_file_ijazah,
            'file_sertifikat_aspd' => $new_path_file_sertifikat_aspd,
        ]);

        return redirect()->route('bergabungShow', Auth::user()->id);
    }

    public function bergabungShow($id){
        $dokumen = Dokumen::where('user_id', $id)->get();
        $pendaftaran = Pendaftaran::where('user_id', $id)->get();
        
        return view('pages.siswa.selesai.siswa-bergabung', compact('dokumen', 'pendaftaran'));
    }
}
