<?php

namespace App\Http\Controllers;

use App\CrComputer;
use App\CrComputerEdit;

class CrComputersController extends CrBaseController
{
    protected $dataTable = 'cr_computers';
    protected $dataEditTable = 'cr_computer_edits';
    protected $editRoute = 'computers.edit';
    protected $updateRoute = 'computers.update';
    protected $indexRoute = 'computers.index';

    protected function newDataEdit()
    {
        return new CrComputerEdit;
    }

    protected function getData($id)
    {
        return CrComputer::find($id);
    }
}
