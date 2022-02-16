<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\CommunityLinkForm;
use App\Models\CommunityLink;
use App\Queries\CommunityLinksQuery;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class CommunityLinkController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['index', 'show']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $query = new CommunityLinksQuery();
        $search = request()->exists('search') ? trim(request()->get('search'), " ") : '';

        if(request()->exists('search')){
            if(request()->exists('popular')){
                $links = $query->search($search, 'popular');    

            } else {
                $links = $query->search($search);
            }

        } else {
            if(request()->exists('popular')){
                $links = $query->getMostPopular();
            
            } else {
                $links = $query->getAll();
            }
        }

        return response()->json(['Links' => $links], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CommunityLinkForm $request)
    {
        $link = new CommunityLink();

        if($link->hasAlreadyBeenSubmitted($request->link)) {
            return response()->json(['Message' => 'This link has been already sent'], 201);
        
        } else {
            CommunityLink::create($request->all());
            
            return response()->json(['Message' => 'Your entry has succesfully been created'], 200);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CommunityLink  $communityLink
     * @return \Illuminate\Http\Response
     */
    public function show(CommunityLink $communitylink)
    {
        return response()->json(['link' => $communitylink], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CommunityLink  $communityLink
     * @return \Illuminate\Http\Response
     */
    public function update(CommunityLinkForm $request, CommunityLink $communitylink)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CommunityLink  $communityLink
     * @return \Illuminate\Http\Response
     */
    public function destroy(CommunityLink $communitylink)
    {
        $query = new CommunityLinksQuery();
        $link = $query->deleteById($communitylink->id);

        if($link) {
            return response()->json(['Message' => 'Link deleted'], 200);
        } else {
            return response()->json(['Message' => 'Link doesn´t exists'], 201);
        }
    }
}
