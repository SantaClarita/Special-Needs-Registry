<?php

namespace App\Repositories;

use App\User;
use App\Participant;
use App\vw_participant;
use DB;

class ParticipantRepository
{
    public function forParticipant(Participant $participant)
    {
        return Participant::find($participant->id);
    }

    public function forUserCompleted(User $user)
    {
        return Participant::where('user_id', $user->id)
                    ->where('status', 0 )
                    ->orderBy('created_at', 'asc')
                    ->get();
    }
    public function forUserIncomplete(User $user)
    {
        return Participant::where('user_id', $user->id)
                    ->where('status', '<>', 0 )
                    ->orderBy('created_at', 'asc')
                    ->get();
    }

    public function filters($coll, $request) {
        if ($request->input('age_range')) {
            $age_arr = [
                [0, 5],
                [6, 10],
                [11, 15],
                [16, 20],
                [21, 25],
                [26, 30],
                [31, 40],
                [41, 50],
                [51, 60],
                [61, 70],
                [70, 150],
            ];
            $coll->whereBetween('age', $age_arr[$request->input('age_range')-1]);
        }

        $gender = $request->input('gender');
        if ($gender != '')
            $coll->where('gender', $gender);

        return $coll;
    }

    public function search($request)
    {      
         if ($request->input('searchdeleted') == 1) 
            $coll = vw_participant::withTrashed()
                                ->search($request->input('search'), null, true)
                                ->where('status', '==', 0 );
        else
            $coll = vw_participant::search($request->input('search'), null, true)
                                ->where('status', '==', 0 );
        if ($request->input('search') != '') { //to fix for a non-existant 'relevance' column when search is ran with no terms
                             //relevance is generated when there are terms   
            $this->filters($coll, $request);
            return $coll->orderBy('relevance','desc')
                        ->orderBy('birthdate', 'desc')
                        ->orderBy('lname')
                        ->orderBy('fname')
                        ->paginate(15);
        }       
        else {
            $this->filters($coll, $request);
            return $coll->orderBy('birthdate', 'desc')
                        ->paginate(15);
        }
    }

}

