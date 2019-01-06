<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Work;
use App\Research;
use App\Project;
use App\Award;

class LandingController extends Controller
{
    //
    public function index(Request $request)
    {
    	$data = null;
    	$user = User::where('type', 'admin')->first();
    	switch($request->get('active')){
    		case 'about-me':
    			$data = $user->about_long;
    			break;
    		case 'education':
    			$data = $user->educations;
    			break;
    		case 'research':
    			$data = Research::all();
    			break;
    		case 'project':
    			$data = Project::all();
    			break;
    		case 'awards':
    			$data = Award::all();
    			break;
            case 'rants':
                $data = "";
                break;
    		default:
    			$data = $user->about_long;
    			break;
    	}
    	return view('public.landing', compact('user', 'data'));
    }
}
