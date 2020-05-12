<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ClubController extends Controller
{
    public function __construct()
    {
    }

    public function index()
    {
        return view('clubs.clubs', [
            'clubs' => Club::orderByDesc('founded')->orderByAsc('name')->get()
        ]);
    }

    public function getClubs()
    {
        $clubs = Club::all();
            return view('clubs', [
                'clubs' => $clubs
            ]);
    }

    public function getClub($id)
    {
        $club = Club::where('id', $id)->get();
        return view('club', [
            'club' => $club
        ]);
    }

    public function addClub()
    {
        return view('clubs.addClub');
    }

    public function addClubPost(Request $request)
    {
        Club::insert([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'founded' => $request->founded,
            'address' => $request->address,
            'phone' => $request->phone
        ]);

        return redirect()->action('ClubController@index');
    }

    public function editClub($id)
    {
        $club = Club::where('id', $id)->first();
        return view('clubs.addClub')->with('club', $club);
    }

    public function editClubPost(Request $request)
    {
        $club = Club::where('id',"=", $request->id)->first();
        Club::where('id',$request->id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'founded' => $request->founded,
            'address' => $request->address,
            'phone' => $request->phone
        ]);

        return redirect()->action('ClubController@index');
    }

    public function deleteClub($id)
    {
        if(Club::where('id',"=", $id)->first() != null)
            Club::where('id','=',$id)->delete();

        return view('home');
    }

    public function tournamentRegistration(Request $request)
    {
        $club = Club::where('id', $request->idKlub)->first();

        $tournament = Tournament::where('id', $request->idTurnir)->get();



        return redirect()->action('ClubController@index');
    }

    public function firePlayer(Request $request)
    {
        $club = Club::where('id', $request->idKlub)->first();

        $player = Player::where('id', $request->idIgrac)->get();

        

        return redirect()->action('ClubController@index');
    }
}