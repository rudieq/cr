<?php

namespace App\Http\Controllers;

use App\CrEstate;
use App\CrEstateEdit;

class CrEstatesController extends CrBaseController
{
    protected $dataTable = 'cr_estates';
    protected $dataEditTable = 'cr_estate_edits';
    protected $editRoute = 'estates.edit';
    protected $updateRoute = 'estates.update';
    protected $indexRoute = 'estates.index';

    protected function newDataEdit()
    {
        return new CrEstateEdit;
    }

    protected function getData($id)
    {
        return CrEstate::find($id);
    }
}
