<?php

namespace App\Http\Traits;

use Backpack\PermissionManager\app\Models\Permission;

trait CrudPermissions
{
    private function setupPermissionActions($crud_name){
        $permissions = ['list','create','update','delete','show'];

        if(!backpack_user()->root){
            //Solo los usuarios no root necesitan ser comprobados
            foreach($permissions as $prm){
                $action = $prm.' '.$crud_name;
                $exist = Permission::where('name',$action)->first();
                if($exist){
                    //Solo si el permiso existe se puede conceder, y solo si se puede conceder se puede no tener. Si el usuario actual NO lo tiene bloqueamos la accion
                    if(!backpack_user()->can($action)){
                        $this->crud->denyAccess($prm);
                    }
                }
            }
            //Permiso especial para TODO
            $exist = Permission::where('name',$crud_name)->first();
            if($exist){
                //Si existe debe estar concedido para acceder a todas las acciones.
                if(!backpack_user()->can($crud_name)){
                    $this->crud->denyAccess($permissions);
                }
            }


        }
    }

}