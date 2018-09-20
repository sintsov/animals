<?php
namespace Sk\Pets\Components;

use RainLab\Builder\Components\RecordList;
use Redirect;
use BackendAuth;
use Sk\Pets\Models\Pet as Pets;

class PetFilterWidget extends RecordList
{

    public function componentDetails()
    {
        return [
            'name'        => 'sk.pets::lang.pets.catalog_with_filter_widget',
            'description' => 'sk.pets::lang.pets.catalog_with_filter_widget_description'
        ];
    }


    public function onRun()
    {
        $this->prepareVars();

        /**
         * @SK Filter Logic
         */

        $this->page['query_string'] = http_build_query(\Input::all());
        if(strlen($this->page['query_string']) > 0) { $this->page['query_string'] = "?".$this->page['query_string']; }
        $this->parseFilters();

        /**
         * End of additional code
         */

        $this->records = $this->page['records'] = $this->listRecords();
    }

    private function parseFilters()
    {
        $parameters = \Input::all();

        $this->page['filter'] = null;
        if(!empty($parameters['filter']))
        {
            $this->page['filter'] = $parameters['filter'];
            unset($parameters['filter']);
        }

        $this->page['query_parameters'] = $parameters;
    }

    protected function listRecords()
    {
        $modelClassName = $this->property('modelClass');
        if (!strlen($modelClassName) || !class_exists($modelClassName)) {
            throw new SystemException('Invalid model class name');
        }

        $model = new $modelClassName();
        $scope = $this->getScopeName($model);
        $scopeValue = $this->property('scopeValue');

        if ($scope !== null) {
            $model = $model->$scope($scopeValue);
        }

        $model = $this->sort($model);


        /**
         * @SK Additional code
         */

        $parameters = $this->page['query_parameters'];

        foreach($parameters as $key => $value)
        {
            if($key == "type") { $value = strtolower($value); }

            if($value != "any"  && $key != "age")
            {
                $model = $model->searchWhere($value, $key, 'exact');
                continue;
            }



            if($key == "age")
            {
                /**
                 * @SK
                 * Refact later
                 * Just a checking
                 */
                switch ($value) {
                    case 1:
                        $birthdateStart = \Carbon\Carbon::create()->addYears(-1)->format("Y-m-d");
                        $model = $model->where('birthdate', '>', $birthdateStart, 'and');
                        break;
                    case 3:
                        $birthdateStart = \Carbon\Carbon::create()->addYears(-3)->format("Y-m-d");
                        $birthdateEnd = \Carbon\Carbon::create()->addYears(-1)->format("Y-m-d");
                        $model = $model->where('birthdate', '>', $birthdateStart, 'and')->where('birthdate', '<', $birthdateEnd, 'and');
                        break;
                    case 5:
                        $birthdateStart = \Carbon\Carbon::create()->addYears(-5)->format("Y-m-d");
                        $birthdateEnd = \Carbon\Carbon::create()->addYears(-3)->format("Y-m-d");
                        $model = $model->where('birthdate', '>', $birthdateStart, 'and')->where('birthdate', '<', $birthdateEnd, 'and');
                        break;
                    case 999:
                        $birthdateEnd = \Carbon\Carbon::create()->addYears(-5)->format("Y-m-d");
                        $model = $model->where('birthdate', '<', $birthdateEnd, 'and');
                        break;
                    default:
                        break;
                }
            }
        }

        /**
         * End of additional code
         */

        $model = $model->whereNull('departure_date');
        $model = $model->whereNull('death_date');

        $records = $this->paginate($model);

        //echo "<pre>";
        //var_dump($records);
        //die();

        return $records;
    }
}
