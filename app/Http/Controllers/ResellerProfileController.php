<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ResellerProfileController extends Controller
{
    public function edit(Request $request)
    {
        $reseller = $request->user()->reseller;
        return view('reseller.profile', compact('reseller'));
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'nama_lengkap' => ['required', 'string', 'max:255'],
            'prodi'        => ['nullable', 'string', 'max:255'],
            'whatsapp'     => ['nullable', 'string', 'max:20'],
            'instagram'    => ['nullable', 'string', 'max:100'],
            'tiktok'       => ['nullable', 'string', 'max:100'],
            'bio'          => ['nullable', 'string', 'max:1000'],
            'foto'         => ['nullable', 'image', 'max:2048'],
        ]);

        $reseller = $request->user()->reseller;

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('resellers', 'public');
        }

        $reseller->update($data);

        return back()->with('status', 'Profil berhasil diperbarui.');
    }
}
