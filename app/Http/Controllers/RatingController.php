<?php

namespace App\Http\Controllers;

use App\Models\Rating;
use App\Models\Dish;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RatingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ratings = Rating::with(['dish', 'user'])->orderBy('created_at', 'desc')->get();
        return view('admin.ratings.index', compact('ratings'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Rating $rating)
    {
        $rating->delete();

        return redirect()->route('admin.ratings.index')
            ->with('success', 'Avaliação excluída com sucesso.');
    }

    public function storeRating(Request $request)
    {
        $validated = $request->validate([
            'dish_id' => 'required|exists:dishes,id',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:500',
        ]);

        $userId = Auth::id();
        
        $existingRating = Rating::where('dish_id', $validated['dish_id'])
            ->where('user_id', $userId)
            ->first();
            
        if ($existingRating) {
            $existingRating->update([
                'rating' => $validated['rating'],
                'comment' => $validated['comment'],
            ]);
            
            $message = 'Avaliação atualizada com sucesso';
            $rating = $existingRating;
        } else {
            $rating = Rating::create([
                'dish_id' => $validated['dish_id'],
                'user_id' => $userId,
                'rating' => $validated['rating'],
                'comment' => $validated['comment'],
            ]);
            
            $message = 'Avaliação enviada com sucesso';
        }

        return response()->json([
            'success' => true,
            'message' => $message,
            'rating' => $rating,
        ]);
    }

    public function getDishRatings(Dish $dish)
    {
        $ratings = $dish->ratings()->with('user:id,name')->orderBy('created_at', 'desc')->get();
        $averageRating = $ratings->avg('rating') ?? 0;
        
        return response()->json([
            'ratings' => $ratings,
            'average_rating' => $averageRating,
            'ratings_count' => $ratings->count(),
        ]);
    }
} 