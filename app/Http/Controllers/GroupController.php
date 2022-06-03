<?php

namespace App\Http\Controllers;

use App\Models\Group;
use Illuminate\Http\Request;

class GroupController extends Controller
{
    public function index()
    {
        $g = Group::query();
        return $g->get()->groupBy('type');
    }
}
