<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;

class MenuController extends Controller
{
    /**
     * Menampilkan daftar menu dengan fitur pencarian dan pengurutan hierarkis.
     */
    public function index(Request $request)
    {
        $query = Menu::query();

        // 1. Fitur Pencarian (Sinkron dengan View)
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('judul_menu', 'like', "%{$search}%")
                  ->orWhere('url', 'like', "%{$search}%");
            });
        }

        // 2. Pengurutan Hierarkis: Menu Utama (parent_id NULL) tampil dulu, lalu Sub-menu
        $menus = $query->orderByRaw('parent_id IS NOT NULL, parent_id ASC')
                       ->orderBy('urutan', 'asc')
                       ->get();

        return view('admin.menus.index', compact('menus'));
    }

    /**
     * Menampilkan form tambah menu.
     */
    public function create()
    {
        // Ambil semua menu untuk opsi dropdown "Menu Induk"
        $menus = Menu::orderBy('urutan', 'asc')->get();
        return view('admin.menus.create', compact('menus'));
    }

    /**
     * Menyimpan menu baru ke database.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul_menu' => 'required|string|max:255',
            'url'        => 'required|string|max:255',
            'parent_id'  => 'nullable|integer|exists:menus,id',
            'urutan'     => 'required|integer|min:1',
            'is_active'  => 'nullable|boolean',
        ]);

        // 3. Handle Checkbox: Jika tidak dicentang, Laravel tidak mengirim data, jadi kita set manual
        $validated['is_active'] = $request->has('is_active');

        Menu::create($validated);

        return redirect('/admin/menus')->with('success', 'Menu berhasil ditambahkan!');
    }

    /**
     * Menampilkan form edit menu.
     */
    public function edit($id)
    {
        $menu = Menu::findOrFail($id);
        
        // 4. Safety Net: Ambil semua menu KECUALI menu yang sedang diedit 
        // untuk mencegah infinite loop (menu menjadi induk dari dirinya sendiri)
        $menus = Menu::where('id', '!=', $id)->orderBy('urutan', 'asc')->get();
        
        return view('admin.menus.edit', compact('menu', 'menus'));
    }

    /**
     * Mengupdate data menu.
     */
    public function update(Request $request, $id)
    {
        $menu = Menu::findOrFail($id);

        $validated = $request->validate([
            'judul_menu' => 'required|string|max:255',
            'url'        => 'required|string|max:255',
            'parent_id'  => 'nullable|integer|exists:menus,id',
            'urutan'     => 'required|integer|min:1',
            'is_active'  => 'nullable|boolean',
        ]);

        // 5. Safety Net Ganda: Mencegah menu menjadi parent dari dirinya sendiri
        if (isset($validated['parent_id']) && $validated['parent_id'] == $menu->id) {
            $validated['parent_id'] = null;
        }

        $validated['is_active'] = $request->has('is_active');

        $menu->update($validated);

        return redirect('/admin/menus')->with('success', 'Menu berhasil diupdate!');
    }

    /**
     * Menghapus menu.
     */
    public function destroy($id)
    {
        $menu = Menu::findOrFail($id);

        // 6. PROTECTIVE DELETE: 
        // Jika menu ini memiliki sub-menu, lepaskan parent_id sub-menu tersebut 
        // agar tidak error foreign key atau menjadi data "yatim piatu"
        Menu::where('parent_id', $menu->id)->update(['parent_id' => null]);

        $menu->delete();

        return redirect('/admin/menus')->with('success', 'Menu berhasil dihapus!');
    }
}