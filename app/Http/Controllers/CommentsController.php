<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Comments;

class CommentsController extends Controller
{
  public function index($id)
  {
    //hämtar alla kommentarer för just en bil
    $comments = Comments::getComments($id);
    //retunerar car.blade med alla kommentarer till bilen
    return view('car', ['comments' => $comments]);
  }
  public function store(Request $request)
  {
    //validerar komentaren
    $this->validate($request, [
        'comment' => 'required'
    ]);

    // The logged in users ID
    $userId = Auth::id();
    //skapar querryn för en komentar och sparar den i databasen
    $comment = new Comments;
    $comment->car_id = $request->input('car_id');
    $comment->user_id = $userId;
    $comment->timestamp = '2018-10-03 11:50:10';
    $comment->comment = $request->input('comment');
    $comment->save();

    return back();
  }
}
