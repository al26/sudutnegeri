<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ComponentContentController extends Controller
{
    public function getModalBody($parent_directory = null, $content) {
        if ($parent_directory !== null) {
            return view("$parent_directory.partials.modal.$content");
        } else {
            return view("partials.modal.$content");
        }
    }

    public function loadModal() {
        return view("components.modal");
    }
}
