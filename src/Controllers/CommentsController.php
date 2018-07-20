<?php

namespace Sanmark\EuphemeLaravelSdk\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Sanmark\EuphemeLaravelSdk\EuphemeService;

class CommentsController extends Controller
{

    public function save(Request $request)
    {
        try {

            $euphemeService = new EuphemeService($request -> instance);
            $comment = $euphemeService -> saveComment($request -> toArray());
            if ($comment -> status == 1) {
                return view('eupheme-laravel-sdk::single-comment', ['comment' => $comment]);
            } else {
                return view('eupheme-laravel-sdk::pending-approval-message');
            }
        } catch (\Exception $e) {
            return view('eupheme-laravel-sdk::error-message');
        }
    }

}