<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Pendaftaran;
use App\Models\Pembayaran;
use App\Models\Dokumen;
use App\Models\Periodic;
use App\Models\Seleksi;
use App\Models\Sistem;
use App\Models\User;
use Illuminate\Process\Exceptions\ProcessTimedOutException;
use App\Notifications\SiswaPendaftaran;
use PDF;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class PendaftaranController extends Controller
{
    //Siswa
    public function pendaftaranSiswaShowPage1(Request $request){
        
        $formData = $request->session()->get('form_data', [
            'nama_lengkap' => '',
            'tanggal_lahir' => '',
            'tempat_lahir' => '',
            'nohp' => '',
            'anak_ke' => '',
            'jumlah_saudara' => '',
            'jenis_kelamin' => '',
            'agama' => '',
            'jalur_pendaftaran' => '',
            'alamat_tinggal_c1_kk' => '',
            'alamat_tmpt_tinggal' => '',
        ]);

        return view ('pages.siswa.pendaftaran.pendaftaran-informasi-pribadi-siswa', compact('formData'));
    }

    public function pendaftaranSiswaShowPage1SaveData(Request $request){
        
        $validated = $request->validate([
            'nama_lengkap' => 'required',
            'tanggal_lahir' => 'required',
            'tempat_lahir' => 'required',
            'nohp' => 'required|min_digits:10|max_digits:14',
            'anak_ke' => 'required|min_digits:1',
            'jumlah_saudara' => 'required',
            'jenis_kelamin' => 'required',
            'agama' => 'required',
            'jalur_pendaftaran' => 'required',

            // Alamat
            'alamat_tinggal_c1_kk' => 'required',
            'alamat_tmpt_tinggal' => 'required',
        ]);
        
        $formData = $request->session()->get('form_data', []);

        $formData = array_merge($formData, $validated);

        $request->session()->put('form_data.nama_lengkap', $validated['nama_lengkap']);
        $request->session()->put('form_data.tanggal_lahir', $validated['tanggal_lahir']);
        $request->session()->put('form_data.tempat_lahir', $validated['tempat_lahir']);
        $request->session()->put('form_data.nohp', $validated['nohp']);
        $request->session()->put('form_data.anak_ke', $validated['anak_ke']);
        $request->session()->put('form_data.jumlah_saudara', $validated['jumlah_saudara']);
        $request->session()->put('form_data.jenis_kelamin', $validated['jenis_kelamin']);
        $request->session()->put('form_data.agama', $validated['agama']);
        $request->session()->put('form_data.jalur_pendaftaran', $validated['jalur_pendaftaran']);

        $request->session()->put('form_data.alamat_tinggal_c1_kk', $validated['alamat_tinggal_c1_kk']);
        $request->session()->put('form_data.alamat_tmpt_tinggal', $validated['alamat_tmpt_tinggal']);
        
        return redirect(route('pendaftaranSiswaShowPage2'));
    }
    
    public function pendaftaranSiswaShowPage2(Request $request){
        $formData = $request->session()->get('form_data', [
            'nisn' => '',
            'nama_sekolah_sd' => '',
            'alamat_sekolah_sd' => '',
            'status_sekolah_sd' => '',
            'is_diy' => '',
            'nilai_rapot_matematika_klsv_smt1' => '',
            'nilai_rapot_bhsindo_klsv_smt1' => '',
            'nilai_rapot_ipa_klsv_smt1' => '',
            'nilai_rapot_ips_klsv_smt1' => '',

            'nilai_rapot_matematika_klsv_smt2' => '',
            'nilai_rapot_bhsindo_klsv_smt2' => '',
            'nilai_rapot_ipa_klsv_smt2' => '',
            'nilai_rapot_ips_klsv_smt2' => '',

            'nilai_rapot_matematika_klsvi_smt1' => '',
            'nilai_rapot_bhsindo_klsvi_smt1' => '',
            'nilai_rapot_ipa_klsvi_smt1' => '',
            'nilai_rapot_ips_klsvi_smt1' => '',

            'nilai_literasi_membaca_aspd' => '',
            'nilai_literasi_numerasi_aspd' => '',
            'nilai_literasi_sains_aspd' => '',
        ]);

        return view('pages.siswa.pendaftaran.pendaftaran-informasi-sekolah-siswa', compact('formData'));
    }

    public function pendaftaranSiswaShowPage2SaveData(Request $request){
        $validated = $request->validate([
            'nisn' => 'required',
            'nama_sekolah_sd' => 'required',
            'alamat_sekolah_sd' => 'required',
            'status_sekolah_sd' => 'required',
            'is_diy' => 'required',

            'nilai_rapot_matematika_klsv_smt1' => 'required',
            'nilai_rapot_bhsindo_klsv_smt1' => 'required',
            'nilai_rapot_ipa_klsv_smt1' => 'required',
            'nilai_rapot_ips_klsv_smt1' => 'required',

            'nilai_rapot_matematika_klsv_smt2' => 'required',
            'nilai_rapot_bhsindo_klsv_smt2' => 'required',
            'nilai_rapot_ipa_klsv_smt2' => 'required',
            'nilai_rapot_ips_klsv_smt2' => 'required',

            'nilai_rapot_matematika_klsvi_smt1' => 'nullable',
            'nilai_rapot_bhsindo_klsvi_smt1' => 'nullable',
            'nilai_rapot_ipa_klsvi_smt1' => 'nullable',
            'nilai_rapot_ips_klsvi_smt1' => 'nullable',

            'nilai_literasi_membaca_aspd' => 'nullable',
            'nilai_literasi_numerasi_aspd' => 'nullable',
            'nilai_literasi_sains_aspd' => 'nullable',
        ]);

        $formData = $request->session()->get('form_data', []);
        $formData = array_merge($formData, $validated);

        $request->session()->put('form_data.nisn', $validated['nisn']);
        $request->session()->put('form_data.nama_sekolah_sd', $validated['nama_sekolah_sd']);
        $request->session()->put('form_data.alamat_sekolah_sd', $validated['alamat_sekolah_sd']);
        $request->session()->put('form_data.status_sekolah_sd', $validated['status_sekolah_sd']);
        $request->session()->put('form_data.is_diy', $validated['is_diy']);

        $request->session()->put('form_data.nilai_rapot_matematika_klsv_smt1', $validated['nilai_rapot_matematika_klsv_smt1']);
        $request->session()->put('form_data.nilai_rapot_bhsindo_klsv_smt1', $validated['nilai_rapot_bhsindo_klsv_smt1']);
        $request->session()->put('form_data.nilai_rapot_ipa_klsv_smt1', $validated['nilai_rapot_ipa_klsv_smt1']);
        $request->session()->put('form_data.nilai_rapot_ips_klsv_smt1', $validated['nilai_rapot_ips_klsv_smt1']);

        $request->session()->put('form_data.nilai_rapot_matematika_klsv_smt2', $validated['nilai_rapot_matematika_klsv_smt2']);
        $request->session()->put('form_data.nilai_rapot_bhsindo_klsv_smt2', $validated['nilai_rapot_bhsindo_klsv_smt2']);
        $request->session()->put('form_data.nilai_rapot_ipa_klsv_smt2', $validated['nilai_rapot_ipa_klsv_smt2']);
        $request->session()->put('form_data.nilai_rapot_ips_klsv_smt2', $validated['nilai_rapot_ips_klsv_smt2']);

        $request->session()->put('form_data.nilai_rapot_matematika_klsvi_smt1', $validated['nilai_rapot_matematika_klsvi_smt1']);
        $request->session()->put('form_data.nilai_rapot_bhsindo_klsvi_smt1', $validated['nilai_rapot_bhsindo_klsvi_smt1']);
        $request->session()->put('form_data.nilai_rapot_ipa_klsvi_smt1', $validated['nilai_rapot_ipa_klsvi_smt1']);
        $request->session()->put('form_data.nilai_rapot_ips_klsvi_smt1', $validated['nilai_rapot_ips_klsvi_smt1']);

        $request->session()->put('form_data.nilai_literasi_membaca_aspd', $validated['nilai_literasi_membaca_aspd']);
        $request->session()->put('form_data.nilai_literasi_numerasi_aspd', $validated['nilai_literasi_numerasi_aspd']);
        $request->session()->put('form_data.nilai_literasi_sains_aspd', $validated['nilai_literasi_sains_aspd']);
        
        // From Page 3

        
        return redirect(route('pendaftaranSiswaShowPage3'));
    }

    public function pendaftaranSiswaShowpage1Back(Request $request){
        $validated = $request->validate([
            'nisn' => 'nullable',
            'nama_sekolah_sd' => 'nullable',
            'alamat_sekolah_sd' => 'nullable',
            'status_sekolah_sd' => 'nullable',
            'is_diy' => 'nullable',

            'nilai_rapot_matematika_klsv_smt1' => 'nullable',
            'nilai_rapot_bhsindo_klsv_smt1' => 'nullable',
            'nilai_rapot_ipa_klsv_smt1' => 'nullable',
            'nilai_rapot_ips_klsv_smt1' => 'nullable',

            'nilai_rapot_matematika_klsv_smt2' => 'nullable',
            'nilai_rapot_bhsindo_klsv_smt2' => 'nullable',
            'nilai_rapot_ipa_klsv_smt2' => 'nullable',
            'nilai_rapot_ips_klsv_smt2' => 'nullable',

            'nilai_rapot_matematika_klsvi_smt1' => 'nullable',
            'nilai_rapot_bhsindo_klsvi_smt1' => 'nullable',
            'nilai_rapot_ipa_klsvi_smt1' => 'nullable',
            'nilai_rapot_ips_klsvi_smt1' => 'nullable',

            'nilai_literasi_membaca_aspd' => 'nullable',
            'nilai_literasi_numerasi_aspd' => 'nullable',
            'nilai_literasi_sains_aspd' => 'nullable',
        ]);

        $formData = $request->session()->get('form_data', []);
        $formData = array_merge($formData, $validated);

        $request->session()->put('form_data.nisn', $validated['nisn']);
        $request->session()->put('form_data.nama_sekolah_sd', $validated['nama_sekolah_sd']);
        $request->session()->put('form_data.alamat_sekolah_sd', $validated['alamat_sekolah_sd']);
        $request->session()->put('form_data.status_sekolah_sd', $validated['status_sekolah_sd']);
        $request->session()->put('form_data.is_diy', $validated['is_diy']);

        $request->session()->put('form_data.nilai_rapot_matematika_klsv_smt1', $validated['nilai_rapot_matematika_klsv_smt1']);
        $request->session()->put('form_data.nilai_rapot_bhsindo_klsv_smt1', $validated['nilai_rapot_bhsindo_klsv_smt1']);
        $request->session()->put('form_data.nilai_rapot_ipa_klsv_smt1', $validated['nilai_rapot_ipa_klsv_smt1']);
        $request->session()->put('form_data.nilai_rapot_ips_klsv_smt1', $validated['nilai_rapot_ips_klsv_smt1']);

        $request->session()->put('form_data.nilai_rapot_matematika_klsv_smt2', $validated['nilai_rapot_matematika_klsv_smt2']);
        $request->session()->put('form_data.nilai_rapot_bhsindo_klsv_smt2', $validated['nilai_rapot_bhsindo_klsv_smt2']);
        $request->session()->put('form_data.nilai_rapot_ipa_klsv_smt2', $validated['nilai_rapot_ipa_klsv_smt2']);
        $request->session()->put('form_data.nilai_rapot_ips_klsv_smt2', $validated['nilai_rapot_ips_klsv_smt2']);

        $request->session()->put('form_data.nilai_rapot_matematika_klsvi_smt1', $validated['nilai_rapot_matematika_klsvi_smt1']);
        $request->session()->put('form_data.nilai_rapot_bhsindo_klsvi_smt1', $validated['nilai_rapot_bhsindo_klsvi_smt1']);
        $request->session()->put('form_data.nilai_rapot_ipa_klsvi_smt1', $validated['nilai_rapot_ipa_klsvi_smt1']);
        $request->session()->put('form_data.nilai_rapot_ips_klsvi_smt1', $validated['nilai_rapot_ips_klsvi_smt1']);

        $request->session()->put('form_data.nilai_literasi_membaca_aspd', $validated['nilai_literasi_membaca_aspd']);
        $request->session()->put('form_data.nilai_literasi_numerasi_aspd', $validated['nilai_literasi_numerasi_aspd']);
        $request->session()->put('form_data.nilai_literasi_sains_aspd', $validated['nilai_literasi_sains_aspd']);

        // From Page 2


        return redirect(route('pendaftaranSiswaShowPage1'));
    }

    public function pendaftaranSiswaShowPage3(Request $request)
    {
        $formData = $request->session()->get('form_data', [
            'nama_ayah' => '',
            'email_ayah' => '',
            'alamat_ayah' => '',
            'no_telpon_ayah' => '',
            'pendidikan_terakhir_ayah' => '',
            'pekerjaan_ayah' => '',
            'penghasilan_ayah' => '',

            'nama_ibu' => '',
            'email_ibu' => '',
            'alamat_ibu' => '',
            'no_telpon_ibu' => '',
            'pendidikan_terakhir_ibu' => '',
            'pekerjaan_ibu' => '',
            'penghasilan_ibu' => '',

            'nama_wali' => '',
            'alamat_wali' => '',
            'no_telpon_wali' => '',
            'pendidikan_terakhir_wali' => '',
            'pekerjaan_wali' => '',
            'penghasilan_wali' => '',

            'file_bukti_pembayaran_pendaftaran' => '',
        ]);
        return view('pages.siswa.pendaftaran.pendaftaran-informasi-orangtua-wali-siswa', compact('formData'));
    }

    public function pendaftaranSiswaShowPage2Back(Request $request)
    {
        $validated = $request->validate([
            'nama_ayah' => 'nullable',
            'email_ayah' => 'nullable',
            'alamat_ayah' => 'nullable',
            'no_telpon_ayah' => 'nullable',
            'pendidikan_terakhir_ayah' => 'nullable',
            'pekerjaan_ayah' => 'nullable',
            'penghasilan_ayah' => 'nullable',

            //Informasi ibu
            'nama_ibu' => 'nullable',
            'email_ibu' => 'nullable',
            'alamat_ibu' => 'nullable',
            'no_telpon_ibu' => 'nullable',
            'pendidikan_terakhir_ibu' => 'nullable',
            'pekerjaan_ibu' => 'nullable',
            'penghasilan_ibu' => 'nullable',

            //Informasi Wali
            'nama_wali' => 'nullable',
            'alamat_wali' => 'nullable',
            'no_telpon_wali' => 'nullable',
            'pendidikan_terakhir_wali' => 'nullable',
            'pekerjaan_wali' => 'nullable',
            'penghasilan_wali' => 'nullable',
            'file_bukti_pembayaran_pendaftaran' => 'nullable',
        ]);
        $formData = $request->session()->get('form_data', []);

        
        if  ($request->hasFile('file_bukti_pembayaran_pendaftaran')) {
            if (!empty($formData['file_bukti_pembayaran_pendaftaran'])) {
                Storage::disk('public')->delete($formData['file_bukti_pembayaran_pendaftaran']);
            }
            $path = $request->file('file_bukti_pembayaran_pendaftaran')->store('temp', 'public');
            // $filename = Str::uuid() . '.' . $request->file('file_bukti_pembayaran_pendaftaran')->getClientOriginalExtension();
            $formData['file_bukti_pembayaran_pendaftaran'] = $path;
        }else{
            if (!empty($formData['file_bukti_pembayaran_pendaftaran'])) {
                $path = $formData['file_bukti_pembayaran_pendaftaran'];
            }else{
                $path = null;
            }
        }

        $formData = array_merge($formData, $validated);

        $request->session()->put('form_data.nama_ayah', $validated['nama_ayah']);
        $request->session()->put('form_data.email_ayah', $validated['email_ayah']);
        $request->session()->put('form_data.alamat_ayah', $validated['alamat_ayah']);
        $request->session()->put('form_data.no_telpon_ayah', $validated['no_telpon_ayah']);
        $request->session()->put('form_data.pendidikan_terakhir_ayah', $validated['pendidikan_terakhir_ayah']);
        $request->session()->put('form_data.pekerjaan_ayah', $validated['pekerjaan_ayah']);
        $request->session()->put('form_data.penghasilan_ayah', $validated['penghasilan_ayah']);

        $request->session()->put('form_data.nama_ibu', $validated['nama_ibu']);
        $request->session()->put('form_data.email_ibu', $validated['email_ibu']);
        $request->session()->put('form_data.alamat_ibu', $validated['alamat_ibu']);
        $request->session()->put('form_data.no_telpon_ibu', $validated['no_telpon_ibu']);
        $request->session()->put('form_data.pendidikan_terakhir_ibu', $validated['pendidikan_terakhir_ibu']);
        $request->session()->put('form_data.pekerjaan_ibu', $validated['pekerjaan_ibu']);
        $request->session()->put('form_data.penghasilan_ibu', $validated['penghasilan_ibu']);

        $request->session()->put('form_data.nama_wali', $validated['nama_wali']);
        $request->session()->put('form_data.alamat_wali', $validated['alamat_wali']);
        $request->session()->put('form_data.no_telpon_wali', $validated['no_telpon_wali']);
        $request->session()->put('form_data.pendidikan_terakhir_wali', $validated['pendidikan_terakhir_wali']);
        $request->session()->put('form_data.pekerjaan_wali', $validated['pekerjaan_wali']);
        $request->session()->put('form_data.penghasilan_wali', $validated['penghasilan_wali']);
        $request->session()->put('form_data.file_bukti_pembayaran_pendaftaran', $path);

        // dd($formData);
        return redirect(route('pendaftaranSiswaShowPage2'));
    }

    public function pendaftaranSiswaSubmit(Request $request){
        $id_check_already = Pendaftaran::where('user_id', Auth::id())->count();
        if ($id_check_already === 0) {
            $validated = $request->validate([
                //Informasi Ayah
                'nama_ayah' => 'nullable',
                'email_ayah' => 'nullable',
                'alamat_ayah' => 'nullable',
                'no_telpon_ayah' => 'nullable',
                'pendidikan_terakhir_ayah' => 'nullable',
                'pekerjaan_ayah' => 'nullable',
                'penghasilan_ayah' => 'nullable',

                //Informasi ibu
                'nama_ibu' => 'nullable',
                'email_ibu' => 'nullable',
                'alamat_ibu' => 'nullable',
                'no_telpon_ibu' => 'nullable',
                'pendidikan_terakhir_ibu' => 'nullable',
                'pekerjaan_ibu' => 'nullable',
                'penghasilan_ibu' => 'nullable',

                //Informasi Wali
                'nama_wali' => 'nullable',
                'alamat_wali' => 'nullable',
                'no_telpon_wali' => 'nullable',
                'pendidikan_terakhir_wali' => 'nullable',
                'pekerjaan_wali' => 'nullable',
                'penghasilan_wali' => 'nullable',

                //File Bukti Pembayaran
                'file_bukti_pembayaran_pendaftaran' => 'nullable',
            ]);

            if ($validated) {
                $formData = $request->session()->get('form_data', []);

                if ($request->hasFile('file_bukti_pembayaran_pendaftaran')) {
                    if (!empty($formData['file_bukti_pembayaran_pendaftaran'])) {
                        Storage::disk('public')->delete($formData['file_bukti_pembayaran_pendaftaran']);
                    }
                    $path = $request->file('file_bukti_pembayaran_pendaftaran')->store('temp/'.Auth::user()->name, 'public');
                } else {
                    if (!empty($formData['file_bukti_pembayaran_pendaftaran'])) {
                        $path = $formData['file_bukti_pembayaran_pendaftaran'];
                    } else {
                        $path = null;
                    }
                }
                $formData = array_merge($formData, $validated);
                
                $request->session()->put('form_data.nama_ayah', $validated['nama_ayah']);
                $request->session()->put('form_data.email_ayah', $validated['email_ayah']);
                $request->session()->put('form_data.alamat_ayah', $validated['alamat_ayah']);
                $request->session()->put('form_data.no_telpon_ayah', $validated['no_telpon_ayah']);
                $request->session()->put('form_data.pendidikan_terakhir_ayah', $validated['pendidikan_terakhir_ayah']);
                $request->session()->put('form_data.pekerjaan_ayah', $validated['pekerjaan_ayah']);
                $request->session()->put('form_data.penghasilan_ayah', $validated['penghasilan_ayah']);

                $request->session()->put('form_data.nama_ibu', $validated['nama_ibu']);
                $request->session()->put('form_data.email_ibu', $validated['email_ibu']);
                $request->session()->put('form_data.alamat_ibu', $validated['alamat_ibu']);
                $request->session()->put('form_data.no_telpon_ibu', $validated['no_telpon_ibu']);
                $request->session()->put('form_data.pendidikan_terakhir_ibu', $validated['pendidikan_terakhir_ibu']);
                $request->session()->put('form_data.pekerjaan_ibu', $validated['pekerjaan_ibu']);
                $request->session()->put('form_data.penghasilan_ibu', $validated['penghasilan_ibu']);

                $request->session()->put('form_data.nama_wali', $validated['nama_wali']);
                $request->session()->put('form_data.alamat_wali', $validated['alamat_wali']);
                $request->session()->put('form_data.no_telpon_wali', $validated['no_telpon_wali']);
                $request->session()->put('form_data.pendidikan_terakhir_wali', $validated['pendidikan_terakhir_wali']);
                $request->session()->put('form_data.pekerjaan_wali', $validated['pekerjaan_wali']);
                $request->session()->put('form_data.penghasilan_wali', $validated['penghasilan_wali']);
                $request->session()->put('form_data.file_bukti_pembayaran_pendaftaran', $path);

                $formData = $request->session()->get('form_data', []);
                if (!empty($formData['file_bukti_pembayaran_pendaftaran'])) {
                    // dd($formData['file_bukti_pembayaran_pendaftaran']);
                    $newPath = str_replace('temp/', 'uploads/', $formData['file_bukti_pembayaran_pendaftaran']);
                    Storage::disk('public')->move($formData['file_bukti_pembayaran_pendaftaran'], $newPath);
                    Storage::disk('public')->deleteDirectory('temp');
                    $finalPath = $newPath;
                    $pendaftaran = Pendaftaran::create([
                        'user_id' => Auth::id(),
                        'nama_lengkap' => $formData['nama_lengkap'],
                        'tanggal_lahir' => $formData['tanggal_lahir'],
                        'tempat_lahir' => $formData['tempat_lahir'],
                        'nohp' => $formData['nohp'],
                        'anak_ke' => $formData['anak_ke'],
                        'jumlah_saudara' => $formData['jumlah_saudara'],
                        'jenis_kelamin' => $formData['jenis_kelamin'],
                        'agama' => $formData['agama'],
                        'jalur_pendaftaran' => $formData['jalur_pendaftaran'],
                        'alamat_tinggal_c1_kk' => $formData['alamat_tinggal_c1_kk'],
                        'alamat_tmpt_tinggal' => $formData['alamat_tmpt_tinggal'],

                        'nisn' => $formData['nisn'],
                        'nama_sekolah_sd' => $formData['nama_sekolah_sd'],
                        'alamat_sekolah_sd' => $formData['alamat_sekolah_sd'],
                        'status_sekolah_sd' => $formData['status_sekolah_sd'],
                        'is_diy' => $formData['is_diy'],

                        'nilai_rapot_matematika_klsv_smt1' => $formData['nilai_rapot_matematika_klsv_smt1'],
                        'nilai_rapot_bhsindo_klsv_smt1' => $formData['nilai_rapot_bhsindo_klsv_smt1'],
                        'nilai_rapot_ipa_klsv_smt1' => $formData['nilai_rapot_ipa_klsv_smt1'],
                        'nilai_rapot_ips_klsv_smt1' => $formData['nilai_rapot_ips_klsv_smt1'],

                        'nilai_rapot_matematika_klsv_smt2' => $formData['nilai_rapot_matematika_klsv_smt2'],
                        'nilai_rapot_bhsindo_klsv_smt2' => $formData['nilai_rapot_bhsindo_klsv_smt2'],
                        'nilai_rapot_ipa_klsv_smt2' => $formData['nilai_rapot_ipa_klsv_smt2'],
                        'nilai_rapot_ips_klsv_smt2' => $formData['nilai_rapot_ips_klsv_smt2'],

                        'nilai_rapot_matematika_klsvi_smt1' => $formData['nilai_rapot_matematika_klsvi_smt1'],
                        'nilai_rapot_bhsindo_klsvi_smt1' => $formData['nilai_rapot_bhsindo_klsvi_smt1'],
                        'nilai_rapot_ipa_klsvi_smt1' => $formData['nilai_rapot_ipa_klsvi_smt1'],
                        'nilai_rapot_ips_klsvi_smt1' => $formData['nilai_rapot_ips_klsvi_smt1'],

                        'nilai_literasi_membaca_aspd' => $formData['nilai_literasi_membaca_aspd'],
                        'nilai_literasi_numerasi_aspd' => $formData['nilai_literasi_numerasi_aspd'],
                        'nilai_literasi_sains_aspd' => $formData['nilai_literasi_sains_aspd'],

                        'nama_ayah' => $formData['nama_ayah'],
                        'email_ayah' => $formData['email_ayah'],
                        'alamat_ayah' => $formData['alamat_ayah'],
                        'no_telpon_ayah' => $formData['no_telpon_ayah'],
                        'pendidikan_terakhir_ayah' => $formData['pendidikan_terakhir_ayah'],
                        'pekerjaan_ayah' => $formData['pekerjaan_ayah'],
                        'penghasilan_ayah' => $formData['penghasilan_ayah'],

                        'nama_ibu' => $formData['nama_ibu'],
                        'email_ibu' => $formData['email_ibu'],
                        'alamat_ibu' => $formData['alamat_ibu'],
                        'no_telpon_ibu' => $formData['no_telpon_ibu'],
                        'pendidikan_terakhir_ibu' => $formData['pendidikan_terakhir_ibu'],
                        'pekerjaan_ibu' => $formData['pekerjaan_ibu'],
                        'penghasilan_ibu' => $formData['penghasilan_ibu'],

                        'nama_wali' => $formData['nama_wali'],
                        'alamat_wali' => $formData['alamat_wali'],
                        'no_telpon_wali' => $formData['no_telpon_wali'],
                        'pendidikan_terakhir_wali' => $formData['pendidikan_terakhir_wali'],
                        'pekerjaan_wali' => $formData['pekerjaan_wali'],
                        'penghasilan_wali' => $formData['penghasilan_wali'],
                        'file_bukti_pembayaran_pendaftaran' => $finalPath,
                    ]);

                    $pendaftaran_id = Pendaftaran::get()->last()->id;

                    Pembayaran::create([
                        'pendaftaran_id' => $pendaftaran_id,
                        'user_id' => Auth::id(),
                        'itHasFile' => true,
                        'isValid' => 'Menunggu',
                    ]);

                    $pembayaran_id = Pembayaran::get()->last()->id;

                    Dokumen::create([
                        'user_id' => Auth::id(),
                        'pendaftaran_id' => $pendaftaran_id,
                        'pembayaran_id' => $pembayaran_id,
                    ]);

                    $dokumen_id = Dokumen::get()->last()->id;

                    Seleksi::create([
                        'user_id' => Auth::id(),
                        'pendaftaran_id' => $pendaftaran_id,
                        'dokumen_id' => $dokumen_id,
                        'pembayaran_id' => $pembayaran_id,
                        'hasil_jalur_pendaftaran' => 'Menunggu',
                        'isLulus' => 'Menunggu',
                    ]);

                    $seleksi_id = Seleksi::get()->last()->id;

                    $periodic_id = Periodic::get()->last()->id;

                    Sistem::create([
                        'user_id' => Auth::id(),
                        'pendaftaran_id' => $pendaftaran_id,
                        'dokumen_id' => $dokumen_id,
                        'pembayaran_id' => $pembayaran_id,
                        'seleksi_id' => $seleksi_id,
                        'periodic_id' => $periodic_id,
                    ]);

                    Storage::deleteDirectory('temp/' . Auth::user()->name);
                    $request->session()->forget('form_data');
                    return redirect(route('dokumenSiswaShow1', Auth::id()))->with('goodNow', 'Pendaftaran Berhasil');
                } else {
                    $finalPath = null;
                    $pendaftaran = Pendaftaran::create([
                        'user_id' => Auth::id(),
                        'nama_lengkap' => $formData['nama_lengkap'],
                        'tanggal_lahir' => $formData['tanggal_lahir'],
                        'tempat_lahir' => $formData['tempat_lahir'],
                        'nohp' => $formData['nohp'],
                        'anak_ke' => $formData['anak_ke'],
                        'jumlah_saudara' => $formData['jumlah_saudara'],
                        'jenis_kelamin' => $formData['jenis_kelamin'],
                        'agama' => $formData['agama'],
                        'jalur_pendaftaran' => $formData['jalur_pendaftaran'],
                        'alamat_tinggal_c1_kk' => $formData['alamat_tinggal_c1_kk'],
                        'alamat_tmpt_tinggal' => $formData['alamat_tmpt_tinggal'],

                        'nisn' => $formData['nisn'],
                        'nama_sekolah_sd' => $formData['nama_sekolah_sd'],
                        'alamat_sekolah_sd' => $formData['alamat_sekolah_sd'],
                        'status_sekolah_sd' => $formData['status_sekolah_sd'],
                        'is_diy' => $formData['is_diy'],

                        'nilai_rapot_matematika_klsv_smt1' => $formData['nilai_rapot_matematika_klsv_smt1'],
                        'nilai_rapot_bhsindo_klsv_smt1' => $formData['nilai_rapot_bhsindo_klsv_smt1'],
                        'nilai_rapot_ipa_klsv_smt1' => $formData['nilai_rapot_ipa_klsv_smt1'],
                        'nilai_rapot_ips_klsv_smt1' => $formData['nilai_rapot_ips_klsv_smt1'],

                        'nilai_rapot_matematika_klsv_smt2' => $formData['nilai_rapot_matematika_klsv_smt2'],
                        'nilai_rapot_bhsindo_klsv_smt2' => $formData['nilai_rapot_bhsindo_klsv_smt2'],
                        'nilai_rapot_ipa_klsv_smt2' => $formData['nilai_rapot_ipa_klsv_smt2'],
                        'nilai_rapot_ips_klsv_smt2' => $formData['nilai_rapot_ips_klsv_smt2'],

                        'nilai_rapot_matematika_klsvi_smt1' => $formData['nilai_rapot_matematika_klsvi_smt1'],
                        'nilai_rapot_bhsindo_klsvi_smt1' => $formData['nilai_rapot_bhsindo_klsvi_smt1'],
                        'nilai_rapot_ipa_klsvi_smt1' => $formData['nilai_rapot_ipa_klsvi_smt1'],
                        'nilai_rapot_ips_klsvi_smt1' => $formData['nilai_rapot_ips_klsvi_smt1'],

                        'nilai_literasi_membaca_aspd' => $formData['nilai_literasi_membaca_aspd'],
                        'nilai_literasi_numerasi_aspd' => $formData['nilai_literasi_numerasi_aspd'],
                        'nilai_literasi_sains_aspd' => $formData['nilai_literasi_sains_aspd'],

                        'nama_ayah' => $formData['nama_ayah'],
                        'email_ayah' => $formData['email_ayah'],
                        'alamat_ayah' => $formData['alamat_ayah'],
                        'no_telpon_ayah' => $formData['no_telpon_ayah'],
                        'pendidikan_terakhir_ayah' => $formData['pendidikan_terakhir_ayah'],
                        'pekerjaan_ayah' => $formData['pekerjaan_ayah'],
                        'penghasilan_ayah' => $formData['penghasilan_ayah'],

                        'nama_ibu' => $formData['nama_ibu'],
                        'email_ibu' => $formData['email_ibu'],
                        'alamat_ibu' => $formData['alamat_ibu'],
                        'no_telpon_ibu' => $formData['no_telpon_ibu'],
                        'pendidikan_terakhir_ibu' => $formData['pendidikan_terakhir_ibu'],
                        'pekerjaan_ibu' => $formData['pekerjaan_ibu'],
                        'penghasilan_ibu' => $formData['penghasilan_ibu'],

                        'nama_wali' => $formData['nama_wali'],
                        'alamat_wali' => $formData['alamat_wali'],
                        'no_telpon_wali' => $formData['no_telpon_wali'],
                        'pendidikan_terakhir_wali' => $formData['pendidikan_terakhir_wali'],
                        'pekerjaan_wali' => $formData['pekerjaan_wali'],
                        'penghasilan_wali' => $formData['penghasilan_wali'],
                        'file_bukti_pembayaran_pendaftaran' => $finalPath,
                    ]);
                    
                    $pendaftaran_id = Pendaftaran::get()->last()->id;

                    Pembayaran::create([
                        'pendaftaran_id' => $pendaftaran_id,
                        'user_id' => Auth::id(),
                        'itHasFile' => false,
                        'isValid' => 'Menunggu',
                    ]);

                    $pembayaran_id = Pembayaran::get()->last()->id;

                    Dokumen::create([
                        'user_id' => Auth::id(),
                        'pendaftaran_id' => $pendaftaran_id,
                        'pembayaran_id' => $pembayaran_id,
                    ]);

                    $dokumen_id = Dokumen::get()->last()->id;

                    Seleksi::create([
                        'user_id' => Auth::id(),
                        'pendaftaran_id' => $pendaftaran_id,
                        'dokumen_id' => $dokumen_id,
                        'pembayaran_id' => $pembayaran_id,
                        'hasil_jalur_pendaftaran' => 'Menunggu',
                        'isLulus' => 'Menunggu',
                    ]);

                    $seleksi_id = Seleksi::get()->last()->id;

                    $periodic_id = Periodic::get()->last()->id;

                    Sistem::create([
                        'user_id' => Auth::id(),
                        'pendaftaran_id' => $pendaftaran_id,
                        'dokumen_id' => $dokumen_id,
                        'pembayaran_id' => $pembayaran_id,
                        'seleksi_id' => $seleksi_id,
                        'periodic_id' => $periodic_id,
                    ]);
                    
                    Storage::deleteDirectory('temp/' . Auth::user()->name);
                    $request->session()->forget('form_data');
                    return redirect(route('dokumenSiswaShow1', Auth::id()))->with('goodNow', 'Pendaftaran Berhasil');
                }
            } else {
                // form data is not valid, return error message
                return redirect()->back()->withErrors($validated);
            }
        }else{
            return redirect(route('logoutUser'));
        }
    }
}