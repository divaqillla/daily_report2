<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\HolidayModel;

class HolidayController extends BaseController
{
    protected $holidayModel;

    public function __construct()
    {
        $this->holidayModel = new HolidayModel();
    }

    // List all holidays
    public function index()
    {
        $data['holidays'] = $this->holidayModel->orderBy('holiday_date', 'DESC')->findAll();
        return view('holiday/index', $data);
    }

    // Display form to create a new holiday
    public function create()
    {
        return view('holiday/create');
    }

    // Process the form submission to add a holiday
    public function store()
    {
        $holiday_date = $this->request->getPost('holiday_date');
        $description  = $this->request->getPost('description');

        if (!$holiday_date) {
            return redirect()->back()->withInput()->with('error', 'Holiday date is required.');
        }

        $this->holidayModel->insert([
            'holiday_date' => $holiday_date,
            'description'  => $description,
        ]);

        return redirect()->to(site_url('holiday'))->with('success', 'Holiday added successfully.');
    }

    // Delete a holiday record
    public function delete($id)
    {
        $this->holidayModel->delete($id);
        return redirect()->to(site_url('holiday'))->with('success', 'Holiday deleted successfully.');
    }
}
