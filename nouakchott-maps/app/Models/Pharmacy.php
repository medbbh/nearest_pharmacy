<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pharmacy extends Model
{
    protected $table = 'export-point';

}
class Building extends Model
{
    protected $table = 'buildings'; // Set the table name if it's different from the default convention
    // Define any other model properties or relationships here
}

class Road extends Model
{
    protected $table = 'roads'; // Set the table name if it's different from the default convention
    // Define any other model properties or relationships here
}

class NaturalElement extends Model
{
    protected $table = 'natural'; // Set the table name if it's different from the default convention
    // Define any other model properties or relationships here
}
class Landuse extends Model
{
    protected $table = 'landuse'; // Set the table name if it's different from the default convention
    // Define any other model properties or relationships here
}