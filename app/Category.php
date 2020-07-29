<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{

	public static $messages = [
        'name.required' => 'Es necesario ingresar un nombre para la categoría.',
        'name.min' => 'El nombre de la categoría debe tener al menos 3 caracteres.',
        'description.max' => 'La descripción corta solo admite hasta 250 caracteres.'
    ];
    public static $rules = [
        'name' => 'required|min:3',
        'description' => 'max:250'
    ];

	protected $fillable = ['name', 'description'];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    // OJO: pon el campo que quieres que se convierta en slug ejemplo quiero que el campo "name" se convierta en "slug".
    // Porque si pongo otro nombre por ejemplo "title" no funcionará porque LARAVEL no sabrá que campo usar.
    // Lo mismo pasa con todas, tanto set como get hay que poner el nombre del campo porque sino se cae
    public function setNameAttribute($name)
    {
        $this->attributes['name'] = $name;
        $this->attributes['slug'] = str_slug($name);
    }

    public function getNameAttribute($value)
    {
        return ucwords($value);
    }

    // $category->products
    public function products()
    {
    	return $this->hasMany(Product::class);
    }

    public function getFeaturedImageUrlAttribute()
    {
        if ($this->image)
            return '/images/categories/'.$this->image;
        // else
        $firstProduct = $this->products()->first();
        if ($firstProduct)
            return $firstProduct->featured_image_url;

        return '/images/default.gif';
    }
}
