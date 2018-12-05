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
        $start = $request->input('age_start');
        $end = $request->input('age_end');

        //if both empty
        if ( !(($start == '' || $start==0)  && ($end == ''|| $end==0)) ) {
            if($start == '' || $start == 0) // if one empty input
                $start = -1;
            if($end == '' || $end == 0) //if one empty input
                $end = 200;
            if($end < $start) { //Swap if order is backwards
                $tmp = $start;
                $start = $end;
                $end = $tmp;
            }
            $coll->whereBetween('age', [ $start, $end ]);
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

