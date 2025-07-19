<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class VideoController extends Controller {

    /**
     * Index video.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $videos = Video::where('status_id', 1)
                        ->withCount('votes')
                        ->orderBy('votes_count', 'desc')
                        ->paginate(10);

        if ($videos->isEmpty()) {
            Log::info('No approved videos found.');
            return response()->json(['message' => 'No videos found.'], 404);
        }

        return response()->json($videos, 200);
    }

    /**
     * Videos by category.
     *
     * @return \Illuminate\Http\Response
     */
    public function videosByCategory($categoryId)
    {
        $videos = Video::where('status_id', 2)
                        ->where('category_id', $categoryId)
                        ->withCount('votes')
                        ->orderBy('votes_count', 'desc')
                        ->paginate(10);

        if ($videos->isEmpty()) {
            Log::info("No approved videos found for category ID: $categoryId");
            return response()->json(['message' => 'No videos found for this category.'], 404);
        }

        return response()->json($videos, 200);
    }

    /**
     * Videos by User ID
     *
     * @return \Illuminate\Http\Response
     */
    public function myVideos(Request $request)
    {
        $user = Auth::user();
        $videos = Video::where('user_id', $user->id)
                        ->withCount('votes')
                        ->orderBy('votes_count', 'desc')
                        ->paginate(10);

        if ($videos->isEmpty()) {
            Log::info("No videos found for user ID: $user->id.");
            return response()->json(['message' => 'No videos found for this user.'], 404);
        }

        return response()->json($videos, 200);
    }

    /**
     * Upload video.
     *
     * @return \Illuminate\Http\Response
     */
    public function upload(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'video' => 'required|mimes:mp4,webm|max:50000',
            'parent_video_id' => 'required|exists:videos,id',
            'category_id' => 'required|exists:categories,id',
            'title' => 'required|string|max:255',
        ]);

        try {
            // Upload the video to AWS S3.
            $path = $request->file('video')->store('videos', 's3', 'public');
            $videoUrl = Storage::disk('s3')->url($path);
            $fileName = basename($path);

            $video = Video::create([
                'user_id' => $user->id,
                'status_id' => 1,
                'category_id' => $request->category_id,
                'parent_video_id' => $request->parent_video_id,
                'title' => $request->title,
                'path' => $videoUrl,
                'file_name' => $fileName
            ]);

            return response()->json(['message' => 'Video uploaded successfully', 'video' => $video], 201);
        } catch (\Exception $e) {
            Log::error('Error uploading video: ' . $e->getMessage());
            return response()->json(['message' => 'Error uploading video.'], 500);
        }
    }

    /**
     * Delete a video.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = Auth::user();

        $video = Video::where('id', $id)->where('user_id', $user->id)->first();

        if (!$video) {
            Log::info("Video not found or unauthorized access attempt by user ID: $user->id for video ID: $id");
            return response()->json(['message' => 'Video not found or unauthorized.'], 404);
        }

        try {
            // @TODO check if the video has been deleted from S3 before continue.
            // This is the video path in the S3 bucket.
            $video_path = 'videos/' . $video->file_name;
            Storage::disk('s3')->delete($video_path);

            $video->delete();

            return response()->json(['message' => 'Video deleted successfully'], 200);
        } catch (\Exception $e) {
            Log::info('Error deleting video: ' . $e->getMessage());
            return response()->json(['message' => 'Error deleting video.'], 500);
        }
    }
}
