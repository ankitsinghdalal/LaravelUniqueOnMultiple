## Installation

You can install the package via composer:

```bash
composer require ankitsinghdalal/laravel-unique-on-multiple
```

The package will automatically register itself.

## Usage

Inside **app/Http/Requests/Something/StoreSometing.php**

```bash
/**
 * Get the validation rules that apply to the request.
 *
 * @return array
 */
public function rules()
{
    return [
        'name' => 'required|max:225|uniqueOfMultiple:menus,location_id-' . $this->get('location_id', 'NULL') . ',language_id-' . $this->get('language_id', 1),
        'location_id' => 'required|exists:menu_location,id',
        'order' => 'digits_between:0,10'
    ];
}
```

Inside **app/Http/Requests/Something/UpdateSomething.php**

```bash
/**
 * Get the validation rules that apply to the request.
 *
 * @return array
 */
public function rules()
{
    return [
        'name' => 'required|max:225|uniqueOfMultiple:menus,location_id-' . $this->get('location_id', 'NULL') . ',language_id-' . $this->get('language_id', 'NULL') . ',except-id-' . $this->route('id', 'NULL'),
        'location_id' => 'required|exists:menu_location,id',
        'order' => 'digits_between:0,10'
    ];
}
```

Inside **resources/lang/en/validation.php**

```bash
'unique_of_multiple' => 'The :attribute has already been taken under its parent.',
```

In the above written piece of code, the custom validation used is `uniqueOfMultiple`. The first argument passed is the table_name i.e `menus` and all other arguments are column_name(s) that are comma-separated. The columns used while creating the resoource are ` name (primary column)`, `location_id`, and `language_id`. However updating a resource uses one extra `except-for` condition i.e `except-id`. The respective value passed for each field is `-` separated.
