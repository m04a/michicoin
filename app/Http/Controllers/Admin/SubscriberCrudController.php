<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\SubscriberRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use App\Models\Subscriber;
/**
 * Class SubscriberCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class SubscriberCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;

    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     * 
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\Subscriber::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/subscriber');
        CRUD::setEntityNameStrings('subscriber', 'subscribers');
    }

    /**
     * Define what happens when the List operation is loaded.
     * 
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        CRUD::column('email');
        CRUD::column('created_at');
        $this->crud->addButtonFromView('top', 'export', 'export', 'end');
    }




    public function export($format='csv')
    {
       
        $fileName = 'subscribers.csv';
        $subscribers = Subscriber::all();

        $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );

        $columns = array('Email','Date');


        $callback = function() use($subscribers, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($subscribers as $sub) {
                $row['Email']  = $sub->email;             
                $row['Date']  = $sub->created_at->format('d/m/Y H:i');

                fputcsv($file, $row);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);

    }

}
