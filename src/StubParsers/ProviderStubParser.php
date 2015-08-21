<?php namespace Kodebyraaet\Generators\StubParsers;

class ProviderStubParser extends StubParser
{

    /**
     * Returns the string that will be replaced by {extra_models} in the stub
     * 
     * @return string
     */
    public function extraModels()
    {
        $string = '';

        if (isset($this->data['extraModels'])) {
            foreach ($this->data['extraModels'] as $model) {
                $string .= ','.PHP_EOL.'                new '. $model .'';
            }
        }
        return $string;
    }

    /**
     * Returns the string that will be replaced by {extra_models_use_statements} in the stub
     * 
     * @return string
     */
    public function extraModelsUseStatements()
    {
        $string = '';

        if (isset($this->data['extraModels'])) {
            foreach ($this->data['extraModels'] as $model) {
                $string .= PHP_EOL.'use '.$this->appNamespace().'\\Data\\'.$this->model().'\\Models\\'. $model .';';
            }
        }
        return $string;
    }

}
