<?php

namespace App\Http\Controllers;
use App\Models\Reel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class ReelController extends Controller
{
    
    public function upload(Request $request)
    {
        $request->validate([
            'video' => 'required|mimes:mp4,mov,ogg,qt|max:20000', // Max size in KB
        ]);

        // Save the file
        $path = $request->file('video')->store('reels', 'public');

        // Store reel data in the database
        $reel = Reel::create([
            'user_id' => $request->user()->id,
            'video_path' => $path,
        ]);

        return response()->json([
            'message' => 'Reel uploaded successfully',
            'reel' => $reel,
        ], 201);
    }

    // Get reel to play
    public function show(Reel $reel)
    {
        $videoUrl = Storage::disk('public')->url($reel->video_path);

        return response()->json([
            'reel' => $reel,
            'video_url' => $videoUrl,
        ]);
    }
}

