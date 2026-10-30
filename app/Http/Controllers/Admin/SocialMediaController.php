<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SocialMedia;
use Illuminate\Http\Request;

class SocialMediaController extends Controller
{
    public function index()
    {
        $socialMedias = SocialMedia::orderBy('order')->get();
        return view('admin.social-medias.index', compact('socialMedias'));
    }

    public function create()
    {
        return view('admin.social-medias.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'platform' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'url' => 'required|url|max:255',
            'icon' => 'nullable|string|max:255',
            'order' => 'nullable|integer',
            'is_active' => 'boolean'
        ]);

        SocialMedia::create($validated);

        return redirect()->route('admin.social-medias.index')
            ->with('success', 'Social media berhasil ditambahkan');
    }

    public function edit(SocialMedia $socialMedia)
    {
        return view('admin.social-medias.edit', compact('socialMedia'));
    }

    public function update(Request $request, SocialMedia $socialMedia)
    {
        $validated = $request->validate([
            'platform' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'url' => 'required|url|max:255',
            'icon' => 'nullable|string|max:255',
            'order' => 'nullable|integer',
            'is_active' => 'boolean'
        ]);

        $socialMedia->update($validated);

        return redirect()->route('admin.social-medias.index')
            ->with('success', 'Social media berhasil diupdate');
    }

    public function destroy(SocialMedia $socialMedia)
    {
        $socialMedia->delete();

        return redirect()->route('admin.social-medias.index')
            ->with('success', 'Social media berhasil dihapus');
    }
}