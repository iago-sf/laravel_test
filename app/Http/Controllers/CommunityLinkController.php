<?php

namespace App\Http\Controllers;

use App\Models\CommunityLink;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Channel;
use App\Http\Requests\CommunityLinkForm;
use App\Queries\CommunityLinksQuery;

class CommunityLinkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Channel $channel = null)
    {
        $query = new CommunityLinksQuery();
        $channels = Channel::orderBy('title','asc')->get();
        $search = request()->exists('search') ? trim(request()->get('search'), " ") : '';

        if(request()->exists('search')){
            if(request()->exists('popular')){
                $links = $query->search($search, 'popular');    

            } else {
                $links = $query->search($search);
            }

        } else {
            if($channel){
                if(request()->exists('popular')){
                    $links = $query->getByChannel($channel, 'popular');
                
                } else {
                    $links = $query->getByChannel($channel);
                }
    
            } else {
                if(request()->exists('popular')){
                    $links = $query->getMostPopular();
                
                } else {
                    $links = $query->getAll();
                }
            }
        }

        return view('community/index', compact('links', 'channels', 'channel', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CommunityLinkForm $request) {
        $approved = Auth::user()->isTrusted();
        $request->merge(['user_id' => Auth::id(), 'approved' => $approved]);

        $link = new CommunityLink();
        $link->user_id = Auth::id();

        if($link->hasAlreadyBeenSubmitted($request->link)) {
            return back()->with('info','You have updated a post.');
        
        } else {
            CommunityLink::create($request->all());

            if($approved){
                return back()->with('success','You added a new post!');
                
            } else {
                
                return back()->with('info','Your post it\'s been sent to revision.');
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CommunityLink  $communityLink
     * @return \Illuminate\Http\Response
     */
    public function show(CommunityLink $communityLink)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CommunityLink  $communityLink
     * @return \Illuminate\Http\Response
     */
    public function edit(CommunityLink $communityLink)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CommunityLink  $communityLink
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CommunityLink $communityLink)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CommunityLink  $communityLink
     * @return \Illuminate\Http\Response
     */
    public function destroy(CommunityLink $communityLink)
    {
        //
    }
}
