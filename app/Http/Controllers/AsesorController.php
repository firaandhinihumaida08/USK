<?php
namespace App\Http\Controllers;

use App\Models\Asesor;
use Illuminate\Http\Request;

class AsesorController extends Controller {
    public function index() {
        $asesors = Asesor::all();
        return view('asesor.index', compact('asesors'));
    }

    public function create() {
        return view('asesor.create');
    }

    public function store(Request $request) {
        $request->validate([
            'nama_asesor' => 'required|string|max:255',
            'no_registrasi' => 'required|string|unique:asesors,no_registrasi',
            'keahlian' => 'required|string|max:255',
        ]);

        Asesor::create($request->all());
        return redirect()->route('asesor.index')->with('success', 'Data asesor berhasil ditambahkan.');
    }

    public function edit(Asesor $asesor) {
        return view('asesor.edit', compact('asesor'));
    }

    public function update(Request $request, Asesor $asesor) {
        $request->validate([
            'nama_asesor' => 'required|string|max:255',
            'no_registrasi' => 'required|string|unique:asesors,no_registrasi,' . $asesor->id,
            'keahlian' => 'required|string|max:255',
        ]);

        $asesor->update($request->all());
        return redirect()->route('asesor.index')->with('success', 'Data asesor berhasil diperbarui.');
    }

    public function destroy(Asesor $asesor) {
        $asesor->delete();
        return redirect()->route('asesor.index')->with('success', 'Data asesor berhasil dihapus.');
    }
}