<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MythologyController extends Controller
{
    private $mythologicalItems = [
        1 => [
            'name' => 'Aswang',
            'description' => 'A shapeshifting monster in Filipino folklore usually possessing a combination of the traits of either a vampire, a ghoul, a warlock/witch, or different species of are-beasts.',
            'habitat' => 'Forests, rural villages',
            'abilities' => 'Shapeshifting, blood-drinking, human-eating',
            'weakness' => 'Garlic, salt, silver, holy water, stingray tails'
        ],
        2 => [
            'name' => 'Tikbalang',
            'description' => 'A creature of Philippine folklore said to lurk in the mountains and forests of the Philippines. It is a tall, bony humanoid creature with the head and hooves of a horse and disproportionately long limbs.',
            'habitat' => 'Deep forests, mountains',
            'abilities' => 'Leading travelers astray, superhuman strength',
            'weakness' => 'Plucking a golden hair from its mane'
        ],
        3 => [
            'name' => 'Kapre',
            'description' => 'A Philippine mythical creature that could be characterized as a tree giant. It is described as being a tall, brown, hairy giant, with a strong smell of burnt tobacco.',
            'habitat' => 'Large trees like Balete, Acacias, and Mangoes',
            'abilities' => 'Invisibility, confusion of travelers',
            'weakness' => 'Magical stones or items that can bind them'
        ],
        4 => [
            'name' => 'Manananggal',
            'description' => 'An aswang that can separate its upper torso and sprout huge bat-like wings to fly into the night in search of its victims.',
            'habitat' => 'Rural areas',
            'abilities' => 'Flight, torso separation',
            'weakness' => 'Salt, garlic, or ash on its lower body half'
        ]
    ];

    public function index()
    {
        return view('mythology.index', ['items' => $this->mythologicalItems]);
    }

    public function show($id)
    {
        if (!isset($this->mythologicalItems[$id])) {
            abort(404);
        }

        return view('mythology.show', ['item' => $this->mythologicalItems[$id]]);
    }
}
