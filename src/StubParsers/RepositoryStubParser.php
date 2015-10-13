<?php namespace Kodebyraaet\Generators\StubParsers;

class RepositoryStubParser extends StubParser
{

    /**
     * Returns the string that will be replaced by {extra_models} in the stub
     * 
     * @return string
     */
    public function extraModelsConstruct()
    {
        $string = '';

        if (isset($this->data['extraModels'])) {
            foreach ($this->data['extraModels'] as $model) {
                $string .= ', ' . $model .' $'. camel_case($model);
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
                $string .= PHP_EOL.'use '.$this->appNamespace().'\\Entities\\'.$this->model().'\\Models\\'. $model .';';
            }
        }
        return $string;
    }

    /**
     * Returns the string that will be replaced by {extra_models_set_variables} in the stub
     * 
     * @return string
     */
    public function extraModelsSetVariables()
    {
        $string = '';

        if (isset($this->data['extraModels'])) {
            foreach ($this->data['extraModels'] as $model) {
                $string .= PHP_EOL.'        $this->'. camel_case($model) .' = $'.camel_case($model). ';';
            }
        }
        return $string;
    }

    /**
     * Returns the string that will be replaced by {extra_models_doc_block} in the stub
     * 
     * @return string
     */
    public function extraModelsDocBlock()
    {
        $string = '';

        if (isset($this->data['extraModels'])) {
            foreach ($this->data['extraModels'] as $model) {
                $string .= PHP_EOL.'     * @param '.$model.' $'.camel_case($model);
            }
        }
        return $string;
    }

}
