<?php

namespace App\Queries;

use App\Models\Channel;
use App\Models\CommunityLink;

class CommunityLinksQuery
{
    public function getByChannel(Channel $channel, $popular = null)
    {
        if($popular){
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
}