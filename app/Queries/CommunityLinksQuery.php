<?php

namespace App\Queries;

use App\Models\Channel;
use App\Models\CommunityLink;

class CommunityLinksQuery
{
    public function getByChannel(Channel $channel, $filter = null)
    {
        if($filter == 'popular'){
            return CommunityLink::where('approved', 1)->where('channel_id', $channel->id)->withCount('users')->orderBy('users_count', 'desc')->paginate(5);

        } else {
            return CommunityLink::where('approved', 1)->where('channel_id', $channel->id)->latest('updated_at')->paginate(5);
        }
    }

    public function getAll()
    {
        return CommunityLink::where('approved', 1)->latest('updated_at')->paginate(5);
    }

    public function getMostPopular()
    {
        return CommunityLink::where('approved', 1)->withCount('users')->orderBy('users_count', 'desc')->paginate(5);
    }

    public function search($search, $filter = null)
    {
        $searchValues = preg_split('/\s+/', $search, -1, PREG_SPLIT_NO_EMPTY);

        if($filter == 'popular'){
            
            return CommunityLink::where('approved', 1)->where( function ($q) use ($searchValues) {
                foreach($searchValues as $value){
                    $q->orWhere('title', 'like', "%". $value ."%");
                }
            })->withCount('users')->orderBy('users_count', 'desc')->paginate(5);

            
        } else {
            return CommunityLink::where('approved', 1)->where(function ($q) use ($searchValues) {
                foreach($searchValues as $value){
                    $q->orWhere('title', 'like', "%". $value ."%");
                }
            })->latest('updated_at')->paginate(5);
        }
    }
}