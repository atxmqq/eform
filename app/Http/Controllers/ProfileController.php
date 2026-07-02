<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function show()
    {
        return view('profile.show', ['user' => auth()->user()]);
    }

    public function updateSignature(Request $request)
    {
        $request->validate([
            'signature_type' => 'required|in:draw,upload',
            'signature_data' => 'required_if:signature_type,draw|nullable|string',
            'signature_file' => 'required_if:signature_type,upload|nullable|file|mimes:png,jpg,jpeg|max:2048',
        ]);

        $user = auth()->user();
        $path = null;

        if ($request->signature_type === 'draw') {
            $dataUrl = $request->signature_data;
            if (!str_starts_with($dataUrl, 'data:image/png;base64,')) {
                return back()->withErrors(['signature_data' => 'ลายเซ็นไม่ถูกต้อง']);
            }
            $imageData = base64_decode(substr($dataUrl, 22));
            $path = 'signatures/' . $user->id . '/signature.png';
            Storage::disk('public')->put($path, $imageData);

        } else {
            if ($request->hasFile('signature_file')) {
                if ($user->signature) {
                    Storage::disk('public')->delete($user->signature);
                }
                $path = $request->file('signature_file')
                    ->storeAs('signatures/' . $user->id, 'signature.' . $request->file('signature_file')->extension(), 'public');
            }
        }

        if ($path) {
            if ($user->signature && $user->signature !== $path) {
                Storage::disk('public')->delete($user->signature);
            }
            $user->update(['signature' => $path]);
        }

        return redirect()->route('profile.show')->with('success', 'บันทึกลายเซ็นสำเร็จ');
    }
}
